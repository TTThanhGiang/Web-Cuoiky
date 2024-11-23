<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AddToCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(AddToCartRequest $request)
    {
        $request->validated();
        $userId = auth()->id();
        //$userId = 15;
        if(!$userId){
            return redirect()->back()->with('error', 'Please log in before adding to cart !');
        }
        
        $cart = Cart::firstOrCreate(
            ['user_id' => $userId]
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_id', $request->product_id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $product = Product::find($request->product_id);
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price
            ]);
        }

        return redirect()->route('cart.view')->with('success', 'Product added to cart!');
    }

    public function viewCart()
    { 
        $cart = Cart::where('user_id', Auth::id())->first(); //Auth::id()
        if (!$cart) {
            return view('web.cart')->with('message', 'Your cart is empty!');
        }

        $cartItems = CartItem::where('cart_id', $cart->id)
                        ->with('product')
                        ->get();

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });
                
        return view('web.cart', compact('cartItems', 'totalPrice'));
    } 


    public function update(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id',
            'action' => 'required|in:increase,decrease,remove',
        ]);


        $cartItem = CartItem::find($request->cart_item_id);

        if (!$cartItem) {
            return redirect()->back()->withErrors(['error' => 'Cart item not found.']);
        }
        if ($request->action === 'increase') {
            $cartItem->quantity += 1;
        } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
        } elseif ($request->action === 'remove') {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item removed from cart.');
        } else {
            $cartItem->delete();
            return redirect()->back()->with('success', 'Item removed from cart.');
        }
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }
}