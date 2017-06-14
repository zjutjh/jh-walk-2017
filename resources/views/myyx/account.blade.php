@include('layouts.head')
{{--修改个人信息--}}
<title>精弘毅行-个人资料</title>
<script type="text/javascript">
    $(document).ready(function(){

        $('select').material_select();
        $('#name').blur(function(){
            if ($("#name").val().length==0){
                $("#namestate").html("请输入姓名！");
                $("#namestate").css("color","red");
            }else{
                $("#namestate").html("  ");
            }});
        $('#phone').blur(function(){
            if ($("#phone").val().length!=11){
                $("#phonestate").html("请输入11位的电话号码！");
                $("#phonestate").css("color","red");
            }else{
                $("#phonestate").html("  ");
            }});
        //ajax
        $("#submita").click(function(){
            var name=$("#name").val()
            var sex=$("#sex").val()
            var area=$("#area").val()
            var startarea=$("#startarea").val()
            var phone=$("#phone").val()
            var qq=$("#qq").val()
            if(phone.length!=11){
                alert('手机号必须是11位,请不要填写短号!')
                exit(0)
            }
            $a=confirm("是否承诺您所填写的个人信息属实，若有不属实的个人信息，所有后果都将自行承担?");
            if($a==true){
                var vm= new Vue({//mode 1代表点击提交 0代表点取消
                    el:"body",
                    ready:function(){
                        this.$http.post("../mywalk/account",{name:name,sex:sex,area:area,startarea:startarea,phone:phone,qq:qq,mode:1}).then(function(response){
                            alert("修改成功!");
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
                });
            }
        });
        $("#cancela").click(function(){
            var vm= new Vue({//mode 1代表点击提交 0代表点取消
                el:"body",
                ready:function(){
                    this.$http.post("../mywalk/account",{mode:0}).then(function(response){
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
            });
        });
    });
</script>
<style type="text/css">
    #phone label{color:red;}
    body { padding-top:70px; }
</style>
<body>
<div class="container">
        <h3 >完善个人资料</h3>
        <h5 class="alert-info">您必须先完善个人信息，方可参加本活动</h5>
            <h4>基本信息</h4>
            <div class="form-group">
                <label for="name">姓名<span class="red-text">*</span></label><span class="red-text">请务必填写真实姓名，一切非真实信息造成的后果将自行承担</span>
                <input v-model="name" class="form-control"  name="name" id="name" value="{{$userarray['name']}}" type="text" placeholder=" 姓名">
                <p id="namestate"></p>

            </div>
            <div class="input-field ">
                <select v-model="sex" name="sex"  id="sex">
                    <?php switch($userarray["sex"]): case '男':?>
                        <option value="男" selected="selected">男</option>
                        <option value="女">女</option><?php break;?>
                    <?php case "女":?>
                        <option value="男">男</option>
                        <option value="女" selected="selected">女</option>
                    <?php break;?>
                    <?php default:?>
                        <option value="" disabled selected>请选择性别</option>
                        <option value="男">男</option>
                        <option value="女">女</option>
                    <?php  endswitch;?>
                </select><label >性别<span class="red-text">*</span></label>
            </div>
            <?php switch($userarray['ltype']): case 'user':?>
                <div class="input-field ">
                    <select v-model="area" name="area"  id="area" >
                        <?php switch($userarray["area"]): case '屏峰':?>
                            <option value="屏峰" selected="selected">屏峰</option>
                            <option value="朝晖">朝晖</option>
                            <option value="校友">校友</option>
                        <?php break;?>
                        <?php case "朝晖":?>
                            <option value="屏峰" >屏峰</option>
                            <option value="朝晖" selected="selected">朝晖</option>
                            <option value="校友">校友</option>
                        <?php break;?>
                        <?php case "校友":?>
                            <option value="屏峰" >屏峰</option>
                            <option value="朝晖">朝晖</option>
                            <option value="校友" selected="selected">校友</option>
                        <?php break;?>
                        <?php default:?>
                            <option value="" disabled selected>请选择校区</option>
                            <option value="屏峰">屏峰</option>
                            <option value="朝晖">朝晖</option>
                            <option value="校友">校友</option>
                        <?php  endswitch;?>
                    </select> <label >校区(目前选择的是:{{$userarray['area']}})<span class="red-text">*</span></label>
                </div>
            <?php break;?>
            <?php case "qq":?>
                <div class="input-field ">
                    <select v-model="area" name="area"  id="area" >
                        <?php switch($userarray["area"]): case '老师':?>
                            <option value="老师" selected="selected">老师</option>
                            <option value="校友">校友</option>
                            <option value="社会人士">社会人士</option>
                        <?php break;?>
                        <?php case "校友":?>
                            <option value="老师">老师</option>
                            <option value="校友" selected="selected">校友</option>
                            <option value="社会人士">社会人士</option>
                        <?php break;?>
                        <?php case "社会人士":?>
                            <option value="老师">老师</option>
                            <option value="校友" >校友</option>
                            <option value="社会人士" selected="selected">社会人士</option>
                        <?php break;?>
                        <?php default:?>
                            <option value="" disabled selected>请选择职业</option>
                            <option value="老师" >老师</option>
                            <option value="校友">校友</option>
                            <option value="社会人士">社会人士</option>
                        <?php  endswitch;?>
                    </select>
                    <label>职业(目前选择的是:{{$userarray['area']}})<span class="red-text">*</span></label>
                </div>
            <?php break;?>
            <?php  endswitch;?>
            <div class="input-field ">
                <select name="startarea" v-model="startarea" id="startarea" >
                    <?php switch($userarray["startarea"]): case '屏峰':?>
                        <option value="屏峰" selected="selected">屏峰</option>
                        <option value="朝晖">朝晖</option>
                        <option value="自主前往">自主前往</option>
                    <?php break;?>
                    <?php case "朝晖":?>
                        <option value="屏峰" >屏峰</option>
                        <option value="朝晖" selected="selected">朝晖</option>
                        <option value="自主前往">自主前往</option>
                    <?php break;?>
                    <?php case "自主前往":?>
                        <option value="屏峰" >屏峰</option>
                        <option value="朝晖">朝晖</option>
                        <option value="自主前往" selected="selected">自主前往</option>
                    <?php break;?>
                    <?php default:?>
                        <option value="" disabled selected>请选择出发点</option>
                        <option value="屏峰" >屏峰</option>
                        <option value="朝晖">朝晖</option>
                        <option value="自主前往">自主前往</option>
                    <?php  endswitch;?>
                </select><label >出发点(目前选择的是:{{$userarray['startarea']}})<span class="red-text">*</span></label>
            </div>
            <div class="form-group">
                <label for="phone">电话<span class="red-text">*</span></label>
                <input v-model="phone" id="phone" name="phone" class="form-control" type="text" placeholder=" 电话" value="{{$userarray['phone']}}">
                <p id="phonestate"></p>
            </div>
            <div class="form-group">
                <label for="qq">QQ<span class="red-text">*</span></label>
                <input id="qq" v-model="qq" name="qq" class="form-control" type="text" placeholder="QQ" value="{{$userarray['qq']}}">
            </div>
            <div class="row">
                <div class="col  offset-m10">
                    <a href="javascript:void(0)" id="cancela" class="waves-effect red btn ">取消</a>
                    <a href="javascript:void(0)" id="submita" class="waves-effect blue btn ">提交</a>
                </div>
            </div>
</div>
</body>