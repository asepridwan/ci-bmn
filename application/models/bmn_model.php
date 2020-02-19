<?php
class Bmn_model extends CI_Model{
// tabel pns
  function wherepns($wherepns, $nilai){
      $this->db->where($wherepns, $nilai);
      return $this->db->get('pns');
  }
  function insertpns($data){
    return $this->db->insert('pns', $data);
  }

// tabel aset
  function insertaset($data){
    return $this->db->insert('aset', $data);
  }

// tabel bast
  function bastnotfixyet(){
    $this->db->select('bast');
    $this->db->where('fix', 0);
    $this->db->distinct();
    return $this->db->get('bast');
  }
  function maxnobast($date){
    $this->db->select_max('no');
    return $this->db->get('bast');
  }
  function bast($nip){
    $this->db->where('nip', $nip);
    return $this->db->get('bast');
  }
  function wherenobast($bast){
    $this->db->where('bast',$bast);
    return $this->db->get('bast');
  }
  function insertbast($data){
    $this->db->insert('bast', $data);
    return $this->db->affected_rows();
  }
  function cegah($barcode){
    return $this->db->query("SELECT * FROM `bast` WHERE `Barcode`='$barcode' ");
  }

  function untukbap($bast, $nip){
    $this->db->where('bast', $bast);
    $this->db->where('nip', $nip);
    return $this->db->get('bast');
  }


// tabel registered
  function registrasi($data){
    return $this->db->insert('registered', $data);
  }
  function checkemail($email){
    $this->db->where('email',$email);
    return $this->db->get('registered');
  }
  function chknipregistered($nip){
    $this->db->where('nip', $nip);
    return $this->db->get('registered');
  }

  function gantipassword($email, $pass1){
    $this->db->where('email', $email);
    $this->db->set('password', $pass1);
    return $this->db->update('registered');
  }

  function login($email, $password){
      $this->db->where('email', $email);
      $this->db->where('password', $password);
      return $this->db->get('registered');
  }

// tabel verified
  function verified($data){
    return $this->db->insert('verified', $data);
  }
  function goverified($uri){
    $this->db->where('vcode', $uri);
    return $this->db->get('verified');
  }

  function changestatusverified($vcode){
    $this->db->set('status', 1);
    $this->db->where('vcode', $vcode);
    return $this->db->update('verified');
  }
  function vcode($email){
    $this->db->where('email', $email);
    return $this->db->get('verified');
  }
  function emailvcode($vcode){
    $this->db->where('vcode', $vcode);
    return $this->db->get('verified');
  }
//sampai sini sudah rapi

//tinggal nge eliminasi function yang sama
  function dataaset(){
    return $this->db->get('aset');
  }
  function barcode($barcode){
    $this->db->where('Barcode', $barcode);
    return $this->db->get('aset');
  }
  function cekuntukupdateaset($barcode, $pns, $bast){
    $this->db->where('Barcode',$barcode);
    $this->db->where('user',$pns);
    $this->db->where('bast',$bast);
    return $this->db->get('aset');
  }
  function bcnull($barcode){
    $this->db->where('user',NULL);
    $this->db->where('bast', NULL);
    $this->db->where('Barcode',$barcode);
    return $this->db->get('aset');
  }
  function updateaset($barcode, $pns, $bast){
    $this->db->set('user', $pns);
    $this->db->set('bast', $bast);
    $this->db->where('Barcode', $barcode);
    return $this->db->update('aset');
  }
  function updateasetjuga($barcode, $asetdata){
    $this->db->where('barcode', $barcode);
    return $this->db->update('aset', $asetdata);
  }

      //query racikan
  function arraydipilih($bast){
    return $this->db->query("SELECT * FROM `aset` WHERE `barcode` IN (SELECT `Barcode` FROM `bast` WHERE `bast` ='$bast')");
    // return $this->db->query("SELECT * FROM `aset` WHERE `barcode` IN (SELECT `barcode` FROM `bast` WHERE `aktif`= '1' )");
  }

  function bastaktif($nip){
    $this->db->where('pic', $nip);
    return $this->db->get('aset');
  }

//tabel idle
  function idle($barcode){
    $this->db->where('barcode', $barcode);
    $this->db->where('pic', null);
    return $this->db->get('aset');
  }


//masih konsep
  function pkpj(){
    return $this->db->query("SELECT * FROM `aset` WHERE `Barcode` IN (SELECT `bc` FROM `pkpj` WHERE `bisa`=0 )");
  }
  function chkpkpj($bc){
    $this->db->where('bc', $bc);
    $this->db->where('bisa','1');
    return $this->db->get('pkpj');
  }
  function pkpjin($bc, $tujuan, $tgl, $nama){
    $this->db->set('bc',$bc);
    $this->db->set('nama',$nama);
    $this->db->set('tglpinjam',date('Y-m-d'));
    $this->db->set('tglkembali',$tgl);
    $this->db->set('tujuan',$tujuan);
    $this->db->set('bisa','1');
    return $this->db->insert('pkpj');
  }

  // function sekalianaset($nobapp, $user){
  //   return $this->db->query("UPDATE `aset` SET `user`= NULL,`bast`= NULL WHERE `Barcode` IN (SELECT `Barcode` FROM `ba` WHERE `bapp`='$nobapp' AND `nama`='$user')");
  // }
  // function cacahbappaset($user){
  //   return $this->db->query("SELECT * FROM `aset` WHERE `Barcode` IN (SELECT `Barcode` FROM `ba` WHERE `bapp` IS NULL AND `nama`='$user')");
  // }

  function max(){
    $this->db->select_max('nosps');
    $query= $this->db->get('sps');
    return $query->row();
  }
  function admin($nip){
    $this->db->where('nip',$nip);
    return $this->db->get('admin');
  }
  function kode_aset($jnsaset){
    $this->db->where('jenisBarang', $jnsaset);
    return $this->db->get('kodeaset');
  }
  function sekalianba($barcode, $pns, $bast, $tgl){
    $this->db->set('Barcode',$barcode);
    $this->db->set('nama',$pns);
    $this->db->set('bast',$bast);
    $this->db->set('tglBast',$tgl);
    $this->db->set('bapp','masih-dipegang-user');
    return $this->db->insert('ba');
  }
  function balikin($arrbc){
    $this->db->where_in('Barcode',$arrbc);
    $this->db->set('bapp',null);
    $this->db->update('ba');
  }
  function accsps(){
    $this->db->where('nosps', 0);
    $query= $this->db->get('sps');
    return $query->result();
  }
  function ctsps($getno, $nosps){
    $this->db->where('no', $getno);
    $this->db->set('nosps', $nosps);
    $query= $this->db->update('sps');
    return $query;
  }
  function sps($sps){
    return $this->db->insert('sps', $sps);
  }
  function updatebapp($user, $nobapp){
    $this->db->set('bapp',$nobapp);
    $this->db->where('bapp',null);
    $this->db->where('nama', $user);
    return $this->db->update('ba');
  }
  function spsperid($getno){
      $this->db->where('no', $getno);
      $query= $this->db->get('sps');
      return $query->row();
  }
  //spesial request untuk dokumen pdf bast dan bap
    // function karo(){
    //   $this->db->where('jabatan','Kepala Biro Umum');
    //   return $this->db->get('pns');
    // }
    // function kabagbmn(){
    //   $this->db->where('jabatan','Kepala Bagian Pengelolaan Barang Milik Negara');
    //   return $this->db->get('pns');
    // }
}
?>
