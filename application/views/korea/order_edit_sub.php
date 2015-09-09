<?php require_once VIEWPATH.'_templates/_header.php' ?>
<section class="container text-center">
	<form class="form-inline" method="post">
		<div class="form-group">
	    <label class="text-danger">狀態</label>
	    <select name="sub_state" class="form-control">
	    	<option value="買" <?php if ($query->sub_state == '買') {echo "selected";}?> >買</option>
	    	<option value="訂" <?php if ($query->sub_state == '訂') {echo "selected";}?> >訂</option>
	    	<option value="結束" <?php if ($query->sub_state == '結束') {echo "selected";}?> >結束</option>
	    </select>
	  </div>
		<div class="form-group">
	    <label class="text-danger">日期</label>
	    <?php  date_default_timezone_set("Asia/Taipei") ?>
	    <input type="date" name="sub_state_date" class="form-control" value="<?php echo ($query->sub_state_date != '0000-00-00') ? $query->sub_state_date : date('Y-m-d')?>">
	  </div>
	  <br><br>
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
	  <br><br>
	  <button type="submit" class="btn btn-primary">送出</button>
	</form>
	<hr>
	<img src="<?php echo  base_url($image)?>" class="img-responsive" style="margin:0 auto;">
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
