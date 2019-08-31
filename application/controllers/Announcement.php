<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');


class Announcement extends In_frontend {

	
	public function __construct() 
	{
		parent::__construct();	
		
		}
		public function add()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=1){
				//echo'<pre>';print_r($admindetails);exit;
				$userdetails=$this->Announcement_model->get_school_details($admindetails['u_id']);
				//echo $this->db->last_query();exit;
			  //echo'<pre>';print_r($userdetails);exit;
				$data['school_list']=$this->Announcement_model->get_school_list($admindetails['u_id']);
				//echo'<pre>';print_r($data);exit;
				
		$admindetails=$this->session->userdata('userdetails');		
				//echo'<pre>';print_r($admindetails);exit;
$schools_details=$this->Announcement_model->get_schools_list_details($admindetails['u_id']);
				//echo'<pre>';print_r($schools_details);exit;
$data['notification_sent_list']=$this->Announcement_model->get_all_sent_notification_details($admindetails['u_id']);
	//echo'<pre>';print_r($data['notification_sent_list']);exit;
	
	
				
				
			$data['tab']='';
			$this->load->view('announcement/announcement-add',$data);
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
					redirect('Announcement/add');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('Announcement/add');
				}
				
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('Announcement/add');
				}
			
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}

}	

   public function schoolannouncement()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				$details=$this->School_model->get_school_basic_details_with_u_id($admindetails['u_id']);
				//echo'<pre>';print_r($details);exit;
				$data['admin_details']=$this->Announcement_model->get_announcement_details_num($admindetails['u_id']);
				//echo'<pre>';print_r( $data['admin_details']);exit;
				$data['send_notification_list']=$this->Announcement_model->get_total_notification_details($admindetails['u_id']);		
				//echo'<pre>';print_r($school_admin_details);exit;
				$data['notification_list']=$this->Announcement_model->details_admin_form($details['s_id']);
				//echo'<pre>';print_r($data['notification_list']);exit;
				$data['tab']='';
				$this->load->view('announcement/announcement_school',$data);
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

	public function getresourcename()
	{
		if($this->session->userdata('userdetails'))
		{
				$post=$this->input->post();
				//echo '<pre>';print_r($post);exit;
				if(isset($post['id']) && count($post['id'])>0){
					
				
				foreach($post['id'] as $list){
					$school_name=$this->Announcement_model->getresourcename($list);
					$names[]=$school_name['name'];
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
	
	public function resourcecomments()
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
					'res_id'=>$lists,
					'comment'=>isset($post['comments'])?$post['comments']:'',
					'create_at'=>date('Y-m-d H:i:s'),
					'status'=>1,
					'sent_by'=>$admindetails['u_id']
					);
					//echo'<pre>';print_r($addcomments);exit;
					$save_Notification=$this->Announcement_model->announcements_notification_list($addcomments);
					//echo'<pre>';print_r($save_Notification);exit;
					}
				}
				
				if(count($save_Notification)>0){
					$this->session->set_flashdata('success',"Notification successfully Sent.");
					redirect('Announcement/schoolannouncement');
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('Announcement/schoolannouncement');
				}
				
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('Announcement/schoolannouncement');
				}
			
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}

}	

	public  function viewall(){
		if($this->session->userdata('userdetails'))
				{
					$details=$this->session->userdata('userdetails');
					
					$data['userdetails']=$this->Home_model->get_all_admin_details($details['u_id']);
					
					if(isset($data['userdetails']['role_id']) && $data['userdetails']['role_id']!=1 && $data['userdetails']['role_id']==2){
					$data['notification_list']	=$this->Home_model->get_notification_list($data['userdetails']['s_id']);
					
					//echo $this->db->last_query();
					}else if($data['userdetails']['role_id']!=1 && $data['userdetails']['role_id']!=2){
						$data['notification_list']	=$this->Home_model->get_resources_notification_list($details['u_id']);
					}
					//echo '<pre>';print_r($data);exit;
					$this->load->view('announcement/announcement_viewall',$data);
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('home');
				}
	}
	public function get_notification_msg()
	{
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				$post=$this->input->post();
				$details=$this->Announcement_model->get_announcements_comment($post['notification_id']);
				$read=array('readcount'=>1);
				$this->Announcement_model->get_announcement_comment_read($post['notification_id'],$read);
				$school_details=$this->Home_model->get_all_admin_details($admindetails['u_id']);
				$Unread_count=$this->Announcement_model->get_notification_unread_count($school_details['s_id']);
				$data['names_list']=$details['comment'];
				$data['time']=$details['create_at'];
				if(count($Unread_count)>0){
				$data['Unread_count']=count($Unread_count);
				}else{
				$data['Unread_count']='';	
				}
				echo json_encode($data);exit;	
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}
    public function get_resource_notification_msg()
	{
		if($this->session->userdata('userdetails'))
		{
				$admindetails=$this->session->userdata('userdetails');
				$post=$this->input->post();
				$details=$this->Announcement_model->get_resource_announcements_comment($post['notification_id']);
				$read=array('readcount'=>1);
				$this->Announcement_model->get_resource_announcement_comment_read($post['notification_id'],$read);
				$Unread_count=$this->Announcement_model->get_resources_notification_unread_count($admindetails['u_id']);
				$data['names_list']=$details['comment'];
				$data['time']=$details['create_at'];
				if($Unread_count['count']!=0){
				$data['Unread_count']=$Unread_count['count'];
				}else{
				$data['Unread_count']='';	
				}
				//echo '<pre>';print_r($data);exit;
				echo json_encode($data);exit;	
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}
    
    public  function smstextemail(){
		if($this->session->userdata('userdetails'))
				{
					$login_details=$this->session->userdata('userdetails');
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('announcement/sms_text_email',$data);
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('home');
				}
	}
	public  function get_student_list(){
		if($this->session->userdata('userdetails'))
		{
			$post=$this->input->post();
			$data['s_list']=$this->Student_model->get_students($post['c_id']);
			$this->load->view('announcement/assign_student_list',$data);
			$this->load->view('html/footer');
			
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
    
   public function class_student_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$post=$this->input->post();
					
					$student_list=$this->Student_model->class_wise_student_list($post['class_id']);
					//echo '<pre>';print_r($student_list);exit;
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
				redirect('dashboard');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	/*
	public  function smspost(){
		if($this->session->userdata('userdetails'))
		{
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			
			if(count($post['stu_ids'])>0){
				foreach($post['stu_ids'] as $li){
						$username = $this->config->item('smsusername');
						$pass     = $this->config->item('smspassword');
						$sender   = $this->config->item('sender');
						$msg      = $post['msg'];
						$ch2 = curl_init();
						curl_setopt($ch2, CURLOPT_URL, "http://trans.smsfresh.co/api/sendmsg.php");
						curl_setopt($ch2, CURLOPT_POST, 1);
						curl_setopt($ch2, CURLOPT_POSTFIELDS, 'user=' . $username . '&pass=' . $pass . '&sender=' . $sender . '&phone=' .$li. '&text=' . $msg . '&priority=ndnd&stype=normal');
						curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
						$server_output = curl_exec($ch2);
						//echo '<pre>';print_r($server_output);
						curl_close($ch2);
				}
			}
			$this->session->set_flashdata('success',"Message successfully sent");
			redirect('announcement/smstextemail');
			
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	*/
	public  function sms(){
		if($this->session->userdata('userdetails'))
				{
					$login_details=$this->session->userdata('userdetails');
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					//echo '<pre>';print_r($data);exit;
					$this->load->view('announcement/sms_text_email',$data);
					$this->load->view('html/footer');
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('home');
				}
	}
	public  function smspost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3){
			$post=$this->input->post();
			//echo'<pre>';print_r($post);exit;
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);
			foreach($post['student_name'] as $lis){ 
				$check[]=$this->Student_model->get_student_name_list(ucfirst($lis),$detail['s_id']);
				}

			foreach($check as $list){
				$mobiles[]=$list['mobile'];
			}
			$los=implode(',', $mobiles);
		//echo '<pre>';print_r($los);exit;

			if($check!=array()){
			$otp=isset($post['msg'])?$post['msg']:'';
            $username = $this->config->item('smsusername');
            $pass     = $this->config->item('smspassword');
            $sender   = $this->config->item('sender');
            $msg      =isset($otp)?$otp:'';
			$save_data=array(
			's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
			'sms'=>isset($post['sms'])?$post['sms']:'',
			'class_id'=>isset($post['class_id'])?$post['class_id']:'',
			'msg'=>isset($post['msg'])?$post['msg']:'',
			'otp'=>isset($otp)?$otp:'',
			'opt_created_at'=>date('Y-m-d H:i:s'),
			'status'=>1,
			'created_at'=>date('Y-m-d H:i:s'),
			'created_by'=>$login_details['u_id'],
			);
			$save=$this->Student_model->save_sms_details($save_data);
			//echo '<pre>';print_r($save);exit;
			if(count($save)>0){
			if(isset($post['student_name']) && count($post['student_name'])>0){
					$cnt=0;foreach($post['student_name'] as $li){ 
						  $add_data=array(
						  'sms_id'=>isset($save)?$save:'',
						  's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						  'student_name'=>$li,
						  'status'=>1,
						  'created_at'=>date('Y-m-d H:i:s'),
						  'updated_at'=>date('Y-m-d H:i:s'),
						  'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
						  );
						   //echo '<pre>';print_r($add_data);exit;
						  $this->Student_model->save_send_sms_students($add_data);	

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
			$this->session->set_flashdata('success',"Message successfully sent");
			redirect('announcement/smslists');
			}else{
			$this->session->set_flashdata('error','technical problem will occurred. Please try again.');
			redirect('announcement/sms');	
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
	public function smslists()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$data['student_list']=$this->Student_model->get_student_send_sms_list($detail['s_id']);
					//echo'<pre>';print_r($data);exit;
					$this->load->view('announcement/list',$data);
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
	
	
	




