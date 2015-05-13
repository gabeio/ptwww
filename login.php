<?php
$show = false;
if(empty($_POST["username"])||empty($_POST["password"])){
	define("active","books");
	include_once "header.php";
	$show = true;
}else{
	require_once "../mysqliconnect.php";
	$db = new mysqli(hostname,username,password,database);
	if ($db->connect_errno > 0)
	{
		echo "Failed to connect to MySQL: " . $db->connect_error();
		exit();
	}

	$hash = hash("sha256",$_POST["password"]);

	$stmt = $db->prepare("SELECT *
	FROM `user`
	WHERE username = ?
		AND hash = ?");

	$stmt->bind_param("ss",$_POST["username"],$hash);

	if(!$result = $stmt->execute()){
		// bad login
		echo "you were not logged in";
	}else{
		// good login
		while($row = $result->fetch_array()){
			if($row[0]){
				echo "you were logged in";
			}else{
				echo "you were not logged in";
			}
		}
	}
}
?>
