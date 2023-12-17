<?php
include"conn.php";
$err = "";

if(isset($_POST['next'])){
    $user = $_POST['username'];

    $find_user = "SELECT * FROM users where username='$user'";
    $user_result=mysqli_query($conn,$find_user);
    $validation_user = mysqli_num_rows($user_result);

    if($validation_user == 1){
        echo"
            <script>
               window.location.href='forgetpassword.php?ref=$user'
            </script>
        ";
    }else{
        $err = "<p style='color:red;'>No account found associated with this Username*</p> ";
    }

}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot</title>

    <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center; /* Center the content horizontally */
        }

        fieldset {
            border: 2px solid #333;
            border-radius: 5px;
            padding: 10px;
            margin: 20px auto; /* Center the fieldset horizontally */
            max-width: 400px; /* Set a maximum width for better readability */
        }

        legend {
            font-size: 1.2em;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        td {
            padding: 5px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        div {
            margin-top: 10px;
        }

        label {
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }
      /* body {
  font-family: 'Arial', sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

fieldset {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border: none;
}

legend {
  font-size: 24px;
  font-weight: bold;
  color: #333;
  margin-bottom: 20px;
}

table {
  width: 100%;
  margin-bottom: 20px;
}

table tr {
  margin-bottom: 10px;
}

table td {
  padding: 10px;
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  box-sizing: border-box;
}

button {
  background-color: #3498db;
  color: #fff;
  padding: 10px 15px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}

button:hover {
  background-color: #2980b9;
}

div {
  text-align: center;
  margin-top: 20px;
}

a {
  color: #3498db;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
} */

    </style>

<script src="forgot.js"></script>
</head>

<body>
    <fieldset>
        <legend>
            <h3>Forgot Password</h3>
        </legend>
        <p><?php echo $err; ?></p>
        <form method="POST" action="forgot.php"  onsubmit="return validateforgotpassForm (this)">
            <table>
                <tr>
                    <td>Username :</td><p id="usernameErr"></p>
                    <td><input type="text" name="username" /></td>
                </tr>
            </table>
            <button type="submit" name="next">NEXT</button>
        </form>
    </fieldset>
    <div>
    <label><a href="registration.php">Don't Have an Account?</a></label>
    <label><a href="index.php">Log In?</a></label> <br>
    </div>
</body>

</html>







