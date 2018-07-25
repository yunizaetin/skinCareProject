<?php

class Login extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('back/User_Model');
	}

	public function index(){
		$this->load->view('back/include/header_login');
		$this->load->view('back/content_login');
		$this->load->view('back/include/footer_login');
	}

	// proses login
	public function loginProcess(){
		$this->form_validation->set_rules('email','Email','required|xss_clean');
		$this->form_validation->set_rules('password','Password','required|xss_clean');

		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// default redirect
			redirect("back/Login");
		} else {
			// set data
			$params 	= array( $this->input->post('email'), $this->input->post('password') );
			$data_user 	= $this->User_Model->checkUser($params);
			if ( $data_user ) {
				$this->session->set_userdata( 'staff', $data_user );
				// default redirect
				redirect("back/Dashboard");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Email / Password Salah!");
				// default redirect
				redirect("back/Login");
			}
		}
		// default redirect
		redirect("back/Login");
	}

	// public function cekLogin(){
	// 	$data = array('email' => htmlentities($_POST['username']),
	// 					'password' => ($_POST['password'])
	// 		);
	// 	$hasil = $this->User_Model->cek_user($data);
	// 	if ($hasil) { //->num_rows() == 1) {
	// 		foreach ($hasil->result() as $sess) {
	// 			$sess_data['id_user'] = $sess->id_user;
	// 			$sess_data['email'] = $sess->email;
	// 			$sess_data['password'] = $sess->password;
	// 			$sess_data['level'] = $sess->level;
	// 			$sess_data['nama_lengkap'] = $sess->nama_lengkap;
	// 			$sess_data['tgl_lahir'] = $sess->tgl_lahir;
	// 			$sess_data['jenis_kelamin'] = $sess->jenis_kelamin;
	// 			$sess_data['no_hp'] = $sess->no_hp;
	// 			$this->session->set_userdata($sess_data);
	// 	//helper_log("login", "masuk ke sistem");
	// 			}
	// 		if ($this->session->userdata('level')==1) {
	// 			redirect('back/Dashboard/index');
	// 		}
	// 		elseif ($this->session->userdata('level') == 0){
	// 			echo "3";
	// 		}
	// 		else {
	// 			echo "sallah";
	// 		//echo "kosong";
	// 			//header('location:'.base_url().'login/login/0');
	// 		}
 //  		}
	// }
}