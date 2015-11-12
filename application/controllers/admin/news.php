<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	var $admin_id = '';
	
	public function __construct() {
		parent::__construct();
		
// 		$this->admin_id = $this->session->userdata('admin_id');
		
// 		if (empty($this->admin_id))
// 			redirect('/admin/login');
		
		$this->load->model('admin/news_model');
		
		if (IS_DEBUG === TRUE) 
			$this->output->enable_profiler(TRUE);
	}
	
	public function index() {
		$keyword = $this->uri->segment ( 4 );
		$uri_segment = 5;	
		$current_page = $this->uri->segment ( $uri_segment );
		
	 	/*每页记录数*/
		$psize = 1; 
		if ($current_page > 1) {
			$offset = ($current_page - 1) * $psize;
		} else {
			$current_page = 1;
			$offset = 0;
		}
		$keyword = empty($keyword) ? 0 : $keyword;
		$where = array(
// 				'status'		=> $status,
				'keyword'		=> $keyword,
		);
		$num = $this->news_model->sel_news_count(1, $keyword);
		
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
		
		$data['news_list'] 	= $this->news_model->sel_news_list(1, $keyword, $offset, $psize);
		
		$data['menu'] 			= 'news';
		$data['sub_menu'] 		= 'news_list';
		$data['keyword'] 		= $keyword;
		$data['main_content'] = $this->load->view('admin/news_list', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function add() {
		$data['menu'] = 'news';
		$data['sub_menu'] = 'news_add';
		
		$data['main_content'] = $this->load->view('admin/news_add', $data, TRUE);
		
		$this->load->view('admin/template', $data);
	}
	
	public function do_add() {
		$title		= trim($this->input->post('title'));
		$content	= trim($this->input->post('content'));

		$news = array(
			'title'		=> $title,
			'content'	=> $content
		);
		
		if ($_FILES['userfile']['name']) {	
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
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
		$news_id = $this->common_model->ins_data('news', $news);
		
		redirect('/admin/news/add');
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
		
		if ($_FILES['userfile']['name']) {	
			$tmp_name 	= $_FILES['userfile']['tmp_name'];
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