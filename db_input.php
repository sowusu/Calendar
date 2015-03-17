

<?php

$userid;
$mysqli = new mysqli('localhost', 'caluser', 'calpass', 'calendar');

if($mysqli->connect_errno){
	print("CONNECTION ERROR YOU FAILURE!");
	exit;
} 

$stmt_get = mysqli->prepare("select userid from users where ". $_GET['username']); 

if (!$stmt_get){
	printf("%d\n", 1);//query failed; return 1
	exit;
}

$stmt_get->execute();

$stmt_get->bind_result($userid);

$stmt_get->fetch();



$stmt_store = $mysqli->prepare("insert into events (event, month, year, day, time, userid, username values (?,?,?,?,?,?,?)")

if (!$stmt_store){
	printf("%d\n", 1);//query failed; return 1
	exit;
}

$stmt_store->bind_param('ssiisis', $_GET['event'], $_GET['month'], $_GET['year'], $_GET['day'], $_GET['time'], $userid, $_GET['username']);

$stmt_store->execute();

$stmt_store->close();



echo "successful connection\n";
echo $_GET['fire'];




?>