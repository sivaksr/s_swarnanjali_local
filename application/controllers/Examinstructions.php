<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Examinstructions extends In_frontend {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Examination_model');	
         $this->load->model('Announcement_model');		
	
	}
	
	public function add()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			//echo '<pre>';print_r($admindetails);exit;
			if($login_details['role_id']==9){
				$this->load->view('examination/add-examinstructions');	
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
	public function addpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);
			if($login_details['role_id']==9){
				$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;

				$cnt=0; foreach($post['instructions'] as $list){ 
				$save_data=array(
				's_id'=>$detail['s_id'],
				'instructions'=>$list,
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'update_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
				//echo'<pre>';print_r($save_data);exit;

				$save_exam=$this->Examination_model->save_exam_instructions($save_data);
				
				$cnt++;}
				$this->session->set_flashdata('success',"Exam Instructions successfully added.");
				redirect('examinstructions/lists');
				
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
	public function lists()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			//echo '<pre>';print_r($admindetails);exit;
			if($login_details['role_id']==9){
			$detail=$this->School_model->get_resources_details($login_details['u_id']);
			$data['exam_instructions']=$this->Examination_model->get_exam_instructions($detail['s_id']);
				
				$this->load->view('examination/examinstructions-list',$data);	
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
			if($login_details['role_id']==9){
			$e_i_id=base64_decode($this->uri->segment(3));	
			$detail=$this->School_model->get_resources_details($login_details['u_id']);
			$data['edit_exam_instructions']=$this->Examination_model->edit_exam_instructions($e_i_id,$detail['s_id']);
				$this->load->view('examination/edit-examinstructions',$data);	
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
	public function editpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);
			if($login_details['role_id']==9){
				$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;

				$save_data=array(
				's_id'=>$detail['s_id'],
				'instructions'=>isset($post['instructions'])?$post['instructions']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'update_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
				//echo'<pre>';print_r($save_data);exit;
				$update=$this->Examination_model->update_exam_instructions($post['e_i_id'],$save_data);
				if(count($update)>0){
				$this->session->set_flashdata('success',"Exam Instructions successfully updated.");
				redirect('examinstructions/lists');
				}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('examinstructions/lists');
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
	public  function status(){
		
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==9){
					$e_i_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($e_i_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Examination_model->update_exam_instructions($e_i_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Exam Instructions successfully Deactivated.");
								}else{
									$this->session->set_flashdata('success',"Exam Instructions successfully Activated.");
								}
								redirect('examinstructions/lists');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('examinstructions/lists');
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
					$e_i_id=base64_decode($this->uri->segment(3));
						$statusdata=$this->Examination_model->delete_exam_instructions($e_i_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Exam Instructions successfully Deleted.");

								redirect('examinstructions/lists');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('examinstructions/lists');
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
	
	
	
	
	
	
	
}