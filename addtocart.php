<?php
if(!empty($_GET['book'])){
	require_once '../mysqliconnect.php';
	$db = new mysqli(hostname,username,password,database);
	if ($db->connect_error){
		echo "Failed to connect to MySQL: " . $db->connect_error;
		exit();
	}else{
		if(!$stmt = $db->prepare("INSERT INTO `cart` (user_id,book_id) VALUES (1,?)")){
			echo 'prepare failed.';
			exit();
		}
		if(!$stmt->bind_param('s',$_GET['book'])){
			echo 'bind failed.';
			exit();
		}
		if(!$result = $stmt->execute()){
			echo 'q0 There was an error running the query [' . $db->error . ']';
			exit();
		}else{
			header('Location: ./cart.php');
			echo "<html><head><meta http-equiv=\"refresh\" content=\"0; url=./cart.php\">";
		}
	}
}
