<style>
	table td {
		font-size:12px;
	}
	.serach_p {
		margin-bottom:10px;
	}
	table tr:hover{
		color:red;
	}
</style>
<p class="nav">当前位置： 会员管理</p>
<p class="serach_p">搜索真实姓名：<input type="text" placeholder="请输入用户的真实姓名" id="search_text" class="text" /><input type="button" value="搜索"  id="search_btn"  class="btn" /><a href="#" id="showAll">全部显示</a></p>
<table border="1" class="even_bg_color">
    <tr>
        <th>ID</th>
        <th>用户名</th>
        <th>密码</th>
        <th>姓名</th>
        <th>银行名称</th>
        <th>银行卡号</th>
        <th>开通日期</th>
        <th colspan="4">操作</th>
    </tr>
    <?php foreach($rst as $item): ?>
    <?php if($item['type'] != '1'): ?>
    <tr>
        <td style="text-align:center"><?=$item['id']?></td>
        <td><?=$item['username']?></td>
        <td><?=$item['password']?></td>
        <td class="real_name"><?=$item['realname']?></td>
        <td><?=$item['bank_name']?></td>
        <td><?=$item['bank_accument']?></td>
        <td><?=$item['join_date']?></td>
        <td><a href="<?="user/showUserDataNum/" . $item['id']?>" class="userapp">数据</a></td>
        <td><a href="<?=site_url("user/showUserMoney/" . $item['id'])?>" class="money">结算</a></td>
        <td><a href="<?=site_url("user/showChangeUser/" . $item['id'])?>" class="edit">修改</a></td>
        <td><a href="<?=site_url("user/deleteUser/" . $item['id'])?>" class="delete">删除</a></td>
    </tr>
    <?php endif ?>
    <?php endforeach ?>
    <tr>
    	<td class="bottom"  colspan="11">共有注册会员：<?=count($rst)?>名</td>
    </tr>
</table>
<script>
$('.even_bg_color tr:even').css('background-color','#eee');
$('.edit,.money,.userapp').click(function(){
	var thisHref= $(this).attr('href');
	$('#content').load(thisHref + "?fafa=" + Math.random());
	return false;
});

$('.delete').click(function(){
	if(confirm("你确认要删除该用户吗？")) {
		var thisHref= $(this).attr('href');
		$.post(thisHref,function(data){
			$.post("<?=uri_string()?>", function(data) {
				$('#content').html(data);	
			});	
			alert(data);
		});
	}
	return false;	
}); //end click

// 搜索真实姓名
$('#search_btn').click(function(){
	var text = $('#search_text').val();
	$('table tr').show();
	if(text != '') {
		$('.real_name').each(function(index, element) {
			if($(this).text() != text) {
				$(element).parent().hide();
			} // 隐藏tr
		}); // 遍历真实姓名
	} // end if
}); // end click
$('#showAll').click(function(){
	$('table tr').show();
	return false;
}); //end click

</script>