<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
function add_resource($url,$Controller){
    Route::get($url,"{$Controller}@get");
    Route::post($url,"{$Controller}@post");
    Route::put($url,"{$Controller}@put");
    Route::delete($url,"{$Controller}@delete");
}


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    add_resource('/index',"IndexController");
    add_resource('/mywalk',"MyyxController");
    add_resource('/rebackyx',"RebackyxController");
    Route::get('/admin',"AdminController@adminIndex");

    Route::post("mywalk/login/passport","MyyxController@login");
    Route::get("/mywalk/login/qq","MyyxController@qq_login");//登录

    Route::get("/admin/excel","AdminController@output_excel");


    Route::get("/mywalk/account","MyyxController@account");
//Route::get("mywalk/account","MyyxController@account");//修改个人信息页面

    Route::get("mywalk/idcard","MyyxController@show_idcard");
    Route::group(['middleware'=>['login']],function (){
        Route::put("mywalk/group/lock","MyyxController@lock_group");
        Route::delete("mywalk/group/member","MyyxController@kick_member");
        Route::post("mywalk/group/join","MyyxController@join_group");//加入组队
        Route::delete("mywalk/group/join","MyyxController@dejoin_group");//取回入队申请
        Route::get("mywalk/group/gif/{gid}","MyyxController@showaugroup");//创建、修改队伍信息页面
        Route::post("mywalk/group/gif/{gid}","MyyxController@au_group");//创建、修改队伍信息
        Route::delete("mywalk/group","MyyxController@dismiss_group");//解散队伍
        Route::post("mywalk/group/member/agree","MyyxController@agree_member");
        Route::delete("mywalk/group/member/agree","MyyxController@disagree_member");
        Route::post("mywalk/account","MyyxController@updaccount");//修改个人信息
        Route::post("mywalk/logout","MyyxController@logout");//登出
        Route::post("mywalk/idcard","MyyxController@change_idcard");
    });



    Route::post("mywalk/group/search","MyyxController@search_group");
    //
});
