<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class School_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function save_school_admin($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	public function save_school_data($data){
		$this->db->insert('schools',$data);
		return $this->db->insert_id();
	}
	public  function delete_admin_user($u_id){
		$this->db->where('u_id',$u_id);
		return $this->db->delete('users');
	}
	public function get_school_details($s_id){
		$this->db->select('*')->from('schools');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->row_array();	
	}
	public function get_school_basic_details($s_id){
		$this->db->select('s_id,u_id')->from('schools');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->row_array();	
	}
	public  function update_school_details($s_id,$data){
		$this->db->where('s_id',$s_id);
    	return $this->db->update("schools",$data);
	}
	public  function get_all_school_list_details($u_id){
		$this->db->select('s_id,u_id,scl_bas_name,scl_email_id,scl_bas_contact,status,completed,create_at,scl_rep_add1,scl_rep_state')->from('schools');
		$this->db->where('create_by',$u_id);
		$this->db->where('status !=',2);
		$this->db->order_by('s_id',"DESC");
		return $this->db->get()->result_array();
	}
	
	public  function get_school_details_with_u_id($u_id){
		$this->db->select('*')->from('schools');
		$this->db->where('u_id',$u_id);
		return $this->db->get()->row_array();
		
	}
	public  function get_school_basic_details_with_u_id($u_id){
		$this->db->select('s_id,u_id')->from('schools');
		$this->db->where('u_id',$u_id);
		return $this->db->get()->row_array();
		
	}
	public  function get_school_basic_details_with_resourse($u_id){
		$this->db->select('users.s_id,users.u_id')->from('schools');
		$this->db->join('users ', 'users.s_id = schools.s_id', 'left');

		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
		
	}
	function get_resources_details($u_id){
		$this->db->select('u_id,role_id,s_id,name')->from('users');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
	
	/* add clas*/
	public  function check_class_name_exist($school_id,$name,$section,$capacity){
		$this->db->select('*')->from('class_list');
		$this->db->where('s_id',$school_id);
		$this->db->where('name',$name);
		$this->db->where('section',$section);
		$this->db->where('capacity',$capacity);
		return $this->db->get()->row_array();
	}
	
	public  function save_class($data){
		$this->db->insert('class_list',$data);
		return $this->db->insert_id();
	}
	public  function get_class_list($school_id){
		$this->db->select('class_list.*,teacher_modules.modules')->from('class_list');
		$this->db->join('teacher_modules', 'teacher_modules.t_m_id = class_list.teacher_module', 'left');
		$this->db->where('class_list.s_id',$school_id);
		$this->db->order_by('id',"desc");
		return $this->db->get()->result_array();
	}
	public  function get_all_class_list($school_id){
		$this->db->select('id,name,section')->from('class_list');
		$this->db->where('s_id',$school_id);
		$this->db->where('status',1);
		$this->db->order_by('id',"desc");
		return $this->db->get()->result_array();
	}
	
	public  function get_all_class_teachers_list($s_id){
		$this->db->select('u_id,name,s_id')->from('users');
		$this->db->where('s_id',$s_id);
		$this->db->where('status',1);
		$this->db->where('role_id',6);
		$this->db->order_by('u_id',"desc");
		return $this->db->get()->result_array();
	}
	public  function update_school_class_details($c_id,$data){
		$this->db->where('id',$c_id);
		return $this->db->update('class_list',$data);
	}
	
	public  function delete_class($c_id){
		$this->db->where('id',$c_id);
		return $this->db->delete('class_list');
	}
	public  function get_class_details($c_id){
		$this->db->select('*')->from('class_list');
		$this->db->where('id',$c_id);
		return $this->db->get()->row_array();
		
	}
	
	/* class teacher */
	public  function save_class_teacher($data){
		$this->db->insert("class_teachers",$data);
		return $this->db->insert_id();
	}
	
	public  function check_teacher_name_exits($s_id,$c_id,$t_id){
		$this->db->select('*')->from('class_teachers');
		$this->db->where('s_id',$s_id);
		$this->db->where('class_id',$c_id);
		$this->db->where('teacher_id',$t_id);
		return $this->db->get()->row_array();
	}
	public  function get_all_class_teachers_assign_list($s_id){
		$this->db->select('class_teachers.*,concat(class_list.name,"-	",class_list.section) as classname,users.name')->from('class_teachers');
		$this->db->join('class_list ', 'class_list.id = class_teachers.class_id', 'left');
		$this->db->join('users ', 'users.u_id = class_teachers.teacher_id', 'left');

		$this->db->where('class_teachers.s_id',$s_id);
		return $this->db->get()->result_array();
	}
	
	public  function update_class_teacher_details($id,$data){
		$this->db->where('id',$id);
		return $this->db->update('class_teachers',$data);
	}
	
	public  function delete_class_teacher($id){
		$this->db->where("id",$id);
		return $this->db->delete("class_teachers");
		
	}
	public function get_assign_class_teacher($id){
		$this->db->select('*')->from('class_teachers');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}
	
	/* subjects*/
	public  function save_class_subject($data){
		$this->db->insert("class_subjects",$data);
		return $this->db->insert_id();
	}
	public  function check_subject_name_exits($s_id,$c_id,$subject){
		$this->db->select('*')->from('class_subjects');
		$this->db->where('s_id',$s_id);
		$this->db->where('class_id',$c_id);
		$this->db->where('subject',$subject);
		return $this->db->get()->row_array();
	}
	public function get_school_subjects_list($s_id){
		$this->db->select('class_subjects.*,concat(class_list.name,"-	",class_list.section) as classname')->from('class_subjects');
		$this->db->join('class_list ', 'class_list.id = class_subjects.class_id', 'left');
		$this->db->where('class_subjects.s_id',$s_id);
		return $this->db->get()->result_array();
		
	}
	public  function update_subject_details($s_id,$data){
		$this->db->where('id',$s_id);
		return $this->db->update('class_subjects',$data);
	}
	public  function delete_class_subject($id){
		$this->db->where('id',$id);
		return $this->db->delete('class_subjects');
		
	}
	public  function get_subject_details($id){
		$this->db->select('*')->from('class_subjects');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}
	/* subjects*/
	
	/* class times*/
	public  function save_time($data){
		$this->db->insert("class_times",$data);
		return $this->db->insert_id();
	}
	public  function check_time_exits($s_id,$form_time,$to_time){
		$this->db->select('*')->from('class_times');
		$this->db->where('s_id',$s_id);
		$this->db->where('form_time',$form_time);
		$this->db->where('to_time',$to_time);
		return $this->db->get()->row_array();
	}
	public  function get_time_details($id){
		$this->db->select('*')->from('class_times');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}
	public  function update_timing_details($s_id,$data){
		$this->db->where('id',$s_id);
		return $this->db->update('class_times',$data);
	}
	public  function get_all_time_list($s_id){
		$this->db->select('class_times.*')->from('class_times');
		$this->db->where('class_times.s_id',$s_id);
		return $this->db->get()->result_array();
		
	}
	public  function delete_class_time($id){
		$this->db->where('id',$id);
		return $this->db->delete('class_times');
	}
	/* class times*/
	/* class time  table*/
	
	public function get_all_timings_list($s_id){
		$this->db->select('*')->from('class_times');
		$this->db->where('s_id',$s_id);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public function get_all_subjects_list_list($s_id){
		$this->db->select('*')->from('class_subjects');
		$this->db->where('s_id',$s_id);
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public  function save_class_time_slot($data){
		$this->db->insert("time_slot",$data);
		return $this->db->insert_id();
	}
	public  function get_all_time_slot_list($s_id){
		$this->db->select('time_slot.*,teacher_modules.modules,class_subjects.subject,concat(class_times.form_time,"-",class_times.to_time) as times,concat(class_list.name,"-	",class_list.section) as classname,users.name')->from('time_slot');
		$this->db->join('class_times ', 'class_times.id = time_slot.time', 'left');
		$this->db->join('class_list ', 'class_list.id = time_slot.class_id', 'left');
		$this->db->join('users ', 'users.u_id = time_slot.teacher', 'left');
		$this->db->join('teacher_modules ', 'teacher_modules.t_m_id = time_slot.teacher_module', 'left');
		$this->db->join('class_subjects ', 'class_subjects.id = time_slot.subject', 'left');
		$this->db->where('time_slot.s_id',$s_id);
		return $this->db->get()->result_array();	
	}
	public function update_time_slote_details($s_id,$data){
		$this->db->where('id',$s_id);
		return $this->db->update('time_slot',$data);
		
	}
	public  function delete_timeslote($id){
		$this->db->where('id',$id);
		return $this->db->delete('time_slot');
	}
	
	public  function get_timeslot_id_details($id){
		$this->db->select('*')->from('time_slot');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}
	public  function check_time_slote_exits($day,$time,$class_id,$teacher){
		$this->db->select('*')->from('time_slot');
		$this->db->where('day',$day);
		$this->db->where('time',$time);
		$this->db->where('class_id',$class_id);
		$this->db->where('teacher',$teacher);
		return $this->db->get()->row_array();
		
	}
	/* class time  table*/
	
	/* teacher login purpose*/
	public  function student_count($u_id){
		$this->db->select('*')->from('time_slot');
		$this->db->where('time_slot.teacher',$u_id);
		$this->db->group_by('time_slot.class_id');
		$return= $this->db->get()->result_array();
		foreach($return as $list){
			$student_list[]=$this->get_student_list($list['class_id']);
			
		}
		if(!empty($student_list)){
			return $student_list;
		}
	//echo '<pre>';print_r($student_list);exit;
	
	}
	public  function get_student_list($class_id){
		$this->db->select('count(users.u_id) as count')->from('users');
		$this->db->where('users.class_name',$class_id);
		return $this->db->get()->row_array();
	}
	
	 
	 
	 public  function class_teacher_user($u_id){
		$this->db->select('class_list.name,class_list.section')->from('class_teachers');
		$this->db->join('class_list ', 'class_list.id = class_teachers.class_id', 'left');
		$this->db->where('class_teachers.teacher_id',$u_id);
		return $this->db->get()->result_array();
	}
	
	 public function class_name_user($u_id){
		$this->db->select('*')->from('time_slot');
		$this->db->where('time_slot.teacher',$u_id);
		$this->db->group_by('time_slot.class_id');
		$return=$this->db->get()->result_array();
		foreach($return as $list){
			$my_list[]=$this->get_my_clas_list($list['class_id']);
	
		}
		if(!empty($my_list)){
			return $my_list;
		}
	//echo'<pre>';print_r($my_list);exit;
	
	}
		 public function get_my_clas_list($class_id){
			 $this->db->select('name,section')->from('class_list');
		$this->db->where('class_list.id',$class_id);
		return $this->db->get()->row_array();
	}
		
	public  function teacher_week_days_perclass($u_id){
		$this->db->select('time_slot.day')->from('time_slot');
		$this->db->where('time_slot.teacher',$u_id);
		$this->db->group_by('time_slot.day');
		return $this->db->get()->result_array();
	}		
		public function classschedules_list($u_id){
			$this->db->select('CONCAT(class_times.form_time," - ",class_times.to_time) as timesheet,time_slot.day,class_subjects.subject,class_list.name,class_list.section')->from('time_slot');
			$this->db->join('class_times ', 'class_times.id = time_slot.time', 'left');
			$this->db->join('class_list ', 'class_list.id = time_slot.class_id', 'left');
			$this->db->join('class_subjects ', 'class_subjects.id = time_slot.subject', 'left');
			$this->db->where('time_slot.teacher',$u_id);
			//$this->db->where('time_slot.time');
			return $this->db->get()->result_array();
		}
			/*
			foreach($return as $lis){
				$get_sub=$this->get_timewise_subjects($lis['time']);
				$data[$lis['time']]=$lis;
				$data[$lis['time']]['subjects']=$get_sub;
			}
			if(!empty($data)){
				return $data;
			}
	
		}
		public  function get_timewise_subjects($time){
			$this->db->select('time_slot.day,time_slot.id,time_slot.subject,time_slot.class_id,class_list.name,class_list.section,class_times.form_time,class_times.to_time')->from('time_slot');
			$this->db->join('class_times ', 'class_times.id = time_slot.class_id', 'left');
			$this->db->join('class_list ', 'class_list.id = time_slot.class_id', 'left');
			$this->db->join('class_subjects ', 'class_subjects.id = time_slot.subject', 'left');
			//$this->db->where('time_slot.day',$day);
			$this->db->where('time_slot.time',$time);
			return $this->db->get()->result_array();
		}
		*/
		public  function class_subject_list($u_id){
			$this->db->select('class_subjects.subject,class_subjects.id')->from('time_slot');
			$this->db->join('class_subjects ', 'class_subjects.id = time_slot.subject', 'left');
			$this->db->where('time_slot.teacher',$u_id);
			$this->db->group_by('class_subjects.subject');
			return $this->db->get()->result_array();	
		}	
			 
			 /* school */
			public function get_teacher_modules($s_id){
			$this->db->select('teacher_modules.modules,teacher_modules.t_m_id')->from('teacher_modules');
			$this->db->where('teacher_modules.s_id',$s_id);
		    $this->db->where('teacher_modules.status',1);
		    return $this->db->get()->result_array();
	       }
		   
		   public function get_class_name_list($s_id,$teacher_module){
			$this->db->select('teacher_module_wise_class.t_m_c_id,teacher_module_wise_class.class as class_name')->from('teacher_module_wise_class');
		    $this->db->where('teacher_module_wise_class.status',1);
		    $this->db->where('teacher_module_wise_class.s_id',$s_id);
		    $this->db->where('teacher_module_wise_class.modules_name',$teacher_module);
		    return $this->db->get()->result_array();
	       }
		   public function get_class_name($s_id){
		   $this->db->select('teacher_module_wise_class.t_m_c_id,teacher_module_wise_class.class as class_name')->from('teacher_module_wise_class');
		    $this->db->where('teacher_module_wise_class.status',1);
		    $this->db->where('teacher_module_wise_class.s_id',$s_id);
		    return $this->db->get()->result_array();
	       }
		   public function get_teacher_modules_wise_class($s_id){
		   $this->db->select('class_list.id,class_list.teacher_module,teacher_modules.modules')->from('class_list');
		     $this->db->join('teacher_modules ', 'teacher_modules.t_m_id = class_list.teacher_module', 'left');
			$this->db->where('class_list.status',1);
		    $this->db->where('class_list.s_id',$s_id);
		    return $this->db->get()->result_array();
	       }

			public function class_names_lists($id){
			$this->db->select('class_list.id,CONCAT(class_list.name,class_list.section) as class_name')->from('class_list');
		    $this->db->where('class_list.status',1);
		    $this->db->where('class_list.teacher_module',$id);
		    return $this->db->get()->result_array();
	       }

			 
			 
			 
			
		
}	
		


	 
	 
		
	
	
	
	
	
	
	
	
	
	
	

