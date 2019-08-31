<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Resource extends In_frontend {

	
	public function __construct() 
	{
		parent::__construct();	
		
		}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==2){
				$data['tab']=base64_decode($this->uri->segment(3));
				$data['school_details']=$this->School_model->get_school_basic_details_with_u_id($login_details['u_id']);
				$data['role_list']=$this->Home_model->get_roles_list();
				$data['resource_list']=$this->Resource_model->get_resource_list($login_details['u_id']);
				//echo '<pre>';print_r($data['resource_list']);exit;
				$this->load->view('resource/add-resource',$data);
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
			if($login_details['role_id']==2){
				$post=$this->input->post();
				
				//echo '<pre>';print_r($post);exit;
				$check_email=$this->Home_model->check_email_exits($post['email']);
				if(count($check_email)>0){
					$this->session->set_flashdata('error',"Email address already exists. Please another email address.");
					redirect('resource');
				}
				
					if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=''){
						$temp = explode(".", $_FILES["image"]["name"]);
							$image = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['image']['tmp_name'], "assets/adminpic/" . $image);
						}else{
							$image='';
						}
						if(isset($post['role_id']) &&count($post['role_id'])>0){
							$role_ids=implode(",",$post['role_id']);
						}else{
							$role_ids='';
						}
						$adddetails=array(
							's_id'=>isset($post['school_id'])?$post['school_id']:'',
							'role_id'=>isset($role_ids)?$role_ids:'',
							'name'=>isset($post['name'])?$post['name']:'',
							'email'=>isset($post['email'])?$post['email']:'',
							'gender'=>isset($post['gender'])?$post['gender']:'',
							'mobile'=>isset($post['phone'])?$post['phone']:'',
							'qalification'=>isset($post['qalification'])?$post['qalification']:'',
							'address'=>isset($post['address'])?$post['address']:'',
							'notes'=>isset($post['notes'])?$post['notes']:'',
							'profile_pic'=>$image,
							'password'=>isset($post['confirmpassword'])?md5($post['confirmpassword']):'',
							'org_password'=>isset($post['confirmpassword'])?$post['confirmpassword']:'',
							'status'=>1,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$login_details['u_id'],
						);
						//echo '<pre>';print_r($adddetails);exit;
						$add_school=$this->Resource_model->save_rsources($adddetails);
						if(count($add_school)>0){
								$this->session->set_flashdata('success',"Resource added Successfully");
								redirect('resource/index/'.base64_encode(1));
						}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('resource/index');
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
	public function edit()
	{	
			if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			//echo "<pre>";print_r($login_details);exit;
			if($login_details['role_id']==2){
				
				$r_id=base64_decode($this->uri->segment(3));
				$data['role_list']=$this->Home_model->get_roles_list();
				$data['resources_details']=$this->Resource_model->get_resources_details($r_id);
				//echo "<pre>";print_r($data);exit;
				$this->load->view('resource/edit-resource',$data);
				$this->load->view('html/footer');
			}else{
				$this->session->set_flashdata('error',"you don't have permission to access");
				redirect('dashboard');
			}

		}else{
			$this->session->set_flashdata('loginerror','Please login to continue');
			redirect('admin');
		}
	}
	public function editpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==2){
				$post=$this->input->post();
				$detail=$this->Resource_model->get_resources_details($post['u_id']);
				if($detail['email']!=$post['email']){
					$check_email=$this->Home_model->check_email_exits($post['email']);
						if(count($check_email)>0){
							$this->session->set_flashdata('error',"Email address already exists. Please another email address.");
							redirect('resource/edit/'.base64_encode($post['u_id']));
						}
				}
				
					if(isset($_FILES['image']['name']) && $_FILES['image']['name']!=''){
						$temp = explode(".", $_FILES["image"]["name"]);
							unlink('assets/adminpic/'.$detail['profile_pic']);
							$image = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['image']['tmp_name'], "assets/adminpic/" . $image);
						}else{
							$image=$detail['profile_pic'];
						}
						if(isset($post['role_id']) &&count($post['role_id'])>0){
							$role_ids=implode(",",$post['role_id']);;
						}else{
							$role_ids='';
						}
						$updatedetails=array(
							'role_id'=>isset($role_ids)?$role_ids:'',
							'name'=>isset($post['name'])?$post['name']:'',
							'email'=>isset($post['email'])?$post['email']:'',
							'gender'=>isset($post['gender'])?$post['gender']:'',
							'mobile'=>isset($post['phone'])?$post['phone']:'',
							'qalification'=>isset($post['qalification'])?$post['qalification']:'',
							'address'=>isset($post['address'])?$post['address']:'',
							'notes'=>isset($post['notes'])?$post['notes']:'',
							'profile_pic'=>$image,
							'update_at'=>date('Y-m-d H:i:s'),
						);
						//echo '<pre>';print_r($adddetails);exit;
						$update=$this->Home_model->update_profile_details($post['u_id'],$updatedetails);
						if(count($update)>0){
								$this->session->set_flashdata('success',"Resource details are successfully Updated");
								redirect('resource/index/'.base64_encode(1));
						}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('resource/edit/'.base64_encode($post['u_id']));
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
	public  function status(){
		
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==2){
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
								$this->session->set_flashdata('success',"Resource Successfully Deactivated.");
								}else{
									$this->session->set_flashdata('success',"Resource Successfully Activated.");
								}
								redirect('resource/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('resource/index/'.base64_encode(1));
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

			if($login_details['role_id']==2){
					$r_id=base64_decode($this->uri->segment(3));
					if($r_id!=''){
						$stusdetails=array(
							'status'=>2,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Home_model->update_profile_details($r_id,$stusdetails);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Resource successfully Deleted.");

								redirect('resource/index/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('resource/index/'.base64_encode(1));
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
	
	
	
	
	
}
