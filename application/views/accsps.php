<html>
  <head>
    <title>PROSES SPS</title>
    <?php include_once 'basisstyiledanjs.php' ;?>

  </head>
  <body>

    <?php include_once 'navbar-atas/awal.php';?>
    
<?php
if (!empty($variable)) {
  echo "<strong>LIST PENGAJUAN PERBAIKAN DARI USER </strong><br><br>";
  foreach ($variable as $key) {
    echo $key->no.' || '.$key->nosps.' || '.$key->barcode.' || '.$key->nama.' || '.$key->keruksakan.' || '.$key->tanggal.' || <a href='.base_url().'bmn/ctsps/'.$key->no.'> Proses => </a> <br>';
  }
}else {
  echo "DATA KOSONG";
}
?>
