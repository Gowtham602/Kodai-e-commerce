<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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
        ->paginate(8); // ✅ paginator

    return view('productuser.product', compact('categories', 'products'));
}


//filter and also the sort by price
public function filter(Request $request)
{
    $query = Product::with('category')
        ->where('is_active', 1);

    if ($request->filled('categories')) {
        $query->whereIn('category_id', $request->categories);
    }

    if ($request->sort === 'latest') {
        $query->latest();
    } elseif ($request->sort === 'price_low') {
        $query->orderBy('price', 'asc');
    } elseif ($request->sort === 'price_high') {
        $query->orderBy('price', 'desc');
    }

    $products = $query->paginate(8);

    return response()->json([
        'products' => $products->items(),
        'pagination' => (string) $products->links('pagination::bootstrap-5'),
    ]);
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
