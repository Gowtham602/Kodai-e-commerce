<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    // LIST
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // CREATE FORM
    public function create()
    {
        return view('admin.categories.create');
    }

    // STORE
 public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
    ]);

    Category::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'is_active' => 1,
    ]);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully'
        ]);
    }

    return redirect()
        ->route('admin.categories.index')
        ->with('success','Category added successfully');
}

    // EDIT
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // UPDATE
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'cat_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category updated successfully'
                ]);
            }
        if ($request->hasFile('cat_image')) {
            if ($category->cat_image) {
                Storage::disk('public')->delete($category->cat_image);
            }
            $category->cat_image = $request->file('cat_image')
                ->store('categories','public');
            $category->save();
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success','Category updated successfully');
    }

    // SOFT DELETE
   public function destroy(Category $category)
{
    $category->delete();

    // AJAX request → return JSON
    if (request()->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Category deleted'
        ]);
    }

    // Normal request fallback
    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category deleted');
}

}
