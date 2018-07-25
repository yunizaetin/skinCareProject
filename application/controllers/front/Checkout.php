<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkout extends CI_Controller {
	private $cart_harga, $cart_count;

	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->library(array('session'));
			$this->load->model(array('front/M_main'));

	}

	public function index(){
		$data['rs_menubar'] = $this->M_main->get_list_kategori();
		// print_r($data['rs_produk']); exit();
		// print_r($data); exit();
		$this->load->view('front/main/header', $data);
		$this->load->view('front/checkout/body');
		$this->load->view('front/main/footer');
	}

}