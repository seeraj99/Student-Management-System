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
	$sql="SELECT * from admission";

	$result = mysqli_query($data, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		include "admin_css.php";
	 ?>
	<title> Admin Dashboard </title>
</head>
<body>

	<?php 
		include "admin_sidebar.php";
	 ?>
	
	<div class="content">
		<center>
		<h1> APPLIED FOR ADMISSION </h1>
		<table border="1" style="border-collapse: collapse; width: 100%;" >
			<tr>
				<th style=" padding: 20px; font-size: 15px; "> Name </th>
				<th style=" padding: 20px; font-size: 15px; "> email </th>
				<th style=" padding: 20px; font-size: 15px; "> number </th>
				<th style=" padding: 20px; font-size: 15px; "> message </th>
			</tr>
				<?php 
					while($info=$result->fetch_assoc())

					{

				 ?>
			<tr>
				<td style="padding: 20px;">
					<?php echo "{$info['name']}"; ?>
						
					</td>
				<td style="padding: 20px;">
					<?php echo "{$info['email']}"; ?>
						</td>
				<td style="padding: 20px;"> 
					<?php echo "{$info['number']}"; ?>
						</td>
				<td style="padding: 20px;"> 
					<?php echo "{$info['message']}"; ?>
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