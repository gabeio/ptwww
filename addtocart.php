<?php
if(!empty($_GET['book'])){
	require_once '../mysqliconnect.php';
	$db = new mysqli(hostname,username,password,database);
	if ($db->connect_errno > 0)
	{
		echo "Failed to connect to MySQL: " . $db->connect_error();
		exit();
	}else{
		$sql = "INSERT INTO `cart` (user_id,book_id) VALUES (1,".$_GET['book'].")";
		if(!$result = $db->query($sql)){
			echo 'q0 There was an error running the query [' . $db->error . ']';
			exit();
		}else{
			header('Location: ./cart.php');
			echo "<html><head><meta http-equiv=\"refresh\" content=\"0; url=./cart.php\">";
		}
	}
}
