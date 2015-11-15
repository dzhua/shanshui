<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Financing extends CI_Controller {

	var $admin_id = '';
	
	public function __construct() {
		parent::__construct();
		
// 		$this->admin_id = $this->session->userdata('admin_id');
		
// 		if (empty($this->admin_id))
// 			redirect('/admin/login');
		
		$this->load->model('admin/financing_model');
		
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
			'lock_start'	=> $keywords[4],
			'lock_stop'		=> $keywords[5],
			'status'		=> $keywords[6]
		);
		$num = $this->financing_model->sel_financing_count($where);
		
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
		
		$data['financing_status']	= $this->financing_model->sel_financing_status();
		$data['financing_list'] 	= $this->financing_model->sel_financing_list($where, $offset, $psize);
		
		$data['menu'] 			= 'financing';
		$data['sub_menu'] 		= 'financing_list';
		$data['keyword'] 		= $keyword;
		$data['main_content'] = $this->load->view('admin/financing_list', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function create() {
		$data['menu'] = 'financing';
		$data['sub_menu'] = 'financing_create';
		
		$data['main_content'] = $this->load->view('admin/financing_create', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function do_create() {
		$item_name	= trim($this->input->post('item_name'));
		$buy_start	= trim($this->input->post('buy_start'));
		$buy_stop	= trim($this->input->post('buy_stop'));
		$total		= trim($this->input->post('total'));
		$lock_start	= trim($this->input->post('lock_start'));
		$lock_stop	= trim($this->input->post('lock_stop'));
		$rate		= trim($this->input->post('rate'));
		$min_share	= trim($this->input->post('min_share'));
		$introduce	= trim($this->input->post('introduce'));

		$financing = array(
			'item_name'		=> $item_name,
			'buy_start'		=> strtotime($buy_start),
			'buy_stop'		=> strtotime($buy_stop),
			'total'			=> $total,
			'lock_start'	=> strtotime($lock_start),
			'lock_stop'		=> strtotime($lock_stop),
			'rate'			=> $rate,
			'min_share'		=> $min_share,
			'introduce'		=> $introduce
		);
		
		if ($_FILES['userfile']['name']) {	
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_FINANCING_UPLOAD_PATH;
		
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
		
					$financing['cover_path'] = IMG_FINANCING_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$financing['create_time'] = time();
		$financing['update_time'] = time();
		$financing_id = $this->common_model->ins_data('financing', $financing);
		
		redirect('/admin/financing/create');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function upd() {
		$id = $this->uri->segment ( 4 );
		if(empty($id)) redirect('/admin/financing');

		$data = $this->common_model->sel_data('financing', array('id' => $id));
		$data['menu'] = 'financing';
		$data['sub_menu'] = 'financing_list';
		
		$data['main_content'] = $this->load->view('admin/financing_edit', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function do_upd() {
		$id			= trim($this->input->post('id'));
		$title		= trim($this->input->post('title'));
		$content	= trim($this->input->post('content'));

		if(empty($id)) redirect('/admin/financing');
		
		$financing = array(
			'title'		=> $title,
			'content'	=> $content
		);
		
		if ($_FILES['userfile']['name']) {	
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_financing_UPLOAD_PATH;
		
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
		
					$financing['img_name'] = IMG_financing_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$financing['update_time'] = time();
		$financing_id = $this->common_model->upd_data('financing', array('id' => $id), $financing);
		
		redirect('/admin/financing/add');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function del() {
		$id = $this->uri->segment ( 4 );
		$this->common_model->upd_data('financing', array('id' => $id), array('status' => 0));
		
		redirect('/admin/financing');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function rand() {
		$financing = $this->financing_model->sel_financing_rand();
		
		foreach ($financing as $key=>$val) {
			$financing[$key]['img_name'] = get_thumb_pic($val['img_name'], 'm');
			$financing[$key]['content'] = cut_str($val['content'], 50);
		}
		
		echo json_encode($financing);
	}
}