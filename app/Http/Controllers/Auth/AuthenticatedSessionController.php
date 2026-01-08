<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Cart;
use App\Models\CartItem;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
 public function store(LoginRequest $request): RedirectResponse
{
    $sessionCart = session('cart', []);

    $request->authenticate();
    $request->session()->regenerate();

    session(['cart' => $sessionCart]);
    $this->mergeSessionCartToDb();

    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    //  THIS IS THE FIX
    return redirect()->intended(route('cart.index'));
}



private function mergeSessionCartToDb()
{
    $sessionCart = session('cart', []);
    if (empty($sessionCart)) return;

    $cart = Cart::firstOrCreate([
        'user_id' => auth()->id()
    ]);

    foreach ($sessionCart as $productId => $item) {
        $cartItem = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $productId
        ]);

        $cartItem->qty = ($cartItem->qty ?? 0) + $item['qty'];
        $cartItem->price = $item['price'];
        $cartItem->save();
    }

    // reload relation
    $cart->load('items');

    $cart->subtotal = $cart->items->sum(fn($i) => $i->qty * $i->price);
    $cart->save();

    session()->forget('cart');
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
