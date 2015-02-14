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
				<h1>Dinobabies</h1> 
			</div>
			<div class="row">
				<div class="col-md-4">
					<div>
						<b>Display All Inventory Items:  </b><button type="button" class="btn btn-default" onclick="location='searchResults.php'">All Items</button><br /><br />
					</div>
				</div>
				<div class="col-md-4">
					<div>
						<p>
							<b>Or... Filter Results:</b>
						</p>
						<form role="form-vertical" action="inventory.php" method="post">
							<select class="dropdown" name="item">
						
<?php

$sql = "SELECT name from item";
$statement = $db->prepare($sql);
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{	
	echo "<option value='" . $row["name"] ."'>" . $row["name"] . "</option>";

}					
							
?>
						
							</select>
							<select class="dropdown" name="size">
						
<?php

$sql = "SELECT size from size";
$statement = $db->prepare($sql);
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{	
	echo "<option value='" . $row["size"] ."'>" . $row["size"] . "</option>";

}					
							
?>
							
							</select>
							<select class="dropdown" name="color">
						
<?php

$sql = "SELECT colorName from color";
$statement = $db->prepare($sql);
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{	
	echo "<option value='" . $row["colorName"] ."'>" . $row["colorName"] . "</option>";

}
							
?>
							
							</select>
							<br /><br /><button type="submit" class="btn btn-default">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div><!--/.container-->
	</body>
</html>
