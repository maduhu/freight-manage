<?php require_once VIEWPATH.'_templates/_header.php' ?>
<section class="container text-center">
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">公司名稱</label>
    <div class="col-sm-10">
      <input type="text" name="company" class="form-control" value="<?php echo  $query->company ?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">姓名</label>
    <div class="col-sm-10">
      <input type="text" name="user_name" class="form-control" value="<?php echo  $query->user_name?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">地址</label>
    <div class="col-sm-10">
      <input type="text" name="address" class="form-control" value="<?php echo  $query->address?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">電話</label>
    <div class="col-sm-10">
      <input type="text" name="telephone" class="form-control" value="<?php echo  $query->telephone?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
      <input type="text" name="email" class="form-control" value="<?php echo  $query->email?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">帳號</label>
    <div class="col-sm-10">
      <input type="text" name="account" class="form-control" value="<?php echo  $query->account?>" required>
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">密碼</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" value="<?php echo $query->password?>" required>
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
