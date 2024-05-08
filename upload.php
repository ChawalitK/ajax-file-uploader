<?php
if(isset($_FILES['file']['name'])){
	/* Getting file name */
	$filename = $_FILES['file']['name'];
	/* Location */
	$location = "uploads/".$filename;
	$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
	$imageFileType = strtolower($imageFileType);

	/* Valid extensions */
	$valid_extensions = array("jpg","jpeg","png");

	$response = "";
	/* Check file extension */
	if(in_array(strtolower($imageFileType), $valid_extensions)) {
	   	/* Upload file */
	   	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
	     	$response = $location;
	   	}
	}

	$url = "https://localhost/ajax-file-uploader/".$response;

	header("Content-type: application/json; charset=utf-8");
	echo '{"url":"'.$url.'", "previewUrl":"'.$url.'", "name":""}';

}