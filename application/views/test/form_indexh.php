<?php @require_once VIEWPATH.'_templates/_header.php' ?>

<section class="container">
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label for="title" class="col-sm-2 control-label">標題</label>
    <div class="col-sm-10">
      <input type="text" name="title" class="form-control" placeholder="XDD">
    </div>
  </div>
  <div class="form-group">
    <label for="content" class="col-sm-2 control-label">內容</label>
    <div class="col-sm-10">
      <textarea name="content" class="form-control" id="" cols="30" rows="10"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-primary" value="送出">
    </div>
  </div>
</form>
</section>

<script type="text/javascript" src="<?=base_url('/assets/tinymce/tinymce.min.js')?>"></script>
<script>
$(function(){

  tinymce.init({
        selector: "textarea",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: false,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ]
  });

});
</script>

<?php @require_once VIEWPATH.'_templates/_header.php' ?>