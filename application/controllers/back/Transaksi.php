<?php

class Transaksi extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		//
		$this->load->model('back/M_transaksi');
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
		$config['base_url'] 	= site_url("back/transaksi/index/");
		$config['total_rows'] 	= $this->M_transaksi->jumlah_data();
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
		$data['rs_id'] 			= $this->M_transaksi->get_all_transaksi_limit($params);
		// view
		$this->load->view('back/include/header');
		$this->load->view('back/transaksi/index',$data);
		$this->load->view('back/include/footer');
	}

	public function detail( $id_pembelian ){
		$this->load->view('back/include/header');
		// get data
		$detail = $this->M_transaksi->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('back/transaksi');
		}
		$data['detail'] = $detail;
		$this->load->view('back/transaksi/detail', $data);
		$this->load->view('back/include/footer');
	}

	// update pengiriman process
	public function update_pengiriman_process(){
		$this->form_validation->set_rules('id_pembelian','ID Pembelian','trim|required|xss_clean');
		$this->form_validation->set_rules('no_resi','No Resi','trim|xss_clean|max_length[15]');
		$this->form_validation->set_rules('tgl_kirim','Tanggal Pengiriman','trim|xss_clean');
		$this->form_validation->set_rules('ket_kirim','Keterangan Pengiriman','trim|xss_clean');
		$this->form_validation->set_rules('status_bayar','Status Pembayaran','trim|xss_clean');
		$this->form_validation->set_rules('status_pembelian','Status Pembelian','trim|xss_clean');
		//id
		$id_pembelian = $this->input->post('id_pembelian', TRUE);
		$detail = $this->M_transaksi->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('back/transaksi');
		}
		// proses
		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'no_resi' => set_value('no_resi'),
				'tgl_kirim' => set_value('tgl_kirim'),
				'ket_kirim' => set_value('ket_kirim'),
			));
			// default redirect
			redirect("back/transaksi/detail/".$id_pembelian);
		} else {
			// update
			if ( $detail['id_kirim'] ) {
				$params = array(
					'tgl_kirim' => ($this->input->post('tgl_kirim', TRUE) ?:NULL),
					'no_resi' => $this->input->post('no_resi', TRUE),
					'ket_kirim' => $this->input->post('ket_kirim', TRUE),
				);
				$where = array( 'id_kirim' => $detail['id_kirim'] );
				if ( $this->M_transaksi->update_pengiriman($params, $where) ) {
					$params = array( 
						'status_pembelian' => $this->input->post('status_pembelian', TRUE), 
						'status_bayar' => $this->input->post('status_bayar', TRUE) 
					);
					$where = array( 'id_pembelian' => $id_pembelian );
					$this->M_transaksi->update_pembelian($params, $where);
					// ----
					$this->session->set_flashdata('error_status', 'success');
					$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				}
			// insert
			} else {
				$params = array(
					'tgl_kirim' => ($this->input->post('tgl_kirim', TRUE) ?:NULL),
					'no_resi' => $this->input->post('no_resi', TRUE),
					'ket_kirim' => $this->input->post('ket_kirim', TRUE),
					'id_pembelian' => $id_pembelian,
				);
				if ( $this->M_transaksi->insert_pengiriman($params) ) {
					$params = array( 
						'status_pembelian' => $this->input->post('status_pembelian', TRUE), 
						'status_bayar' => $this->input->post('status_bayar', TRUE) 
					);
					$where = array( 'id_pembelian' => $id_pembelian );
					$this->M_transaksi->update_pembelian($params, $where);
					// ----
					$this->session->set_flashdata('error_status', 'success');
					$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Data gagal disimpan");
				}
			}
		}
		// default redirect
		redirect("back/transaksi/detail/".$id_pembelian);
	}

	public function delete( $id_pembelian ){
		$this->load->view('back/include/header');
		// get data
		$detail = $this->M_transaksi->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('back/transaksi');
		}
		$data['detail'] = $detail;
		$this->load->view('back/transaksi/delete', $data);
		$this->load->view('back/include/footer');
	}

	function delete_process() {
		//
		$this->form_validation->set_rules('id_pembelian','ID Pembelian','trim|required|xss_clean');
		// id pembelian
		$id_pembelian = $this->input->post('id_pembelian', TRUE);
		// get data
		$detail = $this->M_transaksi->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('back/transaksi');
		}
		// check
		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// default redirect
			redirect("back/transaksi/delete/".$id_pembelian);
		} else {
			// delete
			$where = array( 'id_pembelian' => $id_pembelian );
			if ( $this->M_transaksi->delete_pembelian($where) ) {
				// pesan
	        	$this->session->set_flashdata('error_status', 'success');
	            $this->session->set_flashdata('error_msg', "Data berhasil dihapus");
	            // default redirect
	            redirect("back/transaksi");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Gagal menghapus");
				// default redirect
				redirect("back/transaksi/delete/".$id_pembelian);
			}
		}
		// default redirect
		redirect("back/transaksi/delete/".$id_pembelian);
	}

	public function updatePembayaran(){
		$id_pembelian=$this->input->post('id_pembelian');
		$status_bayar=$this->input->post('status_bayar');
		$data=$this->M_transaksi->update_status_pembayaran($id_pembelian,$status_bayar);

		redirect("back/transaksi/detail/".$id_pembelian);
	}

	public function expaired(){
				/* start of pagination --------------------- */
		// pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url("back/transaksi/expaired/");
		$config['total_rows'] 	= $this->M_transaksi->jumlah_data_expaired();
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
		$data['rs_id'] 			= $this->M_transaksi->get_all_transaksi_expaired($params);
		// view
		$this->load->view('back/include/header');
		$this->load->view('back/transaksi/expaired',$data);
		$this->load->view('back/include/footer');
	}

	public function restock_process( $id_pembelian ){
		// get data
		$detail = $this->M_transaksi->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('back/transaksi/expaired');
		}
		foreach ($detail['detail'] as $barang) {
			$this->M_transaksi->tambah_stok($barang['id_produk'], $barang['stok']);
		}
		$params = array( 'status_pembelian' => "Selesai" );
		$where = array( 'id_pembelian' => $id_pembelian );
		$this->M_transaksi->update_pembelian($params, $where);
		// default error
		$this->session->set_flashdata('error_status', 'success');
		$this->session->set_flashdata('error_msg', "Pengembalian stok berhasil!");
		redirect('back/transaksi/expaired');
	}
}