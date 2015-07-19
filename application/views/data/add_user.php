<form action="user/doAddUser" method="post">
<p class="nav">当前位置： 添加会员</p>
<table border="1">
	<tr>
    	<td>用户名：</td>
        <td><input type="text" name="username" class="text" placeholder="请输入用户名" required id="username" /><span class="ts">*必填</span></td>
    </tr>
    <tr>
    	<td>密　码：</td>
        <td><input type="password" name="password"  class="text" placeholder="请输入用户密码" required  /><span class="ts">*必填</span></td>
    </tr>
    <tr>
    	<td>真实姓名：</td>
        <td>
        	<input type="text" name="realname"  class="text" placeholder="请输入用户的真实姓名" />
        </td>
    </tr>
    <tr>
    	<td>银行账号：</td>
        <td><input type="text" name="bank_accument"  class="text" title="银行账号" placeholder="请输入用户银行账号"  />
        	<input type="text" name="bank_name" class="text" style="width:100px" title="银行名称" placeholder="请输入银行名称" />
        </td>
    </tr>
    <tr>
    	<td>添加应用：</td>
        <td>
        	<table>
            	<caption style="margin-bottom:10px;text-align:left;color:red;font-size:12px;">
                	<p>提示：</p>
                    <p>1、修改下列默认应用列表请到<b>“应用管理”</b>里面修改！</p>
                    <p>2、添加会员后，可在<b>“会员管理 >> 修改”</b>里面进行针对该会员信息和应用的增、改、删等操作!</p>
                </caption>
            	<tr>
                	<th><input type="checkbox" id="selectAll" /></th>
                	<th>名称</th>
                    <th>下载地址</th>
                    <th>操作</th>
                </tr>
                <?php foreach ($appname as $item): ?>
                <tr>
                	<td><input type="checkbox" class="select"/></td>
                	<td class="app_name">
                    	<label>
							<input type="hidden" name="id[]" value="<?=$item['id']?>" />
							<input type="text" name="name[]" value="<?=$item['name']?>"   class="text" readonly />
                        </label>
                        
                    </td>
					<td> <input type="text" name="download[]"   class="text downUrl" placeholder="请输入应用下载地址"  /></td>
                    <td><a href="#" class="delete">删除</a></td>
                </tr>
                <?php endforeach ?>
            </table> <!-- /内嵌表格 -->
        </td>
    </tr>
    <tr>
        <td colspan="2"  class="bottom"><input type="submit" value="确认添加" class="btn" id="add" /><input type="reset" value="重　置" class="btn" /></td>
    </tr>
</table>
</form>
<script>
$('#selectAll').click(function(){
	if(this.checked) {
		$('.select').each(function(){
			this.checked = true;
		});
	} else {
		$('.select').each(function(){
			this.checked = false;
		});
	}
}); // end click
$('.delete').click(function(){
	$(this).parent().parent().remove();	
	return false;
}); // end click

$('form').submit(function(){
	$('.select').each(function(index,element){
		if (!this.checked) {
			$(this).parent().parent().remove(); // 移出未选项目
		}
	});// end each
	
	var url = $(this).attr('action');
	var $data = $(this).serialize();
	$.post(url, $data, function(data){
		$.post("<?=uri_string()?>", function(data) {
				$('#content').html(data);	
		});	
		alert(data);
	});
	return false;
}); // end from submit

$('#username').blur(function(){
	var $this = $(this);
	var $data = {  'username' : $this.val() };
	$.post('user/doCheckSameUserName?fdsx=' + Math.random(),$data, function(data){	
		if(data =='false') {
			alert('已存在相同的用户名，请重新填写！');
		}
	});	
});// end blur
</script>