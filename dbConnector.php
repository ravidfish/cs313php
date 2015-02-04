<?php

function loadDatabase()
{
	$dbHost = "";
	$dbPort = "";
	$dbUser = "";
	$dbPassword = "";

	$dbName = "dinobabies";

    $openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');
	echo "before if ";
    if ($openShiftVar === null || $openShiftVar == "")
    {
		// Not in the openshift environment
		echo "in if ";
        require("setLocalDatabaseCredentials.php");
				
		$db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	}
    else 
    { 
        // In the openshift environment
		echo "in the else ";
        $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
        $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT'); 
        $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
        $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
		
		$db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    } 
    
	return $db;
}

?>
