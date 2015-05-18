<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">會員管理<?if (isset($keyword)) {
	echo " - 搜尋: ".$keyword;
}?></h2>
<section class="container text-center">
	<a href="<?= base_url('admin/user/create')?>" class="btn btn-primary pull-right">新增會員</a>
	<div class="row text-center">
	  <div class="col-lg-4">
		  <form action="<?= base_url('admin/user/search')?>" method="post">
		    <div class="input-group">
		      <input type="text" name="keyword" class="form-control" placeholder="Search for..." value="<?= @$keyword?>">
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
		      </span>
		    </div><!-- /input-group -->
	    </form>
	  </div><!-- /.col-lg-6 -->
	</div><!-- /.row -->
	
	<br>
	<table class="table table-striped">
		<tr class="warning">
			<td>公司名稱</td>
			<td>姓名</td>
			<td>電話</td>
			<td>E-Mail</td>
			<td>編輯</td>
			<td>刪除</td>
		</tr>
		<?php foreach ($users as $key => $value): ?>
			<tr>
				<td><?= $value->company ?></td>
				<td><?= $value->user_name?></td>
				<td><?= $value->telephone?></td>
				<td><?= $value->email?></td>
				<td><a href="<?= base_url('admin/user/edit/'.$value->user_id)?>" class="btn btn-warning">編輯</a></td>
				<td><a href="javascript:if(confirm('確定刪除？'))location.href='<?= base_url('admin/user/delete/'.$value->user_id)?>'" class="btn btn-danger">刪除</a></td>
			</tr>
		<?php endforeach ?>
	</table>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
