<?php 
class Site_model extends CI_Model{

	public function contact(){
		$name = $this->input->post('name');
 		$email =  $this->input->post('email');
 		$phone =  $this->input->post('phone');
 		$message =  $this->input->post('message');
 		$rules = array(
			array(
				'field'=>'name',
				'label'=>'name',
				'rules'=>'trim|required|xss_clean|min_length[6]|max_length[50]|regex_match[/^[a-zA-Z+0-9]*$/]'
				),
			array(
				'field'=>'email',
				'label'=>'email',
				'rules'=>'trim|required|xss_clean|valid_email'
				),
			array(
				'field'=>'phone',
				'label'=>'phone',
				'rules'=>'required'
				),
			array(
				'field'=>'message',
				'label'=>'message',
				'rules'=>'required'
				)
		);
		$this->form_validation->set_rules($rules);
 		if($this->form_validation->run()==true){
 			$email_body = "You have received a new message from your website's contact form.\n\n"."Here are the details:\n\nName: $name\n\nPhone: $phone\n\nEmail: $email\n\nMessage:\n$message";
			$headers = "From: noreply@your-domain.com\n";
			$headers .= "Reply-To: $email";
 			$mail = mail($to, $subject, $email_body, $headers);
 			if($mail){
 				$this->session->set_flashdata('err_success',"Your message was successfully sent");
 				redirect('site/contact');
 			}
 			else{
 				$this->session->set_flashdata('err_success',"Something went wrong");
 			}
 		}
	}

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