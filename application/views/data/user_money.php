<!-- $user 用户一维数组 -->
<!-- $money 结算二维数组 -->
<style>
table td {
	padding:0px;
	font-size:12px;
}
.xg input {
	text-align:center;
	line-height:23px;
	height:23px;
}
.list tr {
	border-bottom:1px solid #ccc;
}
.list tr:last-child {
	border-bottom:none;
}
.user td {
	font-size:14px;
}
</style>
<p class="nav">当前位置： 会员管理 &gt;&gt; 结算中心 &gt;&gt; <?=$user['username']?></p>
<table style="margin-bottom:10px;border-radius:10px;" border="1" class="userinfo">
	<tr class="user">
    	<td style="font-weight:bold">ID:</td>
        <td style="color:red"><?=$user['id']?></td>
        <td style="font-weight:bold">用户名</td>
        <td style="color:red"><?=$user['username']?></td>
        <td style="font-weight:bold">真实姓名</td>
        <td style="color:red"><?=$user['realname']?></td>
        <td style="font-weight:bold">银行名称</td>
        <td style="color:red"><?=$user['bank_name']?></td>
        <td style="font-weight:bold">银行卡号</td>
        <td style="color:red"><?=$user['bank_accument']?></td>
    </tr>
</table> <!-- end 用户简介-->

<table class="list">
	<tr>
    	<th>金额</th>
        <th>手续费</th>
        <th>税后收入</th>
        <th>开户银行</th>
        <th>收款账号</th>
        <th>结算周期</th>
        <th>结算状态</th>
        <th>操作</th>
    </tr>
    <?php if(!$money): ?>
    <tr>
    	<td colspan="8" style="color:#999;text-align:center;">该用户还未产生结算！</td>
    </tr>
    <?php else: ?>
    <?php foreach($money as $key => $item):?>
    <tr style="text-align:center">
    	<td><?=$item['money']?></td>
        <td><?=$item['poundage']?></td>
        <td><?=$item['reality']?></td>
        <td><?=$item['bank_name']?></td>
        <td><?=$item['bank_accument']?></td>
        <td><?=$item['cycle']?></td>
        <td style="color:red;font-weight:bold;"><?=$item['status']?></td>
        <td>
        	<a href="user/changeUserMoney/<?=$item['id']?>" class="edit">修改</a><br /><a href="user/deleteUserMoney/<?=$item['id']?>"  class="delete">删除</a>
        </td>
    </tr>
     <tr style="display:none" class="xg">
    	<td><input type="text" name="money" value="<?=$item['money']?>" style="width:50px"/></td>
        <td><input type="text" name="poundage" value="<?=$item['poundage']?>" style="width:50px"/></td>
        <td><input type="text" name="reality" value="<?=$item['reality']?>" style="width:50px"/></td>
        <td><input type="text" name="bank_name" value="<?=$item['bank_name']?>" style="width:60px"/></td>
        <td><input type="text" name="bank_accument" value="<?=$item['bank_accument']?>" style="width:130px"/></td>
        <td><input type="text" name="cycle" value="<?=$item['cycle']?>" style="width:165px"/></td>
        <td><input type="text" name="status" value="<?=$item['status']?> " style="width:50px"/></td>
        <td>
        	<a href="user/changeUserMoney/<?=$item['id']?>" class="save">保存</a><br /><a href="user/deleteUserMoney/<?=$item['id']?>" class="delete">删除</a>
        </td>
    </tr>
    <?php endforeach ?>
    <?php endif ?>
    <tr class="xg">
    	<td>
        	<input type="hidden" name="id" value="<?=$user['id']?>" />
        	<input type="text" name="money" style="width:50px" />
        </td>
        <td><input type="text" name="poundage" style="width:50px"/></td>
        <td><input type="text" name="reality" style="width:50px"/></td>
        <td><input type="text" name="bank_name" style="width:60px"/></td>
        <td><input type="text" name="bank_accument" style="width:130px"/></td>
        <td><input type="text" name="cycle" style="width:165px" placeholder="yyyy-mm-dd至yyyy-mm-dd" /></td>
        <td><input type="text" name="status" style="width:50px"/></td>
        <td style="text-align:center">
        	<a href="user/addUserMoney" class="add">添加</a>
        </td>
    </tr>
</table>
<p style="text-align:center;margin-top:20px;"><input type="button" value="返　回" class="btn" id="back" /></p>
<script>

$('#back').click(function(){
	$('#content').load("user/showCheckUser" + "?fdsgds=" + Math.random());
});


$('.userinfo td:even').css('background-color','#eee');
$('.edit').click(function(){
	$(this).parent().parent().hide();
	$(this).parent().parent().next('.xg').fadeIn(200);
	return false;	
}); //end click

$('.save').click(function(){
	var href = $(this).attr('href');
	var data = $(this).parent().parent().find('input').serialize();
	$.post(href,data,function(data){
		$.post("<?=uri_string()?>", function(data) {
				$('#content').html(data);	
			});		
	});
	return false;
}); // 保存数据

$('.delete').click(function(){
	if(confirm("您确定要删除这条结算记录吗？")) {
		var href = $(this).attr('href');
		$.post(href,function(data) {
			$.post("<?=uri_string()?>", function(data) {
				$('#content').html(data);	
			});	
			alert(data);
		}); // end post
	}
	return false;	
}); // 删除一条数据

$('.add').click(function(){
	var href = $(this).attr('href');
	var $data = $(this).parent().parent().find('input').serialize();
	$.post(href,$data,function(data){
		$.post("<?=uri_string()?>", function(data) {
				$('#content').html(data);	
			});	
		alert(data);
	});
	return false;
}); // 为此用户添加数据

</script>