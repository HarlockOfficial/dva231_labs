<?php
	if($_SERVER['REQUEST_METHOD']!=="POST"){
		http_response_code(405);
		die();
	}
	if(!(isset($_POST['username']) && isset($_POST['password']))){
		http_response_code(405);
		die();
	}
	require_once "dbcon.php";
	$sql="select id from user where username=:user and password=:pass";
	$arr[':user']=$_POST['username'];
	$arr[':pass']=hash("sha256",$_POST['password']);
	$stmt=query($sql,$arr);
	if($stmt->rowCount()==1){
		session_start();
		$_SESSION['isLoggedIn']=true;
		$_SESSION['id']=$stmt->fetch(PDO::FETCH_ASSOC)['id']
		http_response_code(200);
		die();
	}
	http_response_code(401);
?>
