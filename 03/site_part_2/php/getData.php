<?php
	if($_SERVER['REQUEST_METHOD']!=="POST"){
		http_response_code(405);
		die();
	}
	if(!(isset($_POST['id']) && isset($_POST['source']))){
		http_response_code(400);
		die();
	}
	require_once "dbcon.php";
	$sql="";
	$out=array();
	$arr[':id']=$_POST['id'];
	switch($_POST['source']){
		case "sn":
			$sql = "SELECT title,imgurl,content,extended_content FROM small_news WHERE id=:id";
			break;
		case "ms":
			$sql = "SELECT text,url FROM mission_link WHERE mission_id=:id";
			$out['links']=query($sql,$arr)->fetchAll(PDO::FETCH_ASSOC);
			$sql = "SELECT title,imgurl,action,date,content FROM mission where id=:id";
			break;
		case "ev":
			$sql = "SELECT action,date,content FROM events WHERE id=:id";
			break;
		case "nw":
			$sql = "SELECT title,imgurl,content FROM news WHERE id=:id";
			break;
		default:
			http_response_code(400);
			die();
	}
	if($sql==""){
		http_response_code(400);
		die();
	}
	$out['main']=query($sql,$arr)->fetch(PDO::FETCH_ASSOC);
	if((isset($out['main']['action']) || isset($out['main']['date'])) && isset($out['main']['content'])){
		$out['main']['content']=((empty($out['main']['action']) || is_null($out['main']['action']))?"":$out['main']['action']).
								(!(empty($out['main']['action']) || empty($out['main']['date']))?" on ":"").
								((empty($out['main']['date']) || is_null($out['main']['date']))?"":date('l, F j', strtotime($out['main']['date']))).
								": ".$out['main']['content'];
		unset($out['main']['action']);
		unset($out['main']['date']);
	}
	echo json_encode($out);
?>