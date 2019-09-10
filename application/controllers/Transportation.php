<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Transportation extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Transportation_model');
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					$this->load->view('transportation/index');
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
	
	public function addroutes()

	{	

		if($this->session->userdata('userdetails'))

		{

			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==5){

				$detail=$this->Student_model->get_resources_details($login_details['u_id']);

				$data['tab']=base64_decode($this->uri->segment(3));
				$data['roues_stops_list']=$this->Transportation_model->get_roues_stops_list($detail['s_id']);
				//echo '<pre>';print_r($data);exit;

				$this->load->view('transportation/add-routes-stops',$data);

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

	
	
	
	public function addroutepost()

	{	

		if($this->session->userdata('userdetails'))

		{

			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==5){

				$detail=$this->Student_model->get_resources_details($login_details['u_id']);

				$post=$this->input->post();
$check = $this->Transportation_model->get_saved_route_numbers($post['route_no'],$detail['s_id']);
					//echo $this->db->last_query();exit;
					//echo '<pre>';print_r(count($check));exit;
					if(count($check)>0){
						$this->session->set_flashdata('error',"Route Number already exists. Please use another name");
						redirect('transportation/addroutes/');
					}

			$save_data=array(

			's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
			'route_no'=>isset($post['route_no'])?$post['route_no']:'',
			'status'=>1,
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
			);
			$save=$this->Transportation_model->save_routes($save_data);
		//echo '<pre>';print_r($save);exit;
		if(count($save)>0){

			if(isset($post['route_stops']) && count($post['route_stops'])>0){

					$cnt=0;foreach($post['route_stops'] as $list){ 

						  $add_data=array(
						  's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						  'r_id'=>isset($save)?$save:'',
						  'stop_name'=>$list,
						  's_status'=>1,
						  'created_at'=>date('Y-m-d H:i:s'),
						  'updated_at'=>date('Y-m-d H:i:s'),
						  'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
						  );

						   //echo '<pre>';print_r($add_data);

						  $this->Transportation_model->save_stops($add_data);	



				       $cnt++;}

					}

					//exit;

					

					  $this->session->set_flashdata('success',"Route Number successfully added");	

							redirect('transportation/addroutes/'.base64_encode(1));	

				}else{

					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

					redirect('transportation/addroutes');

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
	public function editroutes()
	{	
		if($this->session->userdata('userdetails'))

		{

			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==5){

				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
			$data['edit_routes_stops']=$this->Transportation_model->edit_edit_routes_stops($detail['s_id'],base64_decode($this->uri->segment(3)));	
				//echo '<pre>';print_r($data);exit;
				$this->load->view('transportation/edit-routes-stops',$data);
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
public function editroutespost()

	{

	if($this->session->userdata('userdetails'))

		{	

		$login_details=$this->session->userdata('userdetails');

		if($login_details['role_id']==5){

		$detail=$this->Student_model->get_resources_details($login_details['u_id']);

        $post=$this->input->post();

		//echo '<pre>';print_r($post);exit;
$editdata_check= $this->Transportation_model->get_saved_route_numbers_details($post['r_id']);
					//echo '<pre>';print_r($editdata_check);exit;
					if($editdata_check['route_no']!=$post['route_no']){
					$checked= $this->Transportation_model->get_saved_route_numbers($post['route_no'],$detail['s_id']);
					//echo $this->db->last_query();exit;
					if(count($checked)>0){
						$this->session->set_flashdata('error',"Route Number already exists. Please use another name");
						redirect('transportation/addroutes/');
					}
					}
         $update_data=array(

		 's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
			'route_no'=>isset($post['route_no'])?$post['route_no']:'',
			'status'=>1,
			'created_at'=>date('Y-m-d H:i:s'),
			'updated_at'=>date('Y-m-d H:i:s'),
			'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
			);

		//echo '<pre>';print_r($update_data);exit;

		$update=$this->Transportation_model->update_routes($post['r_id'],$update_data);
		//echo '<pre>';print_r($update);exit;
		if(count($update)>0){

			$details=$this->Transportation_model->get_edit_stops_list($post['r_id']);

				  if(count($details)>0){

					  foreach($details as $lis){

						 $this->Transportation_model->delete_stops($lis['stop_id']); 

					  }

					}

					if(isset($post['route_stops']) && count($post['route_stops'])>0){

					$cnt=0;foreach($post['route_stops'] as $list){ 

						  $add_data=array(

						  's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
						  'r_id'=>isset($post['r_id'])?$post['r_id']:'',
						  'stop_name'=>$list,
						  's_status'=>1,
						  'created_at'=>date('Y-m-d H:i:s'),
						  'updated_at'=>date('Y-m-d H:i:s'),
						  'created_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
						  );

						   //echo '<pre>';print_r($add_data);

						  $this->Transportation_model->save_stops($add_data);	



				       $cnt++;}

					}

			//exit;

			$this->session->set_flashdata('success',"Route Number successfully updated");	

			redirect('transportation/addroutes/'.base64_encode(1));	
			}else{

				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");

				redirect('transportation/editroutes/'.base64_encode($post['r_id']));

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
				if($login_details['role_id']==5){
				$r_id=base64_decode ($this->uri->segment(3));
	            $status=base64_decode ($this->uri->segment(4));
					if($status==1){
	                 $stain=0;
					 }else{
						 $stain=1;
					 }
				if($r_id!=''){
					$staindata=array(
							'status'=> $stain,
							'created_at'=>date('Y-m-d H:i:s')
							);
							 //echo'<pre>';print_r($staindata );exit;  
			$statusdetails =$this->Transportation_model->status_details_data($r_id,$staindata);
				 //echo'<pre>';print_r($statusdetails);exit;  
								$route_add=array(
									's_status'=>$stain,
									'created_at'=>date('Y-m-d H:i:s'),
								);
								//echo'<pre>';print_r($route_add);exit;
							$siva=$this->Transportation_model->status_route_stops($r_id,$route_add);
							//echo'<pre>';print_r($siva);exit;
							
						
						if($status==1){
								$this->session->set_flashdata('success',"Route Number details successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Route Number details successfully activated.");
								}

				
						
						
						
						redirect('transportation/addroutes/'.base64_encode(1));
						
	              }else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('transportation/addroutes/'.base64_encode(1));
				}

				  
	           }else{
		       $this->session->set_flashdata('error',"techincal problem");
               redirect('transportation/addroutes/');
	   }		   
				
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		
		
	}
	
	public function delete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					$r_id=base64_decode($this->uri->segment(3));
		
		  $delete_details =$this->Transportation_model->delete_details_data($r_id);
						 //echo'<pre>';print_r($delete_details);exit;  			
			$delete_stops=$this->Transportation_model->delete_route_stops($r_id);
					//echo'<pre>';print_r($delete_stops);exit;
					$this->session->set_flashdata('success',"Route Number details delete successfully ");
						redirect('transportation/addroutes/'.base64_encode(1));	
					
				}else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('transportation/addroutes/'.base64_encode(1));
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}	

	
	public function vehicle_details()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
	               
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					
					$data['route']=$this->Transportation_model->get_route_details($detail['s_id']);	
					//echo'<pre>';print_r($data['route']);exit;
			$data['vehicle_list']=$this->Transportation_model->get_vechical_details($detail['s_id'],$login_details['u_id']);
					
					//echo'<pre>';print_r($data['vehicle_list']);exit;
			       $data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('transportation/vehicle-details',$data);
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
	public function vehicle_details_post()
		{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					
		            //echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
		         $post=$this->input->post();
		         //echo'<pre>';print_r( $post);exit;
				 $save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'route_number'=>isset($post['route_number'])?$post['route_number']:'',
				'registration_no'=>isset($post['registration_no'])?$post['registration_no']:'',
				'driver_name'=>isset($post['driver_name'])?$post['driver_name']:'',
				'driver_no'=>isset($post['driver_no'])?$post['driver_no']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>$login_details['u_id']
				);
				//echo'<pre>';print_r( $save_data);exit;
				$save=$this->Transportation_model->save_vechil($save_data);
				//echo'<pre>';print_r($save);exit;
					foreach($post['multiple_stops'] as $lis){
					$route_add=array(	
					'v_id'=>$save,
					's_id'=>$detail['s_id'],
					'multiple_stops'=>$lis,
				     's_status'=>1,
					'created_at'=>date('Y-m-d H:i:s'),
					'updated_at'=>date('Y-m-d H:i:s'),
					'created_by'=>$login_details['u_id']
					);
					//echo'<pre>';print_r($route_add);exit;
					$user=$this->Transportation_model->save_vechil_stops($route_add);
				
					}
				//echo'<pre>';print_r($user);exit;
		            $this->session->set_flashdata('success'," vehicle details successfully added");
						redirect('transportation/vehicle_details/'.base64_encode(1));
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('transportation/vehicle_details/'.base64_encode($post['v_id']));
					}
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		
	}	
	public function edit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					//echo'<pre>';print_r($login_details);exit;
				
				$v_id=base64_decode($this->uri->segment(3));
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);

					$data['route']=$this->Transportation_model->get_route_details($detail['s_id']);	
				//echo '<pre>';print_r($data['route']);exit;
					$data['vechical_details']=$this->Transportation_model->get_edit_vechical_details_list($v_id);
					$data['all_stop_list']=$this->Transportation_model->get_route_stop_lists($data['vechical_details']['route_number']);
					//echo '<pre>';print_r($data);exit;

					$this->load->view('transportation/edit-vehicle-details',$data);
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
		
	public function edit_post()
		{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
		          //echo'<pre>';print_r($login_details);exit;
		$detail=$this->Student_model->get_resources_details($login_details['u_id']);
		$post=$this->input->post();
		//echo'<pre>';print_r($post);exit;
		$save_data=array(
				'route_number'=>isset($post['route_number'])?$post['route_number']:'',
				'registration_no'=>isset($post['registration_no'])?$post['registration_no']:'',
				'driver_name'=>isset($post['driver_name'])?$post['driver_name']:'',
				'driver_no'=>isset($post['driver_no'])?$post['driver_no']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>$login_details['u_id']
				);
				//echo'<pre>';print_r($save_data);exit;
				$update=$this->Transportation_model->update_vechil_route_value($post['v_id'],$save_data);
				//echo'<pre>';print_r($post);
			          if(count($update)>0){
						 $stop=$this->Transportation_model->stops_list_data_update($post['v_id']);	

						   foreach($stop as $list){
								  //echo'<pre>';print_r($stop);exit;
									$s_ids[]=$list['multiple_stops'];
						   }
						foreach($s_ids as $li){
								//echo'<pre>';print_r($li);
								if (in_array($li,$post['multiple_stops']))
									{
										//echo "dd";	
									}else{
										$out[]= $li;
									}
									
								}
						   if(isset($out) && count($out)>0){
									foreach($out as $los){
										
										if($los!=''){
										$del=array('s_status'=>2,'updated_at'=>date('Y-m-d H:i:s'));
										$this->Transportation_model->vehical_update_query($los,$post['v_id'],$del);
										}
									}
								}
							
										 foreach($post['multiple_stops'] as $li){
											if (in_array($li,$s_ids))
											{
											  $dd=array(
												's_status'=>1,
												'created_at'=>date('Y-m-d H:i:s'),
												);
												//echo'<pre>';print_r($dd);exit;
												$this->Transportation_model->update_query($li,$dd);	
												
														
										 
											}else{
												$save=array(
													'v_id'=>$post['v_id'],
													's_id'=>$detail['s_id'],
													'multiple_stops'=>$li,
													's_status'=>1,
													'created_at'=>date('Y-m-d H:i:s'),
													'updated_at'=>date('Y-m-d H:i:s'),
													'created_by'=>$login_details['u_id']
													);
												$this->Transportation_model->insert_query_stops($save);
												//echo $this->db->last_query();exit;
										
											}		
												
										 }
					
					
							
					
							 // exit;      
							
					
				
			
		            $this->session->set_flashdata('success'," vehicle details successfully updated");
						redirect('transportation/vehicle_details/'.base64_encode(1));
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
	
	public function vechicalstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
				$v_id=base64_decode ($this->uri->segment(3));
	            $status=base64_decode ($this->uri->segment(4));
					if($status==1){
	                 $stain=0;
					 }else{
						 $stain=1;
					 }
				if($v_id!=''){
					$staindata=array(
							'status'=> $stain,
							'created_at'=>date('Y-m-d H:i:s')
							);
					$statusdetails =$this->Transportation_model->status_data($v_id,$staindata);
					
					
				 //echo'<pre>';print_r($statusdetails);exit;		
					//echo'<pre>';print_r($statusdetails);exit;  
								$route_add=array(
									's_status'=>$stain,
									'created_at'=>date('Y-m-d H:i:s'),
								);
								//echo'<pre>';print_r($route_add);exit;
							$siva=$this->Transportation_model->status_data_stops($v_id,$route_add);
							if($status==1){
								$this->session->set_flashdata('success',"Vehical details successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Vehical details successfully activated.");
								}

						
						redirect('transportation/vehicle_details/'.base64_encode(1));			  					  
	              }else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('transportation/vehicle_details/'.base64_encode(1));
				}

				  
	   }else{
		 $this->session->set_flashdata('error',"techincal problem");
              redirect('transportation/addroutes/');
	   }		   
				
				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		
		
	}
	
	public function vechicaldelete()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					//echo'<pre>';print_r($login_details);exit;
					$v_id=base64_decode($this->uri->segment(3));
		$delete_details =$this->Transportation_model->delete_vechical_details_data($v_id);
						 //echo'<pre>';print_r($delete_details);exit;  			
			$siva=$this->Transportation_model->delete_vechical_details_stops($v_id);
					//echo'<pre>';print_r($siva);exit;
		
		 
					$this->session->set_flashdata('success',"delete successfully ");
						redirect('transportation/vehicle_details/'.base64_encode(1));	
					
				}else{
						$this->session->set_flashdata('error',"problem is occurs");
			            redirect('transportation/vehicle_details/'.base64_encode(1));
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('dashboard');
		}
	}	

	public function transport_fee_details()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					$data['tab']=base64_decode($this->uri->segment(3));
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['route']=$this->Transportation_model->get_route_details_card($detail['s_id']);
					$data['stops']=$this->Transportation_model->get_stop_list_order_details_card($detail['s_id']);
					 //echo '<pre>';print_r($data);exit;
					$data['transport_free']=$this->Transportation_model->get_transport_free_list_data($detail['s_id']);
					 
					 //echo '<pre>';print_r($data);exit;
					 $data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('transportation/transport-fee-details',$data);
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
	
	public function transport_fee_details_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$post=$this->input->post();	
					//echo'<pre>';print_r($post);exit;
					$cnt=0;foreach($post['route_id'] as $lis){
							$check=$this->Transportation_model->check_transfprtaion_exits($lis,$post['stops'][$cnt],$post['to_stops'][$cnt]);
						if(count($check)>0){
						$this->session->set_flashdata('error',"transportation fee details already exists. Please try again.");
						redirect('transportation/transport_fee_details');
						}
							$save_data = array(
							's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
							'route_id'=>$lis,
							'stops'=>$post['stops'][$cnt],
							'to_stops'=>$post['to_stops'][$cnt],
							'amount'=>$post['amount'][$cnt],
							'status'=>1,
							'created_at'=>date('Y-m-d H:i:s'),
							'updated_at'=>date('Y-m-d H:i:s'),
							'created_by'=>$login_details['u_id']   
						);
						//echo'<pre>';print_r($save_data);exit;
					$save=$this->Transportation_model->save_transport_data($save_data);		
					//echo'<pre>';print_r($save);exit;
					$cnt++;
					}
					if(count($save)>0){
						$this->session->set_flashdata('success',"Transport fee details are successfully added");	
						redirect('transportation/transport-fee-details/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('transportation/transport-fee-details'.base64_encode($post['f_id']));
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
	
	
	
	 public function routes_sides(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5 || $login_details['role_id']==8){
					$post=$this->input->post();
					
					$route_stops=$this->Transportation_model->routes_wise_stop_list($post['route_number']);
					//echo'<pre>';print_r($route_stops);exit;
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
	public function routes_stops()
	{
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					//echo'<pre>';print_r($login_details);exit;
					$post=$this->input->post();
					$route_stops=$this->Transportation_model->routes_stops($post['route_id']);
					//echo'<pre>';print_r($route_stops);exit;
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
	
	
	public function get_stops_order_list()
	{
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==5){
					//echo'<pre>';print_r($login_details);exit;
					$id=$this->input->post('stops');
					//echo'<pre>';print_r($id);exit;
					$route_stops=$this->Transportation_model->get_stops_order_list($id);
					//echo'<pre>';print_r($route_stops);exit;
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
	
	
	
	
	
	
	
	
	/* transportation fee*/
	public  function transportedit(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==5){
				
					$f_id=base64_decode($this->uri->segment(3));
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['transportion_details']=$this->Transportation_model->get_transportaion_details($f_id);
					//echo'<pre>';print_r($data['transportion_details']);exit;
					$data['route']=$this->Transportation_model->get_route_details_card($detail['s_id']);
					 //echo '<pre>';print_r($data);exit;
					//$data['route_stops']=$this->Transportation_model->routes_stops($data['transportion_details']['route_id']);	
$data['route_stops']=$this->Transportation_model->routes_stops($data['transportion_details']['route_id']);
  $data['stops_order_list']=$this->Transportation_model->get_stops_order($data['transportion_details']['stops']);

					//echo'<pre>';print_r($data);exit;	 
					$this->load->view('transportation/transport-fee-edit',$data);
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
	public  function transport_fee_update_post(){
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==5){
				$post=$this->input->post();
				//echo'<pre>';print_r($post);exit;
				$details=$this->Transportation_model->get_transportaion_details($post['f_id']);
				  if($details['route_id']!=$post['route_id']|| $details['stops']!=$post['stops']||$details['to_stops']!=$post['to_stops']){
						$check=$this->Transportation_model->check_transfprtaion_exits($post['route_id'],$post['stops'],$post['to_stops']);
						if(count($check)>0){
						$this->session->set_flashdata('error',"transportation fee details already exists. Please try again.");
						redirect('transportation/transportedit/'.base64_encode($post['f_id']));
						}
					}
				$update=array(
					'route_id'=>isset($post['route_id'])?$post['route_id']:"",
					'stops'=>isset($post['stops'])?$post['stops']:"",
					'to_stops'=>isset($post['to_stops'])?$post['to_stops']:"",
					'amount'=>isset($post['amount'])?$post['amount']:"",
					'updated_at'=>date('Y-m-d H:i:s'),
				
				);
				
				$statusdata=$this->Transportation_model->update_transactional_fee__details($post['f_id'],$update);
					//echo'<pre>';print_r($statusdata);exit;
					if(count($statusdata)>0){
						$this->session->set_flashdata('success',"Transportation fee details successfully updated.");
						
						redirect('transportation/transport_fee_details/'.base64_encode(1));
					}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('transportation/transportedit/'.base64_encode($post['f_id']));
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
	public function transportstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==5){
					$f_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($f_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Transportation_model->update_transactional_fee__details($f_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"Transportation fee details successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"Transportation fee details successfully activated.");
								}
								redirect('transportation/transport_fee_details/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('transportation/transport_fee_details/'.base64_encode(1));
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
	public function transportdelete()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==5){
					$f_id=base64_decode($this->uri->segment(3));
					
					if($f_id!=''){
						$stusdetails=array(
							'status'=>2,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Transportation_model->update_transactional_fee__details($f_id,$stusdetails);
							if(count($statusdata)>0){
								$this->session->set_flashdata('success',"Transportation fee details successfully deleted.");
								
								redirect('transportation/transport_fee_details/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('transportation/transport_fee_details/'.base64_encode(1));
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
	/* transportation fee*/
	/* transportation registration*/
	public function student_transport_registration()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
                     $data['tab']=base64_decode($this->uri->segment(3));
					
					$data['routes']=$this->Transportation_model->get_routes_number_students($detail['s_id']);
                          //echo'<pre>';print_r($data['routes']);exit;
					$data['stops_student']=$this->Transportation_model->get_student_stops($detail['s_id']);
					$data['stops']=$this->Transportation_model->get_stops();
					//echo'<pre>';print_r($data['stops']);exit;
					
					
					
					//$data['vechical_no']=$this->Transportation_model->get_vechical_number_list($detail['s_id']);
					//$data['routes_number']=$this->Transportation_model->get_routes_number($detail['s_id']);
					$data['student_transport']=$this->Transportation_model->student_transport_registration_list($detail['s_id']);	
					//echo'<pre>';print_r($data['student_transport']);exit;
					
					//echo'<pre>';print_r($data);exit;
					$this->load->view('transportation/student-transport-registration',$data);
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
	public function get_stops_route_amount(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$post=$this->input->post();
					$vechical_list=$this->Transportation_model->get_stops_route_amount($post['stop_end']);
					//echo'<pre>';print_r($vechical_list);exit;
					if(count($vechical_list)>0){
						$data['msg']=1;
						$data['list']=$vechical_list;
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
	
	public function get_route_stops_end_student(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$post=$this->input->post();
					$vechical_list=$this->Transportation_model->get_route_stops_end_student($post['stop_strat']);
					//echo'<pre>';print_r($vechical_list);exit;
					if(count($vechical_list)>0){
						$data['msg']=1;
						$data['list']=$vechical_list;
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
	
	
	
	
	
	
	
	public function get_route_stops_student(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$post=$this->input->post();
					$vechical_list=$this->Transportation_model->get_route_stops_student($post['route']);
					//echo'<pre>';print_r($vechical_list);exit;
					if(count($vechical_list)>0){
						$data['msg']=1;
						$data['list']=$vechical_list;
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
		
		public function student_transport_registration_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					//echo'<pre>';print_r($detail);exit;
					 $post=$this->input->post();
		        // echo'<pre>';print_r( $post);exit;
				 $check=$this->Transportation_model->check_student_allready_exits($post['student_id']);
					if(($check)>0){
						$this->session->set_flashdata('error',"student add routes already exists. Please use another student add routes");
						redirect('transportation/student_transport_registration');
					}
				 
				 $save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'student_id'=>isset($post['student_id'])?$post['student_id']:'',
				'route'=>isset($post['route'])?$post['route']:'',
				'stop_strat'=>isset($post['stop_strat'])?$post['stop_strat']:'',
				'stop_end'=>isset($post['stop_end'])?$post['stop_end']:'',
				'total_amount'=>isset($post['total_amount'])?$post['total_amount']:'',
				'pay_amount'=>isset($post['pay_amount'])?$post['pay_amount']:'',
				'status'=>1,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s'),
				'created_by'=>$login_details['u_id']
				);
				//echo'<pre>';print_r($save_data);exit;	
				$save=$this->Transportation_model->save_student_transport_data($save_data);			
				//echo'<pre>';print_r($save);exit;	
				if(count($save)>0){
					    $pay_details=array(
							's_t_id'=>isset($save)?$save:'',
							's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
							'class_name'=>isset($post['class_id'])?$post['class_id']:'',
							'student_id'=>isset($post['student_id'])?$post['student_id']:'',
							'total_amount'=>isset($post['total_amount'])?$post['total_amount']:'',
							'pay_amount'=>isset($post['pay_amount'])?$post['pay_amount']:'',
							'status'=>1,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$login_details['u_id'],
							);
							$this->Transportation_model->save_student_bus_payment($pay_details);
					
					
						$this->session->set_flashdata('success',"student transport registration details are successfully added");	
						redirect('transportation/student_transport_registration/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('transportation/student_transport_registration/');
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
	public function studentedit()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$this->uri->segment(3);
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					//echo'<pre>';print_r($detail);exit;
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					$data['routes']=$this->Transportation_model->get_routes_number_students($detail['s_id']);
					$data['student']=$this->Transportation_model->edit_student_transport_registration($detail['s_id'],base64_decode($this->uri->segment(3)));
					$data['stops_student']=$this->Transportation_model->get_route_stops_student($data['student']['route']);
					$data['end_stop']=$this->Transportation_model->get_route_stops_end_student($data['student']['stop_strat']);
					$data['student_name']=$this->Transportation_model->class_wise_student_list($data['student']['class_id']);	
					$data['total_amount']=$this->Transportation_model->get_stops_route_amount($data['student']['stop_end']);
				//echo'<pre>';print_r($data);exit;	
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('transportation/student-transport-registration-edit',$data);
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
	
	public function student_transport_edit_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					//echo'<pre>';print_r($login_details);exit;
					$this->uri->segment(3);
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);		
					$post=$this->input->post();

					$student=$this->Transportation_model->edit_student_transport_registration($detail['s_id'],$post['s_t_id']);
								//echo'<pre>';print_r($student);exit;

					if($student['student_id']!=$post['student_id']){
					$check=$this->Transportation_model->check_student_allready_exits($post['student_id']);
					if(($check)>0){
						$this->session->set_flashdata('error',"student add routes already exists. Please use another student add routes");
						redirect('transportation/studentedit/'.base64_encode($post['s_t_id']));
					}
					}
					 $update_data=array(
						'class_id'=>isset($post['class_id'])?$post['class_id']:'',
						'student_id'=>isset($post['student_id'])?$post['student_id']:'',
						'route'=>isset($post['route'])?$post['route']:'',
						'stop_strat'=>isset($post['stop_strat'])?$post['stop_strat']:'',
						'stop_end'=>isset($post['stop_end'])?$post['stop_end']:'',
						'total_amount'=>isset($post['total_amount'])?$post['total_amount']:'',
						'status'=>1,
						'updated_at'=>date('Y-m-d H:i:s'),
						'created_by'=>$login_details['u_id']
					);
				//echo'<pre>';print_r($update_data);exit;	
				$update=$this->Transportation_model->update_student_transport_data($post['s_t_id'],$update_data);			
				//echo'<pre>';print_r($update);exit;	
				if(count($update)>0){
						$this->session->set_flashdata('success',"student transport registration details are successfully updated");	
						redirect('transportation/student_transport_registration/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('transportation/student_transport_registration/'.base64_encode($post['s_t_id']));
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
	public function studentstatus()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==3){
					$s_t_id=base64_decode($this->uri->segment(3));
					$status=base64_decode($this->uri->segment(4));
					if($status==1){
						$statu=0;
					}else{
						$statu=1;
					}
					if($s_t_id!=''){
						$stusdetails=array(
							'status'=>$statu,
							'updated_at'=>date('Y-m-d H:i:s')
							);
							$statusdata=$this->Transportation_model->status_student_transport_registration_details($s_t_id,$stusdetails);
							$statusdata=$this->Transportation_model->status_update_student_transport_registration_details($s_t_id,$stusdetails);
							if(count($statusdata)>0){
								if($status==1){
								$this->session->set_flashdata('success',"student transport registration details details successfully deactivated.");
								}else{
									$this->session->set_flashdata('success',"student transport registration details successfully activated.");
								}
								redirect('transportation/student_transport_registration/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('transportation/student_transport_registration/'.base64_encode(1));
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
	public function studentdelete()
	{	
		if($this->session->userdata('userdetails'))
		{
		$login_details=$this->session->userdata('userdetails');

			if( $login_details['role_id']==3){
					$s_t_id=base64_decode($this->uri->segment(3));
					
							$deleted_data=$this->Transportation_model->deleted_student_transport_registration_details($s_t_id,$stusdetails);
							$deleted_datas=$this->Transportation_model->deleted_student_bus_payments_details($s_t_id,$stusdetails);
							if(count($deleted_data)>0){
								$this->session->set_flashdata('success',"student transport registration details details successfully deleted.");
								
								redirect('transportation/student_transport_registration/'.base64_encode(1));
							}else{
									$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
									redirect('transportation/student_transport_registration/'.base64_encode(1));
							}
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('dashboard');
					}
					
			
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
		
	}
	public function get_vehical_routes_lists(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$post=$this->input->post();
					$stops_list=$this->Transportation_model->vehical_wise_stops_list($post['route']);
					if(count($stops_list)>0){
						$data['msg']=1;
						$data['list']=$stops_list;
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
				if($login_details['role_id']==8 || $login_details['role_id']==3){
					$post=$this->input->post();
					$student_list=$this->Transportation_model->class_wise_student_list($post['class_id']);
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
	public function get_vehical_stop_lists(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==8){
					$post=$this->input->post();
					$stops_list=$this->Transportation_model->vehical_stops_list_pickup_point($post['vechical_number']);
					
					if(count($stops_list)>0){
						$data['msg']=1;
						$data['list']=$stops_list;
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
	/* transportation registration*/
	
}
