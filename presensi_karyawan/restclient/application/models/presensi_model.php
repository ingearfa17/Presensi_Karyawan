<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Insert data presensi
	function insert_presensi($data)
	{
		$this->db->insert('presensi', $data);
		return TRUE;
	}
		
	// Get data presensi
	function get_presensi()
    {
        $this->db->select('p.*, k.nama');
		$this->db->from('presensi p');
		$this->db->join('karyawan k','k.idkaryawan = p.idkaryawan');		
		$this->db->order_by('idpresensi','desc');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
    }
	
	// Get data rekap presensi	
	/*
	MySQL QUERY :
	SELECT `k`.`nama`, SUM(IF(jenis= 'masuk', 1, 0)) AS total_masuk, SUM(IF(jenis= 'keluar', 1, 0)) AS total_keluar 
	FROM (`presensi` p) 
	JOIN `karyawan` k ON `k`.`idkaryawan` = `p`.`idkaryawan` 
	GROUP BY `p`.`idkaryawan`
	*/
	function get_rekap_presensi()
    {
        $this->db->select('k.nama');
		$this->db->select_sum("IF(jenis= 'masuk', 1, 0)","total_masuk");		
		$this->db->select_sum("IF(jenis= 'keluar', 1, 0)","total_keluar");		
		$this->db->select_sum("IF(jenis= 'cuti', 1, 0)","total_cuti");
		$this->db->select_sum("IF(jenis= 'ijin', 1, 0)","total_ijin");
		$this->db->from('presensi p');
		$this->db->join('karyawan k','k.idkaryawan = p.idkaryawan');		
		$this->db->group_by('p.idkaryawan');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
    }		
}