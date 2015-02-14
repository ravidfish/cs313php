<?php

session_start();
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
					<span class="navbar-brand" href="dinobabies.php">Dinobabies</span>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
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
				<h1>My Comments</h1>            
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
									
<?php

$sql = "SELECT c.date, c.body FROM comment c join user u on c.user_id = u.user_id where u.email = :user";
$user = $_SESSION['user_id'];
$statement = $db->prepare($sql);
$statement->bindValue(':user', $user, PDO::PARAM_STR);
$statement->execute();
$count = 0;

if (!($row = $statement->fetch(PDO::FETCH_ASSOC)))
{
	echo "<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'><b>No results returned for your search...</b><br />\n</h3></div><div class='panel-body'><br />\n</div></div>";
}

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{	
	$count++;
	echo "<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'><b>My Comment Number: </b>" . $count . "<br />\n</h3></div>";
	echo "<div class='panel-body'><b>Date: </b>" . $row["date"] . "<br />\n<b>Body: </b>" . $row["body"] . "<br />\n</div></div>";
}

?>		
					
				</div>
			</div>
		</div><!--/.container-->
	</body>
</html>
