<!DOCTYPE html>
<html>
	<head>
		<title>Test</title>
	</head>
	<body>
	
<?php

require("dbConnector.php");
$db = loadDatabase();

$sql = "SELECT date, body FROM comment WHERE user_id = :user";
$user = "1";
$statement = $db->prepare($sql);
$statement->bindValue(':user', $user, PDO::PARAM_STR);
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	echo "Date: " . $row["date"] . "<br />\n";
	echo "Body: " . $row["body"] . "<br />\n";	
}

?>
	
	</body>
</html>
