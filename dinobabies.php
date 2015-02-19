<?php

session_start();
//$_SESSION['user_id'] = "";

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "")
{ 
    header("Location: dinobabiesLogin.php");
}

require("dbConnector.php");
$db = loadDatabase();

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Dinobabies</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="../../assets/js/ie-emulation-modes-warning.js"></script>
	</head>
		
	<body>
		<nav class="navbar navbar-fixed-top navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<span class="navbar-brand" href="dinobabies.php">Dinobabies Crochet</span>
				</div>
				<div>
					<ul class="nav navbar-nav">
						<li class="active"><a href="dinobabies.php">Home</a></li>
						<li><a href="myComments.php">View My Comments</a></li>
						<li><a href="dinobabiesLogout.php">Log Out</a></li>
					</ul>
					<form class="navbar-form navbar-right" role="search" method="post" action="searchResults.php">
						<div class="form-group">
							<input type="text" class="form-control" name="search" placeholder="Search for Dinobabies Item">
						</div>
						<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					</form>
				</div><!-- /.nav-collapse -->
			</div><!-- /.container -->
		</nav><!-- /.navbar -->
		
		<!-- header contents -->
		<div class="container">
			<div class="jumbotron">
				<h2>Dinobabies</h2> 
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<div>
						<b>Welcome to Dinobabies Crochet.  The home of the business Dinobabies and all your crocheting needs.</b><br /><br />
						<b>Here you can view our inventory by searching in the box at the top of the page or by filling out the for below.</b><br /><br />
						<b>You can also review the comment posting you have made on our various inventory items by clicking the link at the top.</b><br /><br />
					</div>
					<div>
						<b>Display All Inventory Items:  </b><button type="button" class="btn btn-default" onclick="location='searchResults.php'">All Items</button><br /><br />
					</div>
				</div>
			</div>
		</div><!--/.container-->
	</body>
</html>
