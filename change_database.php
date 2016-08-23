<?php
// 修改数据库信息
if(@ $_POST['dbUser']!='' && $_POST['dbPassword']!='' && $_POST['dbName']!='' && $_POST['emailUser']!='' && $_POST['emailPWD']!='') {
	// 接收
	$username = $_POST['dbUser'];
	$password = $_POST['dbPassword'];
	$database = $_POST['dbName'];
	$emailUser = $_POST['emailUser'];
	$emailPWD = $_POST['emailPWD'];
	$jsemail = $_POST['jsemail'];
	/**  part one  **/
	
	// 修改邮箱信息
	// user里面
	$file_url = 'application/controllers/user.php';
	$str = file_get_contents($file_url);
	$patter = array(
		"/toEmail = '(.*)'/",
		"/fromEmail = '(.*)'/"
	);
	$replace = array(
		"toEmail = '{$jsemail}'",
		"fromEmail = '{$emailUser}'"
	);
	$result = preg_replace($patter, $replace, $str);
	file_put_contents($file_url, $result);
	
	// config文件里面
	$file_url = 'application/config/email.php';
	$str = file_get_contents($file_url);
	$patter = array(
		"/'smtp_user' => '(.*)'/",
		"/'smtp_pass' => '(.*)'/"
	);
	$replace = array(
		"'smtp_user' => '{$emailUser}'",
		"'smtp_pass' => '{$emailPWD}'"
	);
	$result = preg_replace($patter, $replace, $str);
	file_put_contents($file_url, $result);
	/**  part two  **/
	
	// 修改数据库信息
	$file_url = "application/config/database.php"; // 设置文件地址
	$str = file_get_contents($file_url); // 读取文件地址
	
	// start 替换字符串
	$patter = array(
		"/db\['default'\]\['username'\] = '(\w*)'/",
		"/db\['default'\]\['password'\] = '(\w*)'/",
		"/db\['default'\]\['database'\] = '(\w*)'/"
		);
	$replace = array(
		"db['default']['username'] = '{$username}'",
		"db['default']['password'] = '{$password}'",
		"db['default']['database'] = '{$database}'"
		);
	$result = preg_replace($patter, $replace, $str);
	// end 替换字符串
	
	file_put_contents($file_url, $result); // 修改文件
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<title>设置数据库</title>
<style type="text/css">
html,body { margin:0; padding:0; }
.wrapper {
    font-family:"微软雅黑";
    color:#444;
    margin-top:10px;
    padding-top:50px;
    background:url(/images/index_03.png) center top no-repeat;
}
table {
    border-collapse:collapse;
    background-color:white;
    text-align:left;
    border:1px solid #ccc;
    box-shadow:5px 5px 10px #888;
}
table td {
    padding:10px 10px;
}
input.text {
    width:200px;
    padding:5px;

}
.field {
    font-size:14px;
    text-align:right;
    font-weight:bold;
}
caption {
    font-size:18px;
    color:red;
    font-weight:bold;
    padding-bottom:10px;
    padding-top:10px;
    border-radius:10px;
    margin-bottom:10px;
}
td.bot {
    background-color:#eee;
    text-align:center;
}
input.btn {
    margin:0 10px;
}
.copyright {
    font-size:12px;
    color:gray;
    margin-top:20px;
    text-align:center;
}
#db {
	border-bottom:1px solid #ccc;
}
#email {
	border-top:1px solid #ddd;
}
</style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
<body>
<div class="wrapper">
<form method="post">
	<table align="center">
    	<caption>配置系统信息</caption>
        <tbody id="db">
       	<tr>
        	<td class="field">数据库账号：</td>
            <td><input type="text" name="dbUser" class="text"  required placeholder="请填写数据库账号" /></td>
            <td style="color:red">*</td>
        </tr>
        <tr>
        	<td class="field">数据库密码：</td>
            <td><input type="password" name="dbPassword" class="text" required placeholder="请填写数据库密码" /></td>
            <td style="color:red">*</td>
        </tr>
        <tr>
        	<td class="field">数据库名称：</td>
            <td><input type="text" name="dbName" class="text" required placeholder="请填写数据库名称" /></td>
            <td style="color:red">*</td>
        </tr>
        </tbody>
        
        <tbody id="email">
        <tr>
        	<td class="field">发送邮箱帐号：</td>
            <td><input type="text" name="emailUser" class="text" required placeholder="格式：xxxx@163.com(网易邮箱)"/></td>
            <td style="color:red">*</td>
        </tr>
        <tr>
        	<td class="field">发送邮箱密码：</td>
            <td><input type="password" name="emailPWD" class="text" required  placeholder="请填写邮箱密码"/></td>
            <td style="color:red">*</td>
        </tr>
        <tr>
        	<td class="field">接收邮箱账号：</td>
            <td><input type="text" name="jsemail" class="text" required  placeholder="格式：xxxx@xxx.xxx"/></td>
            <td style="color:red">*</td>
        </tr>
        </tbody>
        <tr>
        	<td colspan="3" class="bot">
            	<input type="submit" value="确认提交" class="btn" id="send" />
                <input type="reset" value="重新填写" class="btn" />
            </td>
        </tr>
    </table>
</form>
<p class="copyright">Copyright © 2014 PF, All rights reserved.</p>
</div>
<script type="text/javascript">
$('#send').click(function(){
	alert("修改完成！若测试成功，为安全起见请手动将此文件change_database.php删除！");
	window.open('index.php','数据统计系统首页','_blank');
});
</script>
</body>
</html>