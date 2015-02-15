<?php

session_start();
require("dbConnector.php");
$db = loadDatabase();

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
$colorName = $colorName;
$size = $size;
$body = $body;
$user = $_SESSION['user_id'];
$date = date("Y-m-d");

$sqlGetUser = "SELECT user_id FROM user WHERE email = :user";
$statementUser = $db->prepare($sqlGetUser);
$statementUser->bindValue(':user', $user, PDO::PARAM_STR);
$statementUser->execute();

$rowUser = $statementUser->fetch(PDO::FETCH_ASSOC);
$user_id = $rowUser['user_id'];

$grabItem = "SELECT item_id from item where name = :name";
$statementItem = $db->prepare($grabItem);
$statementItem->bindValue(':name', $name, PDO::PARAM_STR);
$statementItem->execute();

$rowItem = $statementItem->fetch(PDO::FETCH_ASSOC);
$actItem_id = $rowItem['item_id'];

$query = "INSERT INTO comment (user_id, item_id, body, date, archive) VALUES (:user_id, :actItem_id, :body, :date, '0')";
$statementInsert = $db->prepare($query);
$statementInsert->bindParam(':user_id', $user_id);
$statementInsert->bindParam(':actItem_id', $actItem_id);
$statementInsert->bindParam(':body', $body);
$statementInsert->bindParam(':date', $date);
$statementInsert->execute();

echo "Comment Inserted... Redirecting"; 
header("Refresh: 2; inventory.php?name=" . urlencode($name) . "&colorName=" . urlencode($colorName) . "&size=" . urlencode($size));

?>
