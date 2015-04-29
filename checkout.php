<?php
define('active','');
include_once 'header.php';
require_once '../mysqliconnect.php';
$db = new mysqli(hostname,username,password,database);
if ($db->connect_errno > 0)
{
	echo "Failed to connect to MySQL: " . $db->connect_error();
	exit();
}

$sql = "DELETE FROM `cart` WHERE user_id = 1";
if(!$db->query($sql)){
	echo 'v0 There was an error running the query [' . $db->error . ']';
}else{
	$sql = "SELECT *
	FROM `user`
	WHERE user_id = 1";
	if(!$result = $db->query($sql)){
		echo 'v0 There was an error running the query [' . $db->error . ']';
	}else{
		while($row = $result->fetch_assoc()){
			echo '<p>Thank You, '.$row['lastName'].', '.$row['firstName'].' for puchasing with us.</p>';
		}
		$result->free();
	}
}
