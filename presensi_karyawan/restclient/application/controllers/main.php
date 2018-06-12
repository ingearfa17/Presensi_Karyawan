<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
		$this->load->model('karyawan_model','karyawan_m');
		$this->load->model('presensi_model','presensi_m');
    }
	
	public function index()
	{
		if($this->input->post()){
			$this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
			$this->form_validation->set_rules('jenis', 'Jenis', 'required');		
			$this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == TRUE){
				$check = $this->karyawan_m->karyawan_presensi($this->input->post('nip'),$this->input->post('password'));				
				$simpan_data = array(
					'idkaryawan' => $check['idkaryawan'],
					'waktu'		 => time(),
					'jenis'		 => $this->input->post('jenis')
				);
				
				$this->presensi_m->insert_presensi($simpan_data);$this->session->set_flashdata('sukses', 'Presensi telah berhasil dilakukan');			
				redirect('');
			}
		}
		$data = array(
			'data_presensi' => $this->presensi_m->get_presensi()
		);
		$this->load->view('index',$data);
	}
	
	public function password_check($password)
	{
		$nip = $this->input->post('nip');
		$check = $this->karyawan_m->karyawan_presensi($nip,$password);
		
		if(!$check){
			$this->form_validation->set_message('password_check', '%s Wroong !!!');
			return FALSE;
		}else{
			return TRUE;
		}
	}

}
