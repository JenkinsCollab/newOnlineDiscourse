

//adjust type of upload input
function toggleUpload(type){

	//link
	if (type == 0){
		document.getElementById("file_span").style.display = "none";
		document.getElementById("na_span").style.display = "none";
		document.getElementById("info_span").style.display = "none";
		document.getElementById("link_span").style.display = "block";
		document.getElementById("link_input").value = '';
	}
	//file
	if (type == 1){
		document.getElementById("file_span").style.display = "block";
		document.getElementById("na_span").style.display = "none";
		document.getElementById("info_span").style.display = "none";
		document.getElementById("link_span").style.display = "none";
		document.getElementById("file_span").innerHTML = '<input name="file_input" id="file_input" type="file" />';
	}
	//info
	if (type == 2){
		document.getElementById("file_span").style.display = "none";
		document.getElementById("link_span").style.display = "none";
		document.getElementById("na_span").style.display = "none";
		document.getElementById("info_span").style.display = "block";
		document.getElementById("info_input").value = '';
	}
	//info
	if (type == 3){
		document.getElementById("file_span").style.display = "none";
		document.getElementById("link_span").style.display = "none";
		document.getElementById("info_span").style.display = "none";
		document.getElementById("na_span").style.display = "block";
	}
}

//ensure no accidental page browsing
function confirmCancel(){
	return confirm('This will lose any unsaved changes. Are you sure you wish to continue?');
}

//validate add form
function validateAddForm(){

	//ensure title
	if (document.getElementById('title').value == '') {
		alert ('Please enter a title for the entry');
		return false;	//no title
	}
	
	//ensure citation
	if (document.getElementById('citation').value == '') {
		alert ('Please enter a citation for the entry');
		return false;	//no citation
	}
	
	//ensure description
	if (document.getElementById('description').value == '') {
		alert ('Please enter a description for the entry');
		return false;	//no description
	}
	
	//ensure source
	if (document.getElementById('radio_link').checked 
			&& document.getElementById('link_input').value ==''){
		alert ('Please enter a source for the entry');
		return false;
	}
	else if (document.getElementById('radio_file').checked 
			&& document.getElementById('file_input').value ==''){
		alert ('Please enter a source for the entry');
		return false;
	}
	else if (document.getElementById('radio_info').checked 
			&& document.getElementById('info_input').value ==''){
		alert ('Please enter a source for the entry');
		return false;
	}
	
	return true;
}

//reveal browse hierarchies
function browse(browseId){

	divToShow = document.getElementById(browseId);
	className = divToShow.className;

	divs = getDivsByClass(className);
	
	//hide other divs of same class
	for (i=0; i<divs.length; i++){
		divs[i].style.display = "none";
	}
	
	divToShow.style.display = "block";

	return false;
}


//return array of elements with class == className
function getDivsByClass(className){
	toReturn = new Array();
	divs = document.getElementsByTagName('div');
	for (i=0; i<divs.length; i++){
		if (divs[i].className == className){
			toReturn.push(divs[i]);
		}
	}
	return toReturn;
}


