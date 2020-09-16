<?php
	$json=json_decode(file_get_contents('../json/latest.json'), true);
	$arr=array();
	foreach($json['events'] as $elem){
		array_push($arr,(empty($elem['action'])?"":$elem['action']).(empty($elem['day'])?"":date('l, F j', strtotime($elem['day']))).": ".$elem['content']."<br />");
	}
	$arr[count($arr)-1]=substr($arr[count($arr)-1],0,-4);
	echo json_encode($arr);
?>
