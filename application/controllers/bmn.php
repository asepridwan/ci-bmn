<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bmn extends CI_Controller {
	function __construct(){
			parent:: __construct();
			$this->load->model('Bmn_model');
		}

	function index(){
		if(!is_null($this->session->userdata('email'))){
			redirect(base_url().'bmn/profil');
		}
		$err['errprofil']=$this->session->flashdata('error');
		$err['error']= $this->session->flashdata('item');
		$this->load->view('login',$err);
	}

	function proseslogin(){
		$email= $this->input->post('email');
		$password= $this->input->post('password');
		$login= $this->Bmn_model->login($email, $password)->row();

		$nip=$login->nip;
		$admintest= $this->Bmn_model->admin($nip)->num_rows();

		if((!empty($login))xor($admintest>0)){
			$sesi = array (	'email'	=> $login->email,
											'nip'		=> $login->nip
										);
			$this->session->set_userdata($sesi);
			redirect(base_url().'bmn/profil');

		}elseif ((!empty($login))&&($admintest==1)) {
			$sesi = array (	'email'	=> $login->email,
											'nip'		=> $login->nip,
											'admin'		=>1
										);
			$this->session->set_userdata($sesi);
			redirect(base_url().'bmn/profil');
		}else{
			$this->session->set_flashdata('item','Login gagal, check kembali isian anda.');
			redirect(base_url());
		}
	}

	function profil(){
		$nip= $this->session->userdata('nip');
			if(!is_null($this->session->userdata('nip'))){
				$data['biji']=$this->Bmn_model->wherepns('nip', $nip)->row();
				$data['aset']= $this->Bmn_model->bastaktif($nip)->result();
				$this->load->view('profil', $data);
			}else {
				$this->session->set_flashdata('error','Silahkan Login terlebih dahulu');
				redirect(base_url());
			}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function registrasi(){
		$email 	= $this->input->post('email');
		$password	= $this->input->post('pass1');
		$nama			= $this->input->post('pns');
		$wherepns='nama';
		$nilai=$nama;
//check isian form jika kosong
		if(empty($this->input->post(null))){
			$this->load->view('formregistrasi');
		}

//check email, apakah sudah ada?
		elseif($this->Bmn_model->checkemail($email)->num_rows()>0){
			$var_error_email= "Mohon maaf, E-mail yang digunakan sudah terdaftar di sistem. silahkan klik  <a href=".base_url()."/bmn/lupapassword>Lupa Password</a> untuk merubah password anda";
			$this->session->set_flashdata("errorRegistrasi",$var_error_email);
			redirect(base_url()."bmn/registrasi");
		}

//konversi dari nama ke nip
		elseif ($this->Bmn_model->wherepns($wherepns, $nilai)->num_rows()>0) {
			//nama terdaftar di databse dan nip tersedia
			$nip= $this->Bmn_model->wherepns($wherepns, $nilai)->row()->nip;

			//chk nip sudah ada di tabel registered
			if($this->Bmn_model->chknipregistered($nip)->num_rows()>0) {
				$var_error_nama= "Mohon maaf, Nama tersebut sudah terdaftar di sistem. silahkan klik  <a href=".base_url()."/bmn/rubahemail>Rubah Email</a> untuk merubah email anda";
				$this->session->set_flashdata("errorRegistrasi",$var_error_nama);
				redirect(base_url()."bmn/registrasi");
			}else {
				// kode memasukan data ke database bmn  table registered
				$data= array(
											'id'	=> null,
											'email' => $email,
        							'nip' => $nip,
        							'password' => $password,
											'tanggal'=> date('Y-m-d'));
				if($this->Bmn_model->registrasi($data)==true){
					//configurasi string supple untuk kode verifikasi
					$karakter= 'abcdefghijklmnopqrstuvwxyz0123456789';
					$vcode= date('Ymd').str_shuffle($karakter);

					//simpan data verifikasi
						$data= array 	(	'id'=>null,
														'email'=>$email,
														'vcode'=>$vcode,
														'status'=>0
													);
						if($this->Bmn_model->verified($data)==false){
							echo "terjadi kesalahan pada proses verifikasi";
						}else {
							//jika data berhasil masuk ke database lanjut konfirmasi email
							$config= array(
								'protocol' => 'smtp',
								'smtp_host'=> 'ssl://smtp.googlemail.com',
								'smtp_port'=> 465,
								'smtp_user'=> 'bmnkemenkoperekonomian@gmail.com',
								'smtp_pass'=> 'gratisaja',
								'mailtype' => 'html',
								'charset' => 'iso-8859-1'
								);
							$this->load->library('email', $config);
							$this->email->set_newline("\r\n");
							$this->email->from('bmnkemenkoperekonomian@gmail.com', 'Bagian Pengelolaan BMN');
							$this->email->to($email);
							$this->email->subject('Verifikasi Email');
							$this->email->message('silahkan verifikasi email anda dengan mengklik tautan berikut.<br>'.base_url().'bmn/verifikasi/'.$vcode);
							// check jika ada sesuatu yang error dengan pengiriman email
								if(!$this->email->send()){
									echo $this->email->print_debugger();
								}else{
									// minta tolong buat script kirim ulang email verifikasi
									echo "Kami telah mengirim Email verifikasi, check email anda dan lakukan verifikasi <a href=".base_url()."> Kembali ke Halaman Depan </a> ";
								}
							}
				}
			}

//ini else dari koversi nama ke nip
		}else {
			$var_error_dbpns= "Nama tidak terdaftar di databse, silahkan hubungi bagian SDM/Kepegawaian";
			$this->session->set_flashdata("errorRegistrasi",$var_error_dbpns);
			redirect(base_url()."bmn/registrasi");
		}
//akhir braket registrasi
	}

	function verifikasi(){
		$uri= $this->uri->segment(3);
		$vcode= $this->uri->segment(3);
		if($this->Bmn_model->goverified($uri)->num_rows()>0){
			if($this->Bmn_model->changestatusverified($vcode)==true){
				echo "email sudah di verifikasi, terima kasih";
			}
		}
	}

//lupa password
	function lupaPaswoord(){
		if(!is_null($this->input->post('email'))){
			$email= $this->input->post('email');
			//check email di database bmn tabel registered
			if($this->Bmn_model->checkemail($email)->num_rows()>0){
				//get vcode
				$vcode= $this->Bmn_model->vcode($email)->row()->vcode;
				$link= base_url()."bmn/lupaPaswoord/".$vcode;
				$config= array(
					'protocol' => 'smtp',
					'smtp_host'=> 'ssl://smtp.googlemail.com',
					'smtp_port'=> 465,
					'smtp_user'=> 'bmnkemenkoperekonomian@gmail.com',
					'smtp_pass'=> 'gratisaja',
					'mailtype' => 'html',
					'charset' => 'iso-8859-1'
					);
				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('bmnkemenkoperekonomian@gmail.com', 'Bagian Pengelolaan BMN');
				$this->email->to($email);
				$this->email->subject('Lupa Password');
				$this->email->message('silahkan klik tautan berikut untuk merubah password.<br>'.$link);
				// check jika ada sesuatu yang error dengan pengiriman email
					if(!$this->email->send()){
						echo $this->email->print_debugger();
					}else{
						// minta tolong buat script kirim ulang email verifikasi
						echo "Kami telah mengirim Email link rubah password, silahkan cek email anda <a href=".base_url()."> Kembali ke Halaman Depan </a> ";
					}
			}else {
				echo "email belum terdaftar silahkan daftar di <a href=".base_url()."/bmn/registrasi> Registrasi </a>";
			}
		}
		elseif ($this->uri->segment(3)==true) {
			if(!is_null($this->input->post('pass1'))){
				$vcode= $this->uri->segment(3);
				$pass1= $this->input->post('pass1');
				$email= $this->Bmn_model->emailvcode($vcode)->row()->email;
				if($this->Bmn_model->gantipassword($email, $pass1)==true){
					echo "Password berhasil di rubah <a href=".base_url()."> LOGIN </a>";
				}
			}else {
				$data['vcode']= $this->uri->segment(3);
				$this->load->view('formlupapassword.php', $data);
			}
		}else {
			$this->load->view('lupaPaswoord.php');
		}
	}
// sampai sini udah rapi

// fungsi isian untuk tabel Aset
	function insertaset(){
		//authorized user only
		if ($this->session->userdata('admin')!=1) {
			echo "Mohon maaf, sistem hanya melayani pengguna terdaftar.!";
			echo "<a href=".base_url()."> Login =>></a>";
			exit();
		}

		if($this->input->post()==NULL){
			$this->load->view('insertaset');
		}else {
			$post= $this->input->post();

			//cek kode aset apakah ada di database
			$cekkodeaset= $this->Bmn_model->kode_aset($post['jenis_barang']);
			if($cekkodeaset->num_rows()>0){
				//buat barcode dari kode aset dan nup
				$kodebarang= $cekkodeaset->row()->kodeBarang;
				$nup= str_pad( $post['nup'], 4, "0", STR_PAD_LEFT );
				$barcode=$kodebarang.$nup;

				//check jika aset sudah ada di database
				$checkaset= $this->Bmn_model->barcode($barcode);
				if($checkaset->num_rows()>0){
					$this->session->set_flashdata('error', "aset sudah ada di database");
					redirect(base_url()."bmn/insertaset");
				}else {
					//lanjut ke proses memasukan data
					$data= array 	(
						'barcode'				=>$barcode,
						'jenis_barang'	=>$post['jenis_barang'],
						'merk_type'			=>$post['merk_type'],
						'nup'						=>$post['nup'],
						'tgl_perolehan'	=>$post['tgl_perolehan']
					);
					//reporting
					$query= $this->Bmn_model->insertaset($data);
					if($query==true){
						$this->session->set_flashdata('ok', "data berhasil di entri");
						redirect(base_url()."bmn/insertaset");
					}else {
						$this->session->set_flashdata('error', "data gagal di entri");
						redirect(base_url()."bmn/insertaset");
					}
				}
			}else {
				$this->session->set_flashdata('error', "kode aset tidak ada di database silahkan input terlebih dahulu <a href='".base_url()."/bmn/rekamkodeaset'>Rekam Kode Aset </a>");
				redirect(base_url()."bmn/insertaset");
			}
		}
	}

	//merekam kode aset yang belum terekam
	function createkodeaset(){
		//authorized user only
		if ($this->session->userdata('admin')!=1) {
			echo "Mohon maaf, sistem hanya melayani pengguna terdaftar.!";
			echo "<a href=".base_url()."> Login =>></a>";
			exit();
		}

		//tampilkan form isian kode aset jika belum di isi
		if($this->input->post()==NULL){
			$this->load->view('formkodeaset');
		}else {
			$post= $this->input->post();
			$w= strlen($post['kodeaset']);
			if($this->Bmn_model->chkkdaset($post['kodeaset'])->num_rows()>0){
				$this->session->set_flashdata('error', "Kode aset sudah terekam...!");
				redirect(base_url()."bmn/createkodeaset");
			}else {
				//cegah jika panjang data kode aset kurang dari sepuluh
				// lagi di lab
				$w= strlen($post['kodeaset']);
				if($w==10){
					//lanjutkan insert data kode aset
					$data= array('kodeBarang'=>$post['kodeaset'],'jenisBarang'=>$post['jenis_barang']);
					$query121= $this->Bmn_model->insertkdaset($data);
					if($query121 > 0){
						$this->session->set_flashdata('ok', "Data berhasil di rekam...");
						redirect(base_url()."bmn/createkodeaset");
					}else {
						$this->session->set_flashdata('error', "Data gagal di input, silahkan hubungi administrator");
						redirect(base_url()."bmn/createkodeaset");
					}
				}else {
					$this->session->set_flashdata('error', "Panjang data Kode Aset Harus 10 Digit! ");
					redirect(base_url()."bmn/createkodeaset");
				}
			}
		}

	}

//ini bener bener yang menjadi judul projek ini

	function bast(){
		if ($this->session->userdata('admin')!=1) {
			echo "Mohon maaf, sistem hanya melayani pengguna terdaftar.!";
			echo "<a href=".base_url()."> Login =>></a>";
			exit();
		}
		$tahun=date('Y');
		$data['noawal']= $this->Bmn_model->maxnobast($tahun)->row()->maxno;

		if(is_null($this->input->post('bast'))){
			$this->load->view('bast', $data);
		}else {
			$wherepns='nama';
			$nilai=$this->input->post('user');
			$nip= ($this->Bmn_model->wherepns($wherepns, $nilai)->row()->nip);
			//bikin cegahan bast yang sudah ada
			$bast=$this->input->post('bast');

			if ($this->Bmn_model->bastada($bast)->num_rows()>0) {
				$this->session->set_flashdata('error', 'Nomor BAST ini sudah digunakan, silahkan gunakan nomor BAST yang lain. ');
				redirect(base_url().'bmn/bast');
			}else {
				//bikin cegahan user ! pns
				if ($this->Bmn_model->wherepns($wherepns, $nilai)->num_rows()>0) {
					$data= array(	'no'=> $this->input->post('no'),
												'bast'=> $this->input->post('bast'),
												'user'=> $this->input->post('user'),
												'nip_user'=> $nip
											);
					$this->session->set_userdata($data);
					redirect(base_url().'bmn/formbarcode');
				}else {
					$this->session->set_flashdata('error', 'Nama '.$nilai.' tidak terdaftar di database');
					redirect(base_url().'bmn/bast');
				}
			}
		}
		$this->session->set_userdata('tgl', date('Y-m-d'));
	}

	function formbarcode(){
		$this->load->view('formbarcode');
		$bast= $this->session->userdata('bast');
		$data['aset']= $this->Bmn_model->arraydipilih($bast)->result_array();
		$this->load->view('arraybast', $data);
	}

	function insertbast(){
		//check barcode di aset apakah ada jika ada lanjut masukan datanya
		$barcode= $this->input->post('barcode');
		$lokasi= $this->input->post('lokasi');
		$pengguna= $this->input->post('pengguna');
		//check barcode di daftar aset
		if($this->Bmn_model->barcode($barcode)->num_rows()>0){
			//ok barcode ada di aset lanjut check di idle
			if($this->Bmn_model->idle($barcode)->num_rows()>0){
				//di idle ada lanjut ke
				$adata= array (	'id'			=>null,
												'barcode'	=>$barcode,
												'nama'		=>$this->session->userdata('user'),
												'nip'			=>$this->session->userdata('nip_user'),
												'no'			=>$this->session->userdata('no'),
												'bast'		=>$this->session->userdata('bast'),
												'tgl'			=>$this->session->userdata('tgl')
											);
				if($this->Bmn_model->insertbast($adata)>0){
					$asetdata = array (	'lokasi' 		=> $lokasi,
															'pengguna' 	=> $pengguna,
															'pic'				=> $this->session->userdata('user'),
															'nip_pic'		=> $this->session->userdata('nip_user'),
															'bast'			=> $this->session->userdata('bast')
														);
					$this->Bmn_model->updateasetjuga($barcode, $asetdata);
					$this->session->set_flashdata('true', 'OK');
					redirect(base_url().'bmn/formbarcode');
				}else {
					$this->session->set_flashdata('error', 'Gagal insert bast ke database');
					redirect(base_url().'bmn/formbarcode');
				}
			}else {
				//di idle tidak ada berarti aset lagi di pake sama orang (cegah)
				$msg= $this->Bmn_model->bastbc($barcode)->row();
				$nip=$msg->nip;
				$wherepns='nip';
				$nilai=$nip;
				$nama= $this->Bmn_model->wherepns($wherepns, $nilai)->row();
				$this->session->set_flashdata('error','Aset masih digunakan oleh '.$nama->nama.' dengan nomor BAST '.$msg->bast.'<br>');
				redirect(base_url().'bmn/formbarcode');
			}
		}else {
			$this->session->set_flashdata('error', 'Tidak ada aset dengan barcode '.$barcode);
			redirect(base_url().'bmn/formbarcode');
		}
	}

	function drafbast()
	{
		if (is_null($this->session->userdata('bast')))
		{
			echo "Silahkan set dulu BAST nya...<a href='setbast'>Set BAST</a>";
		}
		else
		{
			$x=$this->session->userdata('bast');
			$y=$this->Bmn_model->bastada($x)->row()->file;
			if (is_null($y)) {
				$x= $this->session->userdata('bast');
				$data['bast']= $this->Bmn_model->bastada($x);
				$data['aset']= $this->Bmn_model->asetbast($x);
				$data['user']= $this->Bmn_model->wherepns('nip', $this->session->userdata('nip_user'));
				$this->load->view('drafbast', $data);
			}
			else
			{
				echo "file sudah terupload. !";
			}
		}
	}


//projeksi berita acara pengembalian sebagai counter dari beria acara serah terima dan sekalian sebagai history aset
	function bap()
	{
		$tahun= date('Y');
		$data['noawal']= $this->Bmn_model->maxnobap($tahun)->row()->maxno;
		if ($this->input->post()==NULL)
		{
			$this->load->view('bap', $data);
		}
		else
		{
			$x= $this->input->post('user');
			$y= $this->Bmn_model->wherepns('nama',$x)->row()->nip;
			$z= $this->input->post('bap');
			//check di tabel bap nomor ini ada gak kalau ada return nomor udah ada
			$a= $this->Bmn_model->bapada($z)->num_rows();
			if ($a > 0)
			{
				$this->session->set_flashdata('error','Nomor BAP sudah digunakan, silahkan gunakan nomor lain.!');
				redirect(base_url()."bmn/bap");
			}
			else
			{
				$this->session->set_userdata(array(
																						'bap'					=>$this->input->post('bap'),
																						'no'					=>$this->input->post('no'),
																						'user'				=>$this->input->post('user'),
																						'nip_user'		=>$y
																						));
				redirect (base_url().'bmn/bapbc');
			}
		}
	}
	//tindak lanjut dari isian form nomor bap
	function bapbc()
	{
		if (!is_null($this->session->userdata('bap')))
		{
			$this->load->view('formbapbc');
			$x= $this->session->userdata('nip_user');
			$y= $this->session->userdata('bap');
			$data= $this->Bmn_model->baparray($x, $y);
			if ($data->num_rows() > 0)
			{
				$z['data']= $data->result_array();
				$this->load->view('arraybap', $z);
			}
			else
			{
				$z= array(
										'barcode'		=> null,
										'nip'				=> null,
										'bap'				=> null,
										'tgl'				=> null,
										'bast'			=> null,
										'tgl_bast'	=> null,
										'file_bast'	=> null);
				$this->load->view('arraybap', $z);
			}
		}
		else
		{
			if($this->session->userdata('bap'))
			{
				redirect(base_url().'bmn/bap');
			}
			else
			{
				echo "Mohon maaf, sistem hanya melayani pengguna terdaftar.!";
				echo "<a href=".base_url()."> Login =>></a>";
				exit();
			}
		}
	}
	//panggil fungsi lain dengan segala kondisi
	function checkbap(){
		$this->bacasesi();
		$x= $this->input->post('barcode');
		$b= $this->session->userdata('nip_user');
		$y= $this->Bmn_model->bastbc($x)->row()->nip;
		if ($b==$y) {
			//insert BAP
			//lanjutkan coding insert bap ke database
			$a= $this->Bmn_model->bastbc($x)->row();
			if (is_null($a->file)) {
				$this->session->set_flashdata('error',"BAST belum di upload ke server!");
				redirect(base_url()."/bmn/bapbc");
				exit();
			}
				 $data= array(
					 'id'					=>	null,
					 'barcode'		=>	$this->input->post('barcode'),
					 'nama'				=>	$this->session->userdata('user'),
					 'nip'				=>	$this->session->userdata('nip_user'),
					 'no'					=> 	$this->session->userdata('no'),
					 'bap'				=>	$this->session->userdata('bap'),
					 'tgl'				=>	date('Y-m-d'),
					 'file'				=>	null,
					 'bast'				=>	$a->bast,
					 'tgl_bast'		=>	$a->tgl,
					 'file_bast'	=>	$a->file
				 );
			//code insertbap
			$c= $this->Bmn_model->insertbap($data);
			if($c > 0)
			{
				//update aset
				$d= $this->Bmn_model->updateasetnull($x);
				if($d > 0)
				{
					//delete bast
					$this->Bmn_model->deletebast($a->id);
					redirect(base_url()."bmn/bapbc");
				}
				else
				{
					$this->session->set_flashdata('error',"terjadi kesalahan query pada pemindahan BAST ke BAP !");
					redirect(base_url()."/bmn/bapbc");
				}
			}
			else
			{
				$this->session->set_flashdata('error',"terjadi kesalahan query pada update aset !");
				redirect(base_url()."/bmn/bapbc");
			}
		}
		else
		{
			//session flash error aset bukan milik user tersebut tapi milik user lain, ambil data dari database
			if ($this->Bmn_model->wherepns('nip', $y)->row()>0)
			{
				$z= $this->Bmn_model->wherepns('nip', $y)->row()->nama;
				$this->session->set_flashdata('error',"Aset ini di BAST a/n ".$z);
				redirect(base_url()."/bmn/bapbc");
			}
			else
			{
				$f= $this->Bmn_model->bastbc($x)->row()->pic;
				if (is_null($f))
				{
					$this->session->set_flashdata('error',"Aset belum dipegang user manapun...!!!");
					redirect(base_url()."/bmn/bapbc");
				}
				else
				{
					$this->session->set_flashdata('error',"! Tidak ada aset dengan barcode seperti demikian");
					redirect(base_url()."/bmn/bapbc");
				}
			}
		}
	}
	function drafbap(){
		if (is_null($this->session->userdata('bap')))
		{
			echo "Silahkan set dulu Nomro BAP nya...<a href='setbap'>Set Nomor BAP</a>";
		}
		else
		{
			$x=$this->session->userdata('bap');
			$y=$this->Bmn_model->bapada($x)->row()->file;
			if (is_null($y)) {
				$x= $this->session->userdata('bap');
				$bapada= $this->Bmn_model->bapada($x);
				$data['bap']= $bapada;

				//silahkan sesuaikan
				$data['aset']= $this->Bmn_model->asetbap($x);

				$data['user']= $this->Bmn_model->wherepns('nip', $this->session->userdata('nip_user'));
				$this->load->view('drafbap', $data);
			}
			else
			{
				echo "file sudah terupload. !";
			}
		}
	}
// berita acara pengembalian
	function lab(){
		$x= $this->uri->segment(3);
		if ($x==null) {
			echo "uri segment 3 null";
		}
		else
		{
			echo "uri segment 3 tidak null";
		}
		// $bast= "BASTBMN-1/SET.M.EKON.3.3/03/2020";
		// $x= $this->Bmn_model->bastada($bast);
		// print_r($x->num_rows());

		// $x= "BASTBMN-1/SET.M.EKON.3.3/03/2020";
		// $y= $this->Bmn_model->fileada($x)->row()->file;
		// if($y==null){
		// 	echo "null";
		// }else {
		// 	echo "not null";
		// }



		//sprintf('%04d', $this->input->post('nup'));
		// uniqid();
		// echo $this->uri->segment(3);
		// echo $this->uri->segment(4);
		// echo md5('asep');
	}






	function setbast(){
		if (is_null($this->input->post('nobast'))) {
			$this->load->view('setbast');
		}else {
			if ($this->Bmn_model->bastada($this->input->post('nobast'))->num_rows() > 0) {
				$this->session->set_userdata('bast', $this->input->post('nobast'));
				$this->session->set_flashdata('ok', "Nomor BAST sudah di set dengan nomor: ".$this->session->userdata('bast')."");
				redirect(base_url()."bmn/bast");
			}else {
				$this->session->set_flashdata('error', 'Tidak ada BAST dengan nomor demikian, set ulang nomor BAST.');
				redirect(base_url()."bmn/setbast");
			}
		}
	}
	function uploadbast(){
		if (is_null($this->session->userdata('bast')))
		{
			$this->session->set_flashdata('error', 'Nomor BAST belum di set, Silahkan set terlebih dahulu nomor BASTnya.');
			redirect(base_url()."bmn/setbast");
		}
		else
		{
			$x= $this->session->userdata('bast');
			if($this->Bmn_model->bastada($x)->num_rows() > 0){
				$y= $this->Bmn_model->bastada($x)->row()->file;
				if($y==null){
					if (empty($this->input->post('submit'))) {
						$this->load->view('upload_bast',  array('error'=> ''));
				 	}else {
						$config['upload_path']          = './bast/';
						$config['allowed_types']        = 'pdf';
						$config['file_name']        		= uniqid();
						$this->load->library('upload');
						$this->upload->initialize($config);
						if ( ! $this->upload->do_upload('userfile')){
							$error = array('error' => $this->upload->display_errors());
							$this->load->view('upload_bast',  $error);
						}else {
							$data = array('upload_data' => $this->upload->data());
							$bast=$this->session->userdata('bast');
							$nfile= $this->upload->data('orig_name');
							$this->Bmn_model->updatefilebast($bast, $nfile);
							$this->load->view('upload_success', $data);
						}
				 	}
				}
				else
				{
					$this->session->set_flashdata('error', 'file dengan nomor BAST: '.$this->session->userdata('bast').' sudah di upload,  Set Nomor BAST lain.?');
					redirect(base_url()."bmn/setbast");
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'tidak ada BAST dengan nomor: '.$this->session->userdata('bast').' ,  Set Nomor BAST lain.?');
				redirect(base_url()."bmn/setbast");
			}
		}
  }

	function setbap(){
		if (is_null($this->input->post('nobap'))) {
			$this->load->view('setbap');
		}else {
			if ($this->Bmn_model->bapada($this->input->post('nobap'))->num_rows() > 0) {
				$this->session->set_userdata('bap', $this->input->post('nobap'));
				echo "Nomor BAP sudah di set dengan nomor: ".$this->session->userdata('bap')." <a href='uploadbap'>Lanjut Upload</a>";
			}else {
				echo "tidak ada bap dengan nomor demikian <a href=>input lagi</a>";
			}
		}
	}

	//done
	function uploadbap()
	{
		if (is_null($this->session->userdata('bap')))
		{
			echo "Silahkan set dulu BAP nya...<a href='setbap'>Set BAP</a>";
		}
		else
		{
			$x=$this->session->userdata('bap');
			$y=$this->Bmn_model->bapada($x)->num_rows();
			if ($y > 0)
			{
				//proses row()
				$y=$this->Bmn_model->bapada($x)->num_rows();
				if (empty($this->input->post('submit')))
				{
					$this->load->view('upload_bap',  array('error'=> ''));
				}
				else
				{
					$config['upload_path']          = './bap/';
					$config['allowed_types']        = 'pdf';
					$config['file_name']        		= uniqid();
					$this->load->library('upload');
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload('userfile'))
					{
						$error = array('error' => $this->upload->display_errors());
						$this->load->view('upload_bap',  $error);
					}
					else
					{
						$data = array('upload_data' => $this->upload->data());
						$bap=$this->session->userdata('bap');
						$nfile= $this->upload->data('orig_name');
						$this->Bmn_model->updatefilebap($bap, $nfile);
						$this->load->view('upload_success', $data);
					}
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Nomor BAP tersebut belum ada di database, silahkan set dulu nomor BAP.');
				redirect(base_url().'bmn/setbap');
			}
		}
	}

	function emailgateway()
	{
		if (!empty($this->input->post('email')))
		{
		$config= array(
			'protocol' => 'smtp',
			'smtp_host'=> 'ssl://smtp.googlemail.com',
			'smtp_port'=> 465,
			'smtp_user'=> 'bmnkemenkoperekonomian@gmail.com',
			'smtp_pass'=> 'Bmn_M3nk0',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1'
			);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('bmnkemenkoperekonomian@gmail.com', 'Bagian Pengelolaan BMN');
		$this->email->to($this->input->post('email'));
		$this->email->subject('Bukti kembali pakai Pinjam BMN');
		$this->email->message('File terlampir.');
		$this->email->attach('assets/tanda kembali pakai pinjam.pdf');
			if(!$this->email->send())
			{
	    	echo $this->email->print_debugger();
			}
			else
			{
			  echo "Email berhasil dikirim";
			}
		}
		else
		{
			$this->load->view('formemailgateway');
		}
	}

	function nd(){
		$barcode= $this->uri->segment(3);
		$nip=$this->session->userdata('nip');
		$panggil=$this->session->userdata('email');
		$datasps= array 	(	'no' 					=> '',
		 								'barcode'			=>$barcode,
										'nip'				=>$nip,
										'tanggal'			=>date('Y-m-d')
									);
			$aset= $this->Bmn_model->barcode($barcode);
			$user= $this->Bmn_model->wherepns('nip', $nip);

			if (($aset->num_rows() > 0)&&($user->num_rows() > 0))
			{
				//fungsi cegah selama satu bulan dan fungsi cetak ulang
				$blnthn= date('Y-m');
				$sps= $this->Bmn_model->spsperbulan($blnthn)->num_rows();

				if (($sps > 0)&&($this->uri->segment(4)==null))
				{
					// code... sps sudah ada dan belum lebih dari satu bulan TOLAK
					echo 	"Aset belum lama di perbaiki, apakan aset anda benar-benar rusak lagi? <a href=".$barcode."/1>Lapor keruksakan lagi => </a><br><br><br>
								 Cetak ulang nota dinas permohonan perbaikan <a href=".$barcode."/2>Cetak ulang Nota Dinas => </a>";
				}
				elseif ($this->uri->segment(4)==1)
				{
					// code... jadi ceritanya lain, cuman ganti bentuk dokumen nota dinas doang.
					echo 	"code untuk laporan aset yang dalam satu bulan rusak lebih dari satu kali<br>
								 jadi ceritanya cuman ganti dokumen nota dinas doang.";
				}
				elseif ($this->uri->segment(4)==2)
				{
					// code...
					$data['aset']= $aset->row();
					$data['user']= $user->row();
					$this->load->view('ndperbaikan',$data);
				}
				else
				{ // rekam ke database
					print_r($datasps);
					$rekam= $this->Bmn_model->rekamsps($datasps);
					if ($rekam == TRUE)
					{
						// code...
						$data['aset']= $aset->row();
						$data['user']= $user->row();
						$this->load->view('ndperbaikan',$data);
					}
				}
			}
			else
			{
				echo "Mohon maaf, sistem hanya melayani pengguna terdaftar.!";
				echo "<a href=".base_url()."> Login =>></a>";
				exit();
			}



	}

	function search_username(){
			$username = trim($this->input->get('term', TRUE)); //get term parameter sent via text field. Not sure how secure get() is
      $this->db->select('nama');
      $this->db->from('pns');
      $this->db->like('nama', $username);
			$this->db->limit(5);
      $query = $this->db->get();
      if ($query->num_rows() > 0){
          $data['response'] = 'true'; //If username exists set true
          $data['message'] = array();
          foreach ($query->result() as $row){
						$data['message'][] = array(
                  'value' => $row->nama
              );
          }
      }else{
          $data['response'] = 'false'; //Set false if user not valid
      }
      echo json_encode($data);
		}
	function jnsaset(){
			$kodebarang = trim($this->input->get('term', TRUE)); //get term parameter sent via text field. Not sure how secure get() is
      $this->db->select('jenisBarang');
      $this->db->from('kodeaset');
      $this->db->like('jenisBarang', $kodebarang);
			$this->db->limit(5);
      $query = $this->db->get();
      if ($query->num_rows() > 0){
          $data['response'] = 'true'; //If username exists set true
          $data['message'] = array();
          foreach ($query->result() as $row){
						$data['message'][] = array(
                  'value' => $row->jenisBarang
              );
          }
      }
      else
      {
          $data['response'] = 'false'; //Set false if user not valid
      }
      echo json_encode($data);
		}

		function search_nobast(){
			$nobast = trim($this->input->get('term', TRUE)); //get term parameter sent via text field. Not sure how secure get() is
      $this->db->select('bast');
      $this->db->from('bast');
      $this->db->like('bast', $nobast);
			$this->db->limit(9);
			$this->db->distinct();
      $query = $this->db->get();

			if ($query->num_rows() > 0){
          $data['response'] = 'true'; //If username exists set true
          $data['message'] = array();
          foreach ($query->result() as $row){
						$data['message'][] = array(
                  'value' => $row->bast
              );
          }
      }
      else
      {
          $data['response'] = 'false'; //Set false if user not valid
      }
      echo json_encode($data);
		}

		function search_nobap(){
			$nobap = trim($this->input->get('term', TRUE)); //get term parameter sent via text field. Not sure how secure get() is
      $this->db->select('bap');
      $this->db->from('bap');
      $this->db->like('bap', $nobap);
			$this->db->limit(9);
			$this->db->distinct();
      $query = $this->db->get();

			if ($query->num_rows() > 0){
          $data['response'] = 'true'; //If username exists set true
          $data['message'] = array();
          foreach ($query->result() as $row){
						$data['message'][] = array(
                  'value' => $row->bap
              );
          }
      }
      else
      {
          $data['response'] = 'false'; //Set false if user not valid
      }
      echo json_encode($data);
		}

		function bacasesi(){
			print_r($this->session->userdata());
		}

		function restapi(){
			$this->load->view('restapi');
		}
}
?>
