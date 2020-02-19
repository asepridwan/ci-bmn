<html>
<head>
  <title>FORM LUPA PASSWORD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Assets-management">
  <meta name="author" content="Asep_Ridwan">

  <link rel="icon" href="<?= base_url().'favicon.ico';?>" type="Image/x-icon">
  <link rel="stylesheet" href="<?= base_url()."assets/css/bootstrap.css" ;?>">
  <link rel="stylesheet" href="<?= base_url()."assets/jquery-ui-1.12.1/jquery-ui.css" ;?>">

  <script src="<?= base_url()."assets/js/bootstrap.js" ;?>"></script>
  <script src="<?= base_url()."assets/jquery-3.4.1.js" ;?>"></script>
  <script src="<?= base_url()."assets/popper.js-master/packages/popper/bundle.js" ;?>"></script>
  <script src="<?= base_url()."assets/jquery-ui-1.12.1/jquery-ui.js" ;?>"></script>

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
  <form method="post" action="<?= base_url().'bmn/lupaPaswoord/'.$vcode; ?>"
<div class="container register-form">
            <div class="form">
                <div class="note">
                    <p>FORMULIR LUPA PASSWORD.</p>
                </div>
                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="password" id="password" name="pass1" class="form-control" placeholder="Password *" required/>
                            </div>
                            <div class="form-group">
                                <input type="password" id="confirm_password" name="pass2" class="form-control" placeholder="Konfirmasi Password *" required/>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="pure-button pure-button-primary">Ganti Password</button>
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
