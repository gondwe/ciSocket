<?=titles("Edit ".$table,null,1)?>
<hr>
<?php

    $d = new tablo($table);

    
    // field injection use cases

    switch ($table){
        case "patient_master" : 
        // $d->hide("dob");
        break;
    }


    $d->edit($id);