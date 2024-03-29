<?php
define("active","cart");
include_once "header.php";
require_once "../mysqliconnect.php";
$db = new mysqli(hostname,username,password,database);
if ($db->connect_error){
	echo "Failed to connect to MySQL: " . $db->connect_error;
	exit();
}

$sql = "SELECT *
FROM `user`
WHERE user_id = 1";
if(!$result = $db->query($sql)){
	echo "v0 There was an error running the query [" . $db->error . "]";
}else{
	while($row = $result->fetch_assoc()){
		echo "<p>Hello, ".$row["firstName"]." ".$row["lastName"]."</p>";
	}
	$result->free();
}

$sql = "SELECT *
FROM `cart`
JOIN `book`
ON cart.book_id = book.book_id
AND cart.user_id = 1";
if(!$result = $db->query($sql)){
    echo "q0 There was an error running the query [" . $db->error . "]";
    exit();
}else{
	echo "<table class='table table-striped'>";
	echo "<tr><th>Book Title</th><th>Price (USD)</th><th>Remove From Cart</th></tr>";
	while($row = $result->fetch_assoc()){
		echo "<tr><td>" . $row["title"] . "</td><td>$" . $row["price"] . "</td><td><a class='btn btn-danger' onclick='removeBook(event," . $row["book_id"] . ")' href='./removefromcart.php?book=" . $row["book_id"] . "'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
	}
	$result->free();
}

$sql = "SELECT SUM(price)
FROM `cart`
JOIN `book`
ON cart.book_id = book.book_id
AND cart.user_id = 1";
if(!$result = $db->query($sql)){
	echo "v0 There was an error running the query [" . $db->error . "]";
}else{
	while($row = $result->fetch_array()){
		if($row[0]){
			echo '<tr class="success"> <td>TOTAL</td> <td>$' . $row[0] . '</td> <td></td> </tr>';
		}else{
			echo '<tr class="success"> <td>TOTAL</td> <td>$0</td> <td></td> </tr>';
		}
	}
	echo "<tr class='active'>
		<td> <a class='btn btn-default' href='./books.php'>Continue Shopping</a> </td>
		<td> <a class='btn btn-success' href='./checkout.php'>Checkout</a> </td>
		<td> <a class='btn btn-danger' onclick='removeBook(event,\"all\")' href='./removefromcart.php?book=all'>Empty Cart</a> </td>
	</tr>
	</table>";
	echo "<script>
	function removeBook(event,book){
		event.preventDefault ? event.preventDefault() : (event.returnValue=false)
		$.ajax({
			type: 'POST',
			url:  'removefromcart.php',
			data: {
				book: book
			},
			success: function(data,status){
				console.log(status);
				if(status=='success'){
					if(book==\"all\"){
						alert('You have cleared your cart.');
						location.reload();
					}else{
						alert('You have removed Book #'+book);
						location.reload();
					}
				}
			}
		});
	}
	</script>";
	$result->free();
}

include_once "footer.php";
$db->close();
