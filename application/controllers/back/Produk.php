<?php

class Produk extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
        // load library
		$this->load->library('upload');
		$this->load->model('back/produk/Produk_Model');
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
		$config['base_url'] 	= site_url("back/Produk/index/");
		$config['total_rows'] 	= $this->Produk_Model->jumlah_data();
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
		$data['rs_id'] 			= $this->Produk_Model->get_all_produk_limit($params);
		// view
		$this->load->view('back/include/header');
		$this->load->view('back/produk/content_produk',$data);
		$this->load->view('back/include/footer');
	}

	// fungsi buat nampilin sama proses dibedain yak
	// view tambah
	public function tambahProduk(){
		$data['kategori'] = $this->Produk_Model->getKategori();
		$this->load->view('back/include/header');
		$this->load->view('back/produk/content_tambah_produk',$data);
		$this->load->view('back/include/footer');
	}

	// proses tambah
	public function tambahProdukProcess(){
		$this->form_validation->set_rules('nama_produk','Nama Produk','required|xss_clean');
		$this->form_validation->set_rules('ket_produk','Keterangan Produk','required|xss_clean');
		$this->form_validation->set_rules('harga','Harga Produk','required|xss_clean');
		$this->form_validation->set_rules('stok','Stok Produk','required|xss_clean');
		$this->form_validation->set_rules('id_menu','Kategori Produk','required');
		// print_r($_FILES['gambar']); exit();

		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'nama_produk' 	=> set_value('nama_produk'),
				'ket_produk'	=> set_value('ket_produk'),
				'harga' 		=> set_value('harga'),
				'stok' 			=> set_value('stok'),
				'id_menu' 		=> set_value('id_menu'),
			));
			// default redirect
			redirect("back/Produk/tambahProduk");
		} else {
			// cek file
			if ( $_FILES['gambar']['size'] < 1 ) {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Gambar harus dipilih");
				// recent value
				$this->session->set_flashdata('temp_result', array(
					'nama_produk' 	=> set_value('nama_produk'),
					'ket_produk' 	=> set_value('ket_produk'),
					'harga' 		=> set_value('harga'),
					'stok' 			=> set_value('stok'),
					'id_menu' 		=> set_value('id_menu'),
				));
				// default redirect
				redirect("back/Produk/tambahProduk");
			}
			// proses input
			// set data
			$params = array(
				'nama_produk' 	=> $this->input->post('nama_produk'),
				'ket_produk'	=> $this->input->post('ket_produk'),
				'harga'			=> $this->input->post('harga'),
				'stok'			=> $this->input->post('stok'),
				'id_menu'		=> $this->input->post('id_menu')
			);
			// get id
			$id_produk = $this->Produk_Model->tambahProduk($params);
			if ( $id_produk ) {
				// upload gambar
				$break = explode('.', $_FILES['gambar']['name']);
				$filename 					= $id_produk . '.' . $break[1];
				$config['upload_path']      = './uploads/';
				$config['file_name']      	= $filename;
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
                $config['max_size']         = 10000;
                $this->upload->initialize($config);
                // berhasil upload
                if ( $this->upload->do_upload('gambar')) {
                    // update data
                    $params = array(
                    	'url_image' => $filename
                    );
                    $where = array(
                    	'id_produk' => $id_produk
                    );
                    if ( $this->Produk_Model->ubahProduk($params, $where) ) {
                    	$this->session->set_flashdata('error_status', 'success');
	                    $this->session->set_flashdata('error_msg', "Data berhasil disimpan");
                    } else {
                    	// default error
                    	$this->session->set_flashdata('error_status', 'error');
                    	$this->session->set_flashdata('error_msg', "Gagal mengupdate");
                    	// default redirect
                    	redirect("back/Produk/tambahProduk");
                    }
                } else {
                    // default error
                    $this->session->set_flashdata('error_status', 'error');
                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                    // default redirect
                    redirect("back/Produk/tambahProduk");
                }
				// ----
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				// default redirect
				redirect("back/Produk/tambahProduk");
			}
		}
		// default redirect
		redirect("back/Produk/");
	}

	public function hapusProduk($id_produk){ //parameter dapat isi dari url sehabis '/' ex. /hapusData/3  isi parameter 3
		//$id_produk = $this->Produk_Model->hapusProduk($where);
		$where = array('id_produk' => $id_produk);
		if ( $this->Produk_Model->hapusProduk($where) ) {
			$this->session->set_flashdata('error_status', 'success');
	        $this->session->set_flashdata('error_msg', "Data berhasil dihapus");
        } else {
                // default error
                $this->session->set_flashdata('error_status', 'error');
                $this->session->set_flashdata('error_msg', "Gagal menghapus");
		}
                // default redirect
                redirect('back/Produk','refresh');
	}

	public function ubahProduk($id_produk){

		$data['kategori'] 	= $this->Produk_Model->getKategori();
		$data['produk'] 	= $this->Produk_Model->getDataById($id_produk);
		
			$this->load->view('back/include/header');
			$this->load->view('back/produk/content_ubah_produk',$data);
			$this->load->view('back/include/footer');
	}

	public function ubahProdukProcess(){
		
		$this->form_validation->set_rules('nama_produk','Nama Produk','required|xss_clean');
		$this->form_validation->set_rules('ket_produk','Keterangan Produk','required|xss_clean');
		$this->form_validation->set_rules('harga','Harga Produk','required|xss_clean');
		$this->form_validation->set_rules('stok','Stok Produk','required|xss_clean');
		$this->form_validation->set_rules('id_menu','Kategori Produk','required');
		$this->form_validation->set_rules('id_produk','ID Produk','required');
		// get produk
		$id_produk = $this->input->post('id_produk');
		// proses
		if($this->form_validation->run() == FALSE) {
			// default error 
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'nama_produk' 	=> set_value('nama_produk'),
				'ket_produk' 	=> set_value('ket_produk'),
				'harga' 		=> set_value('harga'),
				'stok' 			=> set_value('stok'),
				'id_menu' 		=> set_value('id_menu'),
			));
			// default redirect
			redirect("back/Produk/ubahProduk/".$id_produk);
		} else {
			// proses update
			// set data
			$params = array(
				'nama_produk' 	=> $this->input->post('nama_produk'),
				'ket_produk'	=> $this->input->post('ket_produk'),
				'harga'			=> $this->input->post('harga'),
				'stok'			=> $this->input->post('stok'),
				'id_menu'		=> $this->input->post('id_menu')
			);
			$where = array(
				'id_produk' 	=> $id_produk
			);
			if ( $this->Produk_Model->ubahProduk( $params, $where ) ) {
				// print_r($_FILES['gambar']); exit();
				// jika gambar diubah
				if ( $_FILES['gambar']['size'] > 0 ) {
					// upload gambar
					$break = explode('.', $_FILES['gambar']['name']);
					$filename 					= $id_produk . '.' . $break[1];
					$config['upload_path']  	= './uploads/';
					$config['file_name']        = $filename;
		            $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
		            $config['max_size']         = 10000;
		            $config['overwrite'] = TRUE;
		            $this->upload->initialize($config);
		            // berhasil upload
		            if ( $this->upload->do_upload('gambar')) {
		                // update data
		                $params = array(
		                	'url_image' => $filename
		                );
		                $where = array(
		                	'id_produk' => $id_produk
		                );
		                if ( $this->Produk_Model->ubahProduk($params, $where) ) {
		                	$this->session->set_flashdata('error_status', 'success');
		                    $this->session->set_flashdata('error_msg', "Data berhasil disimpan");
		                } else {
		                	// default error
		                	$this->session->set_flashdata('error_status', 'error');
		                	$this->session->set_flashdata('error_msg', "Gagal mengupdate");
		                	// default redirect
		                	redirect("back/Produk/ubahProduk/".$id_produk);
		                }
		            } else {
		                // default error
		                $this->session->set_flashdata('error_status', 'error');
		                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
		                // default redirect
		                redirect("back/Produk/ubahProduk/".$id_produk);
		            }
				}
				// ----
				$this->session->set_flashdata('error_status', 'success');
				$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				// default redirect
				redirect("back/Produk/ubahProduk/".$id_produk);
			}
		}
		// default redirect
		redirect("back/Produk/");
	}

}