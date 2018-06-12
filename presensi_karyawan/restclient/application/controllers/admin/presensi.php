<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presensi extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		if($this->session->userdata('logged_in') === FALSE){
			redirect('admin');
		}
		$this->load->model('presensi_model','presensi_m');
    }
	
	public function index()
	{
		redirect('admin/presensi/view');
	}
	
	public function view()
	{			
		$data_query = $this->presensi_m->get_rekap_presensi();
		$data = array (		
			'main_content'	=> 'presensi',
			'data_query'	=> $data_query,
		);
		$this->load->view('admin/index',$data);
	}	
	
	public function grafik()
	{			
		$data_query = $this->presensi_m->get_rekap_presensi();
		$nama = array();
		$masuk = array();
		$keluar = array();
		$cuti = array();
		$ijin = array();
		if($data_query){
			foreach($data_query as $dt){
				 $nama[] = $dt['nama'];
				 $masuk[] = $dt['total_masuk'];
				 $keluar[] = $dt['total_keluar'];
				 $cuti[] = $dt['total_cuti'];
				 $ijin[] = $dt['total_ijin'];
			}
		}
		$data = array (		
			'main_content'	=> 'presensi',
			'data_rekap'	=> array(
				'nama'=>json_encode($nama),
				'masuk'=>json_encode($masuk),
				'keluar'=>json_encode($keluar),
				'cuti'=>json_encode($cuti),
				'ijin'=>json_encode($ijin),
			),
		);
		$this->load->view('admin/index',$data);
	}
}