<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class In_frontend extends CI_Controller {

	
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
		$this->load->model('Student_model');
		$this->load->model('Home_model');
		$this->load->model('School_model');
		$this->load->model('Resource_model');
		$this->load->model('Announcement_model');
	
			if($this->session->userdata('userdetails'))
			{
				$details=$this->session->userdata('userdetails');
				
				$data['userdetails']=$this->Home_model->get_all_admin_details($details['u_id']);
				
				if(isset($data['userdetails']['role_id']) && $data['userdetails']['role_id']!=1){
					if($data['userdetails']['role_id']==2){
						$data['notification_list']	=$this->Home_model->get_notification_list($data['userdetails']['s_id']);
						$data['notification_count']	=$this->Home_model->get_notification_unread_count($data['userdetails']['s_id']);
					}else if($data['userdetails']['role_id']!=1 ||$data['userdetails']['role_id']!=2){
						$data['notification_list']	=$this->Home_model->get_resources_notification_list($data['userdetails']['u_id']);
						$data['notification_count']	=$this->Home_model->get_resources_notification_unread_count($data['userdetails']['u_id']);
					
					}
				}
				//echo '<pre>';print_r($data);exit;
				$this->load->view('html/header',$data);
			}
	}
	
	
}
