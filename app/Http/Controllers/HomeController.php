<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\VerifyAccount;
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

    public function details($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('web/=')->with('error', 'Product not found');
        }
        return view('web/detail', compact('product'));
    }


    
}
