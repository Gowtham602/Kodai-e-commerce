<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KodaiController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TodayDealController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\CategoryController;

use App\Models\Order;



Route::get('/login', function () {
    return redirect()->route('home');
});


Route::get('/', [HomeController::class, 'index'])->name('home');



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


//category for admin
Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {

    Route::resource('categories', CategoryController::class);

});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Route::get('/dashboard', function () {
        //     return view('admin.dashboard');
        // })->name('dashboard');
        
         Route::get('/dashboard', [DashBoardController::class, 'dashboard'])
            ->name('dashboard');
            Route::get('/user-list', [DashBoardController::class, 'userList'])
            ->name('users.index');

        Route::resource('products', AdminProductController::class);

        //order shows
         Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.status');

        Route::get('/admin/orders/{order}/invoice',  [AdminOrderController::class, 'invoice'])
            ->name('orders.invoice');
        //today order 
        Route::get('/admin/orders/today', [AdminOrderController::class, 'todayOrders'])
            ->name('orders.today');
        Route::get('/admin/orders/today/json',[AdminOrderController::class, 'todayOrdersJson'])
            ->name('admin.orders.today.json');

});

// for sticky
Route::get('/cart/summary', [ProductController::class, 'summary'])
    ->name('cart.summary');


// check function routes
// Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::post('/place-order', [CheckoutController::class, 'placeOrder']) ->middleware('auth')
        ->name('place.order');

    Route::get('/order-success/{order}', function (Order $order) {
        return view('checkout.success', compact('order'));
    })->name('order.success');

// });
// Order History (User Side)
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});


//today deal admin login           

Route::get('/test-log', function () {
    logger('LOG SYSTEM WORKING');
    return 'Log test success';
});


//dashboard for admin graph
Route::get('/admin/chart/orders', [DashBoardController::class, 'chartData'])
    ->name('admin.chart.orders');


Route::get(
    '/admin/today-deals/create',
    [TodayDealController::class, 'create']
)->name('admin.today-deals.create');

Route::post(
    '/admin/today-deals/store',
    [TodayDealController::class, 'store']
)->name('admin.today-deals.store');

require __DIR__.'/auth.php';
