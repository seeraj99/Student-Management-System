<?php  	
	error_reporting(0);
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

	$sql = "SELECT * FROM user WHERE usertype='student'";

	$result = mysqli_query($data, $sql);
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
		<center>
			<h1> STUDENT DATA </h1>
			<?php 
				if ($_SESSION['message']) 
				{
					echo $_SESSION['message'];

					unset($_SESSION['message']);
				}
			 ?>
			<table border="1px">
				<tr>
					<th class="table_th"> Username </th>
					<th class="table_th"> Email </th>
					<th class="table_th"> Phone  </th>
					<th class="table_th"> Password </th>
					<th class="table_th"> Delete </th>
					<th class="table_th"> Update </th>
				</tr>

				</tr>
				<?php 
					while($info=$result->fetch_assoc())

					{

				 ?>

				<tr>
					<td class="table_td">
						<?php echo "{$info ['username']}"; ?>
					</td>
					<td class="table_td">
						<?php echo "{$info ['email']}"; ?>
					</td>
					<td class="table_td">
						<?php echo "{$info ['phone']}"; ?>
					</td>
					<td class="table_td">
					<?php echo "{$info ['password']}"; ?>
					</td>
					<td class="table_td">
					<?php echo "<a  onClick=\"javascript: return confirm('Are you sure to delete?'); \"class='btn btn-danger' href=\"delete.php?student_id={$info['id']}\">Delete</a>"; ?>
					</td>
					<td class="table_td">
						<?php echo "<a class='btn btn-primary' href='update_student.php?student_id={$info['id']}'>  update_student</a>";
						?>
					</td>
				</tr>

				<?php 
				}
			 ?>

			</table>
		</center>
	</div>
</body>
</html>