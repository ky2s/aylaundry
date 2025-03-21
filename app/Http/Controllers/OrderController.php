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
        return view('home', compact('orders'));
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
        return view('order_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'service_type' => 'required',
            'status' => 'required'
        ]);

        Order::create($request->all());
        return redirect()->route('home')->with('success', 'Pesanan berhasil ditambahkan!');
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
