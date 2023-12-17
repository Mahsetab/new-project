<!-- PHP Code Here ================================================== -->





<!-- Header -->
<?php include"header.php"; ?>
<!-- /== Header -->

<fieldset>
<h3>Department</h3>
<button><a href="dept_staff.php?ref=Finance">Finance</a></button>
<button><a href="dept_staff.php?ref=Register Office">Register/Office</a></button>
<button><a href="dept_staff.php?ref=IT">IT</a></button>
<button><a href="dept_staff.php?ref=Security">Security</a></button>
<button><a href="dept_staff.php?ref=Library">Library</a></button>

</fieldset>



<h3>STAFF LIST :</h3>


<table style="text-align:left">
    <tr><th>Serial</th>
        <th>Staff ID</th>
        <th>Name</th>
        <th>Number</th>
        <th>Email</th>
    </tr>
<?php
include"../conn.php";
$dept = $_GET['ref'];
$ssql = "SELECT * FROM staff where department ='$dept'"; 
$i = 0;
$rresult = mysqli_query($conn,$ssql); 
while ($row = mysqli_fetch_assoc($rresult)){ 
$i++;
?>

<tr>
    <td><?php echo $i ; ?></td>
    <td><a href="individual_data.php?ref=<?php echo $row['sl'] ; ?>"><?php echo $row['id'] ; ?></a></td>
    <td><?php echo $row['name'] ; ?></td>
    <td><?php echo $row['number'] ; ?></td>
    <td><?php echo $row['email'] ; ?></td>
</tr>
<?php } ?>
</table>


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

/* Fieldset Styles */
fieldset {
  width: 70%;
  margin: 20px auto;
  border: 2px solid #3498db;
  border-radius: 10px;
  padding: 20px;
  box-sizing: border-box;
  background-color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Button Styles */
button {
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
  margin: 5px;
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
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

th, td {
  padding: 15px;
  text-align: left;
}

th {
  background-color: #333;
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