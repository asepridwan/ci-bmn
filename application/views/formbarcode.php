<html>
<head>
  <title>Input Barcode</title>
  <?php include_once 'basisstyiledanjs.php' ;?>

</head>
<body>
<?php include_once 'navbar-atas/awal.php';?>
<div class="container">
  <p><strong>
    <?= $this->session->userdata('user')."<br>".$this->session->userdata('bast'); ?>
  </strong></p>
  <form method="post" action="<?= base_url(); ?>bmn/insertbast">
    <div class="form-group">
      <input type="text" name="barcode" class="form-control" placeholder="Barcode" required>
    </div>
    <div class="form-group">
      <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" required>
    </div>
    <div class="form-group">
      <input type="text" name="pengguna" class="form-control" placeholder="Pengguna" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <p style="color:red;"><?= $this->session->flashdata('error');?></p>
</div>
</body>
</html>
