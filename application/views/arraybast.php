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
        </tr>
      </thead>
      <tbody>
        <?php $x=1; ?>
        <?php foreach ($aset as $key): ?>
        <tr>
          <th scope="row"><?=  $x++; ?></th>
          <td><?php echo $key['barcode'];?></td>
          <td><?php echo $key['jenis_barang'];?></td>
          <td><?php echo $key['merk_type'];?></td>
          <td><?php echo $key['tgl_perolehan'];?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
</div>
</body>
</html>
