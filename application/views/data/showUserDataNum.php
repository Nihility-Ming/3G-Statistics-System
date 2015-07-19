<!-- $user 用户一维数组 -->
<!-- $app 应用二维数组 -->
<style>
#tbody {
	border-top:1px solid #ccc;
}
.xg input {
	text-align:center;
	line-height:23px;
	height:23px;
}
table td {
	text-align:center;
}
table caption input {
	margin:0 10px;
}
.num {
	width:50px;
	text-align:center;
}
#goToAdd:hover {
	background-color:#066;
}
#godate {
	padding:2px 20px;
}

</style>

<p class="nav">当前位置： 会员管理 &gt;&gt; 应用数据</p>
<table style="margin-bottom:10px;border-radius:10px;" border="1" class="userinfo">
	<tr>
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
<form action="user/addUserDataNum" method="post">
<input type="hidden" name="user_id" value="<?=$user['id']?>" />
<p style="margin-bottom:10px;color:blue;font-weight:bold;">请选择应用：
    <select name="app_id" id="select_app">
        <?php foreach($app as $item): ?>
        <option value="<?=$item['id']?>"><?=$item['name']?></option>
        <?php endforeach ?> <!-- 应用表 -->
    </select>
</p>
<table  id="list">
	<caption style="text-align:left;margin-bottom:10px;">
    	<b style="color:blue;">设置时间段</b>：<input type="text" id="start" onClick="WdatePicker()" class="Wdate" placeholder="请选择开始日期" />
        至<input type="text" id="end" onClick="WdatePicker()" class="Wdate" placeholder="请选择结束日期"   />
        <input type="button" value="设　置" id="godate" />
	</caption>
	<tr>
    	<th>日期</th>
        <th>数量</th>
        <th>消费值</th>
        <th>收入</th>
    </tr>
    <tbody id="tbody">
    </tbody>
    <tr>
    	<th>总计：</th>
        <th id="sumNum"></th>
        <th id="sumPrice"></th>
        <th id="sumIncome"></th>
    </tr>
</table>
</form>
<p style="text-align:center;margin-top:20px;"><input type="button" value="修　改" class="btn" id="change" /><input type="button" value="返　回" class="btn" id="back" /></p>
<script>
// 设置值时间段
$('#godate').bind('click', function(){
	
	var $data = {
		'user_id' : '<?=$user['id']?>', 
		'app_id' : $('#select_app').val(),
		'start_date' : $('#start').val(),
		'end_date' : $('#end').val()
	};
	
	var $url = 'user/setStepTime?f125d=' + Math.random();
	$.post($url, $data, function(data) {
		$('#tbody').html(data); // 填充数据到#tbody
		doSum(); //更新统计
	}); // 设置时间成功后响应
	
}); // end 设置时间段


$('#back').click(function(){
	$('#content').load("user/showCheckUser" + "?fdsgds=" + Math.random());
});

$('.userinfo td:even').css('background-color','#eee');


$('form').submit(function(){
	var url = $(this).attr('action');
	url = url + "?fds344=" + Math.random();
	var $data = $(this).serialize();
	$.post(url, $data, function(data){
		alert(data);
	});
	return false;
}); // end from submit

$('#tbody').load('user/selectAppDateNum/<?=$user['id']?>/' + $('#select_app').val() +'?fd=' + Math.random(),function(){
	doSum(); //更新统计
});
$('#select_app').change(function(){
		$('#tbody').load('user/selectAppDateNum/<?=$user['id']?>/' + $('#select_app').val() +'?fxd=' + Math.random(),function(){
	doSum(); //更新统计
});
}); // end select_app change event

$('#change').click(function(){
	// 判断是否有应用，没有则跳转
	if ( !$('#select_app').val() ) {
		alert('请先添加应用！');
		$('#content').load("user/showChangeUser/<?=$user['id']?>?ninfds=" + Math.random() );
		return false;
	}
	var $data = $('#tbody td input').serialize();
	$.post('user/changeAppDateNum/<?=$user['id']?>/' + $('#select_app').val(), $data, function(data){
		alert(data);
	}); // end post
	return false;
}); // end click

/*
$('#godate').click(function(){
		'user/selectAppDateNum/<?=$user['id']?>/' + $('#select_app').val() +'?fd=' + Math.random()
}); // end click
*/


// 统计功能
function jisuan(name, printVar) {
	var value = 0;
	$('input[name="' + name +'"]').each(function(index, element) {
		if(element.value!= '') value += parseFloat(element.value);
	});
	$('#'+ printVar).text(value);	
}

function doSum() {
	jisuan('camount[]', 'sumNum');
	jisuan('cprice[]', 'sumPrice');
	jisuan('cincome[]', 'sumIncome');
	
	// 激活输入时改变统计值
	$('input[name="camount[]"]').keyup(function(){
		jisuan('camount[]', 'sumNum');
	});
	$('input[name="cprice[]"]').keyup(function(){
		jisuan('cprice[]', 'sumPrice');
	});
	$('input[name="cincome[]"]').keyup(function(){
		jisuan('cincome[]', 'sumIncome');
	});
}

</script>