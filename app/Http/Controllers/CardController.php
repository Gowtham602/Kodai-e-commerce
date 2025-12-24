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
}
