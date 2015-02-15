<?php 

session_start();
require("dbConnector.php");
$db = loadDatabase();

$name = $_SESSION['name'];
$colorName = $_SESSION['colorName'];
$size = $_SESSION['size'];
					
if (isset($_POST['comment'])) 
{
	if ($_POST['comment'] != "" || $_POST['comment'] != null)
	{
		$commentBody = $_POST['comment'];
		header("Location: addComment.php?name=" . urlencode($name) . "&colorName=" . urlencode($colorName) . "&size=" . urlencode($size) . "&body=" . urlencode($commentBody));
	}
	
	else 
	{
		echo "Error, need comment body.";
		header("Refresh: 2; inventory.php?name=" . urlencode($name) . "&colorName=" . urlencode($colorName) . "&size=" . urlencode($size));
	}
}

?>