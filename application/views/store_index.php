<?php require_once VIEWPATH.'_templates/_header.php' ?>
<section class="container">
<div class="panel panel-primary">
  <div class="panel-heading">使用者登入</div>
  <div class="panel-body">
    <form class="form-horizontal" method="post">
		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">帳號</label>
		    <div class="col-sm-10">
		      <input type="text" name="account" class="form-control" >
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="" class="col-sm-2 control-label">密碼</label>
		    <div class="col-sm-10">
		      <input type="password" name="password" class="form-control" >
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <input type="submit" class="btn btn-primary" value="登入">
		    </div>
		  </div>
		</form>
  </div>
</div>

</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
