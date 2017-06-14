<style type="text/css">
    .pagination li.active {
        background-color: #40c4ff }
    .pagination li :hover{
        background-color: #4dd0e1;
        transition: .5s ease background-color ;
    }
    .pagination li{
        margin: 0 2px;
    }
    table tbody tr[class~="hoverable"]:hover>td:first-child{
        color:#40c4ff;
        transition: .5s ease color;
    }
</style>
<script type="text/javascript">

    function checkarea(user_sa,group_sa,gid){
        var idcheck="{{ $idcheck}}" ;
        if(idcheck==-1){alert("您还没有填写身份证号，请先填写才能报名");return 0;}
//        if(user_sa!=group_sa){
//            a=confirm('您的出发地点是【'+ user_sa +'】,而该队伍出发点是【'+ group_sa +'】,若您报名参加这个队伍，您必须前往【'+ group_sa +'】,进行出发流程，是否依旧报名该队伍?')
//            if(a==false){
//
//                return 0;
//            }
//        }
        var vm= new Vue({
            el:"body",
            ready:function(){
                this.$http.post("../mywalk/group/join",{gid:gid}).then(function(response){
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

    }

</script>
<div>

<table  class="striped" >
    <thead>
        <tr>
            <th>编号</th>
            <th>队长姓名</th>
            <th>队伍简介</th>
            <th>队长校区</th>
            <th>队员上限</th>
            <th>队员数量</th>
            <th>报名数量</th>
            @if($can_enter==1)
                <th>选择</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach ($grouparray as $group)
        <tr class="hoverable">
            <td align="center">{{$group->id}}</td>
            <td align="center">{{$group->leadername}}</td>
            <td>{{$group->description}}</td>
            <td align="center">{{$group->startarea}}</td>
            <td align="center">{{$group->max_num}}</td>
            <td align="center">{{$group->now_num}}</td>
            <td align="center">{{$group->pre_num}}</td>
            <?php
                if($group->max_num<=$group->now_num*2) {$stateicon='<i class=" icon-adjust"></i>';$statecolor="green";}
                if($group->max_num>$group->now_num*2) {$stateicon='<i class="icon-circle-blank"></i>';$statecolor="green";}
                if($group->max_num==$group->now_num) {$stateicon='<i class=" icon-circle"></i>';$statecolor="red";}
                if($group->lock==1) {$stateicon='<i class="icon-remove"></i>';$statecolor="red";}
            ?>

            @if($can_enter==1)
                <td><a href="javascript:void(0)" onclick="checkarea('{{$user_sa}}','{{$group->startarea}}',{{$group->id}})" class="waves-effect waves-light btn  {{$statecolor}}">{!! $stateicon !!}&nbsp;加入组队</a></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
    <div align="center">
        <div>
            @if ($grouparray->lastPage() > 1)
                <ul class="pagination ">
                    <li class="{{ ($grouparray->CurrentPage() == 1) ? ' disabled' : '' }}"><a href="{{ $grouparray->Url(1) }}" >|<</a></li>
                    <li class="{{ ($grouparray->CurrentPage() == 1) ? ' disabled' : '' }}"><a href="{{ $grouparray->previousPageUrl() }}" ><</a></li>
                    @for ($i = ($grouparray->CurrentPage()-5<=0?1: $grouparray->CurrentPage()-5); $i <=( $grouparray->CurrentPage()+5>$grouparray->lastPage()?$grouparray->lastPage():$grouparray->CurrentPage()+5); $i++)
                        <li class="{{ ($grouparray->CurrentPage() == $i) ? 'active ' : 'waves-effect' }}@if ($grouparray->CurrentPage() == $i) @yield('color') @endif"><a href="{{ $grouparray->Url($i) }}" >{{ $i }}</a>
                    @endfor
                    <li class="{{ ($grouparray->CurrentPage() == $grouparray->lastPage()) ? ' disabled' : '' }}"><a href="{{ $grouparray->nextPageUrl() }}" >></a></li>
                    <li class="{{ ($grouparray->CurrentPage() == $grouparray->lastPage()) ? ' disabled' : '' }}"><a href="{{ $grouparray->Url($grouparray->lastPage()) }}" >>|</a></li>
                </ul>
            @endif


        </div>

    </div>

    <br/>
    <br/>
</div>