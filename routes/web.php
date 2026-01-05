<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KodaiController;
use App\Http\Controllers\CheckOutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TodayDealController;
use App\Models\Order;



Route::get('/login', function () {
    return redirect()->route('home');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//about
Route::get('/about', [KodaiController::class, 'about'])->name('about');


//product ,productfilter ,add cart
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
//filter by sort
// Route::get('/products/filter/sort',[ProductController::class,'sort'])->name('product.sort');

Route::post('/cart/add', [ProductController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [ProductController::class, 'count'])->name('cart.count');


//cart + add and - 
Route::post('/cart/update', [ProductController::class, 'update'])->name('cart.update');
Route::post('/cart/delete', [ProductController::class, 'delete'])->name('cart.delete');

Route::get('/cart', [ProductController::class, 'show'])
    ->name('cart.index'); // IMPORTANT: rename



Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('products', AdminProductController::class);
});


// check function routes
Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');

    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])
        ->name('place.order');

    Route::get('/order-success/{order}', function (Order $order) {
        return view('checkout.success', compact('order'));
    })->name('order.success');

});

if (!$cart || $cart->items->isEmpty()) {
    return redirect()->route('products.index')
        ->with('error', 'Please add items to your cart');
}



//today deal admin login           

Route::get('/test-log', function () {
    logger('LOG SYSTEM WORKING');
    return 'Log test success';
});


Route::get(
    '/admin/today-deals/create',
    [TodayDealController::class, 'create']
)->name('admin.today-deals.create');

Route::post(
    '/admin/today-deals/store',
    [TodayDealController::class, 'store']
)->name('admin.today-deals.store');

require __DIR__.'/auth.php';
