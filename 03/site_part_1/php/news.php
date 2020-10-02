<?php
	require_once "dbcon.php";
	$sql="select title,imgurl,content,extended_content from small_news order by id desc limit 1";
	$news=json_decode(file_get_contents('../json/News.json'),true);
	$news['small_news']=query($sql,null)->fetch(PDO::FETCH_ASSOC);
	echo json_encode($json);
?>
