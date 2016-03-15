<?php 
class Admin_model extends CI_Model{

	public function index_data(){
		$this->db->order_by('id','desc');
		$user = $this->db->get('users',4);
		$user_data[] = $user->result_array();
		$package = $this->db->get('packages',4);
		$package_data[] = $package->result_array();
		$req_package = $this->db->get('ordered_package',4);
		$req_data[] = $req_package->result_array();
		$booked_packages = $this->db->get('order_by',4);
		$book_data[] = $booked_packages->result_array();
		$data[] = array($user_data, $package_data, $req_data, $book_data); 
		return $data;
	}

	//for pagination
	public function data($num,$start,$table_name){
		$this->db->order_by('id','desc');
		$this->db->limit($num,$start);
		$query = $this->db->get($table_name);
		return $query->result_array();
	}

	public function row_count($table_name){
		$query = $this->db->get($table_name);
		return $query->num_rows();
	}

	//getting the single email name from the database
	public function email_single($table_name, $id){
		$data = $this->db->get_where($table_name, array('id'=>$id));
		$all_data = $data->result_array();
		return $email_address = $all_data[0]['email'];
	}

	public function selectby_cond($table,$field="",$cond){
		if(!empty($field)){
			$this->db->select($field);
		}
		$query = $this->db->get_where($table,$cond);
		return $query->result_array();
	}

	public function select_all($table_name,$field_name=''){
		if(!empty($field_name)){
			$query = $this->db->select($field_name);
			$query = $this->db->get($table_name);
		}
		else{
			$query = $this->db->get($table_name);
		} 
		return $query->result_array();
	}

	public function select_join($table1, $table2, $cond){
		$this->db->from($table1);
		$this->db->join($table2,$cond);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function insert_data($table_name, $data){
		return $this->db->insert($table_name, $data);
	}

	public function update($table_name, $status, $cond){
		$this->db->where($cond);
		return $this->db->update($table_name,$status);
	}
	
	public function add_user($data){
		$query = $this->db->insert('users',$data);
		return $query;
	}

	public function add_admin($data){
		$query = $this->db->insert('admin',$data);
		return $query;
	}

	public function login($usertype, $cond){
		if($usertype=="admin"){
			$query = $this->db->get_where('admin',$cond);
		}
		else{
			$query = $this->db->get_where('users',$cond);
		}
		return $query;
	}

	public function manage_user($id = ""){
		if(!empty($id)){
			$cond = ['id' => $id];
			$query = $this->db->get_where('users',$cond);
		}
		else{
			$query = $this->db->get('users');
			
		}
		return $query->result_array();
	}

	public function update_user($data, $id){
		$this->db->where('id',$id);
		$query = $this->db->update('users',$data);
		return $query;
	}

	public function delete($id,$table_name){
		$this->db->where('id',$id);
		$query = $this->db->delete($table_name);
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

	public function add_package($data){
		return $this->db->insert('packages',$data);
	}	

	public function update_package($id, $data){
		$this->db->where('id', $id);
		$query = $this->db->update('packages', $data);
		return $query;
	}

	//retriving all packages
	public function package_list(){
		$query = $this->db->get('packages');
		return $query->result_array();
	}

	//retriving a package fulfilling given condition
	public function package($cond){
		$query = $this->db->get_where('packages',$cond);
		return $query->result_array();
	}

	public function booked_packages(){
		$query = $this->db->get('order_by');
		return $query->result_array();
	}

	public function requested_packages(){
		$query = $this->db->get('ordered_package');
		return $query->result_array();
	}

	public function approve($id, $table_name){
		$data = ['status' => 1];
		$this->db->where('id', $id);
		$query = $this->db->update($table_name,$data);
	}

	public function stall($id, $table_name){
		$data = ['status' => 0];
		$this->db->where('id', $id);
		$query = $this->db->update($table_name,$data);
	}

	//Deleteing booked packages
	public function package_delete($id){
		return $this->db->delete('order_by',array('id'=>$id));
	}

	public function requestedpackage_delete($id){
		return $this->db->delete('ordered_package',array('id'=>$id));
	}

	//deleting packages
	public function delete_package($id){
		return $this->db->delete('packages',array('id'=>$id));
	}

	public function change_password($table,$id, $new_password){
		$this->db->where('id',$id);
		$this->db->update($table,array('password'=>$new_password));
	}

	public function update_displayname($id, $table,$display_name){
		$this->db->where('id',$id);
		return $this->db->update($table, array('display_name'=>$display_name));
	}

	public function change_image($id,$table_name,$img_name){
		$this->db->where('id',$id);
		return $this->db->update($table_name, array('image'=>$img_name));
	}	


	//incomplete
	public function search($table_name, $searchtxt){
		if($table_name == "users"){
			$this->db->like('username',$searchtxt);
			$this->db->or_like('full_name',$searchtxt);
			$this->db->or_like('display_name',$searchtxt);
			$this->db->or_like('email',$searchtxt);
		}
		if($table_name == "packages"){
			$this->db->like('title',$searchtxt);
			$this->db->or_like('description',$searchtxt);
		}
		
		$query = $this->db->get($table_name);
		$data[] = $query->result_array();
		$num = $query->num_rows();
		if($num>=1){
			$results = array($data, $num);
			return $results;
		}
		else{
			return "no results found";
		}
	}

}