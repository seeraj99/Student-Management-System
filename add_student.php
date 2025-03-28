<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
} elseif ($_SESSION['usertype'] == "student") {
    header("location: login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

$data = mysqli_connect($host, $user, $password, $db);

if (isset($_POST['add_student'])) {
    $username = $_POST['name'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['number'];
    $user_password = $_POST['password'];
    $user_type = 'student';

    $check = "SELECT * FROM user WHERE username = '$username'";
    $check_user = mysqli_query($data, $check);
    $row_count = mysqli_num_rows($check_user);

    if ($row_count == 1) {
        echo "<script type='text/javascript'> 
                alert('Username Already Taken. Try another one');
              </script>";
    } else {
        $sql = "INSERT INTO user(username, email, phone, usertype, password) 
                VALUES ('$username', '$user_email', '$user_phone', '$user_type', '$user_password')";

        $result = mysqli_query($data, $sql);

        if ($result) {
            echo "<script type='text/javascript'> 
                    alert('Upload Successful!!!');
                  </script>";
        } else {
            echo "<script type='text/javascript'> 
                    alert('Upload Failed!!!');
                  </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Student</title>
    <style type="text/css">
        label {
            display: inline-block;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: right;
        }
    </style>
    <?php include "admin_css.php"; ?>
</head>
<body>
    <?php include "admin_sidebar.php"; ?>
    <div>
        <center>
            <h1>ADD STUDENT</h1>
            <div>
                <form action="" method="POST">
                    <div>
                        <label>Username</label>
                        <input type="text" name="name">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="email">
                    </div>
                    <div>
                        <label>Phone</label>
                        <input type="number" name="number">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="text" name="password">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="add_student" value="Add Student">
                    </div>
                </form>
            </div>
        </center>
    </div>
</body>
</html>
