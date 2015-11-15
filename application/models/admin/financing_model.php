<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class financing_model extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_financing_list($where, $offset = 0, $psize = 10) {
		$sql = 'SELECT * FROM financing';
		
		if ( ! empty($where)) {
			$sql .=' WHERE 1=1 ';
			foreach ($where as $key=>$val) {
				if (empty($val)) continue;
				switch ($key) {
					case 'compay_name':
					;
					break;
					case 'item_name':
						$sql .= ' AND item_name LIKE "%' . rawurldecode($val) . '%"';
					break;
					case 'buy_start':
						$sql .= ' AND buy_start >=' . strtotime($val);
					break;
					case 'buy_stop':
						$sql .= ' AND buy_stop <=' . strtotime($val);
					break;
					case 'lock_start':
						$sql .= ' AND lock_start >=' . strtotime($val);
					break;
					case 'status':
						$sql .= ' AND status =' . $val;
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
	
	public function sel_financing_rand() {
		$sql = 'SELECT * FROM financing WHERE status=1 ORDER BY RAND() LIMIT 3';
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	/*
	 * 总数
	 */
	public function sel_financing_count($where) {
		$sql = 'SELECT COUNT(*) num FROM financing';
		
		if ( ! empty($where)) {
			$sql .=' WHERE 1=1 ';
			foreach ($where as $key=>$val) {
				if (empty($val)) continue;
				switch ($key) {
					case 'compay_name':
					;
					break;
					case 'item_name':
						$sql .= ' AND item_name LIKE "%' . rawurldecode($val) . '%"';
					break;
					case 'buy_start':
						$sql .= ' AND buy_start >=' . strtotime($val);
					break;
					case 'buy_stop':
						$sql .= ' AND buy_stop <=' . strtotime($val);
					break;
					case 'lock_start':
						$sql .= ' AND lock_start >=' . strtotime($val);
					break;
					case 'status':
						$sql .= ' AND status =' . $val;
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
	
	public function sel_financing_data($id = '') {
		$sql = 'SELECT * FROM financing WHERE id=?';
		
		$q = $this->db->query ( $sql, $id );
		
		return $q->num_rows () > 0 ? $q->row_array () : FALSE;
	}
	
	// ---------------------------------------------------------------------------------------
	
	public function sel_financing_status() {
		$sql = 'SELECT * FROM financing_status';
		
		$q = $this->db->query ( $sql );
		
		return $q->num_rows () > 0 ? $q->result_array () : FALSE;
	}
}