<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	var $admin_id = '';
	
	public function __construct() {
		parent::__construct();
		
// 		$this->admin_id = $this->session->userdata('admin_id');
		
// 		if (empty($this->admin_id))
// 			redirect('/admin/login');
		
		$this->load->model('admin/product_model');
		
		if (IS_DEBUG === TRUE) 
			$this->output->enable_profiler(TRUE);
	}
	
	public function index() {
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
		
		$num = $this->product_model->sel_product_count(1);
		
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
		
		$data['product_list'] 	= $this->product_model->sel_product_list(1, $offset, $psize);
		
		$data['menu'] 			= 'product';
		$data['sub_menu'] 		= 'product_list';
		$data['main_content'] = $this->load->view('admin/product_list', $data, TRUE);
		$this->load->view('admin/template', $data);
	}
	
	public function add() {
		$data['menu'] = 'product';
		$data['sub_menu'] = 'product_add';
		$data['category'] = $this->common_model->sel_list('category');
		
		$data['main_content'] = $this->load->view('admin/product_add', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function do_add() {
		$category		= trim($this->input->post('category'));

		$product = array(
			'category'	=> $category
		);
		
		if ($_FILES['userfile']['name']) {
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_PRODUCT_UPLOAD_PATH;
		
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
						
					// 240 x 162
					if ($image_width >= 240 || $image_height >= 162) {
						if ($image_width / $image_height > 240 / 162) {
							$this->_do_image ( '_m', $path, 240, 240 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 240 / 162) {
							$this->_do_image ( '_m', $path, 140 * ($image_width / $image_height), 162 );
						}
					} else {
						$this->_do_image ( '_m', $path, $image_width, $image_height );
					}
						
					// 100 x 100
					if ($image_width >= 100 || $image_height >= 100) {
						if ($image_width / $image_height > 100 / 100) {
							$this->_do_image ( '_s', $path, 100, 100 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 100 / 100) {
							$this->_do_image ( '_s', $path, 100 * ($image_width / $image_height), 100 );
						}
					} else {
						$this->_do_image ( '_s', $path, $image_width, $image_height );
					}
		
					$product['img_name'] = IMG_PRODUCT_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$product['create_time'] = time();
		$product_id = $this->common_model->ins_data('product', $product);
		
		redirect('/admin/product/add');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function upd() {
		$id = $this->uri->segment ( 4 );
		if(empty($id)) redirect('/admin/product');

		$data = $this->common_model->sel_data('product', array('id' => $id));
		$data['menu'] = 'product';
		$data['sub_menu'] = 'product_list';
		$data['categoryArr'] = $this->common_model->sel_list('category');
		
		$data['main_content'] = $this->load->view('admin/product_edit', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function do_upd() {
		$id		= trim($this->input->post('id'));
		if(empty($id)) redirect('/admin/product');
		$category		= trim($this->input->post('category'));

		$product = array(
			'category'	=> $category
		);
		
		if ($_FILES['userfile']['name']) {
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
			$file_name	= time().'.jpg';
			$file_path 	= APP_SCRIPT.IMG_PRODUCT_UPLOAD_PATH;
		
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
						
					// 240 x 162
					if ($image_width >= 240 || $image_height >= 162) {
						if ($image_width / $image_height > 240 / 162) {
							$this->_do_image ( '_m', $path, 240, 240 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 240 / 162) {
							$this->_do_image ( '_m', $path, 140 * ($image_width / $image_height), 162 );
						}
					} else {
						$this->_do_image ( '_m', $path, $image_width, $image_height );
					}
						
					// 100 x 100
					if ($image_width >= 100 || $image_height >= 100) {
						if ($image_width / $image_height > 100 / 100) {
							$this->_do_image ( '_s', $path, 100, 100 * ($image_height / $image_width) );
						} elseif ($image_width / $image_height <= 100 / 100) {
							$this->_do_image ( '_s', $path, 100 * ($image_width / $image_height), 100 );
						}
					} else {
						$this->_do_image ( '_s', $path, $image_width, $image_height );
					}
		
					$product['img_name'] = IMG_PRODUCT_UPLOAD_PATH . $file_name;
				}
			}
		}
			
		$product['create_time'] = time();
		$product_id = $this->common_model->upd_data('product', array('id' => $id), $product);
		
		redirect('/admin/product');
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	public function del() {
		$id = $this->uri->segment ( 4 );
		$this->common_model->upd_data('product', array('id' => $id), array('status' => 0));
		
		redirect('/admin/product');
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