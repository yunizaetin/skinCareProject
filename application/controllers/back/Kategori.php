<?php

class Kategori extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
        // load library
		$this->load->library('upload');
		$this->load->model('back/kategori/KategoriProduk_Model');
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
		$config['base_url'] 	= site_url("back/Kategori/index/");
		$config['total_rows'] 	= $this->KategoriProduk_Model->jumlah_data();
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
		$data['rs_id'] 			= $this->KategoriProduk_Model->get_all_produk_limit($params);
		// view
		$this->load->view('back/include/header');
		$this->load->view('back/kategori/content_kategori',$data);
		$this->load->view('back/include/footer');
	}

	// fungsi buat nampilin sama proses dibedain yak
	// view tambah
	public function tambahKategori(){
		$data['kategori'] = $this->KategoriProduk_Model->getKategori();
		$this->load->view('back/include/header');
		$this->load->view('back/kategori/content_tambah_kategori',$data);
		$this->load->view('back/include/footer');
	}

	// proses tambah
	public function tambahKategoriProcess(){
		$this->form_validation->set_rules('nama_kategori','Nama Kategori Produk','required|xss_clean');

		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'nama_kategori' => set_value('nama_kategori')
			));
			// default redirect
			redirect("back/Kategori/tambahKategori");
		} else {
			// proses input
			// set data
			$params = array(
				'nama_kategori' 	=> $this->input->post('nama_kategori'),
			);
			// get id
			$id_menu = $this->KategoriProduk_Model->tambahKategori($params);
			if ( $id_menu) {
				// ----
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				// default redirect
				redirect("back/Kategori/tambahKategori");
			}
		}
		// default redirect
		redirect("back/Kategori");
	}

	public function hapusKategori($id_menu){ //parameter dapat isi dari url sehabis '/' ex. /hapusData/3  isi parameter 3
		
		$where = array('id_menu' => $id_menu);
		if ( $this->KategoriProduk_Model->hapusKategori($where) ) {
			$this->session->set_flashdata('error_status', 'success');
	        $this->session->set_flashdata('error_msg', "Data berhasil dihapus");
        } else {
                // default error
                $this->session->set_flashdata('error_status', 'error');
                $this->session->set_flashdata('error_msg', "Gagal menghapus");
		}
                // default redirect
                redirect('back/Kategori','refresh');
	}

	public function ubahKategori($id_menu){

		//$data['kategori'] = $this->KategoriProduk_Model->getKategori();
		$data['kategori'] = $this->KategoriProduk_Model->getDataById($id_menu);
			
			$this->load->view('back/include/header');
			$this->load->view('back/kategori/content_ubah_kategori',$data);
			$this->load->view('back/include/footer');
	}

	public function ubahKategoriProcess(){

		$this->form_validation->set_rules('nama_kategori','Nama Kategori Produk','required|xss_clean');	
		$id_menu = $this->input->post('id_menu');
		// proses
		if($this->form_validation->run() == FALSE) {
			// default error 
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'nama_kategori' => set_value('nama_kategori')
			));
			// default redirect
			redirect("back/Kategori/ubahKategori/".$id_menu);
		} else {
			// proses update
			// set data
			$params = array(
				'nama_kategori' 	=> $this->input->post('nama_kategori')
			);
			$where = array(
				'id_menu' 	=> $id_menu
			);
			if ( $this->KategoriProduk_Model->ubahKategori( $params, $where ) ) {
				// ----
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				// default redirect
				redirect("back/Kategori/ubahKategori/".$id_menu);
			}
		}
		// default redirect
		redirect("back/Kategori");
	}

}