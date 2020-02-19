<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<head>
  <title>LUPA PASSWORD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="<?= base_url().'favicon.ico';?>" type="Image/x-icon">
  <link rel="stylesheet" href="<?= base_url()."assets/css/bootstrap.css" ;?>">
  <script src="<?= base_url()."assets/js/bootstrap.js" ;?>"></script>
  <script src="<?= base_url()."assets/jquery-3.4.1.js" ;?>"></script>
  <script src="<?= base_url()."assets/popper.js-master/packages/popper/bundle.js" ;?>"></script>
  <style>
      :root {
    --input-padding-x: 1.5rem;
    --input-padding-y: .75rem;
    }

    body {
    background: url(<?= base_url()."assets/img/bg-pattern.png";?>), #7b4397 ;
    background: url(<?= base_url()."assets/img/bg-pattern.png";?>), linear-gradient(to left, #7b4397, #dc2430);
    }

    .card-signin {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .card-signin .card-title {
    margin-bottom: 2rem;
    font-weight: 300;
    font-size: 1.5rem;
    }

    .card-signin .card-body {
    padding: 2rem;
    }

    .form-signin {
    width: 100%;
    }

    .form-signin .btn {
    font-size: 80%;
    border-radius: 5rem;
    letter-spacing: .1rem;
    font-weight: bold;
    padding: 1rem;
    transition: all 0.2s;
    }

    .form-label-group {
    position: relative;
    margin-bottom: 1rem;
    }

    .form-label-group input {
    height: auto;
    border-radius: 2rem;
    }

    .form-label-group>input,
    .form-label-group>label {
    padding: var(--input-padding-y) var(--input-padding-x);
    }

    .form-label-group>label {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    margin-bottom: 0;
    /* Override default `<label>` margin */
    line-height: 1.5;
    color: #495057;
    border: 1px solid transparent;
    border-radius: .25rem;
    transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
    color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
    color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
    color: transparent;
    }

    .form-label-group input::-moz-placeholder {
    color: transparent;
    }

    .form-label-group input::placeholder {
    color: transparent;
    }

    .form-label-group input:not(:placeholder-shown) {
    padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
    padding-bottom: calc(var(--input-padding-y) / 3);
    }

    .form-label-group input:not(:placeholder-shown)~label {
    padding-top: calc(var(--input-padding-y) / 3);
    padding-bottom: calc(var(--input-padding-y) / 3);
    font-size: 12px;
    color: #777;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Lupa Password</h5>
            <form class="form-signin" method="post" action="<?php echo base_url().'bmn/lupaPaswoord'; ?>">
              <div class="form-label-group">
                <input name="email" type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
                <label for="panggil">Email</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Kirim Link Rubah Password</button>
              <hr class="my-4">
            </form>
            <p style="color:red;">
              <?php if(!empty($error)){ echo $error;}?>
              <?php if(!empty($errprofil)){ echo $errprofil;}?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
