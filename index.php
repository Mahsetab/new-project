<?php
include"conn.php";
$err = "";
$valid_user ="";
$valid_pass ="";
$user_err = "";
$pass_err = "";



if(isset($_POST['login'])){

     $username = $_POST["username"];
     $password = $_POST["password"];
     $find_user = "SELECT * FROM users where username='$username'";
     $user_result=mysqli_query($conn,$find_user);
     $validation_user = mysqli_num_rows($user_result);
   
     $validation = "SELECT * FROM users where username='$username' AND password='$password'";
     $login_result=mysqli_query($conn,$validation);
     $validation_login = mysqli_num_rows($login_result);
   
      if($validation_login == 1){
         session_start();
         $_SESSION['user'] = $username ;
         header('location:main/home.php');
      }else if(empty($validation_user)){
         $err="*User doesnot exist!";
      }else{
         $err="*Password doesnot match!";
      }
   }


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Login Form</title>

<script src="index.js"></script>
</head>
<body style="text-align: center;">
<h1 style="text-align: center;"> University Management System </h1>
<h3 style="text-align: center;"> Login Information</h3>
 
  <fieldset style="width: 30%; border: 1px solid #ccc; padding: 10px; box-sizing: border-box; margin: 0 auto;">
    <legend style="text-align: center;">Login/Sign In</legend>
    
    <form style="text-align: center;" action="index.php" method="POST" onsubmit="return validateLoginForm(this)">
      <label> Username :</label><p id="usernameErr"></p>
      <input type="text" name="username" placeholder="Enter Username" ><br><br>
     
      <label> Password :</label><p id="passwordErr"></p>
      <input type="password" name="password" placeholder="Enter Password"><br><br>
 
      <input type="submit" name="login" value="Log in">
    </form>
  </fieldset>
  <br><br>
 
<div style="text-align: center;">
<label><a href="registration.php">Don't Have a Account ?</a></label>
<label><a href="forgot.php">Forget Password ?</a></label> <br><br>
</div>
 
</body>
</html>



