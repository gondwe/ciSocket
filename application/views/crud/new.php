

<?=titles("Add ".$table,null,1)?>
<?php 


switch ($table){
    case "patient_master" : 
        echo '<a href="#" class="pull-right m-3"><span class="btn btn-info alert-primary"> Auto Gen :</span><span class="h2"> 44353456</span></a>';
        
    break;
}


?>
<hr>


<?php 
$d = new tablo($table);


// field injection use cases

switch ($table){
    case "patient_master" : 
        // $d->formgrid(4,4,12);
    break;
}



$d->newform();

?>

