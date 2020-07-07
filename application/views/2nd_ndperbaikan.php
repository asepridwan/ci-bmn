<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('application\libraries\TCPDF\tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Asep Ridwan');
$pdf->SetTitle('Nota Dinas Perbaikan');
$pdf->SetSubject('ND');
$pdf->SetKeywords('TCPDF, PDF, ND, BMN');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

$pdf->Image('application\views\Garuda_Pancasila.png', 0, 10, 0, 0, 'png', '', '', false, 80, 'C', false, false, 1, false, false, false);

// set some text to print

// php intl spell number
$f = new NumberFormatter("id", NumberFormatter::SPELLOUT);

//dapatkan nama hari nama bulan teks tanggal teks tahun
$bulan = array(
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
                '12' => 'Desember',
        );

$txt1='	<br><br>
        <strong>KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>
				REPUBLIK INDONESIA<br>'.mb_strtoupper($user->unit).'</strong><br>Jl. Lapangan Banteng Timur Nomor 2-4 Jakarta 10710<br>website: www.ekon.go.id';
$pdf->WriteHTML($txt1,true,false,false,false,'C');

$txt2='	<hr>';
$pdf->WriteHTML($txt2,true,false,false,false,'J');

$txt3='	<strong>NOTA DINAS</strong>
				<br>
				Nomor : BM.3.7/................................................................/'.date('m').'/'.date('Y').'
				<br>
        ';
$pdf->WriteHTML($txt3,true,false,false,false,'C');

$txt4=' <table>
          <tr>
            <td width="8%">Perihal </td>
            <td width="2%">:</td>
            <td width="90%">Permintaan perbaikan Barang Milik Negara</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>Yth. </td>
            <td></td>
            <td>Kepala Bagian Pengelolaan BMN</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Biro Umum</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>Sekretariat Kementerian Koordinator Bidang Perekonomian-RI</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td>di-</td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><p style="text-indent: 20px">Tempat</p></td>
          </tr>
				</table>';
$pdf->WriteHTML($txt4,true,false,false,false,'J');

$txt5= 'Yang bertandatangan dibawah ini, Pegawai Negeri Sipil (PNS) Pengguna Barang Milik Negara (BMN): ';
$pdf->WriteHTML($txt5,true,false,false,false,'J');

$txt6=   '<table>
						<tr>
              <td width="25%"><p style="text-indent: 30px">Nama</p></td>
              <td width="2%">:</td>
              <td width="73%">'.$user->nama.'</td>
            </tr>
            <tr>
              <td><p style="text-indent: 30px">NIP</p></td>
              <td>:</td>
              <td>'.$user->nip.'</td>
            </tr>
            <tr>
              <td><p style="text-indent: 30px">Unit Kerja </p></td>
              <td>:</td>
              <td>'.$user->unit.'</td>
            </tr>
					</table><br>
					Bersama ini melaporkan bahwa Barang Milik Negara (BMN):<br>
					<table>
						<tr>
              <td width="25%"><p style="text-indent: 30px">Jenis</p></td>
              <td width="2%">:</td>
              <td width="73%">'.$aset->jenis_barang.'</td>
            </tr>
            <tr>
              <td><p style="text-indent: 30px">NUP</p></td>
              <td>:</td>
              <td>'.$aset->nup.'</td>
            </tr>
					</table><br>
					Yang berlokasi di:<br>
					<table>
						<tr>
					  	<td width="25%"><p style="text-indent: 30px">Gedung</p></td>
					    <td width="2%">:</td>
					    <td width="73%">'.$aset->gedung.'</td>
					  </tr>
					  <tr>
					    <td><p style="text-indent: 30px">Lantai</p></td>
					    <td>:</td>
					    <td>'.$aset->lantai.' ('.ucwords($f->format($aset->lantai)).')</td>
					  </tr>
						<tr>
					    <td><p style="text-indent: 30px">Ruang</p></td>
					    <td>:</td>
					    <td>'.$aset->ruang.'</td>
					  </tr>
					</table>
          <p style="text-indent: 30px">Belum lama ini aset tersebut pernah dilakukan perbaikan/service karena mengalami keruksakan, namun aset tersebut mengalami keruksakan lagi.</p>
          <p style="text-indent: 30px">Sehubungan dengan hal tersebut diatas, kami mohon kiranya dapat dilaksanakan perbaikan/service kembali sehingga aset tersebut benar-benar dapat di pergunakan.</p>
					<p style="text-indent: 30px">Atas perhatian dan bantuan Saudara, kami ucapkan terima kasih.<br></p>';
$pdf->WriteHTML($txt6,true,false,false,false,'J');

	$txt7='	<table>
						<tr>
              <td width="58%"></td>
              <td width="2%"></td>
              <td width="40%">Jakarta, '.date('d').'-'.$bulan[date('m')].'-'.date('Y').'<br>PNS yang melaporkan</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td><br><br><br><br></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td>'.$user->nama.'<br>NIP. '.$user->nip.'</td>
            </tr>
					</table>';
$pdf->WriteHTML($txt7,true,false,false,false,'C');

//Close and output PDF document
$pdf->Output('NDpemeliharaan.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
