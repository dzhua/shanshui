<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (IS_DEBUG === TRUE) 
			$this->output->enable_profiler(TRUE);
	}
	
	public function index() {
		$data['menu'] 			= 'main';
		$data['sub_menu'] 		= 'main';
		$data['main_content'] = $this->load->view('admin/dashboard', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function out() {
		$this->session->sess_destroy();
		
		redirect('/admin/login');
	}
}