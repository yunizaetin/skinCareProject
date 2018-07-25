<?php

class Dashboard extends CI_Controller{

	public function __construct(){
		parent::__construct();
		// kembalikan ke halaman login jika user belum login atau level salah
		$this->load->model('back/M_dashboard');
		$this->load->model('back/M_transaksi');
		if ( !$this->session->userdata( 'staff' ) && !$this->session->userdata( 'staff' )['level'] ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Anda belum login!");
			// default redirect
			redirect("back/Login");
		}
	}

	public function index(){
		$data=array(
			'penjualan'=>$this->db->query('select total_bayar from pembelian ORDER BY `id_pembelian` DESC')->result(),
			'data'=>$this->M_dashboard->chart_data(),
			'tampil_pembelian' => $this->M_dashboard->tampil_pembelian(),
			'data_penjualan' => $this->M_dashboard->penjualan_today()->result_array(),
			'data_pendapatan' => $this->M_dashboard->pendapatan_today()->result_array(),
			'data_expired' => $this->M_transaksi->jumlah_data_expaired(),
			'data_nonvalidasi' => $this->M_dashboard->perlu_validasi()->result_array(),
			);

		$this->load->view('back/include/header');
		$this->load->view('back/content_dashboard',$data);
		$this->load->view('back/include/footer');

	}

	

	
}


