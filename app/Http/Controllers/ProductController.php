<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('web/category=')->with('error', 'Product not found');
        }
        return view('web/detail', compact('product'));
    }

    public function getProducts(Request $request)
    {
        $products = Product::paginate(8);
        return view('web/index', compact('products'));
    }
}
