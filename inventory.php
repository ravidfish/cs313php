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
				<h2>Dinobabies Crochet - Inventory</h2>            
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
						
<?php

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

$_SESSION['name'] = $name;
$_SESSION['colorName'] = $colorName;
$_SESSION['size'] = $size;

$name = $name;
$colorName = $colorName;
$size = $size;

$sql = "select image, description from item where name = :name";
$statement = $db->prepare($sql);
$statement->bindValue(":name", $name, PDO::PARAM_STR);
$statement->execute();
$results = $statement->fetch(PDO::FETCH_ASSOC);
$image = $results['image'];
$desc = $results['description'];

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
	echo "<b>Body:</b> " . $row['body'] . "<br />\n<br />\n";
}
	
?>
								
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<b>Add Comments</b>						
							</h3>
						</div>
						<div class="panel-body">
							<form method="post" action="commentHelper.php">
								<textarea name="comment" rows='5' cols='43' placeholder="Comment Body..."></textarea>
								<input type="submit">
							</form>
					
<?php 
					
/*if (isset($_POST['comment'])) 
{
	if ($_POST['comment'] != "" || $_POST['comment'] != null)
	{
		$commentBody = $_POST['comment'];
		//header("Location: addComment.php?name=" . urlencode($name) . "&colorName=" . urlencode($colorName) . "&size=" . urlencode($size) . "&body=" . urlencode($commentBody));
	}
}*/

?>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.container-->
	</body>
</html>
