<?php

		$gui = new GUI();
		echo $gui->buildHeader();
		echo $gui->buildSearchUI();
        
        $src ='<div id="content">
            <div id="search_window" class="">
						<form method="post" action="index.php">
							<h3 id="search_tag">' . $msg . '</h3>
							<input type="text" name="search" id="search_input" />
							<input type="submit" id="search_button" />
							<input type="hidden" name="cmd" value="search" />
						</form> ';
		if ($_SESSION['user']->hasAddPerm()){
			$src .=	'<a href="index.php?cmd=add" style="display:block;">New Entry</a>';
		}
       $src.='</div></div>';
       echo $src;
		echo $gui->buildFooter();

?>
