@extends('layouts.group')
@section('jscript_os2')
    <script type="text/javascript">
        $(document).ready(function(){
            var idcheck=" {{$idcheck }}";
            if(idcheck==-1){
                var r=confirm($("#message").text())
                if (r==true)
                {
                    window.location.href="{{url("/mywalk/idcard")}}"
                }

            }
            $('#add_group').click(function(){
                if(idcheck==-1){
                    alert('您没有验证身份，还不能组队')
                    return 0;
                }
                var vm=new Vue({
                    el:"body",
                    ready:function(){
                        this.$http.get("../mywalk/group/gif/-1").then(function(response){
                            window.location.href="<?php echo url("/mywalk/group/gif/-1")?>"
                        },function(response){

                            alert(response.data.message)


                        })
                    }

                })

            })
            $('#searchgroup').click(function(){
                var sgid=$("#sgid").val();
                if(sgid==""){
                   return;
                }
                var vm=new Vue({
                    el:"#search_group",
                    ready:function(){
                        this.$http.post("../mywalk/group/search",{sgid:sgid}).then(function(response){
                           $("#table_group").html(response.data)
                        },function(response){
                            alert(response.data.message)
                        })
                    }
                })


            })



        })
    </script>

@endsection
@section('style_os2')
    <style>
        #searchgroup:hover{
            background-color: red;

        }
        .margin-20px{
            margin-left: 35px;
        }
    </style>
    @endsection
@section('section_white')
<p style="display: none" id="message">您还没有输入身份证号，是否现在进行验证？</p>
    <div class="col m12 s12 l12">
        <div class="card-panel light-blue darken-2">
           <span class="white-text">
                您还没有报名，可以选择&nbsp;
               <a href="javascript:void(0)" id="add_group" class="waves-effect blue waves-light  btn white-text {$statea}" >创建组队</a>&nbsp;也可以选择列表中的队伍加入
           </span></div>

        <br/>
        <br/>
        <div class="row">
            <div class="col m6" >
                <br/>
                <h4 class="margin-20px">选择组队</h4>
            </div>

            <div class="col m6">
                <div class="card transparent">
                    <div class="card-content black-text" id="search_group">

                            <div class="input-field col m10" >
                                <input style="font-size:30px;color:#007acc"  type="text"  id="sgid" name="sgid" class="validate" >
                                <label  for="sgid">组号</label>
                            </div>


                        <a class="btn-floating btn-large waves-effect waves-light cyan" href="javascript:void(0)" id="searchgroup"><i class="icon-search icon-2x"></i></a>
                    </div>
                </div>
            </div><!-- /input-group -->
        </div>
        <div id="table_group">
            @include('myyx.table_group_list',['can_enter'=>1,'grouparray'=>$grouparray])
        </div>
</div>

@endsection

