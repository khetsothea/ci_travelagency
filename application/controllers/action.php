<?php 
class Action extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function userperms($type){
		$usertype = $this->session->userdata('usertype');
		if($type == "other"){
			if($usertype){
				return true;
			}
		}
		else if($type == "user"){
			if($usertype == "admin" or $usertype == "user"){
				return true;
			}
		}
		else if($type == "admin"){
			if($usertype == "admin"){
				return true;
			}
		}
	}

	public function user_edit(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err_success','You must be logged in as admin to add user.<br> Please logIn as admin to continue');
			redirect('site/login_page');
		}

		$id = $this->uri->segment(3);
		if(empty($id)){
			redirect('admin/manage_users');
		}
		$data['user'] = $this->admin_model->manage_user($id);
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/edit_form',$data);	
		$this->load->view('admin/inc/admin_footer');
	}

	public function edit_pro(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err_success','You must be logged in as admin to add user.<br> Please logIn as admin to continue');
			redirect('site/login_page');
		}

		if($_POST){
			$id = $this->input->post('id');
			$full_name = $this->input->post('full_name');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$confirm_password = $this->input->post('confirm_password');
			$email  = $this->input->post('email');
			$usertype = $this->input->post('usertype');
			$image = $_FILES['image']['name'];
			$status = $this->input->post('status');
			$img_size = $_FILES['image']['size'];
			$tmp = $_FILES['image']['tmp_name'];
			$ext = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			$allowed_ext = ['jpeg','jpg','png','gif','bmp'];
			$config = $this->form_validation->set_rules('full_name','Full Name','trim|min_length[6]|required');
			$config = $this->form_validation->set_rules('password','Password','trim|required|max_length[20]|;min_length[6]');
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
			/*$config = $this->form_validation->set_rules('image','Image','trim|required');*/
			$this->form_validation->set_rules($config);
			if($this->form_validation->run()==true){
				if(!empty($image)){
					if($this->upload->do_upload("image")){
						$data = [
							'full_name'=>$full_name,
							'password'=>sha1($password),
							'email'=>$email,
							'image'=>$image,
							'usertype'=>$usertype,
							'status'=>$status
						];
						if($this->admin_model->update_user($data,$id)){
							$this->session->set_flashdata('err_success','User data is successfully updated');
							redirect('action/edit/'.$id);
						}
						else{
							$this->session->set_flashdata('err_success',"Unable to add the user");
							redirect('action/edit/'.$id);
						}	
					}
					else{
						$this->session->set_flashdata('upload_err',$this->upload->display_errors());
						redirect('action/edit/'.$id);
						
					}
				}
				else{
					if(empty($image)){
						$image = $old_image; 
					}
					$data = [
						'full_name'=>$full_name,
						'password'=>sha1($password),
						'email'=>$email,
						'image'=>$image,
						'usertype'=>$usertype,
						'status'=>$status
					];
					if($this->admin_model->update_user($data,$id)){
						$this->session->set_flashdata('err_success','User data is successfully updated');
						redirect('action/edit/'.$id);
					}
					else{
						$this->session->set_flashdata('err_success',"Unable to  update the userdata");
						redirect('action/edit/'.$id);
					}
				}
			}
			else{
				$this->session->set_userdata('id',$id);
				$this->session->set_flashdata('fullname_err',form_error('full_name'));
				$this->session->set_flashdata('password_err',form_error('password'));
				$this->session->set_flashdata('confirmpassword_err',form_error('confirm_password'));
				$this->session->set_flashdata('email_err',form_error('email'));
				$this->session->set_flashdata('usertype_err',form_error('usertype'));
				$this->session->set_flashdata('status_err',form_error('status'));
				redirect('action/edit/'.$id);
			}

		}	
		else{
			redirect('admin');
		}
	}

	public function pricing_delete(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err','Login as admin to add user');
			redirect('site/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id) and is_numeric($id)){
			$this->admin_model->delete($id,'pricing_table');
			$this->session->set_flashdata('err_success','One row is successfully deleted');
			redirect('action/pricing_table');
		}
		else{
			redirect('action/pricing_table');
		}
	}

	public function user_delete(){
		if(!$this->userperms("admin")){
			$this->session->set_flashdata('err_success','You must be logged in as admin to delete.<br> Please logIn as admin to continue');
			redirect('site/login_page');
		}
	
		$id = $this->uri->segment(3);
		if(!empty($id) and is_numeric($id)){
			if($this->admin_model->delete($id,'users')){
				$this->session->set_flashdata('err_success','One user is successfully delete from the database');
				redirect('admin/manage_users');
			}
			else{
				$this->session->set_flashdata('err_success',"Unable to delete the user");
				redirect('admin/manage_users');
			}
		}
		else{
			redirect('admin/manage_users');
		}
	}

	public function add_package(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$this->load->view('admin/pages/addpackage_form');	
		$this->load->view('admin/inc/admin_footer');
	}

	public function addpackage_pro(){
		if($_POST){
			$title = $this->input->post('title');
			$desc = $this->input->post('description');
			$status = $this->input->post('status');
			$added_by = $this->session->userdata('username');
			$image = $_FILES['image']['name'];
			$ext = strtolower(pathinfo($image,PATHINFO_EXTENSION));
			$allowed_ext = ['jpeg','jpg','png','gif','bmp'];
			$this->form_validation->set_rules('title','Title','trim|min_length[6]|required');
			$this->form_validation->set_rules('description','Description','trim|required|;min_length[6]');
			$this->form_validation->set_rules('status','Status','trim|required');
			$rules['upload_path'] = "./uploads/package_image/";
			$rules['allowed_types'] = "jpg|jpeg|png|gif|bmp";
			$rules['max_size'] = 1024;
			$rules['max_height'] = 2048;
			$rules['max_width'] = 2048;
			$this->upload->initialize($rules);
			if($this->form_validation->run()==true){
				if(!empty($image)){
					if($this->upload->do_upload("image")){
						$data = [
							'title'=>$title,
							'description'=>$desc,
							'added_by'=>$added_by,
							'image'=>$image,
							'status'=>$status
						];
						if($this->admin_model->add_package($data)){
							$this->session->set_flashdata('err_success','Package is successfully added');
							redirect('action/add_package');
						}
						else{
							$this->session->set_flashdata('err_success',"Unable to add the package");
							redirect('action/add_package');
						}	
					}
					else{
						$this->session->set_flashdata('upload_err',$this->upload->display_errors());
						redirect('action/add_package');
						
					}
				}
				else{
					if(empty($image)){
						$data = [
								'title'=>$title,
								'description'=>$desc,
								'added_by'=>$added_by,
								'image'=>$image,
								'status'=>$status
						];
						if($this->admin_model->add_package($data)){
							$this->session->set_flashdata('err_success','Package is successfully added');
							redirect('action/add_package');
						}
						else{
							$this->session->set_flashdata('err_success',"Unable to  add the package");
							redirect('action/add_package');
						}
					}
				}
			}
			else{
				$this->session->set_flashdata('title_err',form_error('title'));
				$this->session->set_flashdata('desc_err',form_error('description'));
				$this->session->set_flashdata('status_err',form_error('status'));
				redirect('action/add_package');
			}

		}	
		else{
			redirect('admin');
		}
	}

	public function package_list($start = 0){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$data['results'] = $this->admin_model->data(5,$start,'packages');
 		$config['base_url'] = base_url().'action/package_list';
 		$config['per_page'] = 5;
 		$config['total_rows'] = $this->admin_model->row_count('packages');
 		$this->pagination->initialize($config);
 		$data['pages'] = $this->pagination->create_links();
		//$data['package'] = $this->admin_model->package_list();
		$this->load->view('admin/pages/package_list',$data);	
		$this->load->view('admin/inc/admin_footer');
	}

	public function booked_packages(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$data['booked_packages'] = $this->admin_model->booked_packages();
		$cond = 'order_by.packages_id = packages.id';
		$data['package_name'] = $this->admin_model->select_join('order_by','packages',$cond);
		$this->load->view('admin/pages/booked_packages',$data);
		$this->load->view('admin/inc/admin_footer');
	}

	public function package_view(){
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$data['packages'] = $this->admin_model->selectby_cond("packages","",array('id'=>$id));
			$this->load->view('admin/inc/admin_header');
			$this->load->view('admin/inc/admin_nav');
			$this->load->view('admin/inc/admin_sidebar');
			$this->load->view('admin/pages/package_view',$data);
			$this->load->view('admin/inc/admin_footer');
		}
		else{
			redirect('action/package_list');
		}
	}

	// //booked package approve
	// public function approve(){
	// 	$id = $this->uri->segment(3);
	// 	$table_name = $this->uri->segment(4);
	// 	$this->admin_model->approve($id, $table_name);
	// 	redirect('action/booked_packages');
	// }

	// public function stall(){
	// 	$id = $this->uri->segment(3);
	// 	$table_name = $this->uri->segment(4);
	// 	$this->admin_model->stall($id, $table_name);
	// 	redirect('action/booked_packages');
	// }

	//approving the requested packages
	public function approve(){
		$id = $this->uri->segment(3);
		$table_name = $this->uri->segment(4);
		$page = $this->uri->segment(5);
		$email = $this->admin_model->email_single($table_name,$id);
		$subject = "<h2><strong>Approval of the requested package</strong></h2>";
		$message = "If you didn't request for the tour package. Please kindly ignore the message.<br>Your requested package is successfully approved. Please visit us as soon as possible. Our travel agency will be awaiting for you.<br> The world is waiting for you to explore.<br>Thank you!!!!";
		//send_email('recipient', 'subject', 'message')
		if(send_email($email, $subject, $message)){
			$this->session->set_flashdata('err_success', "The tour package is successfully approved and the email was sent to the customer.");
		}
		else{
			$this->session->set_flashdata('err_success', "Unable to send the email.");
		}
		$this->admin_model->approve($id, $table_name);
		redirect('action/'.$page);
	}

	public function stall(){
		$id = $this->uri->segment(3);
		$table_name = $this->uri->segment(4);
		$page = $this->uri->segment(5);
		$email = $this->admin_model->email_single($table_name,$id);
		$subject = "<h2><strong>Approval of the requested package</strong></h2>";
		$message = "If you didn't request for the tour package. Please kindly ignore the message.<br>Your requested package is waiting to be approved. For now we have stalled. We will be in touch with you as soon as possible. Your tour package will be available as soon as possible<br>Thank you!!!!";
		//send_email('recipient', 'subject', 'message')
		if(send_email($email, $subject, $message)){
			$this->session->set_flashdata('err_success', "The tour package is stalled and the email was sent to the cutomer.");
		}
		else{
			$this->session->set_flashdata('err_success', "Unable to send the email.");
		}
		$this->admin_model->stall($id, $table_name);
		redirect('action/'.$page);
	}

	/*public function stall(){
		$id = $this->uri->segment(3);
		$table_name = $this->uri->segment(4);
		$this->admin_model->email_single($table_name,$id);
		$this->admin_model->stall($id, $table_name);
		$email = $this->admin_model->email_single($table_name,$id);
		$subject = "<h2><strong>Approval of the requested package</strong></h2>";
		$message = "If you didn't request for the tour package. Please kindly ignore the message.<br>Your requested package is waiting to be approved. For now we have stalled. We will be in touch with you as soon as possible. Your tour package will be available as soon as possible<br>Thank yoru!!!!";
		//send_email('recipient', 'subject', 'message')
		if(send_email($email, $subject, $message)){
			$this->session->set_flashdata('err_success', "The tour package is stalled and the email was sent to the cutomer.");
		}
		else{
			$this->session->set_flashdata('err_success', "Unable to send the email.");
		}
		$this->admin_model->stall($id, $table_name);
		redirect('action/'.$page);
	}*/

	public function package_delete($id){
		if($this->admin_model->package_delete($id)){
			$this->session->set_flashdata('err_success','One package is successfully deleted');
			redirect('action/booked_packages');
		}
		else{
			$this->session->set_flashdata('err_success','Unable to delete this package');
			redirect('action/booked_packages');
		}
	}

	public function requested_packages(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$data['requested_packages'] = $this->admin_model->requested_packages();
		$this->load->view('admin/pages/requested_packages',$data);
		$this->load->view('admin/inc/admin_footer');
	}

	public function requestedpackage_delete($id){
		if($this->admin_model->requestedpackage_delete($id)){
			$this->session->set_flashdata('err_success','One package is successfully deleted');
			redirect('action/requested_packages');
		}
		else{
			$this->session->set_flashdata('err_success','Unable to delete this package');
			redirect('action/requested_packages');
		}
	}

	public function available($id, $table_name="packages"){
		$id = $this->uri->segment(3);
		$this->admin_model->approve($id, $table_name);
		redirect('action/package_list');
	}

	public function not_available($id, $table_name="packages"){
		$id = $this->uri->segment(3);
		$this->admin_model->stall($id, $table_name);
		redirect('action/package_list');
	}

	public function edit_package(){
		$id = $this->uri->segment(3);
		if(!empty($id) and is_numeric($id)){
			$this->load->view('admin/inc/admin_header');
			$this->load->view('admin/inc/admin_nav');
			$this->load->view('admin/inc/admin_sidebar');
			$cond = ['id'=>$id];
			$data['package'] = $this->admin_model->package($cond);
			$this->load->view('admin/pages/edit_package',$data);	
			$this->load->view('admin/inc/admin_footer');
		}
		else{
			redirect('action/package_list');
		}
		
	}

	public function editpackage_pro(){
		if($_POST){
			$id = $this->uri->segment(3);
			if(!empty($id) and is_numeric($id)){
				$title = $this->input->post('title');
				$desc = $this->input->post('desc');
				$status = $this->input->post('status');
				$added_by = $this->input->post('added_by');
				$image = $_FILES['image']['name'];
				$this->form_validation->set_rules('title','Title','trim|min_length[6]|required');
				$this->form_validation->set_rules('desc','Description','trim|required|min_length[6]');
				$this->form_validation->set_rules('status','Status','trim|required');
				$this->form_validation->set_rules('added_by','Added by','trim|required|min_length[6]');
				$rules['upload_path'] = "./uploads/package_image/";
				$rules['allowed_types'] = "jpg|jpeg|png|gif|bmp";
				$rules['max_size'] = 1024;
				$rules['max_height'] = 2048;
				$rules['max_width'] = 1536;
				$this->upload->initialize($rules);
				if($this->form_validation->run()==true){
					if(!empty($image)){
						if($this->upload->do_upload("image")){
							$data = [
								'title'=>$title,
								'description'=>$desc,
								'added_by'=>$added_by,
								'image'=>$image,
								'status'=>$status
							];
							if($this->admin_model->update_package($id, $data)){
								$this->session->set_flashdata('err_success','Package is successfully added');
								redirect('action/package_list');
							}
							else{
								$this->session->set_flashdata('err_success',"Unable to add the package");
								redirect('action/edit_package/'.$id);
							}	
						}
						else{
							$this->session->set_flashdata('upload_err',$this->upload->display_errors());
							redirect('action/edit_package/'.$id);
							
						}
					}
					else{
						if(empty($image)){
							$data = [
									'title'=>$title,
									'description'=>$desc,
									'added_by'=>$added_by,
									'status'=>$status
							];
							if($this->admin_model->update_package($id, $data)){
								$this->session->set_flashdata('err_success','Package is successfully added');
								redirect('action/package_list');
							}
							else{
								$this->session->set_flashdata('err_success',"Unable to  add the package");
								redirect('action/edit_package/'.$id);
							}
						}
					}
				}
				else{
					$this->session->set_flashdata('title_err',form_error('title'));
					$this->session->set_flashdata('desc_err',form_error('description'));
					$this->session->set_flashdata('status_err',form_error('status'));
					$this->session->set_flashdata('addedby_err',form_error('added_by'));
					redirect('action/edit_package/'.$id);
				}
			}
			else{
				redirect('action/package_list');
			}
		}	
		else{
			redirect('admin');
		}
	}

	public function delete_package(){
		if($this->session->userdata('usertype')=="admin"){
			$id = $this->uri->segment(3);
			if(!empty($id) and is_numeric($id)){
				if($this->admin_model->delete_package($id)){
					$this->session->set_flashdata('err_success','One package is successfully delete from the database');
					redirect('action/package_list');
				}
				else{
					$this->session->set_flashdata('err_success',"Unable to delete the user");
					redirect('action/package_list');
				}
			}
			else{
				redirect('action/package_list');
			}
		}
		else{
			redirect('site');
		}
	}

	public function change_image(){
		$id = $this->uri->segment(3);
		if(!empty($id) and is_numeric($id)){
			$this->load->view('admin/inc/admin_header');
			$this->load->view('admin/inc/admin_nav');
			$this->load->view('admin/inc/admin_sidebar');
			if($this->session->userdata('usertype')=="admin"){
				$table_name = 'admin';
			}
			else{
				$table_name = 'users';
			}
			$data['user'] = $this->admin_model->selectby_cond($table_name,'',array('id'=>$id));
			$this->load->view('admin/pages/change_image',$data);
			$this->load->view('admin/inc/admin_footer');
		}
		else{
			redirect('admin/setting');
		}		
	}

	public function changeimage_pro(){
		$id = $this->uri->segment(3);
		if($_POST['btnSubmit'] and !empty($id) and is_numeric($id)){
			if($this->session->userdata('usertype')=="admin"){
				$rules['upload_path'] = "./uploads/admin_image/";
				$table_name = "admin";
			}
			else{
				$rules['upload_path'] = "./uploads/user_image/";
				$table_name = "user";
			}
			$img_name = $_FILES['image']['name'];
			$rules['allowed_types'] = "jpg|jpeg|png|gif|bmp";
			$rules['max_size'] = 1024;
			$this->load->library('upload');
			$this->upload->initialize($rules);
			if($this->upload->do_upload('image')){	
				$this->admin_model->change_image($id,$table_name,$img_name);
				$this->session->set_flashdata('err_success','Your profile image is successfully changed.');
				redirect('admin/profile');
			}
			else{
				$this->session->set_flashdata('err_success',$this->upload->display_errors());
				redirect('admin/setting');
					
			}
		}
		else{
			redirect('admin/setting');
		}
	}

	public function change_status(){
		$id = $this->uri->segment(3);
		if(!empty($id) and is_numeric($id)){
			$this->load->view('admin/inc/admin_header');
			$this->load->view('admin/inc/admin_nav');
			$this->load->view('admin/inc/admin_sidebar');
			if($this->session->userdata('usertype')=="admin"){
				$table_name = 'admin';
			}
			else{
				$table_name = 'users';
			}
			$data['user'] = $this->admin_model->selectby_cond($table_name,'',array('id'=>$id));
			$this->load->view('admin/pages/change_status',$data);
			$this->load->view('admin/inc/admin_footer');
		}
		else{
			redirect('admin/setting');
		}
	}

	public function changestatus_pro(){
		$id = $this->uri->segment(3);
		if($_POST and !empty($id) and is_numeric($id)){
			if($this->session->userdata('usertype') == "admin"){
				$table_name = "admin";
			}
			else{
				$table_name = "users";
			}
			$status = $this->input->post('status');
			$data = array('status'=>$status);
			$cond = array('id'=>$id);
			$this->admin_model->update($table_name,$data,$cond);
			$this->session->set_flashdata('err_success','Your status is successfully changed.');
			redirect('admin/profile');
		}
		else{
			redirect('admin/setting');
		}
	}

	public function add_pricing(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$data['package'] = $this->admin_model->select_all('packages','');
		$this->load->view('admin/pages/add_pricing',$data);
		$this->load->view('admin/inc/admin_footer');
	}

	public function addpricing_pro(){
		if($_POST){
			$price = $this->input->post('price');
			$persons = $this->input->post('no_of_persons'); 
			$days = $this->input->post('days');
			$facilities = $this->input->post('facilities');
			$package_id = $this->input->post('package_id');
			$this->form_validation->set_rules('price','Price','trim|required');
			$this->form_validation->set_rules('no_of_persons','Number of persons','trim|required');
			$this->form_validation->set_rules('days','Days','trim|required');
			$this->form_validation->set_rules('facilities','Facilities','trim|required|min_length[20]');
			$this->form_validation->set_rules('package_id','Package','trim|required');
			$table_name = 'pricing_table';
			$data = [
					'price'     =>$price,
					'persons'   =>$persons,
					'days'      =>$days,
					'facilities'=>$facilities,
					'package_id'=>$package_id
				];
			if($this->form_validation->run()==true){
				$this->admin_model->insert_data($table_name,$data);
				$this->session->set_flashdata('err_success','Your pricing table is successfully added');
				redirect('action/add_pricing');
			}
			else{
				$this->session->set_flashdata('price_err',form_error('price'));
				$this->session->set_flashdata('person_err',form_error('no_of_persons'));
				$this->session->set_flashdata('days_err',form_error('days'));
				$this->session->set_flashdata('facilities_err',form_error('facilities'));
				$this->session->set_flashdata('packageid_err',form_error('package_id'));
				redirect('action/add_pricing');
			}
		}
		else{
			redirect('action/add_pricing');
		}
	}

	public function pricing_table(){
		$this->load->view('admin/inc/admin_header');
		$this->load->view('admin/inc/admin_nav');
		$this->load->view('admin/inc/admin_sidebar');
		$data['pricing'] = $this->admin_model->select_all('pricing_table','');
		$cond = 'pricing_table.package_id = packages.id';
		$data['package'] = $this->admin_model->select_join('pricing_table','packages',$cond);
		$this->load->view('admin/pages/pricing',$data);
		$this->load->view('admin/inc/admin_footer');
	}

}