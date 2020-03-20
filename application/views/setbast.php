<html>
<head>
  <title>set nomor bast</title>
    <?php include_once 'basisstyiledanjs.php' ;?>
<script type="text/javascript"> var BASE_URL = "<?php echo base_url();?>"; </script>
<script type="text/javascript">
  $(function() {
          $( "#nobast" ).autocomplete({
          source:
          function( request, response ) {
            $.ajax({
                url: BASE_URL+"bmn/search_nobast",
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
<div class="container">
  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Set nomor BAST</h5>
          <form class="form-signin" method="post" action="setbast">

            <div class="form-label-group">
              <input name="nobast" type="text" id="nobast" class="form-control" placeholder="Pilih No BAST dari menu popup" required>
              <label for="inputPassword">Set Nomor BAST</label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
            <hr class="my-4">
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
