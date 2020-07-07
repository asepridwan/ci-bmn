<html>
  <head>
  <title>BAST</title>
    <?php include_once 'basisstyiledanjs.php' ;?>
  </head>
  <body>
    <?php include_once 'navbar-atas/awal.php'; ?>

    <div class="container">
      <strong>Aset belum lama di perbaiki, apakan aset anda benar-benar rusak lagi? </strong><br>
      <a class="btn btn-outline-warning" href="<?= $barcode ?>/1">Lapor keruksakan lagi</a><br><br>
      <hr>
      Cetak ulang nota dinas permohonan perbaikan <br>
      <a class="btn btn-outline-primary" href="<?= $barcode ?>/2">Cetak ulang Nota Dinas terakhir</a>
    </div>
  </body>
</html>
