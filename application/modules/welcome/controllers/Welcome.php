<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {

	public function index()
	{
		$data["users"] = $this->db->get("users")->result();
		serve("welcome_message",$data);
	}
}
