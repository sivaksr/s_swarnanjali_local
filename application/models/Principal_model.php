<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function save_principal_assign_instractions($data){
		$this->db->insert('principal_assign_instractions',$data);
		return $this->db->insert_id();
	}
	public function save_teacher_name_ids($data){
	$this->db->insert('teachers',$data);
		return $this->db->insert_id();
	}
	
	public function get_teacher_list($id,$s_id){
		$this->db->select('time_slot.teacher,time_slot.id,users.u_id,users.name,users.email,users.mobile')->from('time_slot');
		$this->db->join('users ', 'users.u_id = time_slot.teacher', 'left');
		$this->db->where('time_slot.teacher',$id);
		$this->db->where('time_slot.s_id',$s_id);
		$this->db->where('time_slot.status',1);
		$this->db->group_by('time_slot.teacher');
		return $this->db->get()->row_array();	
	}
	public  function update_instractions($p_a_id,$data){
		$this->db->where('p_a_id',$p_a_id);
		return $this->db->update('principal_assign_instractions',$data);
	}
	public function get_teacher_modules_list($s_id){
	$this->db->select('time_slot.id,time_slot.teacher_module,teacher_modules.modules')->from('time_slot');
	$this->db->join('teacher_modules ', 'teacher_modules.t_m_id = time_slot.teacher_module', 'left');
		$this->db->where('time_slot.s_id',$s_id);
		$this->db->where('time_slot.status',1);
		$this->db->group_by('time_slot.teacher_module');
		return $this->db->get()->result_array();	
	}
    public function get_teacher_modules($s_id){
	$this->db->select('time_slot.id,time_slot.teacher_module,teacher_modules.modules')->from('time_slot');
	$this->db->join('teacher_modules ', 'teacher_modules.t_m_id = time_slot.teacher_module', 'left');
	$this->db->where('time_slot.s_id',$s_id);
	$this->db->where('time_slot.status',1);
	$this->db->group_by('time_slot.teacher_module');
	return $this->db->get()->result_array();	
	}

    /* attendence boys and grils */
   public function get_student_attendance_report_boys($class_id,$date){
		$this->db->select('class_list.name as class_name,class_list.section,users.u_id,users.name,users.roll_number,student_attendenc_reports.time,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_list ', 'class_list.id = student_attendenc_reports.class_id', 'left');
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);
		$this->db->where('users.role_id',7);
		$this->db->where('users.gender','Male');
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
		$this->db->select('class_list.name as class_name,class_list.section,users.name,users.roll_number,student_attendenc_reports.time,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
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
		  
	   public function get_student_attendance_report_girls($class_id,$date){
		$this->db->select('class_list.name as class_name,class_list.section,users.u_id,users.name,users.roll_number,student_attendenc_reports.time,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_list ', 'class_list.id = student_attendenc_reports.class_id', 'left');
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);
		$this->db->where('users.role_id',7);
		$this->db->where('users.gender','Female');
		$this->db->order_by('student_attendenc_reports.time','asc');
		//$this->db->group_by('student_attendenc_reports.time');
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			
			$hours=$this->get_hours_wise_attendance_report_girls($list['u_id'],$date);
			$data[$list['u_id']]=$list;
			$data[$list['u_id']]['hours_list']=$hours;
		}
		//echo '<pre>';print_r($return);exit;
		if(!empty($data)){
			return $data;
		}
		
	}
	public function get_hours_wise_attendance_report_girls($id,$date){
		$this->db->select('class_list.name as class_name,class_list.section,users.name,users.roll_number,student_attendenc_reports.time,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_list ', 'class_list.id = student_attendenc_reports.class_id', 'left');
		$this->db->where('student_attendenc_reports.student_id',$id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);

		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		return $this->db->get()->result_array();
	}
	   /* bonefide certificate */
	   public function save_bonefi_certificate($data){
		$this->db->insert('bonfi_cer',$data);
		return $this->db->insert_id();
	}
	  public function get_bonefi_certificate_format($s_id){
	  $this->db->select('bonfi_cer.*')->from('bonfi_cer');
	  $this->db->where('bonfi_cer.s_id',$s_id);
	  $this->db->where('bonfi_cer.status',1);
	  return $this->db->get()->row_array();
	}	  
    public function update_bonefi_certificate_format($data){
		return $this->db->update("bonfi_cer",$data);
	}
	public function get_bonefi_certificate_format_print($s_id){
	$this->db->select('bonfi_cer.*,schools.scl_bas_name,schools.scl_bas_logo,schools.scl_bas_add1')->from('bonfi_cer');
	$this->db->join('schools ', 'schools.s_id = bonfi_cer.s_id', 'left');
	$this->db->where('bonfi_cer.s_id',$s_id);
	$this->db->where('bonfi_cer.status',1);
	return $this->db->get()->row_array();
	}	
	public function get_teachers_list($teacher_modules){
	$this->db->select('time_slot.id,time_slot.teacher,users.name,users.mobile,time_slot.teacher')->from('time_slot');
	$this->db->join('users ', 'users.u_id = time_slot.teacher', 'left');
	$this->db->where('time_slot.teacher_module',$teacher_modules);
	$this->db->group_by('time_slot.teacher');
	$this->db->where('time_slot.status',1);
	return $this->db->get()->result_array(); 
	}
	public function save_principal_assign_teachers($data){
	$this->db->insert('teachers',$data);
	return $this->db->insert_id();
	}
	public function get_principal_assign_instructions_teachers($s_id){
	$this->db->select('teacher_modules.modules,principal_assign_instractions.p_a_id,principal_assign_instractions.teacher_modules,principal_assign_instractions.instractions,principal_assign_instractions.created_at')->from('principal_assign_instractions');
	$this->db->join('teacher_modules', 'teacher_modules.t_m_id = principal_assign_instractions.teacher_modules', 'left');
	$this->db->where('principal_assign_instractions.status',1);
	$this->db->where('principal_assign_instractions.s_id',$s_id);
	 $return=$this->db->get()->result_array();
	  foreach($return as $list){
	   $lists=$this->get_teachers_name_list($list['p_a_id']);
	   $data[$list['p_a_id']]=$list;
	   $data[$list['p_a_id']]['teacher']=$lists;
	   
	  }
	if(!empty($data)){
	   
	   return $data;
	   
	  }
 }
	public function get_teachers_name_list($p_a_id){
	 $this->db->select('users.name,users.mobile,teachers.p_a_id,teachers.p_a_id,teachers.t_id')->from('teachers');
     $this->db->join('users', 'users.u_id = teachers.teacher_ids', 'left');
	 $this->db->where('teachers.p_a_id',$p_a_id);
     $this->db->where('teachers.status',1);
	 return $this->db->get()->result_array();
	}
	
	/* attendeance reports list */
	public function get_student_attendance_report_list($class_id,$date){
		$this->db->select('class_list.name as class_name,class_list.section,users.u_id,users.name,users.roll_number,student_attendenc_reports.time,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_list ', 'class_list.id = student_attendenc_reports.class_id', 'left');
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);
		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		//$this->db->group_by('student_attendenc_reports.time');
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			
			$hours=$this->get_hours_wise_attendance_report_list($list['u_id'],$date);
			$data[$list['u_id']]=$list;
			$data[$list['u_id']]['hours_list']=$hours;
		}
		//echo '<pre>';print_r($return);exit;
		if(!empty($data)){
			return $data;
		}
		
	}
	public function get_hours_wise_attendance_report_list($id,$date){
		$this->db->select('class_list.name as class_name,class_list.section,users.name,users.roll_number,student_attendenc_reports.time,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_list ', 'class_list.id = student_attendenc_reports.class_id', 'left');
		$this->db->where('student_attendenc_reports.student_id',$id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);

		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		return $this->db->get()->result_array();
	}
	 public function get_student_attendance_reports_list_data($class_id,$date){
		$this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as time,users.u_id,users.name,users.roll_number,student_attendenc_reports.time as times,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_times ', 'class_times.id = student_attendenc_reports.time', 'left');
		$this->db->where('student_attendenc_reports.class_id',$class_id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);
		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		//$this->db->group_by('student_attendenc_reports.time');
		$return=$this->db->get()->row_array();
		$hours_lists=$this->get_hours_wise_attendance_reports_list_data($return['u_id'],$date);
		$data=$return;
		$data['hours']=$hours_lists;
		if(!empty($data)){
			return $data;
		}
	}
	
	public function get_hours_wise_attendance_reports_list_data($id,$date){
		$this->db->select('concat(class_times.form_time,"-	",class_times.to_time) as time,users.name,users.roll_number,student_attendenc_reports.time as times,student_attendenc_reports.attendence,student_attendenc_reports.student_id')->from('student_attendenc_reports');
		$this->db->join('users ', 'users.u_id = student_attendenc_reports.student_id', 'left');
		$this->db->join('class_times ', 'class_times.id = student_attendenc_reports.time', 'left');
		$this->db->where('student_attendenc_reports.student_id',$id);
		$this->db->where("DATE_FORMAT(student_attendenc_reports.created_at,'%Y-%m-%d')",$date);

		$this->db->where('users.role_id',7);
		$this->db->order_by('student_attendenc_reports.time','asc');
		return $this->db->get()->result_array();
	} 
	/* principal assign assign instructions induvall teacher */ 
	public function principal_assign_instructions_teacher($u_id,$s_id){
	 $this->db->select('users.name,users.mobile,teachers.p_a_id,teachers.p_a_id,teachers.t_id')->from('teachers');
     $this->db->join('users', 'users.u_id = teachers.teacher_ids', 'left');
	$this->db->where('teachers.status',1);
	$this->db->where('teachers.s_id',$s_id);
	$this->db->where('teachers.teacher_ids',$u_id);
	 $return=$this->db->get()->result_array();
	  foreach($return as $list){
	   $lists=$this->get_instractions_list($list['p_a_id']);
	   $data[$list['p_a_id']]=$list;
	   $data[$list['p_a_id']]['teacher']=$lists;
	   
	  }
	if(!empty($data)){
	   
	   return $data;
	   
	  }
 }
	public function get_instractions_list($p_a_id){
	$this->db->select('teacher_modules.modules,principal_assign_instractions.p_a_id,principal_assign_instractions.teacher_modules,principal_assign_instractions.instractions,principal_assign_instractions.created_at')->from('principal_assign_instractions');
	$this->db->join('teacher_modules', 'teacher_modules.t_m_id = principal_assign_instractions.teacher_modules', 'left');
	$this->db->where('principal_assign_instractions.status',1);
	 $this->db->where('principal_assign_instractions.p_a_id',$p_a_id);
	 return $this->db->get()->result_array();
	}
	
	
	
	
	
 }
	
	
	
	
	
	
	
	