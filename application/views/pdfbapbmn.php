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
		$this->Image($image_file, 92, 9, 22, '', 'png', '', 'C', false, 300, '', false, false, 0, false, false, false);
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 70, PDF_MARGIN_RIGHT);
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
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// set some text to print
//dapatkan nama hari nama bulan teks tanggal teks tahun

$day=date('D',strtotime($tgl));
$dayList = array(
							'Sun' => 'minggu',
							'Mon' => 'senin',
							'Tue' => 'selasa',
							'Wed' => 'rabu',
							'Thu' => 'kamis',
							'Fri' => 'jumat',
							'Sat' => 'sabtu'
);
$blntgl=strtolower(date('m',strtotime($tgl)));
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
                '12' => 'DESEMBER'
        );
$isitxttgl=date('d',strtotime($tgl));
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
									'31' => 'tiga puluh satu'
								);
$isithn=date('Y',strtotime($tgl));
$thn = array	(	'2019' => 'dua ribu sembilan belas',
								'2020' => 'dua ribu dua puluh',
								'2021' => 'dua ribu dua puluh satu',
								'2022' => 'dua ribu dua puluh dua',
								'2023' => 'dua ribu dua puluh tiga',
								'2024' => 'dua ribu dua puluh empat',
								'2025' => 'dua ribu dua puluh lima',
								'2026' => 'dua ribu dua puluh enam',
								'2027' => 'dua ribu dua puluh tujuh'
							);
$txt2=		'<strong>BERITA ACARA PENGEMBALIAN BARANG MILIK NEGARA</strong><br>
				Nomor: '.$nobapp.'
				<br>';
$pdf->WriteHTML($txt2,true,false,false,false,'C');
$txt= 'Pada hari ini '.$dayList[$day].' tanggal '.$txttgl[$isitxttgl].' bulan '.strtolower($bulan[$blntgl]).' tahun '.$thn[$isithn].' telah dilaksanakan pengembalian Barang Milik Negara (BMN) milik Kementerian Koordinator Bidang Perekonomian Republik Indonesia, dari :';
$pdf->WriteHTML($txt,true,false,false,false,'J');

$txt1= '	<table>
					<tr>
						<td width="3%">I. </td>
						<td width="10%">Nama</td>
						<td width="2%">:</td>
						<td width="85%">'.$user->nama.'</td>
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
						<td>'.$user->jabatan.'  pada '.$user->unit.' Kementerian Koordinator Bidang Perekonomian-RI; yang selanjutnya dalam hal ini disebut sebagai PIHAK PERTAMA.</td>
					</tr>
					<tr>
						<td colspan="4">Kepada</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>II.</td>
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
						<td>Kepala Bagian Pengelolaan Barang Milik Negara yang bertindak untuk dan atas nama Kementerian Koordinator Bidang Perekonomian-RI, yang selanjutnya dalam hal ini disebut sebagai PIHAK PERTAMA.</td>
					</tr>
					<tr>
						<td colspan="4">Dengan spesifikasi Barang Milik Negara Sebagai Berikut : </td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</table>
';
$pdf->WriteHTML($txt1,true,false,false,false,'J');
// <th width="4%" align="center" bgcolor="#D3D3D3">No</th>
// <th width="35%" align="center" bgcolor="#D3D3D3">BARCODE</th>
// <th width="15%" align="center" bgcolor="#D3D3D3">JENIS BARANG</th>
// <th width="23%"  align="center" bgcolor="#D3D3D3">MERK/TYPE</th>
// <th width="8%"  align="center" bgcolor="#D3D3D3">TGL PEROLEHAN</th>
// <th width="15%"  align="center" bgcolor="#D3D3D3">KETERANGAN</th>
$html='<table border="1">
					<tr>
						<th width="4%" align="center" bgcolor="#D3D3D3">No</th>
						<th width="18%" align="center" bgcolor="#D3D3D3">BARCODE</th>
						<th width="25%" align="center" bgcolor="#D3D3D3">JENIS BARANG</th>
						<th width="23%"  align="center" bgcolor="#D3D3D3">MERK/TYPE</th>
						<th width="15%"  align="center" bgcolor="#D3D3D3">TGL PEROLEHAN</th>
						<th width="15%"  align="center" bgcolor="#D3D3D3">KETERANGAN</th>
					</tr>';
					$i=1;
	foreach ($aset->result() as $key) {
$html.=	'<tr>
						<td align="center">'.$i++.'</td>
						<td align="center">'.$key->Barcode.'</td>
						<td align="center">'.$key->jenisBarang.'</td>
						<td align="center">'.$key->merkType.'</td>
						<td align="center">'.$key->tglPerlh.'</td>
						<td align="center">'.$key->keterangan.'</td>
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
							<td width="97%">Barang Milik Negara tersebut dikembalikan dari PIHAK PERTAMA kepada PIHAK KEDUA dalam kondisi : Lengkap/Tidak Lengkap dan Baik/Rusak*.</td>
						</tr>
						<tr>
							<td>2. </td>
							<td>Pengelolaan, pengaturan, pemakaian, perawatan dan perbaikan barang inventaris tersebut selanjutnya menjadi tanggungjawab PIHAK KEDUA.</td>
						</tr>
						<tr>
							<td colspan="2">Demikian Berita Acara Pengembalian ini dibuat agar dapat dipergunakan sebagaimana mestinya.</td>
							<td></td>
						</tr>
					</table>
';
$pdf->WriteHTML($html2,true,false,false,false,'J');

$html3='	<table align="center">
						<tr>
							<td></td>
							<td></td>
							<td>Jakarta, '.date('d',strtotime($tgl)).' '.mb_strtolower($bulan[$blntgl]).' '.date('Y',strtotime($tgl)).'</td>
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
							<td>Kepala Biro Umum,</td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Rayani Marlinang</td>
							<td></td>
							<td>'.$user->nama.'</td>
						</tr>
						<tr>
							<td>NIP. 19630226 198310 2 001</td>
							<td></td>
							<td>NIP.'.$user->nip.'</td>
						</tr>
						<tr>
							<td></td>
							<td>Hari Kristijo</td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>NIP.19661226 199503 1 001</td>
							<td></td>
						</tr>
					</table>
';
$pdf->WriteHTML($html3,true,false,false,false,'J');
// // print a block of text using LIST BELLOW
// // Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
// // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
// // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
// // ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('BAST.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
