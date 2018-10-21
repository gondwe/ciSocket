<?php 
// require_once("fieldsets.php");

/* author:gondwe benard */

/* handle post data */


class tablo extends fieldsets{
	protected $table;
	protected $data;
	protected $fields;
	protected $fieldnames;
	protected $rowcount;
	protected $combos;
	protected $view_hidden;

	private $db;
	
	public $sql;
	public $sqlstring;
	public $values = [];
	public $pictures = [];
	public $aliases = [];
	public $where;
	public $edit = true;
	public $delete = true;
	public $buttons = [];
	
	
	private $fieldtypes;
	
	private $reserved = ["id","date"];
	
	
	function __construct($tbl=null){ $this->db = db(); $this->table = $tbl; $this->hide("sid,scode"); }
	
	
	function init($id=null){
		$this->fsets();
		$i = gettype($this->table);
		switch($i){
			case "string" : 
			$this->sql = str_word_count($i) > 1 ? $this->table : "select * from `$this->table`";
			$this->query($id);
			break;
		}
		$this->fieldtypes = ["int"=>"number","3"=>"number","float"=>"number","7"=>"date","252"=>"textarea","blob"=>"textarea","varchar"=>"text","253"=>"text",];
		
	}
	
	
	function query($id=null){
		if(is_null($id)){
			$this->data = $this->get($this->sql);
		}else{
			$this->data = $this->get($this->sql." where id = '$id'");
		}

	}
	
	/* auto fill form combo boxes  */
	public function combos($a,$b){
		$data = is_array($b)? $b : $this->arrlist($b);
		$this->combos[strtolower($a)] = $data;
	}
	
	public function button($i,$j){
		$this->buttons[$i] = $j;
	}

	
	function aliases($alias){
		$al = explode(",",$alias);
		$this->aliases[current($al)] = end($al);
	}

	
	/* display a table */
	public function table($display_links = 1){
		$this->init();
		// spill($this->sql);
		// $cm = "/".$this->uri->segment(1)."/".$this->uri->segment(2);
		$cm = null;
			
		if( is_string( $this->sqlstring)){
			$this->data = $this->get($this->sqlstring);
		}
		
		if($display_links){
		echo '
		<section class="content">
  	  	 <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="btn-group pull-right m-3">
                    <a class="btn btn-primary btn-sm" href="'.site_url('/#add_new/'.$this->table).'"><i class="fa fa-plus"></i> NEW</a>
					<a class="btn btn-info btn-sm" style="margin-left:12px;" onclick="pdfme()"><i class="fa fa-download"></i> EXPORT</a>
                </div>
            </div>    
		</div>';	
		}

		// echo '
        
  	  	// <div class="panel panel-default card-view">
		// 	<div class="panel-wrapper collapse in	">
		// 	<div class="panel-body">
		// 		<div class="table-wrap">
        //         	<div class="box-body table-responsive" id="pdf">';
		
		
		// echo '<link rel="stylesheet" href="assets/DataTables/datatables.min.css">';
		echo '<link rel="stylesheet" href="css/jquery-ui.css">';
		echo '<link rel="stylesheet" href="css/dataTables.jqueryui.min.css">';
		echo'<table id="example" class="display compact" style="width:100%;">';
		echo "<thead>";
			echo "<tr style='background:#00bcd4; padding-left:10px; font-weight:lighter;border-right: 1px solid black;' class='text-light'>";
				echo "<th  style='border-right:1px solid #ddd;'>SNO</th>";
			foreach($this->fieldnames as $ff):
				if(!in_array($ff,$this->reserved)){ $fg = strtolower($ff);
					if($fg !== "scode") { $fh = isset($this->aliases[$fg]) ? $this->aliases[$fg] : $ff; echo "<th>".strtoupper(rxx($fh))."</th>"; }
				}
			endforeach;
			if(!empty($this->buttons)){$span = count($this->buttons); $actions = $span>1? "s" : null; echo "<th colspan='$span'>Action$actions</th>";}
			echo $this->edit ? "<th><i data-toggle='tooltip' title='Edit' class='fa fa-edit text-light text-lg'></i></th>" : null;
			echo $this->delete ? "<th><i  data-toggle='tooltip' title='Delete' class='fa fa-minus-square text-light'></i></th>" : null;
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
			$x = 1;
			foreach($this->data as $d=>$dd):
			echo "<tr>";
			echo "<td style='border-right:1px solid #ccc; text-align:center'>$x</td>";
				foreach($dd as $db=>$da){
					if(!in_array($db, $this->reserved)){ 
						if(isset($this->combos[$db])){
							/* populate cbo data */
							echo "<td>".@$this->combos[$db][$da]."</td>";
						}else{
							if(strtolower($db) !== "scode") { echo "<td>$da</td>"; }
						}
							
					}
				}
			if(!empty($this->buttons)){
				// spill($this->buttons);
				foreach($this->buttons as $b=>$t){
					echo "<td><a class='btn  btn-primary btn-outline btn-rounded btn-xs' href='".base_url($t."/".$dd['id'])."' >$b</a></td>";
				}
			}

			echo $this->edit ? "<td><a data-toggle='tooltip' title='Edit' href='".base_url('crud/edit/'.$this->table."/".$dd['id'])."'><i class='fa fa-edit text-primary' style='color:#800f7b'></i></a></td>" : null;
			$urlx = base_url("crud/delete/".$this->table."/".$dd['id']."&url=".$_SERVER["QUERY_STRING"]);
			echo $this->delete ?  "<td><a data-toggle='tooltip' title='Delete'  class='' onclick='dltr(\"".$urlx."\");'><i class='fa fa-trash-o text-danger'></i></a></td>" : null;
			echo "</tr>";
			$x++;
			
			endforeach;
			
		echo "</tbody>";
		echo "</table>";
		
		echo '
		
		</div>
            </div>
        </div>
    </div>
    </div>
	</div>
	<script>
	$(document).ready(function() {
		$("#example").DataTable();
	} );

	function dltr(url){
		a = confirm("You are about to Delete 1 Record <br> ARE YOU SURE");
		if(a) window.location.href=url;
	}
</script>
';

	}
	
	public function newform(){
		$this->init();
		$_SESSION["action"] = "insert";
			
		echo '
		<div style="margin:5px; margin-top:20px" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  	  	 <div class="row" style="margin-bottom:10px;">
            <div class=" col-sm-12 col-lg-12 col-xs-12">
                <div class="btn-group pull-right">
					<a class="btn btn-primary btn-sm pull-right" style="" href="'.site_url('/#view_data/'.$this->table).'"><i class="fa fa-download"></i> View '.titles("view").'s</a>
                </div>
            </div>    
        </div>	
        </div>	
        
  	  	';
		
		echo "<form action='insert' enctype='multipart/form-data'  method='post'>";
		foreach($this->fields as $id=>$f):
		$this->fieldset($f);
		endforeach;

		echo "<p><input type='hidden' value='$this->table' name='tbl_name'></p>";
		// $this->hide("tbl_name")
		// echo "<p><input type='submit' value='SAVE' class='btn btn-success form-control'></p>";
		$this->submitbtn();
		echo "</form>";
		
		echo "</div>";
		echo "</div>";
		
		
	}
	
	function submitbtn($name=null){
		echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 pull-left mt-4 form-group">';
		echo "<p><input type='submit' name='$name' value='SAVE' class='form-control btn btn-success'></p>";
		echo "</div>";
	}

	public function edit($a,$cm=null){
		$this->init($a);
		
		// spill($a);
		// spill($cm);
		// $pos = array_search($cm, $this->uri->segments)+1;
		// $last = isset($this->uri->segments[$pos])? "/".$this->uri->segments[$pos] : null;
		// $cm = "/".$cm.$last;
		// spill($cm);
		// $cm = null;


		$_SESSION["action"] = "update";
		echo "<form action='crud/save.php?t=$this->table' role='form' class='row' enctype='multipart/form-data' class='' method='post'>";
		foreach($this->fields as $id=>$f):
		$this->fieldset($f);
		endforeach;
		echo "<input type='hidden' name='rowid' class='' value='".$this->data[0]["id"]."'>";
		$this->submitbtn($this->table);
		
		echo "</form>";

		
	}
	
	
	function fieldset($d){
		$value_set = isset($this->values[$d->name])? $this->values[$d->name] : null;
		$value = $_SESSION["action"] == "update" ? $this->data[0][$d->name] : $value_set;

		$style = isset($this->combos[$d->name]) && !in_array(strtolower($d->name),$this->reserved)? "style='width:85%'" : "null";
		
		if(!in_array(strtolower($d->name),$this->reserved) && !in_array(strtolower($d->name),$this->reserved)){ 
			// spill($style);
			echo "<div class='form-group col-lg-3 col-md-4 col-sm-6 col-xs-12 pull-left' >";
		}else{
			// spill($this->reserved);
			// echo "<div>";
		}
			$this->label($d->name);
			$this->reserve_filter($d,$value);
			$this->combo_filter($d, $value);
			echo "</div>";
	}
	
	/* filter out reserved fields */
	function reserve_filter($d,$v){
		global $user;
		if(!in_array(strtolower($d->name),$this->reserved) && !isset( $this->combos[strtolower($d->name)])){
			
				
			if($d->type == "252" || $d->type == "textarea" || $d->type == "blob"){
				echo "<textarea type='text' name='$d->name' class='form-control'>$v</textarea>";
			}elseif($d->type == "7"){
				$v = @explode(" ",$v)[0];

				echo "<input class='form-control' required type='".$this->fieldtypes[$d->type]."' name='$d->name' value='$v' />";
			}else{
					
				if($d->name == "scode" || $d->name == "sid" ) {
					// $this->reserved[] = "scode";
					// spill($this->reserved);
					echo "<input type='hidden' name='$d->name' class='' value='".$user->scode."' />";
				}elseif(in_array($d->name, $this->pictures)){
					
					if($_SESSION["action"] == "update"){
						
						$img = is_file("img/".$this->table."/".$v)? "/img/".$this->table."/".$v : "/img/noimage.png";
						echo "<img src='".base_url($img)."' width='100px'>";
						
					} 
					echo "<input class='form-control' type='file' name='$d->name' value='$v' />";
				}else{
					echo "<input class='form-control' required type='".$this->fieldtypes[$d->type]."' name='$d->name' value='$v' />";
				}
			}
			
		}
		
	}
	
	/* hide some fields only in table view */
	function view_hidden($i){
		$this->view_hidden = explode(",",$i);
	}
	
	
	/* fill in selectbox bound fields */
	function combo_filter($d,$v){
		if(isset($this->combos[$d->name]) && !in_array(strtolower($d->name),$this->reserved)){
			echo "<select name='$d->name' class='form-control' >";
				foreach($this->combos[$d->name] as $i=>$j){
					$selected = $i == $v ? "selected" : null;
					echo "<option value='$i' $selected >".strtoupper($j)."</option>";
				}
			echo "</select>";
		}
	}
	
	function label($n){ 
		if(!in_array(strtolower($n),$this->reserved)){
			if( strtolower($n) !== "scode" && strtolower($n) !== "sid" ){
				$label = isset($this->aliases[$n]) ? $this->aliases[$n] : $n;
				echo "<div>".strtoupper($label)."</div>";
				
			} 
		}
	}
	
	function hide($a){
		$a = explode(",",$a);
		foreach($a as $b){
			$this->reserved[] = trim($b);
		}
	}
		
	
	
	protected function get($i){ 
		$l =[];
		$j = dbx()->query($i) or spill($this->db->error()); 
		while($r = $j->fetch_assoc()){ $l[] = $r;}
		$this->fields = $j->fetch_fields();
		$this->fieldnames = array_column((array)$this->fields, "name");
		return $l;
	}
		

	
	function arrlist($si){ 
		$l = [];
		$i = dbx()->query($si);
		if($i !== false ) { //$i = $i->fetch_array();
			while($ai = $i->fetch_array()){
				$bi[] = $ai;
			}
		$i = $bi;
			// spill($i);
		foreach($i as $j=>$k){
			$l[current($k)] = end($k);
		}
		}else{
			spill($this->db->error()["message"]);
		}
		return $l;
	}
	
	
}


/* actions via ajax */




?>


