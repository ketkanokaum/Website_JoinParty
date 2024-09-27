<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckAdmin
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

        if (!Auth::check()) { // ตรวจสอบการเข้าสู่ระบบ
            return redirect()->route('error');
        }

        // ตรวจสอบว่าผู้ใช้เป็นแอดมิน
        if (Auth::user()->usertype === 'admin') {
            return $next($request);
        }

        return redirect()->route('error');
    }
}

