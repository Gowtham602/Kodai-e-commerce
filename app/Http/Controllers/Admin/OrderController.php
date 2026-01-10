<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /* =========================
       ORDERS LIST
    ========================== */
    public function index(Request $request)
    {
        $orders = Order::latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /* =========================
       ORDER DETAILS
    ========================== */
    public function show(Order $order)
    {
        $order->load('items');

        return view('admin.orders.show', compact('order'));
    }

    /* =========================
       UPDATE ORDER STATUS
    ========================== */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated');
    }

    /* =========================
       DOWNLOAD INVOICE PDF
    ========================== */
    public function invoice(Order $order)
    {
        // dd($order);
        $order->load('items');

        $pdf = Pdf::loadView('admin.orders.invoice', compact('order'))
                  ->setPaper('a4');

        return $pdf->download('invoice-'.$order->order_number.'.pdf');
    }
}
