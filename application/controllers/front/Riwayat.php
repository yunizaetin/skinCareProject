<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Riwayat extends CI_Controller {
	public function __construct(){
		parent::__construct();
		// 
		if ( !$this->session->userdata('user_orvala') ) {
			redirect();
		}
		// load model
		$this->load->model('front/M_riwayat');
	}

	public function index(){
		$id_user = $this->session->userdata('user_orvala')['id_user'];
		/* start of pagination --------------------- */
		// pagination
		$this->load->library('pagination');
		$config['base_url'] 	= site_url("front/riwayat/index/");
		$config['total_rows'] 	= $this->M_riwayat->get_count_riwayat($id_user);
		$config['uri_segment'] 	= 4;
		$config['per_page'] 	= 10;
		$this->pagination->initialize($config);
		$pagination['data'] 	= $this->pagination->create_links();
		// pagination attribut
		$start 					= $this->uri->segment(4, 0) + 1;
		$end 					= $this->uri->segment(4, 0) + $config['per_page'];
		$end 					= (($end > $config['total_rows']) ? $config['total_rows'] : $end);
		$pagination['start'] 	= ($config['total_rows'] == 0) ? 0 : $start;
		$pagination['end'] 		= $end;
		$pagination['total'] 	= $config['total_rows'];
		// pagination assign value
		$data['pagination'] 	= $pagination;
		$data['no'] 			= $start;
		/* end of pagination ---------------------- */
		$data['rs_menubar'] = $this->M_riwayat->get_list_kategori();
		$this->load->view('front/main/header', $data);
		// get data
		$params 				= array($id_user, ($start - 1), $config['per_page']);
		$data['rs_id'] 			= $this->M_riwayat->get_list_riwayat_limit($params);
		$this->load->view('front/riwayat/index', $data);
		$this->load->view('front/main/footer');
	}

	public function detail( $id_pembelian ){
		$data['rs_menubar'] = $this->M_riwayat->get_list_kategori();
		$this->load->view('front/main/header', $data);
		// get data
		$detail = $this->M_riwayat->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('front/riwayat');
		}
		if ( $detail['status_pembelian'] == "Selesai" || $detail['status_pembelian'] == "Sudah dikirim" ) {
			redirect('front/riwayat/monitoring/'.$id_pembelian);
		}
		$data['detail'] = $detail;
		$this->load->view('front/riwayat/detail', $data);
		$this->load->view('front/main/footer');
	}

	public function alamat( $id_pembelian ){
		$data['rs_menubar'] = $this->M_riwayat->get_list_kategori();
		$this->load->view('front/main/header', $data);
		// get data
		$detail = $this->M_riwayat->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('front/riwayat');
		}
		if ( $detail['status_pembelian'] == "Selesai" || $detail['status_pembelian'] == "Sudah dikirim" ) {
			redirect('front/riwayat/monitoring/'.$id_pembelian);
		}
		$data['detail'] = $detail;
		$data['rs_provinsi'] = $this->M_riwayat->get_list_provinsi();
		$data['rs_kabupaten'] = $this->M_riwayat->get_list_kab_by_prov_id($detail['id_prov']);
		$data['rs_kecamatan'] = $this->M_riwayat->get_list_kec_by_kab_id($detail['id_kab']);
		// view
		$this->load->view('front/riwayat/alamat', $data);
		$this->load->view('front/main/footer');
	}

	// proses ubah alamat
	public function update_alamat_process(){
		$this->form_validation->set_rules('id_pembelian','ID Pembelian','trim|required|xss_clean');
		$this->form_validation->set_rules('id_alamat','ID Alamat','trim|xss_clean');
		$this->form_validation->set_rules('nama','Nama Pemilik','trim|required|xss_clean|max_length[30]');
		$this->form_validation->set_rules('no_hp','No. Handphone','trim|required|xss_clean|max_length[12]');
		$this->form_validation->set_rules('id_prov','Provinsi','trim|xss_clean|required');
		$this->form_validation->set_rules('id_kab','Kabupaten','trim|xss_clean|required');
		$this->form_validation->set_rules('id_kec','Kabupaten','trim|xss_clean');
		$this->form_validation->set_rules('nama_kec','Nama Kabupaten','trim|required|xss_clean');
		$this->form_validation->set_rules('detail_alamat','Detail ALamat','trim|required');
		// id pembelian
		$id_pembelian = $this->input->post('id_pembelian', TRUE);
		$id_alamat = $this->input->post('id_alamat', TRUE);
		// check
		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'nama' 	=> set_value('nama'),
				'no_hp'	=> set_value('no_hp'),
				'id_prov'	=> set_value('id_prov'),
				'id_kab'	=> set_value('id_kab'),
				'id_kec'	=> set_value('id_kec'),
				'nama_kec'	=> set_value('nama_kec'),
				'detail_alamat'	=> set_value('detail_alamat'),
			));
			// default redirect
			redirect("front/riwayat/alamat/".$id_pembelian);
		} else {
			$id_user = $this->session->userdata('user_orvala')['id_user'];
			$params = array(
				'nama' => $this->input->post('nama', TRUE),
				'no_hp' => $this->input->post('no_hp', TRUE),
				'detail_alamat' => $this->input->post('detail_alamat', TRUE),
				'id_kab' => $this->input->post('id_kab', TRUE),
				'id_kec' => $this->input->post('id_kec', TRUE),
				'nama_kec' => $this->input->post('nama_kec', TRUE),
				'id_user' => $id_user,
			);
			// update
			if ( $id_alamat ) {
				$where = array( 'id_alamat' => $id_alamat );
				if ( $this->M_riwayat->update_data_alamat($params, $where) ) {
                	$this->session->set_flashdata('error_status', 'success');
                    $this->session->set_flashdata('error_msg', "Data berhasil disimpan");
                    // default redirect
                    redirect("front/riwayat/konfirmasi/".$id_pembelian);
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Gagal menyimpan");
					// default redirect
					redirect("front/riwayat/alamat/".$id_pembelian);
				}
			// insert
			} else {
				$id_alamat = $this->M_riwayat->insert_data_alamat($params);
				if ( $id_alamat ) {
					$params = array( 'id_alamat' => $id_alamat );
					$where = array( 'id_pembelian' => $id_pembelian );
					$this->M_riwayat->update_pembelian($params, $where);
					// pesan
                	$this->session->set_flashdata('error_status', 'success');
                    $this->session->set_flashdata('error_msg', "Data berhasil disimpan");
                    // default redirect
                    redirect("front/riwayat/konfirmasi/".$id_pembelian);
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Gagal menyimpan");
					// default redirect
					redirect("front/riwayat/alamat/".$id_pembelian);
				}
			}
		}
		// default redirect
		redirect("front/riwayat/alamat/".$id_pembelian);
	}

	public function konfirmasi( $id_pembelian ){
		$data['rs_menubar'] = $this->M_riwayat->get_list_kategori();
		$this->load->view('front/main/header', $data);
		// get data
		$detail = $this->M_riwayat->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('front/riwayat');
		}
		if ( $detail['status_pembelian'] == "Selesai" || $detail['status_pembelian'] == "Sudah dikirim" ) {
			redirect('front/riwayat/monitoring/'.$id_pembelian);
		}
		$data['detail'] = $detail;
		//
		$data['transfer_rekening'] = $this->M_riwayat->get_com_preferences('transfer_rekening');
		$data['transfer_an'] = $this->M_riwayat->get_com_preferences('transfer_an');
		// view
		$this->load->view('front/riwayat/konfirmasi', $data);
		$this->load->view('front/main/footer');
	}

	// proses ubah konfirmasi
	public function update_konfirmasi_process(){
		// load libarary
		$this->load->library('upload');
		//
		$this->form_validation->set_rules('id_pembelian','ID Pembelian','trim|required|xss_clean');
		$this->form_validation->set_rules('id_konfirmasi','ID Konfirmasi','trim|xss_clean');
		$this->form_validation->set_rules('no_rek','No. Rekening','trim|required|xss_clean|max_length[20]');
		$this->form_validation->set_rules('atas_nama','Atas Nama','trim|required|xss_clean|max_length[30]');
		$this->form_validation->set_rules('jml_bayar','Jumlah Transfer','trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('bank_tujuan','Bank Tujuan','trim|required|xss_clean|max_length[30]');
		$this->form_validation->set_rules('tgl_bayar','Tanggal Transfer','trim|required|xss_clean');
		$this->form_validation->set_rules('keterangan','Keterangan Tambahan','trim|xss_clean');
		// id pembelian
		$id_pembelian = $this->input->post('id_pembelian', TRUE);
		$id_konfirmasi = $this->input->post('id_konfirmasi', TRUE);
		// get data
		$detail = $this->M_riwayat->get_pembelian_by_id($id_pembelian);
		//
		if ( $detail['expire'] < date('Y-m-d H:i:s') ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Opsss, transaksimu kadaluarsa sis, yuk transaki lagi!");
			// default redirect
			redirect("front/riwayat/konfirmasi/".$id_pembelian);
		}
		// check
		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// recent value
			$this->session->set_flashdata('temp_result', array(
				'no_rek' 	=> set_value('no_rek'),
				'atas_nama'	=> set_value('atas_nama'),
				'jml_bayar'	=> set_value('jml_bayar'),
				'bank_tujuan'	=> set_value('bank_tujuan'),
				'tgl_bayar'	=> set_value('tgl_bayar'),
				'keterangan'	=> set_value('keterangan'),
			));
			// default redirect
			redirect("front/riwayat/konfirmasi/".$id_pembelian);
		} else {
			if ( !$detail['url_konfirmasi'] && empty($_FILES['url_konfirmasi']['tmp_name']) ) {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Bukti bayar harus diupload");
				// recent value
				$this->session->set_flashdata('temp_result', array(
					'no_rek' 	=> set_value('no_rek'),
					'atas_nama'	=> set_value('atas_nama'),
					'jml_bayar'	=> set_value('jml_bayar'),
					'bank_tujuan'	=> set_value('bank_tujuan'),
					'tgl_bayar'	=> set_value('tgl_bayar'),
					'keterangan'	=> set_value('keterangan'),
				));
				// default redirect
				redirect("front/riwayat/konfirmasi/".$id_pembelian);
			}
			$params = array(
				'no_rek' => $this->input->post('no_rek', TRUE),
				'atas_nama' => $this->input->post('atas_nama', TRUE),
				'jml_bayar' => $this->input->post('jml_bayar', TRUE),
				'bank_tujuan' => $this->input->post('bank_tujuan', TRUE),
				'tgl_bayar' => $this->input->post('tgl_bayar', TRUE),
				'keterangan' => $this->input->post('keterangan', TRUE),
			);
			// update
			if ( $id_konfirmasi ) {
				// upload gambar
				if ( $_FILES['url_konfirmasi']['tmp_name'] ) {
					// upload gambar
					$break = explode('.', $_FILES['url_konfirmasi']['name']);
					$filename 					= "bukti_" . $id_konfirmasi . '.' . $break[1];
					$config['upload_path']      = './uploads/';
					$config['file_name']      	= $filename;
	                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
	                $config['max_size']         = 10000;
	                $this->upload->initialize($config);
	                // berhasil upload
	                if ( $this->upload->do_upload('url_konfirmasi')) {
	                    $params['url_konfirmasi'] = "uploads/" . $filename;
	                } else {
	                    // default error
	                    $this->session->set_flashdata('error_status', 'error');
	                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
	                    // default redirect
						redirect("front/riwayat/konfirmasi/".$id_pembelian);
	                }
				}
				// update
				$where = array( 'id_konfirmasi' => $id_konfirmasi );
				if ( $this->M_riwayat->update_konfirmasi($params, $where) ) {
					// update pembelian
					// $params = array( 'status_bayar' => 'Sudah bayar' );
					if ( $detail['status_pembelian'] != "Selesai" ) {
						$params = array('status_pembelian' => 'Sedang diproses');
						$where = array( 'id_pembelian' => $id_pembelian );
						$this->M_riwayat->update_pembelian($params, $where);
					}
					// pesan
                	$this->session->set_flashdata('error_status', 'success');
                    $this->session->set_flashdata('error_msg', "Data berhasil disimpan");
                    // default redirect
                    redirect("front/riwayat/monitoring/".$id_pembelian);
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Gagal menyimpan");
					// default redirect
					redirect("front/riwayat/konfirmasi/".$id_pembelian);
				}
			// insert
			} else {
				$params['id_pembelian'] = $id_pembelian;
				$id_konfirmasi = $this->M_riwayat->insert_konfirmasi($params);
				if ( $id_konfirmasi ) {
					// upload gambar
					$break = explode('.', $_FILES['url_konfirmasi']['name']);
					$filename 					= "bukti_" . $id_konfirmasi . '.' . $break[1];
					$config['upload_path']      = './uploads/';
					$config['file_name']      	= $filename;
	                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
	                $config['max_size']         = 10000;
	                $this->upload->initialize($config);
	                // berhasil upload
	                if ( $this->upload->do_upload('url_konfirmasi')) {
    					$params = array( 'url_konfirmasi' => "uploads/" . $filename );
    					$where = array( 'id_konfirmasi' => $id_konfirmasi );
    					$this->M_riwayat->update_konfirmasi($params, $where);
						// update pembelian
						$params = array( 'status_pembelian' => 'Sedang diproses' );
						$where = array( 'id_pembelian' => $id_pembelian );
						$this->M_riwayat->update_pembelian($params, $where);
						// pesan
    					// pesan
                    	$this->session->set_flashdata('error_status', 'success');
                        $this->session->set_flashdata('error_msg', "Data berhasil disimpan");
                        // default redirect
                        redirect("front/riwayat/monitoring/".$id_pembelian);
	                } else {
	                    // default error
	                    $this->session->set_flashdata('error_status', 'error');
	                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
	                    // default redirect
						redirect("front/riwayat/konfirmasi/".$id_pembelian);
	                }
				} else {
					// default error
					$this->session->set_flashdata('error_status', 'error');
					$this->session->set_flashdata('error_msg', "Gagal menyimpan");
					// default redirect
					redirect("front/riwayat/konfirmasi/".$id_pembelian);
				}
			}
		}
		// default redirect
		redirect("front/riwayat/konfirmasi/".$id_pembelian);
	}

	// proses delete bukti process
	public function delete_bukti_process($id_konfirmasi){
		$konfirmasi = $this->M_riwayat->get_konfirmasi_by_id($id_konfirmasi);
		if (!$konfirmasi) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('front/riwayat');
		}
		$params = array( 'url_konfirmasi' => NULL );
		$where = array( 'id_konfirmasi' => $id_konfirmasi );
		$this->M_riwayat->update_konfirmasi($params, $where);
		// pesan
    	$this->session->set_flashdata('error_status', 'success');
        $this->session->set_flashdata('error_msg', "Bukti berhasil dihapus");
        // default redirect
        redirect("front/riwayat/konfirmasi/".$konfirmasi['id_pembelian']);
	}

	// monitoring
	public function monitoring( $id_pembelian ){
		$data['rs_menubar'] = $this->M_riwayat->get_list_kategori();
		$this->load->view('front/main/header', $data);
		// get data
		$detail = $this->M_riwayat->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('front/riwayat');
		}
		$data['detail'] = $detail;
		// view
		$this->load->view('front/riwayat/monitoring', $data);
		$this->load->view('front/main/footer');
	}

	// delete
	public function delete( $id_pembelian ){
		$data['rs_menubar'] = $this->M_riwayat->get_list_kategori();
		$this->load->view('front/main/header', $data);
		// get data
		$detail = $this->M_riwayat->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('front/riwayat');
		}
		$data['detail'] = $detail;
		// view
		$this->load->view('front/riwayat/delete', $data);
		$this->load->view('front/main/footer');
	}

	// proses delete pembelian
	public function delete_process(){
		//
		$this->form_validation->set_rules('id_pembelian','ID Pembelian','trim|required|xss_clean');
		// id pembelian
		$id_pembelian = $this->input->post('id_pembelian', TRUE);
		// get data
		$detail = $this->M_riwayat->get_pembelian_by_id($id_pembelian);
		if ( !$detail ) {
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', "Data tidak ditemukan!");
			redirect('front/riwayat');
		}
		// check
		if($this->form_validation->run() == FALSE){
			// default error
			$this->session->set_flashdata('error_status', 'error');
			$this->session->set_flashdata('error_msg', validation_errors());
			// default redirect
			redirect("front/riwayat/delete/".$id_pembelian);
		} else {
			// delete
			$where = array( 'id_pembelian' => $id_pembelian );
			if ( $this->M_riwayat->delete_pembelian($where) ) {
				// pesan
	        	$this->session->set_flashdata('error_status', 'success');
	            $this->session->set_flashdata('error_msg', "Data berhasil dihapus");
	            // default redirect
	            redirect("front/riwayat");
			} else {
				// default error
				$this->session->set_flashdata('error_status', 'error');
				$this->session->set_flashdata('error_msg', "Gagal menghapus");
				// default redirect
				redirect("front/riwayat/delete/".$id_pembelian);
			}
		}
		// default redirect
		redirect("front/riwayat/delete/".$id_pembelian);
	}

	public function ajax_change_provinsi() {
		$id_prov = $this->input->get('id_prov', TRUE);
		$rs_kabupaten = $this->M_riwayat->get_list_kab_by_prov_id($id_prov);
		$html = '<option value="">-- Pilih Kabupaten --</option>';
		foreach ($rs_kabupaten as $kabupaten) {
			$html .= '<option value="'.$kabupaten['id_kab'].'">' . $kabupaten['nama_kab'] . '</option>';
		}
		echo $html;
	}

	public function ajax_change_kabupaten() {
		$id_kab = $this->input->get('id_kab', TRUE);
		$rs_kecamatan = $this->M_riwayat->get_list_kec_by_kab_id($id_kab);
		$html = '<option value="">-- Pilih Kecamatan --</option>';
		foreach ($rs_kecamatan as $kecamatan) {
			$html .= '<option value="'.$kecamatan['id_kec'].'">' . $kecamatan['nama_kec'] . '</option>';
		}
		echo $html;
	}

}