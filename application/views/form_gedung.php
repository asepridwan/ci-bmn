<html>
<head>
  <title>Form input lokasi</title>
  <?php include_once 'basisstyiledanjs.php' ?>

  <script type="text/javascript"> var BASE_URL = "<?php echo base_url();?>"; </script>
  <script type="text/javascript">
    $(function() {
            $( "#gedung" ).autocomplete({
            source:
            function( request, response ) {
              $.ajax({
                  url: BASE_URL+"bmn/gedung",
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

    <script type="text/javascript">
      $(function() {
              $( "#ruang" ).autocomplete({
              source:
              function( request, response ) {
                $.ajax({
                    url: BASE_URL+"bmn/ruang",
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
  <?php include_once 'navbar-atas/awal.php' ?>
  <div class="container">
    <form method="post" action="<?= base_url().'bmn/nama_gedung'; ?>">
      <div class="form-row">
        <div class="col-10">
          <input type="hidden" name="barcode" value="<?= $this->uri->segment(3); ?>">
          <input type="text" class="form-control" id="gedung" placeholder="Nama Gedung" name="gedung" required autofocus>
        </div>
        <div class="col">
          <input type="text" class="form-control" maxlength="1" placeholder="Lantai" name="lantai" required>
        </div>
      </div><br>
      <div class="form-group">
        <input type="text" class="form-control" id="ruang" placeholder="Nama Ruang" name="ruang" required>
      </div>
        <input type="submit" value="Submit" class="btn btn-primary">
    </form>
  </div>
</body>
</html>
