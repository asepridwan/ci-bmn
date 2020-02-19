<?php
foreach ($aset as $key){
  echo $key->barcode. '||' .$key->jenis_barang. '||' .$key->merk_type. '||' .$key->tgl_perolehan.'<br>';
}
?>
<form class="cetakbast" action="<?= base_url()."bmn/cetakbast" ?>" method="post">
  <input type="hidden" name="bast" value="<?= $this->session->userdata('bast'); ?>">
</form>
