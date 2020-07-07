<html>
<head>
  <title>Halaman Teknisi</title>
</head>

<body>
<?php include_once "basisstyiledanjs.php"; ?>
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
        <th >KLAIM</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($sps)): ?>
      <?php $x=1; ?>
      <?php foreach ($sps as $key): ?>
      <tr style='text-align:center;'>
        <td scope="row"><?=  $x++; ?></td>
        <td><?= $key->barcode;?></td>
        <td><?= $key->nama;?></td>
        <td><?= $key->nip;?></td>
        <td><?= $key->lokasi;?></td>
        <td><?= $key->tanggal;?></td>
        <td><?= '<a href="'.base_url().'bmn/klaimteknisi/'.$key->no.'">'.$key->sps.'</a>'; ?></td>
      </tr>
    <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="7"><strong>Tidak ada data</strong></td>
      </tr>
    <?php endif; ?>
    </tbody>
  </table>
  <hr>
</body>
</html>
