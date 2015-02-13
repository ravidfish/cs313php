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
			</div><!-- /.container -->
		</nav><!-- /.navbar -->
		
		<!-- header contents -->
		<div class="container">
			<div class="jumbotron">
				<h1>Please Login</h1> 
			</div>
			<div class="row">
				<div class="col-md-4">
				
				</div>
				<div class="col-md-4">
					<div style="margin-top:20px">
						<div>
							<form name="form_login" method="post" action="login.php" role="form">
								<fieldset>
									<hr>
										<div>
											<input name="user_id" type="text" id="user_id" placeholder="Email Address">
										</div>
										<div>
											<input type="password" name="password" id="password" placeholder="Password">
										</div>
										<br /><br />
										<span>
											<button type="button" data-color="info">Remember Me</button><!-- Additional Option -->
										<input type="checkbox" name="remember_me" id="remember_me" checked="checked">
										</hr>
										<hr>
											<div>
												<div>
													<input type="submit" name="Submit" value="Login">
												</div>
												<div> 
													<a href="dinobabiesRegister.php">Register<small> - Create Account</small></a> 
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
