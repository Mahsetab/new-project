<?php
session_start();
$user = $_SESSION['user'];
include"../conn.php";
$err = "";

if(isset($_POST['submit'])){


    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    

    if($imageFileType != "jpg" && $imageFileType != "png") {
      $err = "Sorry, only PNG & JPG files are allowed.";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      $err = "Sorry, your file was not uploaded!";
    } else {
      $image_file = $target_dir.$user.".".$imageFileType ;
      $image_db = $user.".".$imageFileType ;
      mysqli_query($conn, "UPDATE users SET img='$image_db' WHERE username='$user'");
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $image_file);
      $err = "Image Uploaded!";
    }


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./uploadimg.css">
</head>
<body>
    <fieldset>
        <legend>Upload Profle Picture</legend>
        <p><?php echo $err ; ?></p>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <input type="submit" value="Upload Image" name="submit">
        </form><br><br>
     <button><a href="profile.php">Back to Profile</a></button>
     <button><a href="home.php">Back to Home</a></button>
    </fieldset>
</body>
</html>
