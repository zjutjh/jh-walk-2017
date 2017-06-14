@extends('layouts.group')
@section('jscript_os2')
    <script type="text/javascript">
        $(document).ready(function () {
             $("#gb_order").click(function(){
                 var vm= new Vue({
                     el:"body",
                     ready:function(){
                         this.$http.delete("../mywalk/group/join").then(function(response){
                             alert(response.data.message);
                             window.location.href="<?php echo url("/mywalk")?>"
                         },function(response){
                             if(response.status==403){
                                 alert(response.data.message);
                                 window.location.href="<?php echo url("/mywalk")?>"
                             }else{
                                 alert(response.data.message);
                             }
                         })
                     }
                 });
             })
        })

    </script>
@endsection
@section('section_white')
    <div class="card-panel  light-blue darken-2" align="center">
                               <span class="white-text" >
					您正在报名加入一个组队并等待审核，您可以 <a href="javascript:void(0)" id="gb_order" class="waves-effect blue waves-light  btn white-text {$statea}">取回入队申请</a></span></div>
    <h4>选择组队</h4>
    @include('myyx.table_group_list',['can_enter'=>0,'grouparray'=>$grouparray])

@endsection