<head>
  <title>Berita Acara Pengembalian BMN</title>
</head>
<body>
<?php
  $i=1;
  echo "Permohonan Pengembalian Barang Milik Negara:<br>";
  foreach ($data as $key) {
    echo $i++." || ".$key->nama."<a href='".base_url()."bmn/bapp/".$key->nama."'> Proses =></a>"."<br>";
  }
?>
</body>
