@extends('layouts.master')
@section('title','我的毅行')
@section('color','light-blue accent-2')
@section('myyx_active','active')
@section('content')
    <div class="parallax-container">

        <div class="parallax"> <img src="../img/bg2.jpg" class="blur"></div>
        <div class="section no-pad-bot">
            <div class="container">
                <div class="colockbox" id="countd" class="white-text" style="font-size:70px" align="center">
                    <h2 class="black-text">距本次毅行开始还有</h2>
                    <span class="day  deep-purple-text text-lighten-3">-</span>
                    <span style="font-size:35px" class="deep-purple-text text-lighten-3">天</span>
                    <span class="hour indigo-text text-lighten-3">-</span>
                    <span style="font-size:35px" class="indigo-text text-lighten-3">时</span>
                    <span class="minute blue-text text-lighten-3">-</span>
                    <span style="font-size:35px" class="blue-text text-lighten-3">分</span>

                </div>
            </div>
        </div>
    </div>
    <div class="section white container" id="swa">
        <div class="row">

            <div class="col m12 l12 s12 " >
            <div class="row">
                <div class="col m8" >
                    <div class="card yellow lighten-5 hoverable">
                        <div class="card-content black-text">
                                <h5 style="text-align: center">第九届精弘毅行时间：10月22日</h5>
                            <h3 >风险告知与免责声明</h3>

                            【风险告知】<hr>
                            毅行活动中，你可能面临如下危险：中暑、水泡、抽筋、崴脚、抢劫、车祸等。提醒如下：<br>
                            1、关注活动期间的天气情况，做好防晒、防雨的准备。<br>
                            2、一切听从组织的安排，以小组为单位参加活动，安全优先，遵守活动纪律。<br>
                            3、提前学习如何避免和处理运动损伤，如水泡、抽筋、崴脚等。<br>
                            4、偏僻路段多人结伴同行，勿落单。<br>
                            5、心血管、脑血管、高血压、低血糖、关节炎等有身体健康问题或有突发病史者，不适宜强烈运动。<hr>
                            【免责声明】<hr>
                            1、本活动是非商业性的长距离登山徒步自发群体活动，有一定的风险，参加者应根据自身的状况作出是否参加活动的决定，并应对自己的安全负完全责任。未成年人必须经监护人同意并由其监护人陪同参加。<br>
                            2、活动参与者保证已熟知并同意本次活动的所有行程与活动安排，充分了解毅行活动的潜在风险，愿意独立承担本次活动中可能发生的人身或财产损害；<br>
                            3、活动参与者在活动过程中将根据自身身体状况，独立判断行动风险以保障自身人身和财产安全，不受任何活动参加者及其他成员的影响，并有权随时中途退出活动；<br>
                            4、参加活动往返交通途中和活动中如果发生意外事故，组织者会尽能力范围内组织救援，但对于事故造成的身体损害，乃至不可逆转的永久性身体损伤、后遗症等，以及事件伴随的经济损失，活动组织者不承担任何法律和经济责任。
                            5、本活动参与者须严格遵守活动规则与报名流程，未报名者不可临时参与。如强行参与，一切后果自行承担。<br>
                            6、一旦报名，即视为参加者（包括代他人报名者，被代报名参加者）已经充分了解并自愿接受本免责条款，本免责条款自动生效。否则，请勿报名参加，已报名的参加者请在活动开始前退出本次活动。<br>
                            7、本条款同样适用于活动各环节义工人员。<br>


                        </div>
                        <div class="card-action">
                            在校师生、校友请通过学号或工号进行登录，社会人士请使用QQ登录，请务必遵照真实情况选择登录方式，若无账号请点击注册激活您的通行证，若无法登录请联系客服QQ：642850671。</div>
                    </div>
                </div>
                <div class="col m4" id="logx"  style="">
                    <h4>登录</h4>
                    <br/>
                    <div class="checkbox">
                        <p>
                            <input type="checkbox" id="mzbox" value="mz" >
                            <label for="mzbox">我已阅读左方免责单并同意该免责单</label>
                        </p>

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <ul class="tabs ">
                                <li class="tab col s6"><a class="active" href="#login_passport_tab">通行证登录</a></li>
                                <li class="tab col s6 disabled" id="qq_tab"><a  href="#login_qq_tab">QQ登录</a></li>
                            </ul>
                        </div>
                        <div id="login_passport_tab" class="col s12">
                                <div class="input-field">
                                    <label for="username">学号</label>
                                    <input type="text"  class="validate" id="username" name="username" >
                                </div>

                                <div class="input-field">
                                    <label for="password">密码(此为通行证密码)</label>
                                    <input class="validate" type="password" id="password" name="password" >
                                </div>

                                <div class="row flexr">
                                    <div class="col s5 m5 "><a id="login_passport"  class="waves-effect waves-light btn disabled deep-purple lighten-2" >登录</a></div>
                                    <div class="col s3 m3 center-c"><a class="center-a" href="http://center.craim.net/register?redirect_url={{urlencode("http://walk.izjut.com/mywalk")}}" target="_blank">注册</a></div>
                                    <div class="col s4 m4 center-c"><a class="center-a" href="http://center.craim.net/password/reset?redirect_url={{urlencode("http://walk.izjut.com/mywalk")}}" target="_blank">找回密码</a></div>
                                </div>
                        </div>
                        <div id="login_qq_tab" class="col s12">
                            <iframe src="" id="qq-frame">

                            </iframe>

                        </div>

                    </div>
                    <div>

                        <br>


                        <br/>

                        {{--<div class="row">--}}
                            {{--<div class="col s4 m4"><a id="login_passport"  class="waves-effect waves-light btn-large disabled deep-purple lighten-2" >登录<i class=" icon-signin "></i></a></div>--}}
                            {{--<div class="col s4 m4"><a class="waves-effect waves-light btn-large " href="http://user.zjut.com/index.php?app=passport&action=active" target="_blank">注册<i class=" icon-edit"></i></a></div>--}}
                            {{--<div class="col s4 m4"> <a class="waves-effect waves-light btn-large disabled deep-purple lighten-2" id="login_qq" href ="javascript:void(0)" >QQ<i class=" icon-signin "></i></a></div>--}}
                        {{--</div>--}}


                    </div>
                    </div>

                </div>

            </div>
        </div>
        </div>
    </div>

    <div class="parallax-container">

        <div class="parallax"><img src="../img/bg1.JPG" class="blur"></div>

    </div>

@endsection
@section('hidden_content')
    <div id="modallogin" class="modal">
        <div class="modal-content">
            <h4>登录中...</h4>
            <p>正在提交验证，请稍等...</p>
            <div class="progress blue">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>
@endsection
@section('style_os')
    <style>
        #qq-frame{
            width: 450px;
            height: 400px;
            overflow: hidden;
           border: 0;

            margin-top: 20px;

        }
        h1,h2,h3,h4,h5{
            display: block;
            margin: 5px auto;
            text-align: center;
        }
        #login_passport{
            display: block;
        }
        .center-c{
            position: relative;
            text-align: center;

        }
        .center-a{
            position: absolute;
            display: block;
            top:50%;
            transform: translateY(-50%);
        }
        .flexr{
            display: flex;
        }
    </style>
    @endsection
@section('jscript_os')
    <script src="<?php echo url("/other/clock.js")?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#mzbox").click(function(){
                if  ($("#mzbox").prop('checked')==true){
                    $("#login_passport").removeClass("disabled");
                    $("#qq_tab").removeClass("disabled");

                }else{

                    $("#login_passport").addClass("disabled");
                    $("#qq_tab").addClass("disabled");
                }



            });
            $('#qq_tab').click(function(){
                if ($("#mzbox").prop('checked')==false){
                    alert('您还没有同意免责单')
                    return 0;
                }
                $("#qq-frame").attr("src","{{url("/qqconnect/oauth/index.php")}}");
//                $("#qq-frame").reload()
  //              childWindow = window.open("url("../")."/qqconnect/oauth/index.php" ","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1");
            });




            $("#login_passport").click(function(){
                if ($("#mzbox").prop('checked')==false){
                    alert('您还没有同意免责单')
                    return 0;
                }
                var username=$("#username").val()
                var password=$("#password").val()
//                $("#modallogin").openModal({
//                    dismissable:false
//                    })
                var loginBut=document.getElementById("login_passport");
                loginBut.setAttribute("disabled","")
                loginBut.innerText="登录中...."
               var vm= new Vue({
                    el:"body",
                    ready:function(){

                       this.$http.post("./mywalk/login/passport",{username:username,password:password}).then(function(response){
                           window.location.href="<?php echo url("/mywalk")?>"

                       },function(response){
                           $("#modallogin").closeModal();
                           loginBut.removeAttribute("disabled")
                           if(response.status==500){
                               alert("服务器错误")
                           }else{

                               alert(response.data.message)
                           }


                       })
                    }
               });
            });


        });
    </script>
@endsection