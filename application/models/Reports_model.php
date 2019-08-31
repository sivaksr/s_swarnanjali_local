<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports_model extends CI_Model 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function get_student_masterlist($s_id){
	$this->db->select('users.name,users.address,users.parent_name,users.mobile,users.mobile,student_fee.fee_amount')->from('student_fee');
	$this->db->join('users ', 'users.u_id = student_fee.s_id', 'left');
	$this->db->where('student_fee.status',1);
	$this->db->group_by('student_fee.s_id');
	$this->db->where('student_fee.school_id',$s_id);
	return $this->db->get()->result_array();
	}
	public function get_student_due_reports($s_id){
	$this->db->select('users.name,users.address,users.parent_name,users.mobile,users.mobile,SUM(student_fee.pay_amount) as due_amount,student_fee.fee_amount')->from('student_fee');
	$this->db->join('users ', 'users.u_id = student_fee.s_id', 'left');
	$this->db->where('student_fee.status',1);
	$this->db->group_by('student_fee.s_id');
	$this->db->where('student_fee.school_id',$s_id);
	return $this->db->get()->result_array();
	}
	public function get_student_paid_reports($s_id){
	$this->db->select('users.name,users.address,users.parent_name,users.mobile,users.mobile,SUM(student_fee.pay_amount) as due_amount,student_fee.fee_amount,(student_fee.fee_amount-(SUM(student_fee.pay_amount)))as blance_amount')->from('student_fee');
	$this->db->join('users ', 'users.u_id = student_fee.s_id', 'left');
	$this->db->where('student_fee.status',1);
	$this->db->group_by('student_fee.s_id');
	$this->db->where('student_fee.school_id',$s_id);
	return $this->db->get()->result_array();
	}
	
	
	public function get_fee_reports_list(){
	$this->db->select('class_list.name as class_name,class_list.section,users.name,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,users.parent_name,users.mobile,users.mobile,student_fee.fee_amount')->from('student_fee');
	$this->db->join('users ', 'users.u_id = student_fee.s_id', 'left');
	$this->db->join('class_list ', 'class_list.id = student_fee.class_name', 'left');
	$this->db->where('student_fee.status',1);
	$this->db->group_by('student_fee.s_id');
	return $this->db->get()->result_array();
	}
	public function get_due_reports_list(){
	$this->db->select('class_list.name as class_name,class_list.section,users.name,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,users.parent_name,users.mobile,users.mobile,(student_fee.fee_amount-(SUM(student_fee.pay_amount))) as due_amount,student_fee.fee_amount')->from('student_fee');
	$this->db->join('users ', 'users.u_id = student_fee.s_id', 'left');
	$this->db->join('class_list ', 'class_list.id = student_fee.class_name', 'left');
	$this->db->where('student_fee.status',1);
	$this->db->group_by('student_fee.s_id');
	return $this->db->get()->result_array();	
	}
	public function get_paid_reports_list(){
	$this->db->select('class_list.name as class_name,class_list.section,users.name,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,users.parent_name,users.mobile,users.mobile,SUM(student_fee.pay_amount) as due_amount,student_fee.fee_amount,(student_fee.fee_amount-(SUM(student_fee.pay_amount)))as blance_amount')->from('student_fee');
	$this->db->join('users ', 'users.u_id = student_fee.s_id', 'left');
	$this->db->join('class_list ', 'class_list.id = student_fee.class_name', 'left');
	$this->db->where('student_fee.status',1);
	$this->db->group_by('student_fee.s_id');
	return $this->db->get()->result_array();	
	}
	
	
	
	
	
	
	
	
}
