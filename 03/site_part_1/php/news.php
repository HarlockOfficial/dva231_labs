<?php
	require_once "dbcon.php";
	$sql="select title,imgurl,content,extended_content from small_news order by id desc limit 1";
	$news['small_news']=query($sql,null)->fetch(PDO::FETCH_ASSOC);
	//$news=json_decode(file_get_contents('../json/News.json'),true);
	unset($sql);
	$sql="select title,imgurl,content from news order by id desc limit 3";
	$news['news']=query($sql,null)->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($news);
?>
