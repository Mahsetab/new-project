<?php

session_start();
setcookie("user", "", time() + 36000);
setcookie("pass", "", time() + 36000);
session_destroy();

header('location:../index.php');




?>