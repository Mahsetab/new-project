<?php
session_start();
include"../conn.php";
$user = $_SESSION['user'];

$fname = $lname = $number = $email = $address = "";
$fnameErr = $numberErr= $emailErr= $addressErr ="";

$done = 1;
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST["fname"]) || empty($_POST["lname"])) {
        $fnameErr="First name and Last name Required";
        $done = 0;
    }else {
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
    }

    if(empty($_POST["number"])) {
        $numberErr="Number is Required";
        $done = 0;
    }else {
          $number = test_input($_POST["number"]);
    }


    if(empty($_POST["email"])) {
        $emailErr="Email is Required";
        $done = 0;
    }else {
        $email = test_input($_POST["email"]);
    }

    if(empty($_POST["address"])) {
        $addressErr="Address is Required";
        $done = 0;
    }else {
        $address = test_input($_POST["address"]);
    }

}

if(isset($_POST['update']) && $done==1){

        $SQL = $conn->prepare("UPDATE users SET fname=? , lname=? , phone=? , email=? , address=? WHERE username=?");
        $SQL->bind_param('ssssss', $fname, $lname,$number,$email,$address,$user);
        $SQL->execute();
        
        $success = "Profile Updated!";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$ssql = "SELECT * FROM users where username='$user'"; 
$rresult = mysqli_query($conn,$ssql); 
while ($row = mysqli_fetch_assoc($rresult)){
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./updateprofile.css">
    <script src="updateprofile.js"></script>
 
</head>
<body>

    <fieldset>
        <legend>Update Profile</legend>

        <form method="POST" action="updateprofile.php"onsubmit="return updateprofileForm(this)">
            


            
            
<table style="text-align:left;">
    <tr>
        <th><label for="name">Name : </label></th> <p id="fnameErr"></p>
        <td>    
            <input type="text" name="fname" value="<?php echo $row['fname'] ; ?>">
            <input type="text" name="lname" value="<?php echo $row['lname'] ; ?>">
            <span class="error">* <?php echo $fnameErr;?></span><br>
        </td>
    </tr>

    <tr>
        <th><label for="number">Mobile Number : </label></th> <p id="numberErr"></p>
        <td>            
            <input type="text" name="number" value="<?php echo $row['phone'] ; ?>">
            <span class="error">* <?php echo $numberErr;?></span><br>
        </td>
    </tr>

    <tr>
        <th><label for="number">Email : </label></th> <p id="emailErr"></p>
        <td>            
            <input type="email" name="email" value="<?php echo $row['email'] ; ?>">
            <span class="error">* <?php echo $emailErr;?></span><br>
        </td>
    </tr>

    <tr>
        <th><label for="number">Address : </label></th> <p id="addressErr"></p>
        <td>            
            <textarea type="text" cols="30" rows="5" name="address" ><?php echo $row['address'] ; ?></textarea>
            <span class="error">* <?php echo $addressErr;?></span><br>
        </td>
    </tr>

    <tr>
        <td><button type="submit" name="update">Update</button></td>
    </tr>
</table>

</form>

<br><br>
<button><a href="profile.php">Back to Profile</a></button>
<button><a href="home.php">Back to Home</a></button>

    </fieldset>
<?php } ?>

</body>
</html>