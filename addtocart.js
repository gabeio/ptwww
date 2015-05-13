function addBook(event,book){
	event.preventDefault ? event.preventDefault() : (event.returnValue=false)
	$.ajax({
		type: 'POST',
		url:  'addtocart.php',
		data: {
			book: book
		},
		success: function(data,status){
			console.log(status);
			if(status=='success'){
				alert('You have added Book #'+book);
			}
		}
	});
}
