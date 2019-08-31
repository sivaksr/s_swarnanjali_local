<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
require_once ('razorpay-php/Razorpay.php');
use Razorpay\Api\Api as RazorpayApi;
class Payment extends In_frontend {

	public function __construct() 
	{
		parent::__construct();	
		
	}
	public function pay()
	{
		if($this->session->userdata('userdetails'))
		{
		$post=$this->input->post();
		//echo '<pre>';print_r($post);exit;
		$u_id=base64_decode($this->uri->segment(3));
		$details=$this->Student_model->get_student_details($post['u_id']);
		$data['student_details']=$this->Student_model->get_student_details($post['u_id']);
		$data['last_payment_details']=$this->Student_model->get_student_last_payment_details($post['u_id']);
		
		if(isset($post['payment_type']) && $post['payment_type']==2){
							$data['details']=$details;
							$data['details']['payamount']=$post['amount'];
							$school_details=$this->Student_model->get_school_details($post['u_id']);
							$data['school_details']=$school_details;
							$path = rtrim(FCPATH,"/");
							$file_name =$details['name'].'_'.$details['u_id'].time().'.pdf';
							$pdfFilePath = $path."/assets/fee_invoices/".$file_name;
							ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$html =$this->load->view('student/invoice',$data, true); // render the view into HTML
							//echo '<pre>';print_r($html);exit;
							$this->load->library('pdf');
							$pdf = $this->pdf->load();
							$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$pdf->SetDisplayMode('fullpage');
							$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
							$pdf->WriteHTML($html); // write the HTML into the PDF
							$pdf->Output($pdfFilePath, 'F');
							$pay_details=array(
							's_id'=>isset($post['u_id'])?$post['u_id']:'',
							'school_id'=>isset($details['s_id'])?$details['s_id']:'',
							'class_name'=>isset($details['class_name'])?$details['class_name']:'',
							'roll_number'=>isset($details['roll_number'])?$details['roll_number']:'',
							'fee_amount'=>isset($details['fee_amount'])?$details['fee_amount']:'',
							'fee_terms'=>isset($details['fee_terms'])?$details['fee_terms']:'',
							'pay_amount'=>isset($post['amount'])?$post['amount']:'',
							'invoice'=>isset($file_name)?$file_name:'',

							'status'=>1,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$login_details['u_id'],
							);
							$success=$this->Student_model->save_student_fee_payment($pay_details);
							if(count($success)>0){
									$this->session->set_flashdata('success',"Payment successfully completed");
									redirect('payment/complete/'.base64_encode($success));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('student/index/'.base64_encode(1));
							}
		}else{
			
			if(count($details)>0){
				//echo '<pre>';print_r($details);exit;
					//exit;
					$data['user_details']=$details;
					$api_id=$this->config->item('keyId');
					$api_Secret=$this->config->item('API_keySecret');
					$api = new RazorpayApi($api_id,$api_Secret);
					//$api = new RazorpayApi($this->config->load('keyId'), $this->config->load('API_keySecret'));
					$orderData = [
							'receipt'         =>$details['u_id'] ,
							'amount'          => $post['amount']*100, // 2000 rupees in paise
							'currency'        => 'INR',
							'payment_capture' => 1 // auto capture
					];
					
					echo '<pre>';print_r($orderData);exit;

						$razorpayOrder = $api->order->create($orderData);
						$razorpayOrderId = $razorpayOrder['id'];
						$displayAmount = $amount = $orderData['amount'];
						$displayCurrency=$orderData['currency'];
						$data['details'] = [
									"key"               => $api_id,
									"amount"            => $amount,
									"name"              => $details['name'],
									"description"       => $post['description'],
									"image"             => "",
									"prefill"           => [
									"name"              => $details['name'],
									"email"             => $details['email'],
									"contact"           => $details['mobile'],
									],
									"notes"             => [
									"address"           => $details['address'],
									"merchant_order_id" => $details['u_id'],
									],
									"theme"             => [
									"color"             => "#F37254"
									],
									"order_id"          => $razorpayOrderId,
									"display_currency"          => $orderData['currency'],
						];
					
						$this->load->view('student/pay',$data);
						$this->load->view('html/footer');
					
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('home');
				}
		
		}
		
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	public  function success(){
	
		if($this->session->userdata('userdetails'))
		{
				
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			if($post['u_id']!=''){
				$details=$this->Student_model->get_student_details($post['u_id']);
				$school_details=$this->Student_model->get_school_details($post['u_id']);
				//echo '<pre>';print_r($details);exit;
				if(count($details)>0){
			
							$post=$this->input->post();
							$data['details']=$details;
							$data['details']['payamount']=$post['pay_amount']/100;
							$data['school_details']=$school_details;
							$path = rtrim(FCPATH,"/");
							$file_name =$details['name'].'_'.$details['u_id'].time().'.pdf';
							$pdfFilePath = $path."/assets/fee_invoices/".$file_name;
							ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$html =$this->load->view('student/invoice',$data, true); // render the view into HTML
							//echo '<pre>';print_r($html);exit;
							$this->load->library('pdf');
							$pdf = $this->pdf->load();
							$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$pdf->SetDisplayMode('fullpage');
							$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
							$pdf->WriteHTML($html); // write the HTML into the PDF
							$pdf->Output($pdfFilePath, 'F');
							
							$pay_details=array(
							's_id'=>isset($post['u_id'])?$post['u_id']:'',
							'school_id'=>isset($school_details['s_id'])?$school_details['s_id']:'',
							'class_name'=>isset($details['class_name'])?$details['class_name']:'',
							'roll_number'=>isset($details['roll_number'])?$details['roll_number']:'',
							'fee_amount'=>isset($details['fee_amount'])?$details['fee_amount']:'',
							'fee_terms'=>isset($details['fee_terms'])?$details['fee_terms']:'',
							'pay_amount'=>isset($post['pay_amount'])?$post['pay_amount']/100:'',
							'razorpay_payment_id'=>isset($post['razorpay_payment_id'])?$post['razorpay_payment_id']:'',
							'razorpay_order_id'=>isset($post['razorpay_order_id'])?$post['razorpay_order_id']:'',
							'razorpay_signature'=>isset($post['razorpay_signature'])?$post['razorpay_signature']:'',
							'invoice'=>isset($file_name)?$file_name:'',
							'status'=>1,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$login_details['u_id'],
							);
							$save=$this->Student_model->save_student_fee_payment($pay_details);
							$this->email->set_newline("\r\n");
							$this->email->from('admin@prachaedu.com');
							$this->email->to($details['email']);
							$this->email->subject($details['name'].'Fee Inovice');
							$this->email->message('Please find out below attachment');
							$this->email->attach($pdfFilePath);
							$this->email->send();
							//echo $this->db->last_query();exit;
							redirect('payment/complete/'.base64_encode($save));
							
				}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('home');
				}
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('home');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function complete(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3){
		$inv_id=base64_decode($this->uri->segment(3));
		$data['invoice_detail']=$this->Student_model->get_invoice_details($inv_id);
		$this->load->view('student/payment_success',$data);
		}else if($login_details['role_id']==7){
		$inv_id=base64_decode($this->uri->segment(3));
		$data['invoice_detail']=$this->Student_model->get_invoice_details($inv_id);
		$this->load->view('student/student_payment_success',$data);	
		}				
	}else{
	$this->session->set_flashdata('error','Please login to continue');
	redirect('home');
	}
}
	public  function refund(){
		
		$api_id= $this->config->item('keyId');
		$api_Secret= $this->config->item('API_keySecret');	
		$api = new RazorpayApi($api_id, $api_Secret);
		$payment = $api->payment->fetch('pay_9jcdNamZ0Rj5zJ');
		$refund = $payment->refund();
		//$refund = $payment->refund(array('amount' => 100)); 
		echo '<pre>';print_r($refund);exit;
		
	}
	public  function capture(){
		
		$api_id= $this->config->item('keyId');
		$api_Secret= $this->config->item('API_keySecret');	
		$api = new RazorpayApi($api_id, $api_Secret);
		$payment = $api->payment->fetch('pay_9jcdNamZ0Rj5zJ');
		$capture=$payment->capture();
		//$refund = $payment->refund(array('amount' => 100)); 
		//echo '<pre>';print_r($capture);exit;
		
	}
	public function buspay()
	{
		if($this->session->userdata('userdetails'))
		{
	  $login_details=$this->session->userdata('userdetails');
		$post=$this->input->post();
		//echo '<pre>';print_r($post);exit;
		$student_id=base64_decode($this->uri->segment(3));
     $detail=$this->Student_model->get_resources_details($login_details['u_id']);
     $details=$this->Student_model->get_student_bus_transport_details($detail['s_id'],$post['student_id']);	 
		$data['student_details']=$this->Student_model->get_student_bus_transport_details($detail['s_id'],$post['student_id']);
		$data['last_payment_details']=$this->Student_model->get_student_last_bus_payment_details($post['student_id']);
            
		if(isset($post['payment_type']) && $post['payment_type']==2){
							$data['details']=$details;
							$data['details']['payamount']=$post['amount'];
							if($post['payment_type']==2){
							$data['details']['payment_type']='Cash mode';
							}else if($post['payment_type']==1){
								$data['details']['payment_type']='Online';
							}
							$school_details=$this->Student_model->get_school_details_data($post['student_id']);
							$data['school_details']=$school_details;
							$path = rtrim(FCPATH,"/");
							$file_name =$details['name'].'_'.$details['student_id'].time().'.pdf';
							$pdfFilePath = $path."/assets/bus_invoices/".$file_name;
							ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$html =$this->load->view('student/bus_invoice',$data, true); // render the view into HTML
							//echo '<pre>';print_r($html);exit;
							$this->load->library('pdf');
							$pdf = $this->pdf->load();
							$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$pdf->SetDisplayMode('fullpage');
							$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
							$pdf->WriteHTML($html); // write the HTML into the PDF
							$pdf->Output($pdfFilePath, 'F');
							$pay_details=array(
							'student_id'=>isset($post['student_id'])?$post['student_id']:'',
							's_id'=>isset($details['s_id'])?$details['s_id']:'',
							's_t_id'=>isset($details['s_t_id'])?$details['s_t_id']:'',
							'class_name'=>isset($details['class_id'])?$details['class_id']:'',
							'roll_number'=>isset($details['roll_number'])?$details['roll_number']:'',
							'total_amount'=>isset($details['total_amount'])?$details['total_amount']:'',
							'pay_amount'=>isset($post['amount'])?$post['amount']:'',
							'invoice'=>isset($file_name)?$file_name:'',
							'status'=>1,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$login_details['u_id'],
							);
							$success=$this->Student_model->save_student_bus_payment($pay_details);
							if(count($success)>0){
									$this->session->set_flashdata('success',"Payment successfully completed");
									redirect('payment/completed/'.base64_encode($success));
							}else{
								$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
								redirect('transportation/student_transport_registration/'.base64_encode(1));
							}
		}else{
			
			if(count($details)>0){
				//echo '<pre>';print_r($details);exit;
					//exit;
					$data['user_details']=$details;
					$api_id=$this->config->item('keyId');
					$api_Secret=$this->config->item('API_keySecret');
					$api = new RazorpayApi($api_id,$api_Secret);
					//$api = new RazorpayApi($this->config->load('keyId'), $this->config->load('API_keySecret'));
					$orderData = [
							'receipt'         =>$details['student_id'] ,
							'amount'          => $post['amount']*100, // 2000 rupees in paise
							'currency'        => 'INR',
							'payment_capture' => 1 // auto capture
					];
					
					//echo '<pre>';print_r($orderData);exit;

						$razorpayOrder = $api->order->create($orderData);
						$razorpayOrderId = $razorpayOrder['id'];
						$displayAmount = $amount = $orderData['amount'];
						$displayCurrency=$orderData['currency'];
						$data['details'] = [
									"key"               => $api_id,
									"amount"            => $amount,
									"name"              => $details['username'],
									"description"       => $post['description'],
									"image"             => "",
									"prefill"           => [
									"name"              => $details['username'],
									"email"             => $details['parent_email'],
									"contact"           => $details['mobile'],
									],
									"notes"             => [
									"address"           => $details['address'],
									"merchant_order_id" => $details['u_id'],
									],
									"theme"             => [
									"color"             => "#F37254"
									],
									"order_id"          => $razorpayOrderId,
									"display_currency"          => $orderData['currency'],
						];
					
						$this->load->view('student/bus-pay',$data);
						$this->load->view('html/footer');
					
				}else{
					$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
					redirect('home');
				}
		
		}
		
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public  function bus_payment_success(){
	
		if($this->session->userdata('userdetails'))
		{
				
			$post=$this->input->post();
			//echo '<pre>';print_r($post);exit;
			if($post['student_id']!=''){
				$details=$this->Student_model->get_student_bus_transport_details($post['student_id']);
				$school_details=$this->Student_model->get_school_details_data($post['student_id']);
				//echo '<pre>';print_r($details);exit;
				if(count($details)>0){
			
							$post=$this->input->post();
							$data['details']=$details;
							$data['details']['payamount']=$post['pay_amount']/100;
							$data['school_details']=$school_details;
							$path = rtrim(FCPATH,"/");
							$file_name =$details['name'].'_'.$details['student_id'].time().'.pdf';
							$pdfFilePath = $path."/assets/bus_invoices/".$file_name;
							ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$html =$this->load->view('student/bus_invoice',$data, true); // render the view into HTML
							//echo '<pre>';print_r($html);exit;
							$this->load->library('pdf');
							$pdf = $this->pdf->load();
							$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
							$pdf->SetDisplayMode('fullpage');
							$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
							$pdf->WriteHTML($html); // write the HTML into the PDF
							$pdf->Output($pdfFilePath, 'F');
							
							$pay_details=array(
							'student_id'=>isset($post['student_id'])?$post['student_id']:'',
							's_id'=>isset($school_details['s_id'])?$school_details['s_id']:'',
							'class_name'=>isset($details['class_name'])?$details['class_name']:'',
							'roll_number'=>isset($details['roll_number'])?$details['roll_number']:'',
							'total_amount'=>isset($details['total_amount'])?$details['total_amount']:'',
							'pay_amount'=>isset($post['pay_amount'])?$post['pay_amount']/100:'',
							'razorpay_payment_id'=>isset($post['razorpay_payment_id'])?$post['razorpay_payment_id']:'',
							'razorpay_order_id'=>isset($post['razorpay_order_id'])?$post['razorpay_order_id']:'',
							'razorpay_signature'=>isset($post['razorpay_signature'])?$post['razorpay_signature']:'',
							'invoice'=>isset($file_name)?$file_name:'',
							'status'=>1,
							'create_at'=>date('Y-m-d H:i:s'),
							'create_by'=>$login_details['u_id'],
							);
							$save=$this->Student_model->save_student_bus_payment($pay_details);
							$this->email->set_newline("\r\n");
							$this->email->from('admin@prachaedu.com');
							$this->email->to($details['parent_email']);
							$this->email->subject($details['name'].'Fee Inovice');
							$this->email->message('Please find out below attachment');
							$this->email->attach($pdfFilePath);
							$this->email->send();
							//echo $this->db->last_query();exit;
							redirect('payment/completed/'.base64_encode($save));
							
				}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('home');
				}
			}else{
				$this->session->set_flashdata('error',"technical problem will occurred. Please try again.");
				redirect('home');
			}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	
	public function completed(){
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
			if($login_details['role_id']==3){
		$inv_id=base64_decode($this->uri->segment(3));
		$data['invoice_detail']=$this->Student_model->get_bus_invoice_details($inv_id);
		$this->load->view('student/bus_payment_success',$data);
		}				
	}else{
	$this->session->set_flashdata('error','Please login to continue');
	redirect('home');
	}
}
	
	
	
	
	
	
	
}
