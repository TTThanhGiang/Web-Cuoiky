<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RedirectToAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu user không phải là admin (ID = 1)
        if (Auth::check() && Auth::id() !== 1) {
            return redirect('/chatify/1'); // Điều hướng tới trang chat với admin
        }
        if (Auth::check() && Auth::id() == 1) {
            return redirect('/chatify'); // Điều hướng tới trang chat với admin
        }

        return $next($request);
    }
}
