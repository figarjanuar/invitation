<?php

namespace App\Http\Middleware;

use App\Models\UserList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Invited
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        UserList::where('unq_code', $request->route('code'))->firstOrFail();
        return $next($request);
    }
}
