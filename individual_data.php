<!-- PHP Code Here ================================================== -->

<!-- Header -->
<?php include"header.php"; ?>
<!-- /== Header -->
<?php 
$id = $_GET['ref'];
include"../conn.php";
$ssql = "SELECT * FROM staff where sl='$id'"; 
$rresult = mysqli_query($conn,$ssql); 
while ($row = mysqli_fetch_assoc($rresult)){ 
?>

<h2><?php echo $row['name'] ; ?></h2>

<table style="text-align:left">

        <tr><th>Department : </th> <td><?php echo $row['department'] ; ?></td></tr>
        <tr><th>Phone : </th> <td><?php echo $row['number'] ; ?></td></tr>
        <tr><th>Email : </th> <td><?php echo $row['email'] ; ?></td> </tr>
        <tr><th>Salary: </th> <td>TK. <?php echo $row['salary'] ; ?></td></tr>
        <tr><th>Entry Time : </th>  <td><?php echo $row['entry_time'] ; ?></td></tr>
        <tr><th>Exit Time : </th><br> <td><?php echo $row['exit_time'] ; ?></td></tr>
        <tr><th>Off Day : </th> <td><?php echo $row['off_day'] ; ?></td></tr>
        <tr></tr>
        <tr></tr>
</table>
<br>


<br><br><br>
<button><a href="all_staff.php">Back to Dashboard</a></button>

<?php } ?>

<!-- Footer -->
<?php include"footer.php"; ?>




<style>
        /* Global Styles */
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

/* Button Styles */
/* button {
  background-color: #3498db;
  color: #fff;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
  margin-top: 20px;
  transition: background-color 0.3s ease;
} */
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