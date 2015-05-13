<?php
define("active","checkout");
include_once "header.php";
require_once "../mysqliconnect.php";
$db = new mysqli(hostname,username,password,database);
if ($db->connect_errno > 0)
{
	echo "Failed to connect to MySQL: " . $db->connect_error();
	exit();
}

// GET TOTAL
$sql = "SELECT SUM(price)
FROM `cart` as c
JOIN `book` as b
ON c.book_id = b.book_id
AND c.user_id = 1";
if(!$result = $db->query($sql)){
	echo "v0 There was an error running the query [" . $db->error . "]";
	exit();
}else{
	while($row = $result->fetch_array()){
		if($row[0]){
			$total = $row[0];
		}else{
			echo "You don't have anything in your cart.";
			exit();
		}
	}
	$result->free();
}

// CREATE ORDER
$sql = "INSERT INTO `order` (user_id,total) VALUES (1,".$total.");";
if(!$result = $db->query($sql)){
	echo "v0 There was an error running the query [" . $db->error . "]";
	exit();
}

// GET ORDER ID
$sql = "SELECT LAST_INSERT_ID();";
if(!$result = $db->query($sql)){
	echo "v0 There was an error running the query [" . $db->error . "]";
	exit();
}else{
	while($row = $result->fetch_array()){
		$order = $row[0];
	}
	$result->free();
}

// COPY USER"S CART TO ORDER
$sql = "INSERT INTO `orderDetails` (order_id, book_id)
SELECT ".$order.", book_id
FROM `cart` WHERE user_id = 1;";
if(!$db->query($sql)){
	echo "v0 There was an error running the query [" . $db->error . "]";
	exit();
}

// DELETE EVERYTHING FROM THIS USER"S CART
$sql = "DELETE FROM `cart` WHERE user_id = 1";
if(!$db->query($sql)){
	echo "v0 There was an error running the query [" . $db->error . "]";
	exit();
}else{
	$sql = "SELECT *
	FROM `user`
	WHERE user_id = 1";
	if(!$result = $db->query($sql)){
		echo "v0 There was an error running the query [" . $db->error . "]";
	}else{
		while($row = $result->fetch_assoc()){
			echo "<p>Thank You, ".$row["firstName"]." ".$row["lastName"]." for puchasing with us.</p>";
			echo '<a class="btn btn-default" href="orders.php">See Previous Orders</a>';
		}
		$result->free();
	}
}
