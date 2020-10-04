<?php
	require_once "dbcon.php";
	$sql="select action,date,content from events order by id desc limit 3";
	$arr=array();
	foreach(query($sql,null)->fetchAll(PDO::FETCH_ASSOC) as $elem){
		array_push($arr,(empty($elem['action'])?"":$elem['action']).(!empty($elem['action']) && !empty($elem['date'])?" on ":"").(empty($elem['date'])?"":date('l, F j', strtotime($elem['date']))).": ".$elem['content']."<br />");
	}
	$arr[count($arr)-1]=substr($arr[count($arr)-1],0,-3);
	echo json_encode($arr);
?>
