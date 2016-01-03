<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crowdfunded_support extends CI_Controller {

	var $admin_id = '';
	
	public function __construct() {
		parent::__construct();
		
// 		$this->admin_id = $this->session->userdata('admin_id');
		
// 		if (empty($this->admin_id))
// 			redirect('/admin/login');
		
		$this->load->model('admin/crowdfunded_model');
		
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
			'company_name'	=> $keywords[0],
			'item_name'		=> $keywords[1],
			'buy_start'		=> $keywords[2],
			'buy_stop'		=> $keywords[3],
			'status'		=> $keywords[4]
		);
		$num = $this->crowdfunded_model->sel_crowdfunded_count($where);
		
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
		
		$data['crowdfunded_status']	= $this->crowdfunded_model->sel_crowdfunded_status();
		$data['crowdfunded_list'] 	= $this->crowdfunded_model->sel_crowdfunded_list($where, $offset, $psize);
		foreach ($data['crowdfunded_list'] as $key=>$val) {
			foreach ($data['crowdfunded_status'] as $k=>$v) {
				if ($val['status'] == $v['id']) {
					$data['crowdfunded_list'][$key]['status'] = $v['status'];
					break;
				}
			}
		}
		
		
		$data['menu'] 			= 'crowdfunded';
		$data['sub_menu'] 		= 'crowdfunded_list';
		$data['keyword'] 		= $where;
		$data['main_content'] = $this->load->view('admin/crowdfunded_list', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function create() {
		$data['menu'] = 'crowdfunded';
		$data['sub_menu'] = 'crowdfunded_create';
		
		$data['main_content'] = $this->load->view('admin/crowdfunded_support', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function do_create() {
		$item_name	= trim($this->input->post('item_name'));
		$crowdfunded_id	= trim($this->input->post('crowdfunded_id'));
		$price		= trim($this->input->post('price'));
		$num		= trim($this->input->post('num'));
		$introduce	= trim($this->input->post('introduce'));

		$crowdfunded = array(
			'item_name'		=> $item_name,
			'crowdfunded_id'=> $crowdfunded_id,
			'price'			=> $price,
			'num'			=> $num,
			'introduce'		=> $introduce
		);
		
		if ($_FILES['userfile']['name']) {	
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_CROWDFUNDED_SUPPORT_UPLOAD_PATH;
		
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
							$this->common_model->do_image ( '_l', $path, 1024, 1024 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 1024 / 1024) {
							$this->common_model->do_image ( '_l', $path, 1024 * ($image_width / $image_height), 1024 );
						}
					} else {
						$this->common_model->do_image ( '_l', $path, $image_width, $image_height );
					}
						
					// 214 x 140
					if ($image_width >= 214 || $image_height >= 140) {
						if ($image_width / $image_height > 214 / 140) {
							$this->common_model->do_image ( '_m', $path, 214, 214 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 214 / 140) {
							$this->common_model->do_image ( '_m', $path, 140 * ($image_width / $image_height), 140 );
						}
					} else {
						$this->common_model->do_image ( '_m', $path, $image_width, $image_height );
					}
		
					$crowdfunded['cover_path'] = IMG_CROWDFUNDED_SUPPORT_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$crowdfunded['create_time'] = time();
		$crowdfunded['update_time'] = time();
		$crowdfunded_support_id = $this->common_model->ins_data('crowdfunded_support', $crowdfunded);
		
		redirect('/admin/crowdfunded/create');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function upd() {
		$id = $this->uri->segment ( 4 );
		if(empty($id)) redirect('/admin/crowdfunded');

		$data = $this->common_model->sel_data('crowdfunded', array('id' => $id));
		$data['menu'] = 'crowdfunded';
		$data['sub_menu'] = 'crowdfunded_list';
		
		$data['main_content'] = $this->load->view('admin/crowdfunded_edit', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function do_upd() {
		$id			= trim($this->input->post('id'));
		$title		= trim($this->input->post('title'));
		$content	= trim($this->input->post('content'));

		if(empty($id)) redirect('/admin/crowdfunded');
		
		$crowdfunded = array(
			'title'		=> $title,
			'content'	=> $content
		);
		
		if ($_FILES['userfile']['name']) {	
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_CROWDFUNDED_SUPPORT_UPLOAD_PATH;
		
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
							do_image ( '_l', $path, 1024, 1024 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 1024 / 1024) {
							do_image ( '_l', $path, 1024 * ($image_width / $image_height), 1024 );
						}
					} else {
						do_image ( '_l', $path, $image_width, $image_height );
					}
						
					// 214 x 140
					if ($image_width >= 214 || $image_height >= 140) {
						if ($image_width / $image_height > 214 / 140) {
							do_image ( '_m', $path, 214, 214 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 214 / 140) {
							do_image ( '_m', $path, 140 * ($image_width / $image_height), 140 );
						}
					} else {
						do_image ( '_m', $path, $image_width, $image_height );
					}
		
					$crowdfunded['img_name'] = IMG_CROWDFUNDED_SUPPORT_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$crowdfunded['update_time'] = time();
		$crowdfunded_id = $this->common_model->upd_data('crowdfunded', array('id' => $id), $crowdfunded);
		
		redirect('/admin/crowdfunded/add');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function del() {
		$id = $this->uri->segment ( 4 );
		$this->common_model->upd_data('crowdfunded', array('id' => $id), array('status' => 0));
		
		redirect('/admin/crowdfunded');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function rand() {
		$crowdfunded = $this->crowdfunded_model->sel_crowdfunded_rand();
		
		foreach ($crowdfunded as $key=>$val) {
			$crowdfunded[$key]['img_name'] = get_thumb_pic($val['img_name'], 'm');
			$crowdfunded[$key]['content'] = cut_str($val['content'], 50);
		}
		
		echo json_encode($crowdfunded);
	}
}