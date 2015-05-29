<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">搜尋公司</h2>
<section class="container text-center">
	<form action="" class="form-inline" method="post">
		<div class="form-group">
			<label for="">關鍵字</label>
			<input type="text" name="keyword" class="form-control">
		</div>
		<button type="submit" class="btn btn-primary">送出</button>
	</form>
	<hr>
<?php if (isset($query)): ?>
<table class="table table-hover">
		<tr class="success">
			<td>公司名稱</td>
			<td>負責人</td>
			<td>地址</td>
			<td>E-mail</td>
			<td>選擇</td>
		</tr>
	
	<?php foreach ($query as $key => $value): ?>
		<tr>
			<td><?= $value->company?></td>
			<td><?= $value->user_name?></td>
			<td><?= $value->address?></td>
			<td><?= $value->email?></td>
			<td><a href="<?=base_url('korea/money/create/'.$value->user_id)?>" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> </a></td>
		</tr>	
	<?php endforeach ?>
</table>	
<?php endif ?>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
