<?php require_once VIEWPATH.'_templates/_header.php' ?>
<section class="container">
<div class="col-xs-4"></div>
<div class="col-xs-4">
<form action="" method="post">
	<select name="state_id" class="form-control">
	<?php foreach ($states as $key => $value): ?>
		<?php if ($value->state_id == $query->state_id): ?>
			<option value="<?=$value->state_id?>" selected><?=$value->state_name?></option>	
			<?php continue ?>
		<?php endif ?>
		<option value="<?=$value->state_id?>"><?=$value->state_name?></option>
	<?php endforeach ?>
	</select>
	<br>
	<div class="text-center">
		<button type="submit" class="btn btn-primary">送出</button>
	</div>
</form>
</div>
<div class="col-xs-4"></div>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
