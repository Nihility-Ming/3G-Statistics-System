<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登录失败 - <?=$this -> config -> item('website_name') ?></title>
<link href="<?=base_url("/styles/global.css")?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url("/styles/err.css")?>" rel="stylesheet" type="text/css" />
<script type="text/javascript">
window.onload =function () {
	var seconds = 3;
	setInterval(function(){
		if (seconds == 0) {
			window.location.href = '<?=site_url()?>';
		}
		document.getElementById('seconds').innerHTML = (seconds--);
	}, 1000);
}
</script>
</head>

<body>
	<div class="box">
    	<a href="<?=site_url()?>" title="立即返回"><img src="<?=base_url("/images/err.png")?>" /></a>
    	<h3>操作提示：<?=$msg?></h3>
        <p><span id="seconds">4</span>秒后自动返回，点击上面按钮立即返回...</p>
    </div>
</body>
</html>