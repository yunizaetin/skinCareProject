<?php
/**
* 
*/
class User_Model extends CI_Model{
	var $db;
	var $tabel = 'data_user';

	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default', true);
	}

	public function cek_user($data){
			$query = $this->db->get_where('data_user', $data);
			return $query;
	}

	public function logout(){
		if(session_destroy()){
			$this->session->unset_userdata('id_user');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('password');  
			$this->session->unset_userdata('level'); 
			$this->session->unset_userdata($result);    
			$this->session->sess_destroy();
			redirect('front/Main/index');
		}
	}
}
?>