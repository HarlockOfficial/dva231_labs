<?php
	if($_SERVER['REQUEST_METHOD']!=="PUT"){
		http_response_code(405);
		die();
	}
	parse_str(file_get_contents("php://input"),$_PUT);
	if(!file_exists("../json/".$_PUT['fileName'])){
		http_response_code(404);
		die();
	}
	$json=json_decode(file_get_contents("../json/".$_PUT["fileName"]),true);
	if($json==false or $json==null){
		http_response_code(404);
		die();
	}
	if(!(isset($json['events']) and isset($json['news']) and isset($json['mission']))){
		http_response_code(404);
		die();
	}
	
	require_once "dbcon.php";
	$sql="insert into small_news(title,imgurl,content,extended_content) values(:titl,:img,:cont,:ext_cont)";
	$arr[':titl']=$json['news']['title'];
	$arr[':img']=$json['news']['imgurl'];
	$arr[':cont']=$json['news']['content'];
	$arr[':ext_cont']=$json['news']['extended-content'];
	query($sql,$arr);
	unset($sql);
	unset($arr);
	
	for($i=0;$i<count($json['events']);$i+=1){
		$sql="insert into events(action,date,content) values(:act,:day,:cont)";
		$arr[':act']=$json['events'][$i]['action'];
		$arr[':day']=$json['events'][$i]['day'];
		$arr[':cont']=$json['events'][$i]['content'];
		query($sql,$arr);
		unset($sql);
		unset($arr);
	}
	
	$sql="insert into mission(title,imgurl,action,date,content) values(:titl,:img,:act,:day,:cont)";
	$arr[':titl']=$json['mission']['title'];
	$arr[':img']=$json['mission']['imgurl'];
	$arr[':act']=$json['mission']['action'];
	$arr[':day']=$json['mission']['date'];
	$arr[':cont']=$json['mission']['content'];
	query($sql,$arr);
	unset($sql);
	unset($arr);
	
	$sql="select id from mission order by id desc limit 1";
	$id=query($sql,null)->fetch(PDO::FETCH_ASSOC)['id'];
	unset($sql);
	
	for($i=0;$i<count($json['mission']['links']);$i+=1){
		$sql="insert into mission_link(mission_id,text,url) values(:miss_id,:tex,:link)";
		$arr[':miss_id']=$id;
		$arr[':tex']=$json['mission']['links'][$i]['text'];
		$arr[':link']=$json['mission']['links'][$i]['url'];
		query($sql,$arr);
	}
	http_response_code(200);
?>