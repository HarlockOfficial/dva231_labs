<?php
	session_start();
	if(!(isset($_SESSION['isLoggedIn']) && isset($_SESSION['id']) && $_SESSION['isLoggedIn'])){
		session_destroy();
		header("location: ./login.php");
		die();
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/icon">
		<title>News Admin - NASA</title>
		<link rel="stylesheet" type="text/css" href="css/admin.css" />
	</head>
	<body>
		<div class="admin-row" id="change-news">
				<input type="text" placeholder="Put the new JSON News file name here" />
				or
				<input type="button" value="Upload the new JSON news file" id="json-file-btn"/>
				<input type="file" id="json-file"/>
		</div>
		<div class="admin-row">
		or fill this form
		</div>
		<div class="admin-row">
			<div class="column-2" id="raw-news">
				if you are adding a news:<br />
				<input type="text" placeholder="Write the News Title" /><br />
				<input type="button" value="Upload the new Image" id="image-file-btn"/><input type="file" id="image-file"><br />
				<textarea placeholder="Write the News Content" cols="20" rows="5" /></textarea><br />
				if you are adding a small news, also fill:<br />
				<textarea placeholder="Write the News Extended Content" cols="40" rows="10" /></textarea><br />
			</div>
			<div class="column-2" id="raw-mission">
				if you are adding a mission:<br/>
				<input type="text" placeholder="Write the Action (Landing, Launch, ...)" /><br/>
				<small>Select the mission date</small><br />
				<input type="date"/><br/>
				<textarea placeholder="Write the Event Content" rows="5" cols="20" ></textarea><br/>
			</div>
		</div>
		<div class="admin-row">
			<input type="submit" value="Apply"/>
		</div>
		<div class="admin-row">
			<a href="./php/logout.php" class="no-decoration">Logout</a>
			<a href="./" class="no-decoration">Back To Home</a>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/admin.js"></script>
	</body>
</html>
