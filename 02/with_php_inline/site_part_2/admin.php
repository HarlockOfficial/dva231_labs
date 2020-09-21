<?php
	session_start();
	if(!(isset($_SESSION['isLoggedIn']) and isset($_SESSION['id']) and $_SESSION['isLoggedIn'])){
		session_destroy();
		header("location: ./login.php");
		die();
	}
	if(isset($_POST['logout'])){
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
		<?php
			if(isset($_GET['fileName'])){
				$file_not_found=false;
				if(file_exists("json/".$_GET['filename'])){
					$json=json_decode(file_get_contents("json/".$_GET["fileName"]),true);
					if($json and isset($json['events']) and isset($json['news']) and isset($json['mission'])){
						$array=json_encode(array("events"=>$json['events'],"news"=>$json['news'],"mission"=>$json['mission']));
						if(file_put_contents("json/latest.json",$array, LOCK_EX)!=false){
							echo "<script type='text/javascript'>window.location='./';</script>";
							die();
						}else{
							echo "<script>alert('Server Error, try again Later');</script>";
						}
					}else{
						$file_not_found=true;
					}
				}else{
					$file_not_found=true;
				}
				if($file_not_found){
					echo "<script>alert('File NOT Found try Again');</script>";
				}
			}
		?>
	</head>
	<body>
		<div class="admin-row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="get" id="change-news">
				<input type="text" placeholder="Put the new JSON News file name here" name="fileName" /><br />
				<input type="submit" value="Apply" />
			</form>
		</div>
		<div class="admin-row">
			<form action="<?=$_SERVER['PHP_SELF']?>" method="post" class="action-button">
				<input type="hidden" name="logout" value="1" />
				<input type="submit" value="Logout" />
			</form>
			<form action="./" method="get" class="action-button">
				<input type="submit" value="Back To Home" />
			</form>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/admin.js"></script>
	</body>
</html>
