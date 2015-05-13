<?php
define("active","orders");
include_once "header.php";
require_once "../mysqliconnect.php";
$db = new mysqli(hostname,username,password,database);
if ($db->connect_errno > 0)
{
	echo "Failed to connect to MySQL: " . $db->connect_error();
	exit();
}

$count = 0;
// DISPLAY ORDERS OF THE USER
$orders = "SELECT order_id, total
FROM `order`
WHERE user_id = 1;";
if(!$result = $db->query($orders)){
	echo "v0 There was an error running the query [" . $db->error . "]";
}else{
	while($rows = $result->fetch_assoc()){
		if($count!=0){
			echo "<hr />";
			$count = $count + 1;
		}else{
			$count = 1;
		}
		echo "<h4>Order #".$rows["order_id"]."</h4>";
		$sql = "SELECT *
		FROM `order` as o
		JOIN `orderDetails` as od on o.order_id = od.order_id
		JOIN `item` as i on od.book_id = i.book_id
		JOIN `book` as b on i.book_id = b.book_id
		JOIN `author` as a on i.author_id = a.author_id
		JOIN `publisher` as p on i.publisher_id = p.publisher_id
		WHERE o.order_id = ".$rows["order_id"].";";
		if(!$result1 = $db->query($sql)){
			echo "v1 There was an error running the query [" . $db->error . "]";
		}else{
			echo '<table class="table table-striped">';
			echo "<tr><th>Book Title</th><th>Author</th><th>Publisher</th></tr>";
			while($row = $result1->fetch_assoc()){
				echo "<tr>";
				echo "<td>".$row["title"]."</td>";
				echo "<td>".$row["lastName"].", ".$row["firstName"]."</td>";
				echo "<td>".$row["name"]."</td>";
				echo "</tr>";
			}
			echo "</table>";

			echo "<b>Order Total: " . $rows["total"] . "</b>";
			$result1->free();
		}
	}
	$result->free();
}
