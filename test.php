<!DOCTYPE html>
<html>
	<head>
		<title>Test</title>
	</head>
	<body>
	
<?php 

require("dbConnector.php");
$db = loadDatabase();

foreach ($db->query("SELECT fName, lName FROM user") as $row)
{
	echo "First Name: " . $row['fName'];
	echo " Last Name: " . $row['lName'];
	echo "<br \>";
}

?>
	
	</body>
</html>
