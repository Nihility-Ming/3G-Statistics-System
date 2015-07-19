<style>
table td {
	text-align:center;
}
</style>
<p class="nav">当前位置： 应用数据 &gt;&gt; <span id="appname"></span></p>
<table>
	<caption>设置时间段：<input type="text" id="start" onClick="WdatePicker()" placeholder="请设置开始时间" />至<input type="text" id="end" onClick="WdatePicker()" placeholder="请设置结束时间"/><input type="button" value="显　示" id="godate" /></caption>
	<tr>
    	<!-- <th>编号</th> -->
    	<th>日期</th>
        <th>数量</th>
        <th>消费值</th>
        <th>收入</th>
    </tr>
    <tbody id="setTime">
    <?php if(!$arr): ?>
    <tr>
    	<td colspan="4" style="color:#999;text-align:center;">该应用最近7天没有任何数据，请选择时间段进行查询……</td>
    </tr>
    <tbody>
    <?php else: ?>
    <?php foreach($arr as $key => $item):?>
    <tr style="text-align:center">
    	<!-- <td><?=++$key?></td> -->
    	<td class="sdate"><?=$item['date']?></td>
        <td class="sumNum"><?=$item['amount']?></td>
        <td class="sumPrice"><?=$item['price']?></td>
        <td class="sumIncome"><?=$item['income']?></td>
    </tr>
    <?php endforeach ?>
    <tbody>
    <?php endif ?>
    <tr>
    	<!-- <th></th> -->
    	<th>总计：</th>
        <th id="sumNum"></th>
        <th id="sumPrice"></th>
        <th id="sumIncome"></th>
    </tr>
</table>
<style>
caption {
	text-align:left;
	margin-top:10px;
	margin-bottom:20px;
}
caption input {
	line-height:23px;
	height:23px;
	width:auto;
	text-align:center;
	padding-left:10px;
	padding-right:10px;
	margin-left:10px;
	margin-right:10px;
}
</style>
<script>
doSum('sumNum');
doSum('sumPrice');
doSum('sumIncome');
function doSum(varName) {
	var value = 0;
	$('.' + varName).each(function(index, element) {
		if($(this).text()!='')
			{value += parseFloat($(this).text());
			$('#' + varName).text(value);
		}
	});	
};

var $start = $('#start');
var $end = $('#end');
$('#godate').click(function(){
	if($start.val()=='' || $end.val()=='') {
		alert('请先设置时间段！');
		return false;
	}
	if ( $start.val().replace(/-/g,'') > $end.val().replace(/-/g,'') ) {
		alert("开始日期不能大于结束日期！");
		return false;
	}
	var $data = {
		'user_id' : <?=$user_id?>,
		'app_id' : <?=$app_id?>,
		'start_date': $start.val(),
		'end_date': $end.val()
	};
	$.post('user/showUserSetTime?safk'+Math.random(), $data, function(data) {
		$('#setTime').html(data);	
		doSum('sumNum');
		doSum('sumPrice');
		doSum('sumIncome');
	});
	return false;
}); // 设置时间段

$('#appname').text($('a.current').text());
</script>