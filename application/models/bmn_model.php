<?php
class Bmn_model extends CI_Model
{
// tabel pns
  function wherepns($wherepns, $nilai)
  {
    return $this->db->get_where('pns', array($wherepns => $nilai, ));
  }
  function insertpns($data)
  {
    return $this->db->insert('pns', $data);
  }

// tabel aset
  function insertaset($data)
  {
    return $this->db->insert('aset', $data);
  }

  function updateasetnull($where)
  {
    $this->db->where('barcode', $where);
    $this->db->set('lokasi', NULL);
    $this->db->set('pengguna', NULL);
    $this->db->set('pic', NULL);
    $this->db->update('aset');
    return $this->db->affected_rows();
  }
  function deletebast($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('bast');
  }
  function asetbast($bast)
  {
    return $this->db->get_where('aset', array('bast' => $bast));
  }
  function asetbc($bc)
  {
    return $this->db->get_where('aset', array('barcode' => $bc));
  }

  function asetbap($bap)
  {
    return $this->db->query("SELECT * FROM `aset` WHERE `barcode` IN (SELECT `barcode` FROM `bap` WHERE `bap`='$bap')");
  }

// tabel bast
  function maxnobast($tahun)
  {
    return $this->db->query("SELECT MAX(no) AS 'maxno' FROM `bast` WHERE `tgl` BETWEEN '$tahun-01-01' AND '$tahun-12-31' ");
  }

  function bast($nip)
  {
    $this->db->where('nip', $nip);
    return $this->db->get('bast');
  }

  function insertbast($data)
  {
    $this->db->insert('bast', $data);
    return $this->db->affected_rows();
  }
  function bastbc($bc)
  {
    return $this->db->get_where('bast', array('barcode' => $bc));
  }
  function untukbap($bast, $nip)
  {
    $this->db->where('bast', $bast);
    $this->db->where('nip', $nip);
    return $this->db->get('bast');
  }

  function bastada($bast)
  {
    return $this->db->get_where('bast', array('bast'=> $bast));
  }

  function fileada($bast)
  {
    return $this->db->query("SELECT * FROM `bast` WHERE `bast`= '$bast' ");
  }

  function updatefilebast($bast, $nfile)
  {
    $this->db->where('bast', $bast);
    $this->db->set('file', $nfile);
    return $this->db->update('bast');
  }

// tabel registered
  function registrasi($data)
  {
    return $this->db->insert('registered', $data);
  }
  function checkemail($email)
  {
    $this->db->where('email',$email);
    return $this->db->get('registered');
  }
  function chknipregistered($nip)
  {
    $this->db->where('nip', $nip);
    return $this->db->get('registered');
  }

  function gantipassword($email, $pass1)
  {
    $this->db->where('email', $email);
    $this->db->set('password', $pass1);
    return $this->db->update('registered');
  }

  function login($email, $password)
  {
      $this->db->where('email', $email);
      $this->db->where('password', $password);
      return $this->db->get('registered');
  }

// tabel verified
  function verified($data)
  {
    return $this->db->insert('verified', $data);
  }
  function goverified($uri)
  {
    $this->db->where('vcode', $uri);
    return $this->db->get('verified');
  }

  function changestatusverified($vcode)
  {
    $this->db->set('status', 1);
    $this->db->where('vcode', $vcode);
    return $this->db->update('verified');
  }
  function vcode($email)
  {
    $this->db->where('email', $email);
    return $this->db->get('verified');
  }
  function emailvcode($vcode)
  {
    $this->db->where('vcode', $vcode);
    return $this->db->get('verified');
  }
//sampai sini sudah rapi


//tabel bap

  function maxnobap($tahun)
  {
    return $this->db->query("SELECT MAX(no) AS 'maxno' FROM `bap` WHERE `tgl` BETWEEN '$tahun-01-01' AND '$tahun-12-31' ");
  }

  function insertbap($data)
  {
    $this->db->insert('bap', $data);
    return $this->db->affected_rows();
  }
  function baparray($x, $y)
  {
    $this->db->where('nip', $x);
    $this->db->where('bap', $y);
    return $this->db->get('bap');
  }

  function bapada($bap)
  {
    return $this->db->get_where('bap', array('bap'=> $bap));
  }
  function updatefilebap($bap, $nfile)
  {
    $this->db->where('bap', $bap);
    $this->db->set('file', $nfile);
    return $this->db->update('bap');
  }

  function updatebapp($user, $nobapp)
  {
    $this->db->set('bapp',$nobapp);
    $this->db->where('bapp',null);
    $this->db->where('nama', $user);
    return $this->db->update('ba');
  }

//tinggal nge eliminasi function yang sama
  function dataaset()
  {
    return $this->db->get('aset');
  }
  function barcode($barcode)
  {
    $this->db->where('Barcode', $barcode);
    return $this->db->get('aset');
  }
  function cekuntukupdateaset($barcode, $pns, $bast)
  {
    $this->db->where('Barcode',$barcode);
    $this->db->where('user',$pns);
    $this->db->where('bast',$bast);
    return $this->db->get('aset');
  }
  function bcnull($barcode)
  {
    $this->db->where('user',NULL);
    $this->db->where('bast', NULL);
    $this->db->where('Barcode',$barcode);
    return $this->db->get('aset');
  }
  function updateaset($barcode, $pns, $bast)
  {
    $this->db->set('user', $pns);
    $this->db->set('bast', $bast);
    $this->db->where('Barcode', $barcode);
    return $this->db->update('aset');
  }
  function updateasetjuga($barcode, $asetdata)
  {
    $this->db->where('barcode', $barcode);
    return $this->db->update('aset', $asetdata);
  }

      //query racikan
  function arraydipilih($bast)
  {
    return $this->db->query("SELECT * FROM `aset` WHERE `barcode` IN (SELECT `Barcode` FROM `bast` WHERE `bast` ='$bast')");
    // return $this->db->query("SELECT * FROM `aset` WHERE `barcode` IN (SELECT `barcode` FROM `bast` WHERE `aktif`= '1' )");
  }

  function bastaktif($nip)
  {
    $this->db->where('nip_pic', $nip);
    return $this->db->get('aset');
  }

//tabel idle
  function idle($barcode)
  {
    $this->db->where('barcode', $barcode);
    $this->db->where('pic', null);
    return $this->db->get('aset');
  }


//masih konsep

  function max()
  {
    $this->db->select_max('nosps');
    $query= $this->db->get('sps');
    return $query->row();
  }
  function admin($nip)
  {
    $this->db->where('nip',$nip);
    return $this->db->get('admin');
  }
  function kode_aset($jnsaset)
  {
    $this->db->where('jenisBarang', $jnsaset);
    return $this->db->get('kodeaset');
  }

  function chkkdaset($kdaset)
  {
    return $this->db->get_where('kodeaset', array('kodeBarang'=>$kdaset));
  }
  function insertkdaset($data)
  {
    $this->db->insert('kodeaset', $data);
    return $this->db->affected_rows();
  }

//tabel sps
  function rekamsps($data)
  {
    return $this->db->insert('sps', $data);
  }

  function spsperbulan($blnthn)
  {
    return $this->db->query("SELECT `barcode` FROM `sps` WHERE `tanggal` BETWEEN '$blnthn-01' AND '$blnthn-31' ");
  }

  function ctsps($getno, $nosps)
  {
    $this->db->where('no', $getno);
    $this->db->set('nosps', $nosps);
    $query= $this->db->update('sps');
    return $query;
  }

  function spsperid($getno)
  {
      $this->db->where('no', $getno);
      $query= $this->db->get('sps');
      return $query->row();
  }
}
?>
