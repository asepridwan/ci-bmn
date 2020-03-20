<html>
<head>
<title>Upload Form</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php include_once("basisstyiledanjs.php"); ?>
</head>
<body>
  <br>
  <br>
  <div class="container">
  <form method="post" action="uploadbap" enctype="multipart/form-data">
  <div class="form-group">
    <h3>Upload Dokument untuk BAP dengan nomor <?= $this->session->userdata('bap'); ?></h3>
    <label>Pilih File</label>
    <input type="File" name="userfile">
  </div>
  <input type="submit" value="Upload" name="submit">
</form>
</div>
<?php echo $error;?>
</body>
</html>
