<?php

	include('include/kernel.php');


	$words = array();
	$bigrams =  array();

	$sql = "SELECT * FROM cd_file_table";
	$rsp = new Response($sql);

	$rows = $rsp->get_response();
	
	foreach ($rows as $row){
		$cite = $row['citation'];	
		$citearr = explode(' ',$cite);
		
		$prev = null;
		foreach ($citearr as $word){
			$words[$word] += 1;
			
			if ($prev != null){
				$bigrams[$prev . ' ' . $word] += 1;
			}
			$prev = $word;
			
		}
	}
	

	echo 'Unigrams<br />';
	
	while (!empty($words)){
		$best_word;
		$max_val = 0;
		foreach ($words as $word=>$val){
			if ($val > $max_val){
				$max_val = $val;
				$best_word = $word;
			}
		}
		
		echo $best_word.': ' . $max_val.'<br/>';
		unset($words[$best_word]);
	}



	echo '<br /><br /><br /><br /><br />Bigrams<br />';
	
	while (!empty($bigrams)){
		$best_bigram;
		$max_val = 0;
		foreach ($bigrams as $bigram=>$val){
			if ($val > $max_val){
				$max_val = $val;
				$best_bigram = $bigram;
			}
		}
		
		echo $best_bigram.': ' . $max_val.'<br/>';
		unset($bigrams[$best_bigram]);
	}



	echo '<br /><br /><br /><br />Tags:<br />';
	
	$sql = "SELECT * FROM cd_tags";
	
	$rsp = new Response($sql);
	
	foreach ($rsp->get_response() as $row){
		echo $row['tag'] . '<br />';	
	}








?>