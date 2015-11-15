<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_admin_list() {
		$sql = 'SELECT * FROM admin';
		
		if ( ! empty($where)) {
			$sql .=' WHERE 1=1 ';
			foreach ($where as $key=>$val) {
				if (empty($val)) continue;
				switch ($key) {
					case 'admin_name':
						$sql .= ' AND A.admin_name LIKE "%' . rawurldecode($val) . '%"';
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
	
	public function sel_admin_rand() {
		$sql = 'SELECT * FROM admin WHERE status=1 ORDER BY RAND() LIMIT 3';
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	/*
	 * 总数
	 */
	public function sel_admin_count() {
		$sql = 'SELECT COUNT(*) num FROM admin';
		
		if ( ! empty($where)) {
			$sql .=' WHERE 1=1 ';
			foreach ($where as $key=>$val) {
				if (empty($val)) continue;
				switch ($key) {
					case 'admin_name':
						$sql .= ' AND A.admin_name LIKE "%' . rawurldecode($val) . '%"';
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
	
	public function sel_admin_data($id = '') {
		$sql = 'SELECT * FROM admin WHERE id=?';
		
		$q = $this->db->query ( $sql, $id );
		
		return $q->num_rows () > 0 ? $q->row_array () : FALSE;
	}
}