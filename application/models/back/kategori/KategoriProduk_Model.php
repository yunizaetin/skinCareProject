<?php

class KategoriProduk_Model extends CI_Model{

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
		return $this->db->get('menu_kategori')->num_rows();
	}

	// get_all_produk_limit
	public function get_all_produk_limit($params) {
		$sql = "SELECT *
		        FROM menu_kategori
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

	/*
	public function data($number,$offset){
		$this->db->select('*');
		$this->db->join('menu_kategori','menu_kategori.id_menu=produk.id_menu','left');
		return $query = $this->db->get('produk',$number,$offset)->result();		
	}
	*/
 
	// getDataById
	public function getDataById($id_menu){
		$sql = "SELECT * FROM menu_kategori where id_menu = ?";
		$query = $this->db->query($sql, $id_menu);
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
	public function ubahKategori($params, $where){
		return $this->db->update( 'menu_kategori', $params, $where );
	}

	// insert
	public function tambahKategori($params){
		$this->db->insert('menu_kategori',$params);
		return $this->db->insert_id();
	}

	// delete
	public function hapusKategori($where){
		return $this->db->delete('menu_kategori',$where);
	}

}