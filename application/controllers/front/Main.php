<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Main extends CI_Controller {
		private $cart_harga, $cart_count;

		public function __construct(){
			parent::__construct();
			$this->load->model(array('front/M_main'));
		}

		public function index(){
			// menu
			$data['rs_menubar'] = $this->M_main->get_list_kategori();
			$this->load->view('front/main/header', $data);
			// body
			$data = array();
			$data['rs_banner'] = $this->M_main->get_list_banner();
			// produk terpopuler
			$data['rs_populer'] = $this->M_main->get_list_populer_produk(4);
			foreach ($data['rs_populer'] as $i => $produk) {
				if ( file_exists('uploads/' . $produk['url_image']) && $produk['url_image'] ) {
					$data['rs_populer'][$i]['image'] = 'uploads/' . $produk['url_image'];
				} else {
					$data['rs_populer'][$i]['image'] = 'assets/front/images/img_default.jpg';
				}
			}
			// produk terbaru
			$data['rs_new'] = $this->M_main->get_list_new_produk(4);
			foreach ($data['rs_new'] as $i => $produk) {
				if ( file_exists('uploads/' . $produk['url_image']) && $produk['url_image'] ) {
					$data['rs_new'][$i]['image'] = 'uploads/' . $produk['url_image'];
				} else {
					$data['rs_new'][$i]['image'] = 'assets/front/images/img_default.jpg';
				}
			}
			$this->load->view('front/main/index', $data);
			$this->load->view('front/main/footer');
		}

		public function login(){
			$data['rs_menubar'] = $this->M_main->get_list_kategori();
			// print_r($data); exit();
			$this->load->view('front/main/header', $data);
			$this->load->view('front/main/login');
			$this->load->view('front/main/footer');
		}

		// proses login
		public function login_process(){
			$this->form_validation->set_rules('username','Username','required|xss_clean');
			$this->form_validation->set_rules('password','Password','required|xss_clean');
			// cek input
			if($this->form_validation->run() !== FALSE){
				$params = array(
					$this->input->post('username', TRUE),
					$this->input->post('password', TRUE),
				);
				// $result
				$result = $this->M_main->check_user($params);
				if ( $result ) {
					//
					if ($result['status'] == "tidak") {
						// default error
						$this->session->set_flashdata('error_status', 'error');
						$this->session->set_flashdata('error_msg', "Aktivasi akun dulu ya sis, silahkan cek email ya !");
						// default redirect
						redirect("front/main/login");
					}
					// set sesi
					$params = array(
						'id_user' => $result['id_user'],
						'nama_lengkap' => $result['nama_lengkap'],
					);
					$this->session->set_userdata('user_orvala', $params);
					// ----
					$this->session->set_flashdata('error_status', 'success');
					$this->session->set_flashdata('error_msg', "Login berhasil");
					// default redirect
					redirect("front/dashboard");
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Username / Password salah");
				}
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', validation_errors());
			}
			// default redirect
			redirect("front/main/login");
		}

		// proses logout
		public function logout_process(){
			$this->session->unset_userdata('user_orvala');
			// default redirect
			redirect();
		}

		public function register(){
			$data['rs_menubar'] = $this->M_main->get_list_kategori();
			// print_r($data); exit();
			$this->load->view('front/main/header', $data);
			$this->load->view('front/main/register');
			$this->load->view('front/main/footer');
		}

		// proses daftar
		public function register_process(){
			$this->form_validation->set_rules('nama_lengkap','Nama Lengkap','required|xss_clean|max_length[30]');
			$this->form_validation->set_rules('email','Email Pengirim','required|xss_clean');
			$this->form_validation->set_rules('password','Password','required|xss_clean');
			$this->form_validation->set_rules('ulang_password','Ulangi Password','required|xss_clean');
			$this->form_validation->set_rules('jenis_kelamin','Gender','required|xss_clean');
			$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','required|xss_clean');
			$this->form_validation->set_rules('no_hp','No. Handphone','required|xss_clean|max_length[12]');
			// cek input
			if($this->form_validation->run() !== FALSE){
				if ( $this->input->post('password', TRUE) !== $this->input->post('ulang_password', TRUE) ) {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Password harus sama!");
					// recent value
					$this->session->set_flashdata('temp_result', array(
						'nama_lengkap' => set_value('nama_lengkap'),
						'email' => set_value('email'),
						'jenis_kelamin' => set_value('jenis_kelamin'),
						'tgl_lahir' => set_value('tgl_lahir'),
						'no_hp' => set_value('no_hp'),
					));
					// default redirect
					redirect("front/main/register");
				}
				// cek email
				if ( $this->M_main->is_exist_email($this->input->post('email', TRUE)) ) {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Sorry sis, Email sudah digunakan pengguna lain!");
					// recent value
					$this->session->set_flashdata('temp_result', array(
						'nama_lengkap' => set_value('nama_lengkap'),
						'email' => set_value('email'),
						'jenis_kelamin' => set_value('jenis_kelamin'),
						'tgl_lahir' => set_value('tgl_lahir'),
						'no_hp' => set_value('no_hp'),
					));
					// default redirect
					redirect("front/main/register");
				}
				// tambah user
				// proses input
				// set data
				$params = array(
					'email' 		=> $this->input->post('email'),
					'password' 		=> md5($this->input->post('password')),
					'nama_lengkap' 	=> $this->input->post('nama_lengkap'),
					'tgl_lahir' 	=> $this->input->post('tgl_lahir'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'no_hp' 		=> $this->input->post('no_hp'),
					'mdb_name'		=> "front",
					'mdd'			=> date("Y-m-d H:i:s")
				);
				// get id
				$id_user = $this->M_main->insert_data_user($params);
				if ( $id_user ) {
					$link_aktif = md5($id_user);
					$params = array( 'link_aktif' => $link_aktif );
					$where = array( 'id_user' => $id_user );
					$this->M_main->update_data_user($params, $where);
					// kirim email
					$smtp_username = $this->M_main->get_com_preferences('smtp_username');
					$smtp_password = $this->M_main->get_com_preferences('smtp_password');
					$smtp_nama = $this->M_main->get_com_preferences('smtp_nama');
					// Configure email library
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'ssl://smtp.gmail.com';
					$config['smtp_port'] = 465;
					$config['smtp_user'] = $smtp_username;
					$config['smtp_pass'] = $smtp_password;
					$config['newline'] = "\r\n";
					$config['charset'] = "utf-8";
					$config['mailtype'] = "html";

					// Load email library and passing configured values to email library
					$this->load->library('email', $config);
					// $this->email->set_newline("rn");

					// Sender email address
					$this->email->from($config['smtp_user'], $smtp_nama);
					// Receiver email address
					$this->email->to($this->input->post('email'));
					// Subject of email
					$this->email->subject("Aktivasi Akun");
					// Message in email
					$html = '<!DOCTYPE html>
						<html>
						<head>
							<title></title>
						</head>
						<body>
							<p style="font-size: 24px; text-align: center; background-color: grey; color: white; padding: 20px">Aktivasi Akun</p>
							<p style="font-size: 16px; text-align: center">
							Silahkan klik link dibawah ini untuk mengaktifkan akun : <br>
							<a href="'.site_url('front/main/aktivasi_user/'.$link_aktif).'">Aktifkan Akun</a>
							</p>
						</body>
						</html>';
					$this->email->message($html);
					$this->email->send();
					// echo "<pre>";
					// print_r($this->email->print_debugger(array('headers')));
					// echo "</pre>";
					// exit();
					// ----
					$this->session->set_flashdata('error_status', 'success');
					$this->session->set_flashdata('error_msg', "Yeyy pendaftaran berhasil, silahkan cek email sista untuk aktivasi akun");
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Pendaftaran gagal disimpan");
					// recent value
					$this->session->set_flashdata('temp_result', array(
						'nama_lengkap' => set_value('nama_lengkap'),
						'email' => set_value('email'),
						'jenis_kelamin' => set_value('jenis_kelamin'),
						'tgl_lahir' => set_value('tgl_lahir'),
						'no_hp' => set_value('no_hp'),
					));
				}
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', validation_errors());
				// recent value
				$this->session->set_flashdata('temp_result', array(
					'nama_lengkap' => set_value('nama_lengkap'),
					'email' => set_value('email'),
					'jenis_kelamin' => set_value('jenis_kelamin'),
					'tgl_lahir' => set_value('tgl_lahir'),
					'no_hp' => set_value('no_hp'),
				));
			}
			// default redirect
			redirect("front/main/register");
		}

		public function about(){
			$data['rs_menubar'] = $this->M_main->get_list_kategori();
			// print_r($data); exit();
			$this->load->view('front/main/header', $data);
			// konten
			$data = array();
			$data['rs_konten'] = $this->M_main->get_com_preferences('about');
			$this->load->view('front/main/about', $data);
			$this->load->view('front/main/footer');
		}

		public function help(){
			$data['rs_menubar'] = $this->M_main->get_list_kategori();
			// print_r($data); exit();
			$this->load->view('front/main/header', $data);
			// konten
			$data = array();
			$data['rs_line'] = $this->M_main->get_com_preferences('admin_line');
			$data['rs_alamat'] = $this->M_main->get_com_preferences('admin_alamat');
			$data['rs_telepon'] = $this->M_main->get_com_preferences('admin_telepon');
			$data['rs_waktu'] = $this->M_main->get_com_preferences('admin_layanan');
			$data['rs_maps'] = $this->M_main->get_com_preferences('admin_maps');
			$this->load->view('front/main/help', $data);
			$this->load->view('front/main/footer');
		}

		// kirim pesan
		public function send_message(){
			$this->form_validation->set_rules('kirim_nama','Nama Pengirim','required|xss_clean');
			$this->form_validation->set_rules('kirim_email','Email Pengirim','required|xss_clean');
			$this->form_validation->set_rules('kirim_subjek','Subjek Pengirim','required|xss_clean');
			$this->form_validation->set_rules('kirim_pesan','Isi Pesan','required|xss_clean');

			if($this->form_validation->run() !== FALSE){
				$to = $this->M_main->get_com_preferences('web_email');
				$subject = $this->input->post('kirim_subjek', TRUE);
				$txt = $this->input->post('kirim_pesan', TRUE);
				$headers = "From: " . $this->input->post('kirim_email', TRUE) . "\r\n" .
				"CC: " . $this->M_main->get_com_preferences('web_email');
				// kirim
				mail($to,$subject,$txt,$headers);
				// ----
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Pesan berhasil dikirim");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', validation_errors());
				// recent value
				$this->session->set_flashdata('temp_result', array(
					'kirim_nama' => set_value('kirim_nama'),
					'kirim_email' => set_value('kirim_email'),
					'kirim_subjek' => set_value('kirim_subjek'),
					'kirim_pesan' => set_value('kirim_pesan'),
				));
			}
			// default redirect
			redirect("front/main/help");
		}

		public function aktivasi_user($kode_aktivasi='') {
			$detail = $this->M_main->get_user_aktivasi($kode_aktivasi);
			if (empty($detail)) {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Akun tidak ditemukan !");
				// default redirect
				redirect("front/main/login");
			}
			$params = array(
				'status' => 'aktif'
			);
			$where = array(
				'id_user' => $detail['id_user']
			);
			if ($this->M_main->update_data_user($params, $where)) {
				// default error
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Akun Sista berhasil diaktifkan, silahkan login !");
				// default redirect
				redirect("front/main/login");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Aktivasi akun gagal !");
				// default redirect
				redirect("front/main/login");
			}
			
		}
	}
?>