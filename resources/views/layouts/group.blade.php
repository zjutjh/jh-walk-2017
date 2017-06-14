@extends('layouts.master')
@section('title','我的毅行')
@section('color','light-blue accent-2')
@section('myyx_active','active')
@section('style_os')
    <style type="text/css">
        .parallax-container {
            height: 750px;
        }
        #statnow{
            opacity: 0.9;
        }
    </style>
    @yield('style_os2')
@endsection
@section('jscript_os')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#logout").click(function(){
                var vm= new Vue({
                    el:"body",
                    ready:function(){
                        this.$http.post("./mywalk/logout").then(function(response){
                            alert('登出成功')
                            window.location.href="<?php echo url("/mywalk")?>"
                        },function(response){
                            alert(response.data.message)
                        })
                    }
                });
            })
            $("#chg_info").click(function(){
                window.location.href="<?php echo url("/mywalk/account")?>"
            })
            $("#chg_idcard").click(function(){
                window.location.href="<?php echo url("/mywalk/idcard")?>"
            })

        })

    </script>
    @yield('jscript_os2')
@endsection
@section('content')


    <div class="parallax-container">
        <div class="parallax">

            <img src="../img/bg1.JPG" class="blur">
        </div>
        <div class="section no-pad-bot">
            <div class="container">
                <br/>
                <br/>
                <br/>

                <div class="card transparent hoverable">
                    <div class="card-content black-text">
                        <h5 style="text-align: center">第九届精弘毅行时间：10月22日</h5>
                        <!--<div class="alert-error alert"><h2>报名已经截止</h2></div>	-->
                        1、毅行精神强调“团结协作、勇攀高峰”，报名时请组队报名。<br/>
                        2、以组队形式全部队员完成全部行程的发放毅行团队纪念书，其余完成全程的发放毅行个人纪念书。<br/>
                        3、毅行纪念书上的姓名将与报名时的姓名一致，请务必在报名截止前确定自己录入的信息无误。<br/>

                        请注意下列事项:<br/>
                        1、<a class=" red-text text-lighten-1 ">必须</a>在报名期间内按照相应的方式报名，<a class=" red-text text-lighten-1  ">不得在当天早上临时参与或组队，不得增减、调换队员</a>，毅行当天使用<a class=" red-text text-lighten-1  ">第二代居民身份证</a>在出发点进行身份验证，并领取打卡单等物资。
                        <br/>2、本次毅行采用<a class=" red-text text-lighten-1  ">实名制</a>，不是实名的请修改自己的信息，否则您的报名信息将<a class=" red-text text-lighten-1  ">自动作废</a><br/>
                        3、报名时请尽量确保都能参与，<a class=" red-text text-lighten-1  ">报名截止后毅行主办方依据报名信息统一打印打卡单</a>，出发当天工作人员在所到参与者姓名后盖章确认方为有效，并加盖组队完成章。
                    </div>
                </div>
                <div class="card-panel cyan" id="statnow">
          <span class="white-text">
            您现在的状态是:{{$msg}}
          </span>
                </div>
            </div>
        </div>

    </div>
    <div class="section white">
        <div class="container">	<!-- <div style="margin-right: auto; margin-left: auto; width:800px;">		 -->
            @yield('section_white')
        </div>
    </div>

    <div class="parallax-container">
        <div class="parallax">

            <img src="../img/bg2.jpg" class="blur">
        </div>
    </div>
    <div class="fixed-action-btn click-to-toggle" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red">
            <i class="  icon-reorder icon-large tooltipped" data-position="left" data-delay="50" data-tooltip="更多选项"></i>
        </a>
        <ul>
            <li><a href="javascript:void(0)" id="logout" class="btn-floating red tooltipped" data-position="left" data-delay="50" data-tooltip="登出"><i class="icon-off"></i></a></li>
            <li><a href="javascript:void(0)" id="chg_info" class="btn-floating green tooltipped" data-position="left" data-delay="50" data-tooltip="修改个人信息"><i class="icon-pencil"></i></a></li>
            <li><a href="javascript:void(0)" id="chg_idcard" class="btn-floating yellow darken-1 tooltipped" data-position="left" data-delay="50" data-tooltip="修改身份验证信息(身份证号)"><i class="icon-book"></i></a></li>
        </ul>
    </div>
@endsection
