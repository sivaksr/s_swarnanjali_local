<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	
	public  function get_student_list(){
		$this->db->select('users.u_id,users.name,users.email,users.gender,users.doj,users.mobile,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,users.class_name,users.roll_number,parent_name,users.status,users.create_at,users.fee_amount,users.fee_terms,users.pay_amount,schools.working_month,schools.s_id as school_id,schools.scl_bas_add1,schools.scl_bas_add2,schools.scl_bas_zipcode,schools.scl_bas_city,schools.scl_bas_state,schools.scl_bas_country,schools.scl_bas_name')->from('users');
		$this->db->join('schools', 'schools.s_id = users.s_id', 'left');

		//$this->db->where('create_by',$u_id);
		$this->db->order_by('u_id',"DESC");
		$this->db->where('users.role_id',7);
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			$pay_amt=$this->get_student_data($list['u_id']);
			$pay_last_date=$this->get_student_last_fee_payment($list['u_id']);
			$data[$list['u_id']]= $list;
			$data[$list['u_id']]['pay_amt']=isset($pay_amt['0']['total_pay'])?$pay_amt['0']['total_pay']:'';
			$data[$list['u_id']]['last_pay_date']=isset($pay_last_date['create_at'])?$pay_last_date['create_at']:'';
		}
		if(!empty($data)){
			return $data;
		}
	}
	
	public  function get_student_data($id){
		$this->db->select('SUM(student_fee.pay_amount) as total_pay')->from('student_fee');
		$this->db->where('s_id',$id);
		return $this->db->get()->result_array();
	}
	
	public function get_student_last_fee_payment($id){
		$this->db->select('create_at')->from('student_fee');
		$this->db->where('s_id',$id);
		$this->db->order_by('p_id',"DESC");
		return $this->db->get()->row_array();
	}
	/* student  fe  payment purpose*/
	public function save_student_fee_payment($data){
		$this->db->insert('student_fee',$data);
		return $this->db->insert_id();
	}
	
	/* student  fe  payment purpose*/
	
	
	
	
	
	

}