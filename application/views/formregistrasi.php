<html>
<head>
  <title>FORM REGISTRASI</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Assets-management">
  <meta name="author" content="Asep_Ridwan">

  <?php include_once 'basisstyiledanjs.php' ;?>

  <style>
    :root {
    --input-padding-x: 1.5rem;
    --input-padding-y: .75rem;
    }

    body {
    background: url(<?= base_url().'assets/img/bg-pattern.png';?>), #7b4397 ;
    background: url(<?= base_url().'assets/img/bg-pattern.png';?>), linear-gradient(to left, #7b4397, #dc2430);
    }
  </style>

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
.note
{
    text-align: center;
    height: 80px;
    background: -webkit-linear-gradient(left, #0072ff, #8811c5);
    color: #fff;
    font-weight: bold;
    line-height: 80px;
}
.form-content
{
    padding: 5%;
    border: 1px solid #ced4da;
    margin-bottom: 2%;
}
.form-control{
    border-radius:1.5rem;
}
.pure-button
{
    border:none;
    border-radius:1.5rem;
    padding: 1%;
    width: 20%;
    cursor: pointer;
    background: #0062cc;
    color: #fff;
}
</style>
</head>
<body>
  <form method="post" action="<?php echo base_url().'bmn/registrasi'; ?>"
<div class="container register-form">
            <div class="form">
                <div class="note">
                    <p>FORMULIR REGISTRASI ASET TERKAIT BMN.</p>
                </div>

                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email *" required  autofocus/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="pns" id="nama" class="form-control" placeholder="Nama PNS (mohon dipilih dari daftar popup)*" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="password" id="password" name="pass1" class="form-control" placeholder="Password *" required/>
                            </div>
                            <div class="form-group">
                                <input type="password" id="confirm_password" name="pass2" class="form-control" placeholder="Konfirmasi Password *" required/>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="pure-button pure-button-primary">Daftar</button>


                    <!-- <input type="submit" name="submit" value="Submit"> -->
                    <?php if(!empty($this->session->flashdata('errorRegistrasi'))){
                      echo "<p style='color:black; background:red; font-weight:bold;'>".$this->session->flashdata("errorRegistrasi")."</p>";
                    }
                    ?>
                    <?php if(!empty($this->session->flashdata('errorpassword'))){
                      echo "<p style='color:black; background:red; font-weight:bold;'>".$this->session->flashdata("errorpassword")."</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
      </form>
      </body>
      <script>
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
        if(password.value != confirm_password.value) {
          confirm_password.setCustomValidity("Passwords tidak sama");
        } else {
          confirm_password.setCustomValidity('');
        }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
      </script>
</html>
