<h5 class='m-3 pull-left'><?php echo lang('create_user_heading');?></h5>
<a href="<?=base_url("auth")?>" class="btn btn-primary btn-sm alert-dark pull-right m-3"><i class="fa fa-arrow-left"></i> BACK TO USERS</a>
<hr>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage"><?php if($message){ notify($message);}; ?></div>

<?php echo form_open("auth/create_user");?>
<div class="col-lg-4 col-md-6 pull-left">
      <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> 
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> 
            <?php echo form_input($last_name);?>
      </p>
      
      <?php
      if($identity_column!=='email') {
            echo '<p>';
            echo lang('create_user_identity_label', 'identity');
            echo '';
            echo form_error('identity');
            echo form_input($identity);
            echo '</p>';
      }
      ?>

     
      <p>
            <?php echo lang('create_user_company_label', 'company');?> 
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('create_user_email_label', 'email');?> 
            <?php echo form_input($email);?>
      </p>
 </div>
      <div class="col-lg-4 col-md-6 pull-left">
      <p>
            <?php echo lang('create_user_phone_label', 'phone');?> 
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('create_user_password_label', 'password');?> 
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> 
            <?php echo form_input($password_confirm);?>
      </p>


      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>
      </div>

<?php echo form_close();?>



<script>

$(document).ready(function(){
      $("input:text").addClass("form-control");
      $("input:password").addClass("form-control");
      $("form>p").addClass("text-secondary");
      $("input:submit").addClass("btn btn-primary pull-right");
      $("#first_name").attr("autofocus",true);
});

</script>


<style>
</style>