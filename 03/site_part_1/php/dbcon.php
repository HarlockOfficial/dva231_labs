<?php
function query($sql,$arr){
	$dbh=new PDO("mysql:host=localhost;dbname=nasaDB", "root", "");
	$stmt=$dbh->prepare($sql);
	$stmt->execute($arr);
	return $stmt;
}
?>