<?php require_once VIEWPATH.'_templates/_header.php' ?>
<section class="container text-center">
	<form class="form-inline" method="post">
	  <div class="form-group">
	    <label>數量</label>
	    <input type="number" name="amount" class="form-control" value="<?=$query->amount?>">
	  </div>
	  <div class="form-group">
	    <label>單價</label>
	    <input type="number" name="price" class="form-control" value="<?=$query->price?>">
	  </div>
	  <button type="submit" class="btn btn-primary">送出</button>
	</form>
	<hr>
	<img src="<?= base_url($image)?>" class="img-responsive" style="margin:0 auto;">
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
