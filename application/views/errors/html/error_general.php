<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css')?>" >
	<link rel="stylesheet" href="<?=base_url('assets/css/font-awesome.min.css')?>" >
	<link rel="stylesheet" href="<?=base_url('assets/css/jquery-ui.css')?>" >
	<link rel="stylesheet" href="<?=base_url('assets/css/dataTables.jqueryui.min.css')?>" >
	<link rel="stylesheet" href="<?=base_url('assets/css/sweetalert.css')?>" >
	<link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>" >
  <script src='<?=base_url('assets/js/jquery-3.3.1.min.js')?>'></script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Lost Sheep</title>
<style type="text/css">

	
	h1 {
		color: #444;
		border-bottom: 1px solid #D0D0D0;
		font-size: 23px;
		padding: 14px 15px 10px 15px;
	}


	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}

	p {
		margin: 12px 15px 12px 15px;
	}
</style>
</head>


<body>
	<div id="">
	<a href="<?=base_url('/')?>" class="btn alert-dark m-3 btn-sm"><i class="fa fa-bank"></i> Go Home</a>
	<a href="<?=base_url('systems/faqs')?>" class="pull-right btn alert-primary btn-info m-3 btn-sm"><i class="fa-fa-chevron-left"></i>FAQs</a>
		<h1><?php echo $heading ?? "Protected Route"; ?></h1>
		<?php echo $message ?? null; ?>
	</div>
</body>
</html>