<?php

session_start();

if($_SESSION['token'] != $_POST['token']){
	die("Request forgery detected");
}

$mysqli = new mysqli('localhost', 'caluser', 'calpass', 'calendar');

if($mysqli->connect_errno){
	print("CONNECTION ERROR YOU FAILURE!");
	exit;
} 

$time = $_POST['time'];
$event = $_POST['eventText'];
$id = $_POST['id'];

$stmt_store = $mysqli->prepare("update events set event=?, time=? where id='".$id."'");

if (!$stmt_store){
	printf("%d\n", 2);//query failed; return 2
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt_store->bind_param('ss',$event,$time);

$stmt_store->execute();


$stmt_store->close();







?>
