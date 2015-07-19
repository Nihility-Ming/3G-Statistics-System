<form method="post" action="<?=site_url('user/doChangePassword')?>">
<p class="nav">当前位置： 修改密码</p>
<table style="width:350px;margin-top:100px; margin-left:auto; margin-right:auto;" border="1"  align="center">
	<tr>
    	<td><b>用户名：</b></td>
        <td><input type="text" name="username" class="text" value="<?=$username?>" disabled /></td>
    </tr>
    <tr>
    	<td><b>原密码：</b></td>
        <td><input type="password" name="s_pwd"  class="text" placeholder="请输入原始密码"  required /></td>
    </tr>
    <tr>
    	<td><b>新密码：</b></td>
        <td><input type="password" name="n_pwd1"  class="text" placeholder="请输入新密码"  required /></td>
    </tr>
    <tr>
    	<td><b>重复密码：</b></td>
        <td><input type="password" name="n_pwd2"  class="text" placeholder="请再次输入新密码"  required  /></td>
    </tr>
    <tr>
    	<td colspan="2" class="bottom">
        	<input type="submit" value="确认修改" class="btn" id="changePassword"/>
        </td>
    </tr>
</table>	
</form>
<p style="text-align:center; margin:10px 0;">注意：每次修改密码系统将会自动发送<strong>备份邮件</strong>！</p>
<script>
$('form').submit(function(){
	if(confirm("您确定要修改密码吗？")) {
		var $data = {
			's_pwd' : this.elements['s_pwd'].value,
			'n_pwd1' : this.elements['n_pwd1'].value,
			'n_pwd2' : this.elements['n_pwd2'].value
		};
		$.post('user/doChangePassword',$data,function(data){	
			alert(data);
			if(data=="修改成功！") {
				$.post('user/getBackPassword',function(r){
					// alert(r);
				}); // 发送电子邮件
			}
		});
	}
	return false;
});
</script>