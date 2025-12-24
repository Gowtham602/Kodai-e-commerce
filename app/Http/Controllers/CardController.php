<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
   public function index()
    {
        return view('cart.index'); // create this view later
    }


     public function add(Request $request)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$request->id])) {
        $cart[$request->id]['qty'] += 1;
    } else {
        $cart[$request->id] = [
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'qty' => 1
        ];
    }

    session()->put('cart', $cart);

    return response()->json([
        'count' => count($cart)
    ]);
}


    public function count()
    {
        return response()->json(['count' => count(session('cart',[]))]);
    }


    //cart add and - 
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, $cart[$id]['qty'] + $request->change);
            session()->put('cart', $cart);
        }

        return response()->json($this->cartSummary($cart));
    }

    public function delete(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->id]);
        session()->put('cart', $cart);

        // return response()->json($this->cartSummary($cart));
        return response()->json([
        'count' => count($cart),
        'subtotal' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
        'total' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
    ]);
    }

    private function cartSummary($cart)
    {
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $discount = 0;
        $total = $subtotal - $discount;

        return [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'total' => $total,
            'count' => count($cart)
        ];
    }
}
