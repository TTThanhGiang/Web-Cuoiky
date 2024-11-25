<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Mail\ForgotPasswordMail;
use App\Mail\VerifyAccount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function formLogin(){
        return view('web.auth.login');
    }

    public function login(LoginRequest $request){
        $params = $request->validated();
        $result = Auth::attempt($params);
        if ($result) {
            if (Auth::user()->email_verified_at == null || Auth::user()->status != 1) {
                Auth::logout();
                $errorMessage = 'Your account is not verified or not active, please check your email again.';
                return redirect()->back()->with('error', $errorMessage);
            }

            // $redirectRoute = (Auth::user()->role_id == 1) 
            //     ? 'admin.User.index'
            //     : 'home.index';   
            $redirectRoute = 'home.index';
            return redirect()->route($redirectRoute)->with('success','Login successful!');
        }

        return redirect()->back()->with('error', 'Invalid account.');
    }

    public function formRegister(){
        return view('web.auth.register');
    }

    public function register(RegisterRequest $request){
        $params = $request->validated();
        $params['role_id'] = 2;
        $result = User::create($params);
        if($result){
            try {
                Mail::to($result->email)->send(new VerifyAccount($result));
            } catch (\Exception $e) {
                $result->delete();
                return redirect(-back()->with('error', 'Unable to send verification email. Please try again.'));
            }
            return redirect()->route('login')->with('success', 'Register successfully, please check your email to verify account!');
        }   
        return redirect(-back()->with('error','Something error, please try again!'));
        
    }

    public function verify($email){
        $user = User::where('email', $email)
                    ->whereNull('email_verified_at')
                    ->firstOrFail();
        $user->update(['email_verified_at'=>  now()]);
        return redirect()->route('login')->with('verified', 'You have successfully verified your email. Please log in!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully');
    }

    public function profile(){
        return view('web.auth.profile');
    }

    public function checkProfile(){
        
    }

    public function formForgotPassword(){
        return view('web.auth.forgot-password');
    }

    public function forgotPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $code = sprintf('%05d', rand(0, 99999));

        Session::put('password_reset_code', $code);

        $user = User::where('email', $request->email)->firstOrFail();
        if($user){
            try {
                Mail::to($user->email)->send(new ForgotPasswordMail($user, $code));
            } catch (\Exception $e) {
                return redirect(-back()->with('error', 'Unable to send verification email. Please try again.'));
            }
            Session::put('email_reset', $user->email);
            return redirect()->route('resetPassword')->with("success", 'The confirmation code has been sent to your email!');
        }
        return redirect()->back()->with('error','Email not found.');

    }

    public function formResetPassword(){
        return view('web.auth.reset-password');
    }

    public function resetPassword(ResetPasswordRequest $request){
        $request->validated();
        $sessionCode = Session::get('password_reset_code');
        $sessionEmail= Session::get('email_reset');
        if($request->code == $sessionCode){
            $user = User::where('email', $sessionEmail)->firstOrFail();
            $user->password = $request->password;
            $user->save();
            Session::forget('password_reset_code');
            return redirect()->route('login')->with('success', 'Password changed successfully, Login now');
        }
        return redirect()->back()->with('error','Something error, please try again!');
    }


    public function orders(){
        $orders = Order::where('user_id', Auth::id())->get();
        return view('web.auth.orders', compact('orders'));
    }

    public function viewOrder($orderId){
        $order = Order::where('id', $orderId)
                    ->where('user_id', Auth::id())
                    ->first();
        $orderItems = OrderItem::where('order_id', $orderId)->get();

        return view('web.auth.view_order', compact('order','orderItems'));

    }
    
    public function updateStatus(Request $request){
        $order = Order::findOrFail($request->id);

        if($order->delivery_status == 'pending'){
            $order->delivery_status = 'delivered';
            $order->payment_status = 'paid';
            $order->completed_at = now();
            $order->save();
            return redirect()->back()->with('success', 'Order status updated to Received!');
        }
        return redirect()->back()->with('error', 'Unable to update order status.');

    }
}
