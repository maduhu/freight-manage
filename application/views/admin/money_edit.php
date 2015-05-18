<?php require_once VIEWPATH.'_templates/_header.php' ?>
<h2 class="text-center">金額明細編輯</h2>
<section class="container">
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">日期</label>
    <div class="col-sm-9">
      <input type="date" name="date" class="form-control" value="<?= $query->date?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">公司</label>
    <div class="col-sm-9">
      <select name="user_id" class="form-control">
      	<?php foreach ($users as $value): ?>
          <?php if ( $value->user_id == $query->user_id): ?>
            <option value="<?= $value->user_id?>" selected><?= $value->company?></option>  
            <?php continue ?>
          <?php endif ?>
      		<option value="<?= $value->user_id?>"><?= $value->company?></option>
      	<?php endforeach ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">存入金額</label>
    <div class="col-sm-9">
      <input type="number" name="save_money" class="form-control" value="<?= $query->save_money?>">
    </div>
  </div>
  <div class="form-group">
    <label for="" class="col-sm-2 control-label">使用金額</label>
    <div class="col-sm-9">
      <input type="number" name="use_money" class="form-control" value="<?= $query->use_money?>">
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
