<div class="mt-5">
<div class="rowd">
<a href="<?=base_url('systems/admin')?>" class="btn-primary btn alert-primary btn-sm "><i class="fa fa-chevron-left"></i> ADMIN DASHBOARD</a>
</div>
<div class="ml-5">
<h5 class='m-3 pull-left'><?php echo lang('index_heading');?> Data</h5>


<div id="infoMessage"><?php echo $message;?></div>
<p class="pull-right m-3">
<a href="<?=base_url('auth/create_user')?>" class="btn-info btn alert-primary btn-sm"><i class="fa fa-plus"></i> NEW USER</a>
<a href="<?=base_url('auth/create_group')?>" class="btn-success text-dark btn alert-dark btn-sm"><i class="fa fa-users"></i> ADD USER GROUP</a>
</p>

<div class="mr-5">
<table cellpadding=0 cellspacing=10 class='table-striped table' width="100%">
	<thead class='bg-info text-light '>
	<tr>
		<th><?php echo lang('index_fname_th');?></th>
		<th><?php echo lang('index_lname_th');?></th>
		<th><?php echo lang('index_email_th');?></th>
		<th>Contact</th>
		<th><?php echo lang('index_groups_th');?></th>
		<th><?php echo lang('index_status_th');?></th>
		<th><?php echo lang('index_action_th');?></th>
	</tr>
	</thead>
	<?php foreach ($users as $user):?>
		<tr style="border-bottom:1px solid #ccc;">
	            <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($user->phone,ENT_QUOTES,'UTF-8');?></td>
			<td>
				<?php //foreach ($user->groups as $group):?>
					<?php echo count($user->groups); // anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?>
                <?php //endforeach?>
			</td>
			<td><?php 
			echo ($user->active) ? 
			// anchor("auth/#deactivate/".$user->id, lang('index_active_link'),["class"=>"btn btn-sm badge-pill alert-success"]) 
			'<a href=""  data-toggle="modal" data-target="#exampleModal" data-action="deactivate" data-id="'.$user->id.'" class="btn btn-sm badge-pill btn-success">'.lang('index_active_link').'</a>'
			: 
			'<a href="'.base_url("auth/activate/".$user->id).'"   class="btn btn-sm badge-pill btn-danger">'.lang('index_inactive_link').'</a>';
			?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, '<i class="fa fa-edit"></i> Edit',["class"=>"btn btn-sm btn-primary"]) ;?></td>
		</tr>
	<?php endforeach;?>
</table>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Lighthouse : UAC</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body" id="conte">
			<!-- contents goes hehere -->
			
			</div>
			<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      		</div>
		</div>
	</div>
</div>


<script>

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  action = button.data("action");
  id = button.data("id")
  let actionurl = "<?=base_url()?>" + "/auth/" + action;

// $("#action").text(action)
  $("#conte").load(actionurl+ "/" + id, function(res){
  });

});
</script>


<style>
	.modal-title {
		text-transform:capitalize;
	}
	td {
		padding-bottom:0px !important
	}
</style>