<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examination_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public  function get_subject_list($s_id){
		$this->db->select('class_subjects.id,class_subjects.subject')->from('class_subjects');
		$this->db->where('class_subjects.s_id',$s_id);
		$this->db->group_by('class_subjects.id');
		return $this->db->get()->result_array();
	}
	public  function get_all_subject_mark_list($s_id,$class_id,$exam_type,$student_id){
		$this->db->select('class_list.name as classname,class_list.section,users.name,users.roll_number,exam_marks_list.marks_obtained,exam_marks_list.student_id,exam_marks_list.max_marks,exam_marks_list.remarks,class_subjects.subject,exam_list.exam_type')->from('exam_marks_list');
		$this->db->join('users ', 'users.u_id = exam_marks_list.student_id', 'left');
		$this->db->join('class_subjects ', 'class_subjects.id = exam_marks_list.subject_id', 'left');
		$this->db->join('exam_list ', 'exam_list.id = exam_marks_list.exam_id', 'left');
		$this->db->join('class_list ', 'class_list.id = exam_marks_list.class_id', 'left');
		$this->db->where('exam_marks_list.s_id',$s_id);
		$this->db->where('exam_marks_list.class_id',$class_id);
		$this->db->where('exam_marks_list.exam_id',$exam_type);
		$this->db->where('exam_marks_list.student_id',$student_id);
		return $this->db->get()->result_array();
	}
	public  function get_all_subject_list($s_id,$class_id){
		$this->db->select('class_subjects.id,class_subjects.subject')->from('class_subjects');
		$this->db->where('class_subjects.s_id',$s_id);
		$this->db->group_by('class_subjects.id');
		$this->db->where('class_subjects.class_id',$class_id);
		return $this->db->get()->result_array();
	}
	
	public  function get_time_list($s_id){
		$this->db->select('class_times.id,class_times.form_time,class_times.to_time')->from('class_times');
		$this->db->where('class_times.s_id',$s_id);
		return $this->db->get()->result_array();
	}
	public  function get_teacher_list_list($s_id){
		$this->db->select('u_id,name')->from('users');
		$this->db->where('users.s_id',$s_id);
		$this->db->where('users.role_id',6);
		$this->db->where('users.status',1);
		return $this->db->get()->result_array();
	}
	
	/* create  exam*/
	public  function save_exam($data){
		$this->db->insert('exam_list',$data);
		return $this->db->insert_id();
	}
	/*
	public  function get_exam_time_table_list($s_id){
		$this->db->select('exam_list.*,class_subjects.subject as subname,class_list.name,class_list.section,users.name as teacher_name')->from('exam_list');
		$this->db->join('class_subjects ', 'class_subjects.id = exam_list.subject', 'left');
		$this->db->join('class_list ', 'class_list.id = exam_list.class_id', 'left');
		$this->db->join('users ', 'users.u_id = exam_list.teacher_id', 'left');
		$this->db->where('exam_list.s_id',$s_id);
		//$this->db->where('exam_list.status',1);
		$this->db->order_by('exam_list.id','desc');
		return $this->db->get()->result_array();
	}
	*/
	
	public  function update_exam_details($id,$data){
		$this->db->where('id',$id);
		return $this->db->update('exam_list',$data);
	}
	public  function check_exam_exits($exam_type,$class_id,$subject,$exam_date,$start_time,$to_time){
		$this->db->select('exam_list.id')->from('exam_list');
		$this->db->where('exam_type',$exam_type);
		$this->db->where('class_id',$class_id);
		$this->db->where('subject',$subject);
		$this->db->where('exam_date',$exam_date);
		$this->db->where('start_time',$start_time);
		$this->db->where('to_time',$to_time);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	
	public  function delete_exam($id){
		$this->db->where('id',$id);
		return $this->db->delete('exam_list');
	}
	public  function get_exam_subject_list($id){
		$this->db->select('exam_type,id')->from('exam_list');
		$this->db->where('exam_list.s_id',$id);
		$this->db->where('exam_list.status',1);
		$this->db->group_by('exam_list.exam_type');
		return $this->db->get()->result_array();   
	}
	public  function get_student_list($claas_id){
		$this->db->select('class_list.name as classname,class_list.section,users.u_id,users.name,users.roll_number,users.class_name')->from('users');
		$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
		$this->db->where('users.class_name',$claas_id);
		$this->db->where('users.status',1);
		$this->db->where('users.role_id',7);
		return $this->db->get()->result_array(); 
	}
	public  function get_student_name($subject){
		$this->db->select('class_subjects.subject,class_subjects.id')->from('class_subjects');
		$this->db->where('class_subjects.id',$subject);
		$this->db->where('class_subjects.status',1);
		return $this->db->get()->row_array(); 
	}
	public function get_exam_name($type){
		$this->db->select('exam_type,id')->from('exam_list');
		$this->db->where('exam_list.id',$type);
		$this->db->where('exam_list.status',1);
		return $this->db->get()->row_array(); 
	}
		
	public  function save_exam_mark($data){
		$this->db->insert('exam_marks_list',$data);
		return $this->db->insert_id();	
	}
		/*public  function update_exam_mark($data){
			$this->db->insert('exam_marks_list');
			return $this->db->insert_id();
		}*/


	public  function chekck_martks_entered($student_id,$s_id,$exam_id,$subject_id,$class_id){
		$this->db->select('*')->from('exam_marks_list');
		$this->db->where('student_id',$student_id);
		$this->db->where('s_id',$s_id);
		$this->db->where('exam_id',$exam_id);
		$this->db->where('subject_id',$subject_id);
		$this->db->where('class_id',$class_id);
		return $this->db->get()->row_array(); 
	}
	
	public  function chekck_update_marks($student_id,$s_id,$exam_id,$subject_id,$class_id){
		$this->db->select('*')->from('exam_marks_list');
		$this->db->where('student_id',$student_id);
		$this->db->where('s_id',$s_id);
		$this->db->where('exam_id',$exam_id);
		$this->db->where('subject_id',$subject_id);
		$this->db->where('class_id',$class_id);
		return $this->db->get()->row_array(); 
	}
	public  function update_exam_mark($id,$data){
		$this->db->where('id',$id);
		return $this->db->update("exam_marks_list",$data);
	}
	public function get_update_exam_marks($s_id,$class_id,$subject,$exam_type){
	$this->db->select('class_list.name as classname,class_list.section,users.name,users.roll_number,exam_marks_list.marks_obtained,exam_marks_list.student_id,exam_marks_list.class_id,exam_marks_list.subject_id,exam_marks_list.exam_id,exam_marks_list.max_marks,exam_marks_list.remarks,class_subjects.subject,exam_list.exam_type')->from('exam_marks_list');
		$this->db->join('users ', 'users.u_id = exam_marks_list.student_id', 'left');
		$this->db->join('class_subjects ', 'class_subjects.id = exam_marks_list.subject_id', 'left');
		$this->db->join('exam_list ', 'exam_list.id = exam_marks_list.exam_id', 'left');
		$this->db->join('class_list ', 'class_list.id = exam_marks_list.class_id', 'left');
		$this->db->where('exam_marks_list.s_id',$s_id);
		$this->db->where('exam_marks_list.exam_id',$exam_type);
		$this->db->where('exam_marks_list.subject_id',$subject);
		$this->db->where('exam_marks_list.class_id',$class_id);
		return $this->db->get()->result_array(); 
	}	
	public  function get_student_withmarks_list($s_id,$class_id,$subject_id,$exam_id,$student_id){
		$this->db->select('class_list.name as classname,class_list.section,users.name,users.roll_number,exam_marks_list.marks_obtained,exam_marks_list.student_id,exam_marks_list.max_marks,exam_marks_list.remarks,class_subjects.subject,exam_list.exam_type')->from('exam_marks_list');
		$this->db->join('users ', 'users.u_id = exam_marks_list.student_id', 'left');
		$this->db->join('class_subjects ', 'class_subjects.id = exam_marks_list.subject_id', 'left');
		$this->db->join('exam_list ', 'exam_list.id = exam_marks_list.exam_id', 'left');
		$this->db->join('class_list ', 'class_list.id = exam_marks_list.class_id', 'left');
		$this->db->where('exam_marks_list.s_id',$s_id);
		$this->db->where('exam_marks_list.exam_id',$exam_id);
		$this->db->where('exam_marks_list.subject_id',$subject_id);
		$this->db->where('exam_marks_list.class_id',$class_id);
		$this->db->where('exam_marks_list.student_id',$student_id);
		return $this->db->get()->result_array(); 
	}
		
	public  function get_student_withmarks_lists($s_id,$class_id,$exam_id,$student_id){
		$this->db->select('users.name,users.roll_number,exam_marks_list.marks_obtained,exam_marks_list.student_id,exam_marks_list.max_marks,exam_marks_list.remarks,class_subjects.subject,exam_list.exam_type')->from('exam_marks_list');
		$this->db->join('users ', 'users.u_id = exam_marks_list.student_id', 'left');
		$this->db->join('class_subjects ', 'class_subjects.id = exam_marks_list.subject_id', 'left');
		$this->db->join('exam_list ', 'exam_list.id = exam_marks_list.exam_id', 'left');
		$this->db->where('exam_marks_list.s_id',$s_id);
		$this->db->where('exam_marks_list.exam_id',$exam_id);
		//$this->db->where('exam_marks_list.subject_id',$subject_id);
		$this->db->where('exam_marks_list.class_id',$class_id);
		$this->db->where('exam_marks_list.student_id',$student_id);
		return $this->db->get()->result_array(); 
	}
		
		
		
	public  function get_exam_subject_wise_list($id){
		$this->db->select('exam_marks_list.id,exam_marks_list.exam_id,exam_list.exam_type')->from('exam_marks_list');
		$this->db->join('exam_list ', 'exam_list.id = exam_marks_list.exam_id', 'left');
		$this->db->where('exam_marks_list.s_id',$id);
		$this->db->group_by('exam_marks_list.exam_id',$id);
		return $this->db->get()->result_array();   
	}
		
	public function exam_list_table($u_id){
		$this->db->select('u_id,s_id')->from('users');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
			
	public function exam_pattern_table($s_id){
		$this->db->select('count(exam_list.id) as exam_details')->from('exam_list');
		$this->db->where('exam_list.s_id',$s_id);
		return $this->db->get()->row_array();
	} 
	public function teacher_pattern_table($s_id){
		$this->db->select('count(users.u_id) as teacher_details')->from('users');
		$this->db->where('users.s_id',$s_id);
		$this->db->where('status',1);
		$this->db->where('role_id',6);
		return $this->db->get()->row_array();		
    }
		public function student_pattern_table($s_id){
			$this->db->select('count(users.u_id)as student_details')->from('users');
			$this->db->where('users.s_id',$s_id);
			$this->db->where('status',1);
			$this->db->where('role_id',7);
			return $this->db->get()->row_array();
		}
		public  function total_pattern_table($s_id){
           $this->db->select('SUM(pay_amount) as total_amount')->from('student_fee');
           $this->db->where('student_fee.school_id',$s_id);
           return $this->db->get()->row_array();
		}	
		
		
		
		public function get_all_student_name_list($s_id){
		$this->db->select('users. name,users.u_id')->from('users');
		$this->db->where('users.s_id',$s_id);
		$this->db->where('role_id',7);
		return $this->db->get()->result_array();
		}
		
	public function class_wise_student_list($class_id){
	 $this->db->select('users.class_name,users.name,users.u_id')->from('users');
		 $this->db->where('users.class_name',$class_id);
		 $this->db->where('role_id',7);
		 $this->db->where('status',1);
		 return $this->db->get()->result_array(); 
	 }
		public function get_student_allsubjects_list($student_id){
	    $this->db->select('class_subjects.subject,class_subjects.id')->from('users');
		$this->db->join('class_subjects ', 'class_subjects.id = users.u_id', 'left');
		 $this->db->where('users.name',$student_id);
		 return $this->db->get()->result_array(); 
	 }
		
	/* exam  class syllabus */	
		public function save_exam_syllabus($data){
		$this->db->insert('exam_syllabus',$data);
		return $this->db->insert_id();
	}
	public function get_exam_syllabus_list($s_id){
	$this->db->select('exam_syllabus.*,class_list.name,section')->from('exam_syllabus');
	$this->db->join('class_list ', 'class_list.id = exam_syllabus.class_id', 'left');
	$this->db->where('exam_syllabus.s_id',$s_id);
	$this->db->where('exam_syllabus.status !=',2);
    return $this->db->get()->result_array();
	}
	public function edit_exam_syllabus_list($s_id,$e_s_id){
	$this->db->select('exam_syllabus.*')->from('exam_syllabus');
	$this->db->where('exam_syllabus.s_id',$s_id);
    return $this->db->get()->row_array();
	}		
	public function upadte_exam_syllabus($e_s_id,$data){
	$this->db->where('e_s_id',$e_s_id);
		return $this->db->update("exam_syllabus",$data);
	}		
	public function delete_exam_Syllabus($e_s_id){
	$this->db->where('e_s_id',$e_s_id);
	return $this->db->delete('exam_syllabus');
	}	
		
		
		public function get_school_list(){
			$this->db->select('schools.scl_bas_name,schools.s_id')->from('schools');
			$this->db->where('status',1);
			return $this->db->get()->result_array();
		}
		public function get_school_details(){
		$this->db->select('schools.scl_bas_name,schools.s_id')->from('schools');		
        return $this->db->get()->row_array();	
	}
		
		
		
		public function get_all_sent_notification_details(){
		$this->db->select('announcements.*')->from('announcements');		
		$this->db->group_by('announcements.comment');
        $return=$this->db->get()->result_array();
		foreach( $return as $Lis){
			
			$msg=$this->get_sent_announcements_resouces_list($Lis['comment']);
			$data[$Lis['int_id']]=$Lis;
			$data[$Lis['int_id']]['r_list']=$msg;
		}
		if(!empty($data))
		{
		return $data;
		}
	}
	
	public function get_sent_announcements_resouces_list($msg){
		$this->db->select('announcements.s_id,schools.scl_bas_name')->from('announcements');	
		$this->db->join('schools', 'schools.s_id = announcements.s_id', 'left');
		$this->db->where('comment', $msg);
        return $this->db->get()->result_array();
	}
	
public function get_class_wise_subjects($class_id){
	$this->db->select('class_subjects.*')->from('class_subjects');
	$this->db->where('class_subjects.class_id',$class_id);
	$this->db->where('class_subjects.status',1);
	return $this->db->get()->result_array(); 
	 }
	
	public function save_exam_timing_data($data){
	$this->db->insert('exam_list_data',$data);
		return $this->db->insert_id();
	}
	
	public  function get_exam_time_table_list($s_id){
	$this->db->select('class_subjects.subject as subjects,exam_list.*,class_list.name,class_list.section,users.name as student_name')->from('exam_list');
	$this->db->join('class_list ', 'class_list.id = exam_list.class_id', 'left');
	$this->db->join('class_subjects ', 'class_subjects.id = exam_list.subject', 'left');
	$this->db->join('users ', 'users.u_id = exam_list.student_id', 'left');
	$this->db->where('exam_list.status !=', 2);
	$this->db->where('exam_list.s_id',$s_id);
	 return $this->db->get()->result_array();
	}
	
	/*
	public  function get_exam_time_table_list($s_id){
	$this->db->select('exam_list.*')->from('exam_list');
	$this->db->where('exam_list.status !=', 2);
	$this->db->where('exam_list.s_id',$s_id);
	 $return=$this->db->get()->result_array();
	  foreach($return as $list){
	   $lists=$this->get_exam_list_data($list['id']);
	   //echo '<pre>';print_r($lists);exit;
	   $data[$list['id']]=$list;
	   $data[$list['id']]['exam_list_data']=$lists;
	   
	  }
	if(!empty($data)){
	   
	   return $data;
	   
	  }
 }
	public function get_exam_time_table_details($id){
	 $this->db->select('exam_list_data.*,class_list.name,class_list.section')->from('exam_list_data');
    $this->db->join('class_list ', 'class_list.id = exam_list_data.class_id', 'left');
	 $this->db->where('exam_list_data.id',$id);
	//$this->db->group_by('exam_list_data.class_id',$id);
	 //$this->db->where('exam_list_data.subject');
     $this->db->where('exam_list_data.status !=',2);
	 return $this->db->get()->result_array();
	}
	*/
	public  function get_exam_time_table_details($id){
	$this->db->select('exam_list.*,class_list.name,class_list.section')->from('exam_list');
	$this->db->join('class_list ', 'class_list.id = exam_list.class_id', 'left');
	$this->db->where('exam_list.id',$id);
	return $this->db->get()->row_array();
	}
	
	/***
	public  function get_exam_time_table_details($id){
	$this->db->select('exam_list.*')->from('exam_list');
	$this->db->where('id',$id);
	$return=$this->db->get()->row_array();
		$list=$this->get_edit_exam_list_data($return['id']);
		$data=$return;
		$data['exam_list_data']=$list;
		if(!empty($data)){
			return $data;
		}
	}
	public  function get_edit_exam_list_data($id){
		$this->db->select('exam_list_data.*')->from('exam_list_data');
		$this->db->where('exam_list_data.id',$id);
		return $this->db->get()->result_array();
		
	}
	
	*/
	public function delete_exam_list_data($e_l_id){
	$this->db->where('e_l_id',$e_l_id);
	return $this->db->delete('exam_list_data');
	}	
	
	
	public function get_exam_type_list($s_id){
	$this->db->select('exam_list.id,exam_list.exam_type')->from('exam_list');
		$this->db->where('exam_list.s_id',$s_id);
		$this->db->group_by('exam_list.exam_type');
		$this->db->where('exam_list.status',1);
		return $this->db->get()->result_array(); 
	}
	public function get_exam_hall_tickets($class_id,$student_id,$exam_type){
	$this->db->select('exam_list.*,class_list.name,class_list.section,')->from('exam_list');
    $this->db->join('class_list ', 'class_list.id = exam_list.class_id', 'left');
	$this->db->where('exam_list.status',1);
	$this->db->where('exam_list.exam_type',$exam_type);
	$this->db->where('exam_list.class_id',$class_id);
	$return=$this->db->get()->row_array();
		$lists=$this->get_class_wise_student_data($student_id);
		$data=$return;
		$data['student_list']=$lists;
		if(!empty($data)){
			return $data;
			
		}
	}
	public  function get_class_wise_student_data($student_id){
		$this->db->select('users.class_name,users.name,users.u_id')->from('users');
		 $this->db->where('users.u_id',$student_id);
		 $this->db->where('role_id',7);
		 $this->db->where('status',1);
		 return $this->db->get()->result_array(); 
	 }
	
	
	
	
	public  function student_list($s_id){
		$this->db->select('u_id,name,roll_number,class_name')->from('users');
		$this->db->where('users.s_id',$s_id);
		$this->db->where('users.status',1);
		$this->db->where('users.role_id',7);
		return $this->db->get()->result_array(); 
	}
	
	public function get_exam_hall_ticket_print($id){
	$this->db->select('exam_list.*,class_list.name,class_list.section,users.name as student_name,users.roll_number,users.gender,users.parent_name')->from('exam_list');
	$this->db->join('class_list ', 'class_list.id = exam_list.class_id', 'left');
	$this->db->join('users ', 'users.u_id = exam_list.student_id', 'left');
	$this->db->where('exam_list.id',$id);
	$this->db->where('exam_list.status',1);
	return $this->db->get()->row_array(); 
	}
	public function get_exam_instructions_list($s_id){
	$this->db->select('exam_instructions.e_i_id,exam_instructions.instructions')->from('exam_instructions');
		$this->db->where('exam_instructions.s_id',$s_id);
		$this->db->where('exam_instructions.status',1);
		return $this->db->get()->result_array(); 
	}
	/* exam instructions */
	public function save_exam_instructions($data){
	$this->db->insert('exam_instructions',$data);
		return $this->db->insert_id();
	}
	public function get_exam_instructions($s_id){
	$this->db->select('exam_instructions.*')->from('exam_instructions');
		$this->db->where('exam_instructions.s_id',$s_id);
		$this->db->where('exam_instructions.status!=',2);
		return $this->db->get()->result_array(); 
	}
	public function edit_exam_instructions($e_i_id,$s_id){
	$this->db->select('exam_instructions.*')->from('exam_instructions');
		$this->db->where('exam_instructions.e_i_id',$e_i_id);
		$this->db->where('exam_instructions.s_id',$s_id);
		return $this->db->get()->row_array(); 
	}
	public function update_exam_instructions($e_i_id,$data){
	$this->db->where('e_i_id',$e_i_id);
	return $this->db->update("exam_instructions",$data);
	}	
	public function delete_exam_instructions($e_i_id){
	$this->db->where('e_i_id',$e_i_id);
	return $this->db->delete('exam_instructions');
	}	
	
	public function get_exams_type_list($exam_type){
	$this->db->select('exam_list.id,exam_list.exam_type')->from('exam_list');
		$this->db->where('exam_list.id',$exam_type);
		$this->db->where('exam_list.status',1);
		$this->db->group_by('exam_list.id');
		return $this->db->get()->row_array(); 
	}	
	/*
	public function get_time_table_list($emp_id,$class_name){
	$this->db->select('exam_list.exam_type,exam_list_data.id,exam_list_data.subject,exam_list_data.class_id,exam_list_data.exam_date,exam_list_data.start_time,exam_list_data.to_time')->from('exam_list_data');
	$this->db->join('exam_list ', 'exam_list.id = exam_list_data.id', 'left');
	$this->db->where('exam_list_data.id',$emp_id);
	$this->db->where('exam_list_data.class_id',$class_name);
	$this->db->where('exam_list_data.status',1);
	return $this->db->get()->result_array();
	}
	*/
	public function get_time_table_list($emp_id,$class_name){
	$this->db->select('exam_list.*,class_subjects.subject as subjects')->from('exam_list');
	$this->db->join('class_subjects ', 'class_subjects.id = exam_list.subject', 'left');
	$this->db->where('exam_list.exam_type',$emp_id);
	$this->db->where('exam_list.class_id',$class_name);
	$this->db->where('exam_list.status',1);
	return $this->db->get()->result_array();
	}
	
	/*
	public function exam_type($emp_id){
	$this->db->select('exam_list.exam_type,exam_list_data.id')->from('exam_list_data');
	$this->db->join('exam_list ', 'exam_list.id = exam_list_data.id', 'left');
	$this->db->where('exam_list_data.id',$emp_id);
	$this->db->where('exam_list_data.status',1);
	return $this->db->get()->row_array();
	}
	*/
	public function exam_type($s_id,$emp_id){
	$this->db->select('schools.scl_bas_name,schools.scl_bas_add1,schools.scl_bas_logo,exam_list.exam_type,exam_list.id,exam_list.s_id')->from('exam_list');
	$this->db->join('schools ', 'schools.s_id = exam_list.s_id', 'left');
	$this->db->where('exam_list.exam_type',$emp_id);
	$this->db->where('exam_list.status',1);
	$this->db->where('exam_list.s_id',$s_id);
	return $this->db->get()->row_array();
	}
	
	public function student_details($s_id,$id){
	$this->db->select('schools.scl_bas_name,schools.scl_bas_add1,schools.scl_bas_logo,users.s_id,class_list.name,class_list.section,users.roll_number,users.name as student_name,users.class_name,users.gender,users.parent_name,users.dob,users.profile_pic')->from('users');
	$this->db->join('schools ', 'schools.s_id = users.s_id', 'left');
	$this->db->join('class_list ', 'class_list.id = users.class_name', 'left');
	$this->db->where('users.name',$id);
	$this->db->where('users.s_id',$s_id);
	$this->db->where('users.status',1);
	return $this->db->get()->row_array();
	}
	
	public function get_exam_type_list_data($id){
	$this->db->select('exam_list.id,exam_list.exam_type')->from('exam_list');
	$this->db->where('exam_list.exam_type',$id);
	$this->db->where('exam_list.status',1);
	return $this->db->get()->row_array(); 
	}	
	
    /* add marks */
    public function get_addexam_class_list($s_id){
	$this->db->select('exam_list.id,exam_list.class_id,class_list.id,class_list.name,class_list.section')->from('exam_list');
	$this->db->join('class_list ', 'class_list.id = exam_list.class_id', 'left');
	$this->db->where('exam_list.s_id',$s_id);
	$this->db->where('exam_list.status',1);
	$this->db->group_by('exam_list.class_id');
	return $this->db->get()->result_array(); 
	}	
    public function get_addexam_subject_list($s_id){
	$this->db->select('exam_list.id,exam_list.subject,class_subjects.id,class_subjects.subject')->from('exam_list');
	$this->db->join('class_subjects ', 'class_subjects.id = exam_list.subject', 'left');
	$this->db->where('exam_list.s_id',$s_id);
	$this->db->where('exam_list.status',1);
	$this->db->group_by('exam_list.subject');
	return $this->db->get()->result_array(); 
	}	
    public function get_addexam_subjects_list($s_id,$class_id){
	$this->db->select('exam_list.class_id,exam_list.id,exam_list.subject as subjects,class_subjects.subject')->from('exam_list');
	$this->db->join('class_subjects ', 'class_subjects.id = exam_list.subject', 'left');
	$this->db->where('exam_list.s_id',$s_id);
	$this->db->where('exam_list.class_id',$class_id);
	$this->db->where('exam_list.status',1);
	$this->db->group_by('exam_list.subject');
	return $this->db->get()->result_array(); 
	}	
    public function get_addexam_markswise_class_list($s_id){
	$this->db->select('exam_marks_list.id,exam_marks_list.class_id,class_list.id,class_list.name,class_list.section')->from('exam_marks_list');
	$this->db->join('class_list ', 'class_list.id = exam_marks_list.class_id', 'left');
	$this->db->where('exam_marks_list.s_id',$s_id);
	$this->db->where('exam_marks_list.status',1);
	$this->db->group_by('exam_marks_list.class_id');
	return $this->db->get()->result_array(); 
	}	
    public function get_addexam_markswise_subject_list($s_id){
	$this->db->select('exam_marks_list.id,exam_marks_list.subject_id,class_subjects.id,class_subjects.subject')->from('exam_marks_list');
	$this->db->join('class_subjects ', 'class_subjects.id = exam_marks_list.subject_id', 'left');
	$this->db->where('exam_marks_list.s_id',$s_id);
	$this->db->where('exam_marks_list.status',1);
	$this->db->group_by('exam_marks_list.subject_id');
	return $this->db->get()->result_array(); 
	}	
    public function get_exam_markswise_list($s_id){
	$this->db->select('exam_marks_list.id,exam_marks_list.exam_id,exam_list.id,exam_list.exam_type')->from('exam_marks_list');
	$this->db->join('exam_list ', 'exam_list.id = exam_marks_list.exam_id', 'left');
	$this->db->where('exam_marks_list.s_id',$s_id);
	$this->db->where('exam_marks_list.status',1);
	$this->db->group_by('exam_marks_list.exam_id');
	return $this->db->get()->result_array(); 
	}
	public function get_addexam_marks_subjects_list($s_id,$class_id){
	$this->db->select('exam_marks_list.class_id,exam_marks_list.id,exam_marks_list.subject_id ,class_subjects.subject')->from('exam_marks_list');
	$this->db->join('class_subjects ', 'class_subjects.id = exam_marks_list.subject_id', 'left');
	$this->db->where('exam_marks_list.s_id',$s_id);
	$this->db->where('exam_marks_list.class_id',$class_id);
	$this->db->where('exam_marks_list.status',1);
	$this->db->group_by('exam_marks_list.subject_id');
	return $this->db->get()->result_array(); 
	}	

    public function get_exam_marks_subjects_list($s_id,$class_id){
	$this->db->select('exam_marks_list.class_id,exam_marks_list.id,exam_marks_list.subject_id ,class_subjects.subject')->from('exam_marks_list');
	$this->db->join('class_subjects ', 'class_subjects.id = exam_marks_list.subject_id', 'left');
	$this->db->where('exam_marks_list.s_id',$s_id);
	$this->db->where('exam_marks_list.class_id',$class_id);
	$this->db->where('exam_marks_list.status',1);
	$this->db->group_by('exam_marks_list.subject_id');
	return $this->db->get()->result_array(); 
	}	
   public function get_exam_types_list($s_id,$class_id){
	$this->db->select('exam_list.id,exam_list.exam_type')->from('exam_list');
	$this->db->where('exam_list.s_id',$s_id);
	$this->db->where('exam_list.class_id',$class_id);
	$this->db->where('exam_list.status',1);
	$this->db->group_by('exam_list.exam_type');
	return $this->db->get()->result_array(); 
	}	





	
		
 }				 