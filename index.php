<?php 
error_reporting(0);
session_start();
session_destroy();
if ($_SESSION['message']) 
{
    $message = $_SESSION['message'];
    echo "<script type='text/javascript'> 

            alert('$message');
        </script>";
}

	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "schoolproject";

	$data = mysqli_connect($host,$user,$password,$db);

	$sql = "SELECT * FROM teacher";

	$result =  mysqli_query($data,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title> </title>
</head>
<body>
	<nav> 
    <label class="logo"> My School </label>
    <ul> 
        <li><a href="">Home</a></li>
        <li><a href="">Contact</a></li>
        <li><a href="">Admission</a></li>
        <li><a href="login.php" class="btn btn-primary">Login</a></li>
    </ul>
</nav>
	<div class="sectio1">
		<label class="img_text"> We Teach to Inspire </label>
		<img class="main_img" src="school.png">
		
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img class="welcome_img" src="playground.jpg">
			</div>
			<div class="col-md-8">
				<h1> Welcome to My_School</h1>
				<p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
			</div>
			
		</div>
		
	</div>

	<center>
		<h1> Our Teachers </h1>
	</center>
	<div class="container">
		<div class="row">
			<?php 
				while ($info=$result->fetch_assoc()) 
				{
				
			 ?>
			<div class="col-md-4">
				<img class="teacher" src="<?php echo $info['image']; ?>">
				<h3><?php echo $info['name']; ?></h3>
				<h5><?php echo $info['description']; ?></h5>

			</div>
			<?php 
				}
			 ?>
		
		</div>
		
	</div>
	<center>
		<h1> Our Courses </h1>
	</center>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img class="courses" src="graphic_design.png">
				<h1>	GRAPHIC DESIGN </h1>
			</div>
			<div class="col-md-4">
				<img class="courses" src="digital_marketing.png">
				<h1>	DIGITAL MARKETING </h1>
			</div>
			<div class="col-md-4">
				<img class="courses" src="web_development.png">
				<h1>	WEB DEVELOPMENT </h1>
			</div>
			
		</div>
		
	</div>

	<center > 
		<h1 class="adm"> Admission form </h1>
	</center>
	<div  align="center" class="admission_form">
		<form action="data_check.php" method="POST">
			<div class="adm_int">
				<label class="label_text"> Name </label>
				<input class="input_degs" type="text" name="name">	
			</div>
			<div class="adm_int">
				<label class="label_text"> Email </label>
				<input class="input_degs" type="text" name="email">	
			</div>
			<div class="adm_int">
				<label class="label_text"> Phone Number</label>
				<input class="input_degs" type="Number" name="number">	
			</div>
			<div class="adm_int">
				<label class="label_text"> Message </label>
				<textarea class="input_txt" name="message">	</textarea>
			</div>
			<div class="adm_int">
				<input class="btn btn-primary" id="submit" type="submit" value="apply" name="apply">	
			</div>
		</form>
	</div>
	<footer> 
		<h3 class="footer_txt"> All @copyright reserved by seeraj hub </h3>

	</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>