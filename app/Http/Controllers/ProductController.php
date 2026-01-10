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
    /* ==============================
       PRODUCT LISTING
    ============================== */

    public function index()
    {
        $categories = Category::where('is_active', 1)->get();

        $products = Product::where('is_active', 1)
            ->with('category')
            ->latest()
            ->paginate(8);

        return view('productuser.product', compact('categories', 'products'));
    }

    public function filter(Request $request)
    {
        $query = Product::with('category')->where('is_active', 1);

        if ($request->filled('categories')) {
            $query->whereIn('category_id', (array) $request->categories);
        }

        match ($request->sort) {
            'latest' => $query->latest(),
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            default => null,
        };

        $products = $query->paginate(8)->withQueryString();

        return response()->json([
            'products' => $products->items(),
            'pagination' => (string) $products->links('pagination::bootstrap-5'),
        ]);
    }

    /* ==============================
       ADD TO CART
    ============================== */

    public function add(Request $request)
    {
        return auth()->check()
            ? $this->addToDbCart($request)
            : $this->addToSessionCart($request);
    }

    private function addToSessionCart(Request $request)
    {
        $cart = session('cart', []);
        $product = Product::findOrFail($request->id);

        if (!isset($cart[$product->id])) {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'qty' => 1
            ];
        } else {
            $cart[$product->id]['qty']++;
        }

        session(['cart' => $cart]);

        return $this->sessionSummary($cart);
    }

    private function addToDbCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $item = CartItem::firstOrNew([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
        ]);

        $item->qty = ($item->qty ?? 0) + 1;
        $item->price = $product->price;
        $item->save();

        $cart->load('items');

        return $this->buildResponse($cart->items);
    }

    /* ==============================
       CART PAGE
    ============================== */

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

    /* ==============================
       UPDATE QTY
    ============================== */

    public function update(Request $request)
    {
        return auth()->check()
            ? $this->updateDbCart($request)
            : $this->updateSessionCart($request);
    }

    private function updateSessionCart(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, $cart[$id]['qty'] + $request->change);
        }

        session(['cart' => $cart]);

        return $this->sessionSummary($cart);
    }

    private function updateDbCart(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart) {
            return $this->emptyResponse();
        }

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->id)
            ->first();

        if ($item) {
            $item->qty = max(1, $item->qty + $request->change);
            $item->save();
        }

        $cart->load('items');

        return $this->buildResponse($cart->items);
    }

    /* ==============================
       DELETE ITEM
    ============================== */

    public function delete(Request $request)
    {
        return auth()->check()
            ? $this->deleteDbCart($request)
            : $this->deleteSessionCart($request);
    }

    private function deleteSessionCart(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->id]);

        if (empty($cart)) {
            session()->forget('cart');   //  IMPORTANT
        } else {
            session(['cart' => $cart]);
        }

        return $this->sessionSummary($cart);
    }

    private function deleteDbCart(Request $request)
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if (!$cart) {
            return $this->emptyResponse();
        }

        CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->id)
            ->delete();

        $cart->load('items');

        return $this->buildResponse($cart->items);
    }

    /* ==============================
       CART COUNT (HEADER)
    ============================== */

    public function count()
    {
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->first();
            return response()->json([
                'count' => $cart ? $cart->items()->sum('qty') : 0
            ]);
        }

        return response()->json([
            'count' => collect(session('cart', []))->sum('qty')
        ]);
    }

    /* ==============================
       HELPERS (IMPORTANT)
    ============================== */

    private function buildResponse($items)
    {
        return response()->json([
            'items' => $items->mapWithKeys(fn($i) => [
                $i->product_id => [
                    'qty' => $i->qty,
                    'price' => $i->price,
                ]
            ]),
            'count' => $items->sum('qty'),
            'subtotal' => $items->sum(fn($i) => $i->qty * $i->price),
        ]);
    }

    private function sessionSummary($cart)
    {
        $items = collect($cart)
    ->filter(fn ($i) => is_array($i))
    ->mapWithKeys(fn ($i, $id) => [
        $id => [
            'qty' => $i['qty'],
            'price' => $i['price'],
        ]
    ]);

        return response()->json([
            'items' => $items,
            'count' => $items->sum('qty'),
            'subtotal' => $items->sum(fn($i) => $i['qty'] * $i['price']),
        ]);
    }

    private function emptyResponse()
    {
        return response()->json([
            'items' => [],
            'count' => 0,
            'subtotal' => 0,
        ]);
    }

    // this for sitckly
    public function summary()
{
    if (auth()->check()) {
        $cart = Cart::with('items')->where('user_id', auth()->id())->first();

        return response()->json([
            'count' => $cart ? $cart->items->sum('qty') : 0,
            'subtotal' => $cart
                ? $cart->items->sum(fn ($i) => $i->qty * $i->price)
                : 0,
        ]);
    }

    $cart = collect(session('cart', []));

    return response()->json([
        'count' => $cart->sum('qty'),
        'subtotal' => $cart->sum(fn ($i) => $i['qty'] * $i['price']),
    ]);
}


    /* ==============================
       ADMIN PRODUCT CREATE
    ============================== */

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

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

        if ($request->hasFile('image')) {
            $slug = Str::slug($request->name);
            $ext = $request->image->getClientOriginalExtension();
            $count = Product::where('name', $request->name)->count() + 1;

            $imageName = "{$slug}-{$count}.{$ext}";
            $product->image = $request->image->storeAs('products', $imageName, 'public');
        }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully');
    }
}
