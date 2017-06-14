{{--队伍信息(队长)--}}
<script type="text/javascript">
    function kick_member(pid){
        var vm=new Vue({
            el:"body",
            ready:function(){
                this.$http.delete("../mywalk/group/member",{kickpid:pid}).then(function(response){
                    alert(response.data.message);
                    window.location.href="<?php echo url("/mywalk")?>"
                },function(response){
                    alert(response.data.message);
                })
            }
        })
    }
    function agree(pid){
        var vm=new Vue({
            el:"body",
            ready:function(){
                this.$http.post("../mywalk/group/member/agree",{agreepid:pid}).then(function(response){
                    alert(response.data.message);
                    window.location.href="<?php echo url("/mywalk")?>"
                },function(response){
                    alert(response.data.message);
                })
            }
        })
    }
    function disagree(pid){
        var vm=new Vue({
            el:"body",
            ready:function(){
                this.$http.delete("../mywalk/group/member/agree",{disagreepid:pid}).then(function(response){
                    alert(response.data.message);
                    window.location.href="<?php echo url("/mywalk")?>"
                },function(response){
                    alert(response.data.message);
                })
            }
        })
    }
</script>
<div id="modalteaminfo" class="modal bottom-sheet">
    <div class="modal-content">
        <h5>队伍信息</h5>
        <ul class="collection">
            @foreach($member_info['applied'] as $value)
                <li class="collection-item avatar">
                    <span class="title">{{$value->name}}</span>
                    <p>{{$value->sex}}&nbsp;&nbsp; <br/>出发地点:{{$value->startarea}}&nbsp;&nbsp;
                        电话:{{$value->phone}}&nbsp;&nbsp;QQ:{{$value->qq}}
                    </p>
                    <a href="javascript:kick_member('{{$value->uid}}')"  class="waves-effect waves-light btn blue white-text secondary-content">踢出队伍</a>
                </li>
            @endforeach
        </ul>
        <hr>
        <h5>预备加入队员信息</h5>
        <ul class="collection">
            @foreach($member_info['unapplied'] as $value)
                <li class="collection-item avatar">
                    <span class="title">{{$value->name}}</span>
                    <p>{{$value->sex}}&nbsp;&nbsp; <br/>出发地点:{{$value->startarea}}&nbsp;&nbsp;
                        电话:{{$value->phone}}&nbsp;&nbsp;QQ:{{$value->qq}}
                    </p>
                    <div class="row secondary-content">
                        <div class="col s2 m2 l2">&nbsp;</div>
                        <div class="col s5 m5 l5">
                            <a href="javascript:agree('{{$value->uid}}')"  class="waves-effect waves-light btn green  "><i class="icon-ok"></i></a></div><!-- __APP__/Home/Group/agree/groupid//uid/ -->
                        <div class="col s5 m5 l5">
                            <a href="javascript:disagree('{{$value->uid}}')" class="waves-effect waves-light btn orange white-text   "><i class="icon-remove"></i></a></div>
                    </div>
                </li>
           @endforeach
            </volist>
        </ul>
    </div>

</div>