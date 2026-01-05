<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index()
{
    if (!auth()->check()) {
        // session(['redirect' => 'checkout']);
         session(['redirect' => url('/checkout')]);
        // return redirect()->route('login');
        return redirect()->back()->with('showLoginModal', true);
    }

    $cart = Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->firstOrFail();
    // dd($cart);
    $priceChanged = false;

    foreach ($cart->items as $item) {
        $latestPrice = $item->product->price;
        // dd($latestPrice);

        if ($item->price != $latestPrice) {
            $item->price = $latestPrice;
            $item->save();
            $priceChanged = true;
        }
    }

    $cart->update([
        'subtotal' => $cart->items->sum(fn($i) => $i->qty * $i->price)
    ]);

    return view('checkout.index', compact('cart', 'priceChanged'));
}




public function placeOrder(Request $request)
{
    $cart = Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->firstOrFail();

    DB::beginTransaction();

    try {

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD' . now()->timestamp,
            'subtotal' => $cart->subtotal,
            'total' => $cart->subtotal,
            'status' => 'placed',
            'payment_method' => 'cod',
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'qty' => $item->qty,
                'price' => $item->price,
                'total' => $item->qty * $item->price,
            ]);
        }

        // Clear cart
        $cart->items()->delete();
        $cart->delete();

        DB::commit();

        return redirect()->route('order.success', $order->id);

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Order failed');
    }
}


}
