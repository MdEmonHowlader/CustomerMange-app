<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyJwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( Request $request, Closure $next ): Response{
        $token = $request->cookie( 'token' );
        $verify = JWT_TOKEN::verify_token( $token );

        if ( 'unauthorized' == $verify ) {
            return redirect()->route( 'login' );
        } else {
            $request->headers->set( 'email', $verify->user_email );
            $request->headers->set( 'id', $verify->user_id );
            return $next( $request );
        }
    }
}
