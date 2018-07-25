<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// 
		if ( !$this->session->userdata('user_orvala') ) {
			redirect();
		}
		// load model
		$this->load->model('front/M_profil');
	}

	function index() {
		$data['rs_menubar'] = $this->M_profil->get_list_kategori();
		$this->load->view('front/main/header', $data);
		$this->load->view('front/profil/profil');		
		$this->load->view('front/main/footer');
	}
}