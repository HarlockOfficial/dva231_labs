<?php
	if($_SERVER['REQUEST_METHOD']!=="GET"){
		http_response_code(405);
		die();
	}
	if(!(isset($_GET['id']) && isset($_GET['source']))){
		http_response_code(400);
		die();
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/icon">
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/search.css" />
		</head>
	<body>
		<img class="hide"/>
		<h1></h1>
		<p></p>
		<div></div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/search.js"></script>
	</body>
</html>