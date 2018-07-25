<?php

class Pengguna_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	/////// DATA
	// getKategori
	public function getKategori(){
		$this->db->select('*');
		$query = $this->db->get('data_user');
		return $query->result_array(); // pake result_array atau row array biar hasilnya jadi array
	}

	// jumlah_data
	public function jumlah_data(){
		return $this->db->get('data_user')->num_rows();
	}

	// get_all_produk_limit
	public function get_all_produk_limit($params) {
		$sql = "SELECT *
		        FROM data_user 
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

	/*public function data($number,$offset){
		$this->db->select('*');
		$this->db->join('data_user','menu_kategori.id_menu=produk.id_menu','left');
		return $query = $this->db->get('produk',$number,$offset)->result();		
	}
	*/
 
	// getDataById
	public function getDataById($id_user){
		$sql = "SELECT * FROM data_user where id_user = ?";
		$query = $this->db->query($sql, $id_user);
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
	public function ubahPengguna($params, $where){
		return $this->db->update( 'data_user', $params, $where );
	}

	// insert
	public function tambahPengguna($params){
		$this->db->insert('data_user',$params);
		return $this->db->insert_id();
	}

	// delete
	public function hapusPengguna($where){
		return $this->db->delete('data_user',$where);
	}

}