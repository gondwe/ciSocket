<?php 


class fieldsets {

	private $db;
	public $orient;
	
	function __construct(){
		$this->db = db();
	}

	
	function fsets(){
		global $user;
		// $sid = $user->scode;
		$sid = 1;
		switch($this->table){
			case "users" : 
				$this->hide("password,salt,activation_code,forgotten_password_code,
							created_on,last_login,ip_address,forgotten_password_time,remember_code");
				$this->combo("user_type","select id, b from dataconf where a = 'usertype'");
			break;
			
			case "settings":
				$this->aliases("pobox,address");
				$this->aliases["pnumber"] = "phone";
				$this->aliases["location"] = "town";
				$this->pictures[] = "sign";
				$this->pictures[] = "logo";
			break;
			
			case "patient_master":
			$this->combos("sex","select id, b from dataconf where a = 'gender'");
			$this->combos("category","select id, b from dataconf where a = 'patient_type'");
			break;

			
		}
		
	}

}