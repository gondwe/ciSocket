<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>LFC MIS</title>
	
	
	<link rel="stylesheet" href="<?=site_url("/assets/css/bootstrap.min.css") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/css/font-awesome.min.css") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/js/jquery-3.3.1.min.js") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/css/custom.css") ?>" >
	
	
</head>


<div class="container" style="margin-top:10%">
    <h4 class="text-center text-info ">
    <span class="text-center h1">
    <!-- <i class="text-info fa fa-user-md"></i>  -->
    </span>
    <!-- Lighthouse HMIS -->
    </h4>
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-5 pb-5">

<a href="<?=base_url('auth/login')?>" class="btn btn-outline-primary mb-3"><i class="badge badge-light badge-pill"><i class="fa fa-arrow-left"></i></i> BACK TO LOGIN</a>

<h1><?php echo lang('forgot_password_heading');?></h1>
<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/forgot_password");?>

      <p>
      	<label for="identity"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label> <br />
      	<?php echo form_input($identity,null,["class"=>"form-control"]);?>
      </p>

      <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'),["class"=>"btn btn-primary btn-block"]);?></p>

<?php echo form_close();?>

<div class='fixed-bottom m-3'style="text-align:center" >
     <small style='color:#bbb;' style="" >All Rights Reserved &copy 2018 Lighthouse For Christ Eye Center</small>
    </body>
</div>


<style>
      .btn-block {
            text-transform:uppercase;
            text-align:left;
      }
</style>