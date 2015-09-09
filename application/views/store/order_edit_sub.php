<?php require_once VIEWPATH.'_templates/_header.php' ?>
<section class="container text-center">
	<form class="form-inline" method="post">
		<div class="form-group">
	    <label>顏色</label>
	    <input type="text" name="color" class="form-control" value="<?php echo $query->color?>">
	  </div>
	  <div class="form-group">
	    <label>尺寸</label>
	    <input type="text" name="size" class="form-control" value="<?php echo $query->size?>">
	  </div>
	  <div class="form-group">
	    <label>數量</label>
	    <input type="number" name="amount" class="form-control" value="<?php echo $query->amount?>">
	  </div>
	  <div class="form-group">
	    <label>單價</label>
	    <input type="number" name="price" class="form-control" value="<?php echo $query->price?>">
	  </div>
	  <button type="submit" class="btn btn-primary">送出</button>
	</form>
	<hr>
	<img src="<?php echo  base_url($image)?>" class="img-responsive" style="margin:0 auto;">
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
