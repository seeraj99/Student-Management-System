<?php  	
	session_start();
	if (!isset($_SESSION['username'])) {
		header("location: login.php");
		exit();

	}
	elseif ($_SESSION['usertype'] == "student") {
		header("location: login.php");
		exit();
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Admin Dashboard </title>
	<?php 
		include "admin_css.php";
	 ?>
</head>
<body>
	<?php 
		include "admin_sidebar.php";
	 ?>
	<div class="content">
		<h1> Admin View Only </h1>
		<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
</body>
</html>