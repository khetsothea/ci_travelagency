<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	 class Site extends CI_Controller{

	 	public function __construct(){
	 		parent::__construct();
	 		$this->load->model('site_model');
	 	}

	 	public function index(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$data['package'] = $this->site_model->select('packages',3);
	 		$data['slider'] = $this->site_model->select('packages',6);
	 		$this->load->view('pages/index',$data);
	 		$this->load->view('includes/footer');
	 	} 

	 	public function view_single(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$id = $this->uri->segment(2);
	 		if(empty($id)){
	 			redirect('site');
	 		}
	 		$cond = array('id'=>$id);
	 		$data['package'] = $this->site_model->selectby_cond('packages',$cond);
	 		if(empty($data['package'])){
	 			redirect('site');
	 		}
	 		$this->load->view('pages/view_single',$data);
	 		$this->load->view('includes/footer');
	 	}

	 	public function about(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/about');
	 		$this->load->view('includes/footer');	
	 	}
	 	
	 	public function services(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/services');
	 		$this->load->view('includes/footer');
	 	}
	 	
	 	public function contact(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');

	 		if($_POST){
		 		$this->site_model->contact();
		 	}

	 		$this->load->view('pages/contact');
	 		$this->load->view('includes/footer');
	 	}

	 	// public function contact_us(){
		 // 	if($_POST){
		 // 		$name = $this->input->post('name');
		 // 		$email =  $this->input->post('email');
		 // 		$phone =  $this->input->post('phone');
		 // 		$message =  $this->input->post('message');
		 // 		if(empty($name) or empty($email) or empty($phone) or empty($message)){
		 // 			$this->session->set_flashdata('err_success',"All fields are striclty required");
		 // 			redirect('site/contact');
		 // 		}
		 // 		else{
		 // 			$email_body = "You have received a new message from your website's contact form.\n\n"."Here are the details:\n\nName: $name\n\nPhone: $phone\n\nEmail: $email\n\nMessage:\n$message";
			// 		$headers = "From: noreply@your-domain.com\n";
			// 		$headers .= "Reply-To: $email";
		 // 			$mail = mail($to, $subject, $email_body, $headers);
		 // 			if($mail){
		 // 				$this->session->set_flashdata('err_success',"Your message was successfully sent");
		 // 				redirect('site/contact');
		 // 			}
		 // 			else{
		 // 				$this->session->set_flashdata('err_success',"Something went wrong");
		 // 				redirect('site/contact');
		 // 			}
		 // 		}
		 // 	}
		 // 	else{
		 // 		redirect('site/contact');
		 // 	}
	 	
	 	// }

	 	public function blogs(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/blogs');
	 		$this->load->view('includes/footer');
	 	}

	 	public function portfolio(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$data['slider'] = $this->site_model->select('packages',6);
	 		$this->load->view('pages/portfolio',$data);
	 		$this->load->view('includes/footer');
	 	}

	 	public function faq(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/faq');
	 		$this->load->view('includes/footer');
	 	}

	 	public function package(){
	 		if(isset($_POST['btnSubmit'])){
	 			$id = $this->input->post('package_id');
	 			$cond = array('id'=> $id);
	 			$data['packages'] = $this->site_model->selectby_cond('packages',$cond);
	 			$this->load->view('includes/header');
		 		$this->load->view('includes/navigation');
		 		$this->load->view('pages/package',$data);
		 		$this->load->view('includes/footer');
	 		}
	 		else{
	 			redirect('index');
	 		}
	 	}
	 	
	 	public function packages(){
	 		$data['packages'] = $this->site_model->package_list();
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/packages',$data);
	 		$this->load->view('includes/footer');
	 	}

	 	public function order_package(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/order_package');
	 		$this->load->view('includes/footer');
	 	}

	 	public function orderpackage_pro(){
	 		if($_POST){
	 			$name = $this->input->post('name');
	 			$email = $this->input->post('email');
	 			$phone = $this->input->post('phone');
	 			$country = $this->input->post('country');
	 			$tour_desc = $this->input->post('tour_desc');
	 			$queries = $this->input->post('queries');
	 			$this->form_validation->set_rules('name','full name','trim|required');
	 			$this->form_validation->set_rules('email','Email','trim|required|is_valid');
	 			$this->form_validation->set_rules('country','Country name','trim|required');
	 			if($this->form_validation->run()==true){
	 				$data = array(
	 						'customer_name'   => $name,
	 						'email'           => $email,
	 						'phone'           => $phone,
	 						'country'         => $country,
	 						'package_desc'    => $tour_desc,
	 						'query'           => $queries
	 					);
	 				if($this->site_model->order_package($data)){
	 					$this->session->set_flashdata('msg','Thanks for ordering package from our travel agency. We will notify you when its available. Your package is successfully added for further processing.');
	 					redirect('success_page');
	 				}
	 				else{
	 					$this->session->set_flashdata('err_msg','Unable to add your package.<br>Please try again');
	 					redirect('order_package');
	 				}
	 			}
	 			else{
	 				$this->session->set_flashdata('name_err',form_error('name'));
	 				$this->session->set_flashdata('email_err',form_error('email'));
	 				$this->session->set_flashdata('country_err',form_error('country'));
	 				redirect('order_package');
	 			}
	 		}
	 		else{
	 			redirect('order_package');
	 		}
	 	}

	 	public function book_package(){
	 		$pack_id = $this->input->post('package_id');
			$this->session->set_userdata('package_id',$pack_id);
			$data['packages'] = $this->site_model->package_list();
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/book_package',$data);
	 		$this->load->view('includes/footer');
	 	}

	 	public function bookpackage_pro(){
	 		if($_POST){
	 			$package_id = $this->session->userdata('package_id');
	 			if(empty($package_id)){
	 				$package_id = $this->input->post('package_name');
	 			}
	 			$name = $this->input->post('name');
	 			$email = $this->input->post('email');
	 			$phone = $this->input->post('phone');
	 			$country = $this->input->post('country');
	 			$tour_desc = $this->input->post('tour_desc');
	 			$queries = $this->input->post('queries');
	 			$this->form_validation->set_rules('name','full name','trim|required');
	 			$this->form_validation->set_rules('email','Email','trim|required|is_valid');
	 			$this->form_validation->set_rules('country','Country name','trim|required');
	 			if($this->form_validation->run()==true){
	 				$data = array(
	 						'name'        => $name,
	 						'email'       => $email,
	 						'phone'       => $phone,
	 						'country'     => $country,
	 						'query'       => $queries,
	 						'packages_id' => $package_id
	 					);
	 				if($this->site_model->book_package($data)){
	 					$this->session->set_flashdata('msg','Thanks for booking package from our travel agency. We will notify you when its available. Your package is successfully booked.');
	 					redirect('success_page');
	 				}
	 				else{
	 					$this->session->set_flashdata('err_msg','Unable to book this package for you.<br>Please try again');
	 					redirect('book_package');
	 				}
	 			}
	 			else{
	 				$this->session->set_flashdata('name_err',form_error('name'));
	 				$this->session->set_flashdata('email_err',form_error('email'));
	 				$this->session->set_flashdata('country_err',form_error('country'));
	 				redirect('book_package');
	 			}
	 		}
	 		else{
	 			redirect('book_package');
	 		}
	 	}

	 	public function success_page(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/success_page');
	 		$this->load->view('includes/footer');
	 	}

	 	public function pricing(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->model('admin_model');
	 		$cond = 'pricing_table.package_id = packages.id';
	 		$data['pricing'] = $this->admin_model->select_join('pricing_table','packages',$cond);
	 		$this->load->view('pages/pricing',$data);
	 		$this->load->view('includes/footer');
	 	}

	 	public function login_page(){
	 		$this->load->view('includes/header');
	 		$this->load->view('includes/navigation');
	 		$this->load->view('pages/login_page');
	 		$this->load->view('includes/footer');
	 	}
	 
	}