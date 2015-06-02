<!DOCTYPE html>
<html lang="zh-Hant-TW" class="dropz">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="描述">
  <meta name="keywords"content="關鍵字,關鍵字">
  <meta name="author" content="趙承瑋 Piece">
  <?php if (isset($title)): ?>
    <title class="visible-print-block"><?=$title?></title>
  <?php else: ?>
    <title class="visible-print-block">貨運系統</title>
  <?php endif ?>
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/animate.css')?>">
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script type="text/javascript" src="<?=base_url('assets/js/jquery.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
</head>
<body>
<h1 class="text-center hidden-print">貨運系統</h1>
<hr>
<section class="container hidden-print">
  <?php if ($this->session->userdata('ident') === 'korea'): //管理員能看到的?>
    <div class="btn-group btn-group-justified btn-lg" role="group">
      <a href="<?= base_url('korea/user')?>" class="btn btn-lg btn-primary" role="button">會員管理</a>
      <a href="<?= base_url('korea/order')?>" class="btn btn-lg btn-info" role="button">訂單紀錄</a>
      <a href="<?= base_url('korea/money')?>" class="btn btn-lg btn-warning" role="button">金額明細紀錄</a>
      <a href="<?= base_url('korea/money/create')?>" class="btn btn-lg btn-success" role="button">金額明細新增</a>
      <a href="<?=base_url('welcome/logout')?>" class="btn btn-lg btn-danger" role="button">登出</a>
    </div>
  <?php endif ?>
  <?php if ($this->session->userdata('ident') === 'user'): ?>
    <div class="btn-group btn-group-justified btn-lg" role="group">
      <a href="<?= base_url('store/money')?>" class="btn btn-lg btn-primary" role="button">金額明細</a>
      <a href="<?= base_url('store/order')?>" class="btn btn-lg btn-info" role="button">訂單管理</a>
      <a href="<?= base_url('store/order/create')?>" class="btn btn-lg btn-warning" role="button">新增訂單</a>
      <a href="<?=base_url('welcome/logout')?>" class="btn btn-lg btn-danger" role="button">登出</a>
    </div>    
  <?php endif ?>
</section>