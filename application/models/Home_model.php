<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function login_details($email,$password){
	$sql = "SELECT u_id,email FROM users WHERE (email ='".$email."' AND password='".$password."'  AND status='1' AND role_id!='7') OR (parent_email ='".$email."' AND parent_password='".$password."' AND status='1' AND role_id='7' ) OR (mobile ='".$email."' AND parent_password='".$password."' AND status='1' AND role_id='7' )";
	return $this->db->query($sql)->row_array();	
	}
	/*
	public function login_details($email,$pass){
		$this->db->select('*')->from('users');
		$this->db->where('email',$email);
		$this->db->where('password',$pass);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	*/
	public function get_login_details($u_id){
		$this->db->select('users.u_id,users.role_id,users.status')->from('users');
		$this->db->where('u_id',$u_id);
		return $this->db->get()->row_array();	
	}
	public function get_all_admin_details($u_id){
		$this->db->select('users.*,role.name as role_name,schools.scl_bas_name')->from('users');
		$this->db->join('role', 'role.id = users.role_id', 'left');
		$this->db->join('schools', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();	
	}
	public  function check_email_mobile_exits($email,$mobile){
		$this->db->select('parent_email,mobile')->from('users');
		$this->db->where('parent_email',$email);
		$this->db->where('mobile',$mobile);
		$this->db->where('role_id',7);
		return $this->db->get()->row_array();
	}
	public  function check_email_exits($email){
		$this->db->select('parent_email')->from('users');
		$this->db->where('parent_email',$email);
		$this->db->where('role_id',7);
		return $this->db->get()->row_array();
	}
	public  function check_emails_exits($email){
		$this->db->select('users.u_id,users.email,users.org_password')->from('users');
		$this->db->where('users.email',$email);
		$this->db->where('users.status',1);
		return $this->db->get()->row_array();
	}
	public function check_email_or_mobile_exits($email){
	$this->db->select('users.u_id,users.mobile,users.parent_email,users.parent_org_password')->from('users');
		$this->db->or_where('users.parent_email',$email);
		$this->db->or_where('users.mobile',$email);
		$this->db->where('users.status',1);
		return $this->db->get()->row_array();
	}
	
	
	
	
	public  function check_mobile_exits($mobile){
		$this->db->select('mobile')->from('users');
		$this->db->where('mobile',$mobile);
		$this->db->where('role_id',7);
		return $this->db->get()->row_array();
	}
	public  function update_profile_details($u_id,$data){
		$this->db->where('u_id',$u_id);
    	return $this->db->update("users",$data);
	}
	
	public  function get_roles_list(){
		$this->db->select('id,name')->from('role');
		$this->db->where('id!=',1);
		$this->db->where('id!=',2);
		$this->db->where('id!=',7);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public  function get_all_roles_list(){
		$this->db->select('id')->from('role');
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public  function save_event($data){
		$this->db->insert('events',$data);
		return $this->db->insert_id();
	}
	public  function get_event_list($a_id,$s_id){
		$this->db->select('*')->from('events');
		$this->db->or_where_in('create_by',$a_id);
		$this->db->or_where_in('s_id',$s_id);
		$this->db->where('status',1);
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	}
	
	
	public  function save_calendar_event($data){
		$this->db->insert('calendar_events',$data);
		return $this->db->insert_id();
	}
	
	public  function remove_event($id){
		$this->db->where('id',$id);
		return $this->db->delete('events');
	}
	public  function delete_calendar_event($id){
		$this->db->where('c_id',$id);
		return $this->db->delete('calendar_events');
	}
	
	public  function check_save_calendar_exist($s_id,$event_id,$date,$u_id){
		$this->db->select('*')->from('calendar_events');
		$this->db->where('create_by',$u_id);
		$this->db->where('s_id',$s_id);
		$this->db->where('event_id',$event_id);
		$this->db->where('event_date',$date);
		return $this->db->get()->row_array();
	}
	public  function get_calendar_event_list($a_id,$s_id){
		$this->db->select('title,color,event_date,event_id,c_id')->from('calendar_events');
		$this->db->or_where_in('create_by',$a_id);
		$this->db->or_where_in('s_id',$s_id);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public  function get_school_calendar_event_list($s_id){
		$this->db->select('title,color,event_date,event_id,c_id')->from('calendar_events');
		$this->db->where('s_id',$s_id);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public  function get_student_list($s_id){
		$this->db->select('count(users.u_id) as total_count')->from('users');
		//echo $s_id;
		if($s_id!=''){
			$this->db->where('s_id',$s_id);
		}
		$this->db->where('status',1);
		$this->db->where('role_id',7);
		return $this->db->get()->row_array();
	}
	public  function get_teachers_list($s_id){
		
		$this->db->select('count(users.u_id) as total_count')->from('users');
		if($s_id!=''){
			$this->db->where('s_id',$s_id);
		}
		$this->db->where('status',1);
		$this->db->where('role_id',6);
		return $this->db->get()->row_array();
	}
	public  function get_get_teachers_list($s_id){
		$this->db->select('SUM(student_fee.pay_amount) as total_count')->from('student_fee');
		if($s_id!=''){
			$this->db->where('school_id',$s_id);
		}
		return $this->db->get()->row_array();
	}
	
	public  function get_notification_list($u_id){
		$this->db->select('int_id,s_id,comment,create_at')->from('announcements');
		$this->db->where('s_id',$u_id);
		$this->db->where('status',1);
		$this->db->order_by('int_id',"desc");
		return $this->db->get()->result_array();
	}
	public  function get_notification_unread_count($u_id){
		$this->db->select('count(announcements.int_id) as count')->from('announcements');
		$this->db->where('s_id',$u_id);
		$this->db->where('status',1);
		$this->db->where('readcount',0);
		return $this->db->get()->row_array();
	}
	public  function get_resources_notification_list($u_id){
		$this->db->select('int_id,comment,create_at')->from('schools_announcements');
		$this->db->where('res_id',$u_id);
		$this->db->where('status',1);
		$this->db->order_by('int_id',"desc");
		return $this->db->get()->result_array();
	}
	public  function get_resources_notification_unread_count($u_id){
		$this->db->select('count(schools_announcements.int_id) as count')->from('schools_announcements');
		$this->db->where('res_id',$u_id);
		$this->db->where('status',1);
		$this->db->where('readcount',0);
		return $this->db->get()->row_array();
	}
	
	

}