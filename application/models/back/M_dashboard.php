<?php

class M_dashboard extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	function chart_data(){
        $query = $this->db->query("SELECT  CASE MONTH(tgl_pembelian) 
        	WHEN '01' THEN 'Januari' 
        	WHEN '02' THEN 'Februari'
        	WHEN '03' THEN 'Maret' 
        	WHEN '04' THEN 'April' 
        	WHEN '05' THEN 'Mei' 
        	WHEN '06' THEN 'Juni' 
        	WHEN '07' THEN 'Juli' 
        	WHEN '08' THEN 'Agustus' 
        	WHEN '09' THEN 'September' 
        	WHEN '10' THEN 'Oktober' 
        	WHEN '11' THEN 'November' 
        	WHEN '12' THEN 'Desember' 
        	ELSE MONTH(tgl_pembelian) END AS bulan,SUM(total_bayar) AS jumlah FROM pembelian where status_bayar='Sudah bayar' group by MONTH(tgl_pembelian)");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function laporan_penjualan(){
    	return $this->db->query("select * from pembelian");
    }

    public function tampil_pembelian(){
    	$query=$this->db->query("SELECT a.*, c.nama_lengkap
		        FROM pembelian a
		        INNER JOIN data_alamat b ON a.id_alamat = b.id_alamat 
		        INNER JOIN data_user c ON b.id_user = c.id_user 
		        ORDER BY tgl_pembelian DESC");
    	return $query->result_array();
    }

    public function penjualan_today(){
        return $this->db->query("select sum(A.jumlah) as jumlah from detail_pembelian A inner join pembelian B on A.id_pembelian=B.id_pembelian where CONVERT(B.tgl_pembelian, DATE) = CONVERT(now(), DATE) and B.status_bayar='Sudah bayar'");
    }

    public function pendapatan_today(){
        return $this->db->query("select sum(total_bayar) as total_bayar from pembelian  where CONVERT(tgl_pembelian, DATE) = CONVERT(now(), DATE) and status_bayar='Sudah bayar'");
    }

    public function perlu_validasi(){
        return $this->db->query("select count(status_bayar) as jumlah from pembelian  where status_bayar='Menunggu Konfirmasi'");
    }

}