<?php
	if($_SERVER['REQUEST_METHOD']!=="PUT"){
		http_response_code(405);
		die();
	}
	require_once "dbcon.php";
	function insert_into_db($json){
		$sql="insert into news(title,imgurl,content) values(:titl,:img,:cont)";
		for($i=0;$i<count($json['news']);$i+=1){
			$arr[':titl']=$json['news'][$i]['title'];
			$arr[':img']=$json['news'][$i]['imgurl'];
			$arr[':cont']=$json['news'][$i]['content'];
			query($sql,$arr);
			unset($arr);
		}
		unset($sql);
		
		$sql="insert into small_news(title,imgurl,content,extended_content) values(:titl,:img,:cont,:ext_cont)";
		$arr[':titl']=$json['small_news']['title'];
		$arr[':img']=$json['small_news']['imgurl'];
		$arr[':cont']=$json['small_news']['content'];
		$arr[':ext_cont']=$json['small_news']['extended-content'];
		query($sql,$arr);
		unset($sql);
		unset($arr);
		
		$sql="insert into events(action,date,content) values(:act,:day,:cont)";
		for($i=0;$i<count($json['events']);$i+=1){
			$arr[':act']=$json['events'][$i]['action'];
			$arr[':day']=date("Y-m-d",strtotime($json['events'][$i]['day']));
			$arr[':cont']=$json['events'][$i]['content'];
			query($sql,$arr);
			unset($arr);
		}
		unset($sql);
		
		$sql="insert into mission(title,imgurl,action,date,content) values(:titl,:img,:act,:day,:cont)";
		$arr[':titl']=$json['mission']['title'];
		$arr[':img']=$json['mission']['imgurl'];
		$arr[':act']=$json['mission']['action'];
		$arr[':day']=date("Y-m-d",strtotime($json['mission']['date']));
		$arr[':cont']=$json['mission']['content'];
		query($sql,$arr);
		unset($sql);
		unset($arr);
		
		$sql="select id from mission order by id desc limit 1";
		$id=query($sql,null)->fetch(PDO::FETCH_ASSOC)['id'];
		unset($sql);
		
		$sql="insert into mission_link(mission_id,text,url) values(:miss_id,:tex,:link)";
		$arr[':miss_id']=$id;
		for($i=0;$i<count($json['mission']['links']);$i+=1){
			$arr[':tex']=$json['mission']['links'][$i]['text'];
			$arr[':link']=$json['mission']['links'][$i]['url'];
			query($sql,$arr);
		}
	}
	parse_str(file_get_contents("php://input"),$_PUT);
	if(isset($_PUT['fileName'])){
		if(!file_exists("../json/".$_PUT['fileName'])){
			http_response_code(404);
			die();
		}
		$json=json_decode(file_get_contents("../json/".$_PUT["fileName"]),true);
		if($json==false or $json==null){
			http_response_code(404);
			die();
		}
		if(!(isset($json['events']) and isset($json['small_news']) and isset($json['mission']) and isset($json['news']))){
			http_response_code(404);
			die();
		}
		
		insert_into_db($json);
		
		http_response_code(200);
		die();
	}else if(isset($_PUT['fileJson'])){
		$json=json_decode($_PUT['fileJson'], true);
		if($json==false or $json==null){
			http_response_code(406);
			die();
		}
		if(!(isset($json['events']) and isset($json['small_news']) and isset($json['mission']) and isset($json['news']))){
			http_response_code(406);
			die();
		}
		insert_into_db($json);
		http_response_code(200);
		die();
	}else if(isset($_PUT['title']) && isset($_PUT['content']) && isset($_PUT['imgExt']) && isset($_PUT['img'])){
		$img=base64_decode(explode(",",$_PUT['img'])[1]);			
		$arr[':titl']=$_PUT['title'];
		$arr[':cont']=$_PUT['content'];
		$sql="";
		if(!isset($_PUT['extraContent'])){
			$imgPath="img/news/".date("YmdHis").".".$_PUT['imgExt'];
			$sql="insert into news(title,content,imgurl) values(:titl,:cont,:img)";
		}else{
			$imgPath="img/small_news/".date("YmdHis").".".$_PUT['imgExt'];
			$arr[':extCont']=$_PUT['extraContent'];
			$sql="insert into small_news(title,content,imgurl,extended_content) values(:titl,:cont,:img,:extCont)";
		}
		$arr[':img']=$imgPath;
		if($sql!=""){
			file_put_contents("../".$imgPath,$img);
			query($sql,$arr);
			http_response_code(200);
			die();
		}
		http_response_code(405);
		die();
	}else if((isset($_PUT['eventAction']) || isset($_PUT['eventDate'])) && isset($_PUT['eventContent'])){
		$sql="insert into events(action,date,content) values(:act,:dat,:cont)";
		$arr[':act']=($_PUT['eventAction']==""?NULL:$_PUT['eventAction']);
		$arr[':dat']=($_PUT['eventDate']==""?NULL:$_PUT['eventDate']);
		$arr[':cont']=$_PUT['eventContent'];
		query($sql,$arr);
		http_response_code(200);
		die();
	}else if(isset($_PUT['missionTitle']) && isset($_PUT['missionAction']) && 
			isset($_PUT['missionDate']) && isset($_PUT['missionContent']) && 
			isset($_PUT['missionLinks']) && isset($_PUT['img']) && isset($_PUT['imgExt'])){
		$sql="insert into mission(title,imgurl,action,date,content) values(:titl,:img,:act,:dat,:cont)";
		$arr[':titl']=$_PUT['missionTitle'];
		$arr[':act']=$_PUT['missionAction'];
		$arr[':dat']=$_PUT['missionDate'];
		$arr[':cont']=$_PUT['missionContent'];
		
		$img=base64_decode(explode(",",$_PUT['img'])[1]);			
		$imgPath="img/mission/".date("YmdHis").".".$_PUT['imgExt'];
		$arr[':img']=$imgPath;

		file_put_contents("../".$imgPath,$img);
		query($sql,$arr);
		unset($sql);
		unset($arr);
		$sql="select id from mission order by id desc limit 1";
		$id=query($sql,null)->fetch(PDO::FETCH_ASSOC)['id'];
		unset($sql);
		
		$sql="insert into mission_link(mission_id,text,url) values(:id,:txt,:link)";
		$arr[':id']=$id;
		foreach($_PUT['missionLinks'] as $key=>$val){
			$arr[':txt']=$key;
			$arr[':link']=$val;
			query($sql,$arr);
			unset($arr[':txt']);
			unset($arr[':link']);
		}
		unset($arr);
		unset($sql);
		unset($id);
		
		http_response_code(200);
		die();
	}
	http_response_code(405);
?>