<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Examination extends In_frontend {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Examination_model');	
         $this->load->model('Announcement_model');		
	
	}
	public function create()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			//echo '<pre>';print_r($admindetails);exit;
			if($login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$data['class_list']=$this->School_model->get_all_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_subject_list($detail['s_id']);
				$data['times_list']=$this->Examination_model->get_time_list($detail['s_id']);
				$data['teachers_list']=$this->Examination_model->get_teacher_list_list($detail['s_id']);
				$data['exam_time_table_list']=$this->Examination_model->get_exam_time_table_list($detail['s_id']);
				//$data['exam_time_table_list']=$this->Examination_model->get_exam_time_table_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('examination/create-exam',$data);	
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
	public function edit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			//echo '<pre>';print_r($admindetails);exit;
			if($login_details['role_id']==9){
				$exam_id=base64_decode($this->uri->segment(3));
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$data['class_list']=$this->School_model->get_all_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_subject_list($detail['s_id']);
				$data['times_list']=$this->Examination_model->get_time_list($detail['s_id']);
				$data['teachers_list']=$this->Examination_model->get_teacher_list_list($detail['s_id']);
				//$data['detail']=$this->Examination_model->get_exam_time_table_details($exam_id);
				$data['detail']=$this->Examination_model->get_exam_time_table_details($exam_id);
				$data['student_list']=$this->Examination_model->class_wise_student_list($data['detail']['class_id']);
				//$data['subjects_list']=$this->Examination_model->get_class_wise_subjects($data['detail']['class_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('examination/edit-exam',$data);	
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
	/*
	public function createpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==9){
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				$cnt=0; foreach($post['class_id'] as $list){ 
				$addexam=array(
				's_id'=>$detail['s_id'],
				'exam_type'=>isset($post['exam_type'])?$post['exam_type']:'',
				'class_id'=>$list,
				'exam_date'=>$post['exam_date'][$cnt],
				'subject'=>$post['subject'][$cnt],
				'start_time'=>$post['start_time'][$cnt],
				'to_time'=>$post['to_time'][$cnt],
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
				//echo'<pre>';print_r($addexam);exit;

				$save_exam=$this->Examination_model->save_exam($addexam);
				
				$cnt++;}
				$this->session->set_flashdata('success',"Exam successfully added.");
				redirect('examination/create');
				
				//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	*/
/*
	public function createpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==9){
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				$addexam=array(
				's_id'=>$detail['s_id'],
				'exam_type'=>isset($post['exam_type'])?$post['exam_type']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
				//echo'<pre>';print_r($addexam);exit;

				$save_exam=$this->Examination_model->save_exam($addexam);
				if(count($save_exam)>0){
					if(isset($post['class_id']) && count($post['class_id'])>0){
					$cnt=0;foreach($post['class_id'] as $list){ 
						  $add_data=array(
						  'id'=>isset($save_exam)?$save_exam:'',
						  'class_id'=>$list,
						  'exam_date'=>$post['exam_date'][$cnt],
						  'subject'=>$post['subject'][$cnt],
						  'start_time'=>$post['start_time'][$cnt],
						  'to_time'=>$post['to_time'][$cnt],
						  
						  );
						  // echo '<pre>';print_r($add_data);
						  $this->Examination_model->save_exam_timing_data($add_data);	

				       $cnt++;}
					}
					//exit;
					$this->session->set_flashdata('success',"Exam successfully added.");
					redirect('examination/create');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('examination/create');
				}
				//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	*/

	public function createpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==9){
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
					
				$cnt=0; foreach($post['class_id'] as $list){
					
				$check=$this->Examination_model->check_exam_exits($post['exam_type'],$list,$post['subject'][$cnt],$post['exam_date'][$cnt],$post['start_time'][$cnt],$post['to_time'][$cnt]);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Exam already exists. Please try again once");
						redirect('examination/create');
					}	
					
					
				$addexam=array(
				's_id'=>$detail['s_id'],
				'exam_type'=>isset($post['exam_type'])?$post['exam_type']:'',
				'class_id'=>$list,
				'subject'=>$post['subject'][$cnt],
				'exam_date'=>$post['exam_date'][$cnt],
				'start_time'=>$post['start_time'][$cnt],
				'to_time'=>$post['to_time'][$cnt],
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
			//echo'<pre>';print_r($addexam);exit;

				$save_exam=$this->Examination_model->save_exam($addexam);
				$cnt++;}
				if(count($save_exam)>0){
					$this->session->set_flashdata('success',"Exam successfully added.");
					redirect('examination/create');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('examination/create');
				}
				//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	/*
	public function editpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==9){
				$post=$this->input->post();
				$exam_detail=$this->Examination_model->get_exam_time_table_details($post['exam_id']);

				if($exam_detail['exam_type']!=$post['exam_type'] || $exam_detail['class_id']!=$post['class_id'] || $exam_detail['subject']!=$post['subject'] || $exam_detail['exam_date']!=$post['exam_date']){
					$check=$this->Examination_model->check_exam_exits($post['exam_type'],$post['class_id'],$post['subject'],$post['exam_date'],$detail['s_id']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Exam already exists. Please try again once");
						redirect('examination/create');
					}
				}
				$updateexam=array(
				'exam_type'=>isset($post['exam_type'])?$post['exam_type']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'subject'=>isset($post['subject'])?$post['subject']:'',
				'exam_date'=>isset($post['exam_date'])?$post['exam_date']:'',
				'start_time'=>isset($post['start_time'])?$post['start_time']:'',
				'to_time'=>isset($post['to_time'])?$post['to_time']:'',
				'room_no'=>isset($post['room_no'])?$post['room_no']:'',
				'teacher_id'=>isset($post['teacher_id'])?$post['teacher_id']:'',
				'status'=>1,
				'update_at'=>date('Y-m-d H:i:s'),
				);
				$update=$this->Examination_model->update_exam_details($post['exam_id'],$updateexam);
				if(count($update)>0){
					$this->session->set_flashdata('success',"Exam successfully Updated.");
					redirect('examination/create');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('examination/create');
				}
				//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	*/
	/*
	public function editpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==9){
				$post=$this->input->post();
				
				$exam_detail=$this->Examination_model->get_exam_time_table_details($post['id']);
                //echo'<pre>';print_r($exam_detail);exit;
				/*
				if($exam_detail['exam_type']!=$post['exam_type'] || $exam_detail['class_id']!=$post['class_id'] || $exam_detail['subject']!=$post['subject'] || $exam_detail['exam_date']!=$post['exam_date']){
					$check=$this->Examination_model->check_exam_exits($post['exam_type'],$post['class_id'],$post['subject'],$post['exam_date'],$detail['s_id']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Exam already exists. Please try again once");
						redirect('examination/create');
					}
				}
				
				$updateexam=array(
				'exam_type'=>isset($post['exam_type'])?$post['exam_type']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
               //echo'<pre>';print_r($updateexam);exit;
				$update=$this->Examination_model->update_exam_details($post['id'],$updateexam);
				//echo'<pre>';print_r($update);exit;

				if(($update)>0){
					$details=$this->Examination_model->get_edit_exam_list_data($post['id']);
				  if(count($details)>0){
					  foreach($details as $lis){
						 $this->Examination_model->delete_exam_list_data($lis['e_l_id']); 
					  }
					}
					if(isset($post['class_id']) && count($post['class_id'])>0){
					$cnt=0;foreach($post['class_id'] as $list){ 
						  $add_data=array(
						  'id'=>isset($post['id'])?$post['id']:'',
						  'class_id'=>$list,
						  'exam_date'=>$post['exam_date'][$cnt],
						  'subject'=>$post['subject'][$cnt],
						  'start_time'=>$post['start_time'][$cnt],
						  'to_time'=>$post['to_time'][$cnt],
						  'status'=>1,
				          'create_at'=>date('Y-m-d H:i:s'),
				          'create_by'=>$login_details['u_id'],
						  );
						   //echo '<pre>';print_r($add_data);
						  $this->Examination_model->save_exam_timing_data($add_data);	

				       $cnt++;}
					}
					//exit;
					$this->session->set_flashdata('success',"Exam successfully Updated.");
					redirect('examination/create');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('examination/create');
				}
				//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	*/

	public function editpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);

			if($login_details['role_id']==9){
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;

				$exam_detail=$this->Examination_model->get_exam_time_table_details($post['id']);
				if($exam_detail['exam_type']!=$post['exam_type'] || $exam_detail['class_id']!=$post['class_id'] || $exam_detail['subject']!=$post['subject'] || $exam_detail['exam_date']!=$post['exam_date'] || $exam_detail['start_time']!=$post['start_time'] || $exam_detail['to_time']!=$post['to_time']){
					$check=$this->Examination_model->check_exam_exits($post['exam_type'],$post['class_id'],$post['subject'],$post['exam_date'],$post['start_time'],$post['to_time']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"Exam already exists. Please try again once");
						redirect('examination/create');
					}
				}
				
				$updateexam=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'exam_type'=>isset($post['exam_type'])?$post['exam_type']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'subject'=>isset($post['subject'])?$post['subject']:'',
				'exam_date'=>isset($post['exam_date'])?$post['exam_date']:'',
				'start_time'=>isset($post['start_time'])?$post['start_time']:'',
				'to_time'=>isset($post['to_time'])?$post['to_time']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'update_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
				//echo'<pre>';print_r($updateexam);exit;

				$update=$this->Examination_model->update_exam_details($post['id'],$updateexam);
				//echo'<pre>';print_r($update);exit;

				if(($update)>0){
					$this->session->set_flashdata('success',"Exam successfully Updated.");
					redirect('examination/create');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('examination/create');
				}
				//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	
	
	
	public function removeexam()
	{
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
					$e_l_id=base64_decode($this->uri->segment(3));
					if($e_l_id!=''){
						$statusdata=$this->Examination_model->delete_exam_list_data($e_l_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"exam details sucessfully deleted.");
                              redirect($this->agent->referrer());
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('examination/edit/'.base64_encode($post['id']));
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
	
	
	
	public  function marks(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				if(isset($post['signup'])&& $post['signup']=='submit'){
					$data['student_list']=$this->Examination_model->get_student_list($post['class_id']);
					$data['subject_name']=$this->Examination_model->get_student_name($post['subject']);
					$data['exam_name']=$this->Examination_model->get_exam_name($post['exam_type']);
				}
				$data['class_list']=$this->Examination_model->get_addexam_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_addexam_subject_list($detail['s_id']);
				$data['exam_list']=$this->Examination_model->get_exam_subject_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('examination/add-marks',$data);
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
	
	public  function updatemarks(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				
				$data['class_list']=$this->Examination_model->get_addexam_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_addexam_subject_list($detail['s_id']);
				$data['exam_list']=$this->Examination_model->get_exam_subject_list($detail['s_id']);
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				if(isset($post['signup'])&& $post['signup']=='submit'){
			$data['update_exam_marks']=$this->Examination_model->get_update_exam_marks($detail['s_id'],$post['class_id'],$post['subject'],$post['exam_type']);
					//echo'<pre>';print_r($data);exit;
				}else{
					$data['update_exam_marks']=array();
				}
				$this->load->view('examination/update-marks',$data);
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
	public  function updatemarkspost(){
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$cnt=0;foreach($post['student_id'] as $list){
						$add_marks=array(
						's_id'=>$detail['s_id'],
						'student_id'=>$list,
						'exam_id'=>isset($post['exam_id'])?$post['exam_id']:'',
						'subject_id'=>isset($post['subject_id'])?$post['subject_id']:'',
						'class_id'=>isset($post['class_id'])?$post['class_id']:'',
						'marks_obtained'=>isset($post['marks_obtained'][$cnt])?$post['marks_obtained'][$cnt]:'',
						'max_marks'=>isset($post['max_marks'][$cnt])?$post['max_marks'][$cnt]:'',
						'remarks'=>isset($post['remarks'][$cnt])?$post['remarks'][$cnt]:'',
						'status'=>1,
						'create_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
						);
						//echo '<pre>';print_r($add_marks);exit;
						$check=$this->Examination_model->chekck_update_marks($list,$detail['s_id'],$post['exam_id'],$post['subject_id'],$post['class_id']);
						if(($check)>0){
							$save_marks=$this->Examination_model->update_exam_mark($check['id'],$add_marks);
						}else{
							$save_marks=$this->Examination_model->save_exam_mark($add_marks);
						}
						
						
					$cnt++;}
					
					
					if(count($save_marks)>0){
						$this->session->set_flashdata('success',"Student Marks successfully updated.");
						redirect('examination/updatemarks');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('examination/updatemarks');
					}
					//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
	}
	
	
	
	public  function viewmarks(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
          //echo '<pre>';print_r($login_details);exit;
			if($login_details['role_id']==8 || $login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				$data['class_list']=$this->Examination_model->get_addexam_markswise_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_addexam_markswise_subject_list($detail['s_id']);
				$data['exam_list']=$this->Examination_model->get_exam_markswise_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('examination/view-marks',$data);
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
	public  function marksview(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
          //echo '<pre>';print_r($login_details);exit;
			if($login_details['role_id']==8 || $login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				if(isset($post['subject'])&& $post['subject']=='All'){
				$data['student_list']=$this->Examination_model->get_all_subject_mark_list($detail['s_id'],$post['class_id'],$post['exam_type'],$post['student_id']);
				}else{
				$data['student_list']=$this->Examination_model->get_student_withmarks_list($detail['s_id'],$post['class_id'],$post['subject'],$post['exam_type'],$post['student_id']);		
				}
				$data['class_list']=$this->Examination_model->get_addexam_markswise_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_addexam_markswise_subject_list($detail['s_id']);
				$data['exam_list']=$this->Examination_model->get_exam_markswise_list($detail['s_id']);
				$this->load->view('examination/marks-view',$data);
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
	
	
	public  function addsyllabus(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8 || $login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				if(isset($post['signup'])&& $post['signup']=='submit'){
				if(isset($post['subject'])&& $post['subject']!=='all'){
					$data['student_list']=$this->Examination_model->get_student_withmarks_list($detail['s_id'],$post['class_id'],$post['subject'],$post['exam_type'],$post['student_id']);
				}else{
					$data['student_list']=$this->Examination_model->get_student_withmarks_lists($detail['s_id'],$post['class_id'],$post['exam_type'],$post['student_id']);
				}
				//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				}
				if(isset($post['subject'])&& $post['subject']=='all'){
				$data['subject_list']=$this->Examination_model->get_subject_list($detail['s_id']);
				//echo '<pre>';print_r($data['subject_list']);exit;
				}
				
				$data['student_name_list']=$this->Examination_model->get_all_student_name_list($detail['s_id']);
				//echo '<pre>';print_r($data['student_name_list']);exit;
				$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_subject_list($detail['s_id']);
				$data['exam_list']=$this->Examination_model->get_exam_subject_wise_list($detail['s_id']);
				//echo '<pre>';print_r($data['exam_list']);exit;
				$this->load->view('examination/addsyllabus',$data);
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
	
	public  function addsyllabuspost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8 || $login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				if(isset($_FILES['document']['name']) && $_FILES['document']['name']!=''){
							$temp = explode(".", $_FILES["document"]["name"]);
							$documents = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['document']['tmp_name'], "assets/syllabus/" . $documents);
						}else{
							$documents='';
						}
				
				
				 $save_data=array(
	            's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
	            'class_id'=>isset($post['class_id'])?$post['class_id']:'',
	            'document'=>isset($documents)?$documents:'',
				'org_document'=>isset($_FILES['document']['name'])?$_FILES['document']['name']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				//echo '<pre>';print_r($save_data);exit;
				 $save=$this->Examination_model->save_exam_syllabus($save_data);	
				 //echo '<pre>';print_r($save);exit;
				   if(count($save)>0){
						$this->session->set_flashdata('success',"Syllabus successfully added");	
						redirect('examination/addsyllabuslist');	
					}else{
						$this->session->set_flashdata('error',"technical problem occurred. please try again once");
						redirect('examination/addsyllabus');
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
	
	public  function addsyllabuslist(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8 || $login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				if(isset($post['signup'])&& $post['signup']=='submit'){
				if(isset($post['subject'])&& $post['subject']!=='all'){
					$data['student_list']=$this->Examination_model->get_student_withmarks_list($detail['s_id'],$post['class_id'],$post['subject'],$post['exam_type'],$post['student_id']);
				}else{
					$data['student_list']=$this->Examination_model->get_student_withmarks_lists($detail['s_id'],$post['class_id'],$post['exam_type'],$post['student_id']);
				}
				//echo $this->db->last_query();exit;
					//echo '<pre>';print_r($data);exit;
				}
				if(isset($post['subject'])&& $post['subject']=='all'){
				$data['subject_list']=$this->Examination_model->get_subject_list($detail['s_id']);
				//echo '<pre>';print_r($data['subject_list']);exit;
				}
				
				$data['student_name_list']=$this->Examination_model->get_all_student_name_list($detail['s_id']);
				//echo '<pre>';print_r($data['student_name_list']);exit;
				$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_subject_list($detail['s_id']);
				$data['exam_list']=$this->Examination_model->get_exam_subject_wise_list($detail['s_id']);
				//echo '<pre>';print_r($data['subject_list']);exit;
				
				$data['exam_syllabus_list']=$this->Examination_model->get_exam_syllabus_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('examination/addsyllabus_list',$data);
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
	public function syllabusedit(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8 || $login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
				$data['edit_exam_syllabus']=$this->Examination_model->edit_exam_syllabus_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
				
				
				//echo '<pre>';print_r($data);exit;
				$this->load->view('examination/edit-syllabus',$data);
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
	public  function editsyllabuspost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8 || $login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				$edit_exam_syllabus=$this->Examination_model->edit_exam_syllabus_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
				if(isset($_FILES['document']['name']) && $_FILES['document']['name']!=''){
							$temp = explode(".", $_FILES["document"]["name"]);
							$documents = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['document']['tmp_name'], "assets/syllabus/" . $documents);
						}else{
							$documents=$edit_exam_syllabus['document'];
						}
				
				
				 $update_data=array(
	            's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
	            'class_id'=>isset($post['class_id'])?$post['class_id']:'',
	            'document'=>isset($documents)?$documents:'',
				'org_document'=>isset($_FILES['document']['name'])?$_FILES['document']['name']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				//echo '<pre>';print_r($update_data);exit;
				 $upadte=$this->Examination_model->upadte_exam_syllabus($post['e_s_id'],$update_data);	
				 //echo '<pre>';print_r($upadte);exit;
				   if(count($upadte)>0){
						$this->session->set_flashdata('success',"Syllabus successfully updated");	
						redirect('examination/addsyllabuslist');	
					}else{
						$this->session->set_flashdata('error',"technical problem occurred. please try again once");
						redirect('examination/addsyllabus');
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
	
	public  function syllabusstatus(){
		
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8 || $login_details['role_id']==9){
					$e_s_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($e_s_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Examination_model->upadte_exam_syllabus($e_s_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Syllabus successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Syllabus successfully Activate.");
								}
								redirect('examination/addsyllabuslist');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('examination/addsyllabuslist');
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
	public function syllabusdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==8 || $login_details['role_id']==9){
					$e_s_id=base64_decode($this->uri->segment(3));
					if($e_s_id!=''){
						$statusdata=$this->Examination_model->delete_exam_Syllabus($e_s_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Syllabus successfully Deleted.");

								redirect('examination/addsyllabuslist');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('examination/addsyllabuslist');
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
	
	
	
	
	public  function addmarks(){
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
					$post=$this->input->post();
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$cnt=0;foreach($post['marks_obtained'] as $list){
						$add_marks=array(
						's_id'=>$detail['s_id'],
						'student_id'=>isset($post['student_id'][$cnt])?$post['student_id'][$cnt]:'',
						'exam_id'=>isset($post['exam_id'])?$post['exam_id']:'',
						'subject_id'=>isset($post['subject_id'])?$post['subject_id']:'',
						'class_id'=>isset($post['class_id'])?$post['class_id']:'',
						'marks_obtained'=>isset($post['marks_obtained'][$cnt])?$post['marks_obtained'][$cnt]:'',
						'max_marks'=>isset($post['max_marks'][$cnt])?$post['max_marks'][$cnt]:'',
						'remarks'=>isset($post['remarks'][$cnt])?$post['remarks'][$cnt]:'',
						'status'=>1,
						'create_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
						);
						//echo '<pre>';print_r($add_marks);exit;
						$cnt.$check=$this->Examination_model->chekck_martks_entered($post['student_id'][$cnt],$detail['s_id'],$post['exam_id'],$post['subject_id'],$post['class_id']);
						if(($check)>0){
							$save_marks=$this->Examination_model->update_exam_mark($check['id'],$add_marks);
						}else{
							$save_marks=$this->Examination_model->save_exam_mark($add_marks);
						}
						
						
					$cnt++;}
					
					
					if(count($save_marks)>0){
						$this->session->set_flashdata('success',"Student Marks successfully added.");
						redirect('examination/marks');
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('examination/marks');
					}
					//echo '<pre>';print_r($post);exit;
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
	}
	
	public  function status(){
		
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
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
							$statusdata=$this->Examination_model->update_exam_details($r_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Exam successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Exam successfully Activate.");
								}
								redirect('examination/create');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('examination/create');
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

			if($login_details['role_id']==9){
					$r_id=base64_decode($this->uri->segment(3));
					if($r_id!=''){
						$statusdata=$this->Examination_model->delete_exam($r_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Exam successfully Deleted.");

								redirect('examination/create');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('examination/create');
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
	public function class_student_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8 || $login_details['role_id']==9){
					$post=$this->input->post();
					$student_list=$this->Examination_model->class_wise_student_list($post['class_id']);
					//echo'<pre>';print_r($student_list);exit;
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
	
	public function get_student_allsubjects_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$post=$this->input->post();
					$student_list=$this->Examination_model->get_student_allsubjects_list($post['student_id']);
					//echo'<pre>';print_r($student_list);exit;
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
    public function get_addexam_subjects_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8 || $login_details['role_id']==9){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					$subject_list=$this->Examination_model->get_addexam_subjects_list($detail['s_id'],$post['class_id']);
					//echo'<pre>';print_r($subject_list);exit;
					if(count($subject_list)>0){
						$data['msg']=1;
						$data['list']=$subject_list;
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
    
	public function announcement()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
		if($admindetails['role_id']=8){
				//echo'<pre>';print_r($admindetails);exit;
				$userdetails=$this->Examination_model->get_school_details();
				//echo $this->db->last_query();exit;
			  //echo'<pre>';print_r($userdetails);exit;
				$data['school_list']=$this->Examination_model->get_school_list();
				//echo'<pre>';print_r($data);exit;
				
		$admindetails=$this->session->userdata('userdetails');		
				//echo'<pre>';print_r($admindetails);exit;
$schools_details=$this->Announcement_model->get_schools_list_details($admindetails['u_id']);
				//echo'<pre>';print_r($schools_details);exit;
$data['notification_sent_list']=$this->Examination_model->get_all_sent_notification_details();
	//echo'<pre>';print_r($data['notification_sent_list']);exit;
	
	
				
				
			$data['tab']='';
			$this->load->view('announcement/announcement-notifications',$data);
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
	public function getschoolssname()
	{
		if($this->session->userdata('userdetails'))
		{
				$post=$this->input->post();
				if(isset($post['id']) && count($post['id'])>0){
					foreach($post['id'] as $list){
					$school_name=$this->Announcement_model->getschoolssname($list);
					$names[]=$school_name['scl_bas_name'];
					}
					$tt=implode(",",$names);
					$data['msg']=1;
					$data['names_list']=$tt;
					$data['ids']=$post['id'];
					echo json_encode($data);exit;	
				}else{
					$data['msg']=1;
					$data['names_list']='';
					$data['ids']='';
					echo json_encode($data);exit;	
				}
				
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}
	
	public function sendcomments()
	{
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				if(isset($post['schools_ids']) && $post['schools_ids']!=''){
				foreach(explode(",",$post['schools_ids']) as $lists){
					//echo'<pre>';print_r($post['schools_ids']);exit;
					if($lists !=''){
					$addcomments=array(
					's_id'=>$lists,
					'comment'=>isset($post['comments'])?$post['comments']:'',
					'create_at'=>date('Y-m-d H:i:s'),
					'status'=>1,
					'sent_by'=>$admindetails['u_id']
					);
					//echo'<pre>';print_r($addcomments);exit;
					$save_Notification=$this->Announcement_model->announcements_list($addcomments);
					//echo'<pre>';print_r($save_Notification);exit;
					}
				}
				
				if(count($save_Notification)>0){
					$this->session->set_flashdata('success',"Notification successfully Sent.");
					redirect('examination/announcement');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('examination/announcement');
				}
				
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('examination/announcement');
				}
			
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}

}	
	public function get_student_subject_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8 || $login_details['role_id']==9){
					$post=$this->input->post();
					$subject_list=$this->Examination_model->get_class_wise_subjects($post['class_id']);
					// echo'<pre>';print_r($subject_list);exit;
					 //echo $this->db->last_query();exit;
					if(count($subject_list)>0){
						$data['msg']=1;
						$data['list']=$subject_list;
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
	
	public function get_class_wise_subjects(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==9){
					$post=$this->input->post();
					$subject_list=$this->Examination_model->get_class_wise_subjects($post['class_id']);
					// echo'<pre>';print_r($subject_list);exit;
					 //echo $this->db->last_query();exit;
					if(count($subject_list)>0){
						$data['msg']=1;
						$data['list']=$subject_list;
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
	public  function hallticket(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
               //echo'<pre>';print_r($post);exit;
				if(isset($post['signup'])&& $post['signup']=='submit'){
			$data['student_list']=$this->Examination_model->get_student_list($post['class_id']);
			$data['exam_type_list']=$this->Examination_model->get_exams_type_list($post['exam_type']);
            //echo'<pre>';print_r($data);exit;
			//$data['exam_hallticket']=$this->Examination_model->get_exam_hall_tickets($post['class_id'],$post['student_id'],$post['exam_type']);
				}
			   $data['class_list']=$this->Examination_model->get_addexam_class_list($detail['s_id']);
				$data['subject_list']=$this->Examination_model->get_subject_list($detail['s_id']);
				$data['exam_list']=$this->Examination_model->get_exam_type_list($detail['s_id']);
				$data['exam_instructions']=$this->Examination_model->get_exam_instructions_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('examination/hall-ticket',$data);
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
	public function prints(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
			$emp_id=base64_decode($this->uri->segment(3));
			$class_name=base64_decode($this->uri->segment(4));
			$id=base64_decode($this->uri->segment(5));
		$filename=$emp_id;
		$data['time_table_list']=$this->Examination_model->get_time_table_list($detail['s_id'],$emp_id,$class_name);
		$data['student_details']=$this->Examination_model->student_details($detail['s_id'],$id);
        $data['exam_type']=$this->Examination_model->exam_type($detail['s_id'],$emp_id);

			//echo'<pre>';print_r($data);exit;

		
		//$data['exam_instructions']=$this->Examination_model->get_exam_instructions_list($detail['s_id']);
		//$data['hall_ticket']=$this->Examination_model->get_exam_hall_ticket_print($emp_id);
		$path = rtrim(FCPATH,"/");
					$file_name = '22'.$emp_id.'12_11.pdf';                
					$data['page_title'] = $data['student_details']['class_name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/halltickets/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('examination/hall-ticket-pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/halltickets/".$file_name);
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	 public function get_addexam_marks_subjects_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8 || $login_details['role_id']==9){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					$subject_list=$this->Examination_model->get_addexam_marks_subjects_list($detail['s_id'],$post['class_id']);
					//echo'<pre>';print_r($subject_list);exit;
					if(count($subject_list)>0){
						$data['msg']=1;
						$data['list']=$subject_list;
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
    
	public function get_exam_marks_subjects_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					$subject_list=$this->Examination_model->get_exam_marks_subjects_list($detail['s_id'],$post['class_id']);
					//echo'<pre>';print_r($subject_list);exit;
					if(count($subject_list)>0){
						$data['msg']=1;
						$data['list']=$subject_list;
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
	public function get_exam_types_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==9){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					$subject_list=$this->Examination_model->get_exam_types_list($detail['s_id'],$post['class_id']);
					//echo'<pre>';print_r($subject_list);exit;
					if(count($subject_list)>0){
						$data['msg']=1;
						$data['list']=$subject_list;
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
