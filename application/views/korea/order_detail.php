<?php require_once VIEWPATH.'_templates/_header.php' ?>
<style type="text/css" media="print">
  div.page {
    page-break-after: always;
    page-break-inside: avoid;
  }
</style>
<script src="<?=base_url('assets/js/dropzone.js')?>"></script>
<h2 class="text-center hidden-print">訂單詳情</h2>
<section class="container">
<a href="javascript:window.print();" class="btn btn-success btn-lg hidden-print pull-right">列印訂單</a>
<hr class="hidden-print">
<div class="row hidden-print">
	<div class="col-xs-2"></div>
	<div class="col-xs-8">
		<div class="panel panel-primary">
		  <div class="panel-heading hidden-print">訂單狀況</div>
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
							<a href="<?= base_url('korea/order/edit_state/'.$query[0]->order_id)?>" class="btn btn-warning hidden-print">更改</a>
						</td>
					</tr>	
				</table>
				<br>
		</div>
	</div>
	<div class="col-xs-2"></div>
</div>
</section>
<section class="container hidden-print">
	<?php $price_total = 0;?>
	<?php foreach ($query as $key => $value): ?>
		<div class="row" id="<?=$value->order_img_id?>">
			<div class="col-xs-1">
				<h3><?=$key+1;?></h3>
			</div>
			<div class="col-xs-3">
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
							<td class="text-danger"><? if ( $sub->sub_state == '結束') { echo '0'; } else { echo number_format($sub->amount * $sub->price);}?></td>	
							<td class="text-danger"><?= $sub->sub_state?><? if ( $sub->sub_state == '訂') { echo ' '.$sub->sub_state_date; }?></td>
							<td class="hidden-print"><a href="<?= base_url('korea/order/detail_edit_sub/'.$sub->order_sub_id.'/'.$query[0]->order_id)?>" class="btn btn-warning">編輯</a></td>
							<td class="hidden-print"><a href="<?= base_url('korea/order/detail_delete_sub/'.$sub->order_sub_id.'/'.$query[0]->order_id)?>" class="btn btn-danger">刪除</a></td>
						</tr>
						<?php if ($sub->sub_state != '結束'): ?>
							<?php $price += $sub->amount * $sub->price ?>
						<?php endif ?>
					<?php endforeach ?>
					<?php $price_total += $price ?>
				</table>
				<div class="text-center hidden-print"><a href="<?=base_url('korea/order/detail_create_sub/'.$value->order_img_id.'/'.$query[0]->order_id)?>" class="btn btn-primary">+新增項目</a>	</div>
				<div class="text-center"><h3>$ <?= number_format($price)?></h3></div>
				<hr>
				<h4 class="pull-right">位置：<?=$value->position?> - <?=$value->position_desc?></h4><br>
				<label for="" class="text-success" style="margin:0 20px;">客戶留言</label>
				<div class="well"><?=$value->store_message?></div>
				<label for="" class="text-danger" style="margin:0 20px;">管理員留言</label><a href="<?=base_url('korea/order/message/'.$sub->order_img_id.'/'.$value->order_id)?>" class="btn btn-warning hidden-print">留言</a>
				<div class="well"><?=$value->korea_message?></div>
			</div>			
		</div>
		<hr>
	<?php endforeach ?>
	<div class="row">
		<div class="col-xs-4"></div>
		<div class="col-xs-8"><h2 class="text-danger text-center">$ <?= number_format($price_total)?></h2></div>
	</div>
	<!-- <div class="text-center"><a href="javascript:if(confirm('確定要送出訂單了嗎？'))location.href='<?=base_url('korea/order/submit')?>'" class="btn btn-primary btn-lg" <?php if(empty($query)){ echo "disabled";}?> >送出訂單</a></div> -->
</section>

<section class="container visible-print-block" style="font-size:1px;">
	<?php $price_total = 0;?>
	<?php $count_page = 1;?>
<div class="row page">
	<?php foreach ($query as $key => $value): ?>
		<div class="col-xs-6">
			<div class="col-xs-1" style="padding:0;">
				<p><?=$key+1?></p>
			</div>
			<div class="col-xs-4" style="padding:0;">
				<img src="<?= base_url($value->image)?>" class="img-responsive">
			</div>
			<div class="col-xs-7" style="padding:0;">
				<table class="table table-hover" style="margin:0;">
					<tr class="success">
						<td style="padding: 4px 10px;">顏</td>	
						<td style="padding: 4px 0px;">尺</td>
						<td style="padding: 4px 4px;">數</td>
						<td style="padding: 4px 4px;">金</td>
						<td style="padding: 4px 4px;">總</td>
						<td style="padding: 4px 30px 4px 0;">狀</td>
					</tr>
					<?php $total_row = 0 ?>
					<?php $price = 0; ?>
					<?php foreach ($value->order_subs as $sub_row => $sub): ?>
						<tr>
							<td style="padding: 4px 0px;"><?= $sub->color?></td>
							<td style="padding: 4px 0px;"><?= $sub->size?></td>
							<td style="padding: 4px 3px;" class="text-info"><?= $sub->amount?></td>
							<td style="padding: 4px 3px;" class="text-success"><?= number_format($sub->price)?></td>
							<td style="padding: 4px 3px;" class="text-danger"><? if ( $sub->sub_state == '結束') { echo '0'; } else { echo number_format($sub->amount * $sub->price);}?></td>	
							<td style="padding: 4px 3px;" class="text-danger"><? if ( $sub->sub_state == '訂') { echo substr($sub->sub_state_date, 5, 5); } else { echo $sub->sub_state; }?></td>
						</tr>
						<?php if ($sub->sub_state != '結束'): ?>
							<?php $price += $sub->amount * $sub->price ?>
						<?php endif ?>
						<?php $total_row = ($sub_row+1) ?>
					<?php endforeach ?>
					<?php $price_total += $price ?>
					<?php for ($i=5; $i > $total_row ; $i--): ?>
						<tr>
							<td style="height:26px;"></td>
							<td style="padding: 4px 8px;"></td>
							<td style="padding: 4px 8px;"></td>
							<td style="padding: 4px 8px;"></td>
							<td style="padding: 4px 8px;"></td>
							<td style="padding: 4px 8px;"></td>
						</tr>
					<?php endfor ?>
				</table>
				<p class="pull-right">目前位置: <?= $value->position?> - <?=$value->position_desc?></p>
				<div class="text-center"><p style="margin:1;">$ <?= number_format($price)?></p></div>
				<hr style="margin:0;">
				<div class="col-xs-2">
					<p class="text-success" style="margin:0;padding:0;">你</p>
					<p class="text-danger" style="margin:0;padding:0;">管</p>
				</div>
				<div class="col-xs-10">
					<div class="well" style="margin:0;padding:0;"><?=$value->store_message?></div>					
					<div class="well" style="margin:0;padding:0;"><?=$value->korea_message?></div>
				</div>
			</div>			
		</div>
		<?php if ($key%2 == 1): ?>
			<div class="row"><div class="clear-fix"></div></div>
		<?php endif ?>
		<?php if ($key%8 == 7): ?>
			<?php $count_page++ ?>
			<?php if (ceil(count($query)/8) > $count_page): ?>
				</div>
				<div class="row page">				
			<?php endif ?>
		<?php endif ?>
	<?php endforeach ?>
	<div class="row">
		<div class="col-xs-4"></div>
		<div class="col-xs-8"><h4 class="text-danger text-center">$ <?= number_format($price_total)?></h4></div>
	</div>
</div>
	
</section>

<br><br>
<?php require_once VIEWPATH.'_templates/_footer.php' ?>
