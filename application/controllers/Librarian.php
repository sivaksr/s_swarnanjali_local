<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Librarian extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Librarian_model');
			$this->load->model('Student_model');
	}
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$this->load->view('librarian/attendence-report');
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
	public function add_book()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					//echo'<pre>';print_r($login_details);exit;
					
					$details=$this->Librarian_model->libray_values($login_details['u_id']);
					//echo'<pre>';print_r($details);exit;
				
            $data['book_list']=$this->Librarian_model->book_list_order($details['s_id']);
				//echo'<pre>';print_r($data);exit;
					
					
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('librarian/add-book',$data);
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
	public function add_book_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
						//echo'<pre>';print_r($login_details);exit;
				$post=$this->input->post();	
				//echo'<pre>';print_r($post);exit;
				$details=$this->Librarian_model->libray_values($login_details['u_id']);
					//echo'<pre>';print_r($details);exit;
		$check_book_exit=$this->Librarian_model->check_book_already($details['s_id'],$post['book_number']);
				//echo'<pre>';print_r($check_book_exit);exit;
				if(count($check_book_exit)>0){
					$this->session->set_flashdata('error',"Book already taken");
					redirect('librarian/add-book');
				}	
					
				$save_data=array(
				's_id'=>isset($details['s_id'])?$details['s_id']:'',
				'book_number'=>isset($post['book_number'])?$post['book_number']:'',
				'book_title'=>isset($post['book_title'])?$post['book_title']:'',
				'author_name'=>isset($post['author_name'])?$post['author_name']:'',
				'publisher'=>isset($post['publisher'])?$post['publisher']:'',
				'category'=>isset($post['category'])?$post['category']:'',
				'isbn'=>isset($post['isbn'])?$post['isbn']:'',
				'date'=>isset($post['date'])?$post['date']:'',
				'price'=>isset($post['price'])?$post['price']:'',
				'qty'=>isset($post['qty'])?$post['qty']:'',
				'shelf_no'=>isset($post['shelf_no'])?$post['shelf_no']:'',
				'department'=>isset($post['department'])?$post['department']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				//echo'<pre>';print_r($save_data);exit;	
				$save=$this->Librarian_model->book_details($save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success',"add book details are successfully register");	
					redirect('librarian/add-book/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('librarian/add-book');
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
				if($login_details['role_id']==10){
					//echo'<pre>';print_r($login_details);exit;
					
				 $this->uri->segment(3);
		  //echo'<pre>';print_r($login_details);exit;
		  $details=$this->Librarian_model->libray_values($login_details['u_id']);
					//echo'<pre>';print_r($details);exit;
				
       $data['book']=$this->Librarian_model->book_list_details($details['s_id'],base64_decode($this->uri->segment(3)));
		//echo'<pre>';print_r($data);exit;
			
		  $this->load->view('librarian/edit_add_book',$data);
		
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
				if($login_details['role_id']==10){
			//echo'<pre>';print_r($login_details);exit;
				$post=$this->input->post();	
				//echo'<pre>';print_r($post);exit;
		$book_number=$this->Librarian_model->book_number_exit_details($post['b_id']);		 
				//echo'<pre>';print_r($book_number);exit; 
				if($book_number['book_number']!=$post['book_number']){
		$book_list=$this->Librarian_model->book_number_book_name($post['book_number']);		 
				 //echo'<pre>';print_r($book_list);exit; 
				if(count($book_list)>0){
					 $this->session->set_flashdata('error',"book name alreay taken");
					 redirect('librarian/edit/'.base64_encode($post['b_id']));
			      }	
			}
				$user_data=array(
				'book_number'=>isset($post['book_number'])?$post['book_number']:'',
				'book_title'=>isset($post['book_title'])?$post['book_title']:'',
				'author_name'=>isset($post['author_name'])?$post['author_name']:'',
				'publisher'=>isset($post['publisher'])?$post['publisher']:'',
				'category'=>isset($post['category'])?$post['category']:'',
				'isbn'=>isset($post['isbn'])?$post['isbn']:'',
				'date'=>isset($post['date'])?$post['date']:'',
				'price'=>isset($post['price'])?$post['price']:'',
				'qty'=>isset($post['qty'])?$post['qty']:'',
				'shelf_no'=>isset($post['shelf_no'])?$post['shelf_no']:'',
				'department'=>isset($post['department'])?$post['department']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				//echo'<pre>';print_r($user_data);exit;
				$update=$this->Librarian_model->update_book_details($post['b_id'],$user_data);
				//echo'<pre>';print_r($update);exit;
				if(count($update)>0){
							$this->session->set_flashdata('success','books details successfully Updated');
							redirect('librarian/add_book/'.base64_encode(1));
							
						}else{
							$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
							redirect('librarian/edit/'.base64_encode($post['b_id']));
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
				if($login_details['role_id']==10){
				$b_id=base64_decode ($this->uri->segment(3));
	            $status=base64_decode ($this->uri->segment(4));
					if($status==1){
	                 $stain=0;
					 }else{
						 $stain=1;
					 }
				if($b_id!=''){
					$staindata=array(
							'status'=> $stain,
							'create_at'=>date('Y-m-d H:i:s')
							);
							 //echo'<pre>';print_r($staindata );exit;  
			$statusdetails =$this->Librarian_model->status_details_data($b_id,$staindata);
						 //echo'<pre>';print_r($statusdetails );exit;  
					      if(count($statusdetails)>0){
						$this->session->set_flashdata('sucess',"status  successfully");
				redirect('librarian/add_book/'.base64_encode(1));			  					  
	              }	  
	   }else{
		 $this->session->set_flashdata('error',"techincal problem");
              redirect('librarian/add_book/'.base64_encode($b_id));
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
				if($login_details['role_id']==10){
					$b_id=base64_decode($this->uri->segment(3));
		
		  $delete_details =$this->Librarian_model->delete_details_data($b_id);
						 //echo'<pre>';print_r($delete_details);exit;  			
				if(count($delete_details)>0){
		$this->session->set_flashdata('sucess'," delete successfully");
	    redirect('librarian/add_book/'.base64_encode(1));			
		}else{
			$this->session->set_flashdata('error',"problem is occurs");
			redirect('librarian/add_book/'.base64_encode($b_id));
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

	public function issue_book()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					//echo'<pre>';print_r($data['class_list']);exit;
					$data['issued_book_list']=$this->Librarian_model->get_issued_book_list($detail['s_id']);
					//echo'<pre>';print_r($data['issued_book_list']);exit;
					$data['book_list']=$this->Librarian_model->get_book_list($detail['s_id']);
					//echo'<pre>';print_r($data['book_list']);exit;
					$data['tab']=base64_decode($this->uri->segment(3));
					//echo '<pre>';print_r($class_list);exit;
					$this->load->view('librarian/issue-book',$data);
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
	
	public function renewalbook()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
					$data['edit_renewal']=$this->Librarian_model->edit_renewal_list($detail['s_id'],base64_decode($this->uri->segment(3)));	
					//echo'<pre>';print_r($data);exit;
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					//echo'<pre>';print_r($data['class_list']);exit;
					$data['student_name']=$this->Librarian_model->get_class_wise_student_list($data['edit_renewal']['class_id']);	
					$data['book_list']=$this->Librarian_model->get_book_list($detail['s_id']);
					//echo'<pre>';print_r($data);exit;
					$data['tab']=base64_decode($this->uri->segment(3));
					//echo '<pre>';print_r($data);exit;
					$this->load->view('librarian/renewal-book',$data);
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
	
	public function renewalbook_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
						//echo'<pre>';print_r($login_details);exit;
				$post=$this->input->post();	
				//echo'<pre>';print_r($post);exit;
				
				//echo'<pre>';print_r($post);exit;
				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'student_id'=>isset($post['student_id'])?$post['student_id']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'b_id'=>isset($post['book_number'])?$post['book_number']:'',
				'no_of_books_taken'=>isset($post['no_of_books'])?$post['no_of_books']:'',
				'issued_date'=>isset($post['issued_date'])?$post['issued_date']:'',
				'return_renew_date'=>isset($post['return_renew_date'])?$post['return_renew_date']:'',
				'status'=>2,
				'return_date'=>'',
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				//echo'<pre>';print_r($save_data);exit;	
				$update=$this->Librarian_model->update_renewal_book($post['i_b_id'],$save_data);	
					//echo'<pre>';print_r($update);exit;
					if(count($update)>0){
					$this->session->set_flashdata('success'," book renewal  successfully updated");	
					redirect('librarian/issue_book_list');	
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('librarian/issue_book_list');
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
	
	
	
	
	
	
	
	public function issue_book_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
						//echo'<pre>';print_r($login_details);exit;
				$post=$this->input->post();	
				$check_book_exits=$this->Librarian_model->check_book_already_issued($detail['s_id'],$post['student_id'],$post['book_number']);
				//echo'<pre>';print_r($check_book_exits);exit;
				if(count($check_book_exits)>0){
					$this->session->set_flashdata('error',"Book already issued with this student. Please issue another book");
					redirect('librarian/issue_book');
				}
				//echo'<pre>';print_r($post);exit;
				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'barcode_id'=>isset($post['book_id'])?$post['book_id']:'',
				'student_id'=>isset($post['student_id'])?$post['student_id']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'b_id'=>isset($post['book_number'])?$post['book_number']:'',
				'no_of_books_taken'=>isset($post['no_of_books'])?$post['no_of_books']:'',
				'issued_date'=>isset($post['date'])?$post['date']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
				 );
				//echo'<pre>';print_r($save_data);exit;	
				$save=$this->Librarian_model->save_issued_book($save_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($save)>0){
					$this->session->set_flashdata('success'," book issued successfully");	
					redirect('librarian/issue_book/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('librarian/issue_book/');
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
	public  function return_bookpost(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
				//echo'<pre>';print_r($post);
				if($post['type']==0){
					$data=isset($post['issued_date'])?$post['issued_date']:'';
				}else{
					$data=date('Y-m-d');
				}
				$update_data=array(
					'issued_date'=>$data,
					'return_renew_date'=>date('Y-m-d'),
					'status'=>$post['type'],
					'create_at'=>date('Y-m-d H:i:s'),
					'update_at'=>date('Y-m-d H:i:s')
				 );
				//echo'<pre>';print_r($update_data);exit;	
				$update=$this->Librarian_model->update_book_renew_details($post['issued_book_id'],$update_data);	
					//echo'<pre>';print_r($save);exit;
					if(count($update)>0){
						if(isset($post['fine_if_any']) && $post['fine_if_any']!=''){
							$fine=array(
								'book_id'=>$post['issued_book_id'],
								'student_id'=>$post['student_id'],
								'fine_if_any'=>$post['fine_if_any'],
								'status'=>'',
								'create_at'=>date('Y-m-d H:i:s'),
								'update_at'=>date('Y-m-d H:i:s')
							);
							$this->Librarian_model->adding_issued_book_fine_amount($fine);
						
						}
						
					$this->session->set_flashdata('success'," book issued details successfully updated");	
					redirect('librarian/issue_book_list');	
					}else{
						$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
						redirect('librarian/issue_book_list');	
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
	
	
	public function get_book_issued_date(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Librarian_model->get_resources_details($login_details['u_id']);
					$lib_due_days=$this->Librarian_model->get_school_lib_due_hours($detail['s_id']);
					$post=$this->input->post();
					$book_details=$this->Librarian_model->get_issued_book_details($post['book_id']);
					$datetime1 = new DateTime($book_details['issued_date']);
					$c_date= date('Y-m-d');
					$datetime2 = new DateTime($c_date);
					$interval = $datetime1->diff($datetime2);
					$book_issued_date=$interval->format('%a');
					
					
					if(count($book_details)>0){
						if($lib_due_days['lib_book_due_time'] >$book_issued_date){
							$day_count=(($book_issued_date)-($lib_due_days['lib_book_due_time']));
							$fine=($lib_due_days['fine_charge_amt']*$day_count);
						}else{
							$day_count='';
							$fine='';
						}
						$data['msg']=1;
						$data['i_b_id']=$book_details['i_b_id'];
						$data['issued_date']=$book_details['issued_date'];
						$data['due_days']=$day_count;
						$data['fine_amt']=$fine;
						echo json_encode($data);exit;	
					}else{
						$data['msg']=0;
						$data['issued_date']='';
						$data['due_days']='';
						$data['fine_amt']='';
						$data['list']='';
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
	
	public function return_book()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					
					$i_b_id=base64_decode($this->uri->segment(3));
					if($i_b_id==''){
						$this->session->set_flashdata('error',"Technical  problem will occured . Please try  again once");
						redirect('librarian/add_book');
					}
					$detail=$this->Librarian_model->get_resources_details($login_details['u_id']);
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					
					$data['issued_book_details']=$this->Librarian_model->get_all_issued_book_details($i_b_id);
					
					//echo $this->db->last_query();
					$lib_due_days=$this->Librarian_model->get_school_lib_due_hours($detail['s_id']);
					$book_details=$this->Librarian_model->get_issued_book_details($i_b_id);
					//echo'<pre>';print_r($data);exit;
					$datetime1 = new DateTime($book_details['issued_date']);
					$c_date= date('Y-m-d');
					$datetime2 = new DateTime($c_date);
					$interval = $datetime1->diff($datetime2);
					$book_issued_date=$interval->format('%a');
					if(count($data['issued_book_details'])>0){
						if($lib_due_days['lib_book_due_time'] >$book_issued_date){
							$day_count=(($book_issued_date)-($lib_due_days['lib_book_due_time']));
							$fine=($lib_due_days['fine_charge_amt']*$day_count);
						}else{
							$day_count='';
							$fine='';
						}
						$data['msg']=1;
						$data['due_days']=$day_count;
						$data['fine_amt']=$fine;
					}else{
						$data['msg']=0;
						$data['due_days']='';
						$data['fine_amt']='';
					}
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('librarian/return-book',$data);
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
	public function return_book_list()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Librarian_model->get_resources_details($login_details['u_id']);
					$data['issued_book_list']=$this->Librarian_model->get_issued_book_completed_list($detail['s_id']);
					//echo'<pre>';print_r($data);exit;
					$this->load->view('librarian/return-book-list',$data);
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
	
	public function returnbook()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
				$i_b_id=base64_decode ($this->uri->segment(3));
	            $status=base64_decode ($this->uri->segment(4));
					if($status==0){
	                 
					 }
				if($i_b_id!=''){
					$staindata=array(
							'status'=> 0,
							'return_renew_date'=>'',
							'create_at'=>date('Y-m-d H:i:s'),
							'return_date'=>date('m/d/y')
							);
							// echo'<pre>';print_r($staindata );exit;  
			$statusdetails =$this->Librarian_model->status_return_book($i_b_id,$staindata);
						 //echo'<pre>';print_r($statusdetails );exit;  
					      if(count($statusdetails)>0){
						$this->session->set_flashdata('sucess',"Return book  successfully");
				redirect('librarian/issue_book_list');			  					  
	              }	  
	   }else{
		 $this->session->set_flashdata('error',"techincal problem");
              redirect('librarian/issue_book_list');
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
	
	
	
	
	
	
	
	
	
	
	public function book_damage()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					//echo'<pre>';print_r($login_details);exit;	
			$detail=$this->Student_model->get_resources_details($login_details['u_id']);	
					$data['class_list']=$this->Student_model->get_school_class_list($detail['s_id']);
					//echo'<pre>';print_r($data['class_list']);exit;		
	
				$details=$this->Librarian_model->libray_values($login_details['u_id']);
					//echo'<pre>';print_r($details);exit;
		$data['books_numbers']=$this->Librarian_model->books_number_list($details['s_id']);
					//echo'<pre>';print_r($data['books_numbers']);exit;
			
            $data['damage_book']=$this->Librarian_model->damage_book_list_order($details['s_id']);
				//echo'<pre>';print_r($data['damage_book']);exit;	
			
					$data['tab']=base64_decode($this->uri->segment(3));
					$this->load->view('librarian/book-damage',$data);
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
	
	public function book_damage_post()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					//echo'<pre>';print_r($login_details);exit;
					$post=$this->input->post();	
					//echo'<pre>';print_r($post);exit;
	$details=$this->Librarian_model->libray_values($login_details['u_id']);
	//echo'<pre>';print_r($details);exit;	
				
				$damage_data=array(
                 's_id'=>isset($details['s_id'])?$details['s_id']:'',
				'i_b_id'=>isset($post['book_number'])?$post['book_number']:'',
				'class_id'=>isset($post['class_id'])?$post['class_id']:'',
				'student_id'=>isset($post['student_id'])?$post['student_id']:'',
				'book_number'=>isset($post['book_number'])?$post['book_number']:'',
				'return_type'=>isset($post['return_type'])?$post['return_type']:'',
				'price'=>isset($post['price'])?$post['price']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>isset($login_details['u_id'])?$login_details['u_id']:''
                 );				
				//echo'<pre>';print_r($damage_data);exit;	
			$save_data=$this->Librarian_model->insert_book_damage_list($damage_data);		
				//echo'<pre>';print_r($save_data);exit;		
				if(count($save_data)>0){
				$this->session->set_flashdata('success',"book damage details ars successfully registered");	
					redirect('librarian/book-damage/'.base64_encode(1));	
					}else{
						$this->session->set_flashdata('error',"techechal probelem occur ");
						redirect('librarian/book-damage');
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
	
	 public function get_student_list_class_wise(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$post=$this->input->post();
					$student_list=$this->Librarian_model->get_classwise_student_list($post['class_id']);
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
	
	public function student_list_class(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$post=$this->input->post();
					$student_list=$this->Librarian_model->class_wise_student_list($post['class_id']);
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
	public function issue_book_list()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$detail=$this->Librarian_model->get_resources_details($login_details['u_id']);
					$data['issued_book_list']=$this->Librarian_model->get_issued_book_pending_list($detail['s_id']);
					
					//echo '<pre>';print_r($data);exit;
					$this->load->view('librarian/return-book-list',$data);
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
	
	
	
	public function get_student_issued_book_list(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==10){
					$post=$this->input->post();
					$book_list=$this->Librarian_model->get_student_issued_book_list($post['student_id']);
					
					//echo $this->db->last_query();exit;
					if(count($book_list)>0){
						$data['msg']=1;
						$data['list']=$book_list;
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
