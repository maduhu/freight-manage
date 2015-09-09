<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">留言</h2>
<section class="container">
	<form action="" method="post">
		<div class="form-group">
			<label for="" class="">留言</label>
			<textarea name="korea_message" id="" cols="30" rows="10" class="form-control"><?php echo  $korea_message?></textarea>
		</div>
		<div class="form-group text-center">
			<button class="btn btn-primary" type="submit">送出</button>
		</div>
	</form>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
