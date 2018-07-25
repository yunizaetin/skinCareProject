<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	private $cart_harga, $cart_count;

	public function __construct(){
		parent::__construct();
		// 
		if ( !$this->session->userdata('user_orvala') ) {
			redirect();
		}
		// load model
		$this->load->model('front/M_dashboard');
	}

	function index() {
		$data['rs_menubar'] = $this->M_dashboard->get_list_kategori();
		$this->load->view('front/main/header', $data);
		$this->load->view('front/dashboard/index');		
		$this->load->view('front/main/footer');
	}

	function add_pembelian_process() {
		$rs_cart = $this->session->userdata('cart') ? $this->session->userdata('cart')['data'] : array();
		if ( !$rs_cart ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Opsss keranjangmu masih kosong sis, Yuk belanja dulu");
			redirect('front/dashboard');
		}

		$errors = "";
    
		// cek stok
        foreach ($rs_cart as $i => $cart) {
            $produk = $this->M_dashboard->get_produk_by_id($cart['id']);
            //
            if (!$produk) {
                $errors = $produk['nama_produk'] . " gagal ditambahkan!";
            }
            //
            if ($produk['stok'] < $cart['qty']) {
                $errors = "Stok " . $produk['nama_produk'] . " kurang!";
            }
        }

        if ($errors) {
        	// default error
        	$this->session->set_flashdata('error_status', 'error'); // tipe errornya
        	$this->session->set_flashdata('error_msg', $errors); // pesan errornya
        	redirect('front/dashboard');
        }

		// alamat
		$params = array(
			'id_user' => $this->session->userdata('user_orvala')['id_user'],
		);
		$id_alamat = $this->M_dashboard->insert_data_alamat($params);
		
		// tambahkan ke proses pembelian
		$today = date("Y-m-d H:i:s");
		$expire = date('Y-m-d H:i:s', strtotime($today . ' +1 day'));
		$params = array(
			'tgl_pembelian' => $today,
			'id_alamat' => $id_alamat,
			'expire' => $expire,
		);
		$id_pembelian = $this->M_dashboard->insert_pembelian($params);
		//detail
		$total_bayar = 0; $errors = "";
		foreach ($rs_cart as $cart) {
			$total_bayar += $cart['price'] * $cart['qty'];
			$params = array(
				'id_pembelian' => $id_pembelian,
				'id_produk' => $cart['id'],
				'jumlah' => $cart['qty'],
			);
			if ( !$this->M_dashboard->insert_detail_pembelian($params) ) {
				$produk = $this->M_dashboard->get_produk_by_id($id_produk);
				$errors .= "<br>" + $produk['nama_produk'];
			}
			else {
			// kurangi stok
                    $this->M_dashboard->kurangi_stok_produk($cart['qty'], $cart['id']);
			}
		}
		// 
		$params = array( 'total_bayar' => $total_bayar );
		$where = array( 'id_pembelian' => $id_pembelian );
		$this->M_dashboard->update_pembelian($params, $where);
		//
		if ( !$errors ) {
			// success
			$this->session->unset_userdata('cart');
			$this->session->set_flashdata('error_status', 'success');
			$this->session->set_flashdata('error_msg', "Yeyyy berhasil, isi data pengiriman dulu ya sis!");
			redirect('front/riwayat/alamat/'.$id_pembelian);
		} else {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', $errors);
			redirect('front/dashboard');
		}
	}
}