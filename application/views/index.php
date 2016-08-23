<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>登陆 - <?=$this -> config -> item('website_name') ?></title>
<link href="<?=base_url("/styles/global.css")?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url("/styles/index.css")?>" rel="stylesheet" type="text/css" />
<style type="text/css">
#overlay {
	font-weight:bold;
	font-size:24px;
	text-align:center;
	position:absolute;
	padding-top:200px;
	width:100%;
	top:0px;
	left:0px;
	right:0px;
	bottom:0px;
	display:none;
	color:#333;
}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?=base_url("/scripts/index.js")?>"></script>
</head>

<body>
<div class="wrapper">
	<div class="box">
    	<form action="index.php/welcome/doLogin" method="post">
            <h1 class="hiddenText">数据统计系统</h1>
            <p class="first"><label for="username" class="hiddenText text username">用户名：</label><input type="text" class="text"  name=" username" id="username" maxleng="20" placeholder="请输入用户名" /></p>
            <p><label for="password" class="hiddenText text password">密码：</label><input type="password" class="text" name="password" id="password"  maxleng="20" placeholder="请输入密码" /></p>
            <p  class="captcha"><label for="code" class="hiddenText text code">验证码：</label><input type="text" class="text code" name="code" id="code" maxlength="4" /><?=$cap['image']  ?></p>
            <p><input type="image" src="<?=base_url("/images/index_23.png"); ?>" title="马上登录" id="submit" /></p>
        </form>
    </div> <!-- /box -->
    
    <div class="footer">
    	<p>Copyright &copy; 2014 PF, All rights reserved.</p>
    </div> <!-- /footer -->
</div> <!-- /wrapper -->
<div id="overlay">登录验证中，请稍后...</div>
<script>
$('form').submit(function(){
	$('#submit').attr('disabled',true);
	$('#overlay').fadeToggle(100);
	var url = $(this).attr('action');
	url = url + "?fxsxxx344=" + Math.random();
	var $data = $(this).serialize();
	$.post(url, $data, function(data){
		var newData = eval("(" + data + ")");
		if(newData.result) {
			$.post("index.php/welcome/sendEmail",{'userType' : newData.data.type});
			window.location.href="<?=site_url("user")?>";
		} else {
			$('#overlay').fadeToggle(200,function(){
				alert(newData.message);
				$('#submit').attr('disabled',false);
			});
		}
	});
	return false;
}); // end from submit
</script>
</body>
</html>