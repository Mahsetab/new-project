<?php
session_start();
include"../conn.php";
$oldpass=$newpass=$confirmpass="";
$oldpassErr=$newpassErr=$confirmpassErr="";
$user = $_SESSION['user'];
$done = 1;
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST["oldpass"])) {
        $oldpassErr="Required Old Password";
        $done = 0;
      }else {
        $oldpass = test_input($_POST["oldpass"]);
     }


    if(empty($_POST["newpass"])) {
        $newpassErr="Password is required";
        $done = 0;
    }else {
          $newpass = test_input($_POST["newpass"]);
        if(strlen($newpass) < 8) {
            $newpassErr = "Password should be at least 8 characters";
            $done = 0;
        }
    }

    if(empty($_POST["confirmpass"])) {
        $confirmpassErr=" Password Required";
        $done = 0;
    }else if($_POST["newpass"] != $_POST["confirmpass"]){
        $confirmpassErr="Password Doesnot Match!";
        $done = 0;
    }else{
        $confirmpass = test_input($_POST["confirmpass"]);
    }
    }
if(isset($_POST['changepass']) && $done==1){
    $validation = "SELECT * FROM users where username='$user' AND password='$oldpass'";
    $login_result=mysqli_query($conn,$validation);
    $validation_login = mysqli_num_rows($login_result);
    if($validation_login == 1){
        $SQL = $conn->prepare("UPDATE users SET password=? WHERE username=?");
        $SQL->bind_param('ss', $confirmpass, $user);
        $SQL->execute();
        $success = "Password Changed";
    }else{
        $oldpassErr="Old Password Doesnot match!";
    }
}

/*
    $find_user = "SELECT * FROM users where newpass='$newpass'";
    $user_result=mysqli_query($conn,$find_user);
    $validation_user = mysqli_num_rows($user_result);
    if($validation_user == 1){
      $newpassErr = "Username taken! Choose new";
      $done = 0;
    }

    if($done > 0){
      mysqli_query($conn, "INSERT INTO users (oldpass,newpass,confirmpass)
      VALUES ('oldpass','newpass','confirmpass')");
      session_start();
      $_SESSION['newpass'] = $newpass ;
      header('location:main/home.php');
   }
        
        *///





        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="./changepass.css">
    <script src="changepass.js"></script>

</head>
<body>


<form method="POST" action="changepass.php" method="POST" onsubmit="return validatChangepassForm(this)">

<fieldset>
    <legend><h3>Change Password</h3></legend>
    <p><?php echo $success ; ?></p>
    <table>
        <tr>
            <td>
                <label>Old Password :</label><p id="oldpassErr"></p>
                <input type="text" name="oldpass">
                <span class="error">* <?php echo $oldpassErr;?></span>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <label>New Password :</label><p id="newpassErr"></p>
                <input type="text" name="newpass">
                <span class="error">* <?php echo $newpassErr;?></span>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <label>Confirm Password :</label><p id="confirmpassErr"></p>
                <input type="text" name="confirmpass">
                <span class="error">* <?php echo $confirmpassErr;?></span>
            </td>
        </tr>
    </table>

</fieldset><br>

<input name="changepass" type="submit" value ="Change Password">
</form><br>
<button><a href="profile.php">Back to Profile</a></button>
</body>
</html>