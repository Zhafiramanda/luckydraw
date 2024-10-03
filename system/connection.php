<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_luckydraw";

$connection = mysqli_connect($servername, $username, $password);
// mysqli_select_db($connection,$database);
$db_select = mysqli_select_db($connection, $database);
if (!$db_select) {
  die("Database selection failed: " . mysqli_connect_error());
}
