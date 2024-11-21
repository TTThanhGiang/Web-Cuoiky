<?php

namespace App\Http\Controllers\Amin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $categoryId = $request->get('category_id', $categories->first()->id);

        $category = Category::with('products')->findOrFail($categoryId);
        $products = $category->products()->paginate(6);

        return view('web.category', compact('categories', 'category', 'products'));
    }

    public function detail(){
        
    }


}
