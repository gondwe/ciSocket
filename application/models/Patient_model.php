<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {

    function __construct()
    {
        $this->load->helper("template");
    }


    public function clinics($section = null){
        $types = gl("select id, b as section from dataconf where a='patient_type' ");
		$data["clinic_types"] = $types;
		$data["category_count"] = gl("select dc.b as section, count(pm.id) as total from patient_master as pm left join dataconf as dc on dc.id = pm.category group by dc.id");
        $data["section"] = is_null($section)? current(array_keys($types)) : $section;
        return $data;
    }
    function recent(){
        $data["clinics"] = $this->clinics();
        
        $data["recent"] = get("select p.*, ucase(p.patient_names) as patient_names, pt.b as ptype from patient_master as p 
        left join dataconf as pt 
        on pt.id = p.category and pt.a = 'patient_type' 
        order by p.date desc limit 100 ");
        return $data;
    }

    function namesearch($i){
        return get("select p.*, pt.b as ptype from patient_master as p 
        left join dataconf as pt 
        on pt.id = p.category and pt.a = 'patient_type' 
        where patient_names like '%$i%' or nationalid like '$i' or tel1 like '$i' order by p.date desc");
    }

    function profile($id){
        return get("select p.*, pt.b as ptype from patient_master as p 
        left join dataconf as pt 
        on pt.id = p.category and pt.a = 'patient_type' 
        where p.id = '$id'");

    }

    public function patient_details($id){
        $id = current($id)->charge_id;
        return $this->profile($id);
    }

}