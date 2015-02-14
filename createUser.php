<?php

session_start();
$_SESSION['user_id'] = $_POST['new_user'];
require("dbConnector.php");
$db = loadDatabase();

$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$email = $_POST['new_user'];
$password = $_POST['password1'];
$pass2 = $_POST['password2'];

if ($fName == "" || $fName == null)
{
	echo "First Name is empty";
	header("Refresh: 2; newUser.php");
}

elseif ($lName == "" || $lName == null)
{
	echo "Last Name is empty";
	header("Refresh: 2; newUser.php");
}

elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
{
	echo "Invalid email format"; 
	header("Refresh: 2; newUser.php");
}

elseif ($password !== $pass2 || $password == "" || $pass2 == "" || $password == null || $pass2 == null)
{
	echo "Passwords do not match or are empty";
	header("Refresh: 2; newUser.php");
}

else
{
	$sqlEmailVal = "select email from user";
	$statementEVal = $db->prepare($sqlEmailVal);
	$statementEVal->execute();

	while ($row = $statementEVal->fetch(PDO::FETCH_ASSOC))
	{
		if ($row['email'] == $email || $row['email'] == null)
		{
			echo "Username already exists";
			header("Refresh: 2; newUser.php");
			die();
		}
	}
		
	$query = "INSERT INTO user(fName, lName, email, password, status) VALUES(:fName, :lName, :email, :password, 'active')";
	$statement = $db->prepare($query);
	$statement->bindParam(':fName', $fName);
	$statement->bindParam(':lName', $lName);
	$statement->bindParam(':email', $email);
	$statement->bindParam(':password', $password);
	$statement->execute();
}

header("Location: dinobabies.php");
die(); 

?>
