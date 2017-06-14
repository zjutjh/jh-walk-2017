@include('layouts.head')
<script type="text/javascript">
    $(document).ready(function(){
        $("#cancel").click(function(){
            window.location.href="<?php echo url("/mywalk")?>"
        });
        $("#submit").click(function(){
            var tag=0;
            var idcardVal= $("#idcard_in").val()
            if(idcardVal==$("#idcard_re").val()){tag=1;}else{alert("两次输入的身份证号不一致");tag=0;return;}
            if( idcardVal.length!=18){alert("请输入18位身份证号");tag=0;}else{tag=1;}

            if (tag==1){
                var vm=new Vue({
                    el:"body",
                    ready:function(){
                        this.$http.post("../mywalk/idcard",{idcard:idcardVal.toUpperCase()}).then(function(response){
                            alert(response.data.message)
                            window.location.href="{{ url("/mywalk")}}"
                        },function(response){

                            alert(response.data.message)

                        })
                    }

                })
            }
        });
    });

</script>
<body>
<div class="container">
    <h4>身份验证</h4>
    <div class="card transparent hoverable">
        <div class="card-content black-text">
            <div class="row">
                <form id="idcheckform">
                    <div class="input-field col s12">
                        <input id="idcard_in" name="idcardin" type="text" class="validate">
                        <label for="idcard_in">请输入身份证</label>
                    </div>
                    <div class="input-field col s12">
                        <input id="idcard_re" name="idcardre" type="text" class="validate">
                        <label for="idcard_re">请再一次输入身份证</label>
                    </div>
                </form>

                <a class="waves-effect waves-light blue btn" id="submit">提交</a>&nbsp;<a id="cancel" class="waves-effect waves-light red btn">取消</a><p class="red-text">我们将加密您的身份证号码，请您务必正确输入(请将末尾的X大写)</p>
            </div>
        </div>
    </div>
</div>
</body>