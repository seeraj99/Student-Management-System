<?php  
    session_start();
    
    // Redirect users based on their session and user type
    if (!isset($_SESSION['username'])) {
        header("location: login.php");
        exit(); // Ensure no further code is executed after redirect
    } elseif ($_SESSION['usertype'] == "admin") {
        header("location: login.php");
        exit(); // Ensure no further code is executed after redirect
    }

    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "schoolproject";

    $data = mysqli_connect($host, $user, $password, $db);

    if (!$data) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $name = $_SESSION['username'];

    $sql = "SELECT * FROM user WHERE username='$name'";
    $result = mysqli_query($data, $sql);
    $info = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
        $s_email = $_POST['email'];
        $s_phone = $_POST['phone'];
        $s_password = $_POST['password'];

        $query = "UPDATE user SET email='$s_email', phone='$s_phone', password='$s_password' WHERE username='$name'";
        $result2 = mysqli_query($data, $query);

        if ($result2) {
            $_SESSION['message'] = 'Updating student successful!';
            header("location: student_profile.php");
            exit(); // Ensure no further code is executed after redirect
        } else {
            $_SESSION['message'] = 'Update failed. Please try again.';
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
    <?php include "student_css.php"; ?>
    <style type="text/css">
        label {
            display: inline-block;
            width: 100px;
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: right;
        }
        h1 {
            text-align: center;
            font-weight: bold;
            font-size: 40px;
            padding-top: 15px;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php include "student_sidebar.php"; ?>
    <div class="content">
        <center>
            <h1>Student Information Update</h1>
            <?php 
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']); // Clear the message after displaying
                }
            ?>
            <form action="#" method="POST">
                <div>
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($info['email']); ?>">
                </div>
                <div>
                    <label>Phone</label>
                    <input type="number" name="phone" value="<?php echo htmlspecialchars($info['phone']); ?>">
                </div>
                <div>
                    <label>Password</label>
                    <input type="text" name="password" value="<?php echo htmlspecialchars($info['password']); ?>">
                </div>
                <div>
                    <input type="submit" class="btn btn-success" name="update_profile" value="Update">
                </div>
            </form>
        </center>
    </div>
</body>
</html>
