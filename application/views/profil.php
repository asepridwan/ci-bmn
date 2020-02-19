<html>
  <head>
    <title>PROFIL</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

    <!-- <link rel="stylesheet" href="?= base_url()."assets/css/bootstrap.css" ;?>">
    <script src="?= base_url()."assets/js/bootstrap.js" ;?>"></script>
    <script src="?= base_url()."assets/jquery-3.4.1.js" ;?>"></script>
    <script src="?= base_url()."assets/popper.js-master/packages/popper/bundle.js" ;?>"></script> -->
    <?php include_once 'basisstyiledanjs.php' ;?>

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
    .btnSubmit
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
    <?php include_once 'navbar-atas/awal.php';?>
    <div class="container">
      <div class="card" style="width: 25rem; opacity:0.5;">
        <img src="?= base_url().assets/img/Garuda_Pancasila.png ;?>" class="card-img-top" alt="No Image">
          <div class="card-body">
            <p class="card-text">
              <table>
                <tr>
                  <th colspan="3">DETAIL USER</th>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td><?php echo $biji->nama; ?></td>
                </tr>
                <tr>
                  <td>NIP</td>
                  <td>:</td>
                  <td><?php echo $biji->nip; ?></td>
                </tr>
                <tr>
                  <td>Jabatan</td>
                  <td>:</td>
                  <td><?php echo $biji->jabatan; ?></td>
                </tr>
                <tr>
                  <td>Unit</td>
                  <td>:</td>
                  <td><?php echo $biji->unit; ?></td>
                </tr>
              </table>
            </p>
          </div>
        </div>
      </div>

      <div class="container"><br>
      <Strong>List aset yang dipegang</strong> <br>
    	<table class="table table-striped">
        <thead class="thead-dark">
          <tr style='text-align:center;'>
            <th scope=col>#</th>
    				<th scope=col>BARCODE</th>
    				<th scope=col>JENIS BARANG</th>
    				<th scope=col>MERK / TYPE</th>
            <th scope=col>TANGGAL PEROLEHAN</th>
            <th scope=col>Ajukan Perbaikan</th>
    			</tr>
        </thead>
    	  <tbody>
        <?php $x=1;	foreach($aset as $row): ?>
    		  <tr style='text-align:center;'>
    			  <td><?=$x++; ?></td>
    				<td><?=$row->barcode; ?></td>
    				<td><?=$row->jenis_barang; ?></td>
    				<td><?=$row->merk_type; ?></td>
            <td><?=$row->tgl_perolehan; ?></td>
            <td><a href=<?= base_url()."bmn/nd/".$row->barcode;?>>=></a></td>
    			</tr>
        <?php endforeach;?>
    		</tbody>
    	</table>
    </div>
  </body>
</html>
