<?php
/**
 * Created by PhpStorm.
 * User: louyq
 * Date: 2017/6/16
 * Time: 11:16
 */
namespace App\Http\Middleware;
use Closure;
class LoginAuth{
    public function handle($request, Closure $next, $guard = null){
        if(!isset($_SESSION['login_pid'])){
            return response('没有登录！',401);
        }
        return $next($request);
    }
}