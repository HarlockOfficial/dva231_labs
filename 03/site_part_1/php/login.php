<?php
	require_once "dbcon.php";
	if($_SERVER['REQUEST_METHOD']==="POST"){	//login	
		if(!(isset($_POST['username']) && isset($_POST['password']))){
			http_response_code(405);
			die();
		}
		$sql="select id from user where username=:user and password=:pass";
		$arr[':user']=$_POST['username'];
		$arr[':pass']=hash("sha256",$_POST['password']);
		$stmt=query($sql,$arr);
		if($stmt->rowCount()==1){
			session_start();
			$_SESSION['isLoggedIn']=true;
			$_SESSION['id']=$stmt->fetch(PDO::FETCH_ASSOC)['id'];
			http_response_code(200);
			die();
		}
		http_response_code(401);
		die();
	}else if($_SERVER['REQUEST_METHOD']==="PUT"){	//registration
		parse_str(file_get_contents("php://input"),$_PUT);
		if(!(isset($_PUT['username']) && isset($_PUT['password']))){
			http_response_code(405);
			die();
		}
		$sql="insert into user(username,password) values(:user,:pass)";
		$arr[':user']=$_PUT['username'];
		$arr[':pass']=hash("sha256",$_PUT['password']);
		$stmt=query($sql,$arr);
		if($stmt->rowCount()==1){
			unset($stmt);
			unset($sql);
			$sql="select id from user where username=:user and password=:pass";
			$stmt=query($sql,$arr);
			if($stmt->rowCount()==1){
				session_start();
				$_SESSION['isLoggedIn']=true;
				$_SESSION['id']=$stmt->fetch(PDO::FETCH_ASSOC)['id'];
				http_response_code(200);
				die();
			}
		}
		http_response_code(401);
		die();
	}
	http_response_code(405);
?>
