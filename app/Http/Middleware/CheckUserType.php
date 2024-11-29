<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckUserType
{
    public function handle(Request $request, Closure $next, $type)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->user_type == $type) {
                return $next($request);
            }
        } else {
        }

        return redirect('/');
    }
}
