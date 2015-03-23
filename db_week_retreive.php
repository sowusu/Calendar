<?php

ini_set("session.cookie_httponly", 1);

session_start();

//CHECK CSRF TOKEN
if($_SESSION['token'] !== $_POST['token']){
  die("Request forgery detected");
}

$userid;
$mysqli = new mysqli('localhost', 'caluser', 'calpass', 'calendar');

if($mysqli->connect_errno){
	print("CONNECTION ERROR YOU FAILURE!");
	exit;
} 

$stmt_get = $mysqli->prepare("select id from users where username='". $_POST['username'] . "'"); 

if (!$stmt_get){
	printf("%d\n", 1);//query failed; return 1
	exit;
}

$stmt_get->execute();

$stmt_get->bind_result($userid);

$stmt_get->fetch();

$stmt_get->close();

$time;
$event;
$day;
$tag;
$month_one=$_POST['month_one'];
$year_one=$_POST['year_one'];
$month_two=$_POST['month_two'];
$year_two=$_POST['year_two'];
$id;

$stmt_store = $mysqli->prepare("select event, time, day, id, tag from events where userid='".$userid."' and (month, year) in (('".$month_one."', '".$year_one."'), ('".$month_two."', '".$year_two."')) order by time");

if (!$stmt_store){
	printf("%d\n", 2);//query failed; return 2
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt_store->execute();

$stmt_store->bind_result($event,$time,$day,$id,$tag);
$index = 0;
$dayindex = 0;
echo "{";
while($stmt_store->fetch()){
	if($index!=0){
		echo ",";
	}
	echo "\"".$index."\":{\"event\":\"".htmlspecialchars($event)."\",\"time\":\"".htmlspecialchars($time)."\",\"day\":\"".htmlspecialchars($day)."\",\"id\":\"".htmlspecialchars($id)."\",\"tag\":\"".$tag."\"}";
	$index = $index + 1;
}
if($index!=0){
	echo ",";
}
echo "\"maxindex\":\"".$index."\"}";

$stmt_store->close();







?>
