<html>
<head>
  <title>Input Barcode</title>
  <?php include_once 'basisstyiledanjs.php' ;?>

</head>
<body>
<?php include_once 'navbar-atas/awal.php';?>
<div class="container">
  <p><strong>
    User:  <?= $this->session->userdata('user'); ?><br>
    Nomor: <?= $this->session->userdata('bap'); ?><br>
  </strong></p>
  <form method="post" action="<?= base_url(); ?>bmn/checkbap">
    <div class="form-group">
      <input type="text" name="barcode" maxlength="14" class="form-control" placeholder="Barcode" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a style="float:right;" class="btn btn-primary" role="button" href="drafbap">Draf BAP</a>
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
