<html>
<head>
  <title>Draf BAST</title>
  <style>
 #garis {
  border-collapse: collapse;
}

#garis {
  border: 1px solid black;
}
</style>
</head>
<body>
  <?php
    $bulan= array (
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'Nopember',
                    '12' => 'Desember'
                  );
    $hari= array  (
                    'Sun' => 'Minggu',
                    'Mon' => 'Senin',
                    'Tue' => 'Selasa',
                    'Wed' => 'Rabu',
                    'Thu' => 'Kamis',
                    'Fri' => 'Jumat',
                    'Sat' => 'Sabtu'
                  );

    $y= $bast->row()->tgl;
    $f = new NumberFormatter("id", NumberFormatter::SPELLOUT);
    // $f->format(date('d', strtotime($y)));
  ?>
  <div style="text-align: center">
  <strong>BERITA ACARA SERAH TERIMA BARANG MILIK NEGARA</strong><br>
  NOMOR : <?= $this->session->userdata('bast');?>
  </div>
  <div style="text-align: justify;">
    <br>Pada hari ini, <?= $hari[date('D', strtotime($y))] ?> tanggal <?= $f->format(date('d', strtotime($y))) ?> bulan <?= $bulan[date('m', strtotime($y))] ?> tahun <?= $f->format(date('Y', strtotime($y))) ?> telah dilaksanakan serah terima Barang Milik Negara (BMN) milik Kementerian Koordinator Bidang Perekonomian, dari:<br><br>
  </div>
  <div>
    <table>
      <tr>
        <td>I</td>
        <td>Nama</td>
        <td>:</td>
        <td>Rayani Marlinang</td>
      </tr>
      <tr>
        <td></td>
        <td>NIP</td>
        <td>:</td>
        <td>19630226 198310 2 001</td>
      </tr>
      <tr>
        <td></td>
        <td>Jabatan</td>
        <td>:</td>
        <td style="text-align: justify;">Kepala Bagian Pengelolaan Barang Milik Negara yang bertindak untuk dan atas nama Kementerian Koordinator Bidang Perekonomian-RI, yang selanjutnya dalam hal ini disebut sebagai PIHAK PERTAMA.</td>
      </tr>
      <tr>
        <td><br></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>Kepada</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td>II</td>
        <td>Nama</td>
        <td>:</td>
        <td><?= $user->row()->nama; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>NIP</td>
        <td>:</td>
        <td><?= $user->row()->nip; ?></td>
      </tr>
      <tr>
        <td></td>
        <td>Jabatan</td>
        <td>:</td>
        <td style="text-align: justify;"><?= $user->row()->jabatan ?> pada <?= $user->row()->unit ?> Kementerian Koordinator Bidang Perekonomian-RI; yang selanjutnya dalam hal ini disebut sebagai PIHAK KEDUA.</td>
      </tr>
    </table>
    <br>
    Dengan keterangan Barang Milik Negara (BMN) sebagai berikut:
    <table id="garis" style="width:100%">
      <tr>
        <th id="garis">NO</th>
        <th id="garis">Jenis Barang</th>
        <th id="garis">Merk/Type</th>
        <th id="garis">Tgl Perolehan</th>
        <th id="garis">NUP</th>
        <th id="garis">Kode Ruang Penerima</th>
        <th id="garis">Keterangan</th>
      </tr>
      <?php $x=1; ?>
      <?php foreach ($aset->result() as $key): ?>
      <tr>
        <td id="garis" style="text-align: center;"><?= $x++ ?></td>
        <td id="garis" style="text-align: center;"><?= $key->jenis_barang ?></td>
        <td id="garis" style="text-align: center;"><?= $key->merk_type ?></td>
        <td id="garis" style="text-align: center;"><?= $key->tgl_perolehan ?></td>
        <td id="garis" style="text-align: center;"><?= $key->nup ?></td>
        <td id="garis" style="text-align: center;"><?= $key->lokasi ?></td>
        <td id="garis" style="text-align: center;"><?= $key->pengguna ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
    <br>
    Dengan ketentuan :
    <table width="100%">
      <tr>
        <td>1. </td>
        <td style="text-align: justify;">BMN tersebut tidak boleh dipindahtangankan</td>
      </tr>
      <tr>
        <td>2. </td>
        <td style="text-align: justify;">BMN tersebut digunakan untuk kegiatan operasional <?= $user->row()->jabatan ?> pada unit <?= $user->row()->unit ?> Kementerian Koordinator Bidang Perekonomian-RI</td>
      </tr>
      <tr>
        <td>3. </td>
        <td style="text-align: justify;">Pengelolaan, pengaturan, pemakaian dan perawatan BMN tersebut menjadi tanggung jawab PIHAK KEDUA.</td>
      </tr>
      <tr>
        <td>4. </td>
        <td style="text-align: justify;">Apabila BMN tersebut hilang, maka PIHAK KEDUA wajib bertanggung jawab dan mengganti sesuai dengan ketentuan Barang Milik Negara yang berlaku.</td>
      </tr>
      <tr>
        <td>5. </td>
        <td style="text-align: justify;">Apabila PIHAK KEDUA tidak lagi bertugas/menduduki jabatan sebagai <?= $user->row()->jabatan ?> pada unit <?= $user->row()->unit ?> Kementerian Koordinator Bidang Perekonomian-RI, BMN tersebut wajib dikembalikan ke Biro Umum u.p. Bagian Pengelolaan BMN.</td>
      </tr>
    </table>
    <p style="text-align: justify;">Demikian Berita Acara Serah Terima ini dibuat, agar dapat dipergunakan sebagaimana mestinya.</p><br>
    <br>
    <br>
    <table width="100%">
      <tr>
        <td></td>
        <td></td>
        <td style="text-align: center;">Jakarta, <?= date('d', strtotime($y)).'-'.$bulan[date('m', strtotime($y))].'-'.date('Y', strtotime($y)) ?></td>
      </tr>
      <tr>
        <td style="text-align: center;">Yang Menyerahkan:</td>
        <td></td>
        <td style="text-align: center;">Yang menerima:</td>
      </tr>
      <tr>
        <td style="text-align: center;">PIHAK PERTAMA,</td>
        <td></td>
        <td style="text-align: center;">PIHAK KEDUA,</td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;">Mengetahui:</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;">Kepala Biro Umum,</td>
        <td></td>
      </tr>
      <tr>
        <td><br></td>
        <td><br></td>
        <td><br></td>
      </tr>
      <tr>
        <td style="text-align: center;">Rayani Marlinang</td>
        <td></td>
        <td style="text-align: center;"><?= $user->row()->nama; ?></td>
      </tr>
      <tr>
        <td style="text-align: center;">NIP. 19630226 198310 2 001</td>
        <td></td>
        <td style="text-align: center;">NIP. <?= $user->row()->nip; ?></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;">Hari Kristijo</td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td style="text-align: center;">NIP. 19661226 199503 1 001</td>
        <td></td>
      </tr>
    </table>
  </div>
</body>
