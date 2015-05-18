<?php @require_once VIEWPATH.'_templates/_header.php';?>
<script type="text/javascript" src="<?=base_url('assets/js/ajaxfileupload.js')?>"></script>
<article class="container">
	<section class="row">

		<form class="form-horizontal" role="form" method="post" action="<?=base_url('file/test2')?>" enctype="multipart/form-data">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">檔案位置</label>
		    <div class="col-sm-9">
	        <input id="userfile" class="form-control" type="file" name="userfile" />
		    </div>
		  </div>
		</form>
		<input class="form-control" name="XD">
	</section>
</article>

<script type="text/javascript">
$(function(){
	$('input[type=file]').on('change', ajaxFileUpload); // 上傳檔案欄位變更時，執行上傳
		function ajaxFileUpload(){
	    $.ajaxFileUpload({
	          url: '<?=base_url('test/file/realtimeUpload')?>', // 送出位置
	          secureuri: false,
	          fileElementId: 'userfile', //這個是對應到 input file 的 ID
	          dataType: 'text',
	          success: function(data, status){
	          	if (data == '') {
	          		alert('上傳失敗');
	          	} else {
	          		$('input[name=XD]').val(function(){
	          			return $('input[name=XD]').val() + data;
	          		});
	          	};
	          	$('input[type=file]').on('change', ajaxFileUpload);
	          },
	          error: function(data, status, e){
	          	alert('上傳失敗');
	          	$('input[type=file]').on('change', ajaxFileUpload);
	          }
			});
		}
});
</script>

<?php @require_once VIEWPATH.'_templates/_footer.php';?>