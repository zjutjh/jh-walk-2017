@include('layouts.head')
{{--创建/修改队伍信息--}}
<title>精弘毅行-队伍资料</title>
<body>

    <div class="container">
        <h4>{{$g_msg}}</h4>
        <div class="form-group">
            <label for="max_num">最大队伍人数(2-4)</label>
            <input  id="max_num"  class="form-control" type="text" placeholder="" value="{{$group['max_num']}}">
            <p id="max_num_state"></p>
        </div>
        <div class="form-group">
            <label for="description">介绍</label>
            <input id="description"   class="form-control" type="text" placeholder="一句话说明" value="{{$group['description']}}">
        </div>
        <div class="row">
            <div class="col  offset-m10">
                <a href="javascript:void(0)" id="cancela" class="waves-effect red btn ">取消</a>
                <a href="javascript:void(0)" id="submita" class="waves-effect blue btn ">提交</a>
            </div>
        </div>

    </div>
</body>
<style type="text/css">
    #max_num_state p{color:red;}
</style>
<script type="text/javascript">
    $(document).ready(function () {
        var n_num=  <?php echo $group['now_num']?>;
        var gid=  <?php echo $gid ?>;
        $('#max_num').blur(function(){
            var max_num=$("#max_num").val();
            if(max_num<n_num||max_num>4){
                $("#max_num_state").html("队伍人数应为"+ n_num +" ~4人");
            }else{
                $("#max_num_state").html("");
            }
        })
        $('#cancela').click(function(){
            window.location.href="<?php echo url("/mywalk")?>";
        })
        $('#submita').click(function(){
            var description=$("#description").val();
            var max_num=$("#max_num").val();
            if(max_num<n_num||max_num>4){
                alert("队伍人数应为"+ n_num +" ~4人");
                return 0;
            }
            var vm=new Vue({
                el:"body",
                ready:function(){
                    this.$http.post("../gif/"+ gid,{description:description,max_num:max_num}).then(function(response){
                        alert("操作成功")
                        window.location.href="<?php echo url("/mywalk")?>"
                    },function(response){
                        if(response.status==403){
                            alert("登录已经过期")
                            window.location.href="<?php echo url("/mywalk")?>"
                        }else{
                            alert(response.data.message);
                        }
                    })
                }

            })

        })
    })
</script>