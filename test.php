<?php 
	
require("dbConnector.php");
	
$db = loadDatabase();

foreach ($db->query("SELECT fName, lName FROM users") as &row)
{
	echo "First Name: " . $row['fName'];
	echo " Last Name: " . $row['lName'];
	echo "<br />";
}
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Test</title>
	</head>
	<body>
	</body>
</html>
