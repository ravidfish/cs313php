<?php

require("dbConnector.php");
$db = loadDatabase();

if (isset($_POST['search']))
{
	echo "in if";
	$searchString = $_POST['search']; 
	echo $searchString;
	listLikeItems();
	echo "search for: " . $searchString;
}

?>

<?php 

function listItemComments()
{
	echo "Comments for item 1:" . "<br />\n<br />\n";

	$sql = "SELECT date, body FROM comment WHERE item_id = :item";
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
		echo "<br />\n";
	}
}

function listLikeItems()
{
	
}

function listUserComments()
{
	echo "Comments for user 1:" . "<br />\n<br />\n";

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
}

?>
