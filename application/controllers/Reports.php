<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Reports extends In_frontend {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Student_model');
			$this->load->model('Reports_model');
	}
	
	public function index()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
			   $this->load->view('reports/reports');
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
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
			  $post=$this->input->post();
			  $detail=$this->School_model->get_resources_details($login_details['u_id']);
			  if(($post['reports_id']=='Fee Report')&& $post['reports_id']=='Fee Report'){
			$data['fee_reports']=$this->Reports_model->get_fee_reports_list($post['reports_id']=='Fee Report');
			   //echo'<pre>';print_r($data);exit;
			   $this->load->view('reports/fee-reports',$data);
			   $this->load->view('html/footer1');
			  }else if(($post['reports_id']=='Due Report')&& $post['reports_id']=='Due Report'){
			$data['due_reports']=$this->Reports_model->get_due_reports_list($post['reports_id']=='Due Report');
		   $this->load->view('reports/due-reports',$data);
            $this->load->view('html/footer1');
		}else if(($post['reports_id']=='Paid Report')&& $post['reports_id']=='Paid Report'){
		$data['paid_reports']=$this->Reports_model->get_paid_reports_list($post['reports_id']=='Paid Report');
		   $this->load->view('reports/paid-reports',$data);
            $this->load->view('html/footer1');	
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
	
	public function feeprint(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==3){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
		//$filename=$emp_id;
		$data['fee_reports']=$this->Reports_model->get_fee_reports_list();
		//echo'<pre>';print_r($data);exit;
		$path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                
					$data['page_title'] = $data['fee_reports']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/fee_report/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('reports/fee_reports_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/fee_report/".$file_name);
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	public function dueprint(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==3){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
		//$filename=$emp_id;
		$data['due_reports']=$this->Reports_model->get_due_reports_list();
		//echo'<pre>';print_r($data);exit;
		$path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                
					$data['page_title'] = $data['due_reports']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/due_report/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('reports/due_reports_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/due_report/".$file_name);
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	public function paidprint(){
	if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');

			if($login_details['role_id']==3){
				$detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$post=$this->input->post();
		//$filename=$emp_id;
		$data['paid_reports']=$this->Reports_model->get_paid_reports_list();
		//echo'<pre>';print_r($data);exit;
		$path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                
					$data['page_title'] = $data['paid_reports']['name'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/paid_report/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('reports/paid_reports_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/paid_report/".$file_name);
			}else{
					$this->session->set_flashdata('error',"You have no permission to access");
					redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error','Please login to continue');
			redirect('home');
		}
	}
	
	
	
	
	
	
	
	
	
	
	/*
	public function masterlist()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
               $filename = 'FEE AMOUNT'.date('Ymd').'.csv'; 
			   header("Content-Description: File Transfer"); 
			   header("Content-Disposition: attachment; filename=$filename"); 
			   header("Content-Type: application/csv; ");
			   // get data 
			    $detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$usersdata=$this->Reports_model->get_student_masterlist($detail['s_id']);
			          // echo'<pre>';print_r($usersdata);exit;				

			   // file creation 
			   $file = fopen('php://output', 'w');
				$header = array("STUDENT NAME","ADDRESS","PARIENT NAME","PHONE NO","FEE AMOUNT"); 
			   fputcsv($file, $header);
			   foreach ($usersdata as $key=>$line){ 
				 fputcsv($file,$line); 
			   }
			   fclose($file); 
			   exit; 

				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function due()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){	
				
				
               $filename = 'DUE AMOUNT'.date('Ymd').'.csv'; 
			   header("Content-Description: File Transfer"); 
			   header("Content-Disposition: attachment; filename=$filename"); 
			   header("Content-Type: application/csv; ");
			   // get data 
			    $detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$usersdata=$this->Reports_model->get_student_due_reports($detail['s_id']);
			     //echo'<pre>';print_r($usersdata);exit;
			   // file creation 
			   $file = fopen('php://output', 'w');
				$header = array("STUDENT NAME","ADDRESS","PARIENT NAME","PHONE NO","DUE AMOUNT","FEE AMOUNT"); 
			   fputcsv($file, $header);
			   foreach ($usersdata as $key=>$line){ 
				 fputcsv($file,$line); 
			   }
			   fclose($file); 
			   exit; 

				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	public function paid()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==3){
					
               $filename = 'PAID AMOUNT'.date('Ymd').'.csv'; 
			   header("Content-Description: File Transfer"); 
			   header("Content-Disposition: attachment; filename=$filename"); 
			   header("Content-Type: application/csv; ");
			   // get data 
			  $detail=$this->Student_model->get_resources_details($login_details['u_id']);
				$usersdata=$this->Reports_model->get_student_paid_reports($detail['s_id']);	
				//echo'<pre>';print_r($usersdata);exit;
			   // file creation 
			   $file = fopen('php://output', 'w');
				$header = array("STUDENT NAME","ADDRESS","PARIENT NAME","PHONE NO","PAID AMOUNT","TOTAL AMOUNT","BALANCE AMOUNT"); 
			   fputcsv($file, $header);
			   foreach ($usersdata as $key=>$line){ 
				 fputcsv($file,$line); 
			   }
			   fclose($file); 
			   exit; 

				}else{
						$this->session->set_flashdata('error',"you don't have permission to access");
						redirect('dashboard');
				}
		}else{
			$this->session->set_flashdata('error',"you don't have permission to access");
			redirect('home');
		}
	}
	*/
	
	
	
}	
