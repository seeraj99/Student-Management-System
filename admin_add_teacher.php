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

	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "schoolproject";

	$data = mysqli_connect($host,$user,$password,$db);

	if (!$data) {
        die("Database connection failed: " . mysqli_connect_error());
    }

	if (isset($_POST['add_teacher'])) {
    $T_name = $_POST['name'];
    $description = $_POST['description'];
    $file = $_FILES['image']['name'];
	$tmp_file = $_FILES['image']['tmp_name']; // This is the temporary file path
	$dst = "./image/" . $file;
	$dst_db = "image/" . $file;

if (move_uploaded_file($tmp_file, $dst)) {
    // File moved successfully, proceed with database insertion
    $sql = "INSERT INTO teacher (name, description, image) VALUES ('$T_name','$description','$dst_db')";
   
    $result = mysqli_query($data, $sql);

    if ($result) {
        $_SESSION['message'] = 'Teacher Added successfully!';
        header("location: admin_add_teacher.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        $_SESSION['message'] = 'Update failed. Please try again.';
    }
} else {
    $_SESSION['message'] = 'Failed to upload image. Please try again.';
}

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
	 <style type="text/css">
        label {
            display: inline-block;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: right;
        }
    </style>
</head>
<body>
	<?php 
		include "admin_sidebar.php";
	 ?>
	<div class="content">
		<center>
			<h1> UPDATING STUDENT INFORMATION  </h1>
			<?php 
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']); // Clear the message after displaying
                }
            ?>
			<div>
				<form action="#" method="POST" enctype="multipart/form-data">
					<div>
						<label> TeacherName </label>
						<input type="text" name="name">
					</div>
					<div>
						<label> Description   </label>
						<input type="text" name="description">
					</div>
					<div>
					<div>
						<label> Image </label>
						<input type="file" name="image">
					</div>
					<div>
						<input class="btn btn-success" type="submit" name="add_teacher" value="Add Teacher">
					</div>
				</form>
			</div>
		</center>
	</div>
</body>
</html>