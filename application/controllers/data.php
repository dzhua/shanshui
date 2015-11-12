<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		
	}
	
	public function news() {
		$this->load->model('admin/news_model');
		$uri_segment = 3;
		$current_page = $this->uri->segment ( $uri_segment );
		
		/*每页记录数*/
		$psize = 1;
		if ($current_page > 1) {
			$offset = ($current_page - 1) * $psize;
		} else {
			$current_page = 1;
			$offset = 0;
		}
		
		$num = $this->news_model->sel_news_count(1);
		
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
		$data['news_list'] 	= $this->news_model->sel_news_list(1, NULL, $offset, $psize);
		
		echo json_encode($data);
	}
	
	public function product() {
		$this->load->model('admin/product_model');
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
		
		echo json_encode($data);
	}
}