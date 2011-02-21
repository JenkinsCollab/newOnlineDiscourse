<?php

boot();	//call main boot method

function boot(){

	import_config();
	
	import_libraries();

	import_interfaces();

	import_classes();

	load_session();
	
	//start database connection
	$db = new Database();
	$db->connect();
}

//import setup data
function import_config(){
	require_once('configure.php');
}	

//import interfaces
function import_interfaces(){
	//interface_exists('Interface') || require('Interface.php');
}	


//import all external libraries
function import_libraries(){
	//require_once('xajax/xajax_core/xajax.inc.php');
	//require_once('ajax/ajax_functions.php');
}

//load up all the classes in the classes directory
function import_classes(){
	
	class_exists('Database') || require('classes/class.Database.php');
	class_exists('Response') || require('classes/class.Response.php');
	class_exists('User') || require('classes/class.User.php');
	class_exists('GUI') || require('classes/class.GUI.php');
	class_exists('FileItem') || require('classes/class.FileItem.php');
	class_exists('Comment') || require('classes/class.Comment.php');
	class_exists('MLLib') || require('classes/class.MLLib.php');
}



//start user session
function load_session(){
	
	session_start();
	if (!isset($_SESSION['user'])) {
		$_SESSION['user'] = new User();
	}
}

//generate random string to salt the login password
function get_challenge(){
	$challenge = md5(uniqid(rand(), true));
	$_SESSION['challenge'] = $challenge;
	return $challenge;
}

//cleans input for database insertion
function clean_input($input){

	$clean;	//clean version of variable

	if (is_string($input)){
		$clean = mysql_real_escape_string(stripslashes(ltrim(rtrim($input))));
	}
	else if (is_numeric($input)){
		$clean = mysql_real_escape_string(stripslashes(ltrim(rtrim($input))));
	}
	else if (is_bool($input)){
		$clean = ($input) ? true : false;
	}
	else if (is_array($input)){
		foreach ($input as $k=>$i){
			$clean[$k] = clean_input($i);
		}
	}
	
	return $clean;
	
}




?>
