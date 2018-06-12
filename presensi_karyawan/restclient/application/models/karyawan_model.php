<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	// Presensi
	function karyawan_presensi($nip,$pass)
    {
		$this->db->select('*')->from('karyawan')->where('nip', $nip)->where('password', ($pass));
		$query = $this->db->get();		
		if ($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return FALSE;
		}
    }
	
	// Count data karyawan
	function count_karyawan()
	{										
		return $this->db->count_all_results('karyawan');
	}
	
	// Insert data karyawan
	function insert_karyawan($data)
	{
		$this->db->insert('karyawan', $data);
		return TRUE;
	}
	
	// Update data karyawan
	function update_karyawan($data,$id)
	{
		$this->db->where('idkaryawan', $id);
		$this->db->update('karyawan', $data); 
		return TRUE;
	}
	
	// Delete data karyawan
	function delete_karyawan($id)
	{
		$this->db->where('idkaryawan', $id);
		$this->db->delete('karyawan'); 
		return TRUE;
	}
	
	// Get data karyawan
	function get_karyawan($limit=0, $offset=0)
    {
        $this->db->select('*');
		$this->db->from('karyawan');
		$this->db->order_by('nama','asc');
		$this->db->limit($limit, $offset);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
    }
	
	// Get data karyawan detail by PK
	function get_karyawan_detail($id)
    {
        $this->db->select('*');
		$this->db->from('karyawan');
		$this->db->where('idkaryawan',$id);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return FALSE;
		}
    }	
}