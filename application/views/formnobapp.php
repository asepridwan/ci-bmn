<head>
  <title>Berita acara pengembalian</title>
  <?php include_once 'basisstyiledanjs.php' ;?>
</head>
<body>
  <?php include_once 'navbar-atas/awal.php';?>

  <?php
  if (($this->session->userdata('user')==true)xor($this->session->userdata('tgl')==true)) {
  echo "  <p>Permintaan pengembalian Barang Milik Negara<br>Oleh : ".$this->session->userdata('user')."<br><br>Dengan list aset sebagai berikut:<br>
          ";foreach ($variable as $key) {
            echo $key->Barcode." || ".$key->jenisBarang."<br>";
          }echo "
          <form method=post action=".base_url()."bmn/bapp>
            <label>Atur tanggal</label><br>
            <input type=date name=tgl>
            <input type=submit name=submit value=submit>
          </form></p>";
    }elseif($this->session->userdata('tgl')==true){
      echo "  <p>Permintaan pengembalian Barang Milik Negara<br>Oleh : ".$this->session->userdata('user')."<br><br>Dengan list aset sebagai berikut:<br>
              ";foreach ($variable as $key) {
                echo $key->Barcode." || ".$key->jenisBarang."<br>";
              }
      $tgl=strtotime($this->session->userdata('tgl'));
      echo "<form method=post>
            <label>Tentukan Nomor BAPP</label><br>
            <input type=text name=satu value=BAPBMN- size=8 readonly>
            <input type=text name=dua size=5 maxlength=5 placeholder=Nomor BAST required autofocus>
            <input type=text name=tiga size=25 value=/SET.M.EKON.3.3/".date('m', $tgl)."/".date('Y', $tgl)." readonly>
            <input type=submit name=submit value=submit>
            </form>";
    }else {
      $i=1;
      echo "Permohonan Pengembalian Barang Milik Negara:<br>";
      foreach ($data as $key) {
        echo $i++." || ".$key->nama."<a href='".base_url()."bmn/bapp/".$key->nama."'> Proses =></a>"."<br>";
      }
    }
  ?>
</body>
