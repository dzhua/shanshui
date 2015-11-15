<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_user_list($where, $offset = 0, $psize = 10) {
		$sql = 'SELECT A.user_name,B.* FROM user_account A
				LEFT JOIN user_info B ON A.id=B.account_id';
		
		if ( ! empty($where)) {
			$sql .=' WHERE 1=1 ';
			foreach ($where as $key=>$val) {
				if (empty($val)) continue;
				switch ($key) {
					case 'user_name':
						$sql .= ' AND A.user_name LIKE "%' . rawurldecode($val) . '%"';
					break;
					case 'tel':
						$sql .= ' AND B.tel="'.$val.'"';
					break;
					break;
				}
			}
		}
		
		if (is_numeric($offset) && is_numeric($psize) && $offset>=0 && $psize>0)
			$sql .= " LIMIT $offset,$psize";
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_user_rand() {
		$sql = 'SELECT * FROM user WHERE status=1 ORDER BY RAND() LIMIT 3';
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	/*
	 * 总数
	 */
	public function sel_user_count($where) {
		$sql = 'SELECT COUNT(*) num FROM user_account A
				LEFT JOIN user_info B ON A.id=B.account_id';
		
		if ( ! empty($where)) {
			$sql .=' WHERE 1=1 ';
			foreach ($where as $key=>$val) {
				if (empty($val)) continue;
				switch ($key) {
					case 'user_name':
						$sql .= ' AND A.user_name LIKE "%' . rawurldecode($val) . '%"';
					break;
					case 'tel':
						$sql .= ' AND B.tel="'.$val.'"';
					break;
				}
			}
		}
		
		$q = $this->db->query($sql);
		
		$arr = $q->row_array();
		
		if(empty($arr['num']))
			$arr['num'] = 0;
			
		return $arr['num'];
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_user_data($id = '') {
		$sql = 'SELECT * FROM user WHERE id=?';
		
		$q = $this->db->query ( $sql, $id );
		
		return $q->num_rows () > 0 ? $q->row_array () : FALSE;
	}
}