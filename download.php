<?php


	require_once('include/kernel.php');
	
	
	//guarantee file input
	if (!isset($_REQUEST['search']))	{
		header('location:index.php');
	}
	
	//get file info
	$id = clean_input($_REQUEST['id']);
	$fileItem = new FileItem($id);
	
	echo $fi->getHash();
	
	//execute download file
	header('Content-Description: File Transfer');
	header('Content-Type: application/force-download');
	header('Content-Length: ' . filesize(FILE_PATH . $fi->getHash()));
	header('Content-Disposition: attachment; filename=' . $fi->getName());
	readfile(FILE_PATH . $fi->getHash());































?>