<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Services;
use App\Models\Statuses;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('orders', compact('orders'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $statuses = Statuses::all();
        return view('orders_detail', compact('order', 'statuses'));
    }

    // Menambah pesanan baru
    public function create()
    {
        $services = Services::all();
        return view('orders_create', compact("services"));
    }

    public function store(Request $request)
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
