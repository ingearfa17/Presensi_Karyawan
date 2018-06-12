<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
    {
        parent::__construct();
    }
	
	public function index()
	{
		if($this->input->post('login')){
			$username 	= $this->input->post('username');
			$pass	= $this->input->post('password');

			if($username == 'admin' && $pass == 'admin'){
				$sesion_data = array(
                   'user'  		=> 'Admin',
                   'logged_in' 	=> TRUE
               	);

				$this->session->set_userdata($sesion_data);
			}
		}
		$data = array (		
			'main_content'	=> 'welcome',
		);
		$this->load->view('admin/index',$data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin');
	}			
}
