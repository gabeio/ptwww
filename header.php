<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css">
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
					<div class="header clearfix">
						<nav>
							<ul class="nav nav-pills pull-right">
								<li role="presentation"<?php if(active=="books"){echo " class=\"active\"";}?>><a href="./books.php"><span class="glyphicon glyphicon-book"></span> Books</a></li>
								<li role="presentation"<?php if(active=="cart"){echo " class=\"active\"";}?>><a href="./cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
							</ul>
						</nav>
						<h2>Book Store</h2>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
