<?php

class Setting extends CI_Controller{

	public function __construct(){
		parent::__construct();
		// kembalikan ke halaman login jika user belum login atau level salah
		if ( !$this->session->userdata( 'staff' ) && !$this->session->userdata( 'staff' )['level'] ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Anda belum login!");
			// default redirect
			redirect("back/Login");
		}
		// load model
		$this->load->model('back/setting/M_setting');
	}

	public function about(){
		$this->load->view('back/include/header');
		$data['rs_about'] = $this->M_setting->get_com_preferences('about');
		$this->load->view('back/setting/content_about', $data);
		$this->load->view('back/include/footer');
	}

	public function about_process(){
		$where = array( 'id' => $this->input->post('id', TRUE) );
		$params = array( 'value' => $_POST['value'] );
		if ( $this->M_setting->update_com_preferences($params, $where) ) {
			// ----
			$this->session->set_flashdata('error_status', 'success');
			$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
		} else {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data gagal disimpan");
		}
		// default redirect
		redirect("back/setting/about");
	}

	public function help(){
		$this->load->view('back/include/header');
		$data['rs_line'] = $this->M_setting->get_com_preferences('admin_line');
		$data['rs_alamat'] = $this->M_setting->get_com_preferences('admin_alamat');
		$data['rs_telepon'] = $this->M_setting->get_com_preferences('admin_telepon');
		$data['rs_layanan'] = $this->M_setting->get_com_preferences('admin_layanan');
		$data['rs_maps'] = $this->M_setting->get_com_preferences('admin_maps');
		$this->load->view('back/setting/content_help', $data);
		$this->load->view('back/include/footer');
	}

	public function help_process(){
		$where = array( 'id' => $this->input->post('telepon_id', TRUE) );
		$params = array( 'value' => $this->input->post('telepon_value', TRUE) );
		$this->M_setting->update_com_preferences($params, $where);
		$where = array( 'id' => $this->input->post('line_id', TRUE) );
		$params = array( 'value' => $this->input->post('line_value', TRUE) );
		$this->M_setting->update_com_preferences($params, $where);
		$where = array( 'id' => $this->input->post('alamat_id', TRUE) );
		$params = array( 'value' => $this->input->post('alamat_value', TRUE) );
		$this->M_setting->update_com_preferences($params, $where);
		$where = array( 'id' => $this->input->post('layanan_id', TRUE) );
		$params = array( 'value' => $this->input->post('layanan_value', TRUE) );
		$this->M_setting->update_com_preferences($params, $where);
		$where = array( 'id' => $this->input->post('maps_id', TRUE) );
		$params = array( 'value' => $this->input->post('maps_value', TRUE) );
		$this->M_setting->update_com_preferences($params, $where);
		// ----
		$this->session->set_flashdata('error_status', 'success');
		$this->session->set_flashdata('error_msg', "Data berhasil disimpan");
		// default redirect
		redirect("back/setting/help");
	}
	
}