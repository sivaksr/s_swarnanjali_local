<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@include_once( APPPATH . 'controllers/In_frontend.php');
class Bonafidecatecertificate extends In_frontend {
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
					$data['details']=$this->Principal_model->get_bonefi_certificate_format($detail['s_id']);
					//echo '<pre>';print_r($post);exit;
					$this->load->view('bonafidecatecertificate/add',$data);
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
				$save_data=array(
				's_id'=>isset($detail['s_id'])?$detail['s_id']:'',
				'title'=>isset($post['title'])?$post['title']:'',
				'adminssion_number'=>isset($post['adminssion_number'])?$post['adminssion_number']:'',
				'paragraph'=>isset($post['paragraph'])?$post['paragraph']:'',
				'status'=>1,
				'create_at'=>date('Y-m-d H:i:s'),
				'create_by'=>$login_details['u_id'],
				);
				$details=$this->Principal_model->get_bonefi_certificate_format($detail['s_id']);
				if(count($details)>0){
		      $upadte=$this->Principal_model->update_bonefi_certificate_format($save_data);
		      }else{
				$save=$this->Principal_model->save_bonefi_certificate($save_data);	
	          }
                if(count($save)>0){
					$this->session->set_flashdata('success',"bonafidecatecertificate format successfully added.");
					redirect('bonafidecatecertificate');
				}else{
					$this->session->set_flashdata('success',"bonafidecatecertificate format successfully updated.");
					redirect('bonafidecatecertificate');
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
	
	public function prints()
	{	
		if($this->session->userdata('userdetails'))
		{
			$login_details=$this->session->userdata('userdetails');
				if($login_details['role_id']==12){
					$detail=$this->School_model->get_resources_details($login_details['u_id']);
					$data['details']=$this->Principal_model->get_bonefi_certificate_format_print($detail['s_id']);
					//echo '<pre>';print_r($data);exit;
					$path = rtrim(FCPATH,"/");
					$file_name = '22'.'12_11.pdf';                 
					$data['page_title'] = $data['details']['title'].'invoice'; // pass data to the view
					$pdfFilePath = $path."/assets/bonafide_catecertificate/".$file_name;
					ini_set('memory_limit','320M'); // boost the memory limit if it's low <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$html = $this->load->view('bonafidecatecertificate/bonaficatecertificate_pdf', $data, true); // render the view into HTML
					//echo '<pre>';print_r($html);exit;
					$this->load->library('pdf');
					$pdf = $this->pdf->load();
					$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date('M-d-Y')); // Add a footer for good measure <img src="https://s.w.org/images/core/emoji/72x72/1f609.png" alt="??" draggable="false" class="emoji">
					$pdf->SetDisplayMode('fullpage');
					$pdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
					$pdf->WriteHTML($html); // write the HTML into the PDF
					$pdf->Output($pdfFilePath, 'F');
					redirect("assets/bonafide_catecertificate/".$file_name);
					
					
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