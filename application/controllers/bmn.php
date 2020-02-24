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
			$nip=$this->session->userdata('nip');
			$wherepns='nip';
			$nilai=$nip;
			$truelogin=$this->Bmn_model->wherepns($wherepns, $nilai)->num_rows();
			if($truelogin==1){
				$data['biji']=$this->Bmn_model->wherepns($wherepns, $nilai)->row();
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
					echo "aset sudah ada di database";
				}else {
					//lanjut ke proses memasukan data
					$data= array 	(	'barcode'				=>$barcode,
					'jenis_barang'	=>$post['jenis_barang'],
					'merk_type'			=>$post['merk_type'],
					'nup'						=>$post['nup'],
					'tgl_perolehan'	=>$post['tgl_perolehan'] );

					//reporting
					$query= $this->Bmn_model->insertaset($data);
					if($query==true){
						echo "data berhasil di entri ";
					}else {
						echo "data gagal di entri";
					}
				}
			}else {
				echo "kode aset tidak ada di database silahkan input terlebih dahulu";
			}
		}
	}


//ini bener bener yang menjadi judul projek ini

	function bast(){
		$date= array	(	'tgl' => date('d'),
										'bln' => date('m'),
										'thn' => date('Y')
									);
		$data['noawal']= $this->Bmn_model->maxnobast($date)->row()->no;
		$data['date']=$date;
		if(is_null($this->input->post('bast'))){
			$this->load->view('bast', $data);
		}else {
			$wherepns='nama';
			$nilai=$this->input->post('user');
			$nip= ($this->Bmn_model->wherepns($wherepns, $nilai)->row()->nip);
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
		$this->session->set_userdata($date);
	}

	function formbarcode(){
		$this->load->view('formbarcode');
		$bast= $this->session->userdata('bast');
		$data['aset']= $this->Bmn_model->arraydipilih($bast)->result();
		$this->load->view('arraydipilih', $data);
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
												'nip'			=>$this->session->userdata('nip_user'),
												'no'			=>$this->session->userdata('no'),
												'bast'		=>$this->session->userdata('bast'),
												'tgl'			=>$this->session->userdata('tgl'),
												'bln'			=>$this->session->userdata('bln'),
												'thn'			=>$this->session->userdata('thn')
											);
				if($this->Bmn_model->insertbast($adata)>0){
					$asetdata = array (	'lokasi' 		=> $lokasi,
															'pengguna' 	=> $pengguna,
															'pic'				=> $this->session->userdata('nip_user')
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
				$msg= $this->Bmn_model->cegah($barcode)->row();
				$nip=$msg->nip;
				$wherepns='nip';
				$nilai=$nip;
				$nama= $this->Bmn_model->wherepns($wherepns, $nilai)->row();
				$this->session->set_flashdata('error','Aset masih digunakan oleh '.$nama->nama.' dengan nomor bast '.$msg->bast.'<br>');
				redirect(base_url().'bmn/formbarcode');
			}
		}else {
			$this->session->set_flashdata('error', 'Tidak ada aset dengan barcode '.$barcode);
			redirect(base_url().'bmn/formbarcode');
		}
	}
	function odtbast(){
		$this->load->view('odtbast');
	}
	function pdfbast(){
		$bast= $this->input->post('bast');
		if ($this->Bmn_model->wherenobast($bast)->num_rows()>0) {
			//var buat ngambil isian
			$wherepns= 'nip';
			$nilai= $this->Bmn_model->wherenobast($bast)->row()->nip;
			$tanggal= $this->Bmn_model->wherenobast($bast)->row();

			//isian buat pdfbast
			$data['karo1']=$this->Bmn_model->karo()->row();
			$data['user']=$this->Bmn_model->wherepns($wherepns, $nilai)->row();
			$data['aset']=$this->Bmn_model->arraydipilih($bast);
			$data['kabag']=$this->Bmn_model->kabagbmn()->row();
			$data['bast']=$this->Bmn_model->wherenobast($bast)->row();
			$data['tanggal']=$tanggal->thn.'-'.$tanggal->bln.'-'.$tanggal->tgl;
			$this->load->view('pdfbast', $data);
			$this->session->unset_userdata('no');
			$this->session->unset_userdata('bast');
			$this->session->unset_userdata('user');
			$this->session->unset_userdata('nip_user');
		}else {
			$this->session->set_flashdata('error', 'Tidak ada data');
			redirect(base_url().'bmn/formbarcode');
		}
	}

	function unset(){
		$asession = array('no', 'bast', 'user', 'nip');
		$this->session->unset_userdata($asession);
		redirect(base_url().'bmn/bast');
	}

//BAST ada revisi silah menyesuaikan dengan fungsi model di bastaktif



// berita acara pengembalian
	function bap(){
		//19940911 201902 1 004   BASTBMN-1/SET.M.EKON.3.3/01/2020
		$bast='BASTBMN-1/SET.M.EKON.3.3/01/2020';
		$nip='19940911 201902 1 004';
		$data['bast']= $this->Bmn_model->untukbap($bast, $nip)->result();
		$this->load->view('bap', $data);
	}

	//fungsi fungsi lain yang menjadi garapan
	function balikin(){
		$this->load->view('balikin');
	}





	function lab(){
		if($this->session->userdata())
		$this->load->view('lab');
		//sprintf('%04d', $this->input->post('nup'));
		// echo uniqid();
		// $this->load->view("lab");
		// echo $this->uri->segment(3);
		// echo $this->uri->segment(4);
		// echo md5('asep');
	}
	function restapi(){
		$this->load->view('restapi');
	}
	function tmbasetpkpj(){
		//kondisinya harus aset.user==null && aset.bast==NULL
		//trus check model (hanya jabatan dengan kepala subbagian aset tetap dan pemeliharaan yang bisa masuk)
		$nama="kepala subbagian aset tetap dan pemeliharaan";
		echo $nama;
	}
	function listfile(){
		$this->load->view('../../uploads/DirectoryLister/index.php');
	}
	function upload(){
  	$this->load->view('upload_form', array('error' => ' ' ));
  }
  function do_upload(){
	  $config['upload_path']          = './uploads/';
	  $config['allowed_types']        = 'gif|jpg|png|pdf';
	  $this->load->library('upload', $config);
	  if ( ! $this->upload->do_upload('userfile')){
	    $error = array('error' => $this->upload->display_errors());
	    $this->load->view('upload_form', $error);
    }else{
      $data = array('upload_data' => $this->upload->data());
      $this->load->view('upload_success', $data);
    }
  }
	function arraybast(){
		$data['bast']=$this->Bmn_model->bastnotfixyet()->result();
		$this->load->view('arraybast',$data);
	}
	function pakaipinjam(){
		if(($this->uri->segment(3)==true)xor(!empty($this->input->post()))){
			$this->session->set_userdata('bc',$this->uri->segment(3));
			$this->load->view('formpkpj');
		}elseif (!empty($this->input->post())) {
			$bc=$this->session->userdata('bc');
			$nama=$this->input->post('nama');
			$tujuan=$this->input->post('tujuan');
			$tgl=$this->input->post('tglpinjam');
			if ($this->Bmn_model->chkpkpj($bc)==false) {
				if($this->Bmn_model->pkpjin($bc, $tujuan, $tgl, $nama)==true){
					echo "Data pakai pinjam direkam.";
				}else {
					echo "Gagal entri data pakai pinjam ke database";
				}
			}else {
				echo "Aset sedang dalam pakai pinjam user lain.";
			}
		} else {
			$data['pkpj']=$this->Bmn_model->pkpj();
			$this->load->view('formpkpj', $data);
		}
	}
	function emailgateway(){
		if (!empty($this->input->post('email'))) {
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
		$this->email->to($this->input->post('email'));
		$this->email->subject('Bukti kembali pakai Pinjam BMN');
		$this->email->message('File terlampir.');
		$this->email->attach('assets/tanda kembali pakai pinjam.pdf');
			if(!$this->email->send()){
	    	echo $this->email->print_debugger();
			}else{
			  echo "Email berhasil dikirim";
			}
		}else {
			$this->load->view('formemailgateway');
		}
	}

	function nd(){
		$barcode= $this->uri->segment(3);
		$nip=$this->session->userdata('nip');
		$panggil=$this->session->userdata('panggil');
		$keruksakan=$this->input->post('uraiankeruksakan');
		$sps = array 	(	'no' 					=> '',
										'nosps'				=> '',
		 								'barcode'			=>$barcode,
										'nama'				=>$nip,
										'keruksakan'	=>$keruksakan,
										'tanggal'			=>date('Y-m-d')
									);
		if (empty($keruksakan)){
			$this->load->view('uraiankeruksakan');
		}else {
			$query= $this->Bmn_model->sps($sps);
			$data['aset']= $this->Bmn_model->barcode($barcode)->row();
			$wherepns='nama';
			$nilai=	$nip;
			$data['user']= $this->Bmn_model->wherepns($wherepns, $nilai)->row();
			$data['keruksakan']=$keruksakan;
			$this->load->view('ndperbaikan',$data);
		}
	}
	function accsps(){
		$nama=$this->session->userdata('nama');
		$data['variable']= $this->Bmn_model->accsps();
		$this->load->view('accsps',$data);
	}
	function ctsps(){
		$getno		= $this->uri->segment(3);
		$nosps		= $this->input->post('nosps');
		if (empty($nosps)){
			$data['max']= $this->Bmn_model->max();
			$this->load->view('spsperid',$data);
		}else {
			$query= $this->Bmn_model->ctsps($getno, $nosps);
			$nama= $this->session->userdata('nama');
			$query= $this->Bmn_model->spsperid($getno);
			$barcode= $query->barcode;
			$data['user']	= $this->Bmn_model->carinip($nama);
			$data['aset']	= $this->Bmn_model->barcode($barcode)->row();
			$data['sps']	= $this->Bmn_model->spsperid($getno);
			$this->load->view('sps', $data);
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
}
?>
