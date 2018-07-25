<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model {

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
// kurangi_stok_produk
    function kurangi_stok_produk($jumlah, $id_produk) {
        $this->db->set('stok', 'stok-'.$jumlah, FALSE);
        $this->db->where('id_produk', $id_produk);
        return $this->db->update('produk');
    }

	// insert alamat
	function insert_data_alamat($params) {
		$this->db->insert('data_alamat', $params);
		return $this->db->insert_id();
	}
	
	// pembelian
	public function insert_pembelian($params) {
		$this->db->insert('pembelian', $params);
		return $this->db->insert_id();
	}

	// pembelian
	public function update_pembelian($params, $where) {
		return $this->db->update('pembelian', $params, $where);
	}

	// detail pembelian
	public function insert_detail_pembelian($params) {
		return $this->db->insert('detail_pembelian', $params);
	}

}