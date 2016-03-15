<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$data['index_data'] = $this->admin_model->index_data();
		$this->load->view('admin/pages/main_page',$data);	
		$this->load->view('admin/inc/admin_footer');	
	}

	public function userperms($type){
		$usertype = $this->session->userdata('usertype');
		if($type=="user") {
			if($usertype=="admin" or $usertype=="user"){
				return true;
			}
		}
		elseif($type=="admin"){
			if($usertype=="admin"){
				return true;
			}
		}
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
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');
			$this->form_validation->set_rules('usertype','Usertype','trim|required');
			if($this->form_validation->run()==true){
				$user = $this->admin_model->login($usertype, $cond);
				$userdata = $user->first_row('array');
				$count = $user->num_rows();
				if($count==1){
					$this->session->set_userdata('userid',$userdata['id']);
					$this->session->set_userdata('username',$userdata['username']);
					$this->session->set_userdata('display_name',$userdata['display_name']);
					$this->session->set_userdata('usertype',$userdata['usertype']);
					//$this->session->set_userdata('image',$userdata['image']);
					redirect('admin/index');
				}
				else{
					$err = $this->session->set_flashdata('err',"Invalid login. Please, login with your correct credentials");
					redirect('site/login_page');
				}
			}
			else{
				$this->session->set_flashdata('username_err',form_error('username'));
				$this->session->set_flashdata('password_err',form_error('password'));
				$this->session->set_flashdata('usertype_err',form_error('usertype'));
				redirect('site/login_page');
			}
		}
		else{
			redirect('site/login_page');
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('site/index');
	}

	public function add_user(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err','Login as admin to add user');
			redirect('site/login_page');
		}
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/add_user');	
		$this->load->view('admin/inc/admin_footer');
	}

	public function adduser_pro(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err_success','You must be logged in as admin to add user.<br> Please logIn as admin to continue');
			redirect('site/login_page');
		}
		if($_POST){
			$full_name = $this->input->post('full_name');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$email  = $this->input->post('email');
			$usertype = $this->input->post('usertype');
			$image = $_FILES['image']['name'];
			$status = $this->input->post('status');
			$data = [
					'full_name'=>$full_name,
					'username'=>$username,
					'password'=>sha1($password),
					'email'=>$email,
					'image'=>$image,
					'usertype'=>$usertype,
					'status'=>$status
				];
			$img_size = $_FILES['image']['size'];
			$tmp = $_FILES['image']['tmp_name'];
			$ext = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			$allowed_ext = array('jpeg','jpg','png','gif','bmp');
			$config = $this->form_validation->set_rules('full_name','Full Name','trim|min_length[6]|required');
			$config = $this->form_validation->set_rules('username','Username','trim|min_length[6]|required|is_unique[users.username]');
			$config = $this->form_validation->set_rules('password','Password','trim|required|max_length[20]|min_length[6]');
			$config = $this->form_validation->set_rules('confirm_password','Confirmation Password','required|matches[password]');
			$config = $this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$config = $this->form_validation->set_rules('usertype','Usertype','trim|required');
			$config = $this->form_validation->set_rules('status','Status','trim|required');
			$rules['upload_path'] = "./uploads/user_image/";
			$rules['allowed_types'] = "jpg|jpeg|png|gif|bmp";
			$rules['max_size'] = 1024;
			$rules['max_height'] = 2048;
			$rules['max_width'] = 1536;
			$this->upload->initialize($rules);
			$this->form_validation->set_rules($config);
			if($this->form_validation->run()==true){
				if(!empty($image)){
					if($this->upload->do_upload("image")){
						if($this->admin_model->add_user($data)){
							$this->session->set_flashdata('err_success','User is successfully added');
							redirect('admin/add_user');
						}
						else{
							$this->session->set_flashdata('err_success',"Unable to add the user");
							redirect('admin/add_user');
						}	
					}
					else{
						$this->session->set_flashdata('upload_err',$this->upload->display_errors());
						redirect('admin/add_user');
						
					}
				}
				else{
					if($this->admin_model->add_user($data)){
						$this->session->set_flashdata('err_success','User is successfully added');
						redirect('admin/add_user');
					}
					else{
						$this->session->set_flashdata('err_success',"Unable to add the user");
						redirect('admin/add_user');
					}
				}
				
			}
			else{
				$this->session->set_flashdata('fullname_err',form_error('full_name'));
				$this->session->set_flashdata('username_err',form_error('username'));
				$this->session->set_flashdata('password_err',form_error('password'));
				$this->session->set_flashdata('confirmpassword_err',form_error('confirm_password'));
				$this->session->set_flashdata('email_err',form_error('email'));
				$this->session->set_flashdata('usertype_err',form_error('usertype'));
				$this->session->set_flashdata('status_err',form_error('status'));
				redirect('admin/add_user');
			}

		}	
		else{
			redirect('admin/add_user');
		}
	}

	public function add_admin(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err_success','You must be logged in as admin to add new admin.<br> Please logIn as admin to continue');
			redirect('site/login_page');
		}
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/add_admin');	
		$this->load->view('admin/inc/admin_footer');
	}

	public function addadmin_pro(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err_success','You must be logged in as admin to add user.<br> Please logIn as admin to continue');
			redirect('site/login_page');
		}
		if($_POST){
			$full_name = $this->input->post('full_name');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$email  = $this->input->post('email');
			$usertype = $this->input->post('usertype');
			$image = $_FILES['image']['name'];
			$status = $this->input->post('status');
			$data = array(
					'full_name'=>$full_name,
					'username'=>$username,
					'password'=>sha1($password),
					'email'=>$email,
					'image'=>$image,
					'usertype'=>$usertype,
					'status'=>$status
				);
			$img_size = $_FILES['image']['size'];
			$tmp = $_FILES['image']['tmp_name'];
			$ext = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			$allowed_ext = ['jpeg','jpg','png','gif','bmp'];
			$config = $this->form_validation->set_rules('username','Username','trim|min_length[6]|required|is_unique[admin.username]');
			$config = $this->form_validation->set_rules('full_name','Full Name','trim|min_length[6]|required');
			$config = $this->form_validation->set_rules('password','Password','trim|required|max_length[20]|;min_length[6]');
			$config = $this->form_validation->set_rules('confirm_password','Confirmation Password','required|matches[password]');
			$config = $this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$config = $this->form_validation->set_rules('usertype','Usertype','trim|required');
			$config = $this->form_validation->set_rules('status','Status','trim|required');
			$rules['upload_path'] = "./uploads/admin_image/";
			$rules['allowed_types'] = "jpg|jpeg|png|gif|bmp";
			$rules['max_size'] = 1024;
			$rules['max_height'] = 2048;
			$rules['max_width'] = 1536;
			$this->upload->initialize($rules);
			/*$config = $this->form_validation->set_rules('image','Image','trim|required');*/
			$this->form_validation->set_rules($config);
			if($this->form_validation->run()==true){
				if($this->upload->do_upload("image")){
					$this->session->set_flashdata('err_success','Admin is successfully added');
					$this->admin_model->add_admin($data);
					redirect('admin/add_admin');
				}
				else{
					$this->session->set_flashdata('err_success',"Unable to add the admin");
					redirect('admin/add_admin');
				}
			}
			else{
				$this->session->set_flashdata('fullname_err',form_error('full_name'));
				$this->session->set_flashdata('username_err',form_error('username'));
				$this->session->set_flashdata('password_err',form_error('password'));
				$this->session->set_flashdata('confirmpassword_err',form_error('confirm_password'));
				$this->session->set_flashdata('email_err',form_error('email'));
				$this->session->set_flashdata('usertype_err',form_error('usertype'));
				$this->session->set_flashdata('status_err',form_error('status'));
				redirect('admin/add_admin');
			}

		}	
		else{
			redirect('admin/add_admin');
		}
	}

	public function manage_users(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err_success','You must be logged in as admin to add user.<br> Please logIn as admin to continue');
			redirect('site/login_page');
		}
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$data['users'] = $this->admin_model->manage_user();
		$this->load->view('admin/pages/manage_users',$data);
		$this->load->view('admin/inc/admin_footer');
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

	public function setting(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/setting');
		$this->load->view('admin/inc/admin_footer');
	}

	public function change_password(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/changePassword_form');
		$this->load->view('admin/inc/admin_footer');
	}

	public function changepassword_pro(){
		$id = $this->uri->segment(3);
		if(!empty($id)){
			if(isset($_POST)){
				if($this->session->userdata=="admin"){
				$table = "admin";
				}
				else{
					$table = "users";
				}
				$field = "password";
				$cond = array('id'=>$id);
				$result = $this->admin_model->selectby_cond($table, $field, $cond);
				//$result['0']['password'];
				$old_password = sha1($this->input->post('old_password'));
				$new_password = sha1($this->input->post('new_password'));
				$confirm_password = $this->input->post('confirm_password');
				$this->form_validation->set_rules('old_password','Old password','trim|required|min_length[6]');
				$this->form_validation->set_rules('new_password','New password','trim|required|min_length[6]|matches[confirm_password]');
				$this->form_validation->set_rules('confirm_password','Confirm password','trim|required|min_length[6]|matches[new_password]');
				if($this->form_validation->run()==true){
					if($result['0']['password']===$old_password){
						$this->admin_model->change_password($table,$id, $new_password);
						$this->session->set_flashdata('err_success','Your password is sucessfully changed.<br> Please login with your new password during next login.');
						redirect('admin/setting');
					}
					else{
						$this->session->set_flashdata('err_success','Please provide your correct password');
						redirect('admin/setting');
					}
				}
				else{
					$this->session->set_flashdata('oldpassword_err',form_error('old_password'));
					$oldpassword_err = $this->session->set_flashdata('newpassword_err',form_error('new_password'));
					$oldpassword_err = $this->session->set_flashdata('confirmpassword_err',form_error('confirm_password'));
					redirect('admin/change_password');			
				}
			}
			else{
				redirect('admin/setting');
			}
		}
		else{
			redirect('admin/setting');
		}
	}

	public function change_displayname(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/display_name');
		$this->load->view('admin/inc/admin_footer');
	}

	public function change_displayname_pro(){
		$id = $this->uri->segment(3);
		if(!empty($id)){
			if($_POST){
				if($this->session->userdata('usertype')=="admin"){
				$table = "admin";
				}
				else{
					$table = "users";
				}
				$field = "password";
				$cond = array('id'=>$id);
				$result = $this->admin_model->selectby_cond($table, $field, $cond);
				//$result['0']['password'];
				$password = sha1($this->input->post('password'));
				$display_name = $this->input->post('new_displayname');
				$this->form_validation->set_rules('password','Password','trim|required');
				$this->form_validation->set_rules('new_displayname','Display name','trim|required');
				if($this->form_validation->run()==true){
					if($result[0]['password']==$password){
						$this->admin_model->update_displayname($id, $table,$display_name);
						$this->session->set_flashdata('err_success','Your display name is successfully updated');
						redirect('admin/setting');
					}
					else{
						$this->session->set_flashdata('err_success','Password is incorrect');
						redirect('admin/change_displayname');
					}
				}
				else{
					$this->session->set_flashdata('password_err',form_error('password'));
					$this->session->set_flashdata('displayname_err',form_error('newdisplay_name'));
					redirect('admin/change_displayname');
				}
			}
			else{
				redirect('admin/setting');
			}
		}
		else{
			redirect('admin/setting');
		}
	}

	public function search(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/search');
		$this->load->view('admin/inc/admin_footer');
	}

	public function search_pro(){
		if(!empty($_GET['category'])){
			if($_GET['category'] == "packages"){
				$searchtxt = $_GET['searchtxt'];
				if(strlen($searchtxt)<3){
					$this->session->set_flashdata('err_success','The search text must be at least 4 characters long.');
					redirect('admin/search');
				}
				$data = $this->admin_model->search('packages',$searchtxt);
				$this->session->set_userdata('search_result',$data);
				redirect('admin/search');
			}

			if($_GET['category'] == "users"){
				$searchtxt = $_GET['searchtxt'];
				if(strlen($searchtxt)<3){
					$this->session->set_flashdata('err_success','The search text must be at least 4 characters long.');
					redirect('admin/search');
				}
				$data = $this->admin_model->search('users',$searchtxt);
				$this->session->set_userdata('search_result',$data);
				redirect('admin/search');
			}
		}
		else{
			$this->session->set_flashdata('err_success','Please choose a search category.');
			redirect('admin/search');
		}
	}

}