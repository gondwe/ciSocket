<?php	

    $this->load->helper("tablo");


    $i = $td;
    $addnew=null;
    $editor=false;



    $paging = ["paging"=>(isset($paging)?$paging:"false")];
    $search = ["search"=>(isset($search)?$search:"false")];
    $ordering = ["ordering"=>(isset($ordering)?$ordering:"false")];
    $info = ["info"=>(isset($info)?$info:"false")];
    $pagelength = ["pageLength"=>(isset($pagelength)?$pagelength:"10")];


    $i = (array)$i;
    
    $fields = array_keys(current($i));
	// spill($fields);
	echo '<div style="margin:5px; margin-top:20px; margin-left:20px">';

	if($addnew){
		echo '<a href="#'.$addnew.'" class="btn btn-sm btn-success mb-3">ADD NEW</a>';
	}
	// hr();

	echo '<table id="example" class="display compact striped hover" style="width:100%;"><thead>';
	echo '<tr style="background: #607D8B;color: white;font-weight: lighter;border-right: 1px solid black;">';
	$noidfield = !in_array("id",$fields);
	if($noidfield)echo '<th>Sno</th>';
    foreach($fields as $f){ echo "<th style='border-left: 1px solid white;' >".rxx($f)."</th>"; }
	echo "</thead>";
    echo "<body>";
    echo "</body>";
    $x = 1;
    foreach($i as $j=>$k){
        echo "<tr>";
        if($noidfield)echo "<td>$x</td>";
            foreach($k as $l){
                echo "<td>$l</td>";
			}
        echo "</tr>";
        $x++;
    }
    echo "</tbody>";
    echo "</table>";
	echo "</div>";
	

    $args = [
        "paging"=>$paging["paging"],
        "ordering"=>$ordering["ordering"],
        "searching"=>$search["search"],
        "info"=>$info["info"],
        "pageLength"=>$pagelength["pageLength"],
    ];

    // pf($args);

    tablefoot3($args);



?>
