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
		$image_file = K_PATH_IMAGES.'Garuda_pancasila.png';
		$this->Image($image_file, 92, 10, 22, '', 'png', '', 'C', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('Helvetica', 'B', 12);
		// Title
		$html1='<br><br><br><br>KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN<br>REPUBLIK INDONESIA<BR>SEKRETARIAT<BR>BIRO UMUM';
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
		// Page number
		$this->Cell(0, 10, 'Lembar '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 75, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(15);
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
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// set some text to print
//dapatkan nama hari nama bulan teks tanggal teks tahun


// $bast->bast;

// $bast->tgl;
$txt='	<strong>BERITA ACARA SERAH TERIMA BARANG MILIK NEGARA</strong>
				<br>
				Nomor: '.$bast->bast.'
				<br>
';
$pdf->WriteHTML($txt,true,false,false,false,'C');

$day = date('D', strtotime($tanggal));
$dayList = array(
	'Sun' => 'minggu',
	'Mon' => 'senin',
	'Tue' => 'selasa',
	'Wed' => 'rabu',
	'Thu' => 'kamis',
	'Fri' => 'jumat',
	'Sat' => 'sabtu'
);
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
$txttgl = array	(	'01' => 'satu',
									'02' => 'dua',
									'03' => 'tiga',
									'04' => 'empat',
									'05' => 'lima',
									'06' => 'enam',
									'07' => 'tujuh',
									'08' => 'delapan',
									'09' => 'sembilan',
									'10' => 'sepuluh',
									'11' => 'sebelas',
									'12' => 'dua belas',
									'13' => 'tiga belas',
									'14' => 'empat belas',
									'15' => 'lima belas',
									'16' => 'enam belas',
									'17' => 'tujuh belas',
									'18' => 'delapan belas',
									'19' => 'sembilan belas',
									'20' => 'dua puluh',
									'21' => 'dua puluh satu',
									'22' => 'dua puluh dua',
									'23' => 'dua puluh tiga',
									'24' => 'dua puluh empat',
									'25' => 'dua puluh lima',
									'26' => 'dua puluh enam',
									'27' => 'dua puluh tujuh',
									'28' => 'dua puluh delapan',
									'29' => 'dua puluh sembilan',
									'30' => 'tiga puluh',
									'31' => 'tiga puluh satu',
								);
$thn = array	(	'2019' => 'dua ribu sembilan belas',
								'2020' => 'dua ribu dua puluh',
								'2021' => 'dua ribu dua puluh satu',
								'2022' => 'dua ribu dua puluh dua',
								'2023' => 'dua ribu dua puluh tiga',
								'2024' => 'dua ribu dua puluh empat',
								'2025' => 'dua ribu dua puluh lima',
								'2026' => 'dua ribu dua puluh enam',
								'2027' => 'dua ribu dua puluh tujuh',
							);

$txt= 'Pada hari ini '.$dayList[$day].' tanggal '.$txttgl[date('d', strtotime($tanggal))].' bulan '.mb_strtolower($bulan[date('m', strtotime($tanggal))]).' tahun '.$thn[date('Y', strtotime($tanggal))].' telah dilaksanakan serah terima Barang Milik Negara (BMN) milik Kementerian Koordinator Bidang Perekonomian Republik Indonesia, dari :';
$pdf->WriteHTML($txt,true,false,false,false,'J');

	$txt= '	<table>
						<tr>
							<td width="3%">I.</td>
							<td width="10%">Nama</td>
							<td width="2%">:</td>
							<td  width="85%">'.$kabag->nama.'</td>
						</tr>
						<tr>
							<td></td>
							<td>NIP</td>
							<td>:</td>
							<td>'.$kabag->nip.'</td>
						</tr>
						<tr>
							<td></td>
							<td>Jabatan</td>
							<td>:</td>
							<td>'.$kabag->jabatan.' yang bertindak untuk dan atas nama Kementerian Koordinator Bidang Perekonomian-RI, yang selanjutnya dalam hal ini disebut sebagai PIHAK PERTAMA.</td>
						</tr>
						<tr>
							<td colspan="4">Kepada</td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>II. </td>
							<td>Nama</td>
							<td>:</td>
							<td>'.$user->nama.'</td>
						</tr>
						<tr>
							<td></td>
							<td>NIP</td>
							<td>:</td>
							<td>'.$user->nip.'</td>
						</tr>
						<tr>
							<td></td>
							<td>Jabatan</td>
							<td>:</td>
							<td>'.$user->jabatan.'  pada '.$user->unit.' Kementerian Koordinator Bidang Perekonomian-RI; yang selanjutnya dalam hal ini disebut sebagai PIHAK KEDUA.</td>
						</tr>
						<tr>
							<td colspan="4">Dengan keterangan Barang Milik Negara Sebagai Berikut : </td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</table>
	';
$pdf->WriteHTML($txt,true,false,false,false,'J');
$html='<table border="1">
					<tr>
						<th width="4%"  align="center" bgcolor="#D3D3D3">No</th>
						<th width="17%" align="center" bgcolor="#D3D3D3">NUP</th>
						<th width="17%" align="center" bgcolor="#D3D3D3">Jenis Barang</th>
						<th width="17%" align="center" bgcolor="#D3D3D3">Merk/Type</th>
						<th width="14%" align="center" bgcolor="#D3D3D3">Tgl Perolehan</th>
						<th width="14%" align="center" bgcolor="#D3D3D3">Lokasi</th>
						<th width="17%" align="center" bgcolor="#D3D3D3">Pengguna</th>
					</tr>';
					$i=1;
					foreach ($aset->result() as $key) {
						$html.='<tr>
						<td align="center">'.$i++.'</td>
						<td align="center">'.$key->barcode.'</td>
						<td align="center">'.$key->jenis_barang.'</td>
						<td align="center">'.$key->merk_type.'</td>
						<td align="center">'.$key->tgl_perolehan.'</td>
						<td align="center">'.$key->lokasi.'</td>
						<td align="center">'.$key->pengguna.'</td>
						</tr>';
					}
$html.=	'</table>';
$pdf->WriteHTML($html,true,false,false,false,'J');

$html2='	<table>
						<tr>
							<td colspan="2">Dengan ketentuan :</td>
							<td></td>
						</tr>
						<tr>
							<td width="3%">1. </td>
							<td width="97%">BMN tersebut digunakan untuk kegiatan operasional '.$user->jabatan.' pada '.$user->unit.' Kementerian Koordinator Bidang Perekonomian-RI</td>
						</tr>
						<tr>
							<td>2. </td>
							<td>Pengelolaan, pengaturan, pemakaian dan perawatan BMN tersebut menjadi tanggung jawab PIHAK KEDUA.</td>
						</tr>
						<tr>
							<td>3. </td>
							<td>Apabila BMN tersebut hilang, maka PIHAK KEDUA wajib bertanggung jawab dan mengganti sesuai dengan ketentuan Barang Milik Negara yang berlaku.</td>
						</tr>
						<tr>
							<td>4. </td>
							<td>Apabila PIHAK KEDUA tidak lagi bertugas/menduduki jabatan sebagai '.$user->jabatan.' pada '.$user->unit.' Kementerian Koordinator Bidang Perekonomian-RI, BMN tersebut wajib dikembalikan ke Biro Umum u.p. Bagian Pengelolaan BMN.</td>
						</tr>
					</table>
';
$pdf->WriteHTML($html2,true,false,false,false,'J');
$html3='<table align="center">
						<tr>
							<td></td>
							<td></td>
							<td>Jakarta, '.date('d', strtotime($tanggal)).' '.ucwords(mb_strtolower($bulan[date('m', strtotime($tanggal))])).' '.date('Y', strtotime($tanggal)).'</td>
						</tr>
						<tr>
							<td>Yang Menyerahkan : </td>
							<td></td>
							<td>Yang menerima : </td>
						</tr>
						<tr>
							<td>PIHAK PERTAMA</td>
							<td></td>
							<td>PIHAK KEDUA</td>
						</tr>
						<tr>
							<td></td>
							<td>Mengetahui : </td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>'.$karo1->jabatan.',</td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>'.$kabag->nama.'</td>
							<td></td>
							<td>'.$user->nama.'</td>
						</tr>
						<tr>
							<td>NIP. '.$kabag->nip.'</td>
							<td></td>
							<td>NIP.'.$user->nip.'</td>
						</tr>
						<tr>
							<td></td>
							<td>'.$karo1->nama.'</td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>NIP.'.$karo1->nip.'</td>
							<td></td>
						</tr>
					</table>
';
$pdf->WriteHTML($html3,true,false,false,false,'J');
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
