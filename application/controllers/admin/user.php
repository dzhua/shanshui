<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	var $admin_id = '';
	
	public function __construct() {
		parent::__construct();
		
// 		$this->admin_id = $this->session->userdata('admin_id');
		
// 		if (empty($this->admin_id))
// 			redirect('/admin/login');
		
		$this->load->model('admin/user_model');
		
		if (IS_DEBUG === TRUE) 
			$this->output->enable_profiler(TRUE);
	}
	
	public function index() {
		$keyword = $this->uri->segment ( 3 );
		$uri_segment = 4;	
		$current_page = $this->uri->segment ( $uri_segment );
		
	 	/*每页记录数*/
		$psize = 1; 
		if ($current_page > 1) {
			$offset = ($current_page - 1) * $psize;
		} else {
			$current_page = 1;
			$offset = 0;
		}
		$keywords = empty($keyword) ? 0 : explode('_', $keyword);
		$where = array(
			'user_name'	=> $keywords[0],
			'tel'		=> $keywords[1]
		);
		$num = $this->user_model->sel_user_count($where);
		
		$data['current_page']	= $current_page;
		$data['page_count'] = $page_count = ceil($num/$psize);

		// 处理分页  超出五页当前页放中间
		if ($page_count > 5) {
			if ($current_page >= 4){
				$data['page_start'] = $current_page-2;
				
				if ($page_count >= ($current_page+2)) {
					$data['page_end']   = $current_page+2;
				} elseif ($page_count == ($current_page+1)) {
					$data['page_end']   = $current_page+1;
				} else 
					$data['page_end']	= $page_count;
			} else {
				$data['page_start'] = 1;
				$data['page_end']   = 5;				
			}
		} else {
			$data['page_start'] = 1;
			$data['page_end']   = $page_count;
		}

		// 上一页
		$data['prev_page'] = $current_page == 1 ? 1 : $current_page-1;
		
		// 下一页
		$data['next_page'] = $current_page < $page_count ? $current_page+1 : $page_count;
		
		$data['user_list'] 	= $this->user_model->sel_user_list($where, $offset, $psize);
		foreach ($data['user_list'] as $key=>$val) {
			switch ($val['status']) {
				case 1:
					$data['user_list'][$key]['status'] = '审核通过';
				break;
				case 2:
					$data['user_list'][$key]['status'] = '审核未通过';
				break;
				default:
					$data['user_list'][$key]['status'] = '未审核';
				break;
			}
		}
		
		$data['menu'] 			= 'user';
		$data['sub_menu'] 		= 'user_list';
		$data['keyword'] 		= $where;
		$data['main_content'] = $this->load->view('admin/user_list', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function create() {
		$data['menu'] = 'user';
		$data['sub_menu'] = 'user_list';
		
		$data['main_content'] = $this->load->view('admin/user_create', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function do_create() {
		$user_name		= trim($this->input->post('user_name'));
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
		
		$user_account = array(
			'user_name'	=> $user_name,
			'password'	=> md5($password),
			'status'	=> 0,
			'create_time'	=> time(),
			'update_time'	=> time()
		);
		
		$user_account_id = $this->common_model->ins_data('user_account', $user_account);
		
		if ($user_account_id) {
			$user_info = array(
				'account_id'	=> $user_account_id,
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
			
			$this->common_model->ins_data('user_info', $user_info);
		}
		
		redirect('/admin/user/create');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function upd() {
		$id = $this->uri->segment ( 4 );
		if(empty($id)) redirect('/admin/user');

		$data = $this->common_model->sel_data('user', array('id' => $id));
		$data['menu'] = 'user';
		$data['sub_menu'] = 'user_list';
		
		$data['main_content'] = $this->load->view('admin/user_edit', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function do_upd() {
		$id			= trim($this->input->post('id'));
		$title		= trim($this->input->post('title'));
		$content	= trim($this->input->post('content'));

		if(empty($id)) redirect('/admin/user');
		
		$user = array(
			'title'		=> $title,
			'content'	=> $content
		);
		
		if ($_FILES['userfile']['name']) {	
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_user_UPLOAD_PATH;
		
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
		
					$user['img_name'] = IMG_user_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$user['create_time'] = time();
		$user_id = $this->common_model->upd_data('user', array('id' => $id), $user);
		
		redirect('/admin/user/add');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function del() {
		$id = $this->uri->segment ( 4 );
		$this->common_model->upd_data('user', array('id' => $id), array('status' => 0));
		
		redirect('/admin/user');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function vetted() {
		$id = $this->uri->segment ( 4 );
		if (empty($id)) redirect('/admin/user');
		$status = $this->uri->segment( 5 );
		
		if ($status) {
			$this->common_model->upd_data('user_info', array('id' => $id), array('status' => $status));
			
			redirect('/admin/user');
		} else {
			$data = $this->common_model->sel_data('user_info', array('id' => $id));
			$data['menu'] = 'user';
			$data['sub_menu'] = 'user_vetted';
			
			$data['main_content'] = $this->load->view('admin/user_vetted', $data, TRUE);
			
			$this->load->view('admin/template', $data);
		}
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function rand() {
		$user = $this->user_model->sel_user_rand();
		
		foreach ($user as $key=>$val) {
			$user[$key]['img_name'] = get_thumb_pic($val['img_name'], 'm');
			$user[$key]['content'] = cut_str($val['content'], 50);
		}
		
		echo json_encode($user);
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