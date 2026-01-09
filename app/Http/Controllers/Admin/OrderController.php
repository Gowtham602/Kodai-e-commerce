<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

   public function updateStatus(Order $order)
{
    request()->validate([
        'status' => 'required'
    ]);

    $order->update([
        'status' => request('status')
    ]);

    return back()->with('success', 'Order status updated');
}
}
