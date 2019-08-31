<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class attendancereports extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Student_model');
			$this->load->model('Principal_model');
	}
	
	public function boys()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==12){
				$post=$this->input->post();	
			$detail=$this->School_model->get_resources_details($login_details['u_id']);	
			if(isset($post['submit']) && $post['submit']=='check'){
					$date=explode('/',$post['date']);
					$date_format=$date[2].'-'.$date[0].'-'.$date[1];
					$data['student_attandance']=$this->Principal_model->get_student_attendance_report_boys($post['class_id'],$date_format);
					$data['students_attandances']=$this->Principal_model->get_student_attendance_reports($post['class_id'],$date_format);
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				}else{
					$data['student_attandance']=array();
				}
				$school_details=$this->Principal_model->get_school_basic_details($login_details['u_id']);
				$data['class_list']=$this->Principal_model->get_class_list_school_wise($school_details['s_id']);
				$data['class_time']=$this->Principal_model->get_school_class_times_list($school_details['s_id']);
			   //echo '<pre>';print_r($data);exit;
			   
			   $this->load->view('principal/attendence-report-boys',$data);
			   $this->load->view('html/footer');
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}	
		
	public function girls()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==12){
				$post=$this->input->post();	
			$detail=$this->School_model->get_resources_details($login_details['u_id']);	
			if(isset($post['submit']) && $post['submit']=='check'){
					$date=explode('/',$post['date']);
					$date_format=$date[2].'-'.$date[0].'-'.$date[1];
					$data['student_attandance']=$this->Principal_model->get_student_attendance_report_girls($post['class_id'],$date_format);
					$data['students_attandances']=$this->Principal_model->get_student_attendance_reports($post['class_id'],$date_format);
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				}else{
					$data['student_attandance']=array();
				}
				$school_details=$this->Principal_model->get_school_basic_details($login_details['u_id']);
				$data['class_list']=$this->Principal_model->get_class_list_school_wise($school_details['s_id']);
				$data['class_time']=$this->Principal_model->get_school_class_times_list($school_details['s_id']);
			   //echo '<pre>';print_r($data);exit;
			   
			   $this->load->view('principal/attendence-report-girls',$data);
			   $this->load->view('html/footer');
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}		
		
	public function student()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8 || $login_details['role_id']==12){
				$post=$this->input->post();	
			$detail=$this->School_model->get_resources_details($login_details['u_id']);	
				$school_details=$this->Principal_model->get_school_basic_details($login_details['u_id']);
				$data['class_list']=$this->Principal_model->get_class_list_school_wise($school_details['s_id']);
				$data['class_time']=$this->Principal_model->get_school_class_times_list($school_details['s_id']);
			   //echo '<pre>';print_r($data);exit;
			   $this->load->view('principal/student-attendancereports',$data);
			   $this->load->view('html/footer');
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}		
	public function students()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8 || $login_details['role_id']==12){
				$post=$this->input->post();	
			if(isset($post['submit']) && $post['submit']=='check'){
					$date=explode('/',$post['date']);
					$date_format=$date[2].'-'.$date[0].'-'.$date[1];
					$data['student_attandance']=$this->Principal_model->get_student_attendance_report_list($post['class_id'],$date_format);
					$data['students_attandances']=$this->Principal_model->get_student_attendance_reports_list_data($post['class_id'],$date_format);
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				}else{
					$data['student_attandance']=array();
				}
				$school_details=$this->Principal_model->get_school_basic_details($login_details['u_id']);
				$data['class_list']=$this->Principal_model->get_class_list_school_wise($school_details['s_id']);
				$data['class_time']=$this->Principal_model->get_school_class_times_list($school_details['s_id']);
			  // echo '<pre>';print_r($data);exit;
			    $this->load->view('principal/student-attendancereports-list',$data);
			   $this->load->view('html/footer');
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}			
		
		
		
		
		
		
	
	
}	
