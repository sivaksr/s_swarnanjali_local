<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Teachermoduleswise extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Teacher_model');
	}
	public function addclass()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['teacher_modules']=$this->Teacher_model->get_teacher_modules($detail['s_id']);
					$this->load->view('teacher/add-class',$data);
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
				if($login_details['role_id']==3){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
					$check=$this->Teacher_model->check_module_wise_class_exits($post['modules_name'],$post['class']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"teacher module wise class already exists. Please use another module wise class");
						redirect('teachermoduleswise/addclass');
					}
				
				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'modules_name'=>isset($post['modules_name'])?$post['modules_name']:'',
				'class'=>isset($post['class'])?$post['class']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
				);
				$save=$this->Teacher_model->save_teacher_module_wise_class($save_data);	
					if(count($save)>0){
					$this->session->set_flashdata('success',"teacher module wise class successfully added");	
					redirect('teachermoduleswise/classlists');	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('teachermoduleswise/add');
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
	public function classlists()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['modules_wise_class_list']=$this->Teacher_model->teacher_modules_wise_class_list($detail['s_id']);
					$this->load->view('teacher/class-list',$data);
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
	
	public function editclass()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['teacher_modules']=$this->Teacher_model->get_teacher_modules($detail['s_id']);
					$data['edit_modules_wise_class']=$this->Teacher_model->edit_teacher_modules_wise_class($detail['s_id'],base64_decode($this->uri->segment(3)));
					$this->load->view('teacher/edit-class',$data);
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

	public function editclasspost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				$edit_modules_wise_class=$this->Teacher_model->edit_teacher_modules_wise_class($detail['s_id'],$post['t_m_c_id']);
				if($edit_modules_wise_class['modules_name']!=$post['modules_name']|| $edit_modules_wise_class['class']!=$post['class']){
					$check=$this->Teacher_model->check_module_wise_class_exits($post['modules_name'],$post['class']);
					if(count($check)>0){
						$this->session->set_flashdata('error',"teacher module wise class already exists. Please use another module wise class");
						redirect('teachermoduleswise/editclass/'.base64_encode($post['t_m_c_id']));
					}
				}
				
				$update_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'modules_name'=>isset($post['modules_name'])?$post['modules_name']:'',
				'class'=>isset($post['class'])?$post['class']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
				);
				$update=$this->Teacher_model->update_teacher_modules_wise_class($post['t_m_c_id'],$update_data);	
					if(count($update)>0){
					$this->session->set_flashdata('success',"teacher module wise class successfully updated");	
					redirect('teachermoduleswise/classlists');	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('teachermoduleswise/edit/'.base64_encode($post['t_m_c_id']));
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
	
	public function classstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$t_m_c_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
								if($status==1){
								 $stain=0;
								 }else{
									 $stain=1;
								 }
							if($t_m_c_id!=''){
								$staindata=array(
										'status'=> $stain,
										'updated_at'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Teacher_model->update_teacher_modules_wise_class($t_m_c_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if($status==1){
								$this->session->set_flashdata('success',"teacher module wise class successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"teacher module wise class successfully Activate.");
								}
							redirect('teachermoduleswise/classlists');		  					  
	                        }else{
						$this->session->set_flashdata('error',"problem is occurs");
			          redirect('teachermoduleswise/classlists');
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
	public function classdelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$t_m_c_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
							if($t_m_c_id!=''){
								$staindata=array(
										'status'=>2,
										'updated_at'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Teacher_model->update_teacher_modules_wise_class($t_m_c_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if(count($statusdetails)>0){
					$this->session->set_flashdata('success',"teacher modules successfully delete");	
					redirect('teachermoduleswise/classlists');
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('teachermoduleswise/classlists');
					}
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
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