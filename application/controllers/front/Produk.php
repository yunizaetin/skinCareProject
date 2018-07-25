<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Produk extends CI_Controller {
	private $cart_harga, $cart_count;

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model(array('front/M_main', 'front/M_produk'));
		$this->load->library(array('session'));
	}

	public function index( $id_menu = '' ){

		/* start of pagination --------------------- */
		// pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url("front/Produk/index/");
		$config['total_rows'] 	= $this->M_produk->jumlah_data();
		$config['uri_segment'] 	= 4;
		$config['per_page'] 	= 12;
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

		if ( empty($id_menu) ) {
			redirect( site_url() );
		}
		$data['rs_menubar'] = $this->M_main->get_list_kategori();
		// data produk per kategori
		$rs_produk = $this->M_produk->get_produk_by_id_menu($id_menu);
		foreach ($rs_produk as $i => $produk) {
			if ( file_exists('uploads/' . $produk['url_image']) && $produk['url_image'] ) {
				$rs_produk[$i]['image'] = 'uploads/' . $produk['url_image'];
			} else {
				$rs_produk[$i]['image'] = 'assets/front/images/img_default.jpg';
			}
		}
		$data['rs_produk'] = $rs_produk;
		$data['kategori'] = $this->M_produk->get_kategori_by_id($id_menu);
		$data['cart'] = array(
			'harga' => $this->cart_harga,
			'count' => $this->cart_count,
			);
		
		$this->load->view('front/main/header', $data);
		$this->load->view('front/produk/body');
		$this->load->view('front/main/footer');
	}

	public function detail( $id_produk = '' ){
		if ( empty($id_produk) ) {
			redirect( site_url() );
		}
		$data['rs_menubar'] = $this->M_main->get_list_kategori();
		$this->load->view('front/main/header', $data);
		$data['produk'] = $this->M_produk->get_produk_by_id($id_produk);
		
		$this->load->view('front/produk/detail', $data);
		$this->load->view('front/main/footer');
	}

	public function add_cart( $id_produk = '', $qty=0 ){
		if ( empty($id_produk) ) {
			redirect( site_url() );
		}
		$produk = $this->M_produk->get_produk_by_id($id_produk);
		$rs_cart = $this->session->userdata('cart') ? $this->session->userdata('cart')['data'] : array();
		$cart_price = 0;
		$cart_count = 0;
		$result = array();
		$flag = true;
		//
		if ( $rs_cart ) {
			foreach ($rs_cart as $cart) {
				if ( $cart['id'] == $id_produk ) {
					$cart['qty'] += $qty;
					$flag = false;
				}
				$cart_count += $cart['qty'];
				$cart_price += $cart['qty'] * $cart['price'];
				$result[] = $cart;
			}
		}
		if ( $flag ) {
			$params = array(
		        'id'      => $id_produk,
		        'qty'     => $qty,
		        'price'   => $produk['harga'],
		        'name'    => $produk['nama_produk']
			);
			$cart_count += $qty;
			$cart_price += $qty * $produk['harga'];
			$result[] = $params;
		}
		// echo "<pre>";
		// print_r($result);
		// echo "</pre>";
		// exit();
		// exit();
		// set sesi
		$this->session->set_userdata('cart', array(
			'data' => $result,
			'price' => "Rp " . number_format($cart_price, 0, ',', '.'),
			'count' => $cart_count
		));
		// 
		$this->popup_redirect('Selamat sis, pilihanmu berhasil ditambahkan ke keranjang!', site_url().'front/produk/detail/'.$id_produk);
	}

	public function remove_cart_process( $id_produk = '' ){
		if ( empty($id_produk) ) {
			redirect( site_url() );
		}
		$rs_cart = $this->session->userdata('cart') ? $this->session->userdata('cart')['data'] : array();
		$cart_price = 0;
		$cart_count = 0;
		$result = array();
		//
		if ( $rs_cart ) {
			foreach ($rs_cart as $cart) {
				if ( $cart['id'] != $id_produk ) {
					$cart_count += $cart['qty'];
					$cart_price += $cart['qty'] * $cart['price'];
					$result[] = $cart;
				}
			}
		}
		// set sesi
		$this->session->set_userdata('cart', array(
			'data' => $result,
			'price' => "Rp " . number_format($cart_price, 0, ',', '.'),
			'count' => $cart_count
		));
		// 
		redirect( site_url().'front/dashboard/' );
	}

	// custom redirect
	protected function popup_redirect($msg="", $url="") {
		if (empty($url)) {
			$url = site_url();
		}
		echo '<script type="text/javascript">';
		echo 'window.alert("'.$msg.'");';
		echo 'window.location = "'.$url.'";';
		echo '</script>';
	}

}
