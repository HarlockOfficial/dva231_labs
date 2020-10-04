<?php
	if($_SERVER['REQUEST_METHOD']!=="GET"){
		http_response_code(405);
		die();
	}
	if(!isset($_GET['q']) or empty($_GET['q'])){
		http_response_code(400);
		die();
	}
	require_once "dbcon.php";
	$arr[':q']="%".$_GET['q']."%";
	$out=array();
	$sql="select id,title from news where title like :q limit 5";
	$stmt=query($sql,$arr);
	$stmt1=NULL;
	$stmt2=NULL;
	$stmt3=NULL;
	
	if($stmt->rowCount()<5){
		$sql="select title,id from small_news where title like :q limit 5";
		$stmt1=query($sql,$arr);
		if($stmt->rowCount()+$stmt1->rowCount()<5){
			$sql="select title,id from mission where title like :q limit 5";
			$stmt2=query($sql,$arr);
			if($stmt->rowCount()+$stmt1->rowCount()+$stmt2->rowCount()<5){
				$sql="select action,date,id from events where content like :q limit 5";
				$stmt3=query($sql,$arr);
			}
		}
	}
	foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){
		$row['title']=str_ireplace($_GET['q'], "<b class='text-orange'>".$_GET['q']."</b>", $row['title']);
		array_push($out,"<a class='text-white' href='search.php?id=".$row['id']."&source=nw'>".$row['title']."</a><\br>");
	}
	if(!is_null($stmt1)){
		foreach($stmt1->fetchAll(PDO::FETCH_ASSOC) as $row){
			$row['title']=str_ireplace("/".$_GET['q']."/i", "<b class='text-orange'>".$_GET['q']."</b>", $row['title']);
			array_push($out,"<a class='text-white' href='search.php?id=".$row['id']."&source=sn'>".$row['title']."</a><\br>");
		}
	}
	if(!is_null($stmt2)){
		foreach($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row){
			$row['title']=str_ireplace("/".$_GET['q']."/i", "<span class='text-orange bold'>".$_GET['q']."</span>", $row['title']);
			array_push($out,"<a class='text-white' href='search.php?id=".$row['id']."&source=ms'>".$row['title']."</a><\br>");
		}
	}
	if(!is_null($stmt3)){
		foreach($stmt3->fetchAll(PDO::FETCH_ASSOC) as $row){
			array_push($out,"<a class='text-white' href='search.php?id=".$row['id']."&source=ev'>".$row['action'].date('l, F j', strtotime($row['date']))."</a><\br>");
		}
	}
	if(count($out)>5){
		$out=array_slice($out,0,5);
	}
	if(count($out)>0){
		$out[count($out)-1]=substr($out[count($out)-1],0,-5);
		echo json_encode($out);
	}else{
		echo json_encode(array());
	}
	http_response_code(200);
?>