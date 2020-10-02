<?php
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['isLoggedIn']);
	session_destroy();
	header("location: ../");
?>