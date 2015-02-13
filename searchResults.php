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
				<h1>Dinobabies</h1>            
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
			
<?php

if (isset($_POST['search']))
{
	$sql = "select i.name, c.colorName, s.size from item i join itemcolorsize ics on i.item_id = ics.item_id join color c on ics.color_id = c.color_id join size s on ics.size_id = s.size_id where i.name like :item";
	$item = $_POST["search"] . "%";
	$statement = $db->prepare($sql);
	$statement->bindValue(":item", $item, PDO::PARAM_STR);
}

else
{
	$sql = "select i.name, c.colorName, s.size from item i join itemcolorsize ics on i.item_id = ics.item_id join color c on ics.color_id = c.color_id join size s on ics.size_id = s.size_id";
	$statement = $db->prepare($sql);
}

$statement->execute();

echo "<div class='panel panel-default'><div class='panel-heading'><h3 class='panel-title'>";
											
if (!($row = $statement->fetch(PDO::FETCH_ASSOC)))
{
	echo "<b>No results returned for your search...</b><br />\n<br />\n";
}

else
{
	echo "<b>All results that best match your query:</b><br />\n<br />\n";
}

echo "</h3></div><div class='panel-body'>";

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	echo "<b>Item: </b>" . $row["name"] . ", " . $row["colorName"] . ", " . $row["size"] . "<br />\n";
	echo "<a href='inventory.php?name=" . urlencode($row["name"]) . "&color=" . urlencode($row["colorName"]) . "&size=" . urlencode($row["size"]) . "'>To Item Page</a><br />\n<br />\n";
}

echo "</div></div>";
/*}*/

?>

				</div>	
			</div>
		</div><!--/.container-->
	</body>
</html>
