<?php
	session_start();
	/*if (empty($_SESSION["$DisplayString"]))
	{
		$_SESSION["DisplayString"] = $displayStr;
	}

	header("Location: resultsTxt.php");
	exit;*/
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Results</title>
	</head>
	<body>
		<div>
<?php
	$filepath = "resultsTxt.txt";
	if (file_exists("$filepath"))
	{
		$myfile = fopen("$filepath", "r") or die ("Unable to open file!");
		$oldText = fread($myfile, filesize("$filepath"));
		fclose($myfile);
		
		$tempOld = explode(",", $oldText);
		$tempQ1 = $tempOld[0] + $_POST["q1"];
		$tempQ2 = $tempOld[1] + $_POST["q2"];
		$tempQ3 = $tempOld[2] + $_POST["q3"];
		$tempQ4 = $tempOld[3] + $_POST["q4"];
		$tempCount = $tempOld[4] + 1;
		$skillAvg = $tempQ1 / $tempCount;
		$ques2Avg = $tempQ2 / $tempCount;
		$ques3Avg = $tempQ3 / $tempCount;
		$ques4Avg = $tempQ4 / $tempCount;
		
		$myfile = fopen("$filepath", "w") or die ("Unable to open file!");
		$tempNew = $tempQ1 . "," . $tempQ2 . "," . $tempQ3 . "," . $tempQ4 . "," . $tempCount;
		fwrite($myfile, $tempNew);
		fclose($myfile);
		
		echo round($skillAvg, 1) . "<br>";
		echo round($ques2Avg, 1) . "<br>";
		echo round($ques3Avg, 1) . "<br>";
		echo round($ques4Avg, 1) . "<br>";
	}
	
	else 
	{
		$tempQ1First = $_POST["q1"];
		$tempQ2First = $_POST["q2"];
		$tempQ3First = $_POST["q3"];
		$tempQ4First = $_POST["q4"];
		$tempCountFirst = 1;
		
		$myfile = fopen("$filepath", "w+") or die ("unable to open file!");
		$txt = $tempQ1First . "," . $tempQ2First . "," . $tempQ3First . "," . $tempQ4First . "," . $tempCountFirst;
		fwrite($myfile, $txt);
		fclose($myfile);
		
		echo round($tempQ1First, 1) . "<br>";
		echo round($tempQ2First, 1) . "<br>";
		echo round($tempQ3First, 1) . "<br>";
		echo round($tempQ4First, 1) . "<br>";
	
	}
?>
		</div>
	</body>
</html>