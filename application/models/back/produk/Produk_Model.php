<?php

class Produk_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	/////// DATA
	// getKategori
	public function getKategori(){
		$this->db->select('*');
		$query = $this->db->get('menu_kategori');
		return $query->result_array(); // pake result_array atau row array biar hasilnya jadi array
	}

	// jumlah_data
	public function jumlah_data(){
		return $this->db->get('produk')->num_rows();
	}

	// get_all_produk_limit
	public function get_all_produk_limit($params) {
		$sql = "SELECT *
		        FROM produk a 
		        INNER JOIN menu_kategori b ON a.id_menu = b.id_menu
		        ORDER BY a.nama_produk ASC
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

	public function data($number,$offset){
		$this->db->select('*');
		$this->db->join('menu_kategori','menu_kategori.id_menu=produk.id_menu','left');
		return $query = $this->db->get('produk',$number,$offset)->result();		
	}
 
	// getDataById
	public function getDataById($id_produk){
		$sql = "SELECT * FROM produk where id_produk = ?";
		$query = $this->db->query($sql, $id_produk);
		if ($query->num_rows() > 0) {
		    $result = $query->row_array();
		    $query->free_result();
		    return $result;
		} else {
		    return array();
		}
	}

	

	/////// CRUD
	// update
	public function ubahProduk($params, $where){
		return $this->db->update( 'produk', $params, $where );
	}

	// insert
	public function tambahProduk($params){
		$this->db->insert('produk',$params);
		return $this->db->insert_id();
	}

	// delete
	public function hapusProduk($where){
		return $this->db->delete('produk',$where);
	}

}