<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    //  protect all admin product routes
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    //  LIST PRODUCTS
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(8);

        return view('admin.products.index', compact('products'));
    }

    //  SHOW CREATE FORM
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.products.create', compact('categories'));
    }

    //  STORE PRODUCT
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'name'        => 'required|string|max:255',
    //         'price'       => 'required|numeric',
    //         'weight'      => 'nullable|string|max:50',
    //         'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     ]);

    //     $product = new Product();
    //     $product->category_id = $request->category_id;
    //     $product->name = $request->name;
    //     $product->slug = Str::slug($request->name);
    //     $product->price = $request->price;
    //     $product->weight = $request->weight;
    //     $product->is_active = 1;

    //     // 📸 Image upload
    //     if ($request->hasFile('image')) {
    //         $product->image = $request->file('image')->store('products', 'public');
    //     }

    //     $product->save();

    //     return redirect()
    //         ->route('admin.products.index')
    //         ->with('success', 'Product added successfully');
    // }
    public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required|string|min:3|max:255',
        'price'       => 'required|numeric|min:1|max:100000',
        'weight'      => 'nullable|string|max:50',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ], [
        'category_id.required' => 'Please select a category',
        'name.required'        => 'Product name is required',
        'price.required'       => 'Price is required',
        'price.min'            => 'Price must be greater than 0',
        'image.mimes'          => 'Only JPG, PNG, WEBP images are allowed',
        'image.max'            => 'Image size must be less than 2MB',
    ]);

    $validated['slug'] = Str::slug($validated['name']);
    $validated['is_active'] = 1;

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')
            ->store('products', 'public');
    }

    Product::create($validated);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product added successfully');
}


    //  EDIT FORM
    public function edit(Product $product)
    {
        $categories = Category::where('is_active', 1)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    //  UPDATE PRODUCT
    // public function update(Request $request, Product $product)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'name'        => 'required|string|max:255',
    //         'price'       => 'required|numeric',
    //         'weight'      => 'nullable|string|max:50',
    //         'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     ]);

    //     $product->update([
    //         'category_id' => $request->category_id,
    //         'name'        => $request->name,
    //         'slug'        => Str::slug($request->name),
    //         'price'       => $request->price,
    //         'weight'      => $request->weight,
    //     ]);

    //     // replace image
    //     if ($request->hasFile('image')) {
    //         if ($product->image) {
    //             Storage::disk('public')->delete($product->image);
    //         }
    //         $product->image = $request->file('image')->store('products', 'public');
    //         $product->save();
    //     }

    //     return redirect()
    //         ->route('admin.products.index')
    //         ->with('success', 'Product updated successfully');
    // }
    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name'        => 'required|string|min:3|max:255',
        'price'       => 'required|numeric|min:1|max:100000',
        'weight'      => 'nullable|string|max:50',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
    ]);

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $validated['image'] = $request->file('image')
            ->store('products', 'public');
    }

    $validated['slug'] = Str::slug($validated['name']);

    $product->update($validated);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product updated successfully');
}


    //  DELETE PRODUCT
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }
       
 



}
