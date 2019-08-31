<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Principal extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Principal_model');
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==12){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					//$data['teacher_type']=$this->School_model->get_teacher_modules($detail['s_id']);
					$data['teacher_modules']=$this->Principal_model->get_teacher_modules($detail['s_id']);
					//echo'<pre>';print_r($data);exit;
					$this->load->view('principal/add',$data);
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
	public  function addpost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==12){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				foreach($post['teacher_ids'] as $lis){ 
				$check[]=$this->Principal_model->get_teacher_list(ucfirst($lis),$detail['s_id']);
				}
			foreach($check as $list){
				$mobiles[]=$list['mobile'];
			}
			$los=implode(',', $mobiles);
			//echo '<pre>';print_r($los);exit;
			if($check!=array()){
			$otp=isset($post['instractions'])?$post['instractions']:'';
            $username = $this->config->item('smsusername');
            $pass     = $this->config->item('smspassword');
            $sender   = $this->config->item('sender');
            $msg      = "Principal Request : ".$otp;
			$save_data=array(
			's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
			'teacher_modules'=>isset($post['teacher_modules'])?$post['teacher_modules']:'',
			'instractions'=>isset($post['instractions'])?$post['instractions']:'',
			'otp'=>isset($otp)?$otp:'',
			'opt_created_at'=>date('Y-m-d H:i:s'),
			'status'=>1,
			'created_at'=>date('Y-m-d H:i:s'),
			'created_by'=>$login_details['u_id'],
			);
			$save=$this->Principal_model->save_principal_assign_instractions($save_data);
			//echo '<pre>';print_r($save);exit;
			if(count($save)>0){
			if(isset($post['teacher_ids']) && count($post['teacher_ids'])>0){
					$cnt=0;foreach($post['teacher_ids'] as $li){ 
						  $add_data=array(
						  'p_a_id'=>isset($save)?$save:'',
						  's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						  'teacher_ids'=>$li,
						  'status'=>1,
						  'created_at'=>date('Y-m-d H:i:s'),
						  'updated_at'=>date('Y-m-d H:i:s'),
						  'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
						  );
						   //echo '<pre>';print_r($add_data);exit;
						  $this->Principal_model->save_teacher_name_ids($add_data);	

				       $cnt++;}
					}
			}
            $ch2 = curl_init();
            curl_setopt($ch2, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php");
            curl_setopt($ch2, CURLOPT_POST, 1);
            curl_setopt($ch2, CURLOPT_POSTFIELDS, 'user=' . $username . '&pass=' . $pass . '&sender=' . $sender . '&phone=' .$los. '&text=' . $msg . '&priority=ndnd&stype=normal');
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch2);
			//echo '<pre>';print_r($server_output);exit;
            curl_close($ch2);
		$this->session->set_flashdata('success','Principal assign to teachers instructions sucessfully send');
		redirect('principal');	
		}else{
			$this->session->set_flashdata('error','technical problem will occurred. Please try again.');
			redirect('principal');	
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
	 public function get_teachers_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==12){
					$post=$this->input->post();
					
					$teachers_list=$this->Principal_model->get_teachers_list($post['teacher_modules']);
					//echo '<pre>';print_r($teachers_list);exit;
					if(count($teachers_list)>0){
						$data['msg']=1;
						$data['list']=$teachers_list;
						echo json_encode($data);exit;	
					}else{
						$data['msg']=0;
						echo json_encode($data);exit;
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
				if($login_details['role_id']==12 || $login_details['role_id']==3){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$data['teacher_list']=$this->Principal_model->get_principal_assign_instructions_teachers($detail['s_id']);
					//echo'<pre>';print_r($data);exit;
					$this->load->view('principal/list',$data);
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