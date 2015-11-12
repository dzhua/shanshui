<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
		if (IS_DEBUG === TRUE) 
			$this->output->enable_profiler(TRUE);
	}
	
	public function index() {
		if ( ! empty($_POST)) {
			$name = strip_tags(trim($this->input->post('name')));
			$password = strip_tags(trim($this->input->post('password')));

			$admin = $this->common_model->sel_data('admin', array('name' => $name, 'password' => md5($password)), 'id,name');
			
			if ($admin !== FALSE) {
				$this->session->set_userdata(array('admin_id' => $admin['id']));
				$this->session->set_userdata(array('admin_name' => $admin['name']));
				
				// 统计信息
				$statistics = $this->common_model->sel_statistics_data();
				$this->session->set_userdata('statistics', $statistics);
				
				redirect('/admin/news');
			}else {
				$data['error'] = TRUE;
				$this->load->view('admin/login', $data);
			}
		} else {
			$this->load->view('admin/login');		
		}
	}
	
	public function out() {
		$this->session->sess_destroy();
		
		redirect('/admin/login');
	}
}