<?php
  require_once 'connection.php';
  $query_undian = mysqli_query($connection,"SELECT * FROM tbl_undian_2 WHERE status = '0'");

  $data = array();
  $i = 0;
  foreach ($query_undian as $row) {
    $data[$i]['id'] = $row['id'];
    $data[$i]['nama'] = $row['nama'];
    $data[$i]['nomor_telepon'] = $row['nomor_telepon'];
	$data[$i]['email'] = $row['email'];
  $data[$i]['divisi'] = $row['divisi'];
    $data[$i]['status'] = $row['status'];
    $i++;
  }

  echo json_encode($data);
?>
