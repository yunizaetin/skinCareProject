<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_produk extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	// jumlah_data
	public function jumlah_data(){
		return $this->db->get('produk')->num_rows();
	}

	// tampilkan produk berdasar kategori
	public function get_produk_by_id_menu($id_menu) {
		$sql = "SELECT a.id_produk, a.nama_produk, FORMAT(a.harga, 0) AS 'harga', a.stok, a.url_image, b.nama_kategori
				FROM produk a 
				INNER JOIN menu_kategori b ON a.id_menu = b.id_menu
				WHERE a.id_menu = ? 
				ORDER BY a.nama_produk ASC";
		$query = $this->db->query($sql, $id_menu);
		// echo $this->db->last_query(); exit();
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
		
	}

	// kategori detail
	public function get_kategori_by_id($id_menu) {
		$sql = "SELECT * FROM menu_kategori 
				WHERE id_menu = ?";
		$query = $this->db->query($sql, $id_menu);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
		
	}

	// detail produk
	public function get_produk_by_id($id_produk) {
		$sql = "SELECT * FROM produk 
				WHERE id_produk = ?";
		$query = $this->db->query($sql, $id_produk);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
		
	}

}

/* End of file  */
/* Location: ./application/models/ */