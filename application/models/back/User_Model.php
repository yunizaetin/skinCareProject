<?php

class User_Model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	// checkUser login
	public function checkUser($params) {
		$sql = "SELECT *
		        FROM data_user 
		        WHERE email = ? AND level = 1";
		$query = $this->db->query($sql, $params);
		if ($query->num_rows() > 0) {
		    $result = $query->row_array();
		    $query->free_result();
		    if ( md5($params[1]) == $result['password'] ) {
		    	return $result;
		    } else {
		    	return array();
		    }
		    return $result;
		} else {
		    return array();
		}
	}

}