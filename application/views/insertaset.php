<html>
<head>
  <title>Rekam Aset</title>
  <?php include_once("basisstyiledanjs.php"); ?>

  <script type="text/javascript"> var BASE_URL = "<?php echo base_url();?>"; </script>

  <script type="text/javascript">
    $(function() {
            $( "#jb" ).autocomplete({
            source:
            function( request, response ) {
              $.ajax({
                  url: BASE_URL+"bmn/jnsaset",
                  dataType: "json",
                  data: request,
                  success: function(data){
                      if(data.response == 'true') {
                         response(data.message);
                      }
                  }
              });
          }
      });
    });
  </script>
</head>
<body>

  <?php include_once("navbar-atas/awal.php"); ?>

  <div class="container"  >
    <h3>Rekam Aset<h3>
    <form class="form-horizontal" method="post" action=<?php base_url()."bmn/insertaset" ?>>
      <input type="text" class="form-control" id="jb" name="jenis_barang" placeholder="Jenis Barang" required autofocus>
      <input type="text" class="form-control" name="merk_type" placeholder="Merk/Type" required>
      <input type="text" class="form-control" name="nup"  maxlength="4" placeholder="NUP" required>
      <input type="date" class="form-control" name="tgl_perolehan" placeholder="Tanggal Perolehan" required>
       <button type="submit" class="btn btn-default">Submit</button>
    </form>

  </div>
  <?php if (!is_null($this->session->flashdata('ok'))) {
    echo
    "<div class='alert alert-success'>
      <strong>Sukses!</strong> ". $this->session->flashdata('ok').".
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
