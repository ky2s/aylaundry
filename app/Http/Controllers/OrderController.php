<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Buat pesanan baru
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $service = Service::findOrFail($request->service_id);
        $totalPrice = $service->price * $request->quantity;

        $order = Order::create([
            'customer_id' => $request->user()->id,
            'service_id' => $request->service_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
        ]);
    }

    // Lihat semua pesanan user
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())->get();
        return response()->json($orders);
    }

    // Update status pesanan (admin)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate(['status' => 'in:Proses,Selesai,Batal']);
        $order->update(['status' => $request->status]);

        return response()->json(['message' => 'Order status updated', 'order' => $order]);
    }

    // Detail pesanan
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }
}
