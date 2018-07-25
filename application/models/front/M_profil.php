<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_profil extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	// kategori menu bar
	public function get_list_kategori() {
		$sql = "SELECT * FROM menu_kategori 
				ORDER BY nama_kategori ASC";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

}