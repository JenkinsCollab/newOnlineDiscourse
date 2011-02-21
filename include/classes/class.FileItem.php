<?php


class FileItem{

	var $id;
	var $hash;
	var $title;
	var $filename;
	var $citation;
	var $description;
	var $file_type;	//0 = link, 1 = file
	var $source_id;
	var $tags;
	var $poster_id;

	function FileItem(){
	
		//blank file
		if (func_num_args() == 1 && func_get_arg(0) == 0){
			//blank entries
		}
		//if passed id, lookup file in db
		else if (func_num_args() == 1 && !is_array(func_get_arg(0))){
			$id = clean_input(func_get_arg(0));
			$sql = "SELECT * FROM " . FILE_TABLE . " WHERE id=" . $id;
			$rsp = new Response($sql);
			
			$this->id = $rsp->get('id');
			$this->hash = $rsp->get('hash');
			$this->title = $rsp->get('title');
			$this->filename = $rsp->get('filename');
			$this->citation = $rsp->get('citation');
			$this->description = $rsp->get('description');
			$this->file_type = $rsp->get('file_type');
			$this->source_id = $rsp->get('source');
			$this->poster_id = $rsp->get('uid');
			
			//get tags
			$sql = "SELECT * FROM " . TAG_FILE_TABLE . " WHERE file=$id";
			$rsp = new Response($sql);
			$tags = array();
			foreach ($rsp->get_response() as $row){
				$tags[] = $row['tag'];
			}
			$this->tags = $tags;
			
		}
		//if passed full data array, just set variables
		else if (func_num_args() == 1 && is_array(func_get_arg(0))){
			
			$params = clean_input(func_get_arg(0));	//array of data
			
			$this->id = $params['id'];
			$this->hash = $params['hash'];
			$this->title = $params['title'];
			$this->filename = $params['filename'];
			$this->citation = $params['citation'];
			$this->description = $params['description'];
			$this->file_type = $params['file_type'];
			$this->source_id = $params['source_type'];
			$this->tags = $params['tags'];
			$this->poster_id= $params['poster_id'];
		}
	
	}




	//MEMORY MGMT

	function store(){
		//store file
		$sql = "INSERT INTO " . FILE_TABLE . " (id,filename,hash,title,description,file_type,citation,source,uid) VALUES ($this->id,'$this->filename','$this->hash','$this->title','$this->description',0$this->file_type,'$this->citation',$this->source_id,'$this->poster_id') 
					ON DUPLICATE KEY UPDATE title='$this->title', description='$this->description', citation='$this->citation', source=$this->source_id, uid='$this->poster_id'";
					
		$rsp = new Response($sql);
		if ($this->id == 0){
			$this->id = $rsp->get_id();
		}
		
		//get rid of previous tags
		$sql = "DELETE FROM " . TAG_FILE_TABLE . " WHERE file=$this->id";
		$rsp = new Response($sql);
		
		//store tags
		foreach ($this->tags as $tag){
			//add tags to table
			$sql_1 = "INSERT IGNORE INTO " . TAG_TABLE . " (tag) VALUES ('$tag')";
			$rsp_1 = new Response($sql_1);
			
			//get tag id
			$sql_2 = "SELECT * FROM " . TAG_TABLE . " WHERE tag='$tag'";
			$rsp_2 = new Response($sql_2);
			
			//put pair into table
			$sql_3 = "INSERT INTO " . TAG_FILE_TABLE . " (tag,file) VALUES (" . $rsp_2->get('t_id') . "," . $this->id . ")";
			$rsp_3 = new Response($sql_3);
		}
	}

	//delete file
	function remove(){
		$sql = "DELETE FROM " . FILE_TABLE . " WHERE id=$this->id";
		$rsp = new Response($sql);
		
		$sql = "DELETE FROM " . TAG_FILE_TABLE . " WHERE file=$this->id";
		$rsp = new Response($sql);
	}


	//ACCESSORS/MUTATORS
	
	
	function getId(){
		return $this->id;
	}
	
	function getHash(){
		return $this->hash;
	}
	
	function getTitle(){
		return $this->title;
	}
	
	function getFilename(){
		return $this->filename;
	}

	function getCitation(){
		return $this->citation;
	}
	
	function getDescription(){
		return $this->description;
	}
	
	function getFileType(){
		return $this->file_type;
	}
	function getSourceId(){
		return $this->source_id;
	}
	function getSourceType(){
		$sql = "SELECT * FROM " . SOURCE_TABLE . " WHERE source_id=$this->source_id";
		$rsp = new Response($sql);
		return $rsp->get('source_name');
	}
	
	//html builder
	function getSource(){
	
		//link
		if ($this->file_type == 0){
			return '<a target="_blank" href="http://' . $this->filename . '">Link</a>';
		}
		//file
		else if ($this->file_type == 1){
			return '<a href="index.php?cmd=download&id= ' . $this->id . '">Download</a>';
		}
		//info
		else if($this->file_type == 2 || $this->file_type == 3){
			return '<span>' . $this->filename . '</span>';
		}
	}
	
	function getSourceText(){
		return $this->filename;
	}
	
	function getTags(){
		
		//no tags
		if (empty($this->tags)) return '';
		
		$sql = "SELECT * FROM " . TAG_TABLE . " WHERE t_id=" . implode(' OR t_id=',$this->tags) . " ORDER BY tag ASC";
		$rsp = new Response($sql);
		
		$tag_names = array();
		foreach ($rsp->get_response() as $tag){
			$tag_names[] = $tag['tag'];
		}
		
		return implode(', ',$tag_names);
	}
	
	function getUser(){
		$sql = "SELECT * FROM " . USER_TABLE . " WHERE uid='$this->poster_id'";
		$rsp = new Response($sql);
		return $rsp->get('name');
	}


}


?>