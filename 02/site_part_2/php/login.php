<?php
	if($_SERVER['REQUEST_METHOD']!=="GET"){
		http_response_code(405);
		die();
	}
	if(!(isset($_GET['username']) && isset($_GET['password']))){
		http_response_code(405);
		die();
	}
	session_start();
	$_SESSION['isLoggedIn']=true;
	$_SESSION['id']=0;
	http_response_code(200);
?>
