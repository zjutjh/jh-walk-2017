<?php
/**
 * Created by PhpStorm.
 * User: Louisian
 * Date: 2016/3/6
 * Time: 12:45
 */
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GroupModel;
use App\Model\UserModel;
use App\Model\MainModel;
class IndexController extends Controller{
    public function get(Request $request){
        $webstate_msg=[
            0=>'报名已经结束，请下次再来哦',
            1=>'报名正在进行'
        ];
        $webstate_color=[
            0=>'red',
            1=>'green'
        ];
        $yx_n=MainModel::Get_num_yx();
        $u_count=UserModel::get_memberCount();
        $g_count=GroupModel::get_groupCount();
        $webstate=$webstate_msg[MainModel::Get_webstate()];
        $webstate_col=$webstate_color[MainModel::Get_webstate()];
        return view("index.index",['group'=>$g_count,'joinnum'=>$u_count,'state'=>$webstate,'statecolor'=>$webstate_col,'yxn'=>$yx_n]);

    }

}