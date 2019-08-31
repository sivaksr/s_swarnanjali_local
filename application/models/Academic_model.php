<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Academic_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public  function get_school_basic_details($u_id){
		$this->db->select('users.u_id,users.role_id,users.s_id,name,schools.scl_bas_email,schools.scl_bas_add1,schools.scl_bas_add2,schools.scl_bas_zipcode,schools.scl_bas_city,schools.scl_bas_state,schools.scl_bas_country,schools.scl_bas_logo,schools.scl_bas_name,schools.scl_bas_contact')->from('users');
		$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
	public  function get_class_list_school_wise($school_id){
		$this->db->select('*')->from('class_list');
		$this->db->where('class_list.s_id',$school_id);
		$this->db->where('class_list.status',1);
		return $this->db->get()->result_array();
	}
	public  function get_school_class_times_list($s_id){
		$this->db->select('*')->from('class_times');
		$this->db->where('class_times.s_id',$s_id);
		$this->db->where('class_times.status',1);
		$this->db->order_by('class_times.id','asc');
		return $this->db->get()->result_array();
	}
	
	public function get_student_attendance_report($class_id,$date){
		$this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as time,users.u_id,users.name,users.roll_number,student_attendenc_reports.time as times,student_attendenc_reports.attendence,student_attendenc_reports.student_id,student_attendenc_reports.class_id,class_list.name as classname,class_list.section')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_times ', 'class_times.id = student_attendenc_reports.time', 'left');
		$this->db->join('class_list ', 'class_list.id = student_attendenc_reports.class_id', 'left');
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);
		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		//$this->db->group_by('student_attendenc_reports.time');
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			
			$hours=$this->get_hours_wise_attendance_report($list['u_id'],$date);
			$data[$list['u_id']]=$list;
			$data[$list['u_id']]['hours_list']=$hours;
		}
		//echo '<pre>';print_r($return);exit;
		if(!empty($data)){
			return $data;
		}
		
	}
	public function get_hours_wise_attendance_report($id,$date){
		$this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as time,users.name,users.roll_number,student_attendenc_reports.time as times,student_attendenc_reports.attendence,student_attendenc_reports.student_id,student_attendenc_reports.class_id,class_list.name as classname,class_list.section')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_times ', 'class_times.id = student_attendenc_reports.time', 'left');
		$this->db->join('class_list ', 'class_list.id = student_attendenc_reports.class_id', 'left');
		$this->db->where('student_attendenc_reports.student_id',$id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);

		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		return $this->db->get()->result_array();
	}
	 
	 public function get_student_attendance_reports($class_id,$date){
		$this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as time,users.u_id,users.name,users.roll_number,student_attendenc_reports.time as times,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_times ', 'class_times.id = student_attendenc_reports.time', 'left');
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);
		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		//$this->db->group_by('student_attendenc_reports.time');
		$return=$this->db->get()->row_array();
		$hours_lists=$this->get_hours_wise_attendance_reports($return['u_id'],$date);
		$data=$return;
		$data['hours']=$hours_lists;
		if(!empty($data)){
			return $data;
		}
	}
	
	public function get_hours_wise_attendance_reports($id,$date){
		$this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as time,users.name,users.roll_number,student_attendenc_reports.time as times,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_times ', 'class_times.id = student_attendenc_reports.time', 'left');
		$this->db->where('student_attendenc_reports.student_id',$id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);

		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		return $this->db->get()->result_array();
	}
	 
		public  function get_school_id($u_id){
		$this->db->select('u_id,s_id')->from('users');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
		}
		
	 public  function student_count_list($s_id){
		$this->db->select('count(users.u_id) as stu_count')->from('users');
		$this->db->where('users.s_id',$s_id);
		$this->db->where('status',1);
		$this->db->where('role_id',7);
		return $this->db->get()->row_array();
		} 
		
		public function parent_count_list($s_id){
			$this->db->select('count(users.u_id) as person_count')->from('users');
		$this->db->where('users.s_id',$s_id);
		$this->db->where('status',1);
		$this->db->where('role_id',7);
		return $this->db->get()->row_array();
		}
	
		public  function fee_amount_list($s_id){
		$this->db->select('SUM(pay_amount) as total_amount')->from('student_fee');
		$this->db->where('student_fee.school_id',$s_id);
		return $this->db->get()->row_array();
		}
	 
	 /* Student Transport Registration*/
	
	 
	 

}