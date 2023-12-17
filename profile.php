<!-- PHP Code Here ================================================== -->

<!-- Header -->
<?php include"header.php"; ?>
<!-- /== Header -->
<?php 
$ssql = "SELECT * FROM users where username='$user'"; 
$rresult = mysqli_query($conn,$ssql); 
while ($row = mysqli_fetch_assoc($rresult)){ 
?>

<h2><?php echo $row['fname']." ".$row['lname'] ; ?></h2>
        <img width="200" style="border-radius:50px; margin-bottom:20px;" src="img/<?php echo $row['img'] ; ?>" alt="<?php echo $row['fname'] ; ?>"><br>
        <button><a href="uploadimg.php">Upload Profile Image</a></button>
<table style="text-align:left">
        <tr><th>Phone : </th> <td><?php echo $row['phone'] ; ?></td></tr>
        <tr><th>Email : </th> <td><?php echo $row['email'] ; ?></td></tr>
        <tr><th>Website : </th>  <td><?php echo $row['website'] ; ?></td></tr>
        <tr><th>Blood Group : </th> <td><?php echo $row['blood'] ; ?></td></tr>
        <tr> <th>Address : </th> <td><?php echo $row['address'] ; ?></td></tr>
        <tr></tr>
</table>
<br>

<br><br><br>
<button><a href="updateprofile.php">Edit Profile</a></button>
<button><a href="home.php">Back to Home</a></button>
<br><br><br><br>
<?php } ?>

<!-- Footer -->
<?php include"footer.php"; ?>

<style>
        /* Global Styles */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f7f7f7;
  margin: 0;
  padding: 0;
}

/* Header Styles */
header {
  background-color: #333;
  color: white;
  padding: 15px;
  text-align: center;
}

/* Content Styles */
h2 {
  color: #3498db;
}

img {
  border-radius: 50%;
  margin-bottom: 20px;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

button {
  background-color: #3498db;
  color: #fff;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: block;
  margin: 20px auto;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

button a {
  color: inherit;
  text-decoration: none;
}

button:hover {
  background-color: #2980b9;
}

/* Table Styles */
table {
  width: 60%;
  margin: 20px auto;
  border-collapse: collapse;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

th, td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #3498db;
  color: white;
}

/* Footer Styles */
footer {
  background-color: #333;
  color: white;
  padding: 10px;
  text-align: center;
  position: fixed;
  bottom: 0;
  width: 100%;
}

</style>