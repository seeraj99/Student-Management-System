<?php 

					error_reporting(0);
					session_start();
					session_destroy();
					
				echo $_SESSION['loginMessage'];
				 ?>
				 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Login Page </title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body background="playground.jpg" class="body_deg">
	<center> 
		<div class="form_deg">
			<center class="title_deg"> 
			Login Details 
			<h4>
				
				</h4>

			</center>
			<form action="login_check.php" method="POST">
				<div>
					<label class="label_deg"> Username </label>
					<input type="text" name="username">
				</div>
				<div>
					<label class="label_deg"> Password </label>
					<input type="Password" name="password">
				</div>
				<div>
					<input class="btn btn-primary" type="submit" name="submit" value="Login">
				</div>
			</form>
		</div>
	</center>

</body>
</html>