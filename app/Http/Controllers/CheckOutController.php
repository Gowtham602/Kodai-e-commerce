<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Address;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedCustomer;
use App\Mail\OrderPlacedAdmin;



class CheckoutController extends Controller
{
  public function index()
{
    // if (!auth()->check()) {
    //     session(['redirect' => url('/checkout')]);
    //     return redirect()->route('home')->with('showLoginModal', true);
    // }

    $cart = Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->first();

    //  VERY IMPORTANT CHECK
    if (!$cart || $cart->items->isEmpty()) {
        return redirect()
            ->route('home')
            ->with('info', 'Your cart is empty');
    }

    $priceChanged = false;

    foreach ($cart->items as $item) {
        $latestPrice = $item->product->price;

        if ($item->price != $latestPrice) {
            $item->price = $latestPrice;
            $item->save();
            $priceChanged = true;
        }
    }

    $cart->update([
        'subtotal' => $cart->items->sum(fn ($i) => $i->qty * $i->price)
    ]);

    $addresses = Address::where('user_id', auth()->id())->latest()->get();

    return view('checkout.index', compact('cart', 'priceChanged', 'addresses'));
}


public function placeOrder(Request $request)
{
    // dd($request->all());
// 
    //  CASE 1: Saved address
    if ($request->address_type === 'saved') {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);
    }
    //  CASE 2: Self / Other (manual address)
    else {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|min:10',
            'email' => 'required|email',
            'address' => 'required|min:10',
            'state' => 'required',
            'pincode' => 'required',
        ]);
    }
    // dd('Reached transaction');

    $cart = Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->first();

    DB::beginTransaction();

    try {

        //  ADDRESS
        if ($request->address_type === 'saved') {
            $address = Address::where('id', $request->address_id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        } else {
            $address = Address::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'near_place' => $request->near_place,
            ]);
        }

        //  ORDER
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'ORD' . now()->timestamp,
            'subtotal' => $cart->subtotal,
            'total' => $cart->subtotal,
            'status' => 'placed',
            'payment_method' => 'cod',

            // SNAPSHOT
            'customer_name' => $address->name,
            'customer_phone' => $address->phone,
            'customer_email' => $address->email,
            'shipping_address' => $address->address,
            'state' => $address->state,
            'pincode' => $address->pincode,
            'near_place' => $address->near_place,
        ]);

        //  ORDER ITEMS
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

        //  CLEAR CART
        $cart->items()->delete();
        $cart->delete();

        DB::commit();
        // Send email to customer
        } catch (\Exception $e) {
    DB::rollBack();
    logger('Order failed: '.$e->getMessage());
    return back()->withErrors('Order failed. Please try again.');
}

try {
    Mail::to($order->customer_email)
        ->send(new OrderPlacedCustomer($order));

    Mail::to('admin@kodaichocolates.com')
        ->send(new OrderPlacedAdmin($order));
} catch (\Exception $e) {
    logger('Mail error: '.$e->getMessage());
}

return redirect()
    ->route('order.success', $order->id)
    ->with('order_placed', true);
}

}


