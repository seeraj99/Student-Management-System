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

if (!$data) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM teacher";
$result = mysqli_query($data, $sql);

if (isset($_GET['teacher_id'])) {
    $t_id = $_GET['teacher_id'];
    $sql2 = "DELETE FROM teacher WHERE id ='$t_id'";
    $result2 = mysqli_query($data, $sql2);

    if ($result2) {
        $_SESSION['message'] = 'Teacher deleted successfully!';
        header("location: admin_add_teacher.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        $_SESSION['message'] = 'Deletion failed. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Teacher</title>
    <?php include "admin_css.php"; ?>
</head>
<body>
    <?php include "admin_sidebar.php"; ?>
    <div class="content">
        <center>
            <h1>LIST OF TEACHERS</h1>
            <?php 
                if (isset($_SESSION['message'])) {
                    echo "<div class='alert alert-success'>{$_SESSION['message']}</div>";
                    unset($_SESSION['message']); // Clear the message after displaying
                }
            ?>
            <br>
            <table border="1px" width="50%">
                <tr>
                    <th class="table_th">Name</th>
                    <th class="table_th">Description</th>
                    <th class="table_th">Image</th>
                    <th class="table_th">Delete</th>
                     <th class="table_th">Update</th>
                </tr>
                <?php 
                    while ($info = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td class="table_td"><?php echo $info['name']; ?></td>
                    <td class="table_td"><?php echo $info['description']; ?></td>
                    <td class="table_td">
                        <img height="100px" width="100px" src="<?php echo $info['image']; ?>">
                    </td>
                    <td class="table_td">
                        <?php echo "<a onClick=\"javascript: return confirm('Are you sure to delete?');\" class='btn btn-danger' href=\"view_teacher.php?teacher_id={$info['id']}\">Delete</a>"; ?>
                    </td>
                    <td class="table_td">
                       <?php  echo "<a class='btn btn-success' href='admin_update_teacher.php?teacher_id={$info['id']}'> Update</a>";

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
