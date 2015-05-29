<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">訂單管理 - 搜尋</h2>
<section class="container">
	<form action="" method="post">
		<table class="table table-bordered">
			<tr>
				<td><input type="checkbox" name="opt1" value="1"></td>
				<td>
					<label for="" class="col-xs-2">起始時間</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" name="start_date" value="<?= date('Y-m-d')?>">
					</div>
					<label for="" class="col-xs-2">結束時間</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" name="end_date" value="<?= date('Y-m-d')?>">
					</div>
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="opt2" value="1"></td>
				<td>
					<label for="" class="col-xs-2">處理狀態</label>
					<div class="col-xs-10">
						<select name="state_id" class="form-control">
							<?php foreach ($states as $value): ?>
								<option value="<?=$value->state_id?>"><?=$value->state_name?></option>
							<?php endforeach ?>
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="opt3" value="1"></td>
				<td>
					<label for="" class="col-xs-2">關鍵字</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="keyword">
					</div>
				</td>
			</tr>
		</table>
		<div class="text-center">
			<button type="submit" class="btn btn-primary">送出</button>
		</div>
	</form>
</section>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>