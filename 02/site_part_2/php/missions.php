<?php
	$json=json_decode(file_get_contents('../json/latest.json'), true)['mission'];
	$json['content']="<span class='text-blue'>".$json['action'].date(' \o\n F j Y. ', strtotime($json['date']))."</span>".$json['content'];
	$links="";
	foreach($json['links'] as $link){
		$links.="<a href='".$link['url']."'>".$link['text']."</a><br />";
	}
	$json['links']=$links;
	unset($json['action']);
	unset($json['date']);
	echo json_encode($json);
?>
