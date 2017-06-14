<?php
/**
 * Created by PhpStorm.
 * User: Louisian
 * Date: 2016/3/6
 * Time: 21:36
 */
namespace App\Model;
use Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Model\MainModel;
class GroupModel extends Model{
    protected $table="group_info";
    protected $guarded=["created_at","updated_at","id"];
    public static function get_allGroup(){//获得所有组队信息
        $section=MainModel::Get_num_yx();
        $group_info=GroupModel::where('section',$section)->orderBy('id','desc')->paginate(20);
        if(is_null($group_info)){
            $group_info->id=-1;
            return $group_info;
        }
        return $group_info;
    }
    public static function get_leaderid_byGid($gid){//根据Gid查找队长pid
        $section=MainModel::Get_num_yx();
        $group=GroupModel::where('id',$gid)->orderBy('section','desc')->get();
        if(!is_null($group))return $group[0]->leaderid;
        return -1;
    }
    public static function get_all_info($gid){
        $group=GroupModel::where('id',$gid)->paginate(15);

        return $group;
    }
    public static function get_canshow_info($gid){//获得可以修改的数据
       $group=GroupModel::where('id',$gid)->orderBy('section','desc')->get();
        $ginfo['max_num']=$group[0]->max_num;
        $ginfo['description']=$group[0]->description;
        $now_num=$group[0]->now_num>2?$group[0]->now_num:2;
        $ginfo['now_num']=$now_num;
        $ginfo['pre_num']=$group[0]->pre_num;

        return $ginfo;
    }
    public static function get_allTeamMember_info($gid){
       $userarray= UserModel::get_allMemberInfo_byGid($gid);
        return $userarray;
    }
    public static function get_groupCount(){
        $yxn=MainModel::Get_num_yx();
        $g_count=GroupModel::where('section',$yxn)->count();
        return $g_count;
    }
    public static function au_group_info($pid,$gid,$max_num,$description){//更新或者创建一个队伍
        $lname=UserModel::get_canshow_user_info($pid);

        $section=MainModel::Get_num_yx();


        if($gid==-1){
            if(GroupModel::whereRaw('leaderid=? and section=?',[$pid,$section])->first()!=null){
                return -1;
            }
            $g_new= GroupModel::create(['max_num'=>$max_num,'description'=>$description,'now_num'=>1,'pre_num'=>0,'leaderid'=>$pid,'leadername'=>$lname['name'],'section'=>$section,'startarea'=>$lname['startarea'],'lock'=>0]);
            $gid_add=$g_new->id;
            UserModel::update_group_info($pid,$pid,$gid_add,1);
        }else{
            $g_info=GroupModel::where('id',$gid)->get();
            $g_info[0]->max_num=$max_num;
            $g_info[0]->description=$description;
            $g_info[0]->save();
        }
    }
    public static function join_group($pid,$gid){//加入一个队伍
        $gleader=GroupModel::get_leaderid_byGid($gid);

        $g_info=GroupModel::where('id',$gid)->get();
        if($g_info[0]->max_num<=$g_info[0]->now_num)return -1;
        if($g_info[0]->lock==1)return -2;
        UserModel::update_group_info($pid,$gleader,$gid,0);
        $g_info[0]->pre_num++;
        $g_info[0]->save();
        self::check_member_num($gid);

    }
    public static function dejoin_group($pid,$gid){//取回申请
        $gleader=GroupModel::get_leaderid_byGid($gid);
        $g_info=GroupModel::where('id',$gid)->get();
        $g_info[0]->pre_num--;
        $g_info[0]->save();
        UserModel::update_group_info($pid,$gleader,-1,0);
        self::check_member_num($gid);

    }
    public static function get_all_group_count(){
        $section=MainModel::Get_num_yx();
        $result=GroupModel::where('section',$section)->count();
        return $result;
    }
    public static function lock($gid){//锁定/解锁 队伍
        $group=GroupModel::where('id',$gid)->get();
        if($group[0]->lock==0){
            $group[0]->lock=1;
            $group[0]->save();
            return 1;
        }else{
            $group[0]->lock=0;
            $group[0]->save();
            return 0;
        }
    }
    public static function dismiss($gid){//解散组队
        $group=GroupModel::where('id',$gid)->get();
        $group[0]->delete();
        UserModel::dismiss_allGroupMember($gid);
        return 1;
    }
    public static function get_lockState($gid){//获得队伍是否锁定
        $group=GroupModel::where('id',$gid)->get();
        return $group[0]->lock;
    }
    public static function kick($pid,$gid){//踢出
        $group=GroupModel::where('id',$gid)->get();
        $group[0]->now_num--;
        $group[0]->save();
        UserModel::update_group_info($pid,"",-1,0);
        self::check_member_num($gid);
        return 1;
    }
    public static function agree($pid,$gid){//同意
        $group=GroupModel::where('id',$gid)->get();
        if($group[0]->max_num==$group[0]->now_num)return -1;
        if($group[0]->lock==1)return -2;
        $group[0]->now_num++;
        $group[0]->pre_num--;
        $group[0]->save();
        UserModel::update_group_info($pid,"Unchange",$gid,1);
        self::check_member_num($gid);
        return 1;
    }
    public static function disagree($pid,$gid){//不同意
        $group=GroupModel::where('id',$gid)->get();
        $group[0]->pre_num--;
        $group[0]->save();
        UserModel::update_group_info($pid,"",-1,0);
        self::check_member_num($gid);
        return 1;
    }
    public static function check_member_num($gid){
        $group_array=GroupModel::where('id',$gid)->get();
        $group=$group_array[0];
        $group->now_num=UserModel::get_now_num($gid);
        $group->pre_num=UserModel::get_pre_num($gid);
        $group->save();
        return 1;
    }
    public static function get_all_groupMemberInfo(){
        $section=MainModel::Get_num_yx();
       $groups= GroupModel::whereRaw('section=?',[$section])->get();
        $groups->toArray();
            foreach ($groups as $key=>$group){
                $groups_a[$key]['gid']=$group['id'];
                $groups_a[$key]['leader']=$group['leadername'];
                $groups_a[$key]['leaderphone']=UserModel::get_phone_byPid($group['leaderid']);
                for($i=0;$i<3;$i++){
                    $groups_a[$key]['member'.($i+1)]="";
                    $groups_a[$key]['phone'.($i+1)]="";
                }
                $num=UserModel::get_now_num($group['id']);
                $groups_a[$key]['num']=$num;
                $userInfo=UserModel::get_allMemberInfo_byGid($group['id']);

                $uInfo=$userInfo['applied'];
                $i_m=0;

                for($i=0;$i<$num;$i++){

                    if($uInfo[$i]['uid']==$uInfo[$i]['gleader']){
                        continue;
                    }else{
                        $i_m++;
                    }
                    $groups_a[$key]['member'.($i_m)]=$uInfo[$i]['name'];
                    $groups_a[$key]['phone'.($i_m)]=UserModel::get_phone_byPid($uInfo[$i]['uid']);

                }

            }

        return $groups_a;
    }
}
