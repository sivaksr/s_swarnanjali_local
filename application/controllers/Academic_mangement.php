<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Academic_mangement extends In_frontend {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Academic_model');		
		$this->load->model('Transportation_model');		
		$this->load->model('Student_model');		
	
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role_id']==8){
				
			$this->load->view('html/teacher_dashboard');	
			}else{
				$this->load->view('html/dashboard');
			}
			$this->load->view('html/footer');
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public  function studentlists(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8){
				$data['class_list']=$this->Student_model->get_teacher_wise_student_list($login_details['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('demo/total-students-list');
				$this->load->view('html/footer');
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	public  function attendance(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8){
				
				$post=$this->input->post();
				//echo '<pre>';print_r($post);
				if(isset($post['submit']) && $post['submit']=='check'){
					$date=explode('/',$post['date']);
					$date_format=$date[2].'-'.$date[0].'-'.$date[1];
					$data['student_attandance']=$this->Academic_model->get_student_attendance_report($post['class_id'],$date_format);
					$data['students_attandances']=$this->Academic_model->get_student_attendance_reports($post['class_id'],$date_format);
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				}else{
					$data['student_attandance']=array();
				}
				$school_details=$this->Academic_model->get_school_basic_details($login_details['u_id']);
				$data['class_list']=$this->Academic_model->get_class_list_school_wise($school_details['s_id']);
				$data['class_time']=$this->Academic_model->get_school_class_times_list($school_details['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('academic/attendence-report',$data);
				$this->load->view('html/footer');
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}public  function marks(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8){
				$data['class_list']=$this->Student_model->get_teacher_wise_student_list($login_details['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('demo/view-marks');
				$this->load->view('html/footer');
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	public function student_transport_registration()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
                     
					
					$data['vechical_no']=$this->Transportation_model->get_vechical_number_list($detail['s_id']);
					$data['routes_number']=$this->Transportation_model->get_routes_number($detail['s_id']);
			$data['student_transport']=$this->Transportation_model->student_transport_registration($detail['s_id']);	
					
					
					//echo'<pre>';print_r($login_details);exit;
					$this->load->view('academic/student-transport-registration',$data);
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

	public function student_transport_registration_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					//echo'<pre>';print_r($detail);exit;
					 $post=$this->input->post();
		         //echo'<pre>';print_r( $post);exit;
				 $save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'student_id'=>isset($post['student_id'])?$post['student_id']:'',
				'route'=>isset($post['route'])?$post['route']:'',
				'stop'=>isset($post['stop'])?$post['stop']:'',
				'vechical_number'=>isset($post['vechical_number'])?$post['vechical_number']:'',
				'pickup_point'=>isset($post['pickup_point'])?$post['pickup_point']:'',
				'distance'=>isset($post['distance'])?$post['distance']:'',
				'amount'=>isset($post['amount'])?$post['amount']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>$login_details['u_id']
				);
				//echo'<pre>';print_r($save_data);exit;	
				$save=$this->Transportation_model->save_student_transport_data($save_data);			
				//echo'<pre>';print_r($save);exit;	
				if(count($save)>0){
						$this->session->set_flashdata('success',"student transport registration details are successfully added");	
						redirect('Academic_Mangement/student_transport_registration/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('Academic_Mangement/student_transport_registration/');
					}	
					
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function studentedit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					//echo'<pre>';print_r($login_details);exit;
					$this->uri->segment(3);
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					//echo'<pre>';print_r($detail);exit;
					
		$data['student']=$this->Transportation_model->edit_student_transport_registration($detail['s_id'],base64_decode($this->uri->segment(3)));
		//echo'<pre>';print_r($data);exit;	
			$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
   //echo'<pre>';print_r($data['class_list']);exit;			
					$data['vechical_detail']=$this->Transportation_model->get_vechical_number_list($detail['s_id']);
					//echo'<pre>';print_r($data['vechical_detail']);exit;
					$data['routes_number']=$this->Transportation_model->get_routes_number($detail['s_id']);		
				$data['route_stops']=$this->Transportation_model->vehical_wise_stops_list($data['student']['route']);		
					$data['student_name']=$this->Transportation_model->class_wise_student_list($data['student']['class_id']);	
					$data['stops_list']=$this->Transportation_model->vehical_stops_list_pickup_point($data['student']['vechical_number']);
					
					//echo'<pre>';print_r($data['stops_list']);exit;	
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('academic/student-transport-registration - edit',$data);
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
	
	public function student_transport_edit_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					//echo'<pre>';print_r($login_details);exit;
					$this->uri->segment(3);
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					 $update_data=array(
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'student_id'=>isset($post['student_id'])?$post['student_id']:'',
				'route'=>isset($post['route'])?$post['route']:'',
				'stop'=>isset($post['stop'])?$post['stop']:'',
				'vechical_number'=>isset($post['vechical_number'])?$post['vechical_number']:'',
				'pickup_point'=>isset($post['pickup_point'])?$post['pickup_point']:'',
				'distance'=>isset($post['distance'])?$post['distance']:'',
				'amount'=>isset($post['amount'])?$post['amount']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>$login_details['u_id']
				);
				//echo'<pre>';print_r($update_data);exit;	
				$update=$this->Transportation_model->update_student_transport_data($post['s_t_id'],$update_data);			
				//echo'<pre>';print_r($update);exit;	
				if(count($update)>0){
						$this->session->set_flashdata('success',"student transport registration details are successfully updated");	
						redirect('Academic_Mangement/student_transport_registration/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('Academic_Mangement/student_transport_registration/'.base64_encode($post['s_t_id']));
					}	
					
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function studentstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8){
					$s_t_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($s_t_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Transportation_model->status_student_transport_registration_details($s_t_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"student transport registration details details successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"student transport registration details successfully Activate.");
								}
								redirect('Academic_Mangement/student_transport_registration/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('Academic_Mangement/student_transport_registration/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
		
	}
	public function studentdelete()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8){
					$s_t_id=base64_decode($this->uri->segment(3));
					
							$deleted_data=$this->Transportation_model->deleted_student_transport_registration_details($s_t_id,$stusdetails);
							if(count($deleted_data)>0){
								$this->session->set_flashdata('success',"student transport registration details details successfully Deleted.");
								
								redirect('Academic_Mangement/student_transport_registration/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('Academic_Mangement/student_transport_registration/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
	}
	public function class_student_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$post=$this->input->post();
					$student_list=$this->Transportation_model->class_wise_student_list($post['class_id']);
					if(count($student_list)>0){
						$data['msg']=1;
						$data['list']=$student_list;
						echo json_encode($data);exit;	
					}else{
						$data['msg']=0;
						echo json_encode($data);exit;
					}
					
			}else{
				$this->session->set_flashdata('error',"you don't have permission to access");
				redirect('home');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function get_vehical_routes_lists(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$post=$this->input->post();
					$stops_list=$this->Transportation_model->vehical_wise_stops_list($post['route']);
					if(count($stops_list)>0){
						$data['msg']=1;
						$data['list']=$stops_list;
						echo json_encode($data);exit;	
					}else{
						$data['msg']=0;
						echo json_encode($data);exit;
					}
					
			}else{
				$this->session->set_flashdata('error',"you don't have permission to access");
				redirect('home');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function get_vehical_stop_lists(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$post=$this->input->post();
					$stops_list=$this->Transportation_model->vehical_stops_list_pickup_point($post['vechical_number']);
					
					if(count($stops_list)>0){
						$data['msg']=1;
						$data['list']=$stops_list;
						echo json_encode($data);exit;	
					}else{
						$data['msg']=0;
						echo json_encode($data);exit;
					}
					
			}else{
				$this->session->set_flashdata('error',"you don't have permission to access");
				redirect('home');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
 public function get_vechical_data_list(){
 if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$post=$this->input->post();
					$vechical_list=$this->Transportation_model->get_data_vechical_list($post['stop']);
					
					if(count($stops_list)>0){
						$data['msg']=1;
						$data['list']=$stops_list;
						echo json_encode($data);exit;	
					}else{
						$data['msg']=0;
						echo json_encode($data);exit;
					}
					
			}else{
				$this->session->set_flashdata('error',"you don't have permission to access");
				redirect('home');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	
	
	
	
	
	
}
