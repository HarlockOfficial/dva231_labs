<?php
	if($_SERVER['REQUEST_METHOD']!=="GET"){
		http_response_code(405);
		die();
	}
	if(!isset($_GET['q']) or empty($_GET['q'])){
		http_response_code(400);
		die();
	}
	request_once "dbcon.php";
	$arr[':q']=$_GET['q'];
	$out=array();
	
	$sql="select title,id from small_news where title like :q limit 5";
	$stmt=query($sql,$arr);
	$stmt2=NULL;
	$stmt3=NULL;
	if($stmt->rowCount()!=5){
		$sql="select title,id from mission where title like :q limit 5";
		$stmt2=query($sql,$arr);
		if($stmt->rowCount()+$stmt2->rowCount()<5){
			$sql="select action,date,id from events where content like :q limit 5";
			$stmt3=query($sql,$arr);
		}
	}
	
	while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		array_push($out,"<a class='text-white' href='search.php?id=".$row['id']."&source=sn'>".$row['title']."</a><\br>");
	}
	if(!is_null($stmt2)){
		while($row=$stmt2->fetch(PDO::FETCH_ASSOC)){
			array_push($out,"<a class='text-white' href='search.php?id=".$row['id']."&source=ms'>".$row['title']."</a><\br>");
		}
	}
	if(!is_null($stmt3)){
		while($row=$stmt3->fetch(PDO::FETCH_ASSOC)){
			array_push($out,"<a class='text-white' href='search.php?id=".$row['id']."&source=ev'>".$row['action'].date('l, F j', strtotime($row['day']))."</a><\br>");
		}
	}
	if(count($out)>5){
		$out=array_slice($out,0,5);
	}
	$out[4]=substr($out[4],0,-5);
	echo json_encode($out);
?>