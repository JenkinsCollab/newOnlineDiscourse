<?php

class GUI{


	var $standard_stylesheet;
	var $functional_js;
	
	//params
	var $tags = array('Benkler, Yochai',
					'civil society',
					'civil rights',
					'communications',
					'Communications Decency Act',
					'copyright / copyright law',
					'cyberstalking',
					'digital divide',
					'digital media',
					'disputes',
					'education',
					'Electronic Frontier Foundation (EFF)',
					'e-rulemaking',
					'freedom',
					'free software',
					'history',
					'ICANN',
					'IGP',
					'intellectual property / patenting system',
					'internet governance',
					'Laporte, Leo',
					'networked information / information networks',
					'open source',
					'Palfrey, John',
					'participation/public participation',
					'pornography/cyberporn',
					'society',
					'technology / technologies');


	function GUI(){
		$this->standard_stylesheet = '<link rel="stylesheet" href="include/css/style.css" type="text/css" />';
		//$this->standard_stylesheet = '<link rel="stylesheet" href="http://apocalypsemystic.com/blarney/style.css" type="text/css" />';
		$this->functional_js = '<script src="include/js/functions.js" type="text/javascript"></script>
                                <script src="include/js/jquery-1.5.min.js" type="text/javascript"></script>
                                <script src="include/js/pages.js.js" type="text/javascript"></script>';

//$this->security_js = '<script src="http://static.ning.com/' . NETWORK . '/resources/js/sha1.js" type="text/javascript"></script>';
		
	}

	
	//STANDARD BUILDER FUNCTIONS

	function buildHeader(){
		
		$src = '<html>
					<head>' .
						$this->standard_stylesheet .
						$this->functional_js
					. '</head>
					<body>';
		return $src;
	}


	function buildFooter(){
		$src = '</body>
				</html>';
		return $src;
	}






	//STATE-DEPENDANT BUILDER FUNCTIONS
	
	//search input window
	function buildSearchUI($msg=null){
		//default message
		if ($msg == null) $msg = 'Enter search terms';
	
		$src = '<div id="menuBar">
					<ul id="search_nav">
						<li>Browse By:</li>
						<li><a href="#" onclick="return browse(\'author_browsing\');">Author</a></li>
						<li><a href="#" onclick="browse(\'subject_content\'); return browse(\'subject_browsing\');">Subject</a></li>
						<li><a href="#" onclick="return browse(\'title_browsing\');">Title</a></li>
						<li><a href="#" onclick="return browse(\'year_browsing\');">Year</a></li>
					</ul>
					<span id="search_link"><a href="#" onclick="return browse(\'search_window\');">Search</a></span>
				</div>

                ';
		/*		<div id="middle">
					<div id="author_browsing" class="content_1" style="display:none">
						<div class="navigation_2">
							<ul>
								<li><a href="#" onclick="return browse(\'a_ag\');">A-G</a></li>
								<li><a href="#" onclick="return browse(\'a_hm\');">H-M</a></li>
								<li><a href="#" onclick="return browse(\'a_np\');">N-P</a></li>
								<li><a href="#" onclick="return browse(\'a_qz\');">Q-Z</a></li>
							</ul>
						</div>
						<div id="a_ag" class="content_2" style="display:none">' . $this->buildBrowseUI('author','/^[A-Ga-g]/') . '</div>
						<div id="a_hm" class="content_2" style="display:none">' . $this->buildBrowseUI('author','/^[H-Mh-m]/') . '</div>
						<div id="a_np" class="content_2" style="display:none">' . $this->buildBrowseUI('author','/^[N-Pn-p]/') . '</div>
						<div id="a_qz" class="content_2" style="display:none">' . $this->buildBrowseUI('author','/^[Q-Rq-r]/') . '</div>
					</div>
					<div id="subject_browsing" class="content_1" style="display:none">
						<div id="subject_content" class="content_2">' 
						. $this->buildBrowseUI('subject','/.*//*') .
						'</div>	
					</div>
					<div id="title_browsing" class="content_1" style="display:none">
						<div class="navigation_2">
							<ul>
								<li><a href="#" onclick="return browse(\'t_ag\');">A-G</a></li>
								<li><a href="#" onclick="return browse(\'t_hm\');">H-M</a></li>
								<li><a href="#" onclick="return browse(\'t_np\');">N-P</a></li>
								<li><a href="#" onclick="return browse(\'t_qz\');">Q-Z</a></li>
							</ul>
						</div>
						<div id="t_ag" class="content_2" style="display:none">' . $this->buildBrowseUI('title','/^[A-Ga-g]/') . '</div>
						<div id="t_hm" class="content_2" style="display:none">' . $this->buildBrowseUI('title','/^[H-Mh-m]/') . '</div>
						<div id="t_np" class="content_2" style="display:none">' . $this->buildBrowseUI('title','/^[N-Pn-p]/') . '</div>
						<div id="t_qz" class="content_2" style="display:none">' . $this->buildBrowseUI('title','/^[Q-Rq-r]/') . '</div>
					</div>
					<div id="year_browsing" class="content_1" style="display:none">
						<div class="navigation_2">
							<ul>
								<li><a href="#" onclick="return browse(\'0095\');"><1996</a></li>
								<li><a href="#" onclick="return browse(\'9600\');">1996-2000</a></li>
								<li><a href="#" onclick="return browse(\'0104\');">2001-2004</a></li>
								<li><a href="#" onclick="return browse(\'0509\');">2005-2009</a></li>
							</ul>
						</div>
						<div id="0095" class="content_2" style="display:none">' . $this->buildBrowseUI('year','/1\\d\\d[0-5]/') . '</div>
						<div id="9600" class="content_2" style="display:none">' . $this->buildBrowseUI('year','/1\\d\\d[6-9]|2000/') . '</div>
						<div id="0104" class="content_2" style="display:none">' . $this->buildBrowseUI('year','/200[1-4]/') . '</div>
						<div id="0509" class="content_2" style="display:none">' . $this->buildBrowseUI('year','/200[5-9]/') . '</div>
					</div>
					<div id="search_window" class="content_1">
						<form method="post" action="index.php">
							<h3 id="search_tag">' . $msg . '</h3>
							<input type="text" name="search" id="search_input" />
							<input type="submit" id="search_button" />
							<input type="hidden" name="cmd" value="search" />
						</form>';
		if ($_SESSION['user']->hasAddPerm()){
			$src .=	'<a href="index.php?cmd=add" style="display:block;">New Entry</a>';
		}
		
		$src .=		'</div>
				</div>
			</div>';*/
		return $src;
	}
	
	//browse list window, build of type type of entries that match the regex
	function buildBrowseUI($type,$regex){
	
		$list = array();
	
		//get list and print to screen
		switch ($type){
		
			case 'year':
				$sql = "SELECT DISTINCT year FROM " . FILE_TABLE . " WHERE year>1 ORDER BY year ASC";
				$rsp = new Response($sql);
				foreach ($rsp->get_response() as $resp){
					$year = $resp['year'];
					
					//enforce date range
					
					if (preg_match($regex,$year,$matches,PREG_OFFSET_CAPTURE) == 0) continue;
					$list[] = $year;
				}
				return $this->buildFileList('Choose a year from the selected range', $list);
				
				break;
				
			case 'author':
				$sql = "SELECT DISTINCT author FROM " . FILE_TABLE;
				$authors = array();
				$rsp = new Response($sql);
				
				//parse out different authors
				foreach ($rsp->get_response() as $resp){
					$author_temp = $resp['author'];
					$author_arr = explode("#",$author_temp);
					$authors = array_merge($authors,$author_arr);
					
				}
				//print_r($authors);
				//filter unique authors & sort
				$authors = array_unique($authors);
				natcasesort($authors);
				
				//build output
				foreach ($authors as $author){
					if (preg_match($regex,$author,$matches,PREG_OFFSET_CAPTURE) != 0){
						$list[] = $author;
					}
				}
				return $this->buildFileList('Choose an author from the selected range', $list);
				
				break;
			case 'title':
				$sql = "SELECT id,title FROM " . FILE_TABLE . " ORDER BY title ASC";
				$rsp = new Response($sql);
				
				//build output
				foreach ($rsp->get_response() as $row){
					$title = $row['title'];
					if (preg_match($regex,$title,$matches,PREG_OFFSET_CAPTURE) != 0){
						$list[] = array($row['id'], $title, "true");
					}
				}
				return $this->buildFileList('Choose a title from the selected range', $list, "true");
				
				break;
			case 'subject':
				foreach ($this->tags as $tag){
					if (preg_match($regex,$tag,$matches,PREG_OFFSET_CAPTURE) == 0) continue;
					$list[] = $tag;
				}
				return $this->buildFileList('Choose a key word or phrase', $list);
				
				break;
		
		}
		
		
	
	}
	
	private function buildFileTable($list){
		$src = '<table id="file_table">';
		
		//print list of categories
		foreach ($list as $link){
			$src .= '<tr><td>' . $link . '</td></tr>';
		}
		
		$src .= '</table>';
		
		return $src;
	}
	
	private function buildFileList($title, $list, $is_id="false"){
		
		$MAX_COLS = 3;	//number of columns in display
		
		$src = '<fieldset id="search_fields">
					<legend>' . $title . '</legend>' .
					'<form method="post" action="index.php">' .
					'<input type="hidden" name="cmd" value="search" />' .
					'<input type="hidden" name="is_id" value="' . $is_id . '" />';
		
		
		
		$src .= '<table id="file_table">';
		
		$rows = ceil(count($list) / $MAX_COLS);
		
		$table = array();
		
		//build in-memory representation of table
		for ($c=0;$c<$MAX_COLS; $c++){
			for ($r=0;$r<$rows; $r++){
				if (0 == $r) $table[$c] = array();
				array_push($table[$c], $list[($c*$rows)+$r]);
			}
		}
		
		//build source table
		for ($r=0; $r<$rows; $r++){
			$src .= "<tr>";
			for ($c=0; $c<$MAX_COLS; $c++){
				if (is_array($table[$c][$r])){
					$src .= "<td><a href='index.php?cmd=view&id=" . $table[$c][$r][0] . "'>" . $table[$c][$r][1] . "</a></td>";
				}
				else{
					$src .= "<td><a href='index.php?cmd=search&is_id=false&search=" . urlencode($table[$c][$r]) . "'>" . $table[$c][$r] . "</a></td>";
				}
			}
			$src .= "</tr>";
		}
		
		$src .= '</table>';
		
		return $src;
		
		/*
		foreach ($list as $link){
			if (is_array($link)){
				$src .= "<option value='${link[0]}'>${link[1]}</option>";
			}
			else {
				$src .= "<option value='$link'>$link</option>";
			}
		}
		*/
		
		$src .= '<p><input type="submit" value="Search" /></p>
					</form>
						</fieldset>';
		
		return $src;
	}
	
	
	//search results list
	function buildSearchResults($terms){
	
		if (!isset($_SESSION['is_id']) || !$_SESSION['is_id']){
			$id_match = false;
		}
		else{
			$id_match = true;
		}
		
		$terms = clean_input($terms);
		
		//get ML library functions
		$ml = new MLLib();
		
		
		//search for any match for any term
		$term_arr = $ml->getSearchTermArray($terms);
		$title_qry = implode($term_arr,"%' OR " . FILE_TABLE . ".title LIKE '%");
		$descrip_qry = implode($term_arr,"%' OR " . FILE_TABLE . ".description LIKE '%");
		$author_qry = implode($term_arr,"%' OR " . FILE_TABLE . ".author LIKE '%");
		$year_qry = implode($term_arr,"%' OR " . FILE_TABLE . ".year LIKE '%");
		$citation_qry = implode($term_arr,"%' OR " . FILE_TABLE . ".citation LIKE '%");
		$tag_qry = implode($term_arr,"%') OR (" . TAG_FILE_TABLE . ".tag=" . TAG_TABLE . ".t_id AND " . TAG_TABLE . ".tag LIKE '%");
		
		
		
		//build where clause based on whether we have search terms or ids
		$sql;
		if ($id_match){
			$sql = "SELECT DISTINCT " . FILE_TABLE . ".id, " . FILE_TABLE . ".title FROM " . FILE_TABLE . "," . TAG_FILE_TABLE . "," . TAG_TABLE . " WHERE " . FILE_TABLE . ".id=$terms";
		}
		else {
			$sql = "SELECT DISTINCT " . FILE_TABLE . ".id FROM " . FILE_TABLE . "," . TAG_FILE_TABLE . "," . TAG_TABLE . " WHERE " . FILE_TABLE . ".title LIKE '%$title_qry%' OR " . FILE_TABLE . ".author LIKE '%$author_qry%' OR " . FILE_TABLE . ".year LIKE '%$year_qry%' OR " . FILE_TABLE . ".citation LIKE '%$citation_qry%' OR (" . TAG_FILE_TABLE . ".tag=" . TAG_TABLE . ".t_id AND " . TAG_FILE_TABLE . ".file=" . FILE_TABLE . ".id AND " . TAG_TABLE . ".tag LIKE '%$tag_qry%')";
		}
		
		$rsp = new Response($sql);
		
		//if no responses or empty search, reprint search prompt
		if ($rsp->is_empty() || strlen(trim($terms)) == 0){
			return $this->buildSearchUI('No results matched your search');
		}
		
		//build top of screen
		$src .= '<div id="top">';
		
		if ($id_match){
			$src .= '<div id="view_topleft"><b>Search results for:</b> ' . htmlentities($rsp->get('title')) . '</div>';
		}
		else{
			$src .= '<div id="view_topleft"><b>Search results for:</b> ' . htmlentities($terms) . '</div>';
		}
		
					
		$src .=		'<div id="view_topright"><a href="index.php">New Search</a></div>
				</div>
				<div id="middle">';
		
		//build a linked entry for each file
		//$src .= '<table id="file_list">';
		foreach ($rsp->get_response() as $file){
			$fileitem = new FileItem($file['id']);
			//$src .= '<tr>';
			$src .= '<p class="view_listing">' . $fileitem->getTitle() . '<a class="view_full" href="index.php?cmd=view&id=' . $fileitem->getId() . '">[View Full Record]</a></p>';
			//$src .= '<td>' . $fileitem->getSource() . '</td>';
			
			//$src .= '</tr>';
			$src .= '<hr style="width:500px;" />';
		}
		$src .= '</div>';
		
		return $src;
	}

	//viewing screen for individual entries
	function buildView($id){
		
		$fi = new FileItem($id);
		
		$src .= '<div id="top">
					<div id="view_topleft"><a href="index.php?cmd=search&search=' . $_SESSION['search_term'] . '">Back To Search</a></div>
					<div id="view_topright"><a href="index.php">New Search</a></div>
				</div>';
		$src .= '<div id="view_middle">';
		$src .= '<h3 class="view_cat">Title:</h3><p class="view_body">' . $fi->getTitle() . '</p>';
		$src .= '<h3 class="view_cat">Citation:</h3><p class="view_body">' . $fi->getCitation() . '</p>';
		$src .= '<h3 class="view_cat">Description:</h3><p class="view_body">' . $fi->getDescription() . '</p>';
		$src .= '<h3 class="view_cat">Tags:</h3><p class="view_body">' . $fi->getTags() . '</p>';
		$src .= '<h3 class="view_cat">Source Type:</h3><p class="view_body">' . $fi->getSourceType() . '</p>';
		$src .= '<h3 class="view_cat">Source:</h3><p class="view_body">' . $fi->getSource() . '</p>';
		$src .= '<h3 class="view_cat">Added By:</h3><p class="view_body">' . $fi->getUser() . '</p>';
		
		if ($_SESSION['user']->hasEditPerm($fi->getId())){
			$src .= '<p class="view_cat"><a href="index.php?cmd=add&id=' . $fi->getId() . '"></p>
					<p class="view_cat">[Edit]</a></p><p class="view_cat"><a href="index.php?cmd=delete&id=' . $fi->getId() . '" onclick="return confirm(\'This change cannot be undone. Are you sure you want to proceed?\');">[Delete]</a></p>';
		}
		
		$src .= '</table>';
		
		//add comments
		$sql = "SELECT id FROM " . COMMENT_TABLE . " WHERE fid=$id ORDER BY time ASC";
		$rsp = new Response($sql);
		
		$src .= '<table id="comment_table">';
		foreach ($rsp->get_response() as $cid){
			$comment = new Comment($cid['id']);
			$src .= '<div class="comment"><div class="comment_title">Posted by ' . $comment->getUser() . ' on ' . date('m-d-Y',$comment->getTime()) . ' at ' . date('g:i a',$comment->getTime()) . '</div>';
			$src .= '<p class="comment_text">' . htmlentities($comment->getText()) . '</p></div>';
		}
		$src .= '</table>';
		
		//add comment window
		if ($_SESSION['user']->hasAddPerm()){
			$src .= '<form id="comment_form" action="index.php?cmd=view&id=' . $id . '" method="POST">
						<textarea id="comment_box" rows="7" cols="72" name="comment"></textarea>
						<input id="comment_button" type="submit" value="Post Comment" />
					</form>';
		}
		$src .= '</div>';
		
		return $src;
	}
	
	//id of row to edit, 0 if new entry
	function buildAdd($id=0){
		
		//get source types
		$sql = "SELECT * FROM " . SOURCE_TABLE . " ORDER BY source_name DESC";
		$rsp = new Response($sql);
		$sources = $rsp->get_response();
				
		$fi = new FileItem($id);
		
		$msg = $id == 0 ? 'Add New Entry' : 'Editing Entry: ' . $fi->getTitle();
		
		$src .= '<div id="top">
					<div id="add_topleft"><span style="margin-left:10px;">' . $msg . '</span></div>
					<div id="add_topright"><a href="index.php?cmd=search&search=' . $_SESSION['search_term'] . '" onclick="return confirmCancel();">Back</a></div>
				</div>
				<div id="middle">
					<form id="add_form" action="index.php" method="POST" onsubmit="return validateAddForm();">
						<input type="hidden" name="id" value="' . $id . '" />
						<input type="hidden" id="save_type" name="save_type" value="0" />
						<input type="hidden" name="cmd" value="save" />
						<table>
							<tr><td>Name of source:</td><td><textarea id="title" name="title" cols="50" rows="1">' . $fi->getTitle() . '</textarea></td></tr>
							<tr><td>Citation:</td><td><textarea id="citation" name="citation" cols="50">' . $fi->getCitation() . '</textarea></td></tr>
							<tr><td>Description:</td><td><textarea id="description" name="description" cols="50" rows="5">' . $fi->getDescription() . '</textarea></td></tr>
							<tr><td>Tags:</td><td><textarea name="tags" cols="50" rows="1">' . $fi->getTags() . '</textarea></td></tr>
							<tr><td>Source Type:</td><td><select name="source_type">';
								foreach ($sources as $source){
									$selected = $fi->getSourceId() == $source['source_id'] ? 'selected="selected"' : '';
									$src .= '<option ' . $selected . ' value=' . $source['source_id'] . '>' . $source['source_name'] . '</option>';
								}
		$src .=				'</select></td></tr>';
		if ($id == 0){
			$src .=			'<tr><td>File Type:</td><td><input name="file_type" type="radio" checked="checked" id="radio_link" onclick="toggleUpload(0)" value=0 />Link  <input name="file_type" type="radio" id="radio_info" onclick="toggleUpload(2)" value=2 />Info <input name="file_type" type="radio" id="radio_na" onclick="toggleUpload(3)" value=3 />N/A</td></tr>
							<tr><td>File:</td>
								<td>
									<span id="link_span">http://<input id="link_input" name="link_name" type="text" /></span>
									<span id="file_span" style="display:none;"><input type="file" id="file_input" name="file_input" /></span>
									<span id="info_span" style="display:none;"><input id="info_input" name="info_name" type="text" /></span>
									<span id="na_span" style="display:none;">N/A</span>
								</td>
							</tr>';
		}
		else {
			if ($fi->getFileType() == 0){
			
				$src .=			'<tr><td>File Type:</td><td>
									<input name="file_type" type="radio" checked="checked" id="radio_link" onclick="toggleUpload(0)" value=0 />Link  
									<input name="file_type" type="radio" id="radio_info" onclick="toggleUpload(2)" value=2 />Info 
									<input name="file_type" type="radio" id="radio_na" onclick="toggleUpload(3)" value=3 />N/A
								</td></tr>
							<tr><td>File:</td>
								<td>
									<span id="link_span">http://<input id="link_input" name="link_name" type="text" value="' . $fi->getSourceText() . '" /></span>
									<span id="file_span" style="display:none;"><input type="file" id="file_input" name="file_input" /></span>
									<span id="info_span"><input id="info_input" name="info_name" type="text" /></span>
									<span id="na_span" style="display:none;">N/A</span>
								</td>
							</tr>';
			}
			else if ($fi->getFileType() == 2){
				$src .=			'<tr><td>File Type:</td><td>
									<input name="file_type" type="radio" id="radio_link" onclick="toggleUpload(0)" value=0 />Link  
									<input name="file_type" type="radio" checked="checked" id="radio_info" onclick="toggleUpload(2)" value=2 />Info 
									<input name="file_type" type="radio" id="radio_na" onclick="toggleUpload(3)" value=3 />N/A
								</td></tr>
							<tr><td>File:</td>
								<td>
									<span id="link_span" style="display:none;">http://<input id="link_input" name="link_name" type="text" /></span>
									<span id="file_span" style="display:none;"><input type="file" id="file_input" name="file_input" /></span>
									<span id="info_span"><input id="info_input" name="info_name" type="text" value="' . $fi->getSourceText() . '"/></span>
									<span id="na_span" style="display:none;">N/A</span>
								</td>
							</tr>';
			}
			else if ($fi->getFileType() == 3){
				$src .=			'<tr><td>File Type:</td><td>
									<input name="file_type" type="radio" id="radio_link" onclick="toggleUpload(0)" value=0 />Link  
									<input name="file_type" type="radio" id="radio_info" onclick="toggleUpload(2)" value=2 />Info 
									<input name="file_type" type="radio" checked="checked" id="radio_na" onclick="toggleUpload(3)" value=3 />N/A
								</td></tr>
							<tr><td>File:</td>
								<td>
									<span id="link_span" style="display:none;">http://<input id="link_input" name="link_name" type="text" /></span>
									<span id="file_span" style="display:none;"><input type="file" id="file_input" name="file_input" /></span>
									<span id="info_span" style="display:none;"><input id="info_input" name="info_name" type="text" /></span>
									<span id="na_span">N/A</span>
								</td>
							</tr>';
			}
		}	
							
		$src .=				'<tr><td style="text-align:center"><input type="submit" value="Save" onclick="document.getElementById(\'save_type\').value=0" /></td>
							<td style="text-align:center"><input type="submit" value="Save and Add Another" onclick="document.getElementById(\'save_type\').value=1" /></td></tr>
						</table>
					</form>
				</div>';
				
		
		//file button
		//<input name="file_type" type="radio" id="radio_file" onclick="toggleUpload(1)" value=1 />File
		
		return $src;
	}
	
	
	//returned if there was an errro authenticating
	function getAuthError(){
		$src .= '<html>
					<body>
						' . SID . '<h2>HI! There was a problem logging you in. Try refreshing the page.</h2>
					</body>
				</html>';
		return $src;
	}













}


?>
