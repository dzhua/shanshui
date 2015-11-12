<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_news_list($status = 1, $keyword, $offset = 0, $psize = 10) {
		$sql = 'SELECT * FROM news WHERE status='.$status;
		
		if ( ! empty($keyword))
			$sql .= " AND title LIKE('%".rawurldecode($keyword)."%')";
		
		if (is_numeric($offset) && is_numeric($psize) && $offset>=0 && $psize>0)
			$sql .= " LIMIT $offset,$psize";
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_news_rand() {
		$sql = 'SELECT * FROM news WHERE status=1 ORDER BY RAND() LIMIT 3';
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	/*
	 * 总数
	 */
	public function sel_news_count($status = 1, $keyword) {
		$sql = 'SELECT COUNT(*) num FROM news WHERE status='.$status;
				
		if ( ! empty($keyword))
			$sql .= " AND title LIKE('%".rawurldecode($keyword)."%')";
		
		$q = $this->db->query($sql);
		
		$arr = $q->row_array();
		
		if(empty($arr['num']))
			$arr['num'] = 0;
			
		return $arr['num'];
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_news_data($id = '') {
		$sql = 'SELECT * FROM news WHERE id=?';
		
		$q = $this->db->query ( $sql, $id );
		
		return $q->num_rows () > 0 ? $q->row_array () : FALSE;
	}
}