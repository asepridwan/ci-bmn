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
$this->load->library('Pdf');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'Garuda_Pancasila.png';
		$this->Image($image_file, 98, 12, 22, '', 'png', '', 'C', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('Helvetica', 'B', 14);
		// Title
		$html1='<br><br><br><br><br><br>KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>REPUBLIK INDONESIA';
		$this->writeHTML($html1, true, false, false, false, 'C');
		$this->SetFont('Helvetica', '', 10);
		$html2='Jl. Lapangan Banteng Timur Nomor 2-4 Jakarta 10710 Telp.(021)3521974 Fax.(021)3521985<br>website: www.ekon.go.id';
		$this->writeHTML($html2, true, false, false, false, 'C');
		$html3='<hr>';
		$this->writeHTML($html3, true, false, false, false, 'C');
		// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		// $this->Cell(0, 10, 'Lembar ke '.$this->getAliasNumPage().' dari '.$this->getAliasNbPages().' lembar', 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Asep Ridwan');
$pdf->SetTitle('Berita Acara');
$pdf->SetSubject('BAST');
$pdf->SetKeywords('TCPDF, PDF, BAST, BAPP, BMN');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(25, 60, 15);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// set some text to print
//dapatkan nama hari nama bulan teks tanggal teks tahun
$bulan = array(
                '01' => 'JANUARI',
                '02' => 'FEBRUARI',
                '03' => 'MARET',
                '04' => 'APRIL',
                '05' => 'MEI',
                '06' => 'JUNI',
                '07' => 'JULI',
                '08' => 'AGUSTUS',
                '09' => 'SEPTEMBER',
                '10' => 'OKTOBER',
                '11' => 'NOVEMBER',
                '12' => 'DESEMBER',
        );

// if(isset($bast)){
// $id= $bast->bast;
// $tgl= $bast->tgl;
// $userbast= $bast->user;
// }
$txt='	<br>
        <strong>NOTA DINAS</strong>
				<br>
        <br>
				Nomor : ND-................................................................/2019
				<br>
        ';
$pdf->WriteHTML($txt,true,false,false,false,'C');

$txtL=' <table>
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
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="3"><p style="text-indent: 30px">Yang bertandatangan dibawah ini, Pegawai Negeri Sipil (PNS) Pengguna Barang Milik Negara (BMN): </p></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          </table>
          <table>';
if(isset($user)){
$txtL.=     '<tr>
              <td width="13%">Nama</td>
              <td width="3%">:</td>
              <td width="84%">'.$user->nama.'</td>
            </tr>
            <tr>
              <td>NIP</td>
              <td>:</td>
              <td>'.$user->nip.'</td>
            </tr>
            <tr>
              <td>Unit Kerja </td>
              <td>:</td>
              <td>'.$user->unit.'</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>';}
if(isset($aset)){
$txtL.=     '<tr>
              <td colspan="3"><p style="text-indent: 30px">Bersama ini melaporkan bahwa BMN jenis '.$aset->jenisBarang.' Merk '.$aset->merkType.' dengan nomor NUP '.$aset->Barcode.' perlu dilakukan perbaikan/service, karena '.$keruksakan.'.</p></td>
              <td></td>
              <td></td>
            </tr>';}
$txtL.=    '<tr>
              <td colspan="3"><p style="text-indent: 30px">Sehubungan dengan hal tersebut, kami mohon kiranya dapat dilaksanakan perbaikan/service dalam waktu yang tidak terlalu lama.</p></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="3"><p style="text-indent: 30px">Atas perhatian dan bantuannya, kami ucapkan terima kasih.</p></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </table>
          <table>
            <tr>
              <td width="70%">Catatan Kabag BMN:</td>
              <td>Jakarta, '.date('d').' '.mb_strtolower($bulan[date('m')]).' '.date('Y').'</td>
            </tr>
            <tr>
              <td></td>
              <td>PNS yang melaporkan</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>';
if(isset($user)){
$txtL.=      '<td>'.$user->nama.'</td>
            </tr>
            <tr>
              <td></td>
              <td>'.$user->nip.'</td>
            </tr>
          </table>';}
$pdf->WriteHTML($txtL,true,false,false,false,'J');

//Close and output PDF document
$pdf->Output('NDpemeliharaan.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
