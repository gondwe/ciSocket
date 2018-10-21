<?php 

class Systems extends CI_Controller {


    public function __construct(){
        parent::__construct();
    }
    
    
    function index(){
        
    }
    
    function admin(){
        $data = [];
        if($this->ion_auth->is_admin()){
            serve("dashboard",$data);
        }else{
            kickout("Admin Section. This Module is restricted to the referring usertype. Thanks");
        }
    }

    
    function developer(){
        $data = [];
        if($this->ion_auth->is_admin()){
            serve("developer",$data);
        }else{
            kickout("Developer Section. This Module is restricted to the referring usertype. Thanks");
        }
        
    }


    function lost(){
        serve("lost");
    }

    public function faqs(){
        render("faqs");
    }


    public function audit_trail($date=null){
        $data = [];
        render("trails",$data);
    }



}