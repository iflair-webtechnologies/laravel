<?php namespace Villato\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    protected $except = [
        'inloggen',
        'wachtwoord/email',
        'feedback',
        'registreren',
        'checkideal',
        'addproduct'

    ];
    public function handle($request, Closure $next)
    {
        //dd($next);exit;
        return parent::handle($request, $next);
    }

    

}
