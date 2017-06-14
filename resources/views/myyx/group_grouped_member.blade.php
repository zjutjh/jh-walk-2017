@extends('layouts.group')
@section('section_white')
    <div class="card-panel  light-blue darken-2" align="center" >
        <span class="white-text">
                        你已经成功加入一个组队，你可以&nbsp;&nbsp;<a class="waves-effect blue waves-light  btn modal-trigger" href="#modalteaminfoal">查看组队</a>&nbsp;&nbsp;.
        </span>
    </div>

    <!-- <h4>队长信息</h4>
            <table class="striped">
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>校区</th>
                        <th>电话</th>
                        <th>QQ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{$leader.name}</td>
                        <td>{$leader.sex}</td>
                        <td>{$leader.area}</td>
                        <td>{$leader.phone}</td>
                        <td>{$leader.qq}</td>
                    </tr>
                </tbody>
            </table>
            <hr>

            <h4>队员信息</h4>
            <table class="striped">
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>性别</th>
                        <th>校区</th>
                        <th>电话</th>
                        <th>QQ</th>
                    </tr>
                </thead>
                <tbody>
                    <volist name="listx" id="vo">
                        <tr>
                            <td>{$vo.name}</td>
                            <td>{$vo.sex}</td>
                            <td>{$vo.area}</td>
                            <td>{$vo.phone}</td>
                            <td>{$vo.qq}</td>
                        </tr>
                    </volist>

                </tbody>
            </table> -->
    <!-- 	<hr> -->
    <header>其他队伍信息</header>
    @include('myyx.table_group_list',['can_enter'=>0,'grouparray'=>$grouparray])
@endsection
@section('hidden_content')
    @include('myyx.modal_teaminfo_member',['member_info'=>$member_info])
@endsection