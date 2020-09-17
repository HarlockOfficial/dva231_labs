<?php
	$news=json_decode(file_get_contents('../json/News.json'),true);
	$news2=json_decode(file_get_contents('../json/latest.json'),true)['news'];
	$news1['small_news']=$news2;
	unset($news2);
	$json=array_merge($news,$news1);
	echo json_encode($json);
?>
