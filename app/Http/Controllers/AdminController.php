<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2016/9/18
 * Time: 13:39
 */
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Model\GroupModel;
use App\Model\MainModel;
use App\Model\UserModel;
use Illuminate\Http\Request;
use Excel;

class AdminController extends Controller{
        public function adminIndex(Request $request){
                if($request->session()->has('login_pid')){
                        return view("errors.no_admin_err",['err_msg'=>'登录过期']);
                }
                $pid=$request->session()->get('login_pid');
                if(!UserModel::get_admin_byPid($pid)){
                        return view("errors.no_admin_err",['err_msg'=>'您没有权限']);
                }
                $now_group=GroupModel::get_groupCount();
                $now_join=UserModel::get_joined_count();

                return view("admin.index_admin",['nGroup'=>$now_group,'nJoin'=>$now_join]);

        }
        public function output_excel(Request $request){
                if($request->session()->has('login_pid')){
                        return view("errors.no_admin_err",['err_msg'=>'登录过期']);
                }
                $pid=$request->session()->get('login_pid');
                if(!UserModel::get_admin_byPid($pid)){
                        return view("errors.no_admin_err",['err_msg'=>'您没有权限']);
                }
                $yx=MainModel::Get_num_yx();

                Excel::create('第'.$yx.'届精弘毅行报名数据',function($excel){

                        $excel->setTitle('毅行数据');
                        $excel->setCreator('浙江工业大学精弘网络');
                        $excel->sheet('报名数据',function($sheet){
                                $uInfo=GroupModel::get_all_groupMemberInfo();
                                $sheet->with($uInfo);
                        });
                })->download('xls');
        }
}