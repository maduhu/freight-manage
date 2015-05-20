<?php require_once VIEWPATH.'_templates/_header.php' ?>
<script src="<?=base_url('assets/js/dropzone.js')?>"></script>
<h2 class="text-center">訂單詳情</h2>
<section class="container">
<a href="javascript:window.print();" class="btn btn-success btn-lg hidden-print pull-right">列印訂單</a>
<hr>
<div class="row">
	<div class="col-xs-2"></div>
	<div class="col-xs-8">
		<div class="panel panel-primary">
		  <div class="panel-heading">訂單狀況</div>
		  <table class="table table-striped text-center">
					<tr>
						<td>單號</td>
						<td><?= $query[0]->order_id?></td>
					</tr>
					<tr>
						<td>公司</td>
						<td><?=$user_detail->company?></td>
					</tr>	
					<tr>
						<td>處理狀況</td>
						<td>
							<?php switch ($query[0]->state_id) {
								case '1':
									echo "未處理";
									break;
								case '2':
									echo "處理中";
									break;
								case '3':
									echo "追貨中";	
									break;
								case '4':
									echo "出貨";
									break;
								
								default:
									# code...
									break;
							}?>
							<a href="<?= base_url('admin/order/edit_state/'.$query[0]->order_id)?>" class="btn btn-warning hidden-print">更改</a>
						</td>
					</tr>	
				</table>
				<br>
		</div>
	</div>
	<div class="col-xs-2"></div>
</div>
<hr>


	<?php $price_total = 0;?>
	<?php foreach ($query as $key => $value): ?>
		<div class="row">
			<div class="col-xs-4">
				<img src="<?= base_url($value->image)?>" class="img-responsive">
			</div>
			<div class="col-xs-8">
				<table class="table table-hover">
					<tr class="success">
						<td>顏色</td>	
						<td>尺寸</td>
						<td>數量</td>
						<td>金額</td>
						<td>總金額</td>
						<td>狀態</td>
						<td class="hidden-print">編輯</td>
						<td class="hidden-print">刪除</td>
					</tr>
					<?php $price = 0; ?>
					<?php foreach ($value->order_subs as $sub): ?>
						<tr>
							<td><?= $sub->color?></td>
							<td><?= $sub->size?></td>
							<td class="text-info"><?= $sub->amount?></td>
							<td class="text-success"><?= number_format($sub->price)?></td>
							<td class="text-danger"><?= number_format($sub->amount * $sub->price)?></td>	
							<td class="text-danger"><?= $sub->sub_state?><? if ( $sub->sub_state == '訂') { echo ' '.$sub->sub_state_date; }?></td>
							<td class="hidden-print"><a href="<?= base_url('admin/order/detail_edit_sub/'.$sub->order_sub_id.'/'.$query[0]->order_id)?>" class="btn btn-warning">編輯</a></td>
							<td class="hidden-print"><a href="<?= base_url('admin/order/detail_delete_sub/'.$sub->order_sub_id.'/'.$query[0]->order_id)?>" class="btn btn-danger">刪除</a></td>
						</tr>
						<?php $price += $sub->amount * $sub->price ?>
					<?php endforeach ?>
					<?php $price_total += $price ?>
				</table>
				<div class="text-center hidden-print"><a href="<?=base_url('admin/order/detail_create_sub/'.$value->order_img_id.'/'.$query[0]->order_id)?>" class="btn btn-primary">+新增項目</a>	</div>
				<div class="text-center"><h3>$ <?= number_format($price)?></h3></div>
				<hr>
				<h4 class="pull-right">位置：<?=$value->position?></h4><br>
				<label for="" class="text-success" style="margin:0 20px;">客戶留言</label>
				<div class="well"><?=$value->store_message?></div>
				<label for="" class="text-danger" style="margin:0 20px;">管理員留言</label><a href="<?=base_url('admin/order/message/'.$sub->order_img_id.'/'.$value->order_id)?>" class="btn btn-warning hidden-print">留言</a>
				<div class="well"><?=$value->admin_message?></div>
			</div>			
		</div>
		<hr>
	<?php endforeach ?>
	<div class="row">
		<div class="col-xs-4"></div>
		<div class="col-xs-8"><h2 class="text-danger text-center">$ <?= number_format($price_total)?></h2></div>
	</div>
	<!-- <div class="text-center"><a href="javascript:if(confirm('確定要送出訂單了嗎？'))location.href='<?=base_url('admin/order/submit')?>'" class="btn btn-primary btn-lg" <?php if(empty($query)){ echo "disabled";}?> >送出訂單</a></div> -->
</section>
<br><br>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
