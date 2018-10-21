<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {
	
	public function serve($view=null){
		$this->load->view("partial/header");
		$this->load->view($view);
		$this->load->view("partial/footer");
	}
}


function spill($i){
	echo "<pre>";
	print_r($i);
	echo "</pre>";
}

function serve($i){
	$ci = &get_instance();
	$ci->template->serve($i);
}