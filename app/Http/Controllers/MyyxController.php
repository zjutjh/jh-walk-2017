<?php
/**
 * Created by PhpStorm.
 * User: Louisian
 * Date: 2016/3/6
 * Time: 12:51
 */
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\UserModel;
use App\Model\GroupModel;
use App\Model\MainModel;
use Illuminate\Pagination\PaginationServiceProvider;

function trimall($str)//删除空格
{
    $qian=array(" ","　","\t","\n","\r");
    $hou=array("","","","","");
    return str_replace($qian,$hou,$str);
}

class MyyxController extends Controller{

    public function get(){//显示


        if(!isset($_SESSION['login_pid'])){
            return view("myyx.login");
        }
        $pid=$_SESSION['login_pid'];
        $type=$_SESSION['login_type'];
        //var_dump($type);
       // var_dump($pid);
       // var_dump($_SESSION['login_pid']);
        if(UserModel::checkAccount($pid,$type)==-1){
           $userarray= UserModel::get_canshow_user_info($pid);
            return view("myyx.account",["userarray"=>$userarray]);
        }else{
            $type=UserModel::get_user_now_type($pid);
            $grouparray=GroupModel::get_allGroup();
            $idcheck=UserModel::check_account_idcard($pid);
            $user_info=UserModel::get_canshow_user_info($pid);
            $startarea=$user_info['startarea'];
            switch($type){
                case 1:
                    $msg="还没有报名,不能参加毅行,可以创建组队或是加入一个组队";

//                    if($grouparray->id==-1){
//                        $grouparray->id="N/A";
//                        $grouparray->leadername="N/A";
//                        $grouparray->description="N/A";
//                        $grouparray->startarea="N/A";
//                        $grouparray->max_num=0;
//                        $grouparray->now_num=0;
//                        $grouparray->pre_num=0;
//                    }



                    return view("myyx.group_ungrouped",["msg"=>$msg,"grouparray"=>$grouparray,"user_sa"=>$startarea,'idcheck'=>$idcheck]);
                    break;
                case 2:
                    $gid=UserModel::get_user_gid($pid);
                    $msg="尝试加入【".$gid."】，队长正在审核中，如审核通过则报名成功，未经队长许可不得退出";
                    return view("myyx.group_waiting",["msg"=>$msg,"grouparray"=>$grouparray,'idcheck'=>$idcheck,"user_sa"=>$startarea]);
                    break;
                case 3:
                    $gid=UserModel::get_user_gid($pid);
                    $member_info=GroupModel::get_allTeamMember_info($gid);
                    $leader_pid=GroupModel::get_leaderid_byGid($gid);
                   $leader_info=UserModel::get_canshow_user_info($leader_pid);
                    $msg="报名成功，成为【".$gid."】队伍的队员";
                    return view("myyx.group_grouped_member",["msg"=>$msg,"grouparray"=>$grouparray,'idcheck'=>$idcheck,"user_sa"=>$startarea,'member_info'=>$member_info,'leader_info'=>$leader_info]);
                    break;
                case 4:
                    $gid=UserModel::get_user_gid($pid);
                    $lockstate=GroupModel::get_lockState($gid);
                    $pre_num=GroupModel::get_canshow_info($gid);
                    $member_info=GroupModel::get_allTeamMember_info($gid);

                    $msg="报名成功，成为【".$gid."】队伍的队长";
                    GroupModel::get_allTeamMember_info($gid);
                    return view("myyx.group_grouped_leader",["msg"=>$msg,"grouparray"=>$grouparray,'idcheck'=>$idcheck,"user_sa"=>$startarea,"lockstate"=>$lockstate,"pre_num"=>$pre_num['pre_num'],'member_info'=>$member_info]);
                    break;
            }


        }

//        return view("myyx.group_ungrouped");

    }
    public function login(Request $request){

        $username=trimall($request->input('username'));
        $password=$request->input('password');

        if(User::login($username,$password)==1){
            return $this->apiResponse(200,"登录成功");
        }else{
            return $this->apiResponse(400,"用户名或密码错误");
        }
    }
    public function qq_login(Request $request){
        //echo 1;
        $code=$request->input('code');
        $state=$request->input('state');
        $acc_token=User::qq_login_token($code);
        $openid=User::qq_login_openid($acc_token);
        if(User::qq_login($openid)==1){
            return view('layouts.qq_do');
        }else{
            return $this->apiResponse(400,"登录失败");
        }


    }
    public function logout(){
        if(User::logout()==1){
            return $this->apiResponse(200,"登出成功");
        }
    }
    public function account(){//修改用户信息
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕
        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $userarray= UserModel::get_canshow_user_info($pid);
        return view("myyx.account",['userarray'=>$userarray]);
    }
    public function updaccount(Request $request){//更新用户信息
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕
        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }


        $name=$request->input('name');
        $sex=$request->input('sex');
        $area=$request->input('area');
        $startarea=$request->input('startarea');
        $phone=$request->input('phone');
        $qq=$request->input('qq');
        $mode=$request->input('mode');
        if($mode==1){
            if($name!=null&&$sex!=null&&$area!=null&&$startarea!=null&&$phone!=null&&$qq!=null){
                if(UserModel::update_user_info($pid,$name,$sex,$area,$startarea,$phone,$qq)==1){
                    return $this->apiResponse(200,"修改成功");
                }

            }
            return $this->apiResponse(400,"有错误，请重试");
        }else{
            $user=UserModel::get_canshow_user_info($pid);
            if($user['name']==null||$user['phone']==null){
                User::logout();
                $this->get();
            }else{
                $this->get();
            }

        }

    }
    public function showaugroup($gid_tag){//显示add_group页
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕
        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }

        if($gid_tag!=-1){
            $gid=UserModel::get_user_gid($pid);
            if(GroupModel::get_lockState($gid)!=1)return $this->apiResponse(400,"队伍没有锁定，不能修改信息");
        }
        if($gid_tag==-1){
            $ginfo['max_num']="";
            $ginfo['description']="";
            $ginfo['now_num']=2;
            return view('myyx.add_group',['g_msg'=>'创建一支队伍','group'=>$ginfo,'gid'=>-1]);
        }else{
            $ginfo=GroupModel::get_canshow_info($gid);
            return view('myyx.add_group',['g_msg'=>'修改队伍信息','group'=>$ginfo,'gid'=>$gid]);
        }
    }
    public function au_group($gid_tag,Request $request){//更新、新增队伍
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕
        $max_num=$request->input('max_num');
        if($max_num<2||$max_num>4){
            return $this->apiResponse(400,"队伍最大人数小于2或者大于4人");
        }
        $description=$request->input('description');
        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        if($gid_tag!=-1){
            $gid=UserModel::get_user_gid($pid);

        }else{
            $gid=$gid_tag;
        }

        $tag=GroupModel::au_group_info($pid,$gid,$max_num,$description);
        if( $tag==-1){
            $this->apiResponse(400,"您已创建了一个队伍");
        }
        return $this->apiResponse(200,"修改成功");

    }
    public function join_group(Request $request){//加入队伍
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕
        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=$request->input('gid');
        $g_tag=GroupModel::join_group($pid,$gid);
        if($g_tag==-1) return $this->apiResponse(400,"人数已满");
        if($g_tag==-2) return $this->apiResponse(400,"队伍已经锁定");
        return $this->apiResponse(200,"等待队长审核，同意后则报名成功");
    }
    public function dejoin_group(Request $request){//取回申请队伍
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕
        //检测完毕
        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=UserModel::get_user_gid($pid);
        GroupModel::dejoin_group($pid,$gid);
        return $this->apiResponse(200,"取回申请成功");
    }
    public function dismiss_group(Request $request){//解散队伍
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕

        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=UserModel::get_user_gid($pid);
        GroupModel::dismiss($gid);
        return $this->apiResponse(200,"解散队伍成功!");

    }
    public function lock_group(Request $request){
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕

        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=UserModel::get_user_gid($pid);
        $s_t=GroupModel::lock($gid);
        if($s_t==1) return $this->apiResponse(200,"锁定队伍成功!");
        if($s_t==0) return $this->apiResponse(200,"解锁队伍成功!");

    }
    public function kick_member(Request $request){
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕

        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=UserModel::get_user_gid($pid);
        $kick_pid=$request->input('kickpid');
        if($kick_pid==$pid){
            return $this->apiResponse(400,"队长不能踢出自己哦！");
        }
        GroupModel::kick($kick_pid,$gid);
        return $this->apiResponse(200,"踢出成功！");
    }
    public function agree_member(Request $request){
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕

        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=UserModel::get_user_gid($pid);
        $agree_pid=$request->input('agreepid');
        $g_tag=GroupModel::agree($agree_pid,$gid);
        if($g_tag==-1) return $this->apiResponse(400,"人数已满");
        if($g_tag==-2) return $this->apiResponse(400,"队伍已经锁定");
        return $this->apiResponse(200,"已经同意该队员加入");
    }
    public function disagree_member(Request $request){
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕

        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=UserModel::get_user_gid($pid);
        $disagree_pid=$request->input('disagreepid');
        GroupModel::disagree($disagree_pid,$gid);
        return $this->apiResponse(200,"已经不同意该队员加入");
    }
    public function change_idcard(Request $request){
        //检测报名是否结束
        $ws=MainModel::Get_webstate();

        if($ws==0){
            return $this->apiResponse(401,"报名已经结束!");
        }
        //检测完毕

        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $idcard=$request->input('idcard');
        UserModel::update_idcard($pid,$idcard);
        return $this->apiResponse(200,'修改成功！');
    }
    public function show_idcard(){
        return view("myyx.idcard");
    }
    public function search_group(Request $request){
        $pid=User::check_outdate();
        if($pid==-1){
            return $this->apiResponse(403,"登录过期，请刷新页面");
        }
        $gid=$request->input('sgid');
        if($gid==""){
            $g_info=GroupModel::get_allGroup();
        }else{
            $g_info=GroupModel::get_all_info($gid);
        }


        $idcheck=UserModel::check_account_idcard($pid);
        $user_info=UserModel::get_canshow_user_info($pid);
        $startarea=$user_info['startarea'];
        return view("myyx.table_group_list",["grouparray"=>$g_info,"user_sa"=>$startarea,'idcheck'=>$idcheck,'can_enter'=>1]);
    }

}