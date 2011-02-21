<?php


class User{

	var $id;	//id assigned by ning
	var $username;
	var $auth_lvl;	//0 = not authed, 1 = public, 2 = participant, 3 = advisory panel

	function User(){
	
		$this->auth_lvl = 2;
	}


	//sets authenticated to true if information stored in db matches
	function authenticate($id, $user, $sig){
	
	
		//check referrer
		$valid_addr = 'http://' . NETWORK . '.ning.com';
		if (substr($_SERVER['HTTP_REFERER'],0,strlen($valid_addr)) != $valid_addr){
			$this->auth_lvl = 0;
			return;
		}
	
		//make sure signature matched
		$auth_received;	//level of received signature
		
		//if public signature
		if ($sig == $this->publicHash($id)){
			$auth_received = 1;
		}
		//participants
		else if ($sig == $this->participantHash($id)){
			$auth_received = 2;
		}
		//if advisory signature
		else if ($sig == $this->advisoryHash($id)){
			$auth_received = 3;
		}
		//admins
		else if ($sig == $this->adminHash($id)){
			$auth_received = 4;
		}
		//no signature
		else {
			$this->auth_lvl = 0;
			return;
		}
	
		//get current auth level
		$sql = "SELECT authlvl FROM " . USER_TABLE . " WHERE uid='$id'";
		$rsp = new Response($sql);
		if (!$rsp->is_empty()){
			$auth_received = max($auth_received,$rsp->get('authlvl'));
		}
	
	
		$sql = "INSERT INTO " . USER_TABLE . " (uid,name,authlvl) VALUES ('$id','$user',$auth_received) ON DUPLICATE KEY UPDATE authlvl=$auth_received";
		$rsp = new Response($sql);
		
		
		$this->id = $id;
		$this->username = $user;
		$this->auth_lvl = $auth_received;	
	}





	//authentication hashes
	function publicHash($id){
		return sha1($id . 'worldpeace');
	}
	
	function advisoryHash($id){
		return sha1($id . 'unitedwestand');
	}

	function participantHash($id){
		return sha1($id . 'bravenewworld');
	}
	
	function adminHash($id){
		return sha1($id . 'interregnum');
	}


	//ACCESSORS MUTATORS
	
	function getId(){
		return $this->id;
	}
	
	

	function getName(){
		return $this->username;
	}




	//authorization methods
	
	function getAuthed(){
		return $this->auth_lvl > 0;
	}
	
	function hasAddPerm(){
		return $this->auth_lvl > 1;
	}

	function hasEditPerm($id=0){
		if ($id == 0) return true;	//new file
		if ($this->auth_lvl == 4) return true;	//is admin
		$fi = new FileItem($id);
		$sql = "SELECT uid FROM " . FILE_TABLE . " WHERE id=$id";
		$rsp = new Response($sql);
		
		return $rsp->get('uid') == $this->id;
		
	}	
















}

?>