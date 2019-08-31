<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Student extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Student_model');
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3 || $login_details['role_id']==8){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['tab']=base64_decode($this->uri->segment(3));
				$data['school_details']=$this->School_model->get_school_basic_details_with_resourse($login_details['u_id']);
				//echo $this->db->last_query();exit;
				$data['role_list']=$this->Home_model->get_roles_list();
				$data['student_list']=$this->Student_model->get_student_list($detail['s_id']);
				//echo '<pre>';print_r($data['student_list']);exit;
				$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);

				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/add-student',$data);
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
	
	
	// payment page
	public function payment()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3 || $login_details['role_id']==8 || $login_details['role_id']==7){
			
				$student_id=base64_decode($this->uri->segment(3));
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_details']=$this->Student_model->get_student_details($student_id);
				$data['last_payment_details']=$this->Student_model->get_student_last_payment_details($student_id);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/payment',$data);
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
	
	public function edit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3 || $login_details['role_id']==8){
				$student_id=base64_decode($this->uri->segment(3));
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_list']=$this->Student_model->get_student_details($student_id);
				$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/edit-student',$data);
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
	public function addpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3 || $login_details['role_id']==8){
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$check_email_mobile=$this->Home_model->check_email_mobile_exits($post['parent_email'],$post['mobile']);
					if(($check_email_mobile)>0){
						$this->session->set_flashdata('error',"Both Email Id and Mobile number already exists. Please use another Email Id and Mobile Number");
						redirect('student');
					}
			
				$check_email=$this->Home_model->check_email_exits($post['parent_email']);
					//echo '<pre>';print_r($check_email);exit;
					if(($check_email)>0){
						$this->session->set_flashdata('error',"Email Id already exists. Please use another Email Id");
						redirect('student');
					}
				$check_mobile=$this->Home_model->check_mobile_exits($post['mobile']);
					if(($check_mobile)>0){
						$this->session->set_flashdata('error',"Mobile Number already exists. Please use another Mobile Number");
						redirect('student');
					}
			
					if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name']!=''){
						$temp = explode(".", $_FILES["profile_pic"]["name"]);
						$image = round(microtime(true)) . '.' . end($temp);
						move_uploaded_file($_FILES['profile_pic']['tmp_name'], "assets/adminpic/" . $image);
					}else{
						$image='';
					}
					if(isset($post['address_same']) && $post['address_same']=='on'){
						$p_add=isset($post['current_address'])?$post['current_address']:'';
						$p_city=isset($post['current_city'])?$post['current_city']:'';
						$p_state=isset($post['current_state'])?$post['current_state']:'';
						$p_country=isset($post['current_country'])?$post['current_country']:'';
						$p_pincode=isset($post['current_pincode'])?$post['current_pincode']:'';
					}else{
						$p_add=isset($post['per_address'])?$post['per_address']:'';
						$p_city=isset($post['per_city'])?$post['per_city']:'';
						$p_state=isset($post['per_state'])?$post['per_state']:'';
						$p_country=isset($post['per_country'])?$post['per_country']:'';
						$p_pincode=isset($post['per_pincode'])?$post['per_pincode']:'';
					}
					$addstudent=array(
						's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						'role_id'=>isset($post['role_id'])?$post['role_id']:'',
						'name'=>isset($post['name'])?$post['name']:'',
						'dob'=>isset($post['dob'])?$post['dob']:'',
						'email'=>isset($post['email'])?$post['email']:'',
						'gender'=>isset($post['gender'])?$post['gender']:'',
						'address'=>isset($post['current_address'])?$post['current_address']:'',
						'current_city'=>isset($post['current_city'])?$post['current_city']:'',
						'current_state'=>isset($post['current_state'])?$post['current_state']:'',
						'current_country'=>isset($post['current_country'])?$post['current_country']:'',
						'current_pincode'=>isset($post['current_pincode'])?$post['current_pincode']:'',
						'per_address'=>$p_add,
						'per_city'=>$p_city,
						'per_state'=>$p_state,
						'per_country'=>$p_country,
						'per_pincode'=>$p_pincode,
						'blodd_group'=>isset($post['blodd_group'])?$post['blodd_group']:'',
						'password'=>isset($post['confirmpassword'])?md5($post['confirmpassword']):'',
						'org_password'=>isset($post['confirmpassword'])?$post['confirmpassword']:'',
						'doj'=>isset($post['doj'])?$post['doj']:'',
						'class_name'=>isset($post['class_name'])?$post['class_name']:'',
						'roll_number'=>isset($post['roll_number'])?$post['roll_number']:'',
						'fee_amount'=>isset($post['fee_amount'])?$post['fee_amount']:'',
						'fee_terms'=>isset($post['fee_terms'])?$post['fee_terms']:'',
						'pay_amount'=>isset($post['pay_amount'])?$post['pay_amount']:'',
						'parent_name'=>isset($post['parent_name'])?$post['parent_name']:'',
						'parent_gender'=>isset($post['parent_gender'])?$post['parent_gender']:'',
						'parent_email'=>isset($post['parent_email'])?$post['parent_email']:'',
						'parent_password'=>isset($post['parent_org_password'])?md5($post['parent_org_password']):'',
						'parent_org_password'=>isset($post['parent_org_password'])?$post['parent_org_password']:'',
						'education'=>isset($post['education'])?$post['education']:'',
						'profession'=>isset($post['profession'])?$post['profession']:'',
						'mobile'=>isset($post['mobile'])?$post['mobile']:'',
						'bus_transport'=>isset($post['bus_transport'])?$post['bus_transport']:'',
						'profile_pic'=>$image,
						'status'=>1,
						'create_at'=>date('Y-m-d H:i:s'),
						'update_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
					);
					//echo '<pre>';print_r($addstudent);exit;
					$save_student=$this->Student_model->save_student($addstudent);
						if(count($save_student)>0){
							$pay_details=array(
							's_id'=>isset($save_student)?$save_student:'',
							'school_id'=>isset($detail['s_id'])?$detail['s_id']:'',
							'roll_number'=>isset($post['roll_number'])?$post['roll_number']:'',
							'class_name'=>isset($post['class_name'])?$post['class_name']:'',
							'fee_amount'=>isset($post['fee_amount'])?$post['fee_amount']:'',
							'fee_terms'=>isset($post['fee_terms'])?$post['fee_terms']:'',
							'pay_amount'=>isset($post['pay_amount'])?$post['pay_amount']:'',
							'status'=>1,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$login_details['u_id'],
							);
							$this->Student_model->save_student_fee_payment($pay_details);
							$this->session->set_flashdata('success','Student successfully Added');
							redirect('student/index/'.base64_encode(1));
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('student/index/'.base64_encode(0));
						}
					//echo '<pre>';print_r($addstudent);exit;
			}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function editpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3 || $login_details['role_id']==8){
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				$detail=$this->Student_model->get_student_details($post['student_id']);
				if($detail['parent_email']!=$post['parent_email'] || $detail['mobile']!=$post['mobile'] ){
				$check_email_mobile=$this->Home_model->check_email_mobile_exits($post['parent_email'],$post['mobile']);
					if(($check_email_mobile)>0){
						$this->session->set_flashdata('error',"Both Email Id and Mobile number already exists. Please use another Email Id and Mobile Number");
						redirect('student/edit/'.base64_encode($post['student_id']));
					}
				}
				if($detail['parent_email']!=$post['parent_email']){
				$check_email=$this->Home_model->check_email_exits($post['parent_email']);
					//echo '<pre>';print_r($check_email);exit;
					if(($check_email)>0){
						$this->session->set_flashdata('error',"Email Id already exists. Please use another Email Id");
						redirect('student/edit/'.base64_encode($post['student_id']));
					}
				}
				if($detail['mobile']!=$post['mobile']){
				$check_mobile=$this->Home_model->check_mobile_exits($post['mobile']);
					if(($check_mobile)>0){
						$this->session->set_flashdata('error',"Mobile Number already exists. Please use another Mobile Number");
						redirect('student/edit/'.base64_encode($post['student_id']));
					}
				}
				
					if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name']!=''){
						unlink('assets/adminpic/'.$detail['profile_pic']);
						$temp = explode(".", $_FILES["profile_pic"]["name"]);
						$image = round(microtime(true)) . '.' . end($temp);
						move_uploaded_file($_FILES['profile_pic']['tmp_name'], "assets/adminpic/" . $image);
					}else{
						$image=$detail['profile_pic'];
					}
					if(isset($post['address_same']) && $post['address_same']=='on'){
						$p_add=isset($post['current_address'])?$post['current_address']:'';
						$p_city=isset($post['current_city'])?$post['current_city']:'';
						$p_state=isset($post['current_state'])?$post['current_state']:'';
						$p_country=isset($post['current_country'])?$post['current_country']:'';
						$p_pincode=isset($post['current_pincode'])?$post['current_pincode']:'';
					}else{
						$p_add=isset($post['per_address'])?$post['per_address']:'';
						$p_city=isset($post['per_city'])?$post['per_city']:'';
						$p_state=isset($post['per_state'])?$post['per_state']:'';
						$p_country=isset($post['per_country'])?$post['per_country']:'';
						$p_pincode=isset($post['per_pincode'])?$post['per_pincode']:'';
					}
					$updatestudent=array(
						'name'=>isset($post['name'])?$post['name']:'',
						'dob'=>isset($post['dob'])?$post['dob']:'',
						'email'=>isset($post['email'])?$post['email']:'',
						'gender'=>isset($post['gender'])?$post['gender']:'',
						'address'=>isset($post['current_address'])?$post['current_address']:'',
						'current_city'=>isset($post['current_city'])?$post['current_city']:'',
						'current_state'=>isset($post['current_state'])?$post['current_state']:'',
						'current_country'=>isset($post['current_country'])?$post['current_country']:'',
						'current_pincode'=>isset($post['current_pincode'])?$post['current_pincode']:'',
						'per_address'=>$p_add,
						'per_city'=>$p_city,
						'per_state'=>$p_state,
						'per_country'=>$p_country,
						'per_pincode'=>$p_pincode,
						'blodd_group'=>isset($post['blodd_group'])?$post['blodd_group']:'',
						'password'=>isset($post['confirmpassword'])?md5($post['confirmpassword']):'',
						'org_password'=>isset($post['confirmpassword'])?$post['confirmpassword']:'',
						'doj'=>isset($post['doj'])?$post['doj']:'',
						'class_name'=>isset($post['class_name'])?$post['class_name']:'',
						'roll_number'=>isset($post['roll_number'])?$post['roll_number']:'',
						'parent_name'=>isset($post['parent_name'])?$post['parent_name']:'',
						'parent_gender'=>isset($post['parent_gender'])?$post['parent_gender']:'',
						'parent_email'=>isset($post['parent_email'])?$post['parent_email']:'',
						'education'=>isset($post['education'])?$post['education']:'',
						'profession'=>isset($post['profession'])?$post['profession']:'',
						'mobile'=>isset($post['mobile'])?$post['mobile']:'',
						'bus_transport'=>isset($post['bus_transport'])?$post['bus_transport']:'',
						'profile_pic'=>$image,
						'update_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
					);
					//echo '<pre>';print_r($addstudent);exit;
					$save_student=$this->Home_model->update_profile_details($post['student_id'],$updatestudent);
						if(count($save_student)>0){
							$this->session->set_flashdata('success','Student details successfully Updated');
							redirect('student/index/'.base64_encode(1));
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('student/edit/'.base64_encode($post['student_id']));
						}
					//echo '<pre>';print_r($addstudent);exit;
			}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public  function status(){
		
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==3 || $login_details['role_id']==8){
					$r_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($r_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Home_model->update_profile_details($r_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Student successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Student successfully Activate.");
								}
								redirect('student/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('student/index/'.base64_encode(1));
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
	public function delete()
	{
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==3 || $login_details['role_id']==8){
					$r_id=base64_decode($this->uri->segment(3));
					if($r_id!=''){
						$detail=$this->Student_model->get_student_details($r_id);
						unlink('assets/adminpic/'.$detail['profile_pic']);
						$statusdata=$this->Student_model->delete_student($r_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Student successfully Deleted.");

								redirect('student/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('student/index/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('school');
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
	public  function lists(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				$data['class_list']=$this->Student_model->get_teacher_wise_student_list($login_details['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student_list',$data);
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
	public  function get_class_wise_student_list(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
				//echo '<pre>';print_r($post);
				$data['student_list']=$this->Student_model->get_class_wise_student_list($post['class_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student_data',$data);
				$this->load->view('html/footer1');
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	public  function attendence(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				if(isset($post['signup']) && $post['signup']=='Signup'){
					$data['student_list']=$this->Student_model->get_class_wise_subjectwise_student_list($post['class_id']);
					$data['subject_name']=$this->Student_model->get_subject_name($post['subjects']);
					$data['class_times']=$this->Student_model->get_class_timings($post['time']);
				$data['student_attendeance_update']=$this->Student_model->get_student_attendeance_update($post['class_id'],$post['time']);

    
				}else{
					$data['student_list']=array();
					$data['subject_name']=array();
					$data['student_attendeance_update']=array();
					$data['class_times']=array();
				}

				$data['class_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$data['class_time']=$this->Student_model->get_teacher_wise_time_list($login_details['u_id']);
				$data['subject_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				

				//echo '<pre>';print_r($data['student_list']);exit;
				
				$this->load->view('student/student_attendence',$data);
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
	public  function get_teacher_class_subjects(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
				//echo '<pre>';print_r($post);
				$subjects_list=$this->Student_model->get_teacher_class_subjects($post['class_id'],$login_details['u_id']);
				if(count($subjects_list) > 0)
				{
				$data['msg']=1;
				$data['list']=$subjects_list;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=2;
					echo json_encode($data);exit;
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
	public  function attendenceaddpost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
			   $cnt=0; foreach($post['student_id'] as $li){
				   if(in_array($li,$post['attendence'])){
					 $dd=array(
					's_id'=>$detail['s_id'],
					'student_id'=>$li,
					'class_id'=>$post['class_id'],
					'subject_id'=>$post['subject_id'],
					'time'=>$post['time'],
					'remarks'=>$post['remarks'][$cnt],
					'teacher_id'=>$login_details['u_id'],
					'created_at'=>date('Y-m-d H:i:s'),
					'attendence'=>'Present',
					);
                   $previous_attendance=$this->Student_model->get_previous_attendance_reports($li,$post['class_id'],$post['subject_id'],$post['time'],$login_details['u_id']);
					if(($previous_attendance)>0){
						$dd['update_at']=date('Y-m-d H:i:s');
						$add_attendance=$this->Student_model->update_attendance($previous_attendance['id'],$dd);
					}else{
						$add_attendance=$this->Student_model->save_student_attendance($dd);
					}

				 }else{
					 $ee=array(
					's_id'=>$detail['s_id'],
					'student_id'=>$li,
					'class_id'=>$post['class_id'],
					'subject_id'=>$post['subject_id'],
					'time'=>$post['time'],
					'remarks'=>$post['remarks'][$cnt],
					'teacher_id'=>$login_details['u_id'],
					'created_at'=>date('Y-m-d H:i:s'),
					'attendence'=>'Absent',
					);
					//echo'<pre>';print_r($ee);exit;
                $previous_attendance=$this->Student_model->get_previous_attendance_reports($li,$post['class_id'],$post['subject_id'],$post['time'],$login_details['u_id']);
					if(($previous_attendance)>0){
						$ee['update_at']=date('Y-m-d H:i:s');
						$add_attendance=$this->Student_model->update_attendance($previous_attendance['id'],$ee);
					}else{
						$add_attendance=$this->Student_model->save_student_attendance($ee);
					}
						

				  }
			   $cnt++;}
				//exit;
				$this->session->set_flashdata('success',"Student attendance successfully added.");
			    redirect('student/attendence');
				if(count($add_attendance)>0){
					$this->session->set_flashdata('success',"Student Attendence successfully Added.");
					redirect('student/attendence');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('student/attendence');
				}
				
				
				//exit;
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	
	public  function attendencepost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
			   $cnt=0; foreach($post['student_id'] as $li){
				   if(in_array($li,$post['attendence'])){
					 $dd=array(
					's_id'=>$detail['s_id'],
					'student_id'=>$li,
					'class_id'=>$post['class_id'],
					'subject_id'=>$post['subject_id'],
					'time'=>$post['time'],
					'remarks'=>$post['remarks'][$cnt],
					'teacher_id'=>$login_details['u_id'],
					'created_at'=>date('Y-m-d H:i:s'),
					'attendence'=>'Present',
					);
                   $previous_attendance=$this->Student_model->get_previous_attendance_reports($li,$post['class_id'],$post['subject_id'],$post['time'],$login_details['u_id']);
					if(($previous_attendance)>0){
						$dd['update_at']=date('Y-m-d H:i:s');
						$add_attendance=$this->Student_model->update_attendance($previous_attendance['id'],$dd);
					}else{
						$add_attendance=$this->Student_model->save_student_attendance($dd);
					}

				 }else{
					 $ee=array(
					's_id'=>$detail['s_id'],
					'student_id'=>$li,
					'class_id'=>$post['class_id'],
					'subject_id'=>$post['subject_id'],
					'time'=>$post['time'],
					'remarks'=>$post['remarks'][$cnt],
					'teacher_id'=>$login_details['u_id'],
					'created_at'=>date('Y-m-d H:i:s'),
					'attendence'=>'Absent',
					);
					//echo'<pre>';print_r($ee);exit;
                $previous_attendance=$this->Student_model->get_previous_attendance_reports($li,$post['class_id'],$post['subject_id'],$post['time'],$login_details['u_id']);
					if(($previous_attendance)>0){
						$ee['update_at']=date('Y-m-d H:i:s');
						$add_attendance=$this->Student_model->update_attendance($previous_attendance['id'],$ee);
					}else{
						$add_attendance=$this->Student_model->save_student_attendance($ee);
					}
						

				  }
			   $cnt++;}
				//exit;
				$this->session->set_flashdata('success',"Student Attendence successfully updated.");
			    redirect('student/updateattendence');
				if(count($add_attendance)>0){
					$this->session->set_flashdata('success',"Student Attendence successfully updated.");
					redirect('student/updateattendence');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('student/updateattendence');
				}
				
				
				//exit;
				
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	public  function homework(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
			$data['tab']=base64_decode($this->uri->segment(3));

				$post=$this->input->post();
				if(isset($post['signup']) && $post['signup']=='Signup'){
					$data['student_list']=$this->Student_model->get_class_wise_subjectwise_student_list($post['class_id']);
					$data['subject_name']=$this->Student_model->get_subject_name($post['subjects']);
					$data['subject_name']['time']=isset($post['time'])?$post['time']:'';
				}else{
					$data['student_list']=array();
					$data['subject_name']=array();
					$data['subject_name']['time']='';
				}
				//echo '<pre>';print_r($data);exit;
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);

				$data['class_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$data['class_time']=$this->Student_model->get_teacher_wise_time_list($login_details['u_id']);
				$data['subject_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$data['home_work_list']=$this->Student_model->get_home_work_list($login_details['u_id'],$detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				
					
				$this->load->view('student/create_home_work',$data);
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

	
	 
	
	public function feelist()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if( $login_details['role_id']==3){
				 
                 $detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
				//$data['class_details']=$this->Student_model->class_wise_all_details($post['class_id']);
					//echo'<pre>';print_r($data);exit;
                 // $data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('student/fee_list',$data);
					$this->load->view('html/footer');
					
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
	}
	
public function fee()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if( $login_details['role_id']==3){
				 
                 $detail=$this->Student_model->get_resources_details($login_details['u_id']);	
             $detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);				 
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					
				$data['class_details']=$this->Student_model->class_wise_all_details($post['class_id']);
				//echo'<pre>';print_r($data);exit;
				
					$this->load->view('student/fee_list',$data);
					$this->load->view('html/footer');
					
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
	}
	public function homeworkpost()
	{
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);
			$class_name=$this->Student_model->get_class_name($post['class_id'],$detail['s_id']);

			
			$class_wise_parent=$this->Student_model->get_class_wise_parent_list($post['class_id'],$detail['s_id']);
			  //echo'<pre>';print_r($detail);exit;
			 foreach($class_wise_parent as $lis)
             {
				$emails[]=$lis['parent_email']; 
			 }
			 $send_emails=implode(',', $emails);
			 //echo'<pre>';print_r($send_emails);exit;

				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'subjects'=>isset($post['subjects'])?$post['subjects']:'',
				'work_date'=>isset($post['work_date'])?$post['work_date']:'',
				'work_sub_date'=>isset($post['work_sub_date'])?$post['work_sub_date']:'',
				'work'=>isset($post['work'])?$post['work']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				);
				$save=$this->Student_model->save_home_work_details($save_data);	
					//echo'<pre>';print_r($save);exit;
					
				if(count($save)>0){
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->set_mailtype("html");
				$this->email->from($detail['email']);
				$this->email->to($send_emails);
				$this->email->subject('Teacher assign Home Work');
				$body = 'Work Assign Teacher Name:'.$detail['name'].'<br>  Class:'.$class_name['class']. '<br> Subject :'.$post['subjects'].'<br> Date of Home Work :'.$post['work_date'].'<br> Home Work Submission Date :'.$post['work_sub_date'].'<br> Home Work :'.$post['work'];
				$this->email->message($body);
				$this->email->send();	
				//echo'<pre>';print_r($body);exit;
					$this->session->set_flashdata('success',"home work details are successfully added");	
					redirect('student/homeworklist');	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('student/homework');
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
	public  function homeworklist(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
			$data['tab']=base64_decode($this->uri->segment(3));

				$post=$this->input->post();
				if(isset($post['signup']) && $post['signup']=='Signup'){
					$data['student_list']=$this->Student_model->get_class_wise_subjectwise_student_list($post['class_id']);
					$data['subject_name']=$this->Student_model->get_subject_name($post['subjects']);
					$data['subject_name']['time']=isset($post['time'])?$post['time']:'';
				}else{
					$data['student_list']=array();
					$data['subject_name']=array();
					$data['subject_name']['time']='';
				}
				//echo '<pre>';print_r($data);exit;
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);

				$data['class_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$data['class_time']=$this->Student_model->get_teacher_wise_time_list($login_details['u_id']);
				$data['subject_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$data['home_work_list']=$this->Student_model->get_home_work_list($login_details['u_id'],$detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				
					
				$this->load->view('student/home_work_list',$data);
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
	public  function homeworkedit(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				
				
				//echo '<pre>';print_r($data);exit;
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['class_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$data['class_time']=$this->Student_model->get_teacher_wise_time_list($login_details['u_id']);
				$data['edit_home_work']=$this->Student_model->get_edit_home_work($detail['s_id'],base64_decode($this->uri->segment(3)));
				$data['subject_list']=$this->Student_model->get_teacher_class_subjects($data['edit_home_work']['class_id'],$login_details['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/edit_home_work',$data);
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
public function edithomeworkpost()
	{
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);

				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'subjects'=>isset($post['subjects'])?$post['subjects']:'',
				'work_date'=>isset($post['work_date'])?$post['work_date']:'',
				'work_sub_date'=>isset($post['work_sub_date'])?$post['work_sub_date']:'',
				'work'=>isset($post['work'])?$post['work']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				);
				$update=$this->Student_model->upadte_home_work_details($post['h_w_id'],$save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($update)>0){
					$this->session->set_flashdata('success',"home work details are successfully updated");	
					redirect('student/homeworklist');	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('student/homeworklist');
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
	
	 public function homeworkstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==6){
					//echo'<pre>';print_r($login_details);exit;  
				$h_w_id=base64_decode ($this->uri->segment(3));
	            $status=base64_decode ($this->uri->segment(4));
					if($status==1){
	                 $stain=0;
					 }else{
						 $stain=1;
					 }
				if($h_w_id!=''){
					$staindata=array(
							'status'=> $stain,
							'upate_at'=>date('Y-m-d H:i:s')
							);
							 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Student_model->upadte_home_work_details($h_w_id,$staindata);
						 //echo'<pre>';print_r($statusdetails );exit;  
					      if(count($statusdetails)>0){
							 if($status==1){
								$this->session->set_flashdata('success',"home work details  successfully Deactivated.");
								}else{
									$this->session->set_flashdata('success',"home work details  successfully Activated.");
								}
							
							redirect('student/homeworklist');			  					  
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('hostelmanagement/allocateroom/'.base64_encode(1));	
						}						
					   }else{
						 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('student/homeworklist');
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
	public function homeworkdelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==6){
				$h_w_id=base64_decode ($this->uri->segment(3));	 
						$deletedetails =$this->Student_model->delete_home_work_details($h_w_id);
						 //echo'<pre>';print_r($deletedetails );exit;  
					      if(count($deletedetails)>0){
							 $this->session->set_flashdata('success',"home work details successfully Deleted.");
								
							redirect('student/homeworklist');			  					  
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('student/homeworklist');	
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
		
	public function prints(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==3){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					$student=base64_decode($this->uri->segment(3));
					$filename=$student;
					$data['student_list']=$this->Student_model->get_student_details_print($student);
					//echo'<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                
					$data['page_title'] = $data['student_list']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/students/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('student/student_details_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/students/".$file_name);
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}	
		
		public function details()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_details']=$this->Student_model->get_student_details($login_details['u_id']);
				$data['school_details']=$this->School_model->get_school_basic_details_with_resourse($login_details['u_id']);
				$data['student_list']=$this->Student_model->get_student_wise_list($data['school_details']['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student-details',$data);
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
	public function editdetails()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$student_id=base64_decode($this->uri->segment(3));
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_list']=$this->Student_model->get_student_details($student_id);
				$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/edit-student-details',$data);
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
	
	public function editdetailspost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				//echo'<pre>';print_r($_FILES);exit;
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$student_list=$this->Student_model->get_student_details($post['u_id']);
				if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name']!=''){
						unlink('assets/adminpic/'.$detail['profile_pic']);
						$temp = explode(".", $_FILES["profile_pic"]["name"]);
						$image = round(microtime(true)) . '.' . end($temp);
						move_uploaded_file($_FILES['profile_pic']['tmp_name'], "assets/adminpic/" . $image);
					}else{
						$image=$student_list['profile_pic'];
					}
					if(isset($post['address_same']) && $post['address_same']=='on'){
						$p_add=isset($post['current_address'])?$post['current_address']:'';
						$p_city=isset($post['current_city'])?$post['current_city']:'';
						$p_state=isset($post['current_state'])?$post['current_state']:'';
						$p_country=isset($post['current_country'])?$post['current_country']:'';
						$p_pincode=isset($post['current_pincode'])?$post['current_pincode']:'';
					}else{
						$p_add=isset($post['per_address'])?$post['per_address']:'';
						$p_city=isset($post['per_city'])?$post['per_city']:'';
						$p_state=isset($post['per_state'])?$post['per_state']:'';
						$p_country=isset($post['per_country'])?$post['per_country']:'';
						$p_pincode=isset($post['per_pincode'])?$post['per_pincode']:'';
					}
					$updatestudent=array(
						'name'=>isset($post['name'])?$post['name']:'',
						'dob'=>isset($post['dob'])?$post['dob']:'',
						'email'=>isset($post['email'])?$post['email']:'',
						'gender'=>isset($post['gender'])?$post['gender']:'',
						'address'=>isset($post['current_address'])?$post['current_address']:'',
						'current_city'=>isset($post['current_city'])?$post['current_city']:'',
						'current_state'=>isset($post['current_state'])?$post['current_state']:'',
						'current_country'=>isset($post['current_country'])?$post['current_country']:'',
						'current_pincode'=>isset($post['current_pincode'])?$post['current_pincode']:'',
						'per_address'=>$p_add,
						'per_city'=>$p_city,
						'per_state'=>$p_state,
						'per_country'=>$p_country,
						'per_pincode'=>$p_pincode,
						'blodd_group'=>isset($post['blodd_group'])?$post['blodd_group']:'',
						'doj'=>isset($post['doj'])?$post['doj']:'',
						'class_name'=>isset($post['class_name'])?$post['class_name']:'',
						'fee_amount'=>isset($post['fee_amount'])?$post['fee_amount']:'',
						'fee_terms'=>isset($post['fee_terms'])?$post['fee_terms']:'',
						'pay_amount'=>isset($post['pay_amount'])?$post['pay_amount']:'',
						'parent_name'=>isset($post['parent_name'])?$post['parent_name']:'',
						'parent_gender'=>isset($post['parent_gender'])?$post['parent_gender']:'',
						'parent_email'=>isset($post['parent_email'])?$post['parent_email']:'',
						'education'=>isset($post['education'])?$post['education']:'',
						'profession'=>isset($post['profession'])?$post['profession']:'',
						'mobile'=>isset($post['parent_mobile'])?$post['parent_mobile']:'',
						'profile_pic'=>$image,
						'update_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
					);
					//echo '<pre>';print_r($updatestudent);exit;
					$update=$this->Home_model->update_profile_details($post['u_id'],$updatestudent);
						if(count($update)>0){
							$this->session->set_flashdata('success','Student details successfully Updated');
							redirect('student/details');
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('student/details');
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
		
    public function get_subject_wise_timings(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				
				$post=$this->input->post();
				//$class=$this->Student_model->get_classes();
				$subjects_list=$this->Student_model->get_subject_wise_timings($post['subjects'],$login_details['u_id']);
				//echo '<pre>';print_r($class);exit;

				if(count($subjects_list) > 0)
				{
				$data['msg']=1;
				$data['list']=$subjects_list;
				echo json_encode($data);exit;	
				}else{
					$data['msg']=2;
					echo json_encode($data);exit;
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
	
	public function updateattendence(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==6){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
			
				if(isset($post['signup'])&& $post['signup']=='submit'){
					$data['student_update_attendenace']=$this->Student_model->get_student_view_attendence_list($detail['s_id'],$post['class_id'],$post['subjects'],$post['time']);
				  // echo '<pre>';print_r($data);exit;
				}else{
					$data['student_update_attendenace']=array();
				}
				
				$data['class_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$data['class_time']=$this->Student_model->get_teacher_wise_time_list($login_details['u_id']);
				$data['subject_list']=$this->Student_model->get_teacher_wise_class_list($login_details['u_id']);
				$this->load->view('student/update-attendence',$data);
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
	
	public function absentlist()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['absent_list']=$this->Student_model->get_student_absent_list($detail['s_id'],$login_details['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student-absent-list',$data);
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
	
	public function markslist()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['marks_list']=$this->Student_model->get_student_marks_list($detail['s_id'],$login_details['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student-marks-list',$data);
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
	public function paymentlist()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_details']=$this->Student_model->student_details($login_details['u_id'],$detail['s_id']);
				$data['payment_details']=$this->Student_model->get_student_payment_details($login_details['u_id'],$detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student-payment-list',$data);
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
	
	public function homeworks()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_homework']=$this->Student_model->get_student_homework($login_details['u_id'],$detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student-homework',$data);
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
	/* student books list */
	public function bookslist()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==7){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_books_list']=$this->Student_model->get_student_books_list($login_details['u_id'],$detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/student-books-list',$data);
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
	
	
	/* principal role year wise list */
	
	public function yearwiselist()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==12){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				 $post=$this->input->post();
				 if(isset($post['signup'])&& $post['signup']=='submit'){
			   $data['student_list']=$this->Student_model->get_year_wise_student_list($detail['s_id'],$post['class_id'],$post['year']);
			 //echo '<pre>';print_r($data);exit;
			 if($data['student_list']!=array()){
			 $path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                
					$data['page_title'] = $data['student_list']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/student_year_wise_list/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('principal/student_list_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/student_year_wise_list/".$file_name);
			     }else{
				  $this->session->set_flashdata('error',"year wise no student data");
				redirect('student/yearwiselist');  
			   }
				 }
				  $data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
				$this->load->view('principal/student-list',$data);
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
	public function buspayment()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3 || $login_details['role_id']==8 || $login_details['role_id']==7){
			
				$student_id=base64_decode($this->uri->segment(3));
				
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['student_details']=$this->Student_model->get_student_bus_transport_details($detail['s_id'],$student_id);
				$data['last_payment_details']=$this->Student_model->get_student_last_bus_payment_details($student_id);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('student/bus-payment',$data);
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
	/* student payments */
	public function paymentreports()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==12){
				
				$this->load->view('principal/student-payment-reports');
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
	public function printpayment()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==12){
			$post=$this->input->post();
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);
			$data['payment_list']=$this->Student_model->get_student_payment_list($detail['s_id'],$post['fdate'],$post['tdate']);
			$data['total_payment']=$this->Student_model->get_student_total_payment_list($detail['s_id'],$post['fdate'],$post['tdate']);
				//echo '<pre>';print_r($data);exit;
				 if($data['payment_list']!=array()){
				$path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                
					$data['page_title'] = $data['payment_list']['username'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/student_payments/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('principal/payment_list_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/student_payments/".$file_name);
				}else{
			    $this->session->set_flashdata('error',"Student Payment Reports no data");
				redirect('student/paymentreports'); 
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
	
	public function buspaymentreports()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==12){
				
				$this->load->view('principal/student-bus-payment-reports');
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
	public function printbuspayment()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==12){
			$post=$this->input->post();
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);
			$data['bus_payment_list']=$this->Student_model->get_student_bus_payment_list($detail['s_id'],$post['fdate'],$post['tdate']);
			$data['total_payment']=$this->Student_model->get_student_total_bus_payment_list($detail['s_id'],$post['fdate'],$post['tdate']);
				 if($data['bus_payment_list']!=array()){
				//echo '<pre>';print_r($data);exit;
				$path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                
					$data['page_title'] = $data['bus_payment_list']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/bus_payments/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('principal/bus_payment_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/bus_payments/".$file_name);
				 }else{
				$this->session->set_flashdata('error',"Student Bus Payment Reports No data");
				redirect('student/buspaymentreports');  
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
	
	
	
	
	
}
