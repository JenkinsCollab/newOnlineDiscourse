<?php


	require_once('include/kernel.php');
	
	$pages = array('browseAuthor'=>'browseAuthor.php');

    $curPage = 'home';
    if(isset($_GET['page']) && array_key_exists($_GET['page'],$pages))
        $curPage = $_GET['page'];

    $mainContentFile = 'home.php';
    if(array_key_exists($curPage,$pages)) {
        $mainContentFile = $pages[$curPage];
    }

	//get user authentication info and handle accordingly
	if (isset($_REQUEST['sig'])){
		$uid = clean_input($_REQUEST['id']);
		$uname = clean_input($_REQUEST['username']);
		$sig = clean_input($_REQUEST['sig']);
		
		$_SESSION['user']->authenticate($uid,$uname,$sig);
	}
	
	$cmd = isset($_REQUEST['cmd']) ? clean_input($_REQUEST['cmd']) : 'main';

	//if auth failed, do not proceed
	if (!$_SESSION['user']->getAuthed()){
		echo $_SESSION['user']->authlvl;
		$cmd = 'auth';
	}

	//problems logging in
	if ($cmd == 'auth'){
		$gui = new GUI();
		echo $gui->getAuthError();
	}
    $gui = new GUI();
    echo $gui->buildHeader();
    include 'pages/'.$mainContentFile;
    echo $gui->buildFooter();

	//case for having received search results
	/*else if ($cmd == 'search'){
	
		//guarantee search input
		if (!isset($_REQUEST['search'])){
			header('location:index.php');
		}
		
		//build page
		$search = clean_input($_REQUEST['search']);
		
		//store search terms
		$_SESSION['search_term'] = $search;
		$_SESSION['is_id'] = $_REQUEST['is_id'] == "true" || !isset($_REQUEST['is_id']);
		
		$gui = new GUI();
		echo $gui->buildHeader();
		echo $search == '' ? $gui->buildSearchUI() : $gui->buildSearchResults($search);
		echo $gui->buildFooter();
	}
	//file download request
	else if ($cmd == 'download'){
		
		//guarantee file input
		if (!isset($_REQUEST['id']))	{
			header('location:index.php');
		}
		
		//get file info
		$id = clean_input($_REQUEST['id']);
		$fi = new FileItem($id);
		$f_title = implode("_",explode(" ",$fi->getFilename()));
		$file = FILE_PATH . $fi->getHash();
		
		//execute download file
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='. $f_title);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		ob_clean();
		flush();
		readfile($file);
		exit;
	}
	//data for an entry has come in for change
	//precondition: this must be before view and add
	else if ($cmd == 'save'){
	
		//get rid of unauthed users
		if (!$_SESSION['user']->hasAddPerm()){
			header('location:index.php');
		}
	
		$time = time();
		$ml = new MLLib();
		
		//save
		$id = clean_input($_REQUEST['id']);
		$title = clean_input($_REQUEST['title']);
		$desc = clean_input($_REQUEST['description']);
		$cite = clean_input($_REQUEST['citation']);
		$filetype = clean_input($_REQUEST['file_type']);
		$source = clean_input($_REQUEST['source_type']);
		$tags = $ml->parseTags(clean_input($_REQUEST['tags']));
		$poster_id = $_SESSION['user']->getId();
		
		//link
		$filename;
		if ($filetype == 0){
			$filename = clean_input($_REQUEST['link_name']);
			if (substr($filename,0,7) == 'http://'){
				$filename = substr($filename,7);
				
			}
		}
		else if ($filetype == 2){
			$filename = clean_input($_REQUEST['info_name']);
		}
		//n/a
		else if ($filetype == 3){
			$filename = "N/A";
		}
		
		$filedata = array();
		$filedata['id'] = $id;
		$filedata['filename'] = $filename;
		$filedata['hash'] = sha1($filename . time());
		$filedata['title'] = $title;
		$filedata['description'] = $desc;
		$filedata['citation'] = $cite;
		$filedata['file_type'] = $id != 0 ? 0 : $filetype;
		$filedata['source_type'] = $source;
		$filedata['tags'] = $tags;
		$filedata['poster_id'] = $poster_id;
		
		//add new entry to file table
		$fi = new FileItem($filedata);
		
		$fi->store();
			
		//normal save
		if ($_REQUEST['save_type'] == 0){			
			header('location:index.php?cmd=view&id=' . $fi->getId());
		}
		//save and add another
		else {
			header('location:index.php?cmd=add');
		}
	}
	//display entry for single item
	else if ($cmd == 'view'){
	
		//guarantee id input
		if (!isset($_REQUEST['id'])){
			header('location:index.php');
		}
		
		$id = clean_input($_REQUEST['id']);
		
		//if user posted comment, add to db
		if (isset($_REQUEST['comment'])){
		$comment = clean_input($_REQUEST['comment']);
			$cmt = new Comment(clean_input($_SESSION['user']->getId()),$id,time(),clean_input($comment));
			$cmt->store();
		}
		
		//build page
		$gui = new GUI();
		echo $gui->buildHeader();
		echo $gui->buildView($id);
		echo $gui->buildFooter();
	}
	//add new source
	else if ($cmd == 'add'){
	
		$id = isset($_REQUEST['id']) ? clean_input($_REQUEST['id']) : 0;
	
		//clear search if got here from main screen
		if ($id == 0){
			$_SESSION['search_term'] = '';
		}	
	
		//build page
		$gui = new GUI();
		echo $gui->buildHeader();
		echo $gui->buildAdd($id);
		echo $gui->buildFooter();
	}
	//delete
	else if ($cmd == 'delete'){
		
		//guarantee id input
		if (!isset($_REQUEST['id'])){
			header('location:index.php');
		}
		
		$id = clean_input($_REQUEST['id']);
		
		$fi = new FileItem($id);
		
		if ($_SESSION['user']->hasEditPerm($id)){
			$fi->remove();
		}
		
		header('location:index.php?cmd=search&search=' . $_SESSION['search_term']);
	}
	else if ($cmd == 'browse'){
		$gui = new GUI();
		echo $gui->buildHeader();
		echo $gui->buildBrowseUI(clean_input($_REQUEST['type']));
		echo $gui->buildFooter();
	}	
	//general case: search input field
	else{
		$gui = new GUI();
		echo $gui->buildHeader();
		echo $gui->buildSearchUI();
		echo $gui->buildFooter();
	}*/





















?>