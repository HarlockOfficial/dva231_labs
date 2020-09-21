<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/icon">
		<title>Admin Login - NASA</title>
		<link rel="stylesheet" type="text/css" href="css/login.css" />
		<?php
			session_start();
			if(isset($_SESSION['isLoggedIn']) and isset($_SESSION['id']) and $_SESSION['isLoggedIn']){
				header("location: ./admin.php");
				die();
			}else if(isset($_POST['username']) and isset($_POST['password'])){
				$_SESSION['isLoggedIn']=true;
				$_SESSION['id']=0;
				header("location: admin.php");
				die();
			}
		?>
	</head>
	<body>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="login-form">
			<input type="text" placeholder="username" name="username"/><span class="text-red invisible" id="username-error">*</span><br/>
			<input type="password" placeholder="********" name="password"/><span class="text-red invisible" id="password-error">*</span><br/>
			<input type="submit" value="submit"/>
		</form>
		<a href="./" class="no-decoration">Back To Home</a>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js" integrity="sha512-Hmp6qDy9imQmd15Ds1WQJ3uoyGCUz5myyr5ijainC1z+tP7wuXcze5ZZR3dF7+rkRALfNy7jcfgS5hH8wJ/2dQ==" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/login.js"></script>
	</body>
</html>
