<?php
	require_once "dbcon.php";
	$sql="select action,date as day,content from events order by id desc limit 3";
	while($elem=query($sql,null)->fetch(PDO::FETCH_ASSOC)){
		array_push($arr,(empty($elem['action'])?"":$elem['action']).(empty($elem['day'])?"":date('l, F j', strtotime($elem['day']))).": ".$elem['content']."<br />");
	}
	$arr[count($arr)-1]=substr($arr[count($arr)-1],0,-4);
	echo json_encode($arr);
?>
