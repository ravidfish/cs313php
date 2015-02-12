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
				<h1>Inventory</h1>            
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
						
<?php

$name = "";
$colorName = "";
$size = "";

if (isset($_POST['item']) && isset($_POST['size']) && isset($_POST['color']))
{
	$name = $_POST['item'];
	$colorName = $_POST['color'];
	$size = $_POST['size'];
}

else
{
	$pageURL = "http";

	if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") 
	{
		$pageURL .= "s";
	}

	if ($_SERVER["SERVER_PORT"] != "80")
	{
		$pageURL .= "://";
	}

	else
	{
		$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
	}

	$query_str = parse_url($pageURL, PHP_URL_QUERY);
	parse_str($query_str);
	
	$name = $name;
	$colorName = $color;
	$size = $size;
}

$sql = "select image, description from item where name = :name";
$statement = $db->prepare($sql);
$statement->bindValue(":name", $name, PDO::PARAM_STR);
$statement->execute();
$results = $statement->fetch(PDO::FETCH_ASSOC);
$image = $results['image'];
$desc = $results['description'];

//if ($desc === null || $desc == "") {echo "error";} else {echo $name . " " . $colorName . " " . $size . " " . $image . " " . $desc; }

?>
	
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<?php echo "<h2><b>" . $name . "</b></h2><br />\n" . "<b>Size:</b> " . $size . ", " . $colorName; ?>							
							</h3>
						</div>
						<div class="panel-body">
							<?php echo "<img src='images/" . $image . "'></img>" . "<br />\n"; ?>
							<?php echo "<br />\n" . "<p><b>Item Description:</b> " . $desc . "</p>"; ?>

<?php

//c.user_id join with u.user_id to get user fName and lName
//
$sql2 = "select c.body, c.date, u.fName, u.lName from comment c join item i on i.name = :name join user u on c.user_id  = u.user_id where c.item_id = i.item_id";
$statement2 = $db->prepare($sql2);
$statement2->bindValue(":name", $name, PDO::PARAM_STR);
$statement2->execute();

?>							
							
							<br /><br />
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">
										<b>Comments</b>						
									</h3>
								</div>
								<div class="panel-body">

<?php 

while ($row = $statement2->fetch(PDO::FETCH_ASSOC))
{
	echo "<b>Name:</b> " . $row['fName'] . " " . $row['lName'] . "<br />\n"; 
	echo "<b>Date:</b> " . $row['date'] . "<br />\n"; 
	echo "<b>Body:</b> " . $row['body'] . "<br />\n";
	echo "<br />\n";
}
	
?>
								
								</div>
							</div>
							<br />
							<button type="button" class="btn btn-default" onclick="location='addComment.php'"><b>Add Comment</b></button>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.container-->
	</body>
</html>
