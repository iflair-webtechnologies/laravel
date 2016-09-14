<?php

namespace Villato\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Admin
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo $this->auth->user()->email;exit;
        if ($this->auth->user()->email != env('ADMIN_USER', 'info@mediaversa.nl')) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('inloggen');
            }
        }

        return $next($request);
    }

}
