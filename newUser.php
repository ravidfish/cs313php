<?php 

session_start();
require("dbConnector.php");
$db = loadDatabase();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title>Dinobabies</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="../../assets/js/ie-emulation-modes-warning.js"></script>
	</head>
	
	<body>
		<nav class="navbar navbar-fixed-top navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<span class="navbar-brand" href="dinobabies.php">Dinobabies</span>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="dinobabiesLogin.php">Back To Log In</a></li>
					</ul>
				</div>
			</div><!-- /.container -->
		</nav><!-- /.navbar -->
		
		<!-- header contents -->
		<div class="container">
			<div class="jumbotron">
				<h1>New User</h1> 
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<div style="margin-top:20px">
						<div>
							<form name="form_login" method="post" action="createUser.php" role="form">
								<fieldset>
									<hr>
										<div>
											<input name="fName" type="text" id="fName" placeholder="First Name"><br /><br />
										</div>
										<div>
											<input name="lName" type="text" id="lName" placeholder="Last Name"><br /><br />
										</div>
										<div>
											<input name="new_user" type="text" id="new_user" placeholder="User ID: Email"><br /><br />
										</div>
										<div>
											<input type="password" name="password1" id="password1" placeholder="Enter Your Password"><br /><br />
										</div>
										<div>
											<input type="password" name="password2" id="password2" placeholder="Re-enter Your Password">
										</div>
									</hr>
									<hr>
										<div>
											<div>
												<input type="submit" name="Submit" value="Create">
											</div>
										</div>
									</hr>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
