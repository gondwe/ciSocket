<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Model {

    function __construct()
    {
        $this->load->helper("template");
    }

    function recent(){
        // return $this->db->query("select * from patient_master order by date desc limit 100 ")->result_array();
        return gl("select * from patient_master order by date desc limit 100 ");
    }

}