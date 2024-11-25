<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(){
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
                
        return view('web.checkout', compact('cartItems', 'totalPrice'));
    }

    public function order(Request $request){
        $person = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:11',
        ]);

        $cart = Cart::where('user_id', Auth::id())->first(); //Auth::id()
        $cartItems = CartItem::where('cart_id', $cart->id)
                        ->with('product')
                        ->get();

        $totalPrice = $cartItems->sum(function ($item) {
                return $item->quantity * $item->price;
        });
        $shipping = ($totalPrice> 100) ? 0 : 3;
        $finalTotal = $totalPrice + $shipping;
        try {
            DB::beginTransaction();
            $order = Order::create([
                'user_id' => Auth::id(),
                'name' => $person['name'],
                'email' => $person['email'],
                'address' => $person['address'],
                'phone' => $person['phone'],
                'total_price' => $finalTotal,
                'payment_status' => 'pending',
                'delivery_status' => 'pending',     
            ]);
    
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
            CartItem::where('cart_id', $cart->id)->delete();
            DB::commit();

            Session::put('current_order', $order);
            
            return redirect()->route('checkout.paymentView')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create order. Please try again.');
        }
    
    }


    public function paymentView(){
        $currentOrder = Session::get('current_order');
        $orderItems = OrderItem::where('order_id', $currentOrder->id)
                        ->with('product')
                        ->get();
        return view('web.payment_option', compact('orderItems','currentOrder'));
    }
}
