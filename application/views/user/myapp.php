<style>
.download:link,.download:visited {
	display:inline-block;
	line-height:30px;
	padding:0px 20px;
	color:white;
	background-color:#09C;
	font-weight:bolder;
	text-align:center;
	border-radius:10px;
}
.download:hover {
	background-color:#06F;
}

table td {
	text-align:center;
}
</style>
<p class="nav">当前位置： 应用下载</p>
<table>
	<tr>
    	<th>编号</th>
    	<th>应用名称</th>
        <th>下载地址</th>
        <th>公共资料包</th>
    </tr>
    <?php if( count($d1) > 0 ): ?>
    <?php $i=0; ?>
    <?php foreach($d1 as $key => $item):?>
    <tr>
    	<td><?=++$key?></td>
    	<td><?=$item['name']?></td>
        <td><a href="<?=$item['download']?>" class="download">点击下载</a></td>
        <td><a href="user/downMyPublicApp/<?=$d2[$i++]?>" class="download pub">资料包</a></td>
    </tr>
    <?php endforeach ?>
    <?php else: ?>
    <tr>
    	<td colspan="4" style="padding-top:10px;color:gray">找不到任何应用下载地址，请联系业务员添加！</td>
    </tr>
    <?php endif ?>
</table>
<script>
$('.download').attr('target', '_blank');
</script>