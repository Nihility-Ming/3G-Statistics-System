<style>
	table td {
		text-align:center;
	}
	table caption input {
		margin:0 10px;
		margin-left:4px;
	}
</style>
<table>
	<caption style="text-align:left;margin-bottom:10px;">按日期筛选：<input type="text" id="start" / onClick="WdatePicker()" class="Wdate">至<input type="text" id="end" onClick="WdatePicker()" class="Wdate" /><input type="button" value="确认" id="godate" /> <a href="#" id="showall">全部显示</a></caption>
	<tr>
    	<th>日期</th>
        <th>数量</th>
        <th>操作</th>
    </tr>
    <?php if(!$tb_date): ?>
    <tr>
    	<td colspan="3" style="color:#999;text-align:center;">该用户应用还未添加日期和数量！</td>
    </tr>
    <?php else: ?>
    
    <?php foreach($tb_date as $key => $item):?>
    <tr style="text-align:center">
        <td><?=$item['date']?></td>
        <td><?=$item['amount']?></td>
        <td>
        	<a href="#" class="edit">修改</a> | <a href="user/deleteUserDataNum/<?=$item['id']?>"  

class="delete">删除</a>
        </td>
    </tr>
     <tr style="display:none" class="xg">
        <td><?=$item['date']?></td>
        <td><input type="text" name="amount" value="<?=$item['amount']?>" style="width:50px"/></td>
        <td>
        	<a href="user/changeUserDataNum/<?=$item['id']?>" class="save">保存</a> | <a 

href="user/deleteUserDataNum/<?=$item['id']?>" class="delete">删除</a>
        </td>
    </tr>
    <?php endforeach ?>
    <?php endif ?>
    <tr class="xg">
    	<td  style="text-align:center">
        	<input type="hidden" name="user_id" value="<?=$user_id?>" />
            <input type="hidden" name="app_id" value="<?=$app_id?>" />
        	<input type="text" name="date" style="width:150px" onclick="WdatePicker()"/>
        </td>
        <td  style="text-align:center"><input type="text" name="amount" style="width:50px"/></td>
        <td style="text-align:center">
        	<a href="user/addUserDataNum" class="add">添加</a>
        </td>
    </tr>
</table>
<script>

$('.edit').click(function(){
	$(this).parent().parent().hide();
	$(this).parent().parent().next('.xg').fadeIn(200);
	return false;	
}); //end click

$('.save').click(function(){
	var href = $(this).attr('href');
	var data = $(this).parent().parent().find('input').serialize();
	$.post(href,data);
	$('#showUserDateNum').load("user/showUserDataNum2/<?=$user_id?>/<?=$app_id?>" + "?fjdks=" + Math.random());
	return false;
}); // 保存数据

$('.delete').click(function(){
	var href = $(this).attr('href');
	$.post(href,function(data) {
		alert(data);
	}); // end post
	$('#showUserDateNum').load("user/showUserDataNum2/<?=$user_id?>/<?=$app_id?>" + "?fjdks=" + Math.random());
	return false;	
}); // 删除一条数据

$('.add').click(function(){
	var href = $(this).attr('href');
	var $data = $(this).parent().parent().find('input').serialize();
	$.post(href,$data,function(data){
		alert(data);
	});
	$('#showUserDateNum').load("user/showUserDataNum2/<?=$user_id?>/<?=$app_id?>" + "?fjdks=" + Math.random());
	return false;
}); // 为此用户添加数据
</script>