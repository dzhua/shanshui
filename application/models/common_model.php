<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 通用MODEL函数
 * 
 * @author dzhua
 * @date 2015-11-08
 *
 */
class Common_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		
		$this->load->database();
	}	
	
	// ------------------------------------------------------------------------------------------------------------

	/**
	 * 取一行数据
	 * 
	 * @param 表名 $table
	 * @param 条件 $where
	 */
	public function sel_data($table = '', $where = array(), $field = '') {
		foreach ($where as $key=>$item) {
			$this->db->where($key, $item);
		}
		
		if( ! empty($field))
			$this->db->select($field);
			
		$q = $this->db->get($table);
		
		return $q->num_rows() > 0 ? $q->row_array() : FALSE ;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * 取一列数据
	 * 
	 * @param 表名 $table
	 * @param 条件 $where
	 */
	public function sel_list($table = '', $where = array(), $field = '', $offset = 0, $psize = 0) {
		foreach ($where as $key=>$item) {
			$this->db->where($key, $item);
		}
		
		if( ! empty($field))
			$this->db->select($field);
			
		if (is_numeric($offset) && is_numeric($psize) && $offset>=0 && $psize>0)
			$this->db->limit($psize, $offset);
			
		$q = $this->db->get($table);
		
		return $q->num_rows() > 0 ? $q->result_array() : FALSE ;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * 取总数
	 * 
	 * @param 表名 $table
	 * @param 条件 $where
	 */
	public function sel_count($table = '', $where = array()) {
		foreach ($where as $key=>$item) {
			$this->db->where($key, $item);
		}
		
		if( ! empty($field))
			$this->db->select('x');
			
		$q = $this->db->get($table);
		
		return $q->num_rows() ;
	}
	
	// ------------------------------------------------------------------------------------------------------------

	/**
	 * 增加一条数据
	 */
	public function ins_data($table = '', $data = array()) { 
		$this->db->insert($table, $data);
		
		return $this->db->insert_id();	
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * 修改数据
	 * 
	 * @param 表名 $table
	 * @param 条件 $where
	 * @param 修改的数据 $data
	 */
	public function upd_data($table = '', $where = array(), $data = array()) {
		foreach ($where as $key=>$item) {
			$this->db->where($key, $item);
		}
		
		$this->db->update($table, $data);
		
		if($this->db->affected_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * 删除数据
	 * 
	 * @param 表名  $table
	 * @param 删除条件  $where
	 */
	public function del_data($table = '', $where = array()) {
		foreach ($where as $key=>$item) {
			$this->db->where($key, $item);
		}
		
		$this->db->delete($table, $data);
		
		if($this->db->affected_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * 取条件是 WHERE IN 数据
	 * 
	 * @param 表名 $table
	 * @param 查询条件 $where
	 * @param 查询字段 $field
	 */
	public function sel_wherein_list($table = '', $data = array(), $field = '') {
		$where = ' WHERE 1=1';
		
		foreach ($data as $key=>$item) {
			$item = get_legitimate_str($item);
			if( ! empty($item))
				$where .= " AND $key IN($item)";
		}
		
		if ($where == '1=1')
			return array();

		$sql = 'SELECT '.$field.' FROM '.$table.' '.$where;
		
		$q = $this->db->query($sql);
		
		return $q->num_rows() > 0 ? $q->result_array() : FALSE ;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * 取LIKE数列
	 * 
	 * @param string $table
	 * @param string $like
	 * @param string $field
	 */
	public function sel_like_list($table = '', $like = array(), $field = '') {
		if (empty($field))
			return FALSE;
		
		$this->db->select($field);
		
		foreach ($like as $key=>$val)
			$this->db->like($key, urldecode($val));
		
		$q = $this->db->get($table);
		
		return $q->num_rows() > 0 ? $q->result_array() : FALSE ;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * auto_increment
	 * 
	 * @param string $table
	 * @param array $data
	 * @param string $field
	 * @param int $increment
	 */
	public function auto_increment($table = '', $data = array(), $field = '', $increment = 1) {		
		$sql = "UPDATE $table SET $field=$field+$increment WHERE 1=1";
		
		foreach ($where as $key=>$item) {
			$sql .= " AND $key='$item'";
		}
		
		if($this->db->affected_rows() > 0)
			return TRUE;
		else
			return FALSE;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	/**
	 * 分类数据总数
	 *
	 */
	public function sel_statistics_data() {
		$sql = 'SELECT COUNT(*) num FROM news WHERE `status`=1';
		$q = $this->db->query($sql);
		$news = $q->row_array();
		
		$sql = 'SELECT COUNT(*) num FROM product WHERE `status`=1';
		$q = $this->db->query($sql);
		$product = $q->row_array();
		
		$data['news_count'] 	= $news['num'];
		$data['product_count'] 	= $product['num'];
		
		return $data;
	}
	
	// ------------------------------------------------------------------------------------------------------------
	
	//图片处理缩图
	public function do_image($thumb_marker, $image_name, $width=0, $height=0)
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