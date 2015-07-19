<!-- $money 结算二维数组 -->
<style>
.xg input {
	text-align:center;
	line-height:23px;
	height:23px;
}
</style>
<p class="nav">当前位置： 查看结算记录</p>
<table>
	<tr>
    	<th>编号</th>
   	  <th>金额</th>
        <th>手续费</th>
        <th>税后收入</th>
        <th>开户银行</th>
        <th>收款账号</th>
        <th>结算周期</th>
        <th>状态</th>
    </tr>
    <?php if(!$money): ?>
    <tr>
    	<td colspan="8" style="color:#999;text-align:center;">您还没有结算记录，请耐心等待。</td>
    </tr>
    <?php else: ?>
    <?php foreach($money as $key => $item):?>
    <tr style="text-align:center">
    	<td><?=++$key?></td>
    	<td><?=$item['money']?></td>
        <td><?=$item['poundage']?></td>
        <td><?=$item['reality']?></td>
        <td><?=$item['bank_name']?></td>
        <td><?=$item['bank_accument']?></td>
        <td><?=$item['cycle']?></td>
        <td style="color:red;font-weight:bold;"><?=$item['status']?></td>
    </tr>
    <?php endforeach ?>
    <?php endif ?>
</table>