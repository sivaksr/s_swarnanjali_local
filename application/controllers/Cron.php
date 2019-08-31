<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	
	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		$this->load->model('Cron_model');
		
		}
		/*fee pending send  sms  cron */
		public  function send_fee_sms(){
			
			$student_list=$this->Cron_model->get_student_list();
					foreach($student_list as $list){
						$datetime1 = new DateTime($list['last_pay_date']);
						$datetime2 = new DateTime(date('Y-m-d H:i:s'));
						$interval = $datetime1->diff($datetime2);
						$date_inverval=$interval->m;
						$working_month = (int) filter_var($list['working_month'], FILTER_SANITIZE_NUMBER_INT);
						if($list['fee_terms']==2  && $list['working_month']!=''){
							$month= ($working_month )/($list['fee_terms']);
								$date1 = strtotime("+3 day");
								$paydata=date('M d, Y', $date1);
								$date = date('Y-m-d');
								$newdate = strtotime ( '+'.$month.' month' , strtotime ( $date ) ) ;
								$newdate = date ( 'M d, Y' , $newdate );
								$nextpaydata=date('M d, Y', $date1);
								$address=$list['scl_bas_name'].', '.$list['scl_bas_add1'].','.$list['scl_bas_add2'].','.$list['scl_bas_city'].','.$list['scl_bas_state'].'.';
								$msg= 'Dear Parent, you are requested to pay the school fees before .'.$paydata.'. Ignore if already paid. -'.$address;
								if($date_inverval > $month ){
									$username=$this->config->item('smsusername');
									$pass=$this->config->item('smspassword');
									$mobilesno=$list['mobile'];
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL,"http://bhashsms.com/api/sendmsg.php");
									curl_setopt($ch, CURLOPT_POST, 1);
									curl_setopt($ch, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender=cartin&phone='.$mobilesno.'&text='.$msg.'&priority=ndnd&stype=normal');
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									//echo '<pre>';print_r($ch);exit;
									$server_output = curl_exec ($ch);
								}
								
							}else if($list['fee_terms']>2  && $list['working_month']!=''){
									$month= ($working_month )/($list['fee_terms']);
							
								$date1 = strtotime("+3 day");
								$paydata=date('M d, Y', $date1);
								$date = date('Y-m-d');
								$newdate = strtotime ( '+'.$month.' month' , strtotime ( $date ) ) ;
								$newdate = date ( 'M d, Y' , $newdate );
								$nextpaydata=date('M d, Y', $date1);
								$address=$list['scl_bas_name'].', '.$list['scl_bas_add1'].','.$list['scl_bas_add2'].','.$list['scl_bas_city'].','.$list['scl_bas_state'].'.';
								$msg= 'Your ward’s next fee installment is due on '.$newdate.'. Kindly pay before '.$nextpaydata.'. Ignore if already paid. -'.$address;
								
								if($date_inverval > $month ){
									$username=$this->config->item('smsusername');
									$pass=$this->config->item('smspassword');
									$mobilesno=$list['mobile'];
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL,"http://bhashsms.com/api/sendmsg.php");
									curl_setopt($ch, CURLOPT_POST, 1);
									curl_setopt($ch, CURLOPT_POSTFIELDS,'user='.$username.'&pass='.$pass.'&sender=cartin&phone='.$mobilesno.'&text='.$msg.'&priority=ndnd&stype=normal');
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									//echo '<pre>';print_r($ch);exit;
									$server_output = curl_exec ($ch);
							}
								
						}
					
					
				}
				
				//echo '<pre>';print_r($list);
				
	}
			
			//echo '<pre>';print_r($student_list);
		
	
	
	
	
}
