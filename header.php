<?php
$err = "";
session_start();
include"../conn.php";
$user = $_SESSION['user'];
if($user == false){
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="header.css">
  <title>Home</title>
</head>
<body style="margin:0; padding:0;">

<div class="navbar">
  <h3><a href="home.php">Home</a></h3>
  <h3><a href="profile.php">Profile</a></h3>
  <h3><a href="updateprofile.php">Update Profile</a></h3>
  <h3><a href="changepass.php">Change Password</a></h3>
  <h3><a href="logout.php">Logout</a></h3>
</div>



</body>
</html>

