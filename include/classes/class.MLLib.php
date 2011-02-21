<?php

//machine learning library
class MLLib{

	function MLLib(){
	
	}
















	
	//derive independant tags from user input
	function parseTags($tag_str){
		$to_return = array();
		$tags = explode(' ',$tag_str);
		foreach($tags as $val){
			$trimmed = strtolower(trim(trim($val),','));
			if (strlen($trimmed) > 1){
				$to_return[] = $trimmed;
			}
		}
		return $to_return;
	}


	function getSearchTermArray($term_str){
		$to_return = array();
		$temp = explode(' ',$term_str);
		foreach ($temp as $wrd){
			if (!$this->is_closed_class($wrd)){
				$to_return[] = $wrd;
			}
		}	
		return $to_return;
	}

	function is_closed_class($wrd){
		return strlen($wrd) < 4;
	}



}

?>