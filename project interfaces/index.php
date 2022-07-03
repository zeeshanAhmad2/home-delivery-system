<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->

    <link rel="stylesheet" href="login_register_style.css">

</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="" method="POST">
        <h3>Login</h3>
        <label for="username">Username</label>
        <input type="text" placeholder="Email" id="username" name="email">
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">
        <label for="usertype">User Type</label>
        <input type="text" placeholder="driver or customer" name="usertype">
        <input type="submit" value="Login" class="btn btn-primary" name="submit">
        </div>
    </form>
</body>


<?php

$sql_internal = "SELECT customer_id FROM customers WHERE user_id = " . 1 . ";";
echo $sql_internal;
 if (isset($_POST["submit"])) {

    $email = $_POST['email'];
    $user_password = $_POST['password'];
    $user_type = $_POST['usertype'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ds";
    $conn = mysqli_connect($servername, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error()); 
    }

 if($user_type == 'customer') {

   $sql = sprintf("SELECT * FROM users WHERE user_type = 'customer' AND email = '%s' AND password = '%s';", $email, $user_password);
   echo $sql;
   $result = mysqli_query($conn, $sql);

   if(mysqli_num_Rows($result) > 0) {
    echo "<script>alert('user found');</script>";


    $row = mysqli_fetch_assoc($result);

    
    $sql_internal = "SELECT customer_id FROM customers WHERE user_id = " . $row['user_id'] . ";";
    echo "<script>alert(" . $sql_internal . ");</script>";
    $result_internal = mysqli_query($conn, $sql_internal);
    $row_internal = mysqli_fetch_assoc($result_internal);

    $_SESSION['customer_id'] = $row_internal['customer_id'];
   
    $_SESSION['first_name'] = $row['first_name'];
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['password'] = $row['password'];


     header("Location: zeeshan/index.php");

   } else {
    echo "<script>alert('not found');</script>";
   }
   
} else if ($user_type == 'driver') {


    $sql = sprintf("SELECT * FROM users WHERE user_type = 'driver' AND email = '%s' AND password = '%s';", $email, $user_password);
    echo $sql;
    $result = mysqli_query($conn, $sql);
 
    if(mysqli_num_Rows($result) > 0) {
  
     echo "<script>alert('user found');</script>";

     $sql_internal = "SELECT driver_id FROM drivers WHERE user_id = " . $row['user_id'] . ";";
     $result_internal = mysqli_query($conn, $sql_internal);
     $row_internal = mysqli_fetch_assoc($result_internal);
 
     $_SESSION['driver_id'] = $row_internal['driver_id'];
    
     $_SESSION['first_name'] = $row['first_name'];
     $_SESSION['user_id'] = $row['user_id'];
     $_SESSION['email'] = $row['email'];
     $_SESSION['password'] = $row['password'];
 

     header("Location: sadat/driver.php");

    } else {
     echo "<script>alert('not found');</script>";
    }


}
}
?>

</html>