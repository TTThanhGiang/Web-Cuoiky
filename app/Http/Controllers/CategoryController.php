<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $categoryId = $request->get('category_id', $categories->first()->id);

        $category = Category::with('products')->findOrFail($categoryId);
        $products = $category->products()->paginate(6);

        return view('web/category', compact('categories', 'category', 'products'));
    }


}
