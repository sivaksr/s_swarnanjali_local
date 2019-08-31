<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Dashboard extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		
				
         $this->load->model('Academic_model');
         $this->load->model('Examination_model');
         $this->load->model('Transportation_model');
         $this->load->model('Hostelmanagement_model');

	
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$details=$this->Academic_model->get_school_id($admindetails['u_id']);

			//echo '<pre>';print_r($admindetails);exit;
			if($admindetails['role_id']==6){
				$student_count=$this->School_model->student_count($admindetails['u_id']);
				//echo '<pre>';print_r($student_count);exit;
				if(isset($student_count) && count($student_count)>0){
						$count='';
						foreach($student_count as $list){
							 $count += $list['count'];
						}
					$data['student_count']=$count;
				}else{
					$data['student_count']='&nbsp;';
				}
		     //echo '<pre>';print_r($data);exit;

				$teacher_class=$this->School_model->class_teacher_user($admindetails['u_id']);
				if(count($teacher_class)>0){
					foreach($teacher_class as $list){
						 $lists[]= $list['name'].' '.$list['section'];
					}
					$data['class_reacher']=implode(", ", $lists);
				}else{
					$data['class_reacher']='&nbsp;';
				}
					$data['my_class_list']=$this->School_model->class_name_user($admindetails['u_id']);
				//echo'<pre>';print_r($data);exit;
                 //$class_list=$this->School_model->class_times_classes_list();
				$data['weekday']=$this->School_model->teacher_week_days_perclass($admindetails['u_id']);		  
				$data['classschedules']=$this->School_model->classschedules_list($admindetails['u_id']);		  
				$classs_subject=$this->School_model->class_subject_list($admindetails['u_id']);
				//echo'<pre>';print_r($data);exit;

				if(count($classs_subject)>0){
					
					foreach($classs_subject as $list){
						 //echo '<pre>';print_r($list['count']);
						 $sub_lists[]= $list['subject'];
					}
					$data['classs_subject_list']=implode(", ", $sub_lists);
				}else{
					$data['classs_subject_list']='&nbsp;';
				}

				//echo '<pre>';print_r($data['classschedules']);exit;

				$calendar_event_list=$this->Home_model->get_school_calendar_event_list($details['s_id']);
				//echo '<pre>';print_r($calendar_event_list);exit;
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
//echo '<pre>';print_r($data);exit;				
		            
				$this->load->view('html/teacher_dashboard',$data);	
			}else if($admindetails['role_id']==8){
		
				$details=$this->Academic_model->get_school_id($admindetails['u_id']);
				$data['student_count']=$this->Academic_model->student_count_list($details['s_id']);
				 $data['parent_count']=$this->Academic_model->parent_count_list($details['s_id']);
				$data['fee_sum']=$this->Academic_model->fee_amount_list($details['s_id']);
			$calendar_event_list=$this->Home_model->get_school_calendar_event_list($details['s_id']);
				//echo '<pre>';print_r($calendar_event_list);exit;
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				
				//echo '<pre>';print_r($data);exit;
				$this->load->view('html/dashboard_acedamic',$data);
				
			}else if($admindetails['role_id']==5){
		            //echo'<pre>';print_r($admindetails);exit;
				$details=$this->Academic_model->get_school_id($admindetails['u_id']);
				//echo'<pre>';print_r($details);exit;
			$data['route_count']=$this->Transportation_model->route_count_data($details['s_id']);
            $data['stops_count']=$this->Transportation_model->stop_count_data($details['s_id']);
            //$data['student_count']=$this->Transportation_model->student_count_data($details['s_id']);
		    //echo $this->db->last_query();exit;
			//echo'<pre>';print_r( $data['student_count']);exit;
			
			
			$calendar_event_list=$this->Home_model->get_school_calendar_event_list($details['s_id']);
				//echo '<pre>';print_r($calendar_event_list);exit;
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				
				//echo '<pre>';print_r($data);exit;
				$this->load->view('html/dashboard_transporttation',$data);
				
			}else if($admindetails['role_id']==9){
				$exam=$this->Examination_model->exam_list_table($admindetails['u_id']);
				$data['exam_count']=$this->Examination_model->exam_pattern_table($exam['s_id']);
				$data['teacher_count']=$this->Examination_model->teacher_pattern_table($exam['s_id']);
				$data['student_count']=$this->Examination_model->student_pattern_table($exam['s_id']);
				$data['total_Earnings']=$this->Examination_model->total_pattern_table($exam['s_id']);
				$calendar_event_list=$this->Home_model->get_school_calendar_event_list($details['s_id']);
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				
				$this->load->view('html/dashboard_examination',$data);
				
			
			}else if($admindetails['role_id']==10){
				$this->load->model('Librarian_model');
				$data['book_count']=$this->Librarian_model->get_total_books_list($details['s_id']);
				
				$data['book_issued_count']=$this->Librarian_model->get_total_books_issued_list($details['s_id']);
				$data['book_damage']=$this->Librarian_model->get_book_damage_list($details['s_id']);

				$calendar_event_list=$this->Home_model->get_school_calendar_event_list($details['s_id']);
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				
				//echo '<pre>';print_r($data);exit;
				
				$this->load->view('html/dashboard_librarian',$data);
				
			}else if($admindetails['role_id']==7){
				$this->load->model('Student_model');
				$data['total_amount']=$this->Student_model->get_student_total_amount($admindetails['u_id'],$details['s_id']);
				$data['pay_amount']=$this->Student_model->get_student_pay_amount($admindetails['u_id'],$details['s_id']);
				$data['due_amount']=$this->Student_model->get_student_due_amount($admindetails['u_id'],$details['s_id']);
				$calendar_event_list=$this->Home_model->get_school_calendar_event_list($details['s_id']);
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				
				//echo '<pre>';print_r($data);exit;
				
				$this->load->view('html/dashboard_student',$data);
				
			}else if($admindetails['role_id']==11){
				$this->load->model('Hostelmanagement_model');
				$detail=$this->Student_model->get_resources_details($admindetails['u_id']);	
				$data['rooms_count']=$this->Hostelmanagement_model->get_total_rooms_hostel($detail['s_id']);
				$data['beds_count']=$this->Hostelmanagement_model->get_total_beds_hostel($detail['s_id']);
				$data['student_count_data']=$this->Hostelmanagement_model->get_total_student_hostel($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				//echo '<pre>';print_r($data);exit;
				   
				$calendar_event_list=$this->Home_model->get_school_calendar_event_list($detail['s_id']);
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				
				//echo '<pre>';print_r($data);exit;
				
				$this->load->view('html/dashboard_hostel',$data);
				
			
			}else if($admindetails['role_id']==1){
				$details=$this->Academic_model->get_school_id($admindetails['u_id']);
				$data['student_list']=$this->Home_model->get_student_list($details['s_id']);
				$data['teachers_list']=$this->Home_model->get_teachers_list($details['s_id']);
				$data['total_money']=$this->Home_model->get_get_teachers_list($details['s_id']);
				//echo'<pre>';print_r($data);exit;
				$data['event_list']=$this->Home_model->get_event_list($admindetails['u_id'],$details['s_id']);
				$calendar_event_list=$this->Home_model->get_calendar_event_list($admindetails['u_id'],$details['s_id']);
				//echo'<pre>';print_r($calendar_event_list);exit;

				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				//echo '<pre>';print_r($data);exit;
				$this->load->view('html/dashboard',$data);
			}else if($admindetails['role_id']==2||$admindetails['role_id']==3){
				
				$data['student_list']=$this->Home_model->get_student_list($details['s_id']);
				
				//echo $this->db->last_query();
				$data['teachers_list']=$this->Home_model->get_teachers_list($details['s_id']);
				$data['total_money']=$this->Home_model->get_get_teachers_list($details['s_id']);
				$data['event_list']=$this->Home_model->get_event_list($admindetails['u_id'],$details['s_id']);
				$calendar_event_list=$this->Home_model->get_calendar_event_list($admindetails['u_id'],$details['s_id']);
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				//echo '<pre>';print_r($data);exit;
				$this->load->view('html/dashboard_school',$data);
			}else{
				$data['event_list']=$this->Home_model->get_event_list($admindetails['u_id'],$details['s_id']);
				$calendar_event_list=$this->Home_model->get_calendar_event_list($admindetails['u_id'],$details['s_id']);
				if(count($calendar_event_list)>0){
					foreach($calendar_event_list as $list){
						$date_format=explode("-",$list['event_date']);
						$li[$list['c_id']]=$list;
						$li[$list['c_id']]['year']=$date_format[0];
						$li[$list['c_id']]['month']=$date_format[1]-1;
						$li[$list['c_id']]['date']=$date_format[2];
						
						
					}
					$data['calendra_events']=$li;
				}else{
					$data['calendra_events']=array();
				}
				//echo '<pre>';print_r($data);exit;
				$this->load->view('html/dashboard',$data);
			}
			
			
			$this->load->view('html/footer');
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}

	public  function addevent(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$details=$this->Academic_model->get_school_id($admindetails['u_id']);
				$post=$this->input->post();
				$add_event=array(
				's_id'=>$details['s_id'],
				'event'=>isset($post['event_name'])?$post['event_name']:'',
				'color'=>isset($post['color_type'])?$post['color_type']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$admindetails['u_id']
				);
				$save_event=$this->Home_model->save_event($add_event);
				if(count($save_event)>0){
					$this->session->set_flashdata('success','Event Successfully Added');
					redirect('dashboard');
					
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('dashboard');
				}
				//echo'<pre>';print_r($add_event);exit;
		
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public  function removeevent(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$details=$this->Academic_model->get_school_id($admindetails['u_id']);
				$post=$this->input->post();
				$id=base64_decode($this->uri->segment(3));
				$save_event=$this->Home_model->remove_event($id);
				if(count($save_event)>0){
					$this->session->set_flashdata('success','Event Successfully removed');
					redirect('dashboard');
					
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('dashboard');
				}
				//echo'<pre>';print_r($add_event);exit;
		
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	
	public function remove_events(){
		
		if($this->session->userdata('userdetails'))
		{
			$post = $this->input->post();
			
				$removedattch=$this->Home_model->remove_event($post['event_id']);
				if(count($removedattch) > 0)
				{
				$data['msg']=1;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=0;
					echo json_encode($data);exit;
				}
			
		}else{
			 $this->session->set_flashdata('error','Please login to continue');
			 redirect('Home');
			
		}
	}
	
	public  function save_add_event_calender(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			$details=$this->Academic_model->get_school_id($admindetails['u_id']);
				$post=$this->input->post();
				$add_event=array(
				's_id'=>$details['s_id'],
				'event_id'=>isset($post['event_id'])?$post['event_id']:'',
				'title'=>isset($post['title'])?$post['title']:'',
				'color'=>isset($post['color'])?$post['color']:'',
				'event_date'=>isset($post['timedate'])?$post['timedate']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$admindetails['u_id']
				);
				$check=$this->Home_model->check_save_calendar_exist($details['s_id'],$post['event_id'],$post['timedate'],$admindetails['u_id']);
				
				//echo $this->db->last_query();
				//echo'<pre>';print_r($check);exit;
				if(count($check)>0){
					$data['msg']=2;
					echo json_encode($data);exit;
				}else{
					$save_event=$this->Home_model->save_calendar_event($add_event);
						if(count($save_event)>0){
							$data['msg']=1;
							echo json_encode($data);exit;	
						}else{
							$data['msg']=0;
							echo json_encode($data);exit;
						}	
				}
				
				//echo'<pre>';print_r($add_event);exit;
		
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public  function delete_add_event_calender(){
		if($this->session->userdata('userdetails'))
		{
					$admindetails=$this->session->userdata('userdetails');
					$post=$this->input->post();
					$delete=$this->Home_model->delete_calendar_event($post['c_id']);
						if(count($delete)>0){
							$data['msg']=1;
							echo json_encode($data);exit;	
						}else{
							$data['msg']=0;
							echo json_encode($data);exit;
						}	
				
				
				//echo'<pre>';print_r($add_event);exit;
		
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function logout(){
		$admindetails=$this->session->userdata('userdetails');
		$userinfo = $this->session->userdata('userdetails');
        $this->session->unset_userdata($userinfo);
		$this->session->sess_destroy('userdetails');
		$this->session->unset_userdata('userdetails');
		redirect('home');
	}
	
	
	
	
}
