<?php
/**
 * Created by PhpStorm.
 * User: Louisian
 * Date: 2016/3/7
 * Time: 14:03
 */
namespace App\Model;
use Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Model\MainModel;
use Mockery\CountValidator\Exception;

class UserModel extends Model{

    protected $table="user_info";
    protected $guarded = ['id','created_id','updated_at'];
    public static function checkAccount($pid,$ltype){//当一个用户登录，查找数据库是否有数据
        $user=UserModel::where('uid',$pid)->get();
        $user_c=UserModel::where('uid',$pid)->count();
        //var_dump($user);
        $section=MainModel::Get_num_yx();
       // var_dump($user);
        //var_dump($user);
        if($user_c==0){
            if($ltype==0){
                $ltype="user";
            }else{
                $ltype="qq";
            }

            $user_create=UserModel::create(['uid'=>$pid,'apply'=>0,'iscome'=>0,'gid'=>-1,'section'=>$section,'ltype'=>$ltype]);
            return -1;
        }
        if($user[0]->name==""||$user[0]->phone=""||$user[0]->startarea==""){
            return -1;
        }
            return 1;

    }
    public static function get_phone_byPid($pid){
        $user=UserModel::where('uid',$pid)->first();
        return $user->phone;
    }
    public static function get_admin_byPid($pid){
        $user=UserModel::where('uid',$pid)->first();
        if($user->admin!=1){
            return false;
        }
        return true;
    }
    public static function get_user_info_byPid($pid){
        $user=UserModel::where('uid',$pid)->first();
        return $user;
    }
    public static function get_joined_count(){
        $section=MainModel::Get_num_yx();
        $result=UserModel::whereRaw('section=? and gid>0 and apply=1',[$section])->count();
        return $result;
    }
    public static function get_user_now_type($pid){//获得用户现在的状态
        $user=UserModel::where('uid',$pid)->get();
        $apply=$user[0]->apply;
        $group=$user[0]->gid;
        $leader=$user[0]->gleader;
        $section_now=MainModel::Get_num_yx();
        $section=$user[0]->section;
        if($section_now!=$section){
            return 1;
        }
        if($apply==0&&$group==-1)return 1;//未组队状态
        if($apply==0&&$group>0)return 2;//组队审核状态
        if($apply==1&&$group>0&&$leader!=$pid)return 3;//队员状态
        if($apply==1&&$group>0&&$leader==$pid)return 4;//队长状态
    }
    public static function get_now_num($gid){
        $now_num=UserModel::whereRaw("gid=? and apply=1",[$gid])->count();
        return $now_num;
    }
    public static function update_idcard($pid,$idcard){
        $idcardmd5=md5($idcard);
        $user=UserModel::where('uid',$pid)->first();
        $user->idcard=$idcardmd5;
        $user->save();
    }
    public static function get_pre_num($gid){
        global $gid_t;
        $gid_t=$gid;
        $pre_num=UserModel::where(function($query){
            $query->where('gid',$GLOBALS['gid_t'])
                ->where('apply',0);
        })->count();
        return $pre_num;
    }
    public static function get_user_gid($pid){
        $user=UserModel::where('uid',$pid)->get();
        return $user[0]->gid;
    }
    public static function get_canshow_user_info($pid){//获得一个用户可以直接修改和显示的数据 name sex area startarea phone qq
        $user=UserModel::where('uid',$pid)->get();
        $user=$user[0];
        //todo 重写
        if($user!=NULL){
            $userarray['name']=$user->name;
            $userarray['sex']=$user->sex;
            $userarray['area']=$user->area;
            $userarray['startarea']=$user->startarea;
            $userarray['phone']=$user->phone;
            $userarray['qq']=$user->qq;
            $userarray['ltype']=$user->ltype;
        }else {
            $userarray['name'] = "";
            $userarray['sex'] = "";
            $userarray['area'] ="";
            $userarray['startarea'] = "";
            $userarray['phone'] = "";
            $userarray['qq'] = "";
            $userarray['ltype'] ="";
        }
        return $userarray;
    }
    public static function update_user_info($pid,$name,$sex,$area,$startarea,$phone,$qq){
        $user=UserModel::where("uid",$pid)->get();
        $user=$user[0];
        $user->name=$name;
        $user->sex=$sex;
        $user->area=$area;
        $user->startarea=$startarea;
        $user->phone=$phone;
        $user->qq=$qq;
       if($user->save()){
           return 1;
       }else{
           return -1;
       }
    }

    public static function get_memberCount(){

        $section=MainModel::Get_num_yx();
        $u_count=UserModel::whereRaw("section=? and gid>0 and apply=1",[$section])->count();
        return $u_count;
    }
    public static function update_group_info($pid,$gleader,$gid,$apply){
        $user_info=UserModel::where('uid',$pid)->get();
        $user_info[0]->gid=$gid;
        if($gleader!="Unchange"){$user_info[0]->gleader=$gleader;}
        $user_info[0]->apply=$apply;
        $user_info[0]->section=MainModel::Get_num_yx();
        $user_info[0]->save();
    }
    public static function dismiss_allGroupMember($gid){//解散所有组员
        UserModel::where('gid',$gid)->update(['apply'=>0,'gleader'=>'','gid'=>-1]);
        return 1;
    }

    public static function check_account_idcard($pid){//判断是否把信息填写完全
        $user=UserModel::where('uid',$pid)->get();
        $idcard=$user[0]->idcard;
        if($idcard==null){
            return -1;
        }
        return 1;
    }
    public static function get_allMemberInfo_byGid($gid){


        $userarray['applied']=UserModel::whereRaw("gid=? and apply=1",[$gid])->get();

        $userarray['unapplied']=UserModel::whereRaw("gid=? and apply=0",[$gid])->get();

        return $userarray;
    }

}
