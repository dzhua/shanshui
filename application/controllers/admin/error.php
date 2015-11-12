<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function index() {
		$data['title'] = '找不到相关内容！';
		echo 'xxxxxxxxxx';die;
		$data['main_content'] = $this->load->view('error', $data, TRUE);
		$this->load->view('template', $data);
	}
}