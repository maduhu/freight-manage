<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">金額明細紀錄</h2>
<?php date_default_timezone_set("Asia/Taipei"); ?>
<section class="container text-center">
	<?php if (isset($data)): ?>
		<div class="alert alert-info" role="alert">
			<h3 style="margin:0;">搜尋: </h3>
			<?php if (isset($data['opt1'])): ?>
				<p>日期: <?=$data['start_date']?> ~ <?=$data['end_date']?></p>
			<?php endif ?>	
			<?php if (isset($data['opt2'])): ?>
				<p>公司: <?= $data['company_name']?></p>
			<?php endif ?>
			<?php if (isset($data['opt3'])): ?>
				<p>關鍵字: <?= $data['keyword']?></p>
			<?php endif ?>
		</div>
	<?php endif ?>
	<a href="<?=base_url('admin/money/search')?>" class="btn btn-primary pull-right">搜尋</a>	
	<br><br>

	<table class="table table-striped">
		<tr>
			<td>日期</td>
			<td>公司</td>
			<td>入帳金額</td>
			<td>使用金額</td>
			<td>存金</td>
			<td>kg</td>
			<td>使用明細</td>
			<td>編輯</td>	
			<td>刪除</td>
		</tr>
		<?php $temp = []?>
		<?php foreach ($moneys as $value): //計算有幾個使用者，把PK存進來?>
			<?php if ( ! in_array($value->user_id, $temp)): ?>
				<?php array_push($temp, $value->user_id) ?>
			<?php endif ?>
		<?php endforeach ?>

		<?php $total = 0 ?>
		<?php $balance = 0; // 結餘?>
		<?php for ($i = 0; $i < count($temp); $i++): //計算所有結餘?>
			<?php foreach ($moneys as $value): ?>
				<?php if ( $value->user_id == $temp[$i]): ?>
					<?php $value->balance = $balance + $value->save_money - $value->use_money;?>
					<?php $balance = $value->balance;?>
				<?php endif ?>	
			<?php endforeach ?>
			<?php $total += $balance;?>
			<?php $balance = 0;?>
		<?php endfor ?>

		<?php foreach ($moneys as $value): ?>
			<tr>
				<td><?= $value->date?></td>
				<td><?= $value->company?></td>	
				<td class="text-success"><?= number_format($value->save_money)?></td>	
				<td class="text-info"><?= number_format($value->use_money)?></td>	
				<td class="text-danger"><?= number_format($value->balance)?></td>
				<td><?= $value->kg?></td>	
				<td><?= $value->detail?></td>
				<td><a href="<?= base_url('admin/money/edit/'.$value->money_id)?>" class="btn btn-warning">編輯</a></td>
				<td><a href="javascript:if(confirm('確定要刪除嗎？'))location.href='<?= base_url('admin/money/delete/'.$value->money_id)?>'" class="btn btn-danger">刪除</a></td>
			</tr>
		<?php endforeach ?>
	</table>
	<h3 class="text-center">結餘：<?=number_format($total)?></h3>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
