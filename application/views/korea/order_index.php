<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">訂單管理</h2>
<section class="container text-center">
	<?php if (isset($data)): ?>
		<div class="alert alert-info" role="alert">
			<h3 style="margin:0;">搜尋: </h3>
			<?php if (isset($data['opt1'])): ?>
				<p>日期: <?php echo $data['start_date']?> ~ <?php echo $data['end_date']?></p>
			<?php endif ?>	
			<?php if (isset($data['opt2'])): ?>
				<p>處理狀態: <?php echo  $data['state_id']?></p>
			<?php endif ?>
			<?php if (isset($data['opt3'])): ?>
				<p>關鍵字: <?php echo  $data['keyword']?></p>
			<?php endif ?>
		</div>
	<?php endif ?>
	<a href="<?php echo base_url('korea/order/search')?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> 搜尋</a>	
	<a href="<?php echo base_url('korea/order/all_unsend')?>" class="btn btn-warning pull-right" style="margin:0 20px;">查看所有未送</a>
	<br><br>
	<table class="table table-hover">
		<tr class="info">
			<td>時間</td>
			<td>公司</td>
			<td>聯絡人</td>
			<td>訂單單號</td>
			<td>金額</td>
			<td>手續費</td>
			<td>處理狀況</td>
			<td>未送</td>
			<td>跨號集單</td>
			<td>詳細情況</td>
			<td>刪除</td>
		</tr>
		<?php foreach ($orders as $key => $value): ?>
			<tr>
				<td><?php echo  $value->create_time?></td>
				<td><?php echo  $value->company?></td>
				<td><?php echo  $value->user_name?></td>
				<td><?php echo  $value->order_id?></td>
				<td class="text-danger">$ <?php echo  number_format($value->total_price)?></td>
				<?php if ($value->total_price > 100000000): ?>
					<?php $fee = $value->total_price * 0.06 ?>
				<?php endif ?>
				<?php if ($value->total_price <= 100000000 && $value->total_price > 5000000): ?>
					<?php $fee = $value->total_price * 0.07 ?>
				<?php endif ?>
				<?php if ($value->total_price <= 5000000): ?>
					<?php $fee = $value->total_price * 0.08 ?>
				<?php endif ?>
				<td class="text-success">$ <?php echo  number_format($fee)?></td>
				<td><?php echo  $value->state_name?></td>
				<td style="color:red;"><?php echo  ($value->unsend > 0) ? $value->unsend : ''?></td>
				<td>
					<?php if ($value->cross): ?>
						<span class="glyphicon glyphicon-ok"></span>
					<?php endif ?>
				</td>	
				<td><a href="<?php echo  base_url('korea/order/detail/'.$value->order_id)?>" class="btn btn-success">詳細狀況</a></td>
				<td><a href="javascript:if(confirm('確定要刪除此訂單？'))location.href='<?php echo  base_url('korea/order/delete/'.$value->order_id)?>'" class="btn btn-danger">X</a></td>	
			</tr>
		<?php endforeach ?>
	</table>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
