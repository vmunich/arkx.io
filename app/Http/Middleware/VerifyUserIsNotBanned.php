<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyUserIsNotBanned
{
    /**
     * Determine if the authenticated user is banned.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param bool                     $notBanned
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->is_banned) {
            return $next($request);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
        }

        alert()->info('Your account has been locked. Please contact support.');

        auth()->logout();

        return redirect()->route('login');
    }
}
