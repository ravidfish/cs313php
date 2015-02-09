<?php

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
		<!-- Custom styles for this template -->
		<link href="offcanvas.css" rel="stylesheet">
		<script src="../../assets/js/ie-emulation-modes-warning.js"></script>
	</head>
		
	<body>
		<nav class="navbar navbar-fixed-top navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<span class="navbar-brand" href="#">Dinobabies</span>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="http://php-ravfish.rhcloud.com/dinobabies.php">Home</a></li>
						<li><a href="#">View My Comments</a></li>
					</ul>
					<form class="navbar-form navbar-right" role="search" method="POST" name="search" action="">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search for Dinobabies Item">
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
<?php 
	
echo "<br />\n<br />\n" . "Comments for item 1:" . "<br />\n<br />\n";

$sql = "SELECT c.date, c.body, u.fName, u.lName from comment c join user u on c.user_id = u.user_id WHERE c.item_id = :item";
$item = "1";
$statement = $db->prepare($sql);
$statement->bindValue(':item', $item, PDO::PARAM_STR);
$statement->execute();

$count = 0;

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{	
	$count++;
	echo "Comment Number: " . $count . "<br />\n";
	echo "Date: " . $row["date"] . "<br />\n";
	echo "Body: " . $row["body"] . "<br />\n";
	echo "Authors Name: " . $row["fName"] . " " . $row["lName"] . "<br />\n";
	echo "<br />\n";
}

?>
			
				</div>
				<div class="col-md-4">
			
<?php

echo "<br />\n<br />\n" . "All results that best match your query:" . "<br />\n<br />\n";
$sql = "select i.name, c.colorName, s.size from item i join itemcolorsize ics on i.item_id = ics.item_id join color c on ics.color_id = c.color_id join size s on ics.size_id = s.size_id where i.name = :item";
$item = "beanie";
$statement = $db->prepare($sql);
$statement->bindValue(":item", $item, PDO::PARAM_STR);
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	echo $row["name"] . ", " . $row["colorName"] . ", " . $row["size"] . "<br />\n";
}

echo "<br />\n";
?>

				</div>
				<div class="col-md-4">

<?php

echo "<br />\n<br />\n" . "Comments for user 1:" . "<br />\n<br />\n";
$sql = "SELECT date, body FROM comment WHERE user_id = :user";
$user = "1";
$statement = $db->prepare($sql);
$statement->bindValue(':user', $user, PDO::PARAM_STR);
$statement->execute();

$count = 0;

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{	
	$count++;
	echo "Comment Number: " . $count . "<br />\n";
	echo "Date: " . $row["date"] . "<br />\n";
	echo "Body: " . $row["body"] . "<br />\n";
	echo "<br />\n";
}

?>
				</div>
			</div>
		</div><!--/.container-->
		
	</body>
</html>
