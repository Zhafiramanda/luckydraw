<?php
  require_once 'connection.php';
  $row_count = $_POST['row_count'];
  $kategori = $_POST['kategori'];
  $query_undian = mysqli_query($connection,"UPDATE tbl_setting_2 SET row_count = '$row_count',kategori='$kategori'");

 
  header('Location: ../index.php');
?>
