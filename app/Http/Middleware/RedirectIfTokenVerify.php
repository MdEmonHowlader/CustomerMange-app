<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class RedirectIfTokenVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle( Request $request, Closure $next ): Response{
        $token = $request->cookie( 'token' );
        $verify = JWT_TOKEN::verify_token( $token );

        if ( $token && $verify != 'unauthorized' ) {
            return redirect()->route( 'dashboard' ); // Replace 'dashboard' with your desired authenticated route
        } else {
            return $next( $request );
        }
    }
}
