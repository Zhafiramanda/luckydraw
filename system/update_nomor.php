<?php
  require_once 'connection.php';
  $id = $_POST['id'];
  $kategori = $_POST['kategori'];

  // print_r($id);
  // die;
  $ids = explode(',', $id);

  $ip = getenv('HTTP_CLIENT_IP')?:
  getenv('HTTP_X_FORWARDED_FOR')?:
  getenv('HTTP_X_FORWARDED')?:
  getenv('HTTP_FORWARDED_FOR')?:
  getenv('HTTP_FORWARDED')?:
  getenv('REMOTE_ADDR');

  for ($i=0; $i < sizeof($ids) ; $i++) {
    $query_undian = mysqli_query($connection,"UPDATE tbl_undian_2 SET status='1', kategori='".$kategori."', ip='$ip'  WHERE id='$ids[$i]'");
  }
?>
