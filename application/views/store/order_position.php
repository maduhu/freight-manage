<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">選擇位置</h2>
<section class="container">
<div class="col-xs-4"></div>
<div class="col-xs-4">
<form action="" method="post">
	<select name="position" class="form-control">
		<option value="A">A</option>
		<option value="B">B</option>
		<option value="C">C</option>
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