<?php 


function propername($n=null){
    $me = null;
    $ci = &get_instance();
    $l = $ci->uri->segments;
    $n = is_null($n)? end($l) : $n;
    
    $me= proper($me);

    return $me;
}

function proper($n){
    $n = strtolower(rx($n));
    if(preg_match("/patient_master/i",$n)){ return rxx(preg_replace("/patient_master/","patient",$n)); }
    return rxx($n);
}

