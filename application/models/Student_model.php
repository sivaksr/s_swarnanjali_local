<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function save_student($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	public  function check_email_mobile_exist($parent_email,$mobile){
		$this->db->select('parent_email,mobile')->from('users');
		$this->db->where('users.parent_email',$parent_email);
		$this->db->or_where('users.mobile',$mobile);
		return $this->db->get()->row_array();
	}
	public function update_admission_number($id,$data){
	$this->db->where('u_id', $id);
		return $this->db->update('users', $data);
	}
	public  function get_student_list($u_id){
		$this->db->select('users.u_id,users.bus_transport,users.parent_email,users.name,users.email,users.gender,users.doj,users.mobile,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,users.roll_number,users.parent_name,users.status,users.create_at,users.fee_amount,users.fee_terms,users.pay_amount,CONCAT(class_list.name,"-", class_list.section) as class_name')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->where('users.s_id',$u_id);
		$this->db->where('role_id',7);
		$this->db->order_by('users.u_id',"DESC");
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			$pay_amt=$this->get_student_data($list['u_id']);
			$data[$list['u_id']]= $list;
			$data[$list['u_id']]['pay_amt']=isset($pay_amt['0']['total_pay'])?$pay_amt['0']['total_pay']:'';
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
	
	
	
	
	public  function get_student_wise_list($u_id){
		$this->db->select('users.u_id,users.s_id,users.parent_email,users.name,users.email,users.gender,users.doj,users.mobile,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,users.roll_number,users.parent_name,users.status,users.create_at,users.fee_amount,users.fee_terms,users.pay_amount,CONCAT(class_list.name,"-", class_list.section) as class_name')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->where('users.u_id',$u_id);
		$this->db->where('role_id',7);
		$this->db->order_by('users.u_id',"DESC");
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			$pay_amt=$this->get_student_wise_data($list['u_id']);
			$data[$list['u_id']]= $list;
			$data[$list['u_id']]['pay_amt']=isset($pay_amt['0']['total_pay'])?$pay_amt['0']['total_pay']:'';
		}
		if(!empty($data)){
			return $data;
		}
	}
	
	public  function get_student_wise_data($id){
		$this->db->select('SUM(student_fee.pay_amount) as total_pay')->from('student_fee');
		$this->db->where('s_id',$id);
		return $this->db->get()->result_array();
	}
	
	
	
	
	
	
	
	
	public  function delete_student($u_id){
		
		$this->db->where('u_id',$u_id);
		return $this->db->delete('users');
	}
	public  function delete_student_fee($s_id){
		$this->db->where('s_id',$s_id);
		$this->db->set('status','2');
		return $this->db->delete('student_fee');
	}
	function get_student_details($u_id){
		$this->db->select('schools.scl_bas_name,schools.scl_bas_add1,schools.scl_bas_logo,users.*,class_list.name as classname,class_list.section')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$u_id);
		$return=$this->db->get()->row_array();
		$lists=$this->get_student_fee_details($return['u_id']);
		$data=$return;
		$data['payment_details']=$lists;
		if(!empty($data)){
			return $data;
		}
	}
	public  function get_student_fee_details($u_id){
		$this->db->select('SUM(student_fee.pay_amount)as pay ,student_fee.*,(student_fee.fee_amount-(SUM(student_fee.pay_amount)))as due_amount')->from('student_fee');
		$this->db->where('student_fee.s_id',$u_id);
		$this->db->where('student_fee.status',1);
		return $this->db->get()->result_array();
	}
	
	function get_resources_details($u_id){
		$this->db->select('u_id,role_id,s_id,name,email')->from('users');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
	function get_school_class_list($s_id){
		$this->db->select('class_list.id,class_list.name,class_list.section')->from('class_list');
		$this->db->where('s_id',$s_id);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	
	
	
	/* student  fe  payment purpose*/
	public function save_student_fee_payment($data){
		$this->db->insert('student_fee',$data);
		return $this->db->insert_id();
	}
	public function get_invoice_details($id){
		$this->db->select('p_id,invoice')->from('student_fee');
		$this->db->where('p_id',$id);
		return $this->db->get()->row_array();
	}
	
	public  function get_student_last_payment_details($s_id){
		$this->db->select('*')->from('student_fee');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->result_array();
	}
	
	public  function get_school_details($u_id){
		$this->db->select('users.u_id,users.role_id,users.s_id,name,schools.scl_bas_email,schools.scl_bas_add1,schools.scl_bas_add2,schools.scl_bas_zipcode,schools.scl_bas_city,schools.scl_bas_state,schools.scl_bas_country,schools.scl_bas_logo,schools.scl_bas_name,schools.scl_bas_contact')->from('users');
		$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
	/* student  fe  payment purpose*/
	
	/* tracher login*/
	public  function get_teacher_wise_student_list($u_id){
		$this->db->select('time_slot.*,class_list.name,class_list.section')->from('time_slot');
		$this->db->join('class_list ', 'class_list.id = time_slot.class_id', 'left');
		$this->db->where('time_slot.teacher',$u_id);
		$this->db->where('time_slot.status',1);
		$this->db->group_by('time_slot.class_id');
		return $this->db->get()->result_array();
	}
	
	public  function get_teacher_wise_class_list($u_id){
		$this->db->select('class_list.id as class_id,class_list.name,class_list.section')->from('time_slot');
		$this->db->join('class_list ', 'class_list.id = time_slot.class_id', 'left');
		$this->db->where('time_slot.teacher',$u_id);
		$this->db->where('time_slot.status',1);
		$this->db->group_by('time_slot.class_id');
		return $this->db->get()->result_array();
	}
	
	public  function get_class_wise_student_list($class_id){
		$this->db->select('class_list.name as classname,class_list.section,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,users.u_id,users.name,users.roll_number,users.parent_name,users.mobile,users.email,users.parent_email')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->where('users.class_name',$class_id);
		$this->db->where('users.role_id',7);
		$this->db->where('users.status',1);
		return $this->db->get()->result_array();
	}
	
	
	/*
	public  function get_class_wise_student_list($class_id,$teacher_id){
		$this->db->select('*')->from('time_slot');
		$this->db->join('users ', 'users.class_name = time_slot.class_id', 'left');
		$this->db->where('time_slot.teacher',$teacher_id);
		$this->db->where('users.class_name',$class_id);
		$this->db->where('users.role_id',7);
		return $this->db->get()->result_array();
	}
	*/
	
	public  function get_teacher_class_subjects($class_id,$teacher_id){
		$this->db->select('class_subjects.id,class_subjects.subject as subjects,time_slot.subject')->from('time_slot');
		$this->db->join('class_subjects ', 'class_subjects.id = time_slot.subject', 'left');
		$this->db->where('time_slot.teacher',$teacher_id);
		$this->db->where('time_slot.class_id',$class_id);
		$this->db->group_by('time_slot.subject');
		return $this->db->get()->result_array();
	}
	public function get_subject_wise_timings($subjects,$teacher_id){
	$this->db->select('time_slot.time,time_slot.id,concat(class_times.form_time,"-	",class_times.to_time) as timings')->from('time_slot');
		$this->db->join('class_times ', 'class_times.id = time_slot.time', 'left');
		$this->db->where('time_slot.teacher',$teacher_id);
		$this->db->where('time_slot.subject',$subjects);
		$this->db->group_by('time_slot.time');
		return $this->db->get()->result_array();
	}
	public function get_classes(){
	$this->db->select('time_slot.class_id,time_slot.id')->from('time_slot');
	$this->db->where('time_slot.status',1);
	$this->db->group_by('time_slot.class_id');
	return $this->db->get()->result_array();
	}
	
	
	public  function get_class_wise_subjectwise_student_list($class_id){
		$this->db->select('class_list.name as classname,class_list.section,users.u_id,users.name,users.roll_number,users.class_name')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->where('users.class_name',$class_id);
		$this->db->where('users.role_id',7);
	return $this->db->get()->result_array();
	}
	  
	 public function get_student_attendeance_update($class_id,$time){
	   $this->db->select('*')->from('student_attendenc_reports');
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		//$this->db->where('student_attendenc_reports.subject_id',$subjects);
		$this->db->where('student_attendenc_reports.time',$time);
		//$this->db->where('student_attendenc_reports.teacher_id',$teacher);
		return $this->db->get()->result_array();
	}
	  
	  /*
	  
	  foreach($return as $list){
	   $lists=$this->get_student_attendeance_update($list['class_name']);
	   //echo '<pre>';print_r($lists);exit;
	   $data[$list['class_name']]=$list;
	   $data[$list['class_name']]['attendence_list']=$lists;
	   
	  }
	if(!empty($data)){
	   
	   return $data;
	   
	  }
 }
	
	public function get_student_attendeance_update($class_name){
	$this->db->select('student_attendenc_reports.*')->from('student_attendenc_reports');
		$this->db->where('student_attendenc_reports.class_id',$class_name);
		return $this->db->get()->result_array();
	}
	*/
	
	public   function get_subject_name($subject_id){
		$this->db->select('class_subjects.subject,class_subjects.id')->from('time_slot');
		$this->db->join('class_subjects ', 'class_subjects.id = time_slot.subject', 'left');
		$this->db->where('time_slot.subject',$subject_id);
		return $this->db->get()->row_array();
	}
	public function get_class_timings($time){
	$this->db->select('class_times.id,concat(class_times.form_time,"- ",class_times.to_time) as time')->from('time_slot');
	$this->db->join('class_times ', 'class_times.id = time_slot.time', 'left');
		$this->db->where('time_slot.time',$time);
		return $this->db->get()->row_array();
	}
	public  function save_student_attendance($data){
		$this->db->insert("student_attendenc_reports",$data);
		return $this->db->insert_id();
	}
	
	public  function get_basic_student_details($u_id){
		$this->db->select('users.u_id,users.mobile,users.name,schools.scl_bas_add1,schools.scl_bas_add2,schools.scl_bas_zipcode,schools.scl_bas_city,schools.scl_bas_state,schools.scl_bas_country,schools.scl_bas_name')->from('users');
		$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
	
	public  function get_previous_attendance_reports($student_id,$class_id,$subject_id,$time,$teacher){
		$this->db->select('*')->from('student_attendenc_reports');
		$this->db->where('student_attendenc_reports.student_id',$student_id);
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		$this->db->where('student_attendenc_reports.subject_id',$subject_id);
		$this->db->where('student_attendenc_reports.time',$time);
		$this->db->where('student_attendenc_reports.teacher_id',$teacher);
		return $this->db->get()->row_array();
	}
	public  function update_attendance($id,$data){
		$this->db->where('id',$id);
		return $this->db->update("student_attendenc_reports",$data);
		
	}
	
	public  function get_teacher_wise_time_list($id){
		$this->db->select('class_times.id,class_times.form_time,class_times.to_time')->from('time_slot');
		$this->db->join('class_times ', 'class_times.id = time_slot.time', 'left');
		$this->db->where('time_slot.teacher',$id);
		$this->db->group_by('time_slot.time');
		return $this->db->get()->result_array();
	}
	/* fee list*/
	
         public function class_wise_all_details($class_id){
	 $this->db->select('class_list.name,class_list.section,users.class_name,users.name as username,users.u_id,users.fee_amount,users.pay_amount,users.parent_name,users.mobile')->from('users');
		 $this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		 $this->db->where('users.class_name',$class_id);
		 $this->db->where('users.role_id',7);
		 $this->db->where('users.status',1);
		 return $this->db->get()->result_array(); 
	 }
	public function class_wise_time_slot_details($class_id){
	$this->db->select('teacher_modules.modules,class_subjects.subject as subjects,class_times.form_time,class_times.to_time,users.name as teachers,class_list.name,class_list.section,time_slot.*')->from('time_slot');
		 $this->db->join('class_list ', 'class_list.id = time_slot.class_id', 'left');
		 $this->db->join('users ', 'users.u_id = time_slot.teacher', 'left');
		 $this->db->join('class_times ', 'class_times.id = time_slot.time', 'left');
		 $this->db->join('teacher_modules ', 'teacher_modules.t_m_id = time_slot.teacher_module', 'left');
		 $this->db->join('class_subjects ', 'class_subjects.id = time_slot.subject', 'left');
		 $this->db->where('users.role_id',6);
		 $this->db->where('time_slot.class_id',$class_id);
		 $this->db->where('time_slot.status',1);
		 return $this->db->get()->result_array(); 
	 }
	
	/* home work */
	public function save_home_work_details($data){
	$this->db->insert('home_work',$data);
     return $this->db->insert_id();
	}	
	public function get_home_work_list($u_id,$s_id){
	$this->db->select('class_subjects.subject,class_list.name,class_list.section,home_work.*')->from('home_work');
		 $this->db->join('class_list ', 'class_list.id = home_work.class_id', 'left');
		 $this->db->join('class_subjects ', 'class_subjects.id = home_work.subjects', 'left');
		 $this->db->where('home_work.create_by',$u_id);
		 $this->db->where('home_work.s_id',$s_id);
		 $this->db->where('home_work.status!=',2);
		 return $this->db->get()->result_array(); 
	 }	
	public function get_edit_home_work($s_id,$h_w_id){
	$this->db->select('home_work.*')->from('home_work');
		 $this->db->join('class_list ', 'class_list.id = home_work.class_id', 'left');
		 $this->db->where('home_work.h_w_id',$h_w_id);
		 $this->db->where('home_work.s_id',$s_id);
		 return $this->db->get()->row_array(); 
	 }	
	public function upadte_home_work_details($h_w_id,$data){
	$this->db->where('h_w_id',$h_w_id);
	return $this->db->update("home_work",$data);
	}
	public function delete_home_work_details($h_w_id){
	$this->db->where('h_w_id',$h_w_id);
	return $this->db->delete('home_work');
	}
	
	public  function get_students($c_id){
		$this->db->select('name,u_id')->from('users');
		$this->db->where('class_name',$c_id);
		$this->db->where('role_id',7);
		$this->db->where('status',1);
		return $this->db->get()->result_array(); 
	}
	
	
	
	
	
	/*  add student  print */
	function get_student_details_print($u_id){
		$this->db->select('users.u_id,users.roll_number,schools.scl_bas_name,schools.scl_bas_add1,schools.scl_bas_logo,users.*,class_list.name as classname,class_list.section')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$u_id);
	   $return=$this->db->get()->row_array();
		$lists=$this->get_student_fee_list($return['u_id']);
		$data=$return;
		$data['payment_details']=$lists;
		if(!empty($data)){
			return $data;
		}
	}
	public  function get_student_fee_list($u_id){
		$this->db->select('student_fee.*,(student_fee.fee_amount-student_fee.pay_amount)as due_amount')->from('student_fee');
		$this->db->where('student_fee.s_id',$u_id);
		$this->db->where('student_fee.status',1);
		return $this->db->get()->result_array();
	}
	/* student attendence */
	public function get_student_view_attendence_list($s_id,$class_id,$subject_id,$time){
	$this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as timings,student_attendenc_reports.*,class_list.name,class_list.section,class_subjects.subject,users.name as username,users.roll_number')->from('student_attendenc_reports');
	$this->db->join('users', 'users.u_id= student_attendenc_reports.student_id', 'left');
	$this->db->join('class_list', 'class_list.id= student_attendenc_reports.class_id', 'left');
	$this->db->join('class_subjects', 'class_subjects.id= student_attendenc_reports.subject_id', 'left');
	$this->db->join('class_times', 'class_times.id= student_attendenc_reports.time', 'left');
	$this->db->where('student_attendenc_reports.s_id',$s_id);
	$this->db->where('student_attendenc_reports.class_id',$class_id);
	$this->db->where('student_attendenc_reports.subject_id',$subject_id);
	$this->db->where('student_attendenc_reports.time',$time);
	return $this->db->get()->result_array(); 
	}
	/* class wise parent list */
	public function get_class_wise_parent_list($class_id,$s_id){
	$this->db->select('CONCAT(class_list.name,"-",class_list.section)as class,users.class_name,users.name,users.u_id,users.parent_name,users.parent_email')->from('users');
    $this->db->join('class_list', 'class_list.id= users.class_name', 'left');
	$this->db->where('users.class_name',$class_id);
	$this->db->where('users.role_id',7);
	$this->db->where('users.status',1);
	$this->db->where('users.s_id',$s_id);
	return $this->db->get()->result_array(); 
	}
	public function get_class_name($class_id,$s_id){
	$this->db->select('CONCAT(class_list.name,"-",class_list.section)as class,users.class_name,users.name,users.u_id,users.parent_name,users.parent_email')->from('users');
    $this->db->join('class_list', 'class_list.id= users.class_name', 'left');
	$this->db->where('users.class_name',$class_id);
	$this->db->where('users.role_id',7);
	$this->db->where('users.status',1);
	$this->db->where('users.s_id',$s_id);
	return $this->db->get()->row_array(); 
	}
  public function get_student_absent_list($s_id,$u_id){
    $this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as timings,class_subjects.subject,li.name as teacher,class_list.name,class_list.section,users.name as username,users.roll_number,student_attendenc_reports.subject_id,student_attendenc_reports.time,student_attendenc_reports.attendence,student_attendenc_reports.remarks,student_attendenc_reports.student_id,student_attendenc_reports.created_at')->from('student_attendenc_reports');
	$this->db->join('users', 'users.u_id= student_attendenc_reports.student_id', 'left');
	$this->db->join('class_list', 'class_list.id= student_attendenc_reports.class_id', 'left');
	$this->db->join('users as li', 'li.u_id= student_attendenc_reports.teacher_id', 'left');
	$this->db->join('class_subjects', 'class_subjects.id= student_attendenc_reports.subject_id', 'left');
	$this->db->join('class_times', 'class_times.id= student_attendenc_reports.time', 'left');
	$this->db->where('student_attendenc_reports.s_id',$s_id);
	$this->db->where('student_attendenc_reports.student_id',$u_id);
	$this->db->where('student_attendenc_reports.attendence','Absent');
	return $this->db->get()->result_array(); 
  }
  public function get_student_marks_list($s_id,$u_id){
  $this->db->select('class_subjects.subject,class_list.name,class_list.section,users.name as username,users.roll_number,exam_list.exam_type,exam_marks_list.*')->from('exam_marks_list');
	$this->db->join('users', 'users.u_id= exam_marks_list.student_id', 'left');
	$this->db->join('class_list', 'class_list.id= exam_marks_list.class_id', 'left');
	$this->db->join('exam_list', 'exam_list.id= exam_marks_list.exam_id', 'left');
	$this->db->join('class_subjects', 'class_subjects.id= exam_marks_list.subject_id', 'left');
	$this->db->where('exam_marks_list.s_id',$s_id);
	$this->db->where('exam_marks_list.student_id',$u_id);
	return $this->db->get()->result_array(); 
  }

 public function student_details($u_id,$s_id){
		$this->db->select('schools.scl_bas_name,users.name,users.parent_name,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,class_list.name as classname,class_list.section')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$u_id);
		$this->db->where('users.s_id',$s_id);
		return $this->db->get()->row_array();
       }
   public function get_student_payment_details($u_id,$s_id){
	$this->db->select('student_fee.*')->from('student_fee');
	$this->db->where('student_fee.s_id',$u_id);
	$this->db->where('student_fee.school_id',$s_id);
	return $this->db->get()->result_array();
    }
    public function get_student_homework($u_id,$s_id){
	$this->db->select('class_subjects.subject,home_work.*,li.name as teacher,users.u_id,users.name as username,users.roll_number,class_list.name,class_list.section')->from('home_work');
	$this->db->join('users', 'users.class_name = home_work.class_id', 'left');
	$this->db->join('users as li', 'li.u_id = home_work.create_by', 'left');
	$this->db->join('class_list', 'class_list.id = home_work.class_id', 'left');
	$this->db->join('class_subjects', 'class_subjects.id = home_work.subjects', 'left');
	$this->db->where('home_work.s_id',$s_id);
	$this->db->where('users.u_id',$u_id);
	return $this->db->get()->result_array();
    }
	/*
	foreach($return as $list){
	   $lists=$this->class_wise_student_list($list['class_id']);
	   //echo '<pre>';print_r($lists);exit;
	   $data[$list['class_id']]=$list;
	   $data[$list['class_id']]['student_list']=$lists;
	   
	  }
	if(!empty($data)){
	   
	   return $data;
	   
	  }
 }
	
	public function class_wise_student_list($class_id){
	$this->db->select('users.name,users.u_id')->from('users');
	$this->db->where('users.class_name',$class_id);
	$this->db->where('users.status',1);
	return $this->db->get()->result_array();
	}
	*/
	
	
	
    /* student dashboard */
    public function get_student_total_amount($u_id,$s_id){
	$this->db->select('(student_fee.fee_amount)as total')->from('student_fee');
	$this->db->where('student_fee.s_id',$u_id);
	$this->db->where('student_fee.school_id',$s_id);
	$this->db->where('student_fee.status',1);
	return $this->db->get()->row_array();
    }		
    public function get_student_pay_amount($u_id,$s_id){
	$this->db->select('sum(student_fee.pay_amount)as pay')->from('student_fee');
	$this->db->where('student_fee.s_id',$u_id);
	$this->db->where('student_fee.school_id',$s_id);
	$this->db->where('student_fee.status',1);
	return $this->db->get()->row_array();
    }	
	public function get_student_due_amount($u_id,$s_id){
	$this->db->select('(student_fee.fee_amount-(sum(student_fee.pay_amount)))as due')->from('student_fee');
	$this->db->where('student_fee.s_id',$u_id);
	$this->db->where('student_fee.school_id',$s_id);
    $this->db->where('student_fee.status',1);
	return $this->db->get()->row_array();
    }	
	public function get_update_present_data($id,$data){
		$this->db->where('student_id',$id);
		return $this->db->update("student_attendenc_reports",$data);
	}
    public function get_update_absent_data($id,$data){
	$this->db->where('student_id',$id);
	return $this->db->update("student_attendenc_reports",$data);
	}
    public function get_student_books_list($u_id,$s_id){
	$this->db->select('class_list.name,class_list.section,users.u_id,users.name as username,users.roll_number,users.class_name,users.status')->from('users');
	$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
	$this->db->where('users.u_id',$u_id);
	$this->db->where('users.s_id',$s_id);
	$this->db->where('users.status',1);
	$return=$this->db->get()->row_array();
	$lists=$this->get_class_wise_books_list($return['class_name'],$s_id);
		$data=$return;
		$data['books_list']=$lists;
		if(!empty($data)){
			return $data;
		}
	}	
   public function get_class_wise_books_list($class_name,$s_id){
   $this->db->select('class_books.id,class_books.books')->from('class_books');
	$this->db->where('class_books.class_id',$class_name);
	$this->db->where('class_books.s_id',$s_id);
	$this->db->where('class_books.status',1);
    return $this->db->get()->result_array();
   }
   
   
   public function class_wise_student_list($class_id){
	 $this->db->select('users.class_name,users.name,users.u_id,users.mobile')->from('users');
		 $this->db->where('class_name',$class_id);
		 $this->db->where('role_id',7);
		 $this->db->where('status',1);
		 return $this->db->get()->result_array(); 
	 }
   
   /* student year wise list */
   public function get_year_wise_student_list($s_id,$class_id,$year){
	$this->db->select('users.*,class_list.name as classname,class_list.section')->from('users');
	$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
	$this->db->where("DATE_FORMAT(users.create_at,'%Y')",$year);
	$this->db->where("users.s_id",$s_id);
	$this->db->where("users.class_name",$class_id);
	$this->db->where("users.role_id",7);
	$this->db->where("users.status",1);
	return $this->db->get()->result_array();
	}
    /* student bus payments */
	 /* bus payments*/
   public function get_student_bus_transport_details($s_id,$student_id){
	 $this->db->select('transport_fee.amount as amounts,route_stops.stop_name,route_numbers.route_no,class_list.name,section,users.name as username,users.roll_number,users.mobile,users.parent_name,users.parent_email,users.gender,users.profile_pic,users.address,users.current_city,users.current_state,users.current_country,users.current_pincode,student_transport.*,r.stop_name as stop')->from('student_transport');
	 $this->db->join('class_list', 'class_list.id = student_transport.class_id', 'left');
	 $this->db->join('route_numbers', 'route_numbers.r_id = student_transport.route', 'left');
	 $this->db->join('users', 'users.u_id = student_transport.student_id', 'left');
	 $this->db->join('route_stops', 'route_stops.stop_id = student_transport.stop_strat', 'left');
	 $this->db->join('route_stops as r', 'r.stop_id = student_transport.stop_end', 'left');
	 $this->db->join('transport_fee', 'transport_fee.to_stops = student_transport.total_amount', 'left');
	$this->db->where('student_transport.s_id',$s_id);
	$this->db->where('student_transport.student_id',$student_id);
	$return=$this->db->get()->row_array();
		$lists=$this->get_student_bus_payment_data($return['student_id']);
		$data=$return;
		$data['payment_details']=$lists;
		if(!empty($data)){
			return $data;
		}
	}
	
	public  function get_student_bus_payment_data($id){
		$this->db->select('SUM(student_bus_payment.pay_amount) as total_pay')->from('student_bus_payment');
		$this->db->where('student_id',$id);
		return $this->db->get()->result_array();
	}
	public function get_student_last_bus_payment_details($student_id){
	$this->db->select('*')->from('student_bus_payment');
		$this->db->where('student_id',$student_id);
		return $this->db->get()->result_array();
	}
   public  function get_school_details_data($student_id){
		$this->db->select('users.u_id,users.role_id,users.s_id,name,schools.scl_bas_email,schools.scl_bas_add1,schools.scl_bas_add2,schools.scl_bas_zipcode,schools.scl_bas_city,schools.scl_bas_state,schools.scl_bas_country,schools.scl_bas_logo,schools.scl_bas_name,schools.scl_bas_contact')->from('users');
		$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
		$this->db->where('users.u_id',$student_id);
		return $this->db->get()->row_array();
	}
    public function save_student_bus_payment($data){
		$this->db->insert('student_bus_payment',$data);
		return $this->db->insert_id();
	}
    public function get_bus_invoice_details($id){
		$this->db->select('b_p_id,invoice')->from('student_bus_payment');
		$this->db->where('b_p_id',$id);
		return $this->db->get()->row_array();
	}
	/* student payment reports */
	
	
	
   public function get_student_payment_list($s_id,$fdate,$tdate){
     $fd=date("Y-m-d", strtotime($fdate));
	 $td=date("Y-m-d", strtotime($tdate));
	$this->db->select('student_fee.*,class_list.name,class_list.section,users.name as username')->from('student_fee');
	$this->db->join('class_list', 'class_list.id = student_fee.class_name', 'left');
	$this->db->join('users', 'users.u_id = student_fee.s_id', 'left');
	$this->db->where("DATE_FORMAT(student_fee.create_at,'%Y-%m-%d') >=",$fd);
	$this->db->where("DATE_FORMAT(student_fee.create_at,'%Y-%m-%d') <=",$td);
	$this->db->where('student_fee.school_id',$s_id);
	$this->db->where('student_fee.status',1);
	return $this->db->get()->result_array();
	}
    public function get_student_total_payment_list($s_id,$fdate,$tdate){
	$fd=date("Y-m-d", strtotime($fdate));
	 $td=date("Y-m-d", strtotime($tdate));
	$this->db->select('SUM(student_fee.pay_amount) as paid_amount')->from('student_fee');
	$this->db->where("DATE_FORMAT(student_fee.create_at,'%Y-%m-%d') >=",$fd);
	$this->db->where("DATE_FORMAT(student_fee.create_at,'%Y-%m-%d') <=",$td);
	$this->db->where('student_fee.school_id',$s_id);
	$this->db->where('student_fee.status',1);
	return $this->db->get()->row_array();
	}
	/* student bus payment reports */
	public function get_student_bus_payment_list($s_id,$fdate,$tdate){
	$fd=date("Y-m-d", strtotime($fdate));
	 $td=date("Y-m-d", strtotime($tdate));
	$this->db->select('student_bus_payment.*,class_list.name,class_list.section,users.name as username,users.roll_number as rollnumber')->from('student_bus_payment');
	$this->db->join('class_list', 'class_list.id = student_bus_payment.class_name', 'left');
	$this->db->join('users', 'users.u_id = student_bus_payment.student_id', 'left');
	$this->db->where("DATE_FORMAT(student_bus_payment.create_at,'%Y-%m-%d') >=",$fd);
	$this->db->where("DATE_FORMAT(student_bus_payment.create_at,'%Y-%m-%d') <=",$td);
	$this->db->where('student_bus_payment.s_id',$s_id);
	$this->db->where('student_bus_payment.status',1);
	return $this->db->get()->result_array();
	}
	public function get_student_total_bus_payment_list($s_id,$fdate,$tdate){
	$fd=date("Y-m-d", strtotime($fdate));
	 $td=date("Y-m-d", strtotime($tdate));
	$this->db->select('SUM(student_bus_payment.pay_amount) as paid_amount')->from('student_bus_payment');
	$this->db->where("DATE_FORMAT(student_bus_payment.create_at,'%Y-%m-%d') >=",$fd);
	$this->db->where("DATE_FORMAT(student_bus_payment.create_at,'%Y-%m-%d') <=",$td);
	$this->db->where('student_bus_payment.s_id',$s_id);
	$this->db->where('student_bus_payment.status',1);
	return $this->db->get()->row_array();
	}
	public function get_student_name_list($id,$s_id){
		$this->db->select('users.u_id,users.name,users.email,users.mobile')->from('users');
		$this->db->where('users.u_id',$id);
		$this->db->where('users.s_id',$s_id);
		$this->db->where('users.status',1);
		return $this->db->get()->row_array();	
	}
	public function save_sms_details($data){
	$this->db->insert('sms',$data);
	return $this->db->insert_id();
	}
	public function save_send_sms_students($data){
	$this->db->insert('send_student_sms',$data);
	return $this->db->insert_id();
	}
	public function get_student_send_sms_list($s_id){
	$this->db->select('sms.*,class_list.name,class_list.section')->from('sms');
	$this->db->join('class_list ', 'class_list.id = sms.class_id', 'left');
	$this->db->where('sms.status',1);
	$this->db->where('sms.s_id',$s_id);
	 $return=$this->db->get()->result_array();
	  foreach($return as $list){
	   $lists=$this->get_students_name_list($list['sms_id']);
	   $data[$list['sms_id']]=$list;
	   $data[$list['sms_id']]['students']=$lists;
	   
	  }
	if(!empty($data)){
	   
	   return $data;
	   
	  }
 }
	public function get_students_name_list($sms_id){
	 $this->db->select('users.name,users.mobile')->from('send_student_sms');
     $this->db->join('users', 'users.u_id = send_student_sms.student_name', 'left');
	 $this->db->where('send_student_sms.sms_id',$sms_id);
     $this->db->where('send_student_sms.status',1);
	 return $this->db->get()->result_array();
	}
	public function update_student_fee_payment($id,$data){
   $this->db->where('s_id',$id);
	return $this->db->update("student_fee",$data);
	}


}