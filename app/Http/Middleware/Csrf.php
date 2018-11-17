<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Cookie;

class Csrf
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
        $headers = [];

        if($this->isReading($request)) {
            $request->session()->regenerateToken();
            $headers['X-XSRF-TOKEN'] = csrf_token();
            $config = config('session');
            setcookie('XSRF-TOKEN', csrf_token(), time()+3600, $config['path'], $config['domain'], false, false);
        }else{
            if($this->tokensMatch($request)){
                $request->session()->regenerateToken();
                $headers['X-XSRF-TOKEN'] = csrf_token();
                $config = config('session');
                setcookie('XSRF-TOKEN', csrf_token(), time()+3600, $config['path'], $config['domain'], false, false);
            }else{
                header("Content-Type: application/json");
                header("HTTP/1.0 403 Forbidden");
                echo json_encode(["message" => "Invalid XSRF Token"]);
                die();
            }
        }

        $response = $next($request);
        return $response->withHeaders($headers);
    }

    /**
     * Determine if the session and input CSRF tokens match.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function tokensMatch($request)
    {
        $token = $this->getTokenFromRequest($request);

        return is_string($request->session()->token()) &&
               is_string($token) &&
               hash_equals($request->session()->token(), $token);
    }

    /**
     * Determine if the HTTP request uses a ‘read’ verb.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isReading($request)
    {
        return in_array($request->method(), ['HEAD', 'GET', 'OPTIONS']);
    }

    /**
     * Get the CSRF token from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function getTokenFromRequest($request)
    {
        $token = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');

        if (! $token && $header = $request->header('X-XSRF-TOKEN')) {
            $token = $header;
        }

        return $token;
    }

}
