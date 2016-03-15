<?php 
class User_model extends CI_Model{

	public function login($usertype, $cond){
		if($usertype=="admin"){
			$query = $this->db->get_where('admin',$cond);
		}
		else{
			$query = $this->db->get_where('users',$cond);
		}
		return $query;
	}

	public function update_user($data, $id){
		$this->db->where('id',$id);
		$query = $this->db->update('users',$data);
		return $query;
	}

	public function profile($usertype,$cond){
		if($usertype == "admin"){
			$query = $this->db->get_where('admin',$cond);
		}
		else{
			$query = $this->db->get_where('users',$cond);
		}
		return $query->result_array();
	}
	
}