<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;

class ProductController extends Controller
{
    public function index()
    {
        $image = Image::all();
        $products = Product::all();
        $childView = 'management-product';
        $view = 'products';
        return view('admin.product.index', compact('childView','view','products', 'image'));
    }

    public function create()
    {
        $categories = Category::all();
        $childView = 'management-product';
        $view = 'products';
        return view('admin.product.create', compact('childView','view', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'featured' => 'nullable|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'quantity' => $request->quantity,
            'featured' => $request->featured ?? false,
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = $file->getClientOriginalName();

            $destinationPath = public_path('assets/web/img/product');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $fileName);

            Image::create([
                'product_id' => $product->id,
                'file_name' => $fileName,
                'path' => 'web/img/product/' . $fileName,
            ]);
        }

        return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
    }



    public function edit($id)
    {
        $image = Image::where('product_id', $id)->first();
        $categories = Category::all();
        $product = Product::find($id);
        if (!$product) {
            abort(404, 'Category not found');
        }

        $childView = 'management-product';
        $view = 'product';

        return view('admin.product.edit', compact('childView','view','product', 'categories', 'image'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'featured' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'discount' => $request->input('discount', 0),
            'quantity' => $request->input('quantity'),
            'featured' => $request->input('featured', false),
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $fileName = $file->getClientOriginalName();

            $destinationPath = public_path('assets/web/img/product');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $fileName);

            Image::create([
                'product_id' => $product->id,
                'file_name' => $fileName,
                'path' => 'admin/web/product/' . $fileName,
            ]);
        }

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }



    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $image = Image::where('product_id', $product->id);

        if ($image) {
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully');
    }

    public function getProductImage($id)
    {
        $image = Image::where('product_id', $id)->first();
        if ($image) {
            return asset($image->path);
        }
        return asset('web/img/product/default-image.jpg');
    }
}
