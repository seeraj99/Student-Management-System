<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == "student") {
    header("location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_GET['teacher_id'])) {
    $t_id = $_GET['teacher_id'];
    $sql = "SELECT * FROM teacher WHERE id='$t_id'";
    $result = mysqli_query($data, $sql);
    $info = $result->fetch_assoc();
}

if (isset($_POST['update_teacher'])) {
    $T_id = $_POST['id'];
    $T_name = mysqli_real_escape_string($data, $_POST['name']);
    $description = mysqli_real_escape_string($data, $_POST['description']);
    
    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $file = $_FILES['image']['name'];
        $tmp_file = $_FILES['image']['tmp_name'];
        $dst = "./image/" . $file;
        $dst_db = "image/" . $file;
        move_uploaded_file($tmp_file, $dst);
    } else {
        $dst_db = $info['image']; // Keep old image if no new image is uploaded
    }

    $sql2 = "UPDATE teacher SET name='$T_name', description='$description', image='$dst_db' WHERE id='$T_id'";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        $_SESSION['message'] = 'Teacher updated successfully!';
        header("location: admin_add_teacher.php");
        exit();
    } else {
        $_SESSION['message'] = 'Updating failed. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <?php include "admin_css.php"; ?>
    <style type="text/css">
        label {
            display: inline-block;
            width: 150px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: right;
        }
        .form_deg {
            width: 600px;
        }
    </style>
</head>
<body>
    <?php include "admin_sidebar.php"; ?>
    <div class="content">
        <center>
        <h1>Teacher Update</h1>
        <br>
        <?php 
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']); // Clear the message after displaying
                }
            ?>
        <form class="form_deg" action="#" method="POST" enctype="multipart/form-data">
            <div>
                <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
            </div>
            <div>
                <label>Teacher Name</label>
                <input type="text" name="name" value="<?php echo $info['name']; ?>">
            </div>
            <div>
                <label>Description</label>
                <input type="text" name="description" value="<?php echo $info['description']; ?>">
            </div>
            <div>
                <label>Teacher Old Image</label>
                <img width="100px" height="100px" src="<?php echo $info['image']; ?>">
            </div>
            <div>
                <label>Choose New Image</label>
                <input type="file" name="image">
            </div>
            <div>
                <input class="btn btn-success" type="submit" name="update_teacher" value="Update Teacher">
            </div>
        </form>
        </center>
    </div>
</body>
</html>
