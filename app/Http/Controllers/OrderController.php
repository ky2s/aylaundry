<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Services;
use App\Models\Statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\FlipService;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $limit = config('app.pagination.limit');

        $search = $request->input('search');
        
        $orders = Order::when($search, function ($query, $search) {
            return $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        })->orderBy('created_at', 'desc')->paginate($limit);

        // $orders = Order::orderBy('created_at', 'desc')->paginate($limit);
        return view('orders', compact('orders'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::with('orderDetails.service')->find($id);
        $statuses = Statuses::all();
        return view('orders_detail', compact('order', 'statuses'));
    }

    // Menambah pesanan baru
    public function create()
    {
        $services = Services::all();
        $paymentMethods = PaymentMethod::all();
        return view('orders_create', compact("services","paymentMethods"));
    }

    public function store_v1(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_weight' => 'nullable|numeric|min:1',
            'total_price' => 'required|numeric|min:1',
            'status' => 'in:pending,process,done,canceled',
            'notes' => 'nullable|string',
        ]);
        // dd($request);
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'total_weight' => $request->total_weight,
            'total_price' => $request->total_price,
            'status' => $request->status ?? 'pending',
            'notes' => $request->notes,
            'pickup' => $request->pickup == "on" ? true : false,
            'delivery' => $request->delivery == "on" ? true : false,
            'order_date' => now(),
        ]);
        
        return redirect()->route('orders.show', $order)->with('success', 'Order berhasil dibuat!');
    }

    public function store(Request $request)
    {

        $flip = new FlipService();
    
        $customer = Customer::find($request->customer_id);
        $va = $flip->createVirtualAccount($customer);
        
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'customer_id' => 'required|numeric|exists:customers,id',
            'services' => 'required|array',
            'services.*.id' => 'required|exists:services,id',
            'services.*.quantity' => 'required|numeric|min:1',
            'services.*.weight' => 'required|numeric|min:1',
            'total_weight' => 'nullable|numeric|min:1',
            'total_price' => 'required|min:1',
            'notes' => 'nullable|string',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);
        
        // Hitung total harga pesanan berdasarkan layanan yang dipilih
        DB::beginTransaction();
        
        try {
            // Hitung total harga dan berat pesanan
            $totalPrice = 0;
            $totalWeight = 0;
    
            foreach ($validatedData['services'] as $serviceData) {
                $service = Services::findOrFail($serviceData['id']);
                $weight = $serviceData['weight'] ?? 1; 
                $quantity = $serviceData['quantity'];
                $totalWeight += $weight * $quantity;
                $totalPrice += $service->price_per_kg * $weight * $quantity;
            }
    
            // Ambil data customer
            $customer = Customer::findOrFail($request->customer_id);
    
            // Simpan order
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->phone,
                'address' => $customer->address,
                'total_price' => $totalPrice,
                'total_weight' => $totalWeight,
                'status' => $request->status ?? 'pending',
                'notes' => $request->notes,
                'delivery' => $request->delivery == "yes" ? true : false,
                'payment_method_id' => $request->payment_method_id,
            ]);
    
            // Simpan detail order
            foreach ($validatedData['services'] as $serviceData) {
                $service = Services::findOrFail($serviceData['id']);
                
                OrderDetail::create([
                    'order_id' => $order->id,
                    'service_id' => $service->id,
                    'service_name' => $service->service_name,
                    'price_per_kg' => $service->price_per_kg,
                    'price_per_item' => $service->price_per_item,
                    'estimated_time' => $service->estimated_time,
                    'quantity' => $serviceData['quantity'],
                    'sub_total' => $service->price_per_kg * $serviceData['quantity'],
                ]);
            }
    
            // Commit transaksi jika semua berhasil
            DB::commit();
    
            // return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
            return redirect()->route('orders.receipt', ['order' => $order->id])->with('success', 'Pesanan berhasil dibuat.');
    
        } catch (\Exception $e) {
            // Rollback jika ada kesalahan
            DB::rollBack();
    
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan pesanan: ' . $e->getMessage());
        }
    }

    public function receipt(Order $order)
    {
        return view('orders_receipt', compact('order'));
    }

    // Mengupdate status pesanan
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return redirect()->route('home')->with('success', 'Pesanan berhasil diperbarui!');
    }

    // Menghapus pesanan
    public function destroy($id)
    {
        Order::destroy($id);
        return redirect()->route('home')->with('success', 'Pesanan berhasil dihapus!');
    }

    public function searchCustomers(Request $request)
    {
        $search = $request->get('q');
        $customers = \App\Models\Customer::where('name', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->limit(10)
                    ->get();

        return response()->json($customers);
    }

    public function updateStatus(Request $request, Order $order)
    {

        $statuses = Statuses::pluck('name')->join(',');
        $request->validate([
            'status' => "required|in:$statuses"
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status updated!');
    }
}
