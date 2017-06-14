@extends('layouts.master')
@section('title','首页')
@section('color','amber darken-3')
@section('index_active','active')
@section('style_os')
    <style>
        .swiper-container {
            height:500px;
        }
        .swiper-slide .title {
            font-size: 41px;
            font-weight: 300;
        }
        .swiper-slide .subtitle {
            font-size: 21px;
            padding-left: 20px;
        }
        .swiper-slide .text {
            font-size: 18px;
            padding-left: 35px;
            max-width: 400px;
            line-height: 1.3;
        }
        .swiper-slide {
            font-size: 18px;
            color:#fff;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 40px 60px;
        }
        .swiper-container-pic {
            width: 500px;
            height: 300px;
            margin: 20px auto;
        }
        .swiper-container-pic .swiper-pagination-bullet {
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
            color:#000;
            opacity: 1;
            background: rgba(0,0,0,0.2);
        }
        .swiper-container-pic .swiper-pagination-bullet-active {
            color:#fff;
            background: #007aff;
        }
        .m-table{
            display: flex;

        }
        .center-text{

            position: relative;
            text-align: center;
            width: 100%;
            height: 300px;
           /*height: 100%;*/


        }
        .center-text div{
            position: absolute;

            left: 50%;
            top:50%;
            width: 80%;
            transform:translateX(-50%) translateY(-50%)

        }

    </style>
@endsection
@section('content')
    <div class="swiper-container">
        <div class="swiper-wrapper">
            {{--<div class="swiper-slide blue">--}}
                {{--<div class="title ani" swiper-animate-effect="bounceIn" swiper-animate-duration="0.5s">第{{$yxn}}届精弘毅行</div>--}}
                {{--<div class="subtitle  ani" swiper-animate-effect="slideInLeft"  swiper-animate-duration="0.5s" swiper-animate-delay="0.3s">{{$state}}</div>--}}
                {{--<div class="text"></div>--}}
            {{--</div>--}}
            {{--<div class="swiper-slide orange">--}}
                {{--<div class="title ani" swiper-animate-effect="bounceIn" swiper-animate-duration="0.5s">第{{$yxn}}届精弘毅行</div>--}}
                {{--<div class="subtitle  ani" swiper-animate-effect="slideInLeft"  swiper-animate-duration="0.5s" swiper-animate-delay="0.3s">报名情况</div>--}}
                {{--<div class="text ani" swiper-animate-effect="fadeInLeft"  swiper-animate-duration="0.5s" swiper-animate-delay="0.8s">--}}
                        {{--队伍总数:{{$group}}<br/>--}}
                        {{--已报名总人数:{{$joinnum}}--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="swiper-slide" style="background-image: url('../img/bg3.jpg');background-repeat: no-repeat;background-size: cover;">
                <div class="colockbox" id="countd" class="black-text" style="font-size:70px" align="center">
                    <h2 class="black-text">距第{{$yxn}}届毅行开始还有</h2>
                    <span class="day  deep-purple-text text-lighten-3">-</span>
                    <span style="font-size:35px" class="deep-purple-text text-lighten-3">天</span>
                    <span class="hour indigo-text text-lighten-3">-</span>
                    <span style="font-size:35px" class="indigo-text text-lighten-3">时</span>
                    <span class="minute blue-text text-lighten-3">-</span>
                    <span style="font-size:35px" class="blue-text text-lighten-3">分</span>

                </div>
                <div style="text-align: center">
                    <a class="waves-effect waves-light btn  grey lighten-2 black-text" href="{{url("/mywalk")}}">点我报名</a>
                    <h5 class="black-text">主办方:浙江工业大学精弘网络</h5>
                    <h5  class="black-text">协办方:杭州北风户外俱乐部</h5>
                </div>
            </div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>

        <!-- 如果需要导航按钮 -->
        {{--<div class="swiper-button-prev"></div>--}}
        {{--<div class="swiper-button-next"></div>--}}

        {{--<!-- 如果需要滚动条 -->--}}
        {{--<div class="swiper-scrollbar"></div>--}}
    </div>
<br/>
    <div class="container">
        {{--<div class="row">--}}
            {{--<div class="col s12 m12 l12 index-border">--}}
                {{--<h4 class="index-title">时光</h4>--}}
                {{--<div id="timeline">--}}
                    {{--<ul id="dates">--}}
                        {{--<li><a href="#2005">2005</a></li>--}}
                        {{--<li><a href="#2006">2006</a></li>--}}
                        {{--<li><a href="#2007">2007</a></li>--}}
                        {{--<li><a href="#2008">2008</a></li>--}}
                        {{--<li><a href="#2009">2009</a></li>--}}
                        {{--<li><a href="#2010">2010</a></li>--}}
                        {{--<li><a href="#2012">2012</a></li>--}}
                        {{--<li><a href="#2014">2014</a></li>--}}
                    {{--</ul>--}}
                    {{--<ul id="issues">--}}
                        {{--<li id="2005" style="background-image: url(../img/1.jpg)">--}}
                            {{--<h1>2005 闪亮登场</h1>--}}
                            {{--<p>2005年，呱呱坠地。界面清爽、功能俱全、操作简单易上手，是大家都喜爱的网络家园。出生不久，就有越来越多的朋友到我这里分享自己的生活。</p>--}}
                        {{--</li>--}}
                        {{--<li id="2006">--}}
                            {{--<h1>2006 扬帆起航</h1>--}}
                            {{--<p>2006年，咿呀学语。面对每天千万级的用户访问，技术GG帮我优化了架构，设计师MM帮我设计了欢迎动画等个性化装扮，“妈妈再也不担心我404了”！</p>--}}
                        {{--</li>--}}
                        {{--<li id="2007">--}}
                            {{--<h1>2007 内外兼修</h1>--}}
                            {{--<p>2007年，初长成。咱推出了信息中心和好友圈，开始向SNS社区转型；首创4.0全屏模式，更加美观大方。</p>--}}
                        {{--</li>--}}
                        {{--<li id="2008">--}}
                            {{--<h1>2008 厚积薄发</h1>--}}
                            {{--<p>2008年，十八变。当年推出的个人中心，正式标志着我从传统博客向SNS社区的转变，注册用户和分享量稳居国内第一；每天都有超多用户在我这里分享生活中的新鲜事。</p>--}}
                        {{--</li>--}}
                        {{--<li id="2009">--}}
                            {{--<h1>2009 百花齐放</h1>--}}
                            {{--<p>2009年，百花齐放。引入众多国民级应用，其中最出名的QQ农场，给了好多人一个深夜上网的理由，也为拉近老爸老妈老婆老公的关系做出了卓越的贡献。</p>--}}
                        {{--</li>--}}
                        {{--<li id="2010">--}}
                            {{--<h1>2010 新体验、新起点</h1>--}}
                            {{--<p>2010年，强化内功。致力于在产品体验不断的精雕细琢。因为经历了飞速发展的5年，我明白只有不断的自我修炼，才能让大家真正把咱当成网络的家。</p>--}}
                        {{--</li>--}}
                        {{--<li id="2012">--}}
                            {{--<h1>2012 我的空间 我的家</h1>--}}
                            {{--<p>2012年，培养内涵。更优质的宽屏体验、更丰富的应用、更热闹的个人中心，都是我不断培养内涵的结果。让网络上的家越来越上流，是我追求的目标。</p>--}}
                        {{--</li>--}}
                        {{--<li id="2012">--}}
                            {{--<h1>2014 分享生活 留住感动</h1>--}}
                            {{--<p>2014年，蜕变，不变。和大家一起经历的7年，是我生命中最美好的7年。你们在这7年里，有的从学生步入社会，有的成立家庭，有的有了孩子。时光流转，我们都在成长，但唯一不变的，就是QQ空间——你永远的家！</p>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{----}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
        <div class="row m-table">
            <div class="col s6 m6 l6 index-border m-table-cell"  id="news">
                <h4 class="index-title">详情咨询</h4>
                <div class="row">
                    <div class="col s6 m6 l6" style="text-align: center">
                        <img style="width: 214px;height: 302px"  src="{{url("../img/qr_jxh_1.jpg")}}">

                    </div>
                    <div class="col s6 m6 l6" style="text-align: center">
                        <img  style="width: 214px;height:302px" src="{{url("../img/qr_bf_1.jpg")}}">

                    </div>
                </div>
            </div>

            <div class="col s1 m1 l1">&nbsp;</div>
            <div class="col s5 m5 l5 index-border m-table-cell" id="pic" >
                <h4 class="index-title">本届报名信息统计</h4>
                <br/>
                <div class="center-text">
                    <div>
                        <h5>队伍总数:{{$group}}</h5>
                        <h5>已报名总人数:{{$joinnum}}</h5>
                    </div>

                </div>

                {{--<h4 class="index-title">图集</h4>--}}
                {{--<div class="swiper-container-pic">--}}
                    {{--<div class="swiper-wrapper">--}}
                        {{----}}
                    {{--</div>--}}

                    {{--<!-- Add Pagination -->--}}
                    {{--<div class="swiper-pagination"></div>--}}

                    {{--<!-- Add Arrows -->--}}
                    {{--<div class="swiper-button-prev"></div>--}}
                    {{--<div class="swiper-button-next"></div>--}}
                {{--</div>--}}
            </div>

    </div>
        <div class="row">
            <div class="col s12 m12 l12 index-border">
                <h4 class="index-title" style="text-align: center">赞助商</h4>
            </div>
        </div>
    </div>

@endsection
@section('jscript_os')
    <script src="{{ url("/other/clock.js")}}"></script>
    <script>
        $(function(){
            $().timelinr({
            })
        });
        $(document).ready(function () {
            var isMobile = {
                Android: function() {
                    return navigator.userAgent.match(/Android/i) ? true : false;
                },
                BlackBerry: function() {
                    return navigator.userAgent.match(/BlackBerry/i) ? true : false;
                },
                iOS: function() {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i) ? true : false;
                },
                Windows: function() {
                    return navigator.userAgent.match(/IEMobile/i) ? true : false;
                },
                any: function() {
                    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Windows());
                }
            };
            if( isMobile.any() )
            {
                window.location.href="{{url('/mywalk')}}"
            }
//            $("#pic").css('height',$("#news").css('height'))
            $('.collapsible').collapsible({
                accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
            });

            var mySwiper = new Swiper ('.swiper-container', {
                loop: true,

                // 如果需要分页器
                pagination: '.swiper-pagination',

                // 如果需要前进后退按钮
//            nextButton: '.swiper-button-next',
//            prevButton: '.swiper-button-prev',
//
//            // 如果需要滚动条
//            scrollbar: '.swiper-scrollbar',
//                mousewheelControl : true,
                onInit: function(swiper){ //Swiper2.x的初始化是onFirstInit
                    swiperAnimateCache(swiper); //隐藏动画元素
                    swiperAnimate(swiper); //初始化完成开始动画
                },
//                autoplay:2500,
//                autoplayDisableOnInteraction: false,
                onSlideChangeEnd: function(swiper){
                    swiperAnimate(swiper); //每个slide切换结束时也运行当前slide动画
                }
            })
//            var swiper = new Swiper('.swiper-container-pic', {
//                pagination: '.swiper-pagination',
//                effect: 'flip',
//                grabCursor: true,
//                nextButton: '.swiper-button-next',
//                prevButton: '.swiper-button-prev',
//                paginationBulletRender: function (index, className) {
//                    return '<span class="' + className + '">' + (index + 1) + '</span>';
//                },
//                autoplay: 1500,
//
//                autoplayDisableOnInteraction: false
//
//            });
        })
    </script>

    @endsection
