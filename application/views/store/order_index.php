<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">訂單管理</h2>
<section class="container text-center">
	<?php if (isset($data)): ?>
		<div class="alert alert-info" role="alert">
			<h3 style="margin:0;">搜尋: </h3>
			<?php if (isset($data['opt1'])): ?>
				<p>日期: <?=$data['start_date']?> ~ <?=$data['end_date']?></p>
			<?php endif ?>	
			<?php if (isset($data['opt2'])): ?>
				<p>處理狀態: <?= $data['state_id']?></p>
			<?php endif ?>
			<?php if (isset($data['opt3'])): ?>
				<p>關鍵字: <?= $data['keyword']?></p>
			<?php endif ?>
		</div>
	<?php endif ?>
	<a href="<?=base_url('store/order/search')?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-search"></span> 搜尋</a>	
	<br><br>
	<table class="table table-hover">
		<tr class="success">
			<td>時間</td>
			<td>公司</td>
			<td>聯絡人</td>
			<td>訂單單號</td>
			<td>金額</td>
			<td>手續費</td>
			<td>處理狀況</td>
			<td>詳細情況</td>
		</tr>
		<?php foreach ($orders as $key => $value): ?>
			<tr>
				<td><?= $value->create_time?></td>
				<td><?= $value->company?></td>
				<td><?= $value->user_name?></td>
				<td><?= $value->order_id?></td>
				<td class="text-danger">$ <?= number_format($value->total_price)?></td>
				<td class="text-success">$ <?= $value->total_price * 0.06?></td>
				<td><?= $value->state_name?></td>
				<td><a href="<?= base_url('store/order/detail/'.$value->order_id)?>" class="btn btn-primary">詳細狀況</a></td>
			</tr>
		<?php endforeach ?>
	</table>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
