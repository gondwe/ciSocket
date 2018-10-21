
<?php 

$found = isset($_SERVER["HTTP_REFERER"]);
$link = $found ? $_SERVER["HTTP_REFERER"] : base_url();
$caption = $found ? "BACK" : "HOME";

$rel = end($this->uri->segments);

?>

<a href="<?=$link?>" class="btn btn-sm btn-outline-primary mt-5 ml-5 mb-2"><i class="fa fa-chevron-left"></i> <?=$caption?></a>
<h2 class="ml-5 text-secondary">service not found : [ <span class="text-warning"><?=$rel?></span> ] </h2>
<small class="ml-5">The related patient/doctor service is not found or has not been activated/registered</small>


