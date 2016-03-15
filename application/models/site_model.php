<?php 
class Site_model extends CI_Model{

	public function package_list(){
		$query = $this->db->get_where('packages',array('status'=>1));
		return $query->result_array();
	}

	public function selectby_cond($tablename,$cond){
		$query = $this->db->get_where($tablename, $cond);
		return $query->result_array();
	}

	public function order_package($data){
		$query = $this->db->insert('ordered_package',$data);
		return $query;
	}

	public function book_package($data){
		$query = $this->db->insert('order_by',$data);
		return $query;
	}

	public function select($table_name, $limit=null){
		if($limit != null){
			$query = $this->db->get($table_name, $limit);
		}
		else{
			$query = $this->db->get($table_name);
		}
		return $query->result_array();
	}

}