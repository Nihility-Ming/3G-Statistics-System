<p class="nav">当前位置： 修改资料包应用</p>
<table>
	<tr>
    	<th>ID</th>
    	<th>应用名称</th>
        <th>资料下载地址</th>
        <th>操作</th>
    </tr>
    <form method="post" action="<?=site_url('user/changePublicApp')?>">
    <?php foreach($data as $key => $item): ?>
	<tr>
    	<td style="text-align:center"><?=++$key?></td>
    	<td>
        	<input type="text" class="text ssname" value="<?=$item['name']?>" name="name[]" />
            <input type="hidden" value="<?=$item['id']?>" name="id[]" />
        </td>
        <td><input type="text" class="text downUrl" value="<?=$item['download']?>" name="download[]" /></td>
        <td><a href="user/deletePublicApp" class="deleteApp">删除</a></td>
    </tr>
    <?php endforeach ?>
    <tr style="background-color:#D3EEFE">
    	<td></td>
        <td><input type="text" class="text" id="add_name" placeholder="添加应用名称" /></td>
        <td><input type="text" class="text downUrl" id="add_download" placeholder="添加应用下载地址" /></td>
        <td><a href="user/addPublicApp" id="addApp">添加</a></td>
    </tr> <!-- 添加应用-->
    <tr>
    <td colspan="4"  class="bottom">
        <input type="submit" value="修　改" class="btn" />
        <input type="reset" value="重　置" class="btn" />
    </td>
    </tr>
    </form>
</table>	
<span id="fff"></span>
<script>
$('form').submit(function(){
	var $this = $(this);
	var url = $this.attr('action');
	var data = $this.serialize();
	$.post(url,data,function(d){
		alert(d);	
	}); // end post
	return false;	
});

$('#add_name').blur(function(){
	var $this = $(this);
	$('.ssname').each(function(index, element) {
        if(element.value == $this.val()) {
			alert('已经存在相同名称的应用了，请不要再添加！');
			$this.val('');
		}
    });
}); // end blur

$('#addApp').click(function(){
	if( $('#add_name').val()=='' || $('#add_download').val()=='' ) {
		alert('请先填写表单！');
		return false;
	}
	var $url= $(this).attr('href');
	var $data = {
			'name' : $('#add_name').val(),
			'download' : $('#add_download').val()
		};
	$.post($url, $data, function(data) {
		$.post("<?=uri_string()?>", function(data) {
			$('#content').html(data);	
		});	
		alert(data);	
	});
	return false;	
});

$('.deleteApp').click(function(){
		if(confirm('你确定要山删除该应用吗？')) {
			var $this = $(this);
			var parent_tr = $this.parent().parent(); // tr
			var $url= $this.attr('href');
			var $data = {
				'id' : parent_tr.find('input:hidden').val(),
				'name' : parent_tr.find('.ssname').val()
			}; // 获得将要删除的ID
			$.post($url, $data, function(data) {
				$.post("<?=uri_string()?>", function(data) {
					$('#content').html(data);	
				});	
				alert(data);		
			});
	}
	return false;
});
</script>