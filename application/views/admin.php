<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>后台 - <?=$this -> config -> item('website_name') ?></title>
<link href="<?=base_url("/styles/global.css")?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url("/styles/admin.css")?>" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="<?=base_url("/scripts/admin.js")?>"></script>
<script src="<?=base_url("/scripts/My97DatePicker/WdatePicker.js")?>"></script>
</head>

<body>
<div class="wrapper">
	<div class="header clearInnerFloat">
    	<h1 class="logo hiddenText" title="<?=$this -> config -> item('website_name') ?>"><?=$this -> config -> item('website_name') ?></h1>
        <span class="welcome">^_^ 你好！<?=$username?>，<a href="user/out">退出 &gt;&gt;  </a></span>
    </div>
    <div class="main">
    	<div class="sidebar">
        	<ul class="shabox">
            	<?php if($userRoot): ?>
            	<!-- 管理员 -->
            	<li><a href="#" class="current">管理首页</a></li>
                <li><a href="user/showCheckUser"> -&gt; 会员管理</a>
                <li><a href="user/showAddUser">-&gt; 新增会员</a></li>
                <li><a href="user/showPublicApp">-&gt; 应用管理</a></li>
                <li><a href="user/showChangePassword">-&gt; 修改密码</a></li>
                <!-- /管理员 -->
                <?php else: ?>
                <!-- 用户 -->
                <li><a href="#">-&gt; 应用数据</a></li>
                	<ul class="userApp">
                    	<?php foreach($userData as $item): ?>
                    	<li><a href="user/showNumDate/<?=$item['id'] ?>"><?=$item['name']?></a></li>
                        <?php endforeach ?>
                    </ul>
                <li><a href="user/showMyApp">-&gt; 应用下载</a></li>
                <li><a href="user/showMyMoney">-&gt; 结算记录</a></li>
                <!-- /用户 -->
                <?php endif ?>
                <li><a href="user/out">-&gt; 退出</a></li>
            </ul>
            <div class="anthor shabox">
            	<h4>业务联系咨询</h4>
                <p class="first"><span class="t">联系人：</span>田乙秀</p>
                <p><span class="t">QQ：</span>363294984</p>
                <p><span class="t">TEL：</span>18601925201</p>
            </div>
        </div>
        <div class="content shabox" id="content">
        	<p style="text-align:center;margin-top:55px;">欢迎访问数据统计管理后台！
</p>
        </div>
        <br style="clear:both" />
    </div>
    <div class="footer"><p>Copyright &copy; 2014 PF, All rights reserved.</p></div>
</div>
</body>
</html>