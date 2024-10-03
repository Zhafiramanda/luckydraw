<?php
include('system/connection.php');
require './vendor/autoload.php';
 
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx; 
use PhpOffice\PhpSpreadsheet\Reader\Xls;
 
 /* Allowed MIME(s) File */
 $file_mimes = array(
    'application/octet-stream',
    'application/vnd.ms-excel',
    'application/x-csv',
    'text/x-csv',
    'text/csv',
    'application/csv',
    'application/excel',
    'application/vnd.msexcel',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

 
if (isset($_FILES['uploadFile']['name']) && in_array($_FILES['uploadFile']['type'], $file_mimes)) {

    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
    if($drop == 1){
//   kosongkan tabel tbl_undian
      $truncate ="TRUNCATE TABLE tbl_undian_2";
      mysqli_query($connection,$truncate);
    };

    $array_file = explode('.', $_FILES['uploadFile']['name']);
    $extension  = end($array_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['uploadFile']['tmp_name']);
    $sheet_data  = $spreadsheet->getActiveSheet(0)->toArray();
    $array_data  = [];
    $cnth  = [];

    for ($i = 2; $i < count($sheet_data); $i++) {
        
            
            $nomor  = $sheet_data[$i]['0'];
            $nama_penerima      =  $sheet_data[$i]['1'];
            $email  = $sheet_data[$i]['2'];
            $divisi  = $sheet_data[$i]['3'];


            $query = "INSERT into tbl_undian_2 (nomor,nama_penerima,email,divisi)values('$nomor','$nama_penerima','$email','$divisi')";
      $hasil = mysqli_query($connection,$query);

           

} 
echo"berhasil Grandprize Townhall";
echo " <a href=index.php>Kembali ke Lucky Draw</a>";

}
?>