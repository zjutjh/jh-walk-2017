@extends('layouts.group')
@section('jscript_os2')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#dismiss_group').click(function(){
                var vm=new Vue({
                    el:"body",
                    ready:function(){
                        this.$http.delete("../mywalk/group").then(function(response){
                            alert(response.data.message)
                            window.location.href="<?php echo url("/mywalk")?>"
                        },function(response){
                            alert(response.data.message)
                            window.location.href="<?php echo url("/mywalk")?>"
                        })
                    }
                })
            })
            $('#change_info').click(function(){
                var vm=new Vue({
                    el:"body",
                    ready:function(){
                        this.$http.get("../mywalk/group/gif/0").then(function(response){
                            window.location.href="<?php echo url("/mywalk/group/gif/0")?>"
                        },function(response){
                            alert(response.data.message)
                        })
                    }

                })

            })
            var vm=new Vue({
                el:"body",
                data:{
                  lock:<?php echo $lockstate ?>
                },
                methods:{
                    locker:function(){
                        this.$http.put("../mywalk/group/lock").then(function(response){
                            var msg=response.data.message.toString()

                            softalert(msg)

                        },function(response){
                            var msg=response.data.message.toString()
                            softalert(msg)
                            if(vm.lock==1){
                                vm.lock=0
                            }else{
                                vm.lock=1
                            }

                        })
                    }
                }
            })
        })
    </script>
@endsection
@section('style_os2')
    <style type="text/css">
    .switch label input[type=checkbox]:checked + .lever {
    background-color: #ffcdd2; }
    .switch label input[type=checkbox]:checked + .lever:after {
    background-color: #e57373; }
    #switch{display:inline;}
    </style>
@endsection
@section('section_white')
    <div class="card-panel  light-blue darken-2" >
       <span class="white-text">
                    你已经成功建立一个组队,你可以&nbsp;&nbsp;<a class="waves-effect blue waves-light  btn modal-trigger" href="#modalteaminfo">管理组队</a>&nbsp;&nbsp;(现在有{{$pre_num}}人想要加入您的队伍),或者&nbsp;&nbsp;<a class="waves-effect blue waves-light  btn" id="change_info" href="javascript:void(0)">修改队伍信息</a>&nbsp;&nbsp;如果没人加入，你可以 <a class="waves-effect blue waves-light  btn white-text {$statea}" id="dismiss_group" href="javascript:void(0)" >解散队伍</a> 或者
                   <div id="switch" class="switch">
                       <label class="white-text">
                           解锁
                           <input v-model="lock" v-on:change="locker"  v-bind:true-value="1" v-bind:false-value="0" type="checkbox">
                           <span class="lever"></span>
                           锁定
                       </label>
                   </div>
       </span>
    </div>

    <!-- <h5>成员信息</h5>
    <table class="striped">
        <thead>
            <tr>
                <th>姓名</th>
                <th>性别</th>
                <th>校区/职业</th>
                <th>电话</th>
                <th>QQ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <volist name="list1" id="vo1">
                <tr>
                    <td>{$vo1.name}</td>
                    <td>{$vo1.sex}</td>
                    <td>{$vo1.area}</td>
                    <td>{$vo1.phone}</td>
                    <td>{$vo1.qq}</td>
                    <td><a href="__APP__/Home/Group/kick/groupid/{$vo1.group}/datauid/{$vo1.uid}" class="waves-effect waves-light btn blue white-text {$statea}">踢出队伍</a></td>

                </tr>
            </volist>
        </tbody>
    </table>
    <hr>

    <h5>预备加入队员信息</h5>
    <table class="striped">
        <thead>
            <tr>
                <th>姓名</th>
                <th>性别</th>
                <th>校区</th>
                <th>电话</th>
                <th>QQ</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <volist name="list" id="vo">
                <tr>
                    <td align="center">{$vo.name}</td>
                    <td align="center">{$vo.sex}</td>
                    <td align="center">{$vo.area}</td>
                    <td align="center">{$vo.phone}</td>
                    <td align="center">{$vo.qq}</td>
                    <td align="center"><a href="__APP__/Home/Group/agree/group/{$vo.group}/uid/{$vo.uid}" class="waves-effect waves-light btn green  {$statea}">同意加入</a></td>
                    <td align="center"><a href="__APP__/Home/Group/kick/groupid/{$vo.group}/datauid/{$vo.uid}" class="waves-effect waves-light btn orange white-text  {$statea}">踢出队伍</a></td>
                </tr>
            </volist>

        </tbody>
    </table> -->
    <header>其他队伍信息</header>
    @include('myyx.table_group_list',['can_enter'=>0,'grouparray'=>$grouparray])
@endsection
@section('hidden_content')
    @include('myyx.modal_teaminfo_leader',['member_info'=>$member_info])
@endsection