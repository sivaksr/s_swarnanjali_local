<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		$this->load->library('zend');
		$this->load->model('Home_model');
		
		}
	public function index()
	{	
		if(!$this->session->userdata('userdetails'))
		{
		//echo '<pre>';print_r($data);exit;
		$this->load->view('index');
		}else{
			redirect('dashboard');
		}
	}
	
	public function loginpost(){
		
		if(!$this->session->userdata('userdetails'))
		{
			$post=$this->input->post();
			$check_login=$this->Home_model->login_details($post['email'],md5($post['password']));
			//echo $this->db->last_query();exit;
			//echo '<pre>';print_r($check_login);exit;
			$this->load->helper('cookie');

			if(isset($post['remember_me']) && $post['remember_me']==1){
					$usernamecookie = array('name' => 'username', 'value' => $post["email"],'expire' => time()+86500 ,'path'   => '/');
					$passwordcookie = array('name' => 'password', 'value' => $post["password"],'expire' => time()+86500,'path'   => '/');
					$remembercookie = array('name' => 'remember', 'value' => $post["remember_me"],'expire' => time()+86500,'path'   => '/');
					$this->input->set_cookie($usernamecookie);
					$this->input->set_cookie($passwordcookie);
					$this->input->set_cookie($remembercookie);
					$this->load->helper('cookie');
					$this->input->cookie('username', TRUE);
					//echo print_r($usernamecookie);exit;

					}else{
						delete_cookie('username');
						delete_cookie('password');
						delete_cookie('remember');
					}
			if(count($check_login)>0){
				$login_details=$this->Home_model->get_login_details($check_login['u_id']);
				//echo '<pre>';print_r($login_details);exit;
				$this->session->set_userdata('userdetails',$login_details);
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('error',"Invalid Email Address or Password!");
				redirect('home');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}
	public function forgotpassword()
	{	
		if(!$this->session->userdata('userdetails'))
		{
			
			$this->load->view('forgotpasword');

		}else{
			redirect('dashboard');
		}
	}
	public function forgotpost(){
		$post=$this->input->post();
		$check_email=$this->Home_model->check_emails_exits($post['email']);
			if(count($check_email)>0){
				
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->to($check_email['email']);
				$this->email->from('admin@swarnanjali.com', 'Swarnanjali'); 
				$this->email->subject('Forgot Password'); 
				$body = "<b> Your Account login Password is </b> : ".$check_email['org_password'];
				$this->email->message($body);
				if ($this->email->send())
				{
					$this->session->set_flashdata('success',"Password sent to your registered email address. Please Check your registered email address");
					redirect('home');
				}else{
					$this->session->set_flashdata('error'," In Localhost mail  didn't sent");
					redirect('home');
				}
				}else{
            $check_emails=$this->Home_model->check_email_or_mobile_exits($post['email']);
			if(count($check_emails)>0){
				
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->to($check_emails['email']);
				$this->email->from('admin@swarnanjali.com', 'Swarnanjali'); 
				$this->email->subject('Forgot Password'); 
				$body = "<b> Your Account login Password is </b> : ".$check_emails['parent_org_password'];
				$this->email->message($body);
				if ($this->email->send())
				{
					$this->session->set_flashdata('success',"Password sent to your registered email address. Please Check your registered email address");
					redirect('home');
				}else{
					$this->session->set_flashdata('error'," In Localhost mail  didn't sent");
					redirect('home');
				}
			}
				
			
				$this->session->set_flashdata('error','The email you entered is not a registered email. Please try again. ');
				redirect('home');	
			}
		
}

	
	
	
	
}
