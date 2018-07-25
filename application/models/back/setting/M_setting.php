<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_setting extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	// com preferences
	public function get_com_preferences($params) {
		$sql = "SELECT * FROM com_preferences WHERE label LIKE ? LIMIT 1";
		$query = $this->db->query($sql, $params);
		if ( $query->num_rows() > 0) {
			$result = $query->row_array();
			$query->free_result();
			return $result;
		} else {
			return array();
		}
	}

	// update_com_preferences
	public function update_com_preferences($params, $where) {
		return $this->db->update('com_preferences', $params, $where);
	}

}

/* End of file  */
/* Location: ./application/models/ */