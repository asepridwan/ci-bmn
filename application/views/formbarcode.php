<html>
<head>
  <title>Input Barcode</title>
  <?php include_once 'basisstyiledanjs.php' ;?>

</head>
<body>
  <?php include_once 'navbar-atas/awal.php';?>
  <!-- gak usah pake input type hiddent karena sudah pake session -->
  <form method="post" action="<?= base_url(); ?>bmn/insertbast">
    <input type="text" name="barcode" placeholder="nomor barcode aset" required autofocus><br>
    <input type="text" name="lokasi" placeholder="Lokasi " required ><br>
    <input type="text" name="pengguna" placeholder="Pengguna" required >
    <button type="submit">submit</button>
  </form>
  <?= $this->session->flashdata('error');?>
</body>
</html>
