<html>
  <head>
    <title>PROFIL</title>
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
      <div class="card" style="width: 69rem; opacity:0.5;">
        <!-- <img src="?= base_url().assets/img/Garuda_Pancasila.png ;?>" class="card-img-top" alt="No Image"> -->
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
    				<th scope=col>NUP</th>
    				<th scope=col>JENIS BARANG</th>
    				<th scope=col>MERK / TYPE</th>
            <th scope=col>TANGGAL PEROLEHAN</th>
            <th scope=col>FILE BAST</th>
            <th scope=col>Ajukan Perbaikan</th>
    			</tr>
        </thead>
    	  <tbody>
          <?php
            $x=1;
        	  foreach($aset as $row):
            $tgl= new DateTime($row->tgl_perolehan);
          ?>
    		  <tr style='text-align:center;'>
    			  <td><?=$x++; ?></td>
    				<td><?=$row->barcode; ?></td>
    				<td><?=$row->jenis_barang; ?></td>
    				<td><?=$row->merk_type; ?></td>
            <td><?=$tgl->format('d-m-Y'); ?></td>
            <td><a href="http://10.2.0.5/ci-bmn/bmn/cetakbast/<?= $row->barcode;?>" target="_blank"><?= $row->bast;?> </a></td>
            <td><a href=<?= base_url()."bmn/nd/".$row->barcode;?>>=></a></td>
    			</tr>
        <?php endforeach;?>
    		</tbody>
    	</table>
    </div>

<?php if (!empty($sps)): ?>
<div class="container"><br>
<Strong>List perbaikan aset</strong> <br>
  <table class="table table-light">
    <tr>
      <th>#</th>
      <th>NUP</th>
      <th>TANGGAL PELAPORAN</th>
      <th>PIC</th>
      <th>STATUS</th>
      <th> X </th>
    </tr>
      <?php
        $x=1;
        foreach ($sps as $key):
        $tgl2= new DateTime($key['tanggal']);
      ?>
    <tr>
      <td scope="row"><?=  $x++; ?></td>
      <td><?= $key['barcode'];?></td>
      <td><?= $tgl2->format('d-m-Y');?></td>
      <td><?= $key['pic'];?></td>



      <?php if (($key['status']=='selesai')or($key['status']=='rusak berat')): ?>
        <td><a href="<?=base_url().'bmn/blahbalhbalh/'.$key['no'];?>"> <?= $key['status']; ?> </a></td>
      <?php else: ?>
        <td><?= $key['status'];?></td>
      <?php endif; ?>



      <td><a href="<?=base_url().'bmn/delete_sps/'.$key['no'];?>"> X </a></td>
    </tr>
      <?php endforeach; ?>
      <?php else: ?>
      <hr>
      <?php endif; ?>
  </table>
  <?php if (!is_null($this->session->flashdata('error'))): ?>
  <div class="alert alert-warning">
    <strong>!. <?= $this->session->flashdata('error'); ?></strong>
  </div>
  <?php endif; ?>
  <?php if (!is_null($this->session->flashdata('ok'))): ?>
  <div class="alert alert-success">
    <strong>!. <?= $this->session->flashdata('ok'); ?></strong>
  </div>
  <?php endif; ?>
</div>

    <Strong>History aset yang pernah dipegang</strong> <br>
    <table class="table table-sm">
      <thead class="thead-light">
        <tr style='text-align:center;'>
          <th scope=col>#</th>
          <th scope=col>NUP</th>
          <th scope=col>NOMOR BAP</th>
          <th scope=col>TANGGAL PENGEMBALIAN</th>
          <th scope=col>NOMOR BAST</th>
          <th scope=col>TANGGAL SERAH TERIMA</th>
          <th scope=col>PENGGUNA</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $x=1;
        foreach($histori as $row):
        $tgl3= new DateTime($row->tgl);
        $tgl4= new DateTime($row->tgl_bast);
      ?>
        <tr style='text-align:center;'>
          <td><?=$x++; ?></td>
          <td><?=$row->barcode; ?></td>
          <td><a href="http://10.2.0.5/ci-bmn/bap/<?= $row->file;?>" target="_blank"><?= $row->bap;?> </a></td>
          <td><?=$tgl3->format('d-m-Y'); ?></td>
          <td><a href="http://10.2.0.5/ci-bmn/bast/<?= $row->file_bast;?>" target="_blank"><?= $row->bast;?> </a></td>
          <td><?=$tgl4->format('d-m-Y'); ?></td>
          <td><?=$row->pengguna; ?></td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </body>
</html>
