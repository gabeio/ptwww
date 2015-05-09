<?php
define('active','books');
require_once '../mysqliconnect.php';
$db = new mysqli(hostname,username,password,database);
if ($db->connect_errno > 0)
{
	echo "Failed to connect to MySQL: " . $db->connect_error();
	exit();
}

include_once 'header.php';

$sql = "SELECT *
FROM `user`
WHERE user_id = 1";
if(!$result = $db->query($sql)){
	echo 'v0 There was an error running the query [' . $db->error . ']';
}else{
	while($row = $result->fetch_assoc()){
		echo '<p>Hello, '.$row['firstName'].' '.$row['lastName'].'</p>';
	}
	$result->free();
}

$sql = "SELECT *
FROM `item`
JOIN `book` on item.book_id = book.book_id
JOIN `author` on item.author_id = author.author_id
JOIN `publisher` on item.publisher_id = publisher.publisher_id
ORDER BY item.book_id;";
if(!$result = $db->query($sql)){ // sets and checks results for errors-ish
    die('There was an error running the query [' . $db->error . ']');
}else{
	// $current_id = "";
	echo '<table class="table table-striped">';
	echo '<tr><th>Book Title</th><th>Author</th><th>Publisher</th><th>Price (USD)</th><th>Buy</th></tr>';
	while($row = $result->fetch_assoc()){
		echo '<tr>';
		echo '<td>'.$row['title'].'</td>';
		echo '<td>'.$row['lastName'].', '.$row['firstName'].'</td>';
		echo '<td>'.$row['name'].'</td>';
		echo '<td>$'.$row['price'].'</td>';
		echo '<td><a class="btn btn-default" href="./addtocart.php?book=' . $row['book_id'] . '"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart</a></td>';
		echo'</tr>';
		// $current_id = $row['book_id'];
	}
	echo '</table>';
	$result->free(); // frees the variable
}
include_once 'footer.php';
$db->close();
?>
