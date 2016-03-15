<?php 
class User extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
	}

	public function login(){
		if($_POST){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$usertype = $this->input->post('usertype');
			$cond = [
					'username'=>$username,
					'password'=>sha1($password),
					'usertype'=>$usertype
				];
			$user = $this->admin_model->login($usertype, $cond);
			$userdata = $user->first_row('array');
			$count = $user->num_rows();
			if($count==1){
				$this->session->set_userdata('userid',$userdata['id']);
				$this->session->set_userdata('username',$userdata['username']);
				$this->session->set_userdata('usertype',$userdata['usertype']);
				$this->session->set_userdata('image',$userdata['image']);
				redirect('admin/index');
			}
			else{
				$err = $this->session->set_flashdata('err',"Invalid username or password");
				redirect('site/index');
			}
		}
		else{
			redirect('site/index');
		}
	}

	public function profile(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$usertype = $this->session->userdata['usertype'];
		$id = $this->session->userdata['userid'];
		$cond = ['id'=> $id];
		$user['data'] = $this->admin_model->profile($usertype, $cond);
		$this->load->view('admin/pages/profile',$user);
		$this->load->view('admin/inc/admin_footer');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('site/index');
	}
}