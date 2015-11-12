<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		print_r($_SERVER);
		echo file_get_contents(dirname(__file__) . '/../../www/index.html');
	}
}