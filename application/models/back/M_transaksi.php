<?php

class M_transaksi extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	/////// DATA

	// jumlah_data
	public function jumlah_data(){
		$sql = "SELECT COUNT(a.id_pembelian) AS 'total'
		        FROM pembelian a
		        INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat 
		        INNER JOIN data_user c ON b.id_user = c.id_user";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
		    $result = $query->row_array();
		    $query->free_result();
		    return $result['total'];
		} else {
		    return 0;
		}
	}

	// jumlah_data_expaired
	public function jumlah_data_expaired(){
		$sql = "SELECT COUNT(a.id_pembelian) AS 'total'
		        FROM pembelian a
		        INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat 
		        INNER JOIN data_user c ON b.id_user = c.id_user
		        WHERE a.expire < now() and a.status_pembelian != 'Sudah dikirim' AND a.status_pembelian != 'Selesai'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
		    $result = $query->row_array();
		    $query->free_result();
		    return $result['total'];
		} else {
		    return 0;
		}
	}

	// get_all_transaksi_limit
	public function get_all_transaksi_limit($params) {
		$sql = "SELECT a.*, c.nama_lengkap
		        FROM pembelian a
		        INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat 
		        INNER JOIN data_user c ON b.id_user = c.id_user 
		        ORDER BY tgl_pembelian DESC
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

	// get_all_transaksi_expaired
	public function get_all_transaksi_expaired($params){
		$sql = "SELECT a.*, c.nama_lengkap
		        FROM pembelian a
		        INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat 
		        INNER JOIN data_user c ON b.id_user = c.id_user 
		        WHERE a.expire < now() and a.status_pembelian != 'Sudah dikirim' AND a.status_pembelian != 'Selesai'";

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
				LEFT JOIN data_alamat b ON a.id_alamat = b.id_alamat
				LEFT JOIN kecamatan c ON b.id_kec = c.id_kec
				LEFT JOIN kabupaten d ON c.id_kab = d.id_kab
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

	/////// CRUD
	// insert
	public function insert_pengiriman($params){
		return $this->db->insert('pengiriman',$params);
	}

	// update
	public function update_pengiriman($params, $where){
		return $this->db->update( 'pengiriman', $params, $where );
	}

	// update
	public function update_pembelian($params, $where){
		return $this->db->update( 'pembelian', $params, $where );
	}

	// delete
	public function delete_pembelian($where){
		return $this->db->delete('pembelian',$where);
	}

	// tambah_stok
	public function tambah_stok($id_produk, $jumlah) {
	    $this->db->set('stok', 'stok+'.$jumlah, FALSE);
	    $this->db->where('id_produk', $id_produk);
	    return $this->db->update('produk');
	}

	// kurangi_stok
	public function kurangi_stok($id_produk, $jumlah) {
	    $this->db->set('stok', 'stok-'.$jumlah, FALSE);
	    $this->db->where('id_produk', $id_produk);
	    return $this->db->update('produk');
	}

	// public function update_status_pembayaran($pembelian) {
	//     $this->db->set('status_bayar', 'Sudah bayar');
	//     $this->db->where('id_pembelian', $id_pembelian);
	//     return $this->db->update('pembelian');
	// }

	public function update_status_pembayaran($id_pembelian,$status_bayar) {
	    $this->db->set('status_bayar', $status_bayar);
	    $this->db->where('id_pembelian', $id_pembelian);
	    return $this->db->update('pembelian');
	}

}