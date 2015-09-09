<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">金額明細紀錄 - 搜尋</h2>
<section class="container">
	<form action="" method="post">
		<table class="table table-bordered">
			<tr>
				<td><input type="checkbox" name="opt1" value="1"></td>
				<td>
					<label for="" class="col-xs-2">起始時間</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" name="start_date" value="<?php echo  date('Y-m-d')?>">
					</div>
					<label for="" class="col-xs-2">結束時間</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" name="end_date" value="<?php echo  date('Y-m-d')?>">
					</div>
				</td>
			</tr>
			<tr>
				<td><input type="checkbox" name="opt2" value="1"></td>
				<td>
					<label for="" class="col-xs-2">公司名稱</label>
					<div class="col-xs-10">
						<select name="company" class="form-control">
							<?php foreach ($users as $value): ?>
								<option value="<?php echo $value->user_id?>"><?php echo $value->company?></option>
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