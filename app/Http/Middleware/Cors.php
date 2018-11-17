<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /* @var $response Response */
        
        if($request->getMethod() == "OPTIONS") {
            $headers = [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET,POST,OPTION,PUT,DELETE',
                'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept',
            ];
        }else{

            $headers = [
                'Access-Control-Allow-Origin' => '*',
            ];
        }

        $response = $next($request);
        return $response->withHeaders($headers);
    }
}