<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product_model extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_product_list($status = 1, $offset = 0, $psize = 10) {
		$sql = 'SELECT product.*,category.category category_text FROM product LEFT JOIN category ON product.category=category.id WHERE status='.$status;
		
		if ( ! empty($keyword))
			$sql .= " AND title LIKE('%".rawurldecode($keyword)."%')";
		
		if (is_numeric($offset) && is_numeric($psize) && $offset>=0 && $psize>0)
			$sql .= " LIMIT $offset,$psize";
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	/*
	 * 总数
	 */
	public function sel_product_count($status = 1) {
		$sql = 'SELECT COUNT(*) num FROM product WHERE status='.$status;
				
		if ( ! empty($keyword))
			$sql .= " AND title LIKE('%".rawurldecode($keyword)."%')";
		
		$q = $this->db->query($sql);
		
		$arr = $q->row_array();
		
		if(empty($arr['num']))
			$arr['num'] = 0;
			
		return $arr['num'];
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_product_data($id = '') {
		$sql = 'SELECT * FROM product WHERE id=?';
		
		$q = $this->db->query ( $sql, $id );
		
		return $q->num_rows () > 0 ? $q->row_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_product_rand() {
		$sql = 'SELECT product_id,product_name,product_count,product_shici_count,shici_current_num FROM product WHERE get=0 ORDER BY RAND() LIMIT 1';
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->row_array() : FALSE;
	}
}