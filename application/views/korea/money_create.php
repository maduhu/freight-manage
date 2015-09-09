<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">金額明細新增</h2>
<section class="container">
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">日期</label>
    <div class="col-sm-9">
    	<?php date_default_timezone_set("Asia/Taipei"); ?>
      <input type="date" name="date" class="form-control" value="<?php echo date('Y-m-d')?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">公司</label>
    <div class="col-sm-8">
      <select name="user_id" class="form-control">
      	<?php foreach ($users as $value): ?>
      		<option value="<?php echo  $value->user_id?>" <?php if($value->user_id == $user_id) echo 'selected'?> ><?php echo  $value->company?></option>
      	<?php endforeach ?>
      </select>
    </div>
    <a href="<?php echo base_url('korea/money/create_search')?>" class="btn btn-warning">搜尋公司</a>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">存入金額</label>
    <div class="col-sm-9">
      <input type="number" name="save_money" class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">使用金額</label>
    <div class="col-sm-9">
      <input type="number" name="use_money" class="form-control" value="0">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">kg</label>
    <div class="col-sm-9">
      <input type="text" name="kg" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">使用明細</label>
    <div class="col-sm-9">
      <input type="text" name="detail" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-primary" value="送出">
    </div>
  </div>
</form>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
