<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>登录</title>  
    <link rel="stylesheet" href="/skin/css/pintuer.css">
    <link rel="stylesheet" href="/skin/css/admin.css">
<script type="text/javascript" src="/skin/js/jquery-1.8.0.min.js"></script>
<script src="/skin/admin/onload.js"></script>
<script src="/skin/admin/function.js"></script>
<script>
function checkLogin(){
	if(!this.username.value) throw('用户名不能为空');
	if(!this.password.value) throw('密码不能为空');
}

function doLogin(err, data){
	if(err){
		alert(err);
	}else{
		//alert('验证成功');
		location='/index.php';
	}
}
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#safepass").blur(function(){
  var SAFEPASS=$("#safepass").val();
  });
});
</script>

</head>
<body>
<form id="login" target="ajax" onajax="checkLogin" call="doLogin" action="/index.php/user/checkLogin" method="post">
<div class="bg"></div>
<div class="container">
    <div class="line bouncein">
        <div class="xs6 xm4 xs3-move xm4-move">
            <div style="height:150px;"></div>
            <div class="media media-y margin-big-bottom">           
            </div>         
            <form action="index.html" method="post">
            <div class="panel loginbox">
                <div class="text-center margin-big padding-big-top"><h1>后台管理中心</h1></div>
                <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                    <div class="form-group">
                        <div class="field field-icon-right">
					
                            <input type="text" class="input input-big" id="username" name="username" placeholder="登录账号" data-validate="required:请填写账号" />
                            <span class="icon icon-user margin-small"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field field-icon-right">
                            <input type="password" class="input input-big" id="password" name="password" placeholder="登录密码" data-validate="required:请填写密码" />
                            <span class="icon icon-key margin-small"></span>
                        </div>
                    </div>
					 <div class="form-group">
                        <div class="field field-icon-right">
                            <input id="safepass" name="safepass" type="password" class="input input-big" placeholder="安全码" data-validate="required:请输入安全码" />
                            <span class="icon icon-key margin-small"></span>
                        </div>
                    </div>
               
                 <p></p>
			
                <div style="padding:30px;"><input type="submit" id="submit" class="button button-block bg-main text-big input-big" value="登录"></div>
			
            </div>
            </form>          
        </div>
    </div>
</div>

</body>
</html>