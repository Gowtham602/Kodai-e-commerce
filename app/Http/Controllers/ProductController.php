<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //for uses page interface
   
public function index()
{
    $categories = Category::where('is_active', 1)->get();

    $products = Product::where('is_active', 1)
        ->with('category')
        ->latest()
        ->paginate(8); //  paginator

    return view('productuser.product', compact('categories', 'products'));
}


//filter and also the sort by price
public function filter(Request $request)
{
    $query = Product::with('category')
        ->where('is_active', 1);

    if ($request->filled('categories')) {
        $query->whereIn('category_id', (array) $request->categories);
    }

    if ($request->sort === 'latest') {
        $query->latest();
    } elseif ($request->sort === 'price_low') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'price_high') {
        $query->orderBy('price', 'desc');
    }

    $products = $query
        ->paginate(8)
        ->withQueryString();

    return response()->json([
        'products' => $products->items(),
        'pagination' => (string) $products->links('pagination::bootstrap-5'),
    ]);
}


// check if user is login or session  -> store to session or db
public function add(Request $request)
{
    if (auth()->check()) {
        return $this->addToDbCart($request);
    }
    return $this->addToSessionCart($request);
}

//if user not login add to session 
private function addToSessionCart($request)
{
    $cart = session('cart', []);
    $product = Product::findOrFail($request->id);
    $id = $product->id;

    if (!isset($cart[$id])) {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'qty' => 1
        ];
    } else {
        $cart[$id]['qty']++;
    }

    session(['cart' => $cart]);

    return response()->json([
        'count' => collect($cart)->sum('qty')
    ]);
}


//if user is login means store to db 
private function addToDbCart($request)
{
    $product = Product::findOrFail($request->id);

    $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

    $item = CartItem::firstOrNew([
        'cart_id' => $cart->id,
        'product_id' => $product->id
    ]);

    $item->qty = ($item->qty ?? 0) + 1;
    $item->price = $product->price; // ALWAYS DB PRICE
    $item->save();

    $cart->load('items');
    $cart->subtotal = $cart->items->sum(fn($i) => $i->qty * $i->price);
    $cart->save();

    return response()->json([
        'count' => $cart->items->sum('qty')
    ]);
}

// Call this BEFORE checkout page
public function checkout()
{
    $cart = Cart::with('items.product')
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $this->refreshCartPrices($cart);

    return view('checkout.index', compact('cart'));
}


// MOST IMPORTANT: PRICE VALIDATION AT CHECKOUT
private function refreshCartPrices($cart)
{
    foreach ($cart->items as $item) {
        $currentPrice = $item->product->price;

        if ($item->price != $currentPrice) {
            $item->price = $currentPrice;
            $item->save();
        }
    }

    $cart->update([
        'subtotal' => $cart->items->sum(fn($i) => $i->qty * $i->price)
    ]);
}


public function show()
{
    if (auth()->check()) {
        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->first();

        return view('cart.index', [
            'cart' => $cart,
            'useDb' => true,
        ]);
    }

    return view('cart.index', [
        'cart' => session('cart', []),
        'useDb' => false,
    ]);
}



    //UPDATE QTY (SESSION + DB)
public function update(Request $request)
{
    if (auth()->check()) {
        return $this->updateDbCart($request);
    }

    // SESSION
    $cart = session('cart', []);
    $id = $request->id;

    if (isset($cart[$id])) {
        $cart[$id]['qty'] = max(1, $cart[$id]['qty'] + $request->change);
    }

    session(['cart' => $cart]);

    return $this->sessionSummary($cart);
}

// updated for db after login
private function updateDbCart($request)
{
    $cart = Cart::where('user_id', auth()->id())->first();
    if (!$cart) return response()->json($this->emptyResponse());

    $item = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $request->id)
        ->first();

    if ($item) {
        $item->qty = max(1, $item->qty + $request->change);
        $item->save();
    }

    return $this->dbSummary($cart);
}


// DELETE ITEM (SESSION + DB)
public function delete(Request $request)
{
    if (auth()->check()) {
        return $this->deleteDbCart($request);
    }

    // SESSION
    $cart = session('cart', []);
    unset($cart[$request->id]);

    session(['cart' => $cart]);

    return $this->sessionSummary($cart);
}

// DELETE DB CART ITEM
private function deleteDbCart($request)
{
    $cart = Cart::where('user_id', auth()->id())->first();
    if (!$cart) return response()->json($this->emptyResponse());

    CartItem::where('cart_id', $cart->id)
        ->where('product_id', $request->id)
        ->delete();

    return $this->dbSummary($cart);
}

// SESSION SUMMARY
private function sessionSummary($cart)
{
    return response()->json([
        'cart' => $cart,
        'count' => collect($cart)->sum('qty'),
        'subtotal' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
        'total' => collect($cart)->sum(fn($i) => $i['price'] * $i['qty']),
    ]);
}

// DB SUMMARY
private function dbSummary($cart)
{
    $cart->load('items.product');

    $subtotal = $cart->items->sum(fn($i) => $i->qty * $i->price);

    $cart->update(['subtotal' => $subtotal]);

    return response()->json([
        'cart' => $cart->items->mapWithKeys(fn($i) => [
            $i->product_id => [
                'qty' => $i->qty,
                'price' => $i->price,
            ]
        ]),
        'count' => $cart->items->sum('qty'),
        'subtotal' => $subtotal,
        'total' => $subtotal,
    ]);
}

//EMPTY RESPONSE (FOR SAFETY)
private function emptyResponse()
{
    return [
        'cart' => [],
        'count' => 0,
        'subtotal' => 0,
        'total' => 0,
    ];
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

 public function count()
    {
        return response()->json(['count' => count(session('cart',[]))]);
    }





























    // show add product form for admin
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    // store product in DB for admin
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'weight' => 'nullable|string',
            'price' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = new Product();
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->is_active = true;

        // image upload
         if ($request->hasFile('image')) {

        $slug = Str::slug($request->name); // pineapple-jelly
        $extension = $request->image->getClientOriginalExtension(); // jpg

        // count existing images with same name
        $count = Product::where('name', $request->name)->count() + 1;

        $imageName = $slug . '-' . $count . '.' . $extension;
        $path = $request->image->storeAs('products', $imageName, 'public');

        $product->image = $path;
    }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully');
    }




}
