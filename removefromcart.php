<?php
if(!empty($_REQUEST["book"])){
	require_once "../mysqliconnect.php";
	$db = new mysqli(hostname,username,password,database);
	if ($db->connect_error){
		echo "Failed to connect to MySQL: " . $db->connect_error;
		exit();
	}else{
		if($_REQUEST["book"]!="all"){
			if(!$stmt = $db->prepare("DELETE FROM `cart` WHERE user_id = 1 AND book_id = ? LIMIT 1")){
				echo "prepare failed.";
				exit();
			}
			if(!$stmt->bind_param("s",$_REQUEST["book"])){
				echo "bind failed.";
				exit();
			}
			if(!$result = $stmt->execute()){
				echo "q0 There was an error running the query [" . $db->error . "]";
				exit();
			}else{
				header("Location: ./cart.php");
			}
		}else{
			if(!$stmt = $db->prepare("DELETE FROM `cart` WHERE user_id = 1")){
				echo "prepare failed.";
				exit();
			}
			// if(!$stmt->bind_param("s",$_REQUEST["book"])){
			// 	echo "bind failed.";
			// 	exit();
			// }
			if(!$result = $stmt->execute()){
				echo "q0 There was an error running the query [" . $db->error . "]";
				exit();
			}else{
				header("Location: ./cart.php");
			}
		}
	}
}
