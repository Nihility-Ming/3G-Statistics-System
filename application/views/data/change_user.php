<style>
#addname {
	padding:5px 10px;
	width:200px;
}
table.ttt td{
	text-align:center;
}
</style>
<form action="<?=site_url('user/doChangeUser')?>" method="post">
<p class="nav">当前位置： 会员管理 &gt;&gt; 修改 &gt;&gt; <?=$user_arr['username']?></p>
<table border="1">
	<tr>
    	<td>用户ID：</td>
        <td><span id="userId"><?=$user_arr['id']?></span><input type="hidden" name="user_id"  value="<?=$user_arr['id']?>" /></td>
    </tr>
	<tr>
    	<td>用户名：</td>
        <td><input type="text" name="username" class="text" value="<?=$user_arr['username']?>" disabled /></td>
    </tr>
    <tr>
    	<td>密　码：</td>
        <td><input type="text" name="password"  class="text" value="<?=$user_arr['password']?>" placeholder="请输入用户密码"  required /></td>
    </tr>
    <tr>
    	<td>真实姓名：</td>
        <td><input type="text" name="realname"  class="text" value="<?=$user_arr['realname']?>" placeholder="请输入用户的真实姓名"  /></td>
    </tr>
    <tr>
    	<td>银行账号：</td>
        <td><input type="text" name="bank_accument"  class="text" value="<?=$user_arr['bank_accument']?>" />
        <input type="text" name="bank_name" class="text" style="width:100px" value="<?=$user_arr['bank_name']?>" placeholder="请输入银行名称" />
        </td>
    </tr>
    <tr>
        <td colspan="2">
        	<table  class="ttt">
            	<tr>
                	<th>编号</th>
                	<th>应用名称</th>
                    <th>下载地址</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($download_arr as $key => $item): ?>
                <tr>
                	<td><?=++$key?></td>
                	<td class="app_name">
                    	<label>
							<input type="hidden" name="id[]" value="<?=$item['id']?>" />
							<input type="text" name="name[]" value="<?=$item['name']?>" class="text name" title="<?=$item['name']?>" readonly />
                        </label>
                        
                    </td>
					<td> <input type="text" name="download[]" value="<?=$item['download']?>"   class="text downUrl" title="<?=$item['download']?>"/></td>
                    <td><a href="<?=site_url("user/deleteUserApp/{$item['id']}") ?>" class="deleteApp">删除</a></td>
                </tr>
                <?php endforeach ?>
                <tr style="background-color:#D3EEFE">
                	<td></td>
                	<td>
                    	<select id="addname">
                        	<option disabled selected> -= 请选择应用 =-</option>
                        	<? foreach($app_arr as $item): ?>
                        	<option value="<?=$item['id']?>" class="appname"><?=$item['name']?></option>
                            <? endforeach ?>
                        </select>
                    <td><input type="text" class="text downUrl" id="addurl" placeholder="请输入应用下载地址" /></td>
                    <td><a href="user/addUserApp" id="addApp">添加</a></td>
                </tr>
            </table> <!-- /内嵌表格 -->
        </td>
    </tr><!-- /修改应用 -->
    <tr>
        <td colspan="2"  class="bottom"><input type="submit" value="确认保存" class="btn" id="savedata" /><input type="reset" value="重置" class="btn" /><input type="button" value="返　回" class="btn" id="back" /></td>
    </tr>
</table>
</form>
<script>
$('#back').click(function(){
	$('#content').load("user/showCheckUser" + "?fdsgds=" + Math.random());
});

$('#addApp').click(function(){
	if($('#addname').val()=='' || $('#addurl').val()=='') {
		alert('还未输入应用名称或下载地址！');
		return false;
	}
	
	var url = $(this).attr('href');
	var user_id = $('#userId').text();
	var app_id = $('#addname').val();
	var name = $('#addname :selected').text();
	var download = $('#addurl').val();
	var data = {
		'user_id' : user_id,
		'app_id' : app_id,
		'name' : name,
		'download' : download
	};
	$.post(url,data,function(d){
		$.post("<?=uri_string()?>", function(data) {
				$('#content').html(data);	
			});	
		alert(d);	
	});
	return false;
});// end

$('.deleteApp').click(function(){
	if(confirm("您确定要删除该用户应用吗？")) {
		var url = $(this).attr('href');
		$.get(url,function(data) {
			$.post("<?=uri_string()?>", function(data) {
				$('#content').html(data);	
			});	
			alert(data);
		});
	}
	return false;
}); // end click

$('form').submit(function(){
	var url = $(this).attr('action');
	url = url + "?fxsxxx344=" + Math.random();
	var $data = $(this).serialize();
	$.post(url, $data, function(data){
		alert(data);
	});
	
	if($('#addname').val()!='' &&  $('#addurl').val()!='') {
		alert('需要添加数据要按右边的"添加"按钮！');
	}
	return false;
}); // end from submit

$('input').filter('.name').each(function(index, element) {
	var textValue = $(this).val();
    $('.appname').each(function(){
			if( $(this).text() == textValue) {
				$(this).remove();
			}
		});
});
</script>