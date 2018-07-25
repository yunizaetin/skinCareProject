<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_riwayat extends CI_Model {

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

	// jumlah_data
	public function get_count_riwayat($params){
		$sql = "SELECT COUNT(a.id_pembelian) 'total'
		        FROM pembelian a
		        INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat
		        WHERE b.id_user = ?
		        ORDER BY a.tgl_pembelian DESC";
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
		    $result = $query->row_array();
		    $query->free_result();
		    return $result['total'];
		} else {
		    return 0;
		}
	}

	// get_list_riwayat_limit
	public function get_list_riwayat_limit($params) {
		$sql = "SELECT a.*, c.id_konfirmasi, b.id_kab
		        FROM pembelian a
		        INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat
		        LEFT JOIN konfirmasi c ON c.id_pembelian = a.id_pembelian
		        WHERE b.id_user = ?
		        ORDER BY a.tgl_pembelian DESC
		        LIMIT ?,?";
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
		    $result = $query->result_array();
		    $query->free_result();
		    return $result;
		} else {
		    return array();
		}
	}

	// get pembelian
	public function get_pembelian_by_id($params) {
		$sql = "SELECT a.*, b.nama, b.no_hp, b.detail_alamat, c.nama_kec, d.nama_kab, e.nama_prov, f.id_kirim, 
				f.tgl_kirim, f.no_resi, f.ket_kirim, g.tgl_bayar, g.bank_tujuan, g.jml_bayar,
				g.no_rek, g.atas_nama, g.keterangan, g.url_konfirmasi, g.id_konfirmasi, c.id_kec, d.id_kab, e.id_prov, b.nama_kec
				FROM pembelian a
				INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat
				LEFT JOIN kecamatan c ON b.id_kec = c.id_kec
				LEFT JOIN kabupaten d ON b.id_kab = d.id_kab
				LEFT JOIN provinsi e ON d.id_prov = e.id_prov
				LEFT JOIN pengiriman f ON a.id_pembelian = f.id_pembelian
				LEFT JOIN konfirmasi g ON a.id_pembelian = g.id_pembelian
				WHERE a.id_pembelian = ?
				ORDER BY a.id_pembelian DESC
				LIMIT 1";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			$result['detail'] = $this->get_detail_pembelian($result['id_pembelian']);
			return $result;
		} else {
			return array();
		}
	}

	// get detail pembelian
	public function get_detail_pembelian($params) {
		$sql = "SELECT a.id_detail, a.jumlah, b.nama_produk, b.harga, b.stok, b.url_image, c.nama_kategori, b.id_produk
				FROM detail_pembelian a
				LEFT JOIN produk b ON a.id_produk = b.id_produk
				LEFT JOIN menu_kategori c ON b.id_menu = c.id_menu
				WHERE a.id_pembelian = ?";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// get_list_provinsi
	public function get_list_provinsi() {
		$sql = "SELECT *
				FROM provinsi";
		$query = $this->db->query($sql);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// get_list_kab_by_prov_id
	public function get_list_kab_by_prov_id($params) {
		$sql = "SELECT *
				FROM kabupaten
				WHERE id_prov = ?";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// get_list_kec_by_kab_id
	public function get_list_kec_by_kab_id($params) {
		$sql = "SELECT *
				FROM kecamatan
				WHERE id_kab = ?";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->result_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// get konfirmasi by id
	public function get_konfirmasi_by_id($params) {
		$sql = "SELECT *
				FROM konfirmasi
				WHERE id_konfirmasi = ?";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// get_com_preferences
	public function get_com_preferences($params) {
		$sql = "SELECT *
				FROM com_preferences
				WHERE label = ?";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result['value'];
		} else {
			return '';
		}
	}

	// CRUD
	// insert alamat
	function insert_data_alamat($params) {
		$this->db->insert('data_alamat', $params);
		return $this->db->insert_id();
	}

	// update alamat
	function update_data_alamat($params, $where) {
		return $this->db->update('data_alamat', $params, $where);
	}

	// update pembelian
	function update_pembelian($params, $where) {
		return $this->db->update('pembelian', $params, $where);
	}

	// delete pembelian
	function delete_pembelian($where) {
		return $this->db->delete('pembelian', $where);
	}

	// insert konfirmasi
	function insert_konfirmasi($params) {
		$this->db->insert('konfirmasi', $params);
		return $this->db->insert_id();
	}

	// update konfirmasi
	function update_konfirmasi($params, $where) {
		return $this->db->update('konfirmasi', $params, $where);
	}

}