<?php require_once VIEWPATH.'_templates/_header.php' ?>
<script src="<?=base_url('assets/js/dropzone.js')?>"></script>
<h2 class="text-center">訂單詳情</h2>
<section class="container">
<?php if ( $query[0]->state_id == 1): ?>
	<div class="dropz well text-center" style="border:2px dashed;">
		<p>多圖片拖曳上傳</p>
		<p>drop in here to upload.</p>	
	</div>
<?php endif ?>
	<?php $price_total = 0;?>
	<?php foreach ($query as $key => $value): ?>
		<div class="row">
			<div class="col-xs-4">
				<img src="<?= base_url($value->image)?>" class="img-responsive">
			</div>
			<div class="col-xs-8">
			<?php if ( $query[0]->state_id == 1): ?>
				<a href="<?= base_url('store/order/detail_delete_img/'.$value->order_img_id.'/'.$query[0]->order_id)?>" class="btn btn-danger pull-right">刪除整筆子訂單</a><br><br>
			<?php endif ?>
				<table class="table table-hover">
					<tr class="success">
						<td>顏色</td>	
						<td>尺寸</td>
						<td>數量</td>
						<td>金額</td>
						<td>總金額</td>
					<?php if ( $query[0]->state_id == 1): ?>
						<td>編輯</td>
						<td>刪除</td>
					<?php endif ?>
					</tr>
					<?php $price = 0; ?>
					<?php foreach ($value->order_subs as $sub): ?>
						<tr>
							<td><?= $sub->color?></td>
							<td><?= $sub->size?></td>
							<td class="text-info"><?= $sub->amount?></td>
							<td class="text-success"><?= number_format($sub->price)?></td>
							<td class="text-danger"><?= number_format($sub->amount * $sub->price)?></td>	
						<?php if ( $query[0]->state_id == 1): ?>
							<td><a href="<?= base_url('store/order/detail_edit_sub/'.$sub->order_sub_id.'/'.$query[0]->order_id)?>" class="btn btn-warning">編輯</a></td>
							<td><a href="<?= base_url('store/order/detail_delete_sub/'.$sub->order_sub_id.'/'.$query[0]->order_id)?>" class="btn btn-danger">刪除</a></td>
						<?php endif ?>
						</tr>
						<?php $price += $sub->amount * $sub->price ?>
					<?php endforeach ?>
					<?php $price_total += $price ?>
				</table>
			<?php if ( $query[0]->state_id == 1): ?>
				<div class="text-center"><a href="<?=base_url('store/order/detail_create_sub/'.$value->order_img_id.'/'.$query[0]->order_id)?>" class="btn btn-primary">+新增項目</a>	</div>
			<?php endif ?>
				<div class="text-center"><h3>$ <?= number_format($price)?></h3></div>
				<hr>
			<?php if ( $query[0]->state_id == 1): ?>
				<div class="pull-right">
					目前位置: <?= $value->position?> <a href="<?= base_url('store/order/detail_position/'.$value->order_img_id.'/'.$value->order_id)?>" class="btn btn-success">選擇位置</a>
				</div>
			<?php else: ?>
				<p class="pull-right">目前位置: <?= $value->position?></p><br>
			<?php endif ?>
			<?php if ( $query[0]->state_id == 1): ?>
				<a href="<?= base_url('store/order/detail_message/'.$value->order_img_id.'/'.$value->order_id)?>" class="btn btn-warning">留言</a>
			<?php endif ?>
				<div class="well"><?=$value->store_message?></div>
			</div>			
		</div>
		<hr>
	<?php endforeach ?>
	<div class="row">
		<div class="col-xs-4"></div>
		<div class="col-xs-8"><h2 class="text-danger text-center">$ <?= number_format($price_total)?></h2></div>

	</div>
	<!-- <div class="text-center"><a href="javascript:if(confirm('確定要送出訂單了嗎？'))location.href='<?=base_url('store/order/submit')?>'" class="btn btn-primary btn-lg" <?php if(empty($query)){ echo "disabled";}?> >送出訂單</a></div> -->
</section>
<br><br>
<?php if ( $query[0]->state_id == 1): ?>
<script>
  $(".dropz").dropzone({
      url: "<?=base_url('store/order/muti/'.$query[0]->order_id)?>",
      addRemoveLinks: true,
      dictRemoveLinks: "x",
      dictCancelUpload: "x",
      maxFiles: 10,
      maxFilesize: 5,
      acceptedFiles: ".jpg,.jpeg,.gif,.png",
      init: function() {
          this.on("success", function(file) {
          		window.location.reload(); //拖曳更新完自動刷頁
              // console.log("File " + file.name + "uploaded");
          });
      }
  });
</script>
<?php endif ?>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
