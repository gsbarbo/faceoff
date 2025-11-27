<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessMiddleware
{
    public function handle(Request $request, Closure $next, string $check)
    {
        $user = $request->user();

        if (! $user) {
            abort(403);
        }

        if (! $user->canAccess($check)) {
            abort(403);
        }

        return $next($request);

    }
}
