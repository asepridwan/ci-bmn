<html>
<head>
  <title>Berita Acara Pengembalian</title>
  <?php include_once "basisstyiledanjs.php"; ?>

  <script type="text/javascript"> var BASE_URL = "<?php echo base_url();?>"; </script>
  <script type="text/javascript">
    $(function() {
            $( "#nama" ).autocomplete({
            source:
            function( request, response ) {
              $.ajax({
                  url: BASE_URL+"bmn/search_username",
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
  <?php include_once "navbar-atas/awal.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Berita Acara Pengembalian<br>Barang Milik Negara</h5>
            <form class="form-signin" method="post" action="<?php echo base_url().'bmn/bap'; ?>">
              <div class="form-label-group">
                <input type="hidden" name="no" value="<?=  $noawal+1; ?>">
                  <input name="bap" value="BAPBMN-<?= ($noawal+1); ?>/SET.M.EKON.3.3/<?= date('m'); ?>/<?= date('Y'); ?>" type="text" class="form-control" required autofocus>
                <label for="email">Nomor BAST</label>
              </div>

              <div class="form-label-group">
                <input name="user" type="text" id="nama" class="form-control" placeholder="Mohon pilih dari menu popup" required
                <?php if(!is_null($this->session->userdata('user'))){
            			echo "value='".$this->session->userdata("user")."'>";
            		} ?>
                <label for="inputPassword">Nama Pengguna Barang Milik Negara</label>
              </div>

              <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
              <hr class="my-4">
              <a style="float:left;" href="uploadbap">Upload BAP</a>
              <a style="float:right;" href="drafbap">Draf BAP</a>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php if (!is_null($this->session->flashdata('error'))): ?>
    <div class="alert alert-warning">
      <strong>!. <?= $this->session->flashdata('error'); ?></strong>
    </div>
    <?php endif; ?>
  </div>


</body>
</html>
