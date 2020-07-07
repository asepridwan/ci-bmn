<html>
<body>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">BARCODE</th>
          <th scope="col">NIP PENGGUNA</th>
          <th scope="col">NOMOR BAP</th>
          <th scope="col">TANGGAL BAP</th>
          <th scope="col">NOMOR BAST</th>
          <th scope="col">TANGGAL BAST</th>
          <th scope="col">FILE BAST</th>
          <th scope="col"> X </th>
        </tr>
      </thead>
      <tbody>
        <?php if (!is_null($data)): ?>
        <?php $x=1; ?>
        <?php foreach ($data as $key): ?>
        <tr>
          <td scope="row"><?=  $x++; ?></td>
          <td><?= $key['barcode'];?></td>
          <td><?= $key['nip'];?></td>
          <td><?= $key['bap'];?></td>
          <td><?= $key['tgl'];?></td>
          <td><?= $key['bast'];?></td>
          <td><?= $key['tgl_bast'];?></td>
          <td><a href="http://10.2.0.5/ci-bmn/bast/<?= $key['file_bast'];?>" target="_blank"><?= $key['file_bast'];?> </a></td>
          <td><a href="xbapbc/<?= $key['id'];?> "> X </a> </td>
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
