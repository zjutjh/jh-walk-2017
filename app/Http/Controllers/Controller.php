<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Model\MainModel;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function abort($code,$msg=null)
    {

        $message = "";
        if ($msg == null) {

            switch ($code) {
                case 400:$message = "错误的输入";break;
                case 401:$message = "未认证";break;
                case 403:$message = "无此权限";break;
                case 404:$message = "请求的资源不存在";break;
                default: $code=400; $message = "未知错误"; break;
            }
            return $this->apiResponse($code,$message);
        }
        return $this->apiResponse($code,$msg);

    }
    public function apiResponse($code,$msg,$data=array()){
        $content = json_encode(array("code"=>$code,"message"=>$msg,"data"=>$data));
        return response($content,$code);

    }



}
