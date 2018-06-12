<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		if($this->session->userdata('logged_in') === FALSE){
			redirect('admin');
		}
		$this->load->model('karyawan_model','karyawan_m');
		$this->limit	= 10;
    }
	
	public function index()
	{
		redirect('admin/karyawan/view');
	}
	
	public function view()
	{		
		$count = $this->karyawan_m->count_karyawan();	
		$uri_offset = 4;	
		$offset = $this->uri->segment($uri_offset);				
		$config['base_url'] 		= site_url('admin/karyawan/view/');
		$config['total_rows'] 		= $count;
		$config['per_page'] 		= $this->limit;
		$config['uri_segment'] 		= $uri_offset;		
		$this->pagination->initialize($config);	
		$paging = $this->pagination->create_links();
		
		$data_query = $this->karyawan_m->get_karyawan($this->limit, $offset);
		
		$data = array (		
			'main_content'	=> 'karyawan',
			'data_query'	=> $data_query,
			'paging'		=> $paging,
		);
		$this->load->view('admin/index',$data);
	}
	
	public function add()
	{		
		if($this->input->post()){
			$this->simpan_data();
		}				
		$data = array (		
			'main_content'	=> 'karyawan',
		);
		$this->load->view('admin/index',$data);
	}
	
	public function edit($id=0)
	{		
		$data_detail = $this->karyawan_m->get_karyawan_detail($id);
		if(!$data_detail){
			redirect('admin/karyawan');
		}
		
		if($this->input->post()){
			$this->simpan_data($id);
		}
				
		$data = array (		
			'main_content'	=> 'karyawan',
			'default'		=> $data_detail
		);
		$this->load->view('admin/index',$data);	
	}
	
	private function simpan_data($id=0)
	{
		$data_detail = $this->karyawan_m->get_karyawan_detail($id);		
		
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required');		
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		if ($this->form_validation->run() == TRUE){	
			if($data_detail && $data_detail['password'] == $this->input->post('password')){
				$password = $this->input->post('password');
			} else {
				$password = md5($this->input->post('password'));
			}
			$simpan_data = array(
				'nip'	=> $this->input->post('nip'),
				'nama'	=> $this->input->post('nama'),
				'password'	=> $password,
			);
			
			if($this->uri->segment(3)=='add'){			
				$this->karyawan_m->insert_karyawan($simpan_data);
				$this->session->set_flashdata('sukses', 'Data berhasil ditambahkan');
			}elseif($this->uri->segment(3)=='edit'){
				$this->karyawan_m->update_karyawan($simpan_data,$id);
				$this->session->set_flashdata('sukses', 'Data berhasil diedit');
			}
			redirect('admin/karyawan/view');
		}
	}
	
	public function delete($id)
	{
		$this->karyawan_m->delete_karyawan($id);
		$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		redirect('admin/karyawan/view');
	}
}