
@include("layouts.head")
<title>精弘毅行--@yield('title')</title>
@yield('style_os')
<style type="text/css">
    .mask{height:750px; width:100%; position:absolute ; _position:absolute; top:0; z-index:650; }
    .opacity{ opacity:0.4; filter: alpha(opacity=40); background-color:#2f2f4f; }
    .toast.bluecolor{background-color: #0d47a1}
    body{
        font-family: '微软雅黑', "Microsoft YaHei", '宋体', Arial, Microsoft YaHei, Helvetica,'Open Sans', sans-serif;

    }
    footer .page-footer{
        margin-top: 0;
    }
</style>
<body>

    <div class="navbar-fixed">
        <nav class="@yield('color')">
            <div class="nav-wrapper">
                {{--<a href="#!" class="brand-logo center">精弘毅行</a>--}}
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="icon-reorder icon-2x"></i></a>
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li class="@yield('index_active')"><a href="{{url('/index') }}">首页</a></li>
                        <li class="@yield('myyx_active')" ><a href="{{url('/mywalk') }}">我的毅行</a></li>
                        {{--<li><a href="http://bbs.zjut.edu.cn/question/1120">毅行十问十答</a> </li>--}}
                       {{--<li class="@yield('rebackyx_active')"><a href="{{url('/rebackyx') }}">往届毅行回顾</a></li>--}}
                        <li><a href="http://bbs.zjut.edu.cn" target="_blank">发帖寻队友</a></li>
                        {{--<li><a href="http://bbs.zjut.edu.cn/explore/category-30">发帖寻队友</a></li>--}}
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li class="@yield('index_active')"><a href="{{ url('/index')}}">首页</a></li>
                        <li class="@yield('myyx_active')" ><a href="{{ url('/mywalk') }}">我的毅行</a></li>
                        {{--<li><a href="http://bbs.zjut.edu.cn/question/1120">毅行十问十答</a> </li>--}}
                        {{--<li class="@yield('rebackyx_active')"><a href="<?php echo url('/rebackyx')?>">往届毅行回顾</a></li>--}}
                        <li><a href="http://bbs.zjut.edu.cn" target="_blank">发帖寻队友</a></li>
                    </ul>
            </div>
        </nav>
    </div>
    @yield('content')
    <footer class="page-footer @yield('color')">
        <div class="container">
            <div class="row">

            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="clearFloat" align="center">
                    <div class="footer">Copyright© Louisian-<a href="http://www.zjut.com/" class="white-text" target="_blank" title="浙江工业大学官方学生网络团队" rel="nofollow">精弘网络</a>-<a class="white-text" href="http://www.miibeian.gov.cn/" target="_blank">浙ICP备14002688号-1</a> <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_4672057'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s23.cnzz.com/stat.php%3Fid%3D4672057%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
                    </div>
                </div>
            </div>

        </div>

    </footer>

@yield('hidden_content')
</body>
<script type="text/javascript">

    $(document).ready(function() {

        $(".button-collapse").sideNav();
        $('.parallax').parallax();
        $('.modal-trigger').leanModal();
        $('.tooltipped').tooltip({delay: 50});
//        var Vue=require('vue');
//        Vue.use(require('vue-resource'));


    });

    function softalert(msg){

        Materialize.toast('<span>' + msg + '</span>', 2000,'bluecolor');

    }

</script>
@yield('jscript_os')
