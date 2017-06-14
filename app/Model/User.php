<?php
/**
 * Created by PhpStorm.
 * User: Louisian
 * Date: 2016/3/6
 * Time: 16:50
 */
namespace App\Model;
use Cache;
use Carbon\Carbon;
class User{
    public static function login($username,$password){//通过精弘api登录

        if(!isset($_SESSION['login_pid'])){
            $url_ex="http://api.jh.zjut.edu.cn/jhapi.php?url=";
            $url=$url_ex.urlencode("http://user.zjut.com/api.php?app=passport&action=login&passport=".$username."&password=".$password);
            $msg=file_get_contents($url);
            $infrom=json_decode($msg,true);

            if($infrom['state']=="success"){
                $_SESSION['login_pid']=$infrom['data']['pid'];
                $_SESSION['login_type']=0;
                return 1;
            }else{
                return -1;
            }

        }
        return 1;

    }
    public static function qq_login_token($code){//通过qq登录
        //todo 需要重构 想通过微信登录
        $qqcon=self::get_qq_config();
        $url="https://graph.qq.com/oauth2.0/token?client_id={$qqcon['appid']}&client_secret={$qqcon['appkey']}&redirect_uri={$qqcon['redirect_uri']}&grant_type=authorization_code&code={$code}";
        $msg=file_get_contents($url);
        $inform=explode("&",$msg);
        $acc=explode('=',$inform[0]);

        return $acc[1];


    }
    public static function qq_login_openid($access_token){
        $qqcon=self::get_qq_config();
        $url="https://graph.qq.com/oauth2.0/me?access_token={$access_token}";
        $msg=file_get_contents($url);
        if (preg_match('/\"openid\":\"(\w+)\"/i', $msg, $match)) {
            $openid = $match[1];
        }

        return $openid;
    }
    public static function qq_login($openid){
        $_SESSION['login_pid']=$openid;
        $_SESSION['login_type']=1;
        return 1;
    }
    public static function get_qq_config(){
        $qqcon=require(config_path()."/qqconnect.php");

        return $qqcon;
    }
    public static function check_outdate(){
        if(!isset($_SESSION['login_pid'])){
            return -1;
        }
        $pid=$_SESSION['login_pid'];
        return $pid;

    }
    public static function logout(){
        unset($_SESSION['login_pid']);
        unset($_SESSION['login_type']);
        if(!isset($_SESSION['login_pid'])){
            return 1;
        }else{
            return -1;
        }

    }

}
