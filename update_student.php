<?php  	
	session_start();
	if (!isset($_SESSION['username'])) {
		header("location: login.php");

	}
	elseif ($_SESSION['usertype'] == "student") {
		header("location: login.php");
	}

	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "schoolproject";

	$data = mysqli_connect($host,$user,$password,$db);
	
	$id = $_GET['student_id'];

	$sql = "SELECT * FROM user WHERE  id = '$id'";

	$result = mysqli_query($data,$sql);

	$info=$result->fetch_assoc();

	if (isset($_POST['update'])) 
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];

		$query = "UPDATE user SET username='$name', email='$email', phone='$phone', password='$password'  WHERE id = '$id' ";

		$result2 = mysqli_query($data, $query);

		if ($result2) 
	{
		$_SESSION['message'] = 'Updating student Successful!!!';
		header("location: view_student.php");
	}
	}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> update student </title>
	<style type="text/css">
        label {
            display: inline-block;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: right;
        }
    </style>
	<?php 
		include "admin_css.php";
	 ?>
</head>
<body>
	<?php 
		include "admin_sidebar.php";
	 ?>
	<div class="content">
		<center>
			<h1> UPDATING STUDENT INFORMATION  </h1>
			<div>
				<form action="#" method="POST">
					<div>
						<label> Username </label>
						<input type="text" name="name" value="<?php echo "{$info ['username']}"; ?>">
					</div>
					<div>
						<label> email </label>
						<input type="text" name="email" value="<?php echo "{$info ['email']}"; ?>">
					</div>
					<div>
						<label> phone </label>
						<input type="number" name="phone" value="<?php echo "{$info ['phone']}"; ?>">
					</div>
					<div>
						<label> password </label>
						<input type="text" name="password" value="<?php echo "{$info ['password']}"; ?>">
					</div>
					<div>
						<input class="btn btn-success" type="submit" name="update" value="Update">
					</div>
				</form>
			</div>
		</center>
	</div>
</body>
</html>