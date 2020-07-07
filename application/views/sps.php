<html>
<head>
  <title>Surat Perintah Service</title>
  <?php include_once 'basisstyiledanjs.php' ?>
  <style>
  img {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  </style>
</head>
<body>
<?php include_once "navbar-atas/awal.php"; ?>

<Strong>List permohonan perbaikan</strong> <br>
<table class="table table-striped">
  <thead class="thead-dark">
    <tr style='text-align:center;'>
      <th >#</th>
      <th >NUP</th>
      <th >NAMA USER</th>
      <th >NIP USER</th>
      <th >LOKASI</th>
      <th >TANGGAL</th>
      <th >Tindakan</th>

    </tr>
  </thead>
  <tbody>
  <?php if (!empty($list)): ?>
  <?php $x=1;	foreach($list as $row): ?>
    <tr style='text-align:center;'>
      <td><?=$x++; ?></td>
      <td><?=$row->barcode; ?></td>
      <td><?=$row->nama; ?></td>
      <td><?=$row->nip; ?></td>
      <td><?=$row->lokasi; ?></td>
      <td><?=$row->tanggal; ?></td>
      <td><a href="<?= base_url().'bmn/tindakansps/'.$row->no; ?>"> => </a></td>
    </tr>
  <?php endforeach;?>
<?php else: ?>
  <tr>
    <td colspan="7"><strong>Tidak ada data</strong></td>
  </tr>
<?php endif; ?>
  </tbody>
</table>
<br>
<hr>

<!-- tabel teknisi -->
<Strong>List perbaikan oleh teknisi</strong> <br>
<table class="table table-light">
  <thead>
    <tr style='text-align:center;'>
      <th>#</th>
      <th>NUP</th>
      <th >NAMA USER</th>
      <th >NIP USER</th>
      <th >LOKASI</th>
      <th >TANGGAL</th>
      <th >TEKNISI</th>
      <th >STATUS</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($teknisi)): ?>
    <?php $x=1; ?>
    <?php foreach ($teknisi as $key): ?>
    <tr style='text-align:center;'>
      <td scope="row"><?=  $x++; ?></td>
      <td><?= $key->barcode;?></td>
      <td><?= $key->nama;?></td>
      <td><?= $key->nip;?></td>
      <td><?= $key->lokasi;?></td>
      <td><?= $key->tanggal;?></td>
      <td><?= '<a href="'.base_url().'bmn/cetaksps/'.$key->no.'" target= _blank>'.$key->teknisi.'</a>'; ?></td>
      <td><?= $key->status;?></td>
    </tr>
  <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td colspan="7"><strong>Tidak ada data</strong></td>
    </tr>
  <?php endif; ?>
  </tbody>
</table>
<br>
<hr>

<!-- tabel teknisi -->
<Strong>Histori perbaikan</strong> <br>
  <table class="table table-bordered">
    <thead>
      <tr style='text-align:center;'>
        <th>#</th>
        <th>NUP</th>
        <th >NAMA USER</th>
        <th >SPS</th>
        <th >LOKASI</th>
        <th >TANGGAL</th>
        <th >PIC</th>
        <th >TEKNISI</th>
        <th >STATUS</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($histori)): ?>
      <?php $x=1; ?>
      <?php foreach ($histori as $key): ?>
      <tr style='text-align:center;'>
        <td scope="row"><?=  $x++; ?></td>
        <td><?= $key->barcode;?></td>
        <td><?= $key->nama;?></td>
        <td><?= $key->sps;?></td>
        <td><?= $key->lokasi;?></td>
        <td><?= $key->tanggal;?></td>
        <td><?= $key->pic;?></td>
        <td><?= $key->teknisi;?></td>
        <td><?= $key->status;?></td>
      </tr>
    <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="9"><strong>Tidak ada data</strong></td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>


</body>
</html>
