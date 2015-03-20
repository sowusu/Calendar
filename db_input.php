

<?php
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

$stmt_store = $mysqli->prepare("insert into events (event, month, year, day, time, userid, tag) values (?,?,?,?,?,?,?)");

if (!$stmt_store){
	printf("%d\n", 2);//query failed; return 1
	exit;
}

$stmt_store->bind_param('ssiisis', $_POST['event'], $_POST['month'], $_POST['year'], $_POST['day'], $_POST['time'], $userid, $_POST['tag']);

$stmt_store->execute();

$stmt_store->close();





?>
