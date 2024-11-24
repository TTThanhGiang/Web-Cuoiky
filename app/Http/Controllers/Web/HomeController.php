<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(){
        $latestProducts = Product::whereNull('deleted_at')
                            ->orderBy('created_at', 'desc')
                            ->take(8)
                            ->get();

        $outstandingProducts = Product::whereNull('deleted_at')
                            ->where('featured', 1)
                            ->take(8)
                            ->get();
        return view('web.index', compact('latestProducts','outstandingProducts'));
    }

    public function detail($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('web.detail', compact('product'));
    }

    public function category(Request $request, $id = null)
    {
        $perPage = $request->input('per_page', 6);

        if($id){
            $category = Category::findOrFail($id);
            $products = Product::where('category_id', $id)->paginate($perPage);
        }else{
            $category = null;
            $products = Product::paginate($perPage);
        }

        $categories = Category::withCount('products')->get();
        return view('web.category', compact('categories', 'category', 'products'));
    }


    public function viewBlogs(){
        return view('web.blog');
    }

    public function viewBlogDetail(){
        return view('web.blog_detail');
    }

    
}
