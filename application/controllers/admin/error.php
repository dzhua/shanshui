<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function index() {
		$data['title'] = 'Page Not Found！';
		$data['main_content'] = $this->load->view('admin/error', $data, TRUE);
		$this->load->view('admin/template', $data);
	}
}