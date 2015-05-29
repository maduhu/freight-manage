<?php require_once VIEWPATH.'_templates/_header.php' ?>
<script src="<?=base_url('assets/js/dropzone.js')?>"></script>
<script>
	function submit_check() {
		if (confirm('確定要送出訂單了嗎？')) {
			if ( $("#cross").prop("checked") ) {
				location.href='<?=base_url('store/order/submit/1')?>';
			} else {
				location.href='<?=base_url('store/order/submit')?>'
			};
		};
	}
</script>
<section class="container">
	<div class="dropz well text-center" style="border:2px dashed;">
		<p>多圖片拖曳上傳</p>
		<p>drop in here to upload.</p>	
	</div>
	<?php $price_total = 0;?>
	<?php foreach ($query as $key => $value): ?>
		<div class="row" id="<?=$value->order_img_id?>">
			<div class="col-xs-4">
				<img src="<?= base_url($value->image)?>" class="img-responsive">
			</div>
			<div class="col-xs-8">
				<a href="<?= base_url('store/order/delete_img/'.$value->order_img_id)?>" class="btn btn-danger pull-right">刪除整筆子訂單</a><br><br>
				<table class="table table-hover">
					<tr class="success">
						<td>顏色</td>	
						<td>尺寸</td>
						<td>數量</td>
						<td>金額</td>
						<td>總金額</td>
						<td>編輯</td>
						<td>刪除</td>
					</tr>
					<?php $price = 0; ?>
					<?php foreach ($value->order_subs as $sub): ?>
						<tr>
							<td><?= $sub->color?></td>
							<td><?= $sub->size?></td>
							<td class="text-info"><?= $sub->amount?></td>
							<td class="text-success"><?= number_format($sub->price)?></td>
							<td class="text-danger"><?= number_format($sub->amount * $sub->price)?></td>	
							<td><a href="<?= base_url('store/order/edit_sub/'.$sub->order_sub_id)?>" class="btn btn-warning">編輯</a></td>
							<td><a href="<?= base_url('store/order/delete_sub/'.$sub->order_sub_id)?>" class="btn btn-danger">刪除</a></td>
						</tr>
						<?php $price += $sub->amount * $sub->price ?>
					<?php endforeach ?>
					<?php $price_total += $price ?>
				</table>
				<div class="text-center"><a href="<?=base_url('store/order/create_sub/'.$value->order_img_id)?>" class="btn btn-primary">+新增項目</a>	</div>
				<div class="text-center"><h3>$ <?= number_format($price)?></h3></div>
				<hr>
				<div class="pull-right">
					目前位置: <?= $value->position?> - <?=$value->position_desc?> <a href="<?= base_url('store/order/position/'.$value->order_img_id)?>" class="btn btn-success">選擇位置</a>
				</div>
				<a href="<?= base_url('store/order/message/'.$value->order_img_id)?>" class="btn btn-warning">留言</a>
				<div class="well"><?=$value->store_message?></div>
			</div>			
		</div>
		<hr>
	<?php endforeach ?>
	<div class="row">
		<div class="col-xs-4"></div>
		<div class="col-xs-8"><h2 class="text-danger text-center">$ <?= number_format($price_total)?></h2></div>
	</div>
	<div class="checkbox text-center">
	  <label>
	    <input type="checkbox" value="" id="cross">
	    要跨號集單
	  </label>
	</div>
	<div class="text-center"><a href="javascript:submit_check()" class="btn btn-primary btn-lg" <?php if(empty($query)){ echo "disabled";}?> >送出訂單</a></div>
</section>
<script>
  $(".dropz").dropzone({
      url: "<?=base_url('store/order/muti')?>",
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
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
