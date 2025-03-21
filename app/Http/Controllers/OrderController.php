<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::all();
        return view('orders', compact('orders'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('order_detail', compact('order'));
    }

    // Menambah pesanan baru
    public function create()
    {
        return view('orders_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_weight' => 'nullable|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'status' => 'in:pending,process,done,canceled',
            'notes' => 'nullable|string',
            'pickup' => 'boolean',
            'delivery' => 'boolean',
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_weight' => $request->total_weight,
            'total_price' => $request->total_price,
            'status' => $request->status ?? 'pending',
            'notes' => $request->notes,
            'pickup' => $request->pickup ?? false,
            'delivery' => $request->delivery ?? false,
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
}
