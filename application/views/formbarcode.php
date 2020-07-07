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
      <input type="text" maxlength="14" name="barcode" class="form-control" placeholder="Barcode" required autofocus>
    </div>
    <div class="form-group">
      <input type="text" name="lokasi" class="form-control" placeholder="Lokasi" required>
    </div>
    <div class="form-group">
      <input type="text" name="pengguna" class="form-control" placeholder="Pengguna" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a style="float:right;" class="btn btn-primary" role="button" href="drafbast/TRUE">Draf BAST</a>
  </form>
  <?php if (!is_null($this->session->flashdata('error'))): ?>
  <div class="alert alert-warning">
    <strong>!. <?= $this->session->flashdata('error'); ?></strong>
  </div>
  <?php endif; ?>

  <?php if (!is_null($this->session->flashdata('ok'))): ?>
  <div class="alert alert-success">
    <strong>!. <?= $this->session->flashdata('ok'); ?></strong>
  </div>
  <?php endif; ?>

</div>
</body>
</html>
