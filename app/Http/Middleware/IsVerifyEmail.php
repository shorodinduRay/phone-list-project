<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsVerifyEmail
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
    
        // if (Auth::user()->is_email_verified == 0) {
        //     //auth()->logout();
        //     return redirect()->route('/phonelistUserLogin')
        //             ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        //   }
   
        // return $next($request);
        if(auth()->user()->is_email_verified == 1){
            return $next($request);
        }

        return redirect()->route('/phonelistUserLogin')
                    ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
    }
}
