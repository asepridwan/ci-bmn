<html>
<body>
  <div class="container">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">BARCODE</th>
          <th scope="col">JENIS BARANG</th>
          <th scope="col">MERK / TYPE</th>
          <th scope="col">TANGGAL PEROLEHAN</th>
          <th scope="col"> X </th>
        </tr>
      </thead>
      <tbody>
        <?php $x=1; ?>
        <?php foreach ($aset as $key): ?>
        <tr>
          <th scope="row"><?=  $x++; ?></th>
          <td><?= $key['barcode'];?></td>
          <td><?= $key['jenis_barang'];?></td>
          <td><?= $key['merk_type'];?></td>
          <td><?= $key['tgl_perolehan'];?></td>
          <td><?= "<a href=formbarcode/".$key['barcode']."> X </a>";?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
</div>
</body>
</html>
