<?php
header("Content-Type: application/json");
include 'hashpassword.php';
session_start();

$mysqli = new mysqli('localhost', 'caluser', 'calpass', 'calendar');

if ($mysqli->connect_errno){
	echo json_encode(array("success" => false,
								"message" => "db connection Failed: " . $mysqli->connect_error));
	
	
	exit;
}

$action = $_POST['op'];


if ($action == "SIGN UP")
{
	$username = $_POST['username']; 
	$password = $_POST['password'];

	$stmt = $mysqli->prepare("select username, count(*) as occurs from users where username = '" . $username . "'");
	if (!$stmt){
		echo json_encode(array("success" => false,
								"message" => "Oops, query 1 failed: %s". $mysqli->error));
	
		
		exit;
	}

	//echo "after first query";
	$stmt->execute();
	$stmt->bind_result($nullval, $occurs);
	$stmt->fetch();
	//echo $occurs;

	$stmt->close();

	if ($occurs == 0)
	{//user is not already in database
		$hash = saltyhash($password);
		//echo "Hash: " .$hash;
		//echo "Username: " . $username;
		$stmt1 = $mysqli->prepare("insert into users (username, passhash) values (?, ?)");
		if (!$stmt1){
			echo json_encode(array("success" => false,
								"message" => "Oops, query 2 failed: %s". $mysqli->error));
	
		
			exit;
		}

		$stmt1->bind_param('ss', $username, $hash);
		$stmt1->execute();
		$stmt1->close();


		$stmt3 = $mysqli->prepare("select id from users where username = '". $username ."'");
		if (!$stmt3){
			echo json_encode(array("success" => false,
								"message" => "Oops, query 1 failed: %s". $mysqli->error));
	
		
			exit;
		}

		$stmt3->execute();

		$stmt3->bind_result($userid);
		$stmt3->close();
		//authentication on signup
		$_SESSION['userid'] = $userid;
		$_SESSION['username'] = $username;
		$_SESSION['token'] = substr(md5(rand()), 0, 10);	//CSRF token for preventing attacks
		echo json_encode(array("success" => true,
								"message" => "Signup was successful!"));
			exit;


	}
	else{//user has already signed up

		echo "<p>  </p>";
		echo json_encode(array("success" => false,
								"message" => "This username has already been used! If this is you, go ahead and login, else sign up with a new username and password"));
	
	}

}
else if ($action = "ENTER")
{

	$username = "name was not set";
	if (isset($_POST['username']))
	{
		$username = $_POST['username'];
		$_SESSION['username'] = $username;
		$password = $_POST['password'];


	}
	//echo $username;
	//echo $password;
	$stmt2 = $mysqli->prepare("select id, username, passhash from users where username = '" . $username . "'");
	if (!$stmt2){
		echo json_encode(array("success" => false,
								"message" => "Oops, query 2 failed: %s". $mysqli->error));
	
		
		exit;
	}

	//echo "after first query";
	$stmt2->execute();
	$stmt2->bind_result($userid, $username, $passhash);
	$stmt2->fetch();
	$stmt2->close();




	if ($username != NULL)
	{
		//echo "reached here";
		
		if (!isVerified($passhash, $password)){
			
			echo json_encode(array("success" => false,
								"message" => "Wrong username and password."));
			exit;
		}
		
		else
		{
			echo json_encode(array("success" => true,
								"message" => "Login was successful"));
			exit;	

		}
		
		
	}
	else
	{
		echo json_encode(array("success" => false,
								"message" => "This username is not signed up."));
		exit;

	}	





}//end of else if	
else{}



?>

