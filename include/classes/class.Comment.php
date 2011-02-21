<?php


class Comment{


	var $id;	//coment id
	var $uid;	//user id
	var $uname;	//user name
	var $fid;	//file id
	var $time;
	var $text;
	

	function Comment($id=0){
	
		$this->id = 0;	//start at null
	
		//if an id is passed in
		if (func_num_args() == 1){
			$this->load($id);
		}
		//if custom arguments are passed in
		else{
			$this->uid = func_get_arg(0);
			$this->fid = func_get_arg(1);
			$this->time = func_get_arg(2);
			$this->text = func_get_arg(3);
		}
	}
	
	//load from database
	function load($id=0){
	
		if ($id == 0) return;	//no id specified
	
		$id = clean_input($id);
		$sql = "SELECT * FROM " . COMMENT_TABLE . " JOIN " . USER_TABLE . " ON  " . USER_TABLE . ".uid=" . COMMENT_TABLE . ".uid WHERE id=$id";
		$rsp = new Response($sql);
		
		$this->id = $id;
		$this->uid = $rsp->get('uid');
		$this->uname = $rsp->get('name');
		$this->fid = $rsp->get('fid');
		$this->time = $rsp->get('time');
		$this->text = $rsp->get('text');
	
	}
	
	//store in db
	function store(){
		
		$sql = "INSERT INTO " . COMMENT_TABLE . " (id,uid,fid,time,text) VALUES ($this->id,'$this->uid',$this->fid,$this->time,'$this->text')";
		$rsp = new Response($sql);
	}





	//ACCESSORS/MUTATORS
	
	function getTime(){
		return $this->time;
	}
	
	function getUser(){
		return $this->uname;
	}

	function getText(){
		return htmlentities($this->text);
	}






















}

?>