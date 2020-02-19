<?php 
// $phpWord = new \PhpOffice\PhpWord\PhpWord();
//
// // fungsi section dan fungsi header
// $section = $phpWord->addSection();
// $header = $section->addHeader();
//
// //format font dan paragraf
// $font= array('name' => 'Arial', 'size' => 12, 'bold'=>true);
// $paragraf= array('alignment' => 'center');
//
// //header
// $header->addImage('application\views\Garuda_Pancasila.png', array('width' => 65 , 'height' => 70, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
// $header->addText("KEMENTERIAN KOORDINATOR BIDANG PEREKONOMIAN", $font, $paragraf);
// $header->addText('REPUBLIK INDONESIA', $font, $paragraf);
// $header->addText('SEKRETARIAT', $font, $paragraf);
// $header->addText('BIRO UMUM', $font, $paragraf);
// $header->addText("Jalan Lapangan Banteng Timur No. 2-4 Jakarta Pusat 10710",null,$paragraf);
// $header->addText("Telp. (021) 3521974 - Fax. (021)3521986",null,$paragraf);
// $header->addText('Website : www.ekon.go.id',null, array('alignment' => 'center', 'borderBottomSize' => 6));
//
// //bodi
// $font= array('name' => 'Arial', 'size' => 10);
// $paragraf= array('align' => 'both');
// $section->addTextBreak();
// $section->addText("BERITA ACARA SERAH TERIMA BARANG MILIK NEGARA",array('name' => 'Arial', 'size' => 10, 'bold'=>true),array('align'=>'center'));
// $section->addText('NOMOR : $nomorbast ',array('name' => 'Arial', 'size' => 10, 'bold'=>true),array('align'=>'center'));
// $section->addTextBreak();
// $section->addText("Pada hari ini, Selasa tanggal Tiga Puluh Satu bulan Januari Tahun Dua ribu duabelas, telah dilaksanakan serah terima barang inventaris milik Kementerian Koordinator Bidang Perekonomian dari :",$font,$paragraf);
// $section->addTextBreak();
//
// //tabel
// $table = $section->addTable();
//     $table->addRow();
//         $table->addCell(500)->addText(htmlspecialchars("I.  "));
// 				$table->addCell(1000)->addText(htmlspecialchars("Nama "));
// 				$table->addCell(400)->addText(htmlspecialchars(": "));
// 				$table->addCell(7500)->addText(htmlspecialchars('$namaKabag'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(" "));
// 				$table->addCell()->addText(htmlspecialchars("NIP "));
// 				$table->addCell()->addText(htmlspecialchars(": "));
// 				$table->addCell()->addText(htmlspecialchars('$nipkabagbmn'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(" "));
// 				$table->addCell()->addText(htmlspecialchars("Jabatan "));
// 				$table->addCell()->addText(htmlspecialchars(": "));
// 				$table->addCell()->addText(htmlspecialchars('$jabatankabagbmn'));
// 		$table->addRow();
// 		$table->addCell()->addText(htmlspecialchars(''));
// 		$table->addRow();
// 		$table->addCell()->addText(htmlspecialchars('Kepada: '));
// 		$table->addRow();
//         $table->addCell()->addText(htmlspecialchars("II.  "));
// 				$table->addCell()->addText(htmlspecialchars("Nama "));
// 				$table->addCell()->addText(htmlspecialchars(": "));
// 				$table->addCell()->addText(htmlspecialchars('$namauser'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(" "));
// 				$table->addCell()->addText(htmlspecialchars("NIP "));
// 				$table->addCell()->addText(htmlspecialchars(": "));
// 				$table->addCell()->addText(htmlspecialchars('$nipuser'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(" "));
// 				$table->addCell()->addText(htmlspecialchars("Jabatan "));
// 				$table->addCell()->addText(htmlspecialchars(": "));
// 				$table->addCell()->addText(htmlspecialchars('$jabatanuser'));
//
// $section->addTextBreak();
// $section->addText("Dengan keterangan Barang Milik Negara (BMN) sebagai berikut: ");
//
// $table = $section->addTable(array('borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80));
// 		$table->addRow();
// 				$table->addCell(500)->addText(htmlspecialchars("No"),array('bold'=>true), array('align'=>'center'));
// 				$table->addCell(1800)->addText(htmlspecialchars('NUP'),array('bold'=>true), array('align'=>'center'));
// 				$table->addCell(1800)->addText(htmlspecialchars('Jenis Barang'),array('bold'=>true), array('align'=>'center'));
// 				$table->addCell(1800)->addText(htmlspecialchars('Merk/Type'),array('bold'=>true), array('align'=>'center'));
// 				$table->addCell(1800)->addText(htmlspecialchars('Ruang Penerima'),array('bold'=>true), array('align'=>'center'));
// 				$table->addCell(1800)->addText(htmlspecialchars('Pengguna'),array('bold'=>true), array('align'=>'center'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars('$No'));
// 				$table->addCell()->addText(htmlspecialchars('$NUP'));
// 				$table->addCell()->addText(htmlspecialchars('$Jenis Barang'));
// 				$table->addCell()->addText(htmlspecialchars('$Merk/Type'));
// 				$table->addCell()->addText(htmlspecialchars('$Ruang Penerima'));
// 				$table->addCell()->addText(htmlspecialchars('$Pengguna'));
// $section->addTextBreak();
//
// $table = $section->addTable();
// 		$table->addRow();
// 				$table->addCell(500)->addText(htmlspecialchars("Dengan ketentuan: "));
// 		$table->addRow();
// 				$table->addCell(500)->addText(htmlspecialchars("1. "));
// 				$table->addCell(9000)->addText(htmlspecialchars('BMN tersebut digunakan untuk kegiatan operasional $jabatanuser pada Biro Umum Kementerian Koordinator Bidang Perekonomian-RI '),null,array('align'=>'both'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars("2. "));
// 				$table->addCell()->addText(htmlspecialchars('Pengelolaan, pengaturan, pemakaian dan perawatan BMN tersebut menjadi tanggung jawab PIHAK KEDUA.'),null,array('align'=>'both'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars("3. "));
// 				$table->addCell()->addText(htmlspecialchars('Apabila BMN tersebut hilang, maka PIHAK KEDUA wajib bertanggung jawab dan mengganti sesuai dengan ketentuan Barang Milik Negara yang berlaku.'),null,array('align'=>'both'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars("4. "));
// 				$table->addCell()->addText(htmlspecialchars('Apabila PIHAK KEDUA tidak lagi bertugas/menduduki jabatan sebagai $jabatanuser pada Biro Umum Kementerian Koordinator Bidang Perekonomian-Rl, BMN tersebut wajib dikembalikan ke Biro Umum u.p. Bagian Pengelolaan BMN.'),null,array('align'=>'both'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars("Demikian Berita Acara Serah Terima ini dibuat, agar dapat dipergunakan sebagaimana mestinya. "),null,array('align'=>'both'));
// $section->addTextBreak();
//
// $table = $section->addTable();
// 		$table->addRow();
// 				$table->addCell(3000)->addText(htmlspecialchars(""));
// 				$table->addCell(3000)->addText(htmlspecialchars(""));
// 				$table->addCell(3000)->addText(htmlspecialchars('Jakarta $tgl(d-m-Y)'),null,array('align'=>'center'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars("Yang Menyerahkan: "),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(""));
// 				$table->addCell()->addText(htmlspecialchars('Yang menerima:'),null,array('align'=>'center'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars("PIHAK PERTAMA, "),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(""));
// 				$table->addCell()->addText(htmlspecialchars('PIHAK KEDUA, '),null,array('align'=>'center'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(""));
// 				$table->addCell()->addText(htmlspecialchars("Mengetahui:"),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(''));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(""));
// 				$table->addCell()->addText(htmlspecialchars("Kepala Biro Umum,"),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(''));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars('$namakabagbmn'),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(''));
// 				$table->addCell()->addText(htmlspecialchars('$namauser'),null,array('align'=>'center'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars('$nipkabagbmn'),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(''));
// 				$table->addCell()->addText(htmlspecialchars('$nipuser'),null,array('align'=>'center'));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(''));
// 				$table->addCell()->addText(htmlspecialchars('$namakaroumum'),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(''));
// 		$table->addRow();
// 				$table->addCell()->addText(htmlspecialchars(''));
// 				$table->addCell()->addText(htmlspecialchars('$nipkaroumum'),null,array('align'=>'center'));
// 				$table->addCell()->addText(htmlspecialchars(''));
//
// //footer
//
//
// // Save file
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
// $objWriter->save('C:\xampp\htdocs\temp\helloWorld.docx');
// redirect(base_url().'temp/helloWorld.docx');
?>
