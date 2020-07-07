<html>
<head>
  <title>Tindakan</title>
  <?php include_once'basisstyiledanjs.php'; ?>

</head>
<body>
  <?php include_once'navbar-atas/awal.php'; ?>
  <div class="container">
  <form>
  <div class="row">
    <div class="col-3">
      <input type="text" class="form-control" name="pic" readonly value="<?= $nama; ?>" >
    </div>
    <div class="col">
      <input type="text" class="form-control" name="tindakan" placeholder="Tindakan" autofocus required>
    </div>
  </div>
  <br>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="<?= base_url().'bmn/teknisi/'.$this->uri->segment(3); ?>" class="btn btn-secondary float-right">Limpahkan Ke Teknisi</a>
  </div>
</form>
</div>
</body>
</html>
