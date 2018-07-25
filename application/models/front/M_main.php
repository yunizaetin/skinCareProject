<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_main extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	// list banner
	public function get_list_banner() {
		$sql = "SELECT * FROM data_promosi";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
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

	// com preferences
	public function get_com_preferences($params) {
		$sql = "SELECT * FROM com_preferences WHERE label LIKE ? LIMIT 1";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result['value'];
		} else {
			return '';
		}
	}

	// is exist email
	public function is_exist_email($params) {
		$sql = "SELECT * FROM data_user WHERE email LIKE ? LIMIT 1";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return true;
		} else {
			return false;
		}
	}

	// cek user ada atau tidak
	// paramas 0 : username, 1 : password
	public function check_user($params) {
		$sql = "SELECT * FROM data_user WHERE email LIKE ? AND level = '0' LIMIT 1";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			if ( $result['password'] === md5($params[1]) ) {
				return $result;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


	public function get_user_aktivasi($params) {
		$sql = "SELECT * FROM data_user WHERE link_aktif = ? LIMIT 1";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// get list populer produk
	public function get_list_populer_produk($params) {
		$sql = "SELECT a.id_produk, a.nama_produk, FORMAT(a.harga, 0) AS 'harga', a.stok, a.url_image, c.nama_kategori 
				FROM produk a
				LEFT JOIN detail_pembelian b ON a.id_produk = b.id_produk
				INNER JOIN menu_kategori c ON a.id_menu = c.id_menu
				GROUP BY a.id_produk
				ORDER BY COUNT(b.id_produk) DESC
				LIMIT ?";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// get list new produk
	public function get_list_new_produk($params) {
		$sql = "SELECT a.id_produk, a.nama_produk, FORMAT(a.harga, 0) AS 'harga', a.stok, a.url_image, c.nama_kategori 
				FROM produk a
				INNER JOIN menu_kategori c ON a.id_menu = c.id_menu
				ORDER BY a.id_produk DESC
				LIMIT ?";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	/* CRUD */
	function insert_data_user($params) {
		$this->db->insert('data_user', $params);
		return $this->db->insert_id();
	}

	function update_data_user($params, $where) {
		return $this->db->update('data_user', $params, $where);
	}

}

/* End of file  */
/* Location: ./application/models/ */