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
$this->load->library('tcpdf');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'Garuda_Pancasila.png';
		// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
		$this->Image($image_file, 'C', 6, '22', '', 'png', false, 'C', false, 300, 'C', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('Helvetica', 'B', 14);
		// Title
		$html1='<br><br><br><br><br>KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>REPUBLIK INDONESIA<BR>SEKRETARIAT<BR>BIRO UMUM';
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
$pdf->SetTitle('Surat Perintah Service');
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 60, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER );

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);

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
if(isset($sps)){
$txt='<br><br><br><strong>SURAT PERINTAH SERVICE</strong>
				<br>
				Nomor: SPS-'.$sps->nosps.'/SET.M.EKON.3.3/KP/'.substr($sps->tanggal,5,2).'/'.substr($sps->tanggal,0,4).'
				<br>
';
$pdf->WriteHTML($txt,true,false,false,false,'C');
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>  'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
	$pecahkan = explode('-', $tanggal);
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

	$echotgl= '	<table>
								<tr>
									<td>'.tgl_indo(date("Y-m-d")).'</td>
								</tr>
								</table>';
	$pdf->WriteHTML($echotgl,true,false,false,false,'R');
	$echopenyedia='	<table>
										<tr>
											<td width="40px">Yth. </td>
											<td width="60%">CV. Karya Perdana</td>
										</tr>
										<tr>
											<td></td>
											<td>Jl. Sunan Giri No 26/4, Pondok Pucung, Karang Tengah</td>
										</tr>
										<tr>
											<td></td>
											<td>Tanggerang</td>
										</tr>
									</table>
								';
$pdf->WriteHTML($echopenyedia,true,false,false,false,'L');

$txt= '<p style="text-indent: 40px">Dengan ini diminta bantuan saudara untuk melaksanakan pemeliharaan, perawatan dan perbaikan Barang Milik Negara yang dipergunakan oleh:</p>';
$pdf->WriteHTML($txt,true,false,false,false,'J');

if(isset($user)){
$html='<table style="margin-left:40px">
				<tr>
					<td width="20%"><p style="text-indent: 36px">Nama</p></td>
					<td width="3%"> : </td>
					<td width="77%">'.$user->nama.'</td>
				</tr>
				<tr>
					<td><p style="text-indent: 36px">Unit/Bagian</p></td>
					<td> : </td>
					<td>'.$user->unit.'</td>
				</tr>
			</table>';}
if(isset($aset)){
$html.='<p style="text-indent: 40px">
					Barang milik negara yang dimaksud, adalah sebagai berikut:
				</p>
				<table>
					<tr>
						<td width="25%"><p style="text-indent: 40px">Jenis Barang</p></td>
						<td width="3%"> : </td>
						<td width="72%">'.$aset->jenisBarang.'</td>
					</tr>
					<tr>
						<td><p style="text-indent: 40px">Nomor NUP</p></td>
						<td> : </td>
						<td>'.$aset->Barcode.'</td>
					</tr>
					<tr>
						<td><p style="text-indent: 40px">Tahun Perolehan</p></td>
						<td> : </td>
						<td>'.substr($aset->tglPerlh,-4).'</td>
					</tr>
				</table>';
			}
if(isset($sps)){
$html.='<p style="text-indent: 40px">
					Laporan keruksakan dari pengguna barang milik negara diatas adalah barang tersebut '.$sps->keruksakan.', sehingga perlu dilakukan pemeliharaan, perawatan dan perbaikan pada barang milik negara yang dipergunakan oleh pengguna barang tersebut.<br>
				</p>';
$pdf->WriteHTML($html,true,false,false,false,'J');
}
$html1='	<table align="center">
						<tr>
							<td width="65%"></td>
							<td width="35%">Kepala Bagian Pengelolaan</td>
						</tr>
						<tr>
							<td></td>
							<td>Barang Milik Negara</td>
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
							<td>Rayani Marlinang</td>
						</tr>
						<tr>
							<td></td>
							<td>NIP.19630226 198310 2 001</td>
						</tr>
					</table>';
$pdf->WriteHTML($html1,true,false,false,false,'J');
					$html2='<p style="font-size:10px"><br><br><br>
							PERHATIAN:<br>
							– Setelah surat ini ditandatangani agar segera menindaklanjutinya dalam waktu yang tidak terlalu lama. <br>
							– Dilarang merubah atau menambahkan jenis pekerjaan pada surat ini. <br>
							– Pada saat melaksanakan perbaikan harap membawa surat asli. – Diharapkan untuk mengecek ke aslian suku cadang yang diganti.<br>
							– Apabila ada keluhan/kendala mengenai perbaikan tersebut, agar menghubungi :<br>
							Bagian Pengelolaan BMN u.p. Sub Bagian Penatausahaan Aset Tetap dan Pemeliharaan<br>
							Biro Umum Sekretariat Kemenko Bidang Perekonomian-RI.<br>
							Telp. Eks. : (021) 385-2478 atau Intern. : 2303/2304
					</p>';
$pdf->WriteHTML($html2,true,false,false,false,'C');
// print a block of text using LIST BELLOW
// Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('BAST.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
