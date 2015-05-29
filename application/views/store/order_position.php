<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">選擇位置</h2>
<section class="container">
<div class="col-xs-4"></div>
<div class="col-xs-4">
<form action="" method="post">
	<select name="position" class="form-control">
		<option value="A" <?if ($query->position == 'A') {echo 'selected';} ?> >A</option>
		<option value="B" <?if ($query->position == 'B') {echo 'selected';} ?> >B</option>
		<option value="C" <?if ($query->position == 'C') {echo 'selected';} ?> >C</option>
	</select>
	<br>
	<label for="">位置描述</label>
	<input type="text" name="position_desc" class="form-control" placeholder="例如 2F-2" value="<?=$query->position_desc?>">
	<br>
	<div class="text-center">
		<button type="submit" class="btn btn-primary">送出</button>
	</div>
</form>
</div>
<div class="col-xs-4"></div>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>