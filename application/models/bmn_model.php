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
  }//Batas akhir query tabel pns

// tabel aset
  function insertaset($data)
  {
    return $this->db->insert('aset', $data);
  }

  function asetbast($bast)
  {
    return $this->db->get_where('aset', array('bast' => $bast));
  }

  function asetbc($bc)
  {
    return $this->db->get_where('aset', array('barcode' => $bc));
  }

  function bastaktif($nip)
  {
    $this->db->where('nip_pic', $nip);
    return $this->db->get('aset');
  }

  function idle($barcode)
  {
    $this->db->where('barcode', $barcode);
    $this->db->where('pic', null);
    return $this->db->get('aset');
  }

  function arraydipilih($bast)
  {
    return $this->db->query("SELECT * FROM `aset` WHERE `barcode` IN (SELECT `Barcode` FROM `bast` WHERE `bast` ='$bast')");
  }

  function updateasetnull($where)
  {
    $this->db->where('barcode', $where);
    $this->db->set('lokasi', NULL);
    $this->db->set('pengguna', NULL);
    $this->db->set('pic', NULL);
    $this->db->set('nip_pic', NULL);
    $this->db->set('bast', NULL);
    $this->db->update('aset');
    return $this->db->affected_rows();
  }

  function updateaset($barcode, $pns, $bast)
  {
    $this->db->set('user', $pns);
    $this->db->set('bast', $bast);
    $this->db->where('Barcode', $barcode);
    return $this->db->update('aset');
  }

  function updateasetgedung($bc, $data)
  {
    $this->db->where('barcode', $bc);
    $this->db->update('aset', $data);
    return $this->db->affected_rows();
  }

  function updateasetjuga($barcode, $asetdata)
  {
    $this->db->where('barcode', $barcode);
    $this->db->update('aset', $asetdata);
    return $this->db->affected_rows();
  }//Batas akhir query tabel aset

// tabel bast
  function deletebast($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('bast');
  }

  function maxnobast($tahun)
  {
    return $this->db->query("SELECT MAX(no) AS 'maxno' FROM `bast` WHERE `tgl` BETWEEN '$tahun-01-01' AND '$tahun-12-31' ");
  }

  function insertbastdata($data)
  {
    $this->db->insert('bast', $data);
    return $this->db->affected_rows();
  }

  function bastbc($bc)
  {
    return $this->db->get_where('bast', array('barcode' => $bc));
  }

  function bastada($bast)
  {
    return $this->db->get_where('bast', array('bast'=> $bast));
  }

  function updatefilebast($bast, $nfile)
  {
    $this->db->where('bast', $bast);
    $this->db->set('file', $nfile);
    return $this->db->update('bast');
  }//Batas akhir query tabel bast

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
  }//Batas akhir query tabel registered

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
  }//Batas akhir query tabel verified

//tabel bap
  function fileadabap($bap)
  {
    return $this->db->query("SELECT * FROM `bap` WHERE `bap`= '$bap' ");
  }

  function iddeletebap($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('bap');
  }

  function asetbap($bap)
  {
    return $this->db->query("SELECT * FROM `aset` WHERE `barcode` IN (SELECT `barcode` FROM `bap` WHERE `bap`='$bap')");
  }

  function maxnobap($tahun)
  {
    return $this->db->query("SELECT MAX(no) AS 'maxno' FROM `bap` WHERE `tgl` BETWEEN '$tahun-01-01' AND '$tahun-12-31' ");
  }

  function insertbap($data)
  {
    $this->db->insert('bap', $data);
    return $this->db->affected_rows();
  }

  function histori($nip)
  {
    $this->db->where('nip', $nip);
    return $this->db->get('bap');
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

  function idbapada($id)
  {
    return $this->db->get_where('bap', array('id'=> $id));
  }//Batas akhir query tabel bap

// tabel admin
  function admin($nip)
  {
    $this->db->where('nip',$nip);
    return $this->db->get('admin');
  }//batas akhir query tabel admin

//tabel kodeaset
  function kodeaset($where, $nilai)
  {
    return $this->db->get_where('kodeaset', array($where => $nilai));
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

  function klaimteknisi($no, $data)
  {
    $this->db->query("UPDATE `sps` SET `teknisi` = '$data', `status` = 'Team Teknisi Sedang Menuju Lokasi' WHERE `no` = $no");
    return $this->db->affected_rows();
  }

  function updatesps($no, $data)
  {
    $this->db->where('no', $no);
    $this->db->update('sps', $data);
    return $this->db->affected_rows();
  }

  function spsperbulan($blnthn, $barcode)
  {
    return $this->db->query("SELECT 'barcode' FROM `sps` WHERE `barcode` IN (SELECT `barcode` FROM `sps`WHERE `tanggal` BETWEEN '$blnthn-01' AND '$blnthn-31') AND `barcode`=$barcode");
  }

  function re_nd($bc)
  {
    $this->db->select_max('no');
    $this->db->where('barcode', $bc);
    return $this->db->get('sps');
  }

  function spsno($no)
  {
    return $this->db->get_where('sps', array('no' => $no));
  }

  function maxnosps($tahun)
  {
    return $this->db->query("SELECT MAX(nosps) AS 'maxno' FROM `sps` WHERE `tgl_sps` BETWEEN '$tahun-01-01' AND '$tahun-12-31' ");
  }

  function teknisibelumkelar()
  {
    $this->db->where('done', null);
    return $this->db->get('sps');
    // return $this->db->query("SELECT * FROM `sps` WHERE `status` != 'selesai'  ");
  }

  function historiperbaikan()
  {
    return $this->db->query("SELECT * FROM `sps` WHERE `done` = 1 OR `done` = 0 ");
  }

  function listklaimteknisi()
  {
    return $this->db->query("SELECT * FROM `sps` WHERE `teknisi` IS NULL");
  }

  function list_sps()
  {
    $this->db->order_by('tanggal', 'DESC');
    return $this->db->get_where('sps', array('sps'=> null));
  }

  function list_sps_user($nip)
  {
    return $this->db->get_where('sps', array('done'=> null, 'nip' => $nip));
  }

  function delete_sps($no)
  {
    $this->db->where('no', $no);
    $this->db->delete('sps');
  }

  //tabel teknisi
  function readteknisi($kolom, $nilai)
  {
    return $this->db->get_where('teknisi', array($kolom => $nilai));
  }

  function loginteknisi($nama, $pass)
  {
    $this->db->where('direktur', $nama);
    $this->db->where('password', $pass);
    return $this->db->get('teknisi');
  }
}
?>
