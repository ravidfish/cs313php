 <?php 
 
session_start();
$errmsg_arr = array();
$errflag = false;

require("dbConnector.php");
$db = loadDatabase();    
 
if (isset($_REQUEST['Submit'])) 
{
    if($_REQUEST['user_id']=="" || $_REQUEST['password']=="")
    {
		echo " Field must be filled";
    }
	
    else
    {
		$user_id = $_REQUEST['user_id'];
		$pass = $_REQUEST['password'];
		
		$sql1= "select * from user where email = :user_id &&  password = :pass";
		$statement=$db->prepare($sql1);
		$statement->bindValue(":user_id", $user_id, PDO::PARAM_STR);
		$statement->bindValue(":pass", $pass, PDO::PARAM_STR);
		$statement->execute();
		$rows = $statement->fetch(PDO::FETCH_NUM);
	  
		if ($rows > 0)
		{ 
			header("location:dinobabies.php"); 
		}
  
		else
		{
			$errmsg_arr[]='Username and Password are not found';
			$errflag = true;
		
			if ($errflag)
			{
				echo "Username and Password are not found";
				$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
				session_write_close();
				header("Refresh: 2; dinobabiesLogin.php");
			}
        }
    }
}

?>
