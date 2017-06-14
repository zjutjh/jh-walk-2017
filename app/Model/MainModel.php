<?php
/**
 * Created by PhpStorm.
 * User: Louisian
 * Date: 2016/3/7
 * Time: 14:38
 */
namespace App\Model;
use Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
class MainModel extends Model{
    protected $table="main_info";
    public static function Get_num_yx(){
        $value=MainModel::where('name','yx_num')->first();
        return $value->value;
    }
    public static function Get_webstate(){
        $value=MainModel::where('name','webstate')->first();
        return $value->value;
    }

}