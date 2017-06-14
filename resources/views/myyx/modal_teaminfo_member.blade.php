{{--组队信息(队员)--}}
<div id="modalteaminfoal" class="modal bottom-sheet">
    <div class="modal-content">
        <h5>队长信息</h5>
        <ul class="collection">

            <li class="collection-item avatar">
                <span class="title">{{$leader_info['name']}}</span>
                <p>{{$leader_info['sex']}}&nbsp;&nbsp; <br/>出发地点:{{$leader_info['startarea']}}&nbsp;&nbsp;
                    电话:{{$leader_info['phone']}}&nbsp;&nbsp;QQ:{{$leader_info['qq']}}
                </p>

            </li>

        </ul>
        <hr>
        <h5>队员信息</h5>
        <ul class="collection">
            @foreach($member_info['applied'] as $value)
                <li class="collection-item avatar">
                    <span class="title">{{$value->name}}</span>
                    <p>{{$value->sex}}&nbsp;&nbsp; <br/>出发地点:{{$value->startarea}}&nbsp;&nbsp;
                        电话:{{$value->phone}}&nbsp;&nbsp;QQ:{{$value->qq}}
                    </p>

                </li>
            @endforeach

        </ul>
    </div>
</div>