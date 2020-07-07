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
$pdf->SetTitle('Surat Perintah Service');
$pdf->SetSubject('SPS');
$pdf->SetKeywords('TCPDF, PDF, SPS, BMN');

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

$pdf->Image('application\views\Garuda_Pancasila.png', 0, 15, 0, 0, 'png', '', '', false, 80, 'C', false, false, 1, false, false, false);

// set some text to print
//dapatkan nama hari nama bulan teks tanggal teks tahun

//konversi DateTime dari database ke Unix DateTime format
// $tgl= new DateTime($nd->tanggal);

// php intl spell number
$f = new NumberFormatter("id", NumberFormatter::SPELLOUT);
$x= strtotime($sps->tgl_sps);
$tgl= new DateTime("@$x");
//array untuk merubah nama bulan inggris ke indonesia
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

$txt1='	<br><br><br>
        <strong>KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>
				REPUBLIK INDONESIA<br>SEKRETARIAT<br>BIRO UMUM<br>BAGIAN PENGELOLAAN BMN</strong><br>Jl. Lapangan Banteng Timur Nomor 2-4 Jakarta 10710<br>website: www.ekon.go.id';
$pdf->WriteHTML($txt1,true,false,false,false,'C');

$txt2='	<hr>';
$pdf->WriteHTML($txt2,true,false,false,false,'J');

$txt3='	<strong>SURAT PERINTAH SERVICE</strong>
				<br>
				Nomor : '.$sps->sps.'
				<br>
        ';
$pdf->WriteHTML($txt3,true,false,false,false,'C');

$txt4=' <table>
          <tr>
            <td width="5%">Yth. </td>
            <td width="95%">'.$teknisi->nama.'</td>
          </tr>
          <tr>
            <td></td>
            <td>'.$teknisi->alamat.'</td>
          </tr>
          <tr>
            <td></td>
            <td>'.$teknisi->kota.'</td>
          </tr>
				</table>';
$pdf->WriteHTML($txt4,true,false,false,false,'J');

$txt5= 'Dengan ini diminta bantuan saudara untuk melaksanakan perawatan, pemeliharaan dan perbaikan Barang Milik Negara yang digunakan oleh:<br>';
$pdf->WriteHTML($txt5,true,false,false,false,'J');

$txt6=   '<table>
						<tr>
              <td width="20%"><p style="text-indent: 30px">Nama</p></td>
              <td width="2%">:</td>
              <td width="77%">'.$user->nama.'</td>
            </tr>
            <tr>
              <td><p style="text-indent: 30px">Unit/Bag</p></td>
              <td>:</td>
              <td>'.$user->unit.'</td>
            </tr>
            <tr>
              <td><p style="text-indent: 30px">Lokasi</p></td>
              <td>:</td>
              <td>'.$sps->lokasi.'</td>
            </tr>
            <tr>
              <td><p style="text-indent: 30px">Jenis Barang</p></td>
              <td>:</td>
              <td>'.$jenisbarang.'</td>
            </tr>
            <tr>
              <td><p style="text-indent: 30px">NUP</p></td>
              <td>:</td>
              <td>'.$sps->barcode.'</td>
            </tr>
					</table>
          <p>Untuk melaksanakan pekerjaan tersebut, surat perintah ini
          diserahkan kepada yang bersangkutan untuk dapat dilaksanakan sebagaimana mestinya.
          Atas perhatiannya, kami ucapkan terima kasih.</p><br>
          ';
$pdf->WriteHTML($txt6,true,false,false,false,'J');

	$txt7='	<table>
						<tr>
              <td width="58%"></td>
              <td width="2%"></td>
              <td width="40%">Jakarta, '.$tgl->format("d").'-'.$bulan[$tgl->format("m")].'-'.$tgl->format("Y").' <br> Kepala Bagian Pengelolaan <br> Barang Milik Negara</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td><br><br><br></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td>Rayani Marlinang <br> NIP. 19630226 198310 2 001 </td>
            </tr>
					</table>';
$pdf->WriteHTML($txt7,true,false,false,false,'C');

//Close and output PDF document
$pdf->Output('NDpemeliharaan.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
