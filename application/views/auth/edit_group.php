<h5 class='m-3 pull-left'><?php echo lang('edit_group_heading');?> Information</h5>
<a data-toggle='modal' data-target="#delete" class="btn btn-danger btn-sm text-light pull-right m-3"><i class="fa fa-times"></i> DELETE GROUP</a>
<a href="<?=base_url("auth/groups")?>" class="btn btn-primary btn-sm alert-dark pull-right m-3"><i class="fa fa-arrow-left"></i> BACK TO GROUPS</a>
<hr>

<div id="infoMessage"><?php ?></div>
<div class="col-md-4 pull-left">
<?php echo form_open(current_url());?>

      <p>
            <?php echo lang('edit_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name,null,["class"=>"form-control"]);?>
      </p>

      <p>
            <?php echo lang('edit_group_desc_label', 'description');?> <br />
            <?php echo form_input($group_description,null,["class"=>"form-control"]);?>
      </p>

      <p><?php echo form_submit('submit', lang('edit_group_submit_btn'),["class"=>"btn btn-success"]);?></p>

<?php echo form_close();?>
</div>
<div class="pull-right col-md-7">
<h5 class="m-3">Members</h5>
      <?php 
            // pf($group);
            echo "<ol>";
            foreach($dg as $d=>$u){
                  echo "<li><a href='".base_url('auth/edit_user/'.$u->id)."'  class='rowd text-dark btn-sm alert-info mb-1'>".rxx($u->username)." (".$u->names.")<span class='pull-right mr-5'> <b > Call </b>: ".$u->phone."</span></a></li>";
            }
      ?>
</div>


<div class="modal" id="delete" role="dialog" id="exampleMOdal">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">
      <button id="deleter" default class="btn btn-warning col-md-3 pull-left ml-5" data-dismiss="modal">Ok</button>
      <button class="btn btn-success col-md-3 pull-right mr-5" data-dismiss="modal">Cancel</button>
      </div>
      <!-- <div class="modal-footer"> -->
            <!-- <button class="btn btn-light" data-dismiss='modal'>Close</button> -->
      <!-- </div> -->
</div>
</div>
</div>


<script>
$("#deleter").click(function(){
      window.location.href="<?=base_url('auth/delgroup/'.$group->id)?>"
})
</script>