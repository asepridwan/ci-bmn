<html>
<head>
  <title>Rekam Kode Aset</title>
  <?php include_once("basisstyiledanjs.php"); ?>
</head>
<body>

  <?php include_once("navbar-atas/awal.php"); ?>

  <div class="container"  >
    <h3>Rekam Kode Aset<h3>
    <form class="form-horizontal" method="post" action=<?php base_url()."bmn/insertaset" ?>>
      <input type="text" class="form-control" maxlength="10" name="kodeaset" placeholder="Kode Aset" required autofocus>
      <input type="text" class="form-control" name="jenis_barang" placeholder="Jenis Barang" required >
       <button type="submit" class="btn btn-default">Submit</button>
    </form>

  </div>
  <?php if (!is_null($this->session->flashdata('ok'))) {
    echo
    "<div class='alert alert-success'>
      <strong>Sukses!</strong> ". $this->session->flashdata('ok')."
    </div>";
  }
    if (!is_null($this->session->flashdata('error'))) {
      // code...
    echo
    "<div class='alert alert-warning'>
      <strong>Peringatan!</strong> ". $this->session->flashdata('error').".
    </div>";
  }
  ?>

</body>
</html>
