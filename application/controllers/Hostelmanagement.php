<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Hostelmanagement extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Hostelmanagement_model');
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$this->load->view('hostel/index');
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
	
	public function hosteltype()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
			$data['hostel_type']=$this->Hostelmanagement_model->get_hostel_type_list_details($detail['s_id']);		
					//echo'<pre>';print_r($data);exit;
					
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('hostel/hostel_type',$data);
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
	
	public function addhosteltype()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
				//echo'<pre>';print_r($login_details);exit;
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'hostel_type'=>isset($post['hostel_type'])?$post['hostel_type']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updatetime'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
					);
				//echo'<pre>';print_r($save_data);exit;
				$save=$this->Hostelmanagement_model->save_hostel_type_details($save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"hostel type details are successfully added");	
					redirect('hostelmanagement/hosteltype/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('hostelmanagement/hosteltype');
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
	public function hostetypeledit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);
		$data['hostel_type_list']=$this->Hostelmanagement_model->edit_hostel_type_details_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
		//echo'<pre>';print_r($data);exit;
					$this->load->view('hostel/edit_hostel_type',$data);
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function edithosteltype()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
				//echo'<pre>';print_r($login_details);exit;
				
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$save_data=array(
				'hostel_type'=>isset($post['hostel_type'])?$post['hostel_type']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updatetime'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
					);
					//echo'<pre>';print_r($save_data);exit;
				$save=$this->Hostelmanagement_model->update_hostel_type_details($post['h_t_id'],$save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"hostel type details are successfully updated");	
					redirect('hostelmanagement/hosteltype/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('hostelmanagement/hosteltype');
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
	public function hostaltypestatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$h_t_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
								if($status==1){
								 $stain=0;
								 }else{
									 $stain=1;
								 }
							if($h_t_id!=''){
								$staindata=array(
										'status'=> $stain,
										'updatetime'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Hostelmanagement_model->update_hostel_type_details($h_t_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if($status==1){
								$this->session->set_flashdata('success',"Hostel Type Details successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Hostel Type Details successfully Activate.");
								}
							redirect('hostelmanagement/hosteltype/'.base64_encode(1));			  					  
	                        }else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('hostelmanagement/hosteltype/'.base64_encode(1));
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
	
	public function hostaltypedelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$h_t_id=base64_decode ($this->uri->segment(3));
						 $delete_details =$this->Hostelmanagement_model->delete_hostel_type_details_data($h_t_id);
						 //echo'<pre>';print_r($delete_details);exit;  			
							$this->session->set_flashdata('success',"delete successfully ");		 
							redirect('hostelmanagement/hosteltype/'.base64_encode(1));			  					  
	                        }else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

			            redirect('hostelmanagement/hosteltype/'.base64_encode(1));
				         } 
		              }else{
			          $this->session->set_flashdata('error',"you don't have permission to access");
			          redirect('home');
		    }
	
	}
	public function hostelfloor()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
			$data['hostel_floors']=$this->Hostelmanagement_model->get_hostel_floors_list_details($detail['s_id']);		
					//echo'<pre>';print_r($data);exit;
					
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('hostel/hostel_floors',$data);
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
	
	public function addhostelfloors()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
				//echo'<pre>';print_r($login_details);exit;
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'floor_name'=>isset($post['floor_name'])?$post['floor_name']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
					);
				//echo'<pre>';print_r($save_data);exit;
				$save=$this->Hostelmanagement_model->save_hostel_floor_details($save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"hostel floors details are successfully added");	
					redirect('hostelmanagement/hostelfloor/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('hostelmanagement/hostelfloor/');
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
	public function hostelfloorsedit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);
		$data['hostel_floors_list']=$this->Hostelmanagement_model->edit_hostel_floors_details_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
		//echo'<pre>';print_r($data);exit;
					$this->load->view('hostel/edit_hostel_floors',$data);
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function edithostelfloors()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
				//echo'<pre>';print_r($login_details);exit;
				
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$update_data=array(
				'floor_name'=>isset($post['floor_name'])?$post['floor_name']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''	
					);
					//echo'<pre>';print_r($save_data);exit;
				$save=$this->Hostelmanagement_model->update_hostel_floors_details($post['f_id'],$update_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"hostel type details are successfully updated");	
					redirect('hostelmanagement/hostelfloor/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('hostelmanagement/hostelfloor/',$post['f_id']);
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
	public function hostelfloorsstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$f_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
								if($status==1){
								 $stain=0;
								 }else{
									 $stain=1;
								 }
							if($f_id!=''){
								$staindata=array(
										'status'=> $stain,
										'updated_at'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Hostelmanagement_model->update_hostel_floors_details($f_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if($status==1){
								$this->session->set_flashdata('success',"Hostel floors Details successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Hostel floors Details successfully Activate.");
								}
							redirect('hostelmanagement/hostelfloor/'.base64_encode(1));			  					  
	                        }else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('hostelmanagement/hostelfloor/'.base64_encode(1));
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
	public function hostelfloorsdelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$f_id=base64_decode ($this->uri->segment(3));
						 $delete_details =$this->Hostelmanagement_model->delete_hostel_floors_details_data($f_id);
						 //echo'<pre>';print_r($delete_details);exit;  			
							$this->session->set_flashdata('success',"delete successfully ");		 
							redirect('hostelmanagement/hostelfloor/'.base64_encode(1));			  					  
	                        }else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

			            redirect('hostelmanagement/hostelfloor/'.base64_encode(1));
				         } 
		              }else{
			          $this->session->set_flashdata('error',"you don't have permission to access");
			          redirect('home');
		    }
	
	}
	
	public function hosteldetails()
	{	
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					
					//echo'<pre>';print_r($login_details);exit;
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$data['hostel_details']=$this->Hostelmanagement_model->hostel_details_list($detail['s_id']);	
				//echo'<pre>';print_r($data);exit;
					//echo'<pre>';print_r($data['hostel_details']);exit;
			$data['hostel_types']=$this->Hostelmanagement_model->hostel_type_details_list_show($detail['s_id']);		
					//echo'<pre>';print_r($data['hostel_types']);exit;
					
					
					
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('hostel/hostel-details',$data);
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
	public function add_hosteldetails()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'hostel_name'=>isset($post['hostel_name'])?$post['hostel_name']:'',
				'hostel_type'=>isset($post['hostel_type'])?$post['hostel_type']:'',
				'warden_name'=>isset($post['warden_name'])?$post['warden_name']:'',
				'contact_number'=>isset($post['contact_number'])?$post['contact_number']:'',
				'address'=>isset($post['address'])?$post['address']:'',
				'facilities'=>isset($post['facilities'])?$post['facilities']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
					//echo'<pre>';print_r($save_data);exit;
					$save=$this->Hostelmanagement_model->save_hostel_details($save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"hostel details are successfully added");	
					redirect('Hostelmanagement/hosteldetails/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('Hostelmanagement/hosteldetails',$post['h_t_id']);
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
	public function hosteldetailsedit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['hostel_details']=$this->Hostelmanagement_model->edit_hostel_details_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
					//echo'<pre>';print_r($data);exit;
					$data['hostel_types']=$this->Hostelmanagement_model->hostel_type_details_list_show($detail['s_id']);		
					
				//echo'<pre>';print_r($data['']);exit;
					
					//echo'<pre>';print_r($data);exit;
					$this->load->view('hostel/edit_hostel-details',$data);
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	public function edit_hostel()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$update_data=array(
				'hostel_name'=>isset($post['hostel_name'])?$post['hostel_name']:'',
				'hostel_type'=>isset($post['hostel_type'])?$post['hostel_type']:'',
				'warden_name'=>isset($post['warden_name'])?$post['warden_name']:'',
				'contact_number'=>isset($post['contact_number'])?$post['contact_number']:'',
				'address'=>isset($post['address'])?$post['address']:'',
				'facilities'=>isset($post['facilities'])?$post['facilities']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
					//echo'<pre>';print_r($update_data);exit;
					$update=$this->Hostelmanagement_model->update_hostel_details($post['id'],$update_data);	
					//echo'<pre>';print_r($update);exit;
					if(count($update)>0){
					$this->session->set_flashdata('success',"hostel details are successfully updated");	
					redirect('Hostelmanagement/hosteldetails/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('Hostelmanagement/hosteldetails/',$post['id']);
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
	
	public function hostalstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
				//echo'<pre>';print_r($login_details);exit;  
				$id=base64_decode ($this->uri->segment(3));
	            $status=base64_decode ($this->uri->segment(4));
					if($status==1){
	                 $stain=0;
					 }else{
						 $stain=1;
					 }
				if($id!=''){
					$staindata=array(
							'status'=> $stain,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Hostelmanagement_model->update_hostel_details_satus($id,$staindata);
						 //echo'<pre>';print_r($statusdetails );exit;  
					      if(count($statusdetails)>0){
							 if($status==1){
								$this->session->set_flashdata('success',"  hostel details successfully deactivate.");
								}else{
									$this->session->set_flashdata('success',"  hostel details  successfully activate.");
								}
							
							redirect('Hostelmanagement/hosteldetails/'.base64_encode(1));			  					  
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('Hostelmanagement/hosteldetails/'.base64_encode(1));	
						}						
					   }else{
						 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('Hostelmanagement/hosteldetails/'.base64_encode($id));
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
	public function hostaldelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$id=base64_decode ($this->uri->segment(3));
						 $delete_details =$this->Hostelmanagement_model->delete_hostel_details_data($id);
						 //echo'<pre>';print_r($delete_details);exit;  			
							$this->session->set_flashdata('success',"delete successfully ");		 
							redirect('Hostelmanagement/hosteldetails/'.base64_encode(1));			  					  
	                        }else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

			            redirect('Hostelmanagement/hosteldetails/'.base64_encode(1));
				         } 
		              }else{
			          $this->session->set_flashdata('error',"you don't have permission to access");
			          redirect('home');
		    }
	
	}
		
	
	public function addroomdetails()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
							//echo'<pre>';print_r($post);exit;
							 $room_data=array(
								's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
								'hotel_type'=>isset($post['hotel_type'])?$post['hotel_type']:'',
								'room_name'=>isset($post['room_name'])?$post['room_name']:'',
								'floor_id'=>isset($post['floor_number'])?$post['floor_number']:'',
								'total_beds'=>isset($post['total_beds'])?$post['total_beds']:'',
								'status'=>1,
								'created_at'=>date('Y-m-d H:i:s'),
								'updated_at'=>date('Y-m-d H:i:s'),
								'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
							 );
					//echo'<pre>';print_r($room_data);exit;
					$save=$this->Hostelmanagement_model->save_room_details($room_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"room details are successfully added");	
					redirect('hostelmanagement/roomdetails/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hostelmanagement/roomdetails/');
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
	
	public function allocateroom()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$data['tab']=base64_decode($this->uri->segment(3));
					$data['hostel_list']=$this->Hostelmanagement_model->hostel_type_list($detail['s_id']);	
					$data['hostel_room_name']=$this->Hostelmanagement_model->hostel_room_name($detail['s_id']);
					//echo '<pre>';print_r($data['hostel_room_name']);exit;
					
					$data['floor_list']=$this->Hostelmanagement_model->get_hostel_floor_list($detail['s_id']);	
					$data['room_number_list']=$this->Hostelmanagement_model->get_room_number_list($detail['s_id']);
					//echo '<pre>';print_r($data);exit;
					$data['hostel_floors_list']=$this->Hostelmanagement_model->get_hostel_floors_list($detail['s_id']);	
					$data['allocaterrom_list']=$this->Hostelmanagement_model->get_allocaterrom_list($detail['s_id']);
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					$data['room_list']=$this->Hostelmanagement_model->get_rom_list($detail['s_id']);
					
                   //echo '<pre>';print_r($data);exit;	
					$this->load->view('hostel/allocate-room',$data);
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
	
	public function roomdetails()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$data['tab']=base64_decode($this->uri->segment(3));
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$data['hostel_list']=$this->Hostelmanagement_model->hostel_type_list($detail['s_id']);	
					//echo'<pre>';print_r($data['hostel_list']);exit;
					
					$data['hostel_floors_list']=$this->Hostelmanagement_model->get_hostel_floors_list($detail['s_id']);	
					//echo'<pre>';print_r($data['hostel_floors_list']);exit;
					$data['room_list']=$this->Hostelmanagement_model->get_hostel_rooms_list($detail['s_id']);	
					//echo'<pre>';print_r($data);exit;
					
					$this->load->view('hostel/room-details',$data);
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
	public function roomdetails_edit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$r_id=base64_decode($this->uri->segment(3));
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$data['hostel_list']=$this->Hostelmanagement_model->hostel_type_list($detail['s_id']);
					//echo'<pre>';print_r($data['hostel_list']);exit;
					$data['hostel_floors_list']=$this->Hostelmanagement_model->get_hostel_floors_list($detail['s_id']);	
					//echo'<pre>';print_r($data['hostel_floors_list']);exit;
					$data['room_details']=$this->Hostelmanagement_model->get_room_details($r_id);	
					//echo'<pre>';print_r($data['room_details']);exit;
					
					$this->load->view('hostel/room-details-edit',$data);
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
	public function editroomdetails()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					
					$room_details=$this->Hostelmanagement_model->get_room_details($post['h_r_id']);	
					if($room_details['room_name']!=$post['room_name'] || $room_details['total_beds']!=$post['total_beds'] || $room_details['floor_id']!=$post['floor_number']){
					$check=$this->Hostelmanagement_model->check_room_Details_exsists($post['room_name'],$post['total_beds'],$post['floor_number']);
						if(count($check)>0){
						$this->session->set_flashdata('error',"Room details already exists. Please try again.");
						redirect('hostelmanagement/roomdetails_edit/'.base64_encode($post['h_r_id']));
						}	
					}
						//echo'<pre>';print_r($post);
							 $update_room_data=array(
								'hotel_type'=>isset($post['hotel_type'])?$post['hotel_type']:'',
								'room_name'=>isset($post['room_name'])?$post['room_name']:'',
								'floor_id'=>isset($post['floor_number'])?$post['floor_number']:'',
								'total_beds'=>isset($post['total_beds'])?$post['total_beds']:'',
								'updated_at'=>date('Y-m-d H:i:s'),
							 );
					//echo'<pre>';print_r($update_room_data);exit;
					$update_details =$this->Hostelmanagement_model->hostel_room_update_details_data($post['h_r_id'],$update_room_data);
					//echo'<pre>';print_r($save);exit;
					if(count($update_details)>0){
					$this->session->set_flashdata('success',"Room details are successfully updated");	
					redirect('hostelmanagement/roomdetails/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hostelmanagement/roomdetails_edit/'.base64_encode($post['h_r_id']));
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
	
	 public function roomstatus(){
	   if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==11){
				//echo'<pre>';print_r($login_details);exit;
	                $h_r_id= $this->uri->segment(3);
	                $status=$this->uri->segment(4);
	                 if($status==1){
	                 $stain=0;
					 }else{
						 $stain=1;
					 }
				if($h_r_id!=''){
					$staindata=array(
							'status'=> $stain,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							 //echo'<pre>';print_r($staindata);exit;  
			$statusdetails =$this->Hostelmanagement_model->status_room_details_data($h_r_id,$staindata);
						 //echo'<pre>';print_r($statusdetails);exit;  
					     if(count($statusdetails)>0){
							 if($status==1){
								$this->session->set_flashdata('success',"   Room  successfully deactivate.");
								}else{
									$this->session->set_flashdata('success'," Room  successfully activate.");
								}
							
							redirect('hostelmanagement/roomdetails/'.base64_encode(1));			  					  
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('hostelmanagement/roomdetails/'.base64_encode(1));	
						}						
					   }else{
						 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hostelmanagement/roomdetails/'.base64_encode($h_r_id));
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
	public function roomdelete(){
	
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==11){
				 //echo'<pre>';print_r($login_details);exit;
			  $h_r_id= $this->uri->segment(3);
		 //echo'<pre>';print_r($h_r_id);exit;
                       $delete_details =$this->Hostelmanagement_model->hostel_room_deleted_details_data($h_r_id);
						 //echo'<pre>';print_r($delete_details);exit;  
					     					 
										$this->session->set_flashdata('sucess',"delete sucessfully");
									  redirect('hostelmanagement/roomdetails/'.base64_encode(1));
									  
		             }else{
						 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hostelmanagement/roomdetails/'.base64_encode($h_r_id));
					   }		   
								
				
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	
	}
	
	public function get_allocate_room_number_list(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$post=$this->input->post();
					
					$floors=$this->Hostelmanagement_model->get_allocate_room_number_list($post['floor_name']);
					//echo $this->db->last_query();exit;
					
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
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	
	public function get_romm_wise_bed_list(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$post=$this->input->post('room_numebr');
					$floors=$this->Hostelmanagement_model->get_romm_wise_bed_list($post);
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
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function class_student_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$post=$this->input->post();
					$student_list=$this->Hostelmanagement_model->class_wise_student_list($post['class_id']);
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
	
	public  function allottedpost(){
	if($this->session->userdata('userdetails'))
			{
				$login_details=$this->session->userdata('userdetails');
					if($login_details['role_id']==11){
						$post=$this->input->post();
						
						//echo '<pre>';print_r($post);exit;
						$detail=$this->Student_model->get_resources_details($login_details['u_id']);
						$check=$this->Hostelmanagement_model->check_allocateroom_data_exsists($post['student_name'],$post['email'],$post['g_contact_number'],$post['allot_bed'],$post['floor_name'],$post['room_numebr']);
						//echo '<pre>';print_r($check);exit;
						if(count($check)>0){
							$this->session->set_flashdata('error'," Room already allocated. Please try again.");
							redirect('hostelmanagement/allocateroom/');
						}
							//echo'<pre>';print_r($post);exit;
							 $allocateroom_data=array(
								's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
								'registration_type'=>isset($post['registration_type'])?$post['registration_type']:'',
								'staff_name'=>isset($post['staff_name'])?$post['staff_name']:'',
								'hostel_type'=>isset($post['hostel_type'])?$post['hostel_type']:'',
								'floor_name'=>isset($post['floor_name'])?$post['floor_name']:'',
								'room_numebr'=>isset($post['room_numebr'])?$post['room_numebr']:'',
								'student_name'=>isset($post['student_name'])?$post['student_name']:'',
								'class_id'=>isset($post['class_id'])?$post['class_id']:'',
								'gender'=>isset($post['gender'])?$post['gender']:'',
								'contact_number'=>isset($post['contact_number'])?$post['contact_number']:'',
								'dob'=>isset($post['dob'])?$post['dob']:'',
								'joining_date'=>isset($post['joining_date'])?$post['joining_date']:'',
								'till_date'=>isset($post['till_date'])?$post['till_date']:'',
								'allot_bed'=>isset($post['allot_bed'])?$post['allot_bed']:'',
								'charge_per_month'=>isset($post['charge_per_month'])?$post['charge_per_month']:'',
								'no_of_months'=>isset($post['no_of_months'])?$post['no_of_months']:'',
								'paid_amount'=>isset($post['paid_amount'])?$post['paid_amount']:'',
								'guardian_name'=>isset($post['guardian_name'])?$post['guardian_name']:'',
								'g_contact_number'=>isset($post['g_contact_number'])?$post['g_contact_number']:'',
								'relation'=>isset($post['relation'])?$post['relation']:'',
								'email'=>isset($post['email'])?$post['email']:'',
								'address'=>isset($post['address'])?$post['address']:'',
								'status'=>1,
								'created_at'=>date('Y-m-d H:i:s'),
								'updated_at'=>date('Y-m-d H:i:s'),
								'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
							 );
					//echo'<pre>';print_r($room_data);exit;
					$save=$this->Hostelmanagement_model->save_allocateroom_data_details($allocateroom_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success'," Room  successfully allocated");	
					redirect('hostelmanagement/allocateroom/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hostelmanagement/allocateroom/');
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
	public function allocateroom_edit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo '<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$a_r_id=base64_decode($this->uri->segment(3));
					$data['hostel_list']=$this->Hostelmanagement_model->hostel_type_list($detail['s_id']);	
					//echo '<pre>';print_r($data['hostel_list']);exit;
					$data['hostel_room_name']=$this->Hostelmanagement_model->hostel_room_name($detail['s_id']);
					//echo '<pre>';print_r($data['hostel_room_name']);exit;
					//echo'<pre>';print_r($data);exit;	
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					$data['floor_list']=$this->Hostelmanagement_model->get_hostel_floor_list($detail['s_id']);
					//echo '<pre>';print_r($data['floor_list']);exit;
					$data['room_number_list']=$this->Hostelmanagement_model->get_room_number_list($detail['s_id']);
					//echo '<pre>';print_r($data['room_number_list']);exit;
					$data['hostel_floors_list']=$this->Hostelmanagement_model->get_hostel_floors_list($detail['s_id']);	
					$data['allocaterrom_list']=$this->Hostelmanagement_model->get_allocaterrom_list($detail['s_id']);
					//echo '<pre>';print_r($data['allocaterrom_list']);exit;	
					$data['allocaterrom_details']=$this->Hostelmanagement_model->get_allocaterrom_details_list($detail['s_id'],base64_decode($this->uri->segment(3)));
					$data['student_name']=$this->Hostelmanagement_model->get_class_wise_student_list($data['allocaterrom_details']['class_id']);	
                    $data['bed_details']=$this->Hostelmanagement_model->get_allocated_bed_list($data['allocaterrom_details']['room_numebr']);
					//echo '<pre>';print_r($data);exit;		
					$this->load->view('hostel/allocate-room-edit',$data);
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
	
	public  function editallottedpost(){
	if($this->session->userdata('userdetails'))
			{
				$login_details=$this->session->userdata('userdetails');
					if($login_details['role_id']==11){
						//echo '<pre>';print_r($login_details);exit;
						$post=$this->input->post();
						$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$allocaterrom_details=$this->Hostelmanagement_model->get_allocaterrom_details_list($detail['s_id'],$post['a_r_id']);
					//echo'<pre>';print_r($allocaterrom_details);exit;

					if($allocaterrom_details['student_name']!=$post['student_name'] || $allocaterrom_details['email']!=$post['email'] || $allocaterrom_details['g_contact_number']!=$post['g_contact_number']|| $allocaterrom_details['allot_bed']!=$post['allot_bed']|| $allocaterrom_details['floor_name']!=$post['floor_name']|| $allocaterrom_details['room_numebr']!=$post['room_numebr']){
						$check=$this->Hostelmanagement_model->check_allocateroom_data_exsists($post['student_name'],$post['email'],$post['g_contact_number'],$post['allot_bed'],$post['floor_name'],$post['room_numebr']);
						if(count($check)>0){
						$this->session->set_flashdata('error'," Room already allocated. Please try again.");
						redirect('hostelmanagement/allocateroom_edit/'.base64_encode($post['a_r_id']));
						}	
					}		
							 $allocateroom_data=array(
								'registration_type'=>isset($post['registration_type'])?$post['registration_type']:'',
								'staff_name'=>isset($post['staff_name'])?$post['staff_name']:'',
								'hostel_type'=>isset($post['hostel_type'])?$post['hostel_type']:'',
								'floor_name'=>isset($post['floor_name'])?$post['floor_name']:'',
								'room_numebr'=>isset($post['room_numebr'])?$post['room_numebr']:'',
								'student_name'=>isset($post['student_name'])?$post['student_name']:'',
								'class_id'=>isset($post['class_id'])?$post['class_id']:'',
								'gender'=>isset($post['gender'])?$post['gender']:'',
								'contact_number'=>isset($post['contact_number'])?$post['contact_number']:'',
								'dob'=>isset($post['dob'])?$post['dob']:'',
								'joining_date'=>isset($post['joining_date'])?$post['joining_date']:'',
								'till_date'=>isset($post['till_date'])?$post['till_date']:'',
								'allot_bed'=>isset($post['allot_bed'])?$post['allot_bed']:'',
								'charge_per_month'=>isset($post['charge_per_month'])?$post['charge_per_month']:'',
								'no_of_months'=>isset($post['no_of_months'])?$post['no_of_months']:'',
								'paid_amount'=>isset($post['paid_amount'])?$post['paid_amount']:'',
								'guardian_name'=>isset($post['guardian_name'])?$post['guardian_name']:'',
								'g_contact_number'=>isset($post['g_contact_number'])?$post['g_contact_number']:'',
								'relation'=>isset($post['relation'])?$post['relation']:'',
								'email'=>isset($post['email'])?$post['email']:'',
								'address'=>isset($post['address'])?$post['address']:'',
								'status'=>1,
								'created_at'=>date('Y-m-d H:i:s'),
								'updated_at'=>date('Y-m-d H:i:s'),
								'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
							 );
					//echo'<pre>';print_r($allocateroom_data);exit;
					$update=$this->Hostelmanagement_model->update_allocateroom_details($post['a_r_id'],$allocateroom_data);	
					//echo'<pre>';print_r($update);exit;
					if(count($update)>0){
					$this->session->set_flashdata('success'," Room  successfully allocated updated");	
					redirect('hostelmanagement/allocateroom/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hostelmanagement/allocateroom/'.$post['a_r_id']);
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
	
public function allocateroomstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;  
				$a_r_id=base64_decode ($this->uri->segment(3));
	            $status=base64_decode ($this->uri->segment(4));
					if($status==1){
	                 $stain=0;
					 }else{
						 $stain=1;
					 }
				if($a_r_id!=''){
					$staindata=array(
							'status'=> $stain,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Hostelmanagement_model->update_allocateroom_details($a_r_id,$staindata);
						 //echo'<pre>';print_r($statusdetails );exit;  
					      if(count($statusdetails)>0){
							 if($status==1){
								$this->session->set_flashdata('success',"  Allocate Room  successfully deactivate.");
								}else{
									$this->session->set_flashdata('success',"  Allocate Room  successfully activate.");
								}
							
							redirect('hostelmanagement/allocateroom/'.base64_encode(1));			  					  
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('hostelmanagement/allocateroom/'.base64_encode(1));	
						}						
					   }else{
						 $this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('hostelmanagement/allocateroom/'.base64_encode($a_r_id));
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
	public function allocateroomdelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
				$a_r_id=base64_decode ($this->uri->segment(3));	 
						$deletedetails =$this->Hostelmanagement_model->delete_allocateroom_details($a_r_id);
						 //echo'<pre>';print_r($deletedetails );exit;  
					      if(count($deletedetails)>0){
							 $this->session->set_flashdata('success',"  Allocate Room  successfully Deleted.");
								
							redirect('hostelmanagement/allocateroom/'.base64_encode(1));			  					  
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('hostelmanagement/allocateroom/'.base64_encode(1));	
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
	
public function feedetails()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	

					$data['fee_list']=$this->Hostelmanagement_model->get_fee_list($detail['s_id']);
					//echo'<pre>';print_r($data);exit;

					$this->load->view('hostel/fee-details',$data);
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

      public function get_floor_number_list(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$post=$this->input->post();
					
					$route_stops=$this->Hostelmanagement_model->get_floor_number_list($post['hostel_type']);
					//echo'<pre>';print_r($route_list);exit;
					if(count($route_stops)>0){
						$data['msg']=1;
						$data['list']=$route_stops;
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
    
    public function visitorpassinfo()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
			$data['visitor_pass_info']=$this->Hostelmanagement_model->get_visitor_pass_info_details($detail['s_id']);		
					//echo'<pre>';print_r($data);exit;
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('hostel/visitor_pass_info',$data);
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
	
	public function visitorpassinfopost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			 $detail=$this->Student_model->get_resources_details($login_details['u_id']);
	     $post=$this->input->post();	
		      //echo'<pre>';print_r($post);exit;
			 
		       $save_data=array(
	            's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
	            'visitor_type'=>isset($post['visitor_type'])?$post['visitor_type']:'',
	            'visitor_name'=>isset($post['visitor_name'])?$post['visitor_name']:'',
	            'location'=>isset($post['location'])?$post['location']:'',
	            'contact_number'=>isset($post['contact_number'])?$post['contact_number']:'',
	            'email'=>isset($post['email'])?$post['email']:'',
	            'visit_time'=>isset($post['visit_time'])?$post['visit_time']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				 //echo'<pre>';print_r($save_data);exit;
		        $save=$this->Hostelmanagement_model->save_visitor_pass_details($save_data);	
				//echo'<pre>';print_r($save);exit;
		       if(count($save)>0){
					$this->session->set_flashdata('success',"Visitor Pass & Info details successfully added");	
					redirect('hostelmanagement/visitorpassinfo/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"technical problem occurred. please try again once");
						redirect('hostelmanagement/visitorpassinfo/');	
					}  
		
				}else{
				$this->session->set_flashdata('error',"you don't have permission to access");
				redirect('admin');
			}
	}
	
	public function visitorpassinfoedit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);
		$data['edit_visitor_pass_info']=$this->Hostelmanagement_model->edit_visitor_pass_info_details_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
		//echo'<pre>';print_r($data);exit;
					$this->load->view('hostel/edit_visitor_pass_info',$data);
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}

	public function visitorpassinfoeditpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
				//echo'<pre>';print_r($login_details);exit;
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$update_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
	            'visitor_type'=>isset($post['visitor_type'])?$post['visitor_type']:'',
	            'visitor_name'=>isset($post['visitor_name'])?$post['visitor_name']:'',
	            'location'=>isset($post['location'])?$post['location']:'',
	            'contact_number'=>isset($post['contact_number'])?$post['contact_number']:'',
	            'email'=>isset($post['email'])?$post['email']:'',
	            'visit_time'=>isset($post['visit_time'])?$post['visit_time']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
					);
					//echo'<pre>';print_r($update_data);exit;
				$update=$this->Hostelmanagement_model->update_visitor_pass_info_details($post['v_p_id'],$update_data);	
					//echo'<pre>';print_r($update);exit;
					if(count($update)>0){
					$this->session->set_flashdata('success',"Visitor Pass & Info details are successfully updated");	
					redirect('hostelmanagement/visitorpassinfo/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('hostelmanagement/visitorpassinfoedit/',$post['v_p_id']);
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
	
	public function visitorpassinfostatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$v_p_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
								if($status==1){
								 $stain=0;
								 }else{
									 $stain=1;
								 }
							if($v_p_id!=''){
								$staindata=array(
										'status'=> $stain,
										'updated_at'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Hostelmanagement_model->update_visitor_pass_info_details($v_p_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if($status==1){
								$this->session->set_flashdata('success',"Visitor Pass & Info Details successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Visitor Pass & Info Details successfully Activate.");
								}
							redirect('hostelmanagement/visitorpassinfo/'.base64_encode(1));		  					  
	                        }else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('hostelmanagement/visitorpassinfo/'.base64_encode(1));	
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
	
	public function visitorpassinfodelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$v_p_id=base64_decode ($this->uri->segment(3));
						 $delete_details =$this->Hostelmanagement_model->delete_visitor_pass_info_details($v_p_id);
						 //echo'<pre>';print_r($delete_details);exit;  			
							$this->session->set_flashdata('success'," Visitor Pass & Info delete successfully ");		 
							redirect('hostelmanagement/visitorpassinfo/'.base64_encode(1));			  					  
	                        }else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

			          redirect('hostelmanagement/visitorpassinfo/'.base64_encode(1));	
				         } 
		              }else{
			          $this->session->set_flashdata('error',"you don't have permission to access");
			          redirect('home');
		    }
	
	}
	
	public function gatepassinfo()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					$data['gate_pass_list']=$this->Hostelmanagement_model->get_gate_pass_list($detail['s_id']);
					
					//echo'<pre>';print_r($data);exit;
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('hostel/gate_pass_info',$data);
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
	
	public function alloted_class_wise_student_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					$id=$this->input->post('class_name');
					//echo $post;exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$student_list=$this->Hostelmanagement_model->allocate_class_wise_student_list($id);
					// echo $this->db->last_query();exit;
				  // echo'<pre>';print_r($student_list);exit;

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
	
	
	public function gatepassinfopost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			 $detail=$this->Student_model->get_resources_details($login_details['u_id']);
	     $post=$this->input->post();	
		      //echo'<pre>';print_r($post);exit;
			 
		       $save_data=array(
	            's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
	            'date'=>isset($post['date'])?$post['date']:'',
	            'gate_pass_number'=>isset($post['gate_pass_number'])?$post['gate_pass_number']:'',
	            'class_id'=>isset($post['class_id'])?$post['class_id']:'',
	            'student_name'=>isset($post['student_name'])?$post['student_name']:'',
	            'gate_pass_hours'=>isset($post['gate_pass_hours'])?$post['gate_pass_hours']:'',
	            'remarks'=>isset($post['remarks'])?$post['remarks']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				 //echo'<pre>';print_r($save_data);exit;
		        $save=$this->Hostelmanagement_model->save_gate_pass_details($save_data);	
				//echo'<pre>';print_r($save);exit;
		       if(count($save)>0){
					$this->session->set_flashdata('success',"Gate Pass & Info details successfully added");	
					redirect('hostelmanagement/gatepassinfo/'.base64_encode(1));		
					}else{
						$this->session->set_flashdata('error',"technical problem occurred. please try again once");
						redirect('hostelmanagement/gatepassinfo/');	
					}  
		
				}else{
				$this->session->set_flashdata('error',"you don't have permission to access");
				redirect('admin');
			}
	}
	
	public function gatepassinfoedit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
		$data['edit_gate_pass_info']=$this->Hostelmanagement_model->edit_gate_pass_info_details_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
		$data['student_name']=$this->Hostelmanagement_model->get_gate_pass_class_wise_student_list($data['edit_gate_pass_info']['class_id']);	
		//echo'<pre>';print_r($data['student_name']);exit;
					$this->load->view('hostel/edit_gate_pass_info',$data);
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	public function gatepassinfoeditpost()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
				//echo'<pre>';print_r($login_details);exit;
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();
					//echo'<pre>';print_r($post);exit;
					$update_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
	            'date'=>isset($post['date'])?$post['date']:'',
	            'gate_pass_number'=>isset($post['gate_pass_number'])?$post['gate_pass_number']:'',
	            'class_id'=>isset($post['class_id'])?$post['class_id']:'',
	            'student_name'=>isset($post['student_name'])?$post['student_name']:'',
	            'gate_pass_hours'=>isset($post['gate_pass_hours'])?$post['gate_pass_hours']:'',
	            'remarks'=>isset($post['remarks'])?$post['remarks']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
					);
					//echo'<pre>';print_r($update_data);exit;
				$update=$this->Hostelmanagement_model->update_gate_pass_info_details($post['g_p_id'],$update_data);	
					//echo'<pre>';print_r($update);exit;
					if(count($update)>0){
					$this->session->set_flashdata('success',"Gate Pass & Info details are successfully updated");	
					redirect('hostelmanagement/gatepassinfo/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('hostelmanagement/gatepassinfoedit/',$post['g_p_id']);
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
	
	public function gatepassinfostatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$g_p_id=base64_decode ($this->uri->segment(3));
							$status=base64_decode ($this->uri->segment(4));
								if($status==1){
								 $stain=0;
								 }else{
									 $stain=1;
								 }
							if($g_p_id!=''){
								$staindata=array(
										'status'=> $stain,
										'updated_at'=>date('Y-m-d H:i:s')
										);
										 //echo'<pre>';print_r($staindata );exit;  
						$statusdetails =$this->Hostelmanagement_model->update_gate_pass_info_details($g_p_id,$staindata);
									 //echo'<pre>';print_r($statusdetails );exit;  
									  if($status==1){
								$this->session->set_flashdata('success',"Gate Pass & Info Details successfully Deactivate.");
								}else{
									$this->session->set_flashdata('success',"Gate Pass & Info Details successfully Activate.");
								}
							redirect('hostelmanagement/gatepassinfo/'.base64_encode(1));		  					  
	                        }else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('hostelmanagement/gatepassinfo/'.base64_encode(1));	
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
	
	public function gatepassinfodelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==11){
					//echo'<pre>';print_r($login_details);exit;
					$g_p_id=base64_decode ($this->uri->segment(3));
						 $delete_details =$this->Hostelmanagement_model->delete_gate_pass_info_details($g_p_id);
						 //echo'<pre>';print_r($delete_details);exit;  			
							$this->session->set_flashdata('success'," Gate Pass & Info delete successfully ");		 
							redirect('hostelmanagement/gatepassinfo/'.base64_encode(1));			  					  
	                        }else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

			          redirect('hostelmanagement/gatepassinfo/'.base64_encode(1));	
				         } 
		              }else{
			          $this->session->set_flashdata('error',"you don't have permission to access");
			          redirect('home');
		    }
	
	}
	
	
	public  function prints(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				
		 
		$emp_id=base64_decode($this->uri->segment(3));
		$filename=$emp_id;
		$data['usersData']=$this->Hostelmanagement_model->get_visitor_details_print($emp_id);
		
					$path = rtrim(FCPATH,"/");
					$file_name = '22'.$emp_id.'12_11.pdf';                
					$data['page_title'] = $data['usersData']['visitor_name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/visitorpass/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('hostel/visitorpasspdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/visitorpass/".$file_name);
			}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
			}
	}
	
	public  function gatepassprint(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				
		 
		$emp_id=base64_decode($this->uri->segment(3));
		$filename=$emp_id;
		$data['gate_pass']=$this->Hostelmanagement_model->gate_pass_print_data($emp_id);
		//echo'<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = '22'.$emp_id.'12_11.pdf';                
					$data['page_title'] = $data['gate_pass']['gate_pass_number'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/gatepass/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('hostel/gatepasspdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/gatepass/".$file_name);
			}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
			}
	}
	
	
	
	
	
	
	
	/*
	public  function prints(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				
		 
		$emp_id=base64_decode($this->uri->segment(3));
		$filename=$emp_id;
		$usersData=$this->Hostelmanagement_model->get_visitor_details_print($emp_id);
		
		
		$filename = 'Visitor Pass'.date('Ymd').'.csv'; 
		//echo '<pre>';print_r($filename);exit;
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; "); 

		// get data
		//$usersData = $this->Main_model->getUserDetails();

		// file creation
		$file = fopen('php://output', 'w');

		$header = array("S. No","Visitor Type","Visitor Name","From Location","Contact Number","Email Address","Visitor Time"); 
		fputcsv($file, $header);

		foreach ($usersData as $key=>$line){
		 fputcsv($file,$line);
		}

		fclose($file);
		exit;
			}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
			}
	}
	*/
	
	
	
	
	
	
	
	
	
	
	
	
	
  }