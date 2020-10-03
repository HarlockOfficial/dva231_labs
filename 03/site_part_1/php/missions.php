<?php
	require_once "dbcon.php";
	$sql="select id,title,imgurl,action,date,content from mission order by id desc limit 1";
	$res=query($sql,null)->fetch(PDO::FETCH_ASSOC);
	$res['content']="<span class='text-blue'>".$res['action'].date(' \o\n F j Y. ', strtotime($res['date']))."</span>".$res['content'];
	unset($sql);
	
	$sql="select text,url from mission_link where mission_id=:miss_id";
	$arr[':miss_id']=$res['id'];
	$links="";
	while($link=query($sql,$arr)->fetch(PDO::FETCH_ASSOC)){
		$links.="<a href='".$link['url']."'>".$link['text']."</a><br />";
	}
	
	$res['links']=$links;
	unset($res['id']);
	unset($res['action']);
	unset($res['date']);
	echo json_encode($res);
?>
