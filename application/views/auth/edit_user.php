<h5 class='m-3 pull-left'><?php echo lang('edit_user_heading');?> Information</h5>
<a href="<?=base_url("auth")?>" class="btn btn-primary btn-sm alert-dark pull-right m-3"><i class="fa fa-arrow-left"></i> BACK TO USERS</a>
<hr>
<p><?php echo lang('edit_user_subheading');?></p>


<div id="infoMessage"><?php echo $message;?></div>
<div class="col-md-8">
<?php echo form_open(uri_string());?>

<div class="col-md-6 pull-left">
      <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> 
            <?php echo form_input($first_name,null,["class"=>"form-control"]);?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> 
            <?php echo form_input($last_name,null,["class"=>"form-control"]);?>
      </p>

      <p>
            <?php echo lang('edit_user_company_label', 'company');?> 
            <?php echo form_input($company,null,["class"=>"form-control"]);?>
      </p>

      <p>
            <?php echo lang('edit_user_phone_label', 'phone');?> 
            <?php echo form_input($phone,null,["class"=>"form-control"]);?>
      </p>
</div>
<div class="col-md-6 pull-left">
      <p>
            <?php echo lang('edit_user_password_label', 'password');?> 
            <?php echo form_input($password,null,["class"=>"form-control"]);?>
      </p>

      <p>
            <?php //echo lang('edit_user_password_confirm_label', 'password_confirm');?>
            Confirm Password
            <?php echo form_input($password_confirm,null,["class"=>"form-control"]);?>
      </p>
</div>
</div>

<div class="col-md-4 pull-right">

      <?php if ($this->ion_auth->is_admin()): ?>

          <!-- <h3><?php echo lang('edit_user_groups_heading');?></h3> -->
          <?php foreach ($groups as $group):?>
              <label class="checkbox" class='alert bg-dark'>
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                        if ($gID == $grp->id) {
                              $checked= ' checked="checked"';
                              break;
                        }
                  }
                  ?>
              <input class="inline-list-item" type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
              <?php echo rxx(htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8'),2);?>
              </label>
          <?php endforeach?>

      <?php endif ?>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>
<hr>
      <p class="pull-right">
      <?php echo form_submit('submit', "SAVE USER DATA", ["class"=>"btn btn-sm btn-success alert-primary mt-3 badge-pill"]);?><br>
      <a href="<?=base_url("auth")?>" class="btn btn-danger badge-pill alert-danger btn-sm  m-3 "><i class="fa fa-arrow-times"></i> CANCEL</a>
      </p>

</div>
<?php echo form_close();?>


<script>

$(document).ready(function(){
      // $("input:text").addClass("form-control");
      // $("input:password").addClass("form-control");
      // $("p").addClass("text-secondary");
});

</script>


<style>
checkbox {
      display:inline-block

}

</style>