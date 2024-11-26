<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $childView = 'management-product';
        $view = 'products';
        return view('admin.product.index', compact('childView','view','product'));
    }

    public function create()
    {
        $childView = 'create';
        $view = 'products';
        return view('admin.product.create', compact('childView','view'));
    }

    public function update()
    {
        return view('admin.category.create');
    }

    public function delete()
    {
        return view('admin.category.create');
    }
}
