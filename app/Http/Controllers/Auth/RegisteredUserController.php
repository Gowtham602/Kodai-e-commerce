<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


// public function store(Request $request): JsonResponse
// {
//     try {
//         $validated = $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'email', 'max:255', 'unique:users'],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         $user = User::create([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//         ]);

//         Auth::login($user);

//         return response()->json([
//             'success' => true,
//             'message' => 'Registration successful. Welcome!',
//         ]);

//     } catch (ValidationException $e) {
//         return response()->json([
//             'success' => false,
//             'errors' => $e->errors(),
//         ], 422);
//     }
// }

public function store(Request $request): JsonResponse
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);
    //SAVE SESSION CART
    $sessionCart = session('cart', []);
    Auth::login($user);
    session(['cart' => $sessionCart]);

    // MERGE CART
    $this->mergeSessionCartToDb();

    return response()->json([
        'success' => true,
        'message' => 'Registration successful'
    ]);
}
//send otp
// public function sendOtp(Request $request)
// {
//     $validated = $request->validate([
//         'name'  => 'required|string|max:255',
//         'phone' => 'required|digits:10|unique:users,phone',
//     ]);

//     $otp = rand(100000, 999999);

//     session([
//         'otp' => $otp,
//         'otp_expires_at' => now()->addSeconds(60),
//         'register_name' => $validated['name'],
//         'register_phone' => $validated['phone'],
//     ]);

//     logger("OTP: ".$otp); // temp for testing

//     return response()->json([
//         'message' => 'OTP sent successfully'
//     ]);
// }



// public function sendOtp(Request $request)
// {
//     $request->validate([
//         'name'  => 'required|string|max:255',
//         'phone' => 'required|digits:10|unique:users,phone'
//     ], [
//         'phone.unique' => 'This phone number is already registered. Please login.'
//     ]);

//     $otp = rand(100000, 999999);
//      Session::forget(['register_otp', 'otp_expires_at']);

//     Session::put('register_otp', $otp);
//     Session::put('register_phone', $request->phone);
//     Session::put('register_name', $request->name);
//     Session::put('otp_expires_at', now()->addMinutes(2)); // ⏱ 2 mins

//     if (config('sms.mode') === 'log') {
//         Log::info("OTP for {$request->phone} is {$otp}");
//         return response()->json(['message' => 'OTP logged']);
//     }

//    $response= Http::get('http://its.idealsms.in/pushsms.php', [
//         'username' => config('sms.username'),
//         'api_password' => config('sms.password'),
//         'sender' => config('sms.sender'),
//         'to' => $request->phone,
//         'message' => "Your OTP is {$otp}. Valid for 5 minutes. IDLSMS",
//         'priority' => config('sms.priority'),
//         'e_id' => config('sms.e_id'),
//         't_id' => config('sms.t_id'),
//     ]);
//     Log::info('SMS RESPONSE', [
//         'status' => $response->status(),
//         'body'   => $response->body(),
//     ]);

//     return response()->json(['message' => 'OTP sent']);
// }
public function sendOtp(Request $request)
{
    // dd($request);
    $request->validate([
        'name'  => 'required|string|max:255',
        'phone' => 'required|digits:10|unique:users,phone'
    ],[
        'phone.unique' => 'This phone number is already registered. Please login.'
    ]);
    

    $otp = rand(100000, 999999);

    session([
        'register_otp'   => $otp,
        'register_phone' => $request->phone,
        'register_name'  => $request->name,
        'otp_expires_at' => now()->addMinutes(2),
    ]);

    if (config('sms.mode') === 'log') {
        Log::info("OTP for {$request->phone} is {$otp}");
        return response()->json(['message' => 'OTP logged']);
    }

    //  EXACT DLT TEMPLATE
    $message = "{$otp} Please use this OTP {$otp} for your registration.IDLSMS";

    $response = Http::asForm()->post(
        'http://its.idealsms.in/pushsms.php',
        [
            'username'     => config('sms.username'),
            'api_password' => config('sms.password'),
            'sender'       => config('sms.sender'),
            'to'           => $request->phone,
            'message'      => $message,
            'priority'     => config('sms.priority'),
            'e_id'         => config('sms.e_id'),
            't_id'         => config('sms.t_id'),
        ]
    );

    Log::info('SMS RESPONSE', [
        'status' => $response->status(),
        'body'   => $response->body(),
    ]);

    return response()->json(['message' => 'OTP sent']);
}



//verify otp 
// public function verifyOtp(Request $request)
// {
//     $request->validate([
//         'otp' => 'required|digits:6',
//     ]);

//     if (!session()->has('otp') || now()->greaterThan(session('otp_expires_at'))) {
//         return response()->json(['message' => 'OTP expired'], 422);
//     }

//     if ($request->otp != session('otp')) {
//         return response()->json(['message' => 'Invalid OTP'], 422);
//     }

//     return response()->json(['success' => true]);
// }
public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6'
    ]);

    if (!session()->has('register_otp') || !session()->has('otp_expires_at')) {
        return response()->json(['message' => 'OTP expired'], 422);
    }

    if (now()->greaterThan(session('otp_expires_at'))) {
        session()->forget(['register_otp', 'otp_expires_at']);
        return response()->json(['message' => 'OTP expired'], 422);
    }

    if ($request->otp != session('register_otp')) {
        return response()->json(['message' => 'Invalid OTP'], 422);
    }

    return response()->json(['message' => 'OTP verified']);
}



// completeRegister() — CREATE USER

// public function completeRegister(Request $request)
// {
//     $request->validate([
//         'email' => 'required|email|unique:users,email',
//         'password' => ['required','confirmed', Rules\Password::defaults()],
//     ]);

//     if (!session()->has('register_phone')) {
//         return response()->json(['message' => 'Session expired'], 422);
//     }

//     $user = User::create([
//         'name' => session('register_name'),
//         'phone' => session('register_phone'),
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//     ]);

//         //  SAVE SESSION CART
//         $sessionCart = session('cart', []);

//         Auth::login($user);

//         //  RESTORE SESSION CART
//         session(['cart' => $sessionCart]);

//         //  MERGE CART
//         $this->mergeSessionCartToDb();

//         session()->forget([
//             'otp','otp_expires_at','register_name','register_phone'
//         ]);

//         return response()->json([
//             'success' => true,
//             'redirect' => route('cart.index')
//         ]);

// }
public function completeRegister(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => ['required','confirmed', Rules\Password::defaults()],
    ]);

    if (!session()->has('register_phone') || !session()->has('register_name')) {
        return response()->json(['message' => 'Session expired'], 422);
    }

    $user = User::create([
        'name' => session('register_name'),
        'phone' => session('register_phone'),
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $sessionCart = session('cart', []);
    Auth::login($user);
    session(['cart' => $sessionCart]);

    $this->mergeSessionCartToDb();

    session()->forget([
        'register_otp',
        'register_name',
        'register_phone'
    ]);

    return response()->json([
        'success' => true,
        'redirect' => route('cart.index')
    ]);
}



private function mergeSessionCartToDb(){
    $sessionCart =session('cart',[]);
    if(empty($sessionCart)) return;

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
         $cart->update([
        'subtotal' => $cart->items->sum(fn ($i) => $i->qty * $i->price)
    ]);

    session()->forget('cart');


} 

}
