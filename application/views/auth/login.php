<!DOCTYPE html>
<html lang="en" style=''>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?=$sysname.$ver?></title>
	
	
	<link rel="stylesheet" href="<?=site_url("/assets/css/bootstrap.min.css") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/css/font-awesome.min.css") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/js/jquery-3.3.1.min.js") ?>" >
	<link rel="stylesheet" href="<?=base_url("assets/css/custom.css") ?>" >
	
	
</head>
<body style='background:white'>
    
<!-- </body> -->
<div class="container" style='background:#17a2b8;'>
    <h1 class="text-center" style="margin-top:2%;margin-left:-60px;">
    <img src="<?=base_url('assets/images/sky.png')?>" alt="bird" style=' max-width:300px' class='col-md-4 col-lg-3 p-3'>
    <!-- <sub style='color:#ddd' class=''>&reg</sub> -->
    </h1>
	<div class="row justify-content-center" style='background:#0ccae86b'>
		<div class="col-xs-12 col-md-8 col-sm-10 col-lg-5 pb-5">


                    <!--Form with header-->

                    <form action="" method="post">
                        <div class="">
                            <div class=" pb-3">
                                <!-- <div class="bg-info text-white text-center py-2"> -->
                                    <!-- <h3> Sign In</h3> -->
                                <!-- </div> -->
									
                            </div>
                                    <div id='alerts' class="m-0"><?=$message?></div>
                            <div class="card-body p-3">


<?php echo form_open("auth/login");?>

  <!-- <p> -->
    <div class="form-group">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
            </div>
              <?php echo form_input($identity,null,["class"=>"form-control", "placeholder"=>" Username"]);?>
            </div>
        </div>
  <!-- </p> -->

  <!-- <p> -->
    <div class="form-group">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-lock text-primary"></i></div>
            </div>
              <?php echo form_input($password,null,["class"=>"form-control", "placeholder"=>" Password"]);?>
            </div>
        </div>
  <!-- </p> -->

  <?php echo form_submit('submit', lang('login_submit_btn'), ["class"=>"mb-3 pull-right btn btn-info btn-block"]);?>

  <div class="pull-left">
    
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
    
  </div>

  <div class="pull-right text-light"><a href="forgot_password" class="text-light"><?php echo lang('login_forgot_password');?></a></div>

  
<?php echo form_close();?>


<div class='fixed-bottom m-3'style="text-align:center" >
     <small style='color:#bbb;' style="" >All Rights Reserved &copy 2018 Lighthouse For Christ Eye Center</small>
    </body>
</div>


<style>
    #alerts {
        color:#ddd;
    }
    .btn-block {
            text-transform:uppercase;
            text-align:left;
            padding-left:40px
      }
    .container{
        /* border: 1px solid #ddd; */
        box-shadow: 0px 0px 300px 60px #ddd;
        /* padding-top:50px */
    }
    .justify-content-center {
        border-top: 1px solid #ddd;
    }
</style>