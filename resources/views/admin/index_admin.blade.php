@include('layouts.head')
<title>毅行后台</title>
<body>
    <div class="row">
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">报名信息</span>
                    <p>全部报名队伍：{{$nGroup}}</p>
                    <p>全部报名人数：{{$nJoin}}</p>

                </div>
                <div class="card-action">
                    <a href="<?php echo url("/admin/excel")?>">下载组队表</a>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">修改届数</span>
                    <p>现在届数</p>

                </div>
                <div class="card-action">
                    <a href="<?php echo url("/admin/excel")?>">下载组队表</a>
                </div>
            </div>
        </div>
    </div>
</body>