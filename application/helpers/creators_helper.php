<?php 
namespace ben10;
?>
<h4>Developer</h4>
<?php

use mysqli;

function db($d){ 
    // multi-db connector
    switch($d){
        case null : $a = "topnav"; $b="toor"; $c = "3307"; break;
        case 1 : $a = "medicare"; $b=""; $c = "3306"; break;
    }$db = new mysqli("localhost:$c","root",$b,$a);if($db->connect_errno > 0){die(spill($db->connect_error));}else{return $db;}}
function clean($i){ return mysqli_real_escape_string(db(), $i);}
function run($a,$d=null){return process($a,$d);}
function process($sql,$d=null){ $db = db($d); $_SESSION["erc"] = $j = ($db->query($sql))? TRUE :FALSE; if(!$j) spill($db->error); return $j; }  
function process2($sql,$d){$db = db($d);if($d = $db->query($sql)){$j = TRUE; }else{ spill($db->error);$j = FALSE;}$_SESSION["erc"] = $j;return $d;}
function get($i="",$d=null){if($i !== ""){$l = []; $j = process2($i,$d); while($k = $j->fetch_object()){ $l[] = $k; } return $l; } } 
function getlist($i,$d=null){$raw = get($i,$d);if(empty($raw)){ return []; }else{ if(count((array)$raw[0])==2){ foreach($raw as $j=>$k){$l[current($k)] = end($k);}} else{ if(count((array)$raw[0])>2){ foreach($raw as $j=>$k) { $l[$j] = $k; }}else{ foreach($raw as $j=>$k) { foreach($k as $m=>$n): $l[] = $n; endforeach;} } }} if(count((array)$l) == 1){ $l = current($l); } return $l; }
function fetch($i,$d){$a = get($i);$b = isset($a[0])?$a[0] : [];$c = current($b);return $c;}
function spill($i,$d=null){echo "<pre>";print_r($i);echo "</pre>";}function pf($i){spill($i);}

?>
<input type="text"  autofocus id="qq" class="form-control" onKeydown=get(event);>
<?php

$u = getlist("select distinct(stafftype), 'usertype', staffid from medicare.staff where stafftype <> '' group by stafftype;");

$x = implode(",",array_map(function($y){
    return "('".implode("','",(array)$y)."')";
},$u));

// process("insert into dataconf (b,a, id) values $x");

spill($x);
spill($u);


?>



<div class="play">..waiting</div>


<script>
    function get(e){
        let enter = e.keyCode; 
        if(enter == '13'){ $.post('pages/ajax/sql.php',{"sql":$("#qq").val()},(d)=>{ $(".play").html(d);})}
    }
</script>