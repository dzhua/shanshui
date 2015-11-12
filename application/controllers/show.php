<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		echo file_get_contents(dirname(__file__) . '/../../www' . $_SERVER['REQUEST_URI']);
	}
}