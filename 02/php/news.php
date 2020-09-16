<?php
	$json_file = file_get_contents('Ass2News.json');
	$json=json_decode($json_file, true);
	print_r($json);
?>