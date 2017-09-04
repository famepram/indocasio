<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<!-- <link rel="shortcut icon" href="assets/favicon.ico"> -->
<?php $favicon = get_meta('favicon');?>
<?php if(!empty($favicon)):?>
	<link rel="icon" href="<?php echo base_url().'uploads/site/'.$favicon;?>">
<?php else:?>
	<link rel="icon" href="<?php echo base_url().'assets/img/favicon_128.png';?>">
<?php endif;?>
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/owl-carousel/owl.transition.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/slick/slick.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<!-- iCheck -->
<link href="<?php echo base_url();?>assets/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="assets/js/required/html5shiv.js"></script>
  <script src="assets/js/required/respond.min.js"></script>
<![endif]-->

<script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>

<script src="<?php echo base_url();?>assets/plugins/validator.js"></script>
<script>var base_url = '<?php echo base_url();?>';</script>