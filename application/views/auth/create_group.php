<h5 class='m-3 pull-left'><?php echo lang('create_group_heading');?></h5>
<a href="<?=base_url("auth/groups")?>" class="btn btn-primary btn-sm alert-dark pull-right m-3"><i class="fa fa-users"></i> GROUPS</a>
<hr>
<p><?php echo lang('create_group_subheading');?></p>

<?php ?>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_group");?>
<div class="col-md-6">
      <p>
            <?php echo lang('create_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name,null,["class"=>"form-control"]);?>
      </p>

      <p>
            <?php echo lang('create_group_desc_label', 'description');?> <br />
            <?php echo form_input($description,null,["class"=>"form-control"]);?>
      </p>
</div>

      <p><?php echo form_submit('submit', lang('create_group_submit_btn'), ["class"=>"btn btn-primary"]);?></p>

<?php echo form_close();?>

<?php 


$this->load->view("auth/groups");