<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class School extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
	
	}
	public  function index(){
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=1){
				$data['school_list']=$this->School_model->get_all_school_list_details($admindetails['u_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('school/school-list',$data);
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
	public function add()
	{	
		if($this->session->userdata('userdetails'))
		{
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=1){
				$data['tab']=base64_decode($this->uri->segment(3));
				$scl_id=base64_decode($this->uri->segment(4));
				$data['school_details']=$this->School_model->get_school_details($scl_id);
				//echo '<pre>';print_r($data);exit;
			$this->load->view('school/add-school',$data);
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
			$admindetails=$this->session->userdata('userdetails');
			if($admindetails['role_id']=2){
				//echo '<pre>';print_r($admindetails);exit;
				$data['tab']=1;
				$data['school_details']=$this->School_model->get_school_details_with_u_id($admindetails['u_id']);
				//echo '<pre>';print_r($data);exit;
			$this->load->view('school/add-school',$data);
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
			$logindetails=$this->session->userdata('userdetails');
				if($logindetails['role_id']==1 || $logindetails['role_id']==2){
					$post=$this->input->post();
					
					//echo '<pre>';print_r($logindetails);exit;
					if(isset($post['school_id']) && $post['school_id']!=''){
						$details=$this->School_model->get_school_details($post['school_id']);
						if($details['scl_email_id']!=$post['scl_email_id']){
							$emailcheck= $this->Home_model->check_emails_exits($post['scl_email_id']);
							if(count($emailcheck)>0){
								$this->session->set_flashdata('error','Email id already exists.please use another Email id');
								redirect('school/add/'.base64_encode(1).'/'.base64_encode($post['school_id']));
							}
						}
								$update_scl_data=array(
									'scl_email_id'=>isset($post['scl_email_id'])?$post['scl_email_id']:'',
									'scl_con_number'=>isset($post['scl_con_number'])?$post['scl_con_number']:'',
									'update_at'=>date('Y-m-d H:i:s'),
									);
								$update_school=$this->School_model->update_school_details($details['s_id'],$update_scl_data);
								if(count($update_school)>0){
									
										$admin_updata_data=array(
											'email'=>isset($post['scl_email_id'])?$post['scl_email_id']:'',
											'mobile'=>isset($post['scl_con_number'])?$post['scl_con_number']:'',
											'update_at'=>date('Y-m-d H:i:s'),
										);
										$this->Home_model->update_profile_details($details['u_id'],$admin_updata_data);
										$this->session->set_flashdata('success',"School Credential are successfully updated");
										redirect('school/add/'.base64_encode(2).'/'.base64_encode($details['s_id']));
									}else{
										$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
										redirect('school/add/'.base64_encode(1).'/'.base64_encode($details['s_id']));
									}
					
					}else{
						$emailcheck= $this->Home_model->check_emails_exits($post['scl_email_id']);
							if(count($emailcheck)>0){
								$this->session->set_flashdata('error','Email id already exists.please use another Email id');
								redirect('school/add/'.base64_encode(1));
							}
							$add_data=array(
							'email'=>isset($post['scl_email_id'])?$post['scl_email_id']:'',
							'mobile'=>isset($post['scl_con_number'])?$post['scl_con_number']:'',
							'password'=>isset($post['confirmpassword'])?md5($post['confirmpassword']):'',
							'org_password'=>isset($post['confirmpassword'])?$post['confirmpassword']:'',
							'status'=>1,
							'role_id'=>2,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$logindetails['u_id'],
							);
							$save_admin=$this->School_model->save_school_admin($add_data);
							if(count($save_admin)>0){
									$add_scl_data=array(
									'u_id'=>isset($save_admin)?$save_admin:'',
									'scl_email_id'=>isset($post['scl_email_id'])?$post['scl_email_id']:'',
									'scl_con_number'=>isset($post['scl_con_number'])?$post['scl_con_number']:'',
									'status'=>1,
									'create_at'=>date('Y-m-d H:i:s'),
									'create_by'=>$logindetails['u_id'],
									);
									$school_save=$this->School_model->save_school_data($add_scl_data);
									if(count($school_save)>0){
										$this->session->set_flashdata('success',"School Credential are successfully created");
										redirect('school/add/'.base64_encode(2).'/'.base64_encode($school_save));
									}else{
										$this->School_model->delete_admin_user($save_admin);
										$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
										redirect('school/add/'.base64_encode(1));
									}
								
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/add/'.base64_encode(1));
							}
						
					}
						
					//echo '<pre>';print_r($save_admin);exit;
					
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
	}
	
	public  function addrepresentative(){
		if($this->session->userdata('userdetails'))
		{
				$logindetails=$this->session->userdata('userdetails');
				if($logindetails['role_id']==1 || $logindetails['role_id']==2){
					$post=$this->input->post();
					//echo '<pre>';print_r($post);exit;
					$twodata=array(
							'scl_representative'=>isset($post['scl_representative'])?$post['scl_representative']:'',
							'scl_rep_contact'=>isset($post['scl_rep_contact'])?$post['scl_rep_contact']:'',
							'mob_country_code'=>isset($post['mob_country_code'])?$post['mob_country_code']:'',
							'scl_rep_mobile'=>isset($post['scl_rep_mobile'])?$post['scl_rep_mobile']:'',
							'scl_rep_email'=>isset($post['scl_rep_email'])?$post['scl_rep_email']:'',
							'scl_rep_nationali_id'=>isset($post['scl_rep_nationali_id'])?$post['scl_rep_nationali_id']:'',
							'scl_rep_add1'=>isset($post['scl_rep_add1'])?$post['scl_rep_add1']:'',
							'scl_rep_add2'=>isset($post['scl_rep_add2'])?$post['scl_rep_add2']:'',
							'scl_rep_zipcode'=>isset($post['scl_rep_zipcode'])?$post['scl_rep_zipcode']:'',
							'scl_rep_city'=>isset($post['scl_rep_city'])?$post['scl_rep_city']:'',
							'scl_rep_state'=>isset($post['scl_rep_state'])?$post['scl_rep_state']:'',
							'scl_rep_country'=>isset($post['scl_rep_country'])?$post['scl_rep_country']:'',
							'update_at'=>date('Y-m-d H:i:s')
							);
						$steptwo= $this->School_model->update_school_details($post['school_id'],$twodata);
						if(count($steptwo)>0){
								$this->session->set_flashdata('success',"School Representative details are successfully updated");
								redirect('school/add/'.base64_encode(3).'/'.base64_encode($post['school_id']));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/add/'.base64_encode(2).'/'.base64_encode($post['school_id']));
							}	
					
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	public  function basicdetails(){
		if($this->session->userdata('userdetails'))
		{
				$logindetails=$this->session->userdata('userdetails');
				if($logindetails['role_id']==1 || $logindetails['role_id']==2){
					$post=$this->input->post();
						$details=$this->School_model->get_school_details($post['school_id']);

					//echo '<pre>';print_r($post);exit;
					if(isset($_FILES['scl_bas_document']['name']) && $_FILES['scl_bas_document']['name']!=''){
							unlink("assets/school_basicdetails/".$details['scl_bas_document']);
							$temp = explode(".", $_FILES["scl_bas_document"]["name"]);
							$scl_bas_document = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['hos_bas_document']['tmp_name'], "assets/school_basicdetails/" . $scl_bas_document);
						}else{
							$scl_bas_document=$details['scl_bas_document'];
						}
						if(isset($_FILES['scl_bas_logo']['name']) && $_FILES['scl_bas_logo']['name']!=''){
							unlink("assets/school_basicdetails/".$details['scl_bas_logo']);
							$temp = explode(".", $_FILES["scl_bas_logo"]["name"]);
							$scl_bas_logo = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['scl_bas_logo']['tmp_name'], "assets/school_basicdetails/" . $scl_bas_logo);
						}else{
							$scl_bas_logo=$details['scl_bas_logo'];
						}
					$threedata=array(
							'scl_bas_name'=>isset($post['scl_bas_name'])?$post['scl_bas_name']:'',
							'scl_bas_contact'=>isset($post['scl_bas_contact'])?$post['scl_bas_contact']:'',
							'scl_bas_email'=>isset($post['scl_bas_email'])?$post['scl_bas_email']:'',
							'scl_bas_nationali_id'=>isset($post['scl_bas_nationali_id'])?$post['scl_bas_nationali_id']:'',
							'scl_bas_add1'=>isset($post['scl_bas_add1'])?$post['scl_bas_add1']:'',
							'scl_bas_add2'=>isset($post['scl_bas_add2'])?$post['scl_bas_add2']:'',
							'scl_bas_zipcode'=>isset($post['scl_bas_zipcode'])?$post['scl_bas_zipcode']:'',
							'scl_bas_city'=>isset($post['scl_bas_city'])?$post['scl_bas_city']:'',
							'scl_bas_state'=>isset($post['scl_bas_state'])?$post['scl_bas_state']:'',
							'scl_bas_country'=>isset($post['scl_bas_country'])?$post['scl_bas_country']:'',
							'working_month'=>isset($post['working_month'])?$post['working_month']:'',
							'scl_bas_document'=>$scl_bas_document,
							'scl_bas_logo'=>$scl_bas_logo,
							'update_at'=>date('Y-m-d H:i:s')
							);
						$update_data= $this->School_model->update_school_details($post['school_id'],$threedata);
						if(count($update_data)>0){
								$this->session->set_flashdata('success',"School Basic details are successfully updated");
								redirect('school/add/'.base64_encode(4).'/'.base64_encode($post['school_id']));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/add/'.base64_encode(3).'/'.base64_encode($post['school_id']));
							}	
					
				}else{
					$this->session->set_flashdata('error',"you don't have permission to access");
					redirect('dashboard');
				}
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	public function financial()
	{
		if($this->session->userdata('userdetails'))
		{
				$logindetails=$this->session->userdata('userdetails');
				if($logindetails['role_id']==1 || $logindetails['role_id']==2){
					
					$post=$this->input->post();
					$details=$this->School_model->get_school_details($post['school_id']);
						//echo '<pre>';print_r($_FILES);exit;
						if(isset($_FILES['bank_documents']['name']) && $_FILES['bank_documents']['name']!=''){
							if($details['bank_document']!=''){
								unlink("assets/school_basicdetails/".$details['bank_document']);
							}
							
							$temp = explode(".", $_FILES["bank_documents"]["name"]);
							$bank_document = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['bank_documents']['tmp_name'], "assets/school_basicdetails/" . $bank_document);
						}else{
							$bank_document='';
						}
					$fourdata=array(
							'bank_holder_name'=>$post['bank_holder_name'],
							'bank_acc_no'=>$post['bank_acc_no'],
							'bank_name'=>$post['bank_name'],
							'bank_ifsc'=>$post['bank_ifsc'],
							'bank_document'=>$bank_document,
							'update_at'=>date('Y-m-d H:i:s')
							);
						$update_data= $this->School_model->update_school_details($post['school_id'],$fourdata);
							if(count($update_data)>0){
								$this->session->set_flashdata('success',"School Financial Details are successfully updated");
								redirect('school/add/'.base64_encode(5).'/'.base64_encode($post['school_id']));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/add/'.base64_encode(4).'/'.base64_encode($post['school_id']));
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
	public function otherdetails()
	{
		if($this->session->userdata('userdetails'))
		{
				$logindetails=$this->session->userdata('userdetails');
				if($logindetails['role_id']==1 || $logindetails['role_id']==2){
					
					$post=$this->input->post();
					//echo '<pre>';print_r($logindetails);exit;
					$details=$this->School_model->get_school_details($post['school_id']);

						if(isset($_FILES['kyc_file1']['name']) && $_FILES['kyc_file1']['name']!=''){
							if($details['kyc_file1']!=''){
							unlink("assets/school_basicdetails/".$details['kyc_file1']);
							}
							$temp = explode(".", $_FILES["kyc_file1"]["name"]);
							$file1 = round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file1']['tmp_name'], "assets/school_basicdetails/" . $file1);
						}else{
							$file1=$details['kyc_file1'];
						}
						if(isset($_FILES['kyc_file2']['name']) && $_FILES['kyc_file2']['name']!=''){
							if($details['kyc_file2']!=''){
							unlink("assets/school_basicdetails/".$details['kyc_file2']);
							}
							$temp = explode(".", $_FILES["kyc_file2"]["name"]);
							$file2 =base64_decode($post['school_id']).round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file2']['tmp_name'], "assets/school_basicdetails/" . $file2);
						}else{
							$file2=$details['kyc_file2'];
						}
						if(isset($_FILES['kyc_file3']['name']) && $_FILES['kyc_file3']['name']!=''){
							if($details['kyc_file3']!=''){
							unlink("assets/school_basicdetails/".$details['kyc_file3']);
							}
							$temp = explode(".", $_FILES["kyc_file3"]["name"]);
							$file3 =base64_decode($post['school_id']).'1'.round(microtime(true)) . '.' . end($temp);
							move_uploaded_file($_FILES['kyc_file3']['tmp_name'], "assets/school_basicdetails/" . $file3);
						}else{
							$file3=$details['kyc_file3'];
						}
					$fivedata=array(
							'kyc_doc1'=>isset($post['kyc_doc1'])?$post['kyc_doc1']:'',
							'kyc_doc2'=>isset($post['kyc_doc2'])?$post['kyc_doc2']:'',
							'kyc_doc3'=>isset($post['kyc_doc3'])?$post['kyc_doc3']:'',
							'kyc_file1'=>$file1,
							'kyc_file2'=>$file2,
							'kyc_file3'=>$file3,
							'completed'=>1,
							'update_at'=>date('Y-m-d H:i:s')
							);
						$update_data= $this->School_model->update_school_details($post['school_id'],$fivedata);
							if(count($update_data)>0){
								$this->session->set_flashdata('success',"School Details are successfully Saved");
								
								if($logindetails['role_id']==2){
									redirect('school/add/'.base64_encode(1).'/'.base64_encode($post['school_id']));
								}else{
								redirect('school');
								}
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/add/'.base64_encode(5).'/'.base64_encode($post['school_id']));
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
			if($admindetails['role_id']=1){
					$s_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($s_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->School_model->update_school_details($s_id,$stusdetails);
							if(count($statusdata)>0){
									$details=$this->School_model->get_school_basic_details($s_id);
									$admindetails=array(
									'status'=>$statu,
									'update_at'=>date('Y-m-d H:i:s')
									);
								$this->Home_model->update_profile_details($details['u_id'],$admindetails);
								if($status==1){
								$this->session->set_flashdata('success',"School successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"School successfully activated.");
								}
								redirect('school');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school');
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
			if($admindetails['role_id']=1){
					$s_id=base64_decode($this->uri->segment(3));
					if($s_id!=''){
						$stusdetails=array(
							'status'=>2,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->School_model->update_school_details($s_id,$stusdetails);
							if(count($statusdata)>0){
									$details=$this->School_model->get_school_basic_details($s_id);
									$admindetails=array(
									'status'=>2,
									'update_at'=>date('Y-m-d H:i:s')
									);
								$this->Home_model->update_profile_details($details['u_id'],$admindetails);
								$this->session->set_flashdata('success',"School successfully Deleted.");
								redirect('school');
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school');
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
	
	/* scholl details*/
	public function class_lists()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=2){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$data['tab']=base64_decode($this->uri->segment(3));
				$class_id=base64_decode($this->uri->segment(4));
				if(isset($class_id) && $class_id!=''){
					$data['class_details']=$this->School_model->get_class_details($class_id);
				}else{
					$data['class_details']=array();
				}
			$data['teacher_modules']=$this->School_model->get_teacher_modules($detail['s_id']);

				
				$data['class_list']=$this->School_model->get_class_list($detail['s_id']);
				$data['class_name']=$this->School_model->get_class_name($detail['s_id']);	

				
				//echo '<pre>';print_r($data);exit;
				$this->load->view('school/add-class',$data);
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
	public function get_class_name_list(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$floors=$this->School_model->get_class_name_list($detail['s_id'],$post['teacher_module']);
					//echo'<pre>';print_r($floors);exit;
					if(count($floors)>0){
						$data['msg']=1;
						$data['list']=$floors;
						echo json_encode($data);exit;	
					}else{
						$data['msg']=0;
						echo json_encode($data);exit;
					}
			
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	
	
	public  function addclasspost(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3){
				$post=$this->input->post();
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				//echo '<pre>';print_r($post);exit;
				
				if(isset($post['c_id']) && $post['c_id']!=''){
					$class_details=$this->School_model->get_class_details($post['c_id']);
					if($class_details['name']!=$post['name'] || $class_details['section']!=$post['section'] || $class_details['capacity']!=$post['capacity']){
						$check_email=$this->School_model->check_class_name_exist($detail['s_id'],$post['name'],$post['section'],$post['capacity']);
						if(count($check_email)>0){
							$this->session->set_flashdata('error',"Class name already exists. Please another class name.");
							redirect('school/class_lists/'.base64_encode(0).'/'.base64_encode($post['c_id']));
						}
					}
					$editclass=array(
						'teacher_module'=>isset($post['teacher_module'])?$post['teacher_module']:'',
						'name'=>isset($post['name'])?$post['name']:'',
						'section'=>isset($post['section'])?$post['section']:'',
						'capacity'=>isset($post['capacity'])?$post['capacity']:'',
						'update_at'=>date('Y-m-d H:i:s'),
					);
					//echo '<pre>';print_r($addstudent);exit;
					$save_class=$this->School_model->update_school_class_details($post['c_id'],$editclass);
				}else{
					$check_email=$this->School_model->check_class_name_exist($detail['s_id'],$post['name'],$post['section'],$post['capacity']);
					if(count($check_email)>0){
						$this->session->set_flashdata('error',"Class name already exists. Please another class name.");
						redirect('school/class_lists');
					}
					
					$addclass=array(
						's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						'teacher_module'=>isset($post['teacher_module'])?$post['teacher_module']:'',
						'name'=>isset($post['name'])?$post['name']:'',
						'section'=>isset($post['section'])?$post['section']:'',
						'capacity'=>isset($post['capacity'])?$post['capacity']:'',
						'status'=>1,
						'create_at'=>date('Y-m-d H:i:s'),
						'update_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
					);
					//echo '<pre>';print_r($addstudent);exit;
					$save_class=$this->School_model->save_class($addclass);
				}
					
						if(count($save_class)>0){
							$this->session->set_flashdata('success','Class added successfully');
							redirect('school/class_lists/'.base64_encode(1));
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('school/class_lists/'.base64_encode(0));
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
   public  function classstatus(){
		
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$c_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($c_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->School_model->update_school_class_details($c_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Class successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Class successfully Activate.");
								}
								redirect('school/class_lists/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school/class_lists/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('school/class_lists/'.base64_encode(1));
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
	public function classdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			if($admindetails['role_id']=1){
					$c_id=base64_decode($this->uri->segment(3));
					if($c_id!=''){
							$statusdata= $this->School_model->delete_class($c_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Class successfully Deleted.");
								redirect('school/class_lists/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school/class_lists/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('school/class_lists/'.base64_encode(1));
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
	
	/* school class Details*/
	public function class_teachers()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=2){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$data['tab']=base64_decode($this->uri->segment(3));
				$assign_class_teacher_id=base64_decode($this->uri->segment(4));
				if($assign_class_teacher_id!=''){
					$data['details']=$this->School_model->get_assign_class_teacher($assign_class_teacher_id);
				}else{
					$data['details']=array();
				}
				$data['class_list']=$this->School_model->get_all_class_list($detail['s_id']);
				$data['teachers_list']=$this->School_model->get_all_class_teachers_list($detail['s_id']);
				$data['assign_teachers_list']=$this->School_model->get_all_class_teachers_assign_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('school/class_teachers',$data);
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
	
	public function addclass_teacherpost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=2){
				$post=$this->input->post();
				
				//echo '<pre>';print_r($post);exit;
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				
				if(isset($post['a_c_t_id']) && $post['a_c_t_id']!=''){
					$class_teacher_details=$this->School_model->get_assign_class_teacher($post['a_c_t_id']);
					if($class_teacher_details['class_id'] !=$post['class_id'] || $class_teacher_details['teacher_id'] !=$post['teacher_id']){
						$check=$this->School_model->check_teacher_name_exits($detail['s_id'],$post['class_id'],$post['teacher_id']);
						if(count($check)>0){
							$this->session->set_flashdata('error',"The Name already exists. Please try again");
							redirect('school/class_teachers/'.base64_encode(0));
						}
					}
					$class_teacher=array(
						'class_id'=>isset($post['class_id'])?$post['class_id']:'',
						'teacher_id'=>isset($post['teacher_id'])?$post['teacher_id']:'',
						'update_at'=>date('Y-m-d H:i:s'),
						);
						$updatedata= $this->School_model->update_class_teacher_details($post['a_c_t_id'],$class_teacher);
						if(count($updatedata)>0){
								$this->session->set_flashdata('success',"Teacher Name successfully assigned");
								redirect('school/class_teachers/'.base64_encode(1));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/class_teachers/'.base64_encode(0));
							}
					
				}else{
							$check=$this->School_model->check_teacher_name_exits($detail['s_id'],$post['class_id'],$post['teacher_id']);
						if(count($check)>0){
							$this->session->set_flashdata('error',"The Name already exists. Please try again.");
							redirect('school/class_teachers/'.base64_encode(0));
						}
						$class_teacher=array(
						's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						'class_id'=>isset($post['class_id'])?$post['class_id']:'',
						'teacher_id'=>isset($post['teacher_id'])?$post['teacher_id']:'',
						'status'=>1,
						'create_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
						);
						$addclass_teacher=$this->School_model->save_class_teacher($class_teacher);
						if(count($addclass_teacher)>0){
								$this->session->set_flashdata('success',"Teacher Name successfully assigned");
								redirect('school/class_teachers/'.base64_encode(1));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/class_teachers/'.base64_encode(0));
							}
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
	 public  function classsteachertatus(){
		
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=3){
					$c_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($c_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->School_model->update_class_teacher_details($c_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Class teacher successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Class teacher successfully Activate.");
								}
								redirect('school/class_teachers/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school/class_teachers/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('school/class_teachers/'.base64_encode(1));
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
	public function classteacherdelete()
	{
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=3){
					$c_id=base64_decode($this->uri->segment(3));
					if($c_id!=''){
							$statusdata= $this->School_model->delete_class_teacher($c_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Class teacher successfully Deleted.");
								redirect('school/class_teachers/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school/class_teachers/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('school/class_teachers/'.base64_encode(1));
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
	/* school class Details*/
	/* class times*/
	public function class_times()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=2){
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				$data['tab']=base64_decode($this->uri->segment(3));
				$time_id=base64_decode($this->uri->segment(4));
				if($time_id!=''){
					$data['details']=$this->School_model->get_time_details($time_id);
				}else{
					$data['details']=array();
				}
				$data['class_list']=$this->School_model->get_all_class_list($detail['s_id']);
				$data['teachers_list']=$this->School_model->get_all_class_teachers_list($detail['s_id']);
				$data['time_list']=$this->School_model->get_all_time_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;
				$this->load->view('school/class_times',$data);
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
	
	public function addclass_timepost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=3){
				$post=$this->input->post();
				
				//echo '<pre>';print_r($post);exit;
				$detail=$this->School_model->get_resources_details($login_details['u_id']);
				
				if(isset($post['time_id']) && $post['time_id']!=''){
					$times=$this->School_model->get_time_details($post['time_id']);
					if($times['form_time'] !=$post['form_time'] || $times['to_time'] !=$post['to_time']){
						$check=$this->School_model->check_time_exits($detail['s_id'],$post['form_time'],$post['to_time']);
						if(count($check)>0){
							$this->session->set_flashdata('error',"Time already exists. Please try again");
							redirect('school/class-times/'.base64_encode(0).'/'.base64_encode($post['time_id']));
						}
					}
					$class_time=array(
						'form_time'=>isset($post['form_time'])?$post['form_time']:'',
						'to_time'=>isset($post['to_time'])?$post['to_time']:'',
						'update_at'=>date('Y-m-d H:i:s'),
						);
						$updatedata= $this->School_model->update_timing_details($post['time_id'],$class_time);
						if(count($updatedata)>0){
								$this->session->set_flashdata('success',"Time successfully Updated.");
								redirect('school/class-times/'.base64_encode(1));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/class-times/'.base64_encode(0).'/'.base64_encode($post['time_id']));
							}
					
				}else{
						$check=$this->School_model->check_time_exits($detail['s_id'],$post['form_time'],$post['to_time']);
						
						//echo $this->db->last_query();exit;
						if(($check)>0){
							$this->session->set_flashdata('error',"Time already exists. Please try again.");
							redirect('school/class-times/'.base64_encode(0));
						}
						$class_time=array(
						's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						'form_time'=>isset($post['form_time'])?$post['form_time']:'',
						'to_time'=>isset($post['to_time'])?$post['to_time']:'',
						'status'=>1,
						'create_at'=>date('Y-m-d H:i:s'),
						'create_by'=>$login_details['u_id'],
						);
						$addtime=$this->School_model->save_time($class_time);
						if(count($addtime)>0){
								$this->session->set_flashdata('success',"Time successfully added.");
								redirect('school/class-times/'.base64_encode(1));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('school/class-times/'.base64_encode(0));
							}
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
	 public  function classs_timetatus(){
		
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=3){
					$c_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($c_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'update_at'=>date('Y-m-d H:i:s')
							);
							$statusdata= $this->School_model->update_timing_details($c_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Time successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Time successfully Activate.");
								}
								redirect('school/class-times/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school/class-times/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('school/class-times/'.base64_encode(1));
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
	public function classtimedelete()
	{
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']=3){
					$c_id=base64_decode($this->uri->segment(3));
					if($c_id!=''){
							$statusdata= $this->School_model->delete_class_time($c_id);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Time successfully Deleted.");
								redirect('school/class-times/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('school/class-times/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('school/class-times/'.base64_encode(1));
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
	/* class times*/
	
	
	
	
	
}
