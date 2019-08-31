<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Teacher extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Teacher_model');
	}
	public function add()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					
					$this->load->view('teacher/add');
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
					$check=$this->Teacher_model->check_module_exits($detail['s_id'],$post['modules']);
					if(($check)>0){
						$this->session->set_flashdata('error',"Teacher Module already exists. Please use another Module");
						redirect('teacher/add');
					}
				
				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'modules'=>isset($post['modules'])?$post['modules']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
				);
				$save=$this->Teacher_model->save_teacher_modules($save_data);	
					if(count($save)>0){
					$this->session->set_flashdata('success',"teacher modules successfully added");	
					redirect('teacher/lists');	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('teacher/add');
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
	public function lists()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['modules_list']=$this->Teacher_model->teacher_modules_list($detail['s_id']);
					$this->load->view('teacher/list',$data);
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
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['edit_modules']=$this->Teacher_model->edit_teacher_modules($detail['s_id'],base64_decode($this->uri->segment(3)));
					$this->load->view('teacher/edit',$data);
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
	public function editpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				$edit_modules=$this->Teacher_model->edit_teacher_modules($detail['s_id'],$post['t_m_id']);
				if($edit_modules['modules']!=$post['modules']){
					$check=$this->Teacher_model->check_module_exits($detail['s_id'],$post['modules']);
					if(($check)>0){
						$this->session->set_flashdata('error',"Teacher Module already exists. Please use another Module");
						redirect('teacher/edit/'.base64_encode($post['t_m_id']));
					}
				}
				$update_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'modules'=>isset($post['modules'])?$post['modules']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
				);
				$update=$this->Teacher_model->update_teacher_modules($post['t_m_id'],$update_data);	
					if(count($update)>0){
					$this->session->set_flashdata('success',"teacher modules successfully updated");	
					redirect('teacher/lists');	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('teacher/edit/'.base64_encode($post['t_m_id']));
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
	public function status()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$t_m_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
								if($status==1){
								 $stain=0;
								 }else{
									 $stain=1;
								 }
							if($t_m_id!=''){
								$staindata=array(
										'status'=> $stain,
										'updated_at'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Teacher_model->update_teacher_modules($t_m_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if($status==1){
								$this->session->set_flashdata('success',"teacher modules successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"teacher modules successfully Activate.");
								}
							redirect('teacher/lists');			  					  
	                        }else{
						$this->session->set_flashdata('error',"problem is occurs");
			           redirect('teacher/lists');	
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
	public function delete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$t_m_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
							if($t_m_id!=''){
								$staindata=array(
										'status'=>2,
										'updated_at'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Teacher_model->update_teacher_modules($t_m_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if(count($statusdetails)>0){
					$this->session->set_flashdata('success',"teacher modules successfully delete");	
					redirect('teacher/lists');	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('teacher/lists');
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