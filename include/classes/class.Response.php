<?php

//handles generalized database access. takes a query and returns results
class Response{

	
	var $error = 0;	//0 if clear, 1 if error
	var $error_msg = '';	//message for storing errors
	var $response = array();	//actual array of response rows
	var $id = 0;
	var $size = 0;
	
	//only for debugging
	var $debug = true;	//debug flag
	var $sql;

    /**
     *Processes the sql string; sets error flag as necessary.
     * @param <type> $sql
     */
	function Response($sql){
		$this->sql = $sql;
		//process rows of request if no error and store in response array
		$result = mysql_query($sql) or $this->handle_error(mysql_error());
		if ($this->error == 0){
			if ($result != 1){
				while (($row = mysql_fetch_array($result,MYSQL_ASSOC)) != null){
					$this->response[] = $row;
				}
				$this->response = $this->clean_output($this->response);
				$this->size = count($this->response);
			}

			$this->id = mysql_insert_id();
		}

	}

	//returns 0 if request successful, 1 if error
	function get_status(){
		return $this->error;
	}

	//returns size
	function get_size(){
		return $this->size;
	}

	//returns array of responses indexed numerically
	function get_response(){
		return $this->response;
	}

	//returns value at key location for first row
	function get($key){
	
		//check that array is not empty
		if ($this->is_empty()){
			return null;
		}
		//check to make sure key is valid
		if (!array_key_exists($key,$this->response[0])){
			$this->handle_error("Attempt to access invalid index " . $key);
		}
		
		return $this->response[0][$key];
		
	}
	
	//check if response returned null
	function is_empty(){
		return count($this->response) === 0;
	}
	
	//get last id
	function get_id(){
		return $this->id;
	}

	
	// takes care of sql errors that are caught during the request
	function handle_error($msg){
		$this->error = 1;	//set error flag to 1
		$this->error_msg = $msg;	//capture the error message
		
		//if debugging is on, kill the program and print the message
		if ($this->debug){
			die ($this->error_msg . ' SQL: ' . $this->sql);
		}
	}



	//cleans input for database insertion
	private function clean_output($output){
	
		$clean = array();	//clean version of variable
	
		if (is_string($output)){
			$clean = htmlentities($output);
		}
		else if (is_numeric($output)){
			$clean = htmlentities($output);
		}
		else if (is_array($output)){
			foreach ($output as $k=>$i){
				$clean[$k] = $this->clean_output($i);
			}
		}
		
		return $clean;
		
	}














}

?>