<?php

	include('include/kernel.php');

	//print_r( $_REQUEST['ids']);

	if (!isset($_REQUEST['ids'])){ 

		$sql = "SELECT * FROM " . FILE_TABLE . " WHERE isnull(author) AND isnull(year)";
		$rsp = new Response($sql);
		
		echo '<form action="temp.php" method="POST">';
		
		
		$count = 0;
		
		foreach ($rsp->get_response()  as $resp){
			
			$citation = $resp['citation'];
		
			$matches;
			$authors;
			preg_match('/(.+?)(\\.|-)/',$citation,$matches,PREG_OFFSET_CAPTURE);
			
			if (!empty($matches)){
				$authors = implode('#',explode(' and ',$matches[1][0]));
			}
			
			//print_r($matches);
		
			$id =  $resp['id'];
			echo '<input type="hidden" name="ids[]" value="' . $id . '" />';
			echo '<input type="text" size="50" name="authors[' . $id . ']" value="' . $authors . '" />';	
			echo '<br />';
			
			//grab year
			$year;
			$matches;
			preg_match('/\\d{4}/',$citation,$matches,PREG_OFFSET_CAPTURE);
			//print_r($matches);
			
			if (!empty($matches)){
				$year = $matches[0][0];
			}
			
			
			echo '<input type="text" name="year[' . $id . ']" size="50" value="' . $year . '" />';
			echo '<br />';
			echo $resp['citation'];
			echo '<br /><br />';
			
			unset($authors);
			unset($year);
			
			$count ++;
			
			if ($count % 30 == 0){
				echo '
				<br />
				<br />
				<br />
				<br />
				<br /><input type="submit" />
				<br />
				<br />
				<br />
				<br /></form><form action="temp.php" method="POST">';
			}
			
		}
	
	
		echo '<input type="hidden" name="go" value="go" /><input type="submit" /></form>';
	}
	
	else{
	
	print_r($_POST['ids']);
	
		foreach ($_REQUEST['ids'] as $id){
		
			$sql = "UPDATE " . FILE_TABLE . " SET author='" . $_REQUEST['authors'][$id] . "', year='" . $_REQUEST['year'][$id] . "' WHERE id=$id";
			echo $sql;
			$rsp = new Response($sql);
		
		}
		
	
	}


//1iwa8a1ljxwi











?>