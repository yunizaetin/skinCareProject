<?php

class Pengguna extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
        // load library
		$this->load->library('upload');
		$this->load->model('back/pengguna/Pengguna_Model');
		// kembalikan ke halaman login jika user belum login atau level salah
		if ( !$this->session->userdata( 'staff' ) && !$this->session->userdata( 'staff' )['level'] ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Anda belum login!");
			// default redirect
			redirect("back/Login");
		}
	}

	public function index(){
		/* start of pagination --------------------- */
		// pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url("back/Pengguna/index/");
		$config['total_rows'] 	= $this->Pengguna_Model->jumlah_data();
		$config['uri_segment'] 	= 4;
		$config['per_page'] 	= 10;
		$this->pagination->initialize($config);
		$pagination['data'] 	= $this->pagination->create_links();
		// pagination attribut
		$start 					= $this->uri->segment(4, 0) + 1;
		$end 					= $this->uri->segment(4, 0) + $config['per_page'];
		$end 					= (($end > $config['total_rows']) ? $config['total_rows'] : $end);
		$pagination['start'] 	= ($config['total_rows'] == 0) ? 0 : $start;
		$pagination['end'] 		= $end;
		$pagination['total'] 	= $config['total_rows'];
		// pagination assign value
		$data['pagination'] 	= $pagination;
		$data['no'] 			= $start;
		/* end of pagination ---------------------- */
		// get data
		$params 				= array(($start - 1), $config['per_page']);
		$data['rs_id'] 			= $this->Pengguna_Model->get_all_produk_limit($params);
		// view
		$this->load->view('back/include/header');
		$this->load->view('back/pengguna/content_pengguna',$data);
		$this->load->view('back/include/footer');
	}

	// fungsi buat nampilin sama proses dibedain yak
	// view tambah
	public function tambahPengguna(){
		$data['pengguna'] = $this->Pengguna_Model->getKategori();
		$this->load->view('back/include/header');
		$this->load->view('back/pengguna/content_tambah_pengguna',$data);
		$this->load->view('back/include/footer');
	}

	// proses tambah
	public function tambahPenggunaProcess(){
		$this->form_validation->set_rules('email','Email','required|xss_clean');
		$this->form_validation->set_rules('password','Password','required|xss_clean');
		$this->form_validation->set_rules('level','Level','required');
		$this->form_validation->set_rules('nama_lengkap','Nama Lengkap','required|xss_clean');
		$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
		$this->form_validation->set_rules('no_hp','Nomor HP','required|xss_clean');

		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'email' 		=> set_value('email'),
				'password' 		=> set_value('password'),
				'level' 		=> set_value('level'),
				'nama_lengkap' 	=> set_value('nama_lengkap'),
				'tgl_lahir' 	=> set_value('tgl_lahir'),
				'jenis_kelamin' => set_value('jenis_kelamin'),
				'no_hp' 		=> set_value('no_hp')
			));
			// default redirect
			redirect("back/Pengguna/tambahPengguna");
		} else {
			// proses input
			// set data
			$params = array(
				'email' 		=> $this->input->post('email'),
				'password' 		=> md5($this->input->post('password')),
				'level' 		=> $this->input->post('level'),
				'nama_lengkap' 	=> $this->input->post('nama_lengkap'),
				'tgl_lahir' 	=> $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'no_hp' 		=> $this->input->post('no_hp'),
			);
			// get id
			$id_user = $this->Pengguna_Model->tambahPengguna($params);
			if ( $id_user) {
				// ----
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				// default redirect
				redirect("back/Pengguna/tambahPengguna");
			}
		}
		// default redirect
		redirect("back/Pengguna");
	}

	public function hapusPengguna($id_user){ //parameter dapat isi dari url sehabis '/' ex. /hapusData/3  isi parameter 3
		
		$where = array('id_user' => $id_user);
		if ( $this->Pengguna_Model->hapusPengguna($where) ) {
			$this->session->set_flashdata('error_status', 'success');
	        $this->session->set_flashdata('error_msg', "Data berhasil dihapus");
        } else {
                // default error
                $this->session->set_flashdata('error_status', 'error');
                $this->session->set_flashdata('error_msg', "Gagal menghapus");
		}
                // default redirect
                redirect('back/Pengguna','refresh');
	}

	public function ubahPengguna($id_user){

		//$data['kategori'] = $this->KategoriProduk_Model->getKategori();
		$data['pengguna'] = $this->Pengguna_Model->getDataById($id_user);
			
			$this->load->view('back/include/header');
			$this->load->view('back/pengguna/content_ubah_pengguna',$data);
			$this->load->view('back/include/footer');
	}

	public function ubahPenggunaProcess(){

		$this->form_validation->set_rules('email','Email','required|xss_clean');
		$this->form_validation->set_rules('password','Password','required|xss_clean');
		$this->form_validation->set_rules('level','Level','required|xss_clean');
		$this->form_validation->set_rules('nama_lengkap','Nama Lengkap','required|xss_clean');
		$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','required|xss_clean');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required|xss_clean');
		$this->form_validation->set_rules('no_hp','Nomor HP','required|xss_clean');
		//get user
		$id_user = $this->input->post('id_user');
		// proses
		if($this->form_validation->run() == FALSE) {
			// default error 
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'email' 		=> set_value('email'),
				'password' 		=> set_value('password'),
				'level' 		=> set_value('level'),
				'nama_lengkap' 	=> set_value('nama_lengkap'),
				'tgl_lahir' 	=> set_value('tgl_lahir'),
				'jenis_kelamin' => set_value('jenis_kelamin'),
				'no_hp' 		=> set_value('no_hp')
			));
			// default redirect
			redirect("back/Pengguna/ubahPengguna/".$id_user);
		} else {
			// proses update
			// set data
			$params = array(
				'email' 		=> $this->input->post('email'),
				'password' 		=> $this->input->post('password'),
				'level' 		=> $this->input->post('level'),
				'nama_lengkap' 	=> $this->input->post('nama_lengkap'),
				'tgl_lahir' 	=> $this->input->post('tgl_lahir'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'no_hp' 		=> $this->input->post('no_hp'),
			);
			$where = array(
				'id_user' 	=> $id_user
			);
			if ( $this->Pengguna_Model->ubahPengguna( $params, $where ) ) {
				// ----
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				// default redirect
				redirect("back/Pengguna/ubahPengguna/".$id_user);
			}
		}
		// default redirect
		redirect("back/Pengguna");
	}

}