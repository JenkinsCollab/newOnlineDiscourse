<?php

	include('include/kernel.php');




	if (!isset($_REQUEST['go'])){

		$file = fopen('upload.txt','r');
		
		$text;
		
		echo '<form action="upload.php" method="POST">
				<input type="hidden" name="go" value="go" />';
		
		while (!feof($file)){
			$text = fgets($file);
			$arr = explode(',',$text);
			//print_r($arr);
			
			$count = count($arr);
	
			$cit;
			for ($i = 0; $i < $count - 4; $i++){
				$cit .= $arr[$i];
			}
			//echo str_replace('~',',',$cit);
			echo 'CITATION: <textarea rows="5" cols="35" name="cite[]">' . str_replace('~',',',$cit) . '</textarea>';;
			
			echo '<br />';
			
			echo 'TITLE: <input type="text" name="title[]" />';
			
			echo '<br />';
			echo 'DESCRIPTION: <input type="text" name="desc[]" value="' . str_replace('~',',',$arr[$count - 1]) . '" />';
			echo '<br />';
			echo 'KEYWORDS: <input type="text" name="key[]" value="' . str_replace('~',',',$arr[$count - 2]) . '" />';
			echo '<br />';
			echo 'SOURCE: <input type="text" name="source[]" value="' . str_replace('~',',',$arr[$count - 3]) . '" />';
			echo '<br />';
			
	
			echo '<br />';
		}	
	
		
		echo '</form>';
	}
	else{
		
		
		for ($i=0; $i<count($_REQUEST['cite']); $i++){
			echo $_REQUEST['cite'][$i]. '<br />' . $_REQUEST['key'][$i];
			
		}
		
		
		
		
		
	}
	







//1iwa8a1ljxwi











?>