<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function fbAppId(){ return "1653365274883779"; }


function fbVersion(){ return "v2.4";}


//function to count the number of words in a string
/**
 * 
 * @param type $string
 * @return type
 */
function wordCount($string){
    $a = explode(" ", $string);
    
    return count($a);
}


/**
 * 
 * @param type $phoneNumber
 * @return string
 */
function is_phone_number($phoneNumber){
    if (preg_match("/^[0-9]*$/", $phoneNumber)) {
        return $phoneNumber;
    } 

    else {
        return ""; // return empty string
    }
}

// to ensure input is a real name i.e. only alphabets are allowed
/**
 * 
 * @param type $name
 * @return string
 */
function is_real_name($name)
{
    $name = stripslashes(trim($name));
    $name = strip_tags($name);
    $name = htmlentities($name);
    
    if (preg_match("/^[a-zA-Z ]*$/", $name)) {
        return $name;
    } 

    else {
        return ""; // return empty string
    }
}

// to ensure only integer is allowed
/**
 * Used to ensure $value is an integer
 * @param type $value
 * @return int or empty string on failure
 */
function only_int($value)
{
    if (preg_match("/^[0-9]*$/", $value)) {
        return $value;
    } 

    else {
        return FALSE; // return empty string
    }
}

// to ensure input is in email format
/**
 * Checks whether string is a well-formatted email
 * @param String $email The string to be checked
 * @return string
 */
function is_email($email)
{
    $email = stripslashes(trim($email));
    $email = strip_tags($email);
    $email = htmlentities($email);
    
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitize email
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email = strtolower($email); // change case to lower
        return $email;
    } 

    else {
        return ""; // return empty string if error encountered
    }
}


// to allow only numbers, alphabets, underscore and fullstop. This is suitable for username
/**
 * 
 * @param type $name
 * @return string
 */
function is_username($name)
{
    $name = stripslashes(trim($name));
    $name = htmlentities($name);
    
    if (preg_match("/^[a-zA-Z 0-9_.]*$/", $name)) {
        return $name;
    } 

    else {
        return ""; // return empty string
    }
}

// to encrypt password
/**
 * 
 * @param type $pword
 * @return type
 */
function hash_pass($pword)
{
    $salt1 = "*&!mm3v6*_";
    $salt2 = "ki3fr+_@";
    
    $new_pword = hash('ripemd128', "$salt1$pword$salt2");
    
    return $new_pword;
}

// to check if url is valid
/**
 * 
 * @param type $url
 * @return string
 */
function is_url($url)
{
    $url = filter_var($url, FILTER_SANITIZE_URL); // sanitize url
    
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return $url;
    } 

    else {
        return "";
    }
}


/**
 * 
 * @param type $errorCode
 * @return string
 */
function getFileError($errorCode)
{
    if ($errorCode > 0) { // if error code is greater than 0
        
        switch ($errorCode) {
            case 1:
                $msg = "Exceeds upload_max_file in php.ini";
                break;
            
            case 2:
                $msg = "Exceeds max_file_size in html";
                break;
            
            case 3:
                $msg = "partially uploaded";
                break;
            
            case 4:
                $msg = "no file uploaded";
                break;
            
            case 6:
                $msg = "no temp folder";
                break;
            
            case 7:
                $msg = "unable to write to disk";
                break;
            
            case 8:
                $msg = "file upload stopped";
                break;
        }
        
        return $msg;
    }
}


/**
 * 
 * @param type $valueToFilter
 * @return string
 */
function spam_filter($valueToFilter){
    $unallowed = [
        'to:',
        'cc:',
        'bcc:',
        'content-type:',
        'mime-version:',
        'multipart-mixed:',
        'content-transfer-encoding:'
    ];
    
    // loop through the array to check if any value in the array is found in the $value sent by caller
    foreach ($unallowed as $spam) {
        if (stripos($valueToFilter, $spam) !== FALSE) { // false will be returned if $spam is not found in $valueToFilter. stripos() is case-insensitive
            return ""; // return an emoty string is $spam is found in $valueToFilter. This will break out of the spam_filter()
        }
    }
    
    // if no spam is found, replace any occurence of \r, \n, %0a, %0d with a space and return trimmed version of $valueToFilter
    str_replace(array(
        "\r",
        "\n",
        "%0a",
        "%0d"
    ), ' ', $valueToFilter);
    return trim($valueToFilter);
}


//to be used as naming convention for team and task names
/**
 * 
 * @param type $name
 * @return string
 */
function allowedName($name){
    $name = stripslashes(trim($name));
    $name = htmlspecialchars($name);
    $name = strip_tags($name);
    
    if (preg_match("/^[a-zA-Z 0-9._-]*$/", $name)) {
        return $name;
    } 

    else {
        return ""; // return empty string
    }
}



/**
 * @description function to generate random string with an underscore in between
 * @param string $codeType string to pass as 2nd param to random_string() e.g. alnum, numeric
 * @param int $minLength minimum length of string to generate
 * @param int $maxLength maximum length of string to generate
 * @param string $delimiter [optional] The string to put in between the first and second strings Default is underscore
 * @return string $code the new randomly generated code
 */
function generateRandomCode($codeType, $minLength, $maxLength, $delimiter = "_"){
    $totLength = rand($minLength, $maxLength-1);
    
    $b4_ = rand(1, $totLength-1);//number of strings before the underscore
    $afta_ = $totLength - $b4_;//number of strings after the underscore
    
    $code = random_string($codeType, $b4_) . $delimiter . random_string($codeType, $afta_);
    
    return $code;
}


/**
 * @description creates dir for new users and copy an index file to the subdir to prevent illegal access to them from the url
 * @param string $userCode the code of the new user to create the directories for
 */
function mkdirAndCopyFiles($userCode){
    //make dir for user creating a folder to hold all user's files
    mkdir("../smartfiles/users/$userCode/profile_pics", 0755, TRUE);//profile pictures folder
    mkdir("../smartfiles/users/$userCode/pc", 0755, TRUE);//files shared in a personal chat
    mkdir("../smartfiles/users/$userCode/conf", 0755, TRUE);//files share in a video call/conference


    //copy an index html file to directories to prevent access to the the folder contents from URL
    
    copy("../smartfiles/users/index.html", "../smartfiles/users/$userCode/index.html");
    copy("../smartfiles/users/index.html", "../smartfiles/users/$userCode/profile_pics/index.html");
    copy("../smartfiles/users/index.html", "../smartfiles/users/$userCode/pc/index.html");
    copy("../smartfiles/users/index.html", "../smartfiles/users/$userCode/conf/index.html");
}


/**
 * Array of file extensions regarded to be a document.
 * Used in separating file types inserted into the column 'type' of files table
 * Used in Task/fileUpload (at least)
 * @return array
 */
function docArray(){
    return ['.doc', '.docx', '.pdf', '.xls', '.ppt', '.pptx', '.csv', '.xlsx', '.dot', '.docm', '.dotx', '.dotm', '.docb',
        '.xlt', '.xlm', '.xlsm', '.xltx', '.xltm', '.xlsb', '.xla', '.xlam', '.xll', '.xlw', '.pot', '.pps', '.pptm', '.potx',
        '.potm', '.ppam', '.ppsx', '.ppsm', '.sldx', '.sldm', '.pub', '.odt', '.fb2', '.ps', '.wpd', '.wp', '.wp7', '.accdb',
        '.accde', '.accdt', '.accdr', '.xps'];
}


/**
 * Array of url endings (e.g. '.com')
 * Used in getting url from a string that looks like a url but doesn't start with a protocol or 'www'
 * @return array
 */
function urlArray(){
    return ['uk', 'za', 'com', 'net', 'name', 'ng', 'edu', 'ca', 'org', 'edu'];
}



/**
 * Creates link to unsubscribe from a notification email
 * @param type $userEmail
 * @param type $userId
 * @param type $userCode
 * @param type $subsciptionType
 * @return string
 */

function unsubscribeLink($userEmail, $userId, $userCode, $subsciptionType){
   $rand = generateRandomCode(20, 30);
   $random = generateRandomCode(30, 40, "");


   //replace the "@" in email so as to be able to safely PASS it in URL
   $urlEmail = str_replace(['@', '.'], ['at', 'dot'], $userEmail);


   $unsubscribeLink = base_url()."subscription/unsubscribe/$random/$userCode/$subsciptionType/$urlEmail/$userId/$rand";

   return $unsubscribeLink;
}


function igcEmail(){
    return "fourty400@gmail.com";
}


//=====================================ndk=================================================
// =========================================================================================
// =========================================================================================
// =========================================================================================
// =========================================================================================
// =========================================================================================

function serve($view, $data=[]){
	$ci = &get_instance();
	$ci->load->view("partial/header");
	$ci->load->view($view,$data);
	$ci->load->view("partial/footer");
}

function render($a,$b=null){ serve($a,$b);}

function dbx(){	$ci = & get_instance(); return $ci->db; } 
	function clean($i){ $d = &get_instance()->db->conn_id; return mysqli_real_escape_string($d, $i);}
	function spill($i){echo "<pre>";print_r($i);echo "</pre>";}function pf($i){spill($i);}
 	function run($a){return process($a);}
	function process($sql){ $db = dbx(); $_SESSION["erc"] = $j = ($db->query($sql))? TRUE :FALSE; if(!$j) notice($db->error,1); return $j; }  
	function process2($sql){$db = dbx();if($d = $db->query($sql)){$j = TRUE; }else{ spill($db->error);$j = FALSE;}$_SESSION["erc"] = $j;return $d;}
	function get($i=""){if($i !== ""){$l = []; $j = process2($i); return $j->result_object();  } } 
	function gl($i,$p=null){$raw = get($i);if(empty($raw)){ return []; }else{ 
		if(count((array)$raw[0])==2){
		 foreach($raw as $j=>$k){$l[current($k)] = end($k);}} else{ 
			 if(count((array)$raw[0])>2){ 
				 foreach($raw as $j=>$k) { 
					if($p) { $l[current($k)] = $k; }else{ $l[$j] = $k; }
					}}else{ 
						 foreach($raw as $j=>$k) { 
							 foreach($k as $m=>$n): $l[] = $n; endforeach;} } }} if(count((array)$l) == 1){ $l = current($l); } return $l; }
	function fetch($i){$a = get($i);$b = isset($a[0])?$a[0] : [];$c = current($b);return $c;}

	/* global vars */
	$err = "";
	$user = isset($_SESSION["hms"])? $_SESSION["hms"] : [];
	$sid = loggedin()? $user->scode : null;
	$page = $_SERVER["PHP_SELF"]; $page = explode("/",$page); $mypage = end($page);
	$authpages = ["login.php","storage.php","signup.php","register.php", "forgot.php"];
	if(isset($_SESSION["hms"])) $uid = $user->id; 

	function rx($i,$j=0){$i = strtolower($i); $i = preg_replace("/[ \/]/","_",$i); return $j ? strtoupper($i):ucwords($i);}
	function rxx($i,$j=0){$k = str_replace("_"," ", strtolower($i)); return $j? strtoupper($k):ucwords($k);}
	
	function am_i_logged_in(){ if(loggedin()) header("location:./#"); }
	function loggedin(){ return isset($_SESSION["hms"])?true : false ; }
	function login($u,$p)
	{
		global $err;
		$found = fetch("select count(id) from users where username = '$u' ");
		if($found){
			$sql = fetch("select password from users where username = '$u' ");
			if(password_verify($p,$sql)){
				$err =  "Welcome";
				$user = getlist("select * from users where username = '$u' ");
				$_SESSION["hms"] = $user;
				header("location:./#");
			}else{
				$err =  "Password Incorect!";
			}
		}else{
			$err =  "User Not Found!";
		}
	}

	function insert($t,$p=null){
		$post = is_null($p)? $_POST :$p ;

		foreach($post as $k=>&$p){
			$post[$k] = clean($p);
		}

		$f = implode("`,`",array_keys($post));
		$v = implode("','",array_values($post));
		$sql = "insert into $t (`$f`) values('$v')";
		// pf($sql);
		if(process($sql)){
			$r = fetch("select max(id) from $t");
			savefiles($t, $r);
			// success("Save Successful");
			// return "Save Successful";
			return true;
		}
		
	}


	function savefiles($t, $r){
		if(!empty($_FILES)){
			// spill($_FILES);
			foreach($_FILES as $i=>$j){
				$p = save_pic($t,$i);
				if($p !== ""){
					$sql = "update $t set `$i` = '$p' where id = $r";
					process($sql); 
				}
			}
		}
	}



	function save_pic($table, $fldname, $type=1){

		$uploads = '../img';
		$trailer = "";
		$files=$_FILES;

		$time = microtime(1)*10000;
		$name =$files[$fldname]['name'];
		if($name !== ''){
		
		$esx = explode(".",$name);
		$esx = end($esx);
		$extension = strtolower($esx);		
		$allowed = $type == 1 ? ['jpg','jpeg','png',] : ['jpg','jpeg','png','txt','doc','docx','ppt','pptx','xls','xlsx','accdb','mdb','pdf'];
		if(in_array($extension,$allowed)){		
		$location =$uploads."/".$table."/";
		if (!@mkdir($location, 0777)) {$dh = opendir($location);closedir($dh);}		
		if(move_uploaded_file($files[$fldname]['tmp_name'],$location.$name))
		{   $trailer = $time.".".$extension;rename($location.$name, $location.$trailer);	}
		else{echo("Upload Fail! : ".$location.$name);}
		}else{ echo("Incorrect file format :.".$extension); }}
		return $trailer;
		
	}


	function image($url,$tbl=null){
		$tbl = is_null($tbl)? null : $tbl."/";
		return site_url("/img/$tbl".$url);
	}

	function get_params(){
		$p = $_SESSION["params"];array_shift($p);return $p;
	}

		
	function datalog($op){
		code("logging CRUD activity..\n");
		$id =$_SESSION["user_id"];
		$username = fetch("select username from users where id = '$id'");
		$h = fopen("assets/lfclogs.txt","a");
		fputs($h, date("d/m/YG:i:s").",OP:".$op.",Acc:".$username.";");
		fclose($h);
		code("Log successful\n");
		// echo("Press OK to Continue\n");
	}

	function code($i){ echo "<code>$i</code>"; }

	function protect_page(){ if(!isset($_SESSION["user_id"])) redirect("auth/logout"); }

	function age($d,$op=false){
		$p = (date_diff(date_create($d),date_create()));
		$dr = ["d"=>"days","y"=>"years","w"=>"weeks","m"=>"months","h"=>"hours","i"=>"minutes","s"=>"seconds"];
		if($op) return $p[$op];
		foreach($p as $k=>$v){
			if($v > 0) return $v." ".$dr[$k];
		}
	}

	function titles($t,$more = false, $btn=false){
		if(isset($_SERVER["HTTP_REFERER"])){
			$ref = $_SERVER["HTTP_REFERER"]; $here = $_SERVER["REQUEST_URI"];
			if($btn){
				$j = preg_match("*".$here."*",$ref,$c);
				if($j){$label = "BACK";}else{ $label = "CANCEL";$_SESSION['back'] = $ref;}
				$r = $_SESSION["back"];
			}
		
			echo "<h5 class='m-4 pull-left'>";
			echo proper($t)." <span class='text-primary'>".rxx($more)."</span>";
			if($btn) echo "<a href='".$r."' class='ml-3 mb-2 btn btn-sm btn-danger'>".$label."</a>";
			echo "</h5>";
		}else{
			echo "<h5 class='m-4 pull-left'>$t</h5>";
			
		}
	}
	

		
function ucase($i){
    return strtoupper($i);
}

function pno($i){
	return "<span class='text-danger'>".str_pad($i,4,"0", STR_PAD_LEFT)."</span>";
}

function pflink($id){
	$names = fetch("select patient_names from patient_master where id = '$id'");
	return "<a style='color:#009688' href='".base_url('patient/profile/'.$id)."'>".rxx($names,2)." | pNo.".pno($id)."</a>";
}

function topic($i){
	return "<h5 class='m-3' style='color:#28a745 !important'> ".rxx($i)."</h5>";
}

function newbtn($a,$b=null,$c="ADD"){
	return '<a href="'.base_url($a).'" class="btn btn-sm btn-primary m-4" >'.$c.' '.rxx($b,2).' <i class="fa fa-plus"></i></a>';
}

function datef($d){
    return date_format(new DateTime($d),"D jS M, Y G:i:s A");
}

function success($msg){
	$_SESSION["infoh"] = strip_tags($msg); 
	// die();
}
function warning($msg){
	$_SESSION["errorh"] = strip_tags($msg); 
}
function notice($msg,$p=0){
	if($p) { $_SESSION["wnotice"] = strip_tags($msg); }else{ $_SESSION["notice"] = strip_tags($msg); }
}

function error($msg){ warning($msg); }



function notify($mess='test',$warning=false, $push = false){
	global $user;
	// $user = $username;
	$color = $warning ? "#ff5722" : "#6610f2";
	echo $msg = '<div id="swal2" class="alert text-light alert-dismissible show fade pull-right col-sm-5" style="z-index:2000;background:'.$color.'; margin:5px;bottom:5px; position:fixed;right:5px; " role="alert"><span id="chatTarget">'.$mess.'</span><button type="button" class="close" style="" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
	echo "
	<script>
		setTimeout(function(){ $('#swal2').fadeOut(2000, 'linear'); },3000)
    </script>
    ";
}

function kickout($info=null){ serve("auth/security", ["info"=>$info]); }