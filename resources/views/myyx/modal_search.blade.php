{{--搜索组队--}}

<script type="text/javascript">
   function McloseModal(){
       $("#Modalsearch").closeModal();
   }

</script>
    <div class="modal-content">

        <table class="table">
            <caption>队伍信息</caption>
            <tbody>
            <tr >
                <td>队长姓名</td>
                <td>{{$g_info->leadername}}</td>
            </tr>
            <tr >
                <td>队伍出发点</td>
                <td>{{$g_info->startarea}}</td>
            </tr>
            <tr >
                <td>队伍描述</td>
                <td>{{$g_info->description}}</td>
            </tr>
            <tr >
                <td>已报人数/队伍上限</td>
                <td>{{$g_info->now_num}}/{{$g_info->max_num}}</td>
            </tr>
            <tr>
                <td>是否可报名</td>
                <td></td>
            </tr>

            </tbody>
        </table>
    </div>
    <div class="modal-footer">  <a  class=" waves-effect waves-red btn-flat" href="javascript:McloseModal()">关闭</a>&nbsp;&nbsp;
        <a  id="ingroup" href="javascript:void(0)" onclick="" class=" waves-effect waves-green btn-flat">加入组队</a>

    </div>
