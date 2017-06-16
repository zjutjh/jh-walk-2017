<?php
/**
 * Created by PhpStorm.
 * User: louyq
 * Date: 2017/6/16
 * Time: 12:22
 */
namespace App\Http\Middleware;

use Closure;
class EnableCORS{
    public function handle($request, Closure $next){
        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'true');
        return $response;
    }
}