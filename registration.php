<?php

include "conn.php";
$firstnameErr = $lastnameErr = $genderErr = $bloodgroupErr = $emailErr = $phonenumberErr = $websiteErr = $addressErr = $usernameErr = $passwordErr = $confirmpasswordErr = "";
$questionErr = "";
$ansErr = "";
$done = 1;

$c_modified_time = "";
$c_fname = $c_lname = $c_email = $c_number = $c_website = $c_address = "";
$c_username = $c_pass1 = $c_pass2 = "";
if (!empty($_COOKIE['c_fname'])) {
  $c_fname = $_COOKIE['c_fname'];
}
if (!empty($_COOKIE['c_lname'])) {
  $c_lname = $_COOKIE['c_lname'];
}
if (!empty($_COOKIE['c_email'])) {
  $c_email = $_COOKIE['c_email'];
}
if (!empty($_COOKIE['c_number'])) {
  $c_number = $_COOKIE['c_number'];
}
if (!empty($_COOKIE['c_website'])) {
  $c_website = $_COOKIE['c_website'];
}
if (!empty($_COOKIE['c_address'])) {
  $c_address = $_COOKIE['c_address'];
}

if (!empty($_COOKIE['c_username'])) {
  $c_username = $_COOKIE['c_username'];
}
if (!empty($_COOKIE['c_pass1'])) {
  $c_pass1 = $_COOKIE['c_pass1'];
}
if (!empty($_COOKIE['c_pass2'])) {
  $c_pass2 = $_COOKIE['c_pass2'];
}

date_default_timezone_set("Asia/Dhaka");
$modified_time = date("Y-m-d h:i:sa");

if (!empty($_COOKIE['modified_time'])) {
  $c_modified_time = $_COOKIE['modified_time'];
}

if (isset($_POST['draft'])) {
  setcookie("c_fname", $_POST['firstname'], time() + 3600000);
  setcookie("c_lname", $_POST['lastname'], time() + 3600000);
  setcookie("c_email", $_POST['email'], time() + 3600000);
  setcookie("c_number", $_POST['number'], time() + 3600000);
  setcookie("c_website", $_POST['website'], time() + 3600000);
  setcookie("c_address", $_POST['address'], time() + 3600000);

  setcookie("c_username", $_POST['username'], time() + 3600000);
  setcookie("c_pass1", $_POST['pass1'], time() + 3600000);
  setcookie("c_pass2", $_POST['pass2'], time() + 3600000);

  setcookie("modified_time", $modified_time, time() + 3600000);

  header('location:index.php');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["firstname"])) {
    $firstnameErr = "Fisrt Name is required";
    $done = 0;
  } else {
    $firstname = test_input($_POST["firstname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)) {
      $firstnameErr = "Only letters and white space allowed";
    }
  }

  //Last Name
  if (empty($_POST["lastname"])) {
    $lastnameErr = "Last Name is required";
    $done = 0;
  } else {
    $lastname = test_input($_POST["lastname"]);
    if (!preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
      $lastnameErr = "Only letters and white space allowed";
    }
  }
  // Gender
  if (empty($_POST["gender"])) {
    $genderErr = "";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  // Blood Group
  if (empty($_POST["blood"])) {
    $bloodgroupErr = "Blood is required";
    $done = 0;
  } else {
    $bloodgroup = test_input($_POST["blood"]);
  }

  //Email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $done = 0;
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email";
      $done = 0;
    }
  }
  //Phone Number
  if (empty($_POST["number"])) {
    $phonenumberErr = "Phone Number is required ";
    $done = 0;
  } else {
    $phonenumber = test_input($_POST["number"]);
  }

  //Website
  if (empty($_POST["website"])) {
    $website = "";
    $done = 0;
  } else {
    $website = test_input($_POST["website"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
      $websiteErr = "Invalid URL";
    }
  }
  //address
  if (empty($_POST["address"])) {
    $addressErr = "";
    $done = 0;
  } else {
    $address = test_input($_POST["address"]);
  }
  //username
  if (empty($_POST["username"])) {
    $usernameErr = "Username  is required";
    $done = 0;
  } else {
    $username = test_input($_POST["username"]);

    $find_user = "SELECT * FROM users where username='$username'";
    $user_result = mysqli_query($conn, $find_user);
    $validation_user = mysqli_num_rows($user_result);
    if ($validation_user == 1) {
      $usernameErr = "Username taken! Choose new";
      $done = 0;
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $username)) {
      $usernameErr = "Only letters ";
      $done = 0;
    }
  }

  //password
  if (empty($_POST["pass1"])) {
    $passwordErr = "Password  is required";
    $done = 0;
  } else if (strlen($_POST["pass1"]) <= 8) {
    $passwordErr = "Password  should be atleast 8 Character";
    $done = 0;
  } else {
    $pass1 = test_input($_POST["pass1"]);
  }

  if (empty($_POST["pass2"])) {
    $passwordErr = "Password  is required";
    $done = 0;
  } else if ($_POST["pass2"] != $pass1) {
    $confirmpasswordErr = "Confirm Password Must Match with Password!";
    $done = 0;
  } else {
    $pass = test_input($_POST["pass2"]);
  }


  $noQuestion = 0;
  $noAns = 0;
  $question = array();
  $ans = array();


  if (!empty($_POST["q1"]) && !empty($_POST["ans1"])) {
    $noQuestion = $noQuestion + 1;
    $noAns = $noAns + 1;
    $ans[0] = test_input($_POST["ans1"]);
    $question[0] = test_input($_POST["q1"]);
  }
  if (!empty($_POST["q2"]) && !empty($_POST["ans2"])) {
    $noQuestion = $noQuestion + 1;
    $noAns = $noAns + 1;
    $ans[1] = test_input($_POST["ans2"]);
    $question[1] = test_input($_POST["q2"]);
  }
  if (!empty($_POST["q3"]) && !empty($_POST["ans3"])) {
    $noQuestion = $noQuestion + 1;
    $noAns = $noAns + 1;
    $ans[2] = test_input($_POST["ans3"]);
    $question[2] = test_input($_POST["q3"]);
  }
  if (!empty($_POST["q4"]) && !empty($_POST["ans4"])) {
    $noQuestion = $noQuestion + 1;
    $noAns = $noAns + 1;
    $ans[3] = test_input($_POST["ans4"]);
    $question[3] = test_input($_POST["q4"]);
  }


  if ($noQuestion < 2) {
    $questionErr = "Atleast 2 Question Need to be Added";
    $done = 0;
  }


  if ($noQuestion != $noAns) {
    $ansErr = "Make Sure you answered selected Questions!";
    $done = 0;
  }





  if ($done > 0) {
    $img = "demo.png";
    $SQL = $conn->prepare("INSERT INTO users (username, password , fname, lname , email , phone , gender , blood , website , address ,img) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $SQL->bind_param('sssssssssss', $username, $pass, $firstname, $lastname, $email, $phonenumber, $gender, $bloodgroup, $website, $address, $img);
    $SQL->execute();
    for ($i = 0; $i < $noQuestion; $i++) {
      $SQL = $conn->prepare("INSERT INTO questions (username, question, ans) VALUES (?,?,?)");
      $SQL->bind_param('sss', $username, $question[$i], $ans[$i]);
      $SQL->execute();
    }
    session_start();
    $_SESSION['user'] = $username;
    header('location:main/home.php');
  }
}

function test_input($data)
{
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
  <link rel="stylesheet" href="registration.css">
  <title>Registration</title>

</head>

<body>
  <h1> Registration</h1>

  <h3>Last modified time : <?php echo $c_modified_time; ?></h3>

  <p><span class="error">* Required field</span></p>

  <form method="POST" action="registration.php" id="registration" enctype="multipart/form-data" novalidate>
    <fieldset>
      <legend>
        <h3> General Information</h3>
      </legend>

      <label>First Name :</label>
      <p id="firstnameErr"></p>
      <input type="text" value="<?php echo $c_fname; ?>" name="firstname">
      <span class="error">* <?php echo $firstnameErr; ?></span><br><br>
      <label>Last Name :</label>
      <p id="lastnameErr"></p>
      <input type="text" value="<?php echo $c_lname; ?>" name="lastname">
      <span class="error">* <?php echo $lastnameErr; ?></span><br><br>

      <label>Gender :</label>
      <p id="genderErr"></p>
      <input type="radio" name="gender" value="female"> Male
      <input type="radio" name="gender" value="male"> Female
      <input type="radio" name="gender" value="other"> Other
      <span class="error">* <?php echo $genderErr; ?></span><br><br>

      <label>Blood Group : </label>
      <p id="bloodErr"></p>
      <select name="blood" required>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="AB+">AB+</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
      </select>
      <span class="error">* <?php echo $bloodgroupErr; ?></span>

    </fieldset>

    <fieldset>

      <legend>
        <h3> Contact Information </h3>
      </legend>

      <table>
        <tr>
          <td>
            <label>Eamil :</label>
            <p id="emailErr"></p>
          </td>
          <td>
            <input type="text" name="email" value="<?php echo $c_email; ?>">
            <span class="error">* <?php echo $emailErr; ?></span><br>
          </td>
        </tr>

        <tr>
          <td>
            <label>Phone Number :</label>
            <p id="numberErr"></p>
          </td>
          <td>
            <input type="number" value="<?php echo $c_number; ?>" name="number">
            <span class="error">* <?php echo $phonenumberErr; ?></span><br>
          </td>
        </tr>

        <tr>
          <td>
            <label>Website :</label>
          </td>
          <td>
            <input type="text" value="<?php echo $c_website; ?>" name="website">

          </td>
        </tr>



        <tr>
          <td>
            <label>Address :</label>
          </td>
          <td>
            <textarea type="text" name="address"><?php echo $c_address; ?></textarea>

          </td>
        </tr>

      </table>

    </fieldset>


    <fieldset>
      <legend>
        <h3>Security Question</h3>
      </legend>
      <?php echo $questionErr; ?>
      <?php echo $ansErr; ?>
      <table>
        <tr>
          <td>
            <label> Question 1 :</label>
            <select name="q1">
              <option>Select Question </option>
              <option value="2">Where is the first place you spent a vacation? </option>
              <option value="3">What is your favourite food ? </option>
              <option value="4">What is your pet name ? </option>
              <option value="5">What is your favourite singer ? </option>
            </select>
          </td>
          <td>
            <input type="text" name="ans1" placeholder="Answer 1">
          </td>
        </tr>
        <tr>
          <td>
            <label> Question 2 :</label>
            <select name="q2">
              <option>Select Question </option>
              <option value="2">Where is the first place you spent a vacation </option>
              <option value="3">What is your favourite food ? </option>
              <option value="4">What is your pet name ? </option>
              <option value="5">What is your favourite singer ? </option>
            </select>
          </td>
          <td>
            <input type="text" name="ans2" placeholder="Answer 2">
          </td>
        </tr>

        <tr>
          <td>
            <label> Question 3 :</label>
            <select name="q3">
              <option>Select Question </option>
              <option value="2">Where is the first place you spent a vacation? </option>
              <option value="3">What is your favourite food ? </option>
              <option value="4">What is your pet name ? </option>
              <option value="5">What is your favourite singer ? </option>
            </select>
          </td>
          <td>
            <input type="text" name="ans3" placeholder="Answer 3">
          </td>
        </tr>

        <tr>
          <td>
            <label> Question 4 :</label>
            <select name="q4">
              <option>Select Question </option>
              <option value="2">Where is the first place you spent a vacation? </option>
              <option value="3">What is your favourite food ? </option>
              <option value="4">What is your pet name ? </option>
              <option value="5">What is your favourite singer ? </option>
            </select>
          </td>

          <td>
            <input type="text" name="ans4" placeholder="Answer 4">
          </td>
        </tr>
      </table>
    </fieldset>




    <fieldset>

      <legend>
        <h3> Account Information</h3>
      </legend>
      <table>
        <tr>
          <td>
            <label>Username :</label>
            <p id="usernameErr"></p>
          </td>
          <td>
            <input type="text" name="username" value="<?php echo $c_username; ?>">
            <span class="error">* <?php echo $usernameErr; ?></span><br>
          </td>
        </tr>

        <tr>
          <td>
            <label>Password :</label>
            <p id="pass1Err"></p>
          </td>
          <td>
            <input type="password" name="pass1" value="<?php echo $c_pass1; ?>">
            <span class="error">* <?php echo $passwordErr; ?></span><br>
          </td>
        </tr>

        <tr>
          <td>
            <label>Confirm Password :</label>
            <p id="pass2Err"></p>
          </td>
          <td>
            <input type="password" name="pass2" value="<?php echo $c_pass2; ?>">
            <span class="error">* <?php echo $confirmpasswordErr; ?></span><br>
          </td>
        </tr>
      </table>

    </fieldset> <br>
    <div class="submit_vi">
      <input type="submit" value="Register" name="register">
      <input type="submit" value="Save as Draft" name="draft">
    </div>
  </form>

</body>
<script src="registration.js"></script>

</html>