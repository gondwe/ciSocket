<h5 class='m-3 pull-left'>Section Groups</h5>
<a href="<?=base_url("auth")?>" class="btn btn-primary btn-sm alert-dark pull-right m-3">
<i class="fa fa-arrow-left">
</i> BACK TO USERS</a>
<hr>
<?php 


// pf($groups);

?>

<ul class="inline-list">
    <?php foreach($groups as $k=>$data): ?>
    <li class="inline-list-item bg-light">
        <span class="col-md-2 text-primary"><?=$data->id ?></span>
        <span class="col-md-6"><?=rxx($data->name)?></span>
        <span class="ml-5 text-dark col-md-6 m"><i><?=$data->description?></i></span>
        <a href="<?=base_url("auth/edit_group/".$data->id)?>" class="pull-right btn-sm btn btn-success alert-primary">EDIT GROUP</a>
    </li>
    <?php endforeach; ?>

  
</ul>



<style>
    .inline-list-item {
        list-style:none;
        width:100%;
        border-bottom:1px solid #ddd;
        padding:10px 0px 10px 10px;
        margin-bottom:2px

    }
</style>