<!DOCTYPE html>
<html>
	<head>
		<title>Movie List</title>
	</head>

	<body>

<?php

try
{
	$user = "phpbob";
	$pass = "cs313pass";
	
	$db = new PDO("mysql:host=localhost;dbname=movietest", $user, $pass);
	
	echo "connection successful <br />\n";
	
	$sql = "select name from actor where name like :name";
	$query = "Harrison Ford";
	$statement = $db->prepare($sql);
	$statement->bindValue(':name', '%' . $query . '%', PDO::PARAM_STR);
	$statement->execute();
	
	while ($row = $statement->fetch(PDO::FETCH_ASSOC))
	{
		echo "found: " . $row["name"] . "<br />\n";
	}
}
catch(PDOException $ex)
{
	echo "Error: " . $ex->getMessage();
	die();
}

?>

	</body>
</html>
