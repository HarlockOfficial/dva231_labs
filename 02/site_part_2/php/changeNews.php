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
	//check if is a valid file
	$json=json_decode(file_get_contents("../json/".$_PUT["fileName"]),true);
	if($json==false or $json==null){
		http_response_code(404);
		die();
	}
	if(!(isset($json['events']) and isset($json['news']) and isset($json['mission']))){
		http_response_code(404);
		die();
	}
	$array=json_encode(array("events"=>$json['events'],"news"=>$json['news'],"mission"=>$json['mission']));
	if(file_put_contents("../json/latest.json",$array, LOCK_EX)!=false){
		http_response_code(200);
		die();
	}
	http_response_code(500);
?>
