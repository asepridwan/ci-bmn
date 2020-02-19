<html>
<head>
  <title>BAST</title>
    <?php include_once 'basisstyiledanjs.php' ;?>
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
<style>
.pure-button
{
    border:none;
    border-radius:1.5rem;
    padding: 1%;
    width: 10%;
    cursor: pointer;
    background: #0062cc;
    color: #fff;
}
#error{
  color:red;
}
</style>
</head>
<body>

<?php
include_once 'navbar-atas/awal.php';
$x=$noawal+1;
$nobast= "BASTBMN-".$x."/SET.M.EKON.3.3/".$date['bln']."/".$date['thn'];
?>
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Berita Acara Serah Terima<br>Barang Milik Negara</h5>
          <form class="form-signin" method="post" action="<?php echo base_url().'bmn/bast'; ?>">
            <div class="form-label-group">
              <input type="hidden" name="no" value="<?=  $x; ?>">
              <input name="bast" value='<?= $nobast; ?>' type="text" id="bast" class="form-control" placeholder="<?=$nobast;?>" required autofocus>
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
          </form>
        </div>
      </div>
    </div>
  </div>
  <p id=error><?= $this->session->flashdata('error'); ?></p>
</div>
</body>