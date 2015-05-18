<?php @require_once VIEWPATH.'_templates/_header.php';?>

<article class="container">
	<section class="row">

		<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">檔案位置</label>
		    <div class="col-sm-9">
	        <input class="form-control" type="file" name="userfile" />
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary btn-lg">送出</button>
		    </div>
		  </div>
		</form>

	</section>
</article>

<?php @require_once VIEWPATH.'_templates/_footer.php';?>