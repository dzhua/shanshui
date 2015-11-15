<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	var $admin_id = '';
	
	public function __construct() {
		parent::__construct();
		
// 		$this->admin_id = $this->session->admindata('admin_id');
		
// 		if (empty($this->admin_id))
// 			redirect('/admin/login');
		
		$this->load->model('admin/admin_model');
		
		if (IS_DEBUG === TRUE) 
			$this->output->enable_profiler(TRUE);
	}
	
	public function index() {
		$data['admin_list'] 	= $this->admin_model->sel_admin_list();		
		$data['menu'] 			= 'admin';
		$data['sub_menu'] 		= 'admin_list';
		$data['main_content'] = $this->load->view('admin/admin_list', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function create() {
		$data['menu'] = 'admin';
		$data['sub_menu'] = 'admin_list';
		
		$data['main_content'] = $this->load->view('admin/admin_create', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function do_create() {
		$admin_name		= trim($this->input->post('admin_name'));
		$password		= trim($this->input->post('password'));
		$repassword		= trim($this->input->post('repassword'));
		$company_name	= trim($this->input->post('company_name'));
		$IDnumber		= trim($this->input->post('IDnumber'));
		$linkman		= trim($this->input->post('linkman'));
		$tel		= trim($this->input->post('tel'));
		$mobile		= trim($this->input->post('mobile'));
		$email		= trim($this->input->post('email'));
		$fax		= trim($this->input->post('fax'));
		$qq			= trim($this->input->post('qq'));
		$address	= trim($this->input->post('address'));
		$introduce	= trim($this->input->post('introduce'));
		
		if($password != $repassword) {
			exit();
		}
		
		$admin_account = array(
			'admin_name'	=> $admin_name,
			'password'	=> md5($password),
			'status'	=> 0,
			'create_time'	=> time(),
			'update_time'	=> time()
		);
		
		$admin_account_id = $this->common_model->ins_data('admin_account', $admin_account);
		
		if ($admin_account_id) {
			$admin_info = array(
				'account_id'	=> $admin_account_id,
				'company_name'	=> $company_name,
				'IDnumber'		=> $IDnumber,
				'linkman'		=> $linkman,
				'tel'			=> $tel,
				'mobile'		=> $mobile,
				'email'			=> $email,
				'fax'			=> $fax,
				'qq'			=> $qq,
				'city'			=> '',
				'area'			=> '',
				'district'		=> '',
				'address'		=> $address,
				'introduce'		=> $introduce,
				'status'		=> 0,
				'create_time'	=> time(),
				'update_time'	=> time()
			);
			
			$this->common_model->ins_data('admin_info', $admin_info);
		}
		
		redirect('/admin/admin/create');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function upd() {
		$id = $this->uri->segment ( 4 );
		if(empty($id)) redirect('/admin/news');

		$data = $this->common_model->sel_data('news', array('id' => $id));
		$data['menu'] = 'news';
		$data['sub_menu'] = 'news_list';
		
		$data['main_content'] = $this->load->view('admin/news_edit', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function do_upd() {
		$id			= trim($this->input->post('id'));
		$title		= trim($this->input->post('title'));
		$content	= trim($this->input->post('content'));

		if(empty($id)) redirect('/admin/news');
		
		$news = array(
			'title'		=> $title,
			'content'	=> $content
		);
		
		if ($_FILES['adminfile']['name']) {	
			$tmp_name 	= $_FILES['adminfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_NEWS_UPLOAD_PATH;
		
			if ( ! file_exists($file_path))
				@mkdir($file_path);
		
			if(move_uploaded_file($tmp_name, $file_path.$file_name)){
				$path = $file_path.$file_name;
		
				if( file_exists($path) ){
		
					//生成3类图片开始
					$pic=getimagesize($path);
					$image_width=$pic["0"]; //获取图片的宽
					$image_height=$pic["1"];//获取图片的高
		
					// 1024 x 1024
					if ($image_width >= 1024 || $image_height >= 1024) {
						if ($image_width / $image_height > 1024 / 1024) {
							$this->_do_image ( '_l', $path, 1024, 1024 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 1024 / 1024) {
							$this->_do_image ( '_l', $path, 1024 * ($image_width / $image_height), 1024 );
						}
					} else {
						$this->_do_image ( '_l', $path, $image_width, $image_height );
					}
						
					// 214 x 140
					if ($image_width >= 214 || $image_height >= 140) {
						if ($image_width / $image_height > 214 / 140) {
							$this->_do_image ( '_m', $path, 214, 214 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 214 / 140) {
							$this->_do_image ( '_m', $path, 140 * ($image_width / $image_height), 140 );
						}
					} else {
						$this->_do_image ( '_m', $path, $image_width, $image_height );
					}
		
					$news['img_name'] = IMG_NEWS_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$news['create_time'] = time();
		$news_id = $this->common_model->upd_data('news', array('id' => $id), $news);
		
		redirect('/admin/news/add');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function del() {
		$id = $this->uri->segment ( 4 );
		$this->common_model->upd_data('news', array('id' => $id), array('status' => 0));
		
		redirect('/admin/news');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function rand() {
		$news = $this->news_model->sel_news_rand();
		
		foreach ($news as $key=>$val) {
			$news[$key]['img_name'] = get_thumb_pic($val['img_name'], 'm');
			$news[$key]['content'] = cut_str($val['content'], 50);
		}
		
		echo json_encode($news);
	}
	
	// ------------------------------------------------------------------------------------------------------------

	//图片处理缩图
	private function _do_image($thumb_marker, $image_name, $width=0, $height=0)
	{
		$this->load->library('image_lib');
		$config['image_library']= 'GD2';
		$config['source_image'] = $image_name;
		$config['width'] 		= $width;
		$config['height'] 		= $height;
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = $thumb_marker;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
}