<?php
class Crud extends MX_Controller {


    function __construct()
    {
        // $this->load->helper("fieldsets");
        // $this->load->library("tablo");
    }

    public function edit($table=null,$id=null){
        if(is_null($table) || is_null($id)) redirect("/", "refresh");
        
        $data["id"] = $id;
        $data["table"] = $table;
        serve("crud/edit",$data);
    }

    public function insert($t){
        $table = array_pop($_POST);
        $ref = $_SERVER["HTTP_REFERER"];
        insert($table);
        redirect($ref);
        
    }

    function new($table){
        $data["table"] = $table;
        serve("crud/new",$data);
    }

    public function save($t,$ref = null){
        // pf($this->uri);
        $ref = is_null($ref) ? $_SERVER["HTTP_REFERER"] : $ref;
        pf($ref);
        $table = $t;
        // exit();
        if(!empty($_POST)){
            $id = array_pop($_POST); 
            foreach($_POST as $k=>$v){ $fields[] = "`$k`='$v'"; }
            $fields = implode(", ",$fields);
            $sql = "update $table set $fields where id = '$id'";
            savefiles($table, $id);
            if(process($sql)){ datalog("save"); success("Save Successful"); }
            redirect($ref);
        }
    }


    public function view_data(){
        $i = current ( $_SESSION["params"] ) ;
        
        $d = new tablo($i);
        switch($i) {
            case "settings" : $d->hide("school_code,logo,sign,email,category"); break;
            case "patient_master" : $d->sqlstring = "Select * from `$i` limit 100"; break;
        }


        $d->table();
    }


    function delete($table,$id){
        $sql = "delete from `$table` where id = '$id'";
        if(process($sql)) datalog("del");
    }


    public function search($mod, $meth, $arg=''){
        if(isset($_POST["s"])){
            $req = ($_POST['s']);
            $echo = '';
            
            if($req !== ""){
                $data = [];
                $mdname = $mod."/".$mod."_model";
                $md2 = $mod."_model";
                
                $model = $this->load->model($mdname);
                $data = $this->$md2->$meth($req);

                foreach($data as $k=>$v){
                    $echo .= '<li id="reslist" class="form-control" data-rate="'.$v->unit_cost.'" data-id="'.$v->id.'" onclick=lod(this)>'.$v->item.'</div>';
                }
            }

            echo $echo;
        }
    }
}