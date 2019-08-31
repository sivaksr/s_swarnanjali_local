<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function save_class_subjects($data){
	$this->db->insert('class_subjects',$data);
	return $this->db->insert_id();
		
	}
	public function save_class_wise_subject_list($data){
	$this->db->insert('subject_list',$data);
	return $this->db->insert_id();	
	}
	 public function get_class_wise_subjects_list($s_id){
	$this->db->select('class_subjects.*,class_list.name,class_list.section')->from('class_subjects');
	$this->db->join('class_list ', 'class_list.id = class_subjects.class_id', 'left');
	$this->db->where('class_subjects.s_id', $s_id);
	$this->db->where('class_subjects.status !=', 2);
	return $this->db->get()->result_array();
 }
	 
	
	
	public function edit_class_wise_subject_list($s_id,$id){
	$this->db->select('class_subjects.*,class_list.name,class_list.section')->from('class_subjects');
	$this->db->join('class_list ', 'class_list.id = class_subjects.class_id', 'left');
	$this->db->where('class_subjects.s_id', $s_id);
	$this->db->where('class_subjects.id', $id);
	return $this->db->get()->row_array();
	}
	
	
	public function update_class_wise_subjects_details($id,$data){
	$this->db->where('id',$id);
    return $this->db->update("class_subjects",$data);		
	}	
	public function delete_subject_list_details($s_l_id){
	$this->db->where('s_l_id',$s_l_id);
	return $this->db->delete('subject_list');
	}	
	public function save_subject_list_details($data){
	$this->db->insert('subject_list',$data);	
	return $this->db->insert_id();
	}	
	 public function delete_class_wise_subject($id){
	$this->db->where('id',$id);
	return $this->db->delete('class_subjects');
	}
	 public function get_student_subject_list($class_id){
	$this->db->select('class_subjects.*,class_list.name,class_list.section')->from('class_subjects');
	$this->db->join('class_list ', 'class_list.id = class_subjects.class_id', 'left');
	$this->db->where('class_subjects.class_id', $class_id);
	 $return=$this->db->get()->result_array();
	  foreach($return as $list){
	   $lists=$this->get_subject_all_list($list['id']);
	   //echo '<pre>';print_r($lists);exit;
	   $data[$list['id']]=$list;
	   $data[$list['id']]['subject_list']=$lists;
	   
	  }
	if(!empty($data)){
	   
	   return $data;
	   
	  }
 }
	public function get_subject_all_list($id){
	 $this->db->select('subject_list.id,subject_list.subject')->from('subject_list');
     $this->db->where('subject_list.id',$id);
	 return $this->db->get()->result_array();
	}	 
	 
	 public function get_class_wise_subjects($class_id){
	$this->db->select('class_subjects.*')->from('class_subjects');
	$this->db->where('class_subjects.class_id',$class_id);
	$this->db->where('class_subjects.status',1);
	return $this->db->get()->result_array(); 
	}
	public function get_teacher_modules_type($class_id){
	$this->db->select('class_list.*,teacher_modules.t_m_id,teacher_modules.modules')->from('class_list');
	$this->db->join('teacher_modules ', 'teacher_modules.t_m_id = class_list.teacher_module', 'left');
	$this->db->where('class_list.id',$class_id);
	$this->db->where('class_list.status',1);
	return $this->db->get()->result_array(); 
	} 
	public function get_class_wise_teachers($class_id){
	$this->db->select('class_teachers.*,users.name,users.u_id')->from('class_teachers');
	$this->db->join('users', 'users.u_id = class_teachers.teacher_id', 'left');
	$this->db->where('class_teachers.class_id',$class_id);
	$this->db->where('class_teachers.status',1);
	return $this->db->get()->result_array(); 
	}  
	 
	 public function check_subject($class_id,$id){
	$this->db->select('class_subjects.id')->from('class_subjects');
		$this->db->where('class_subjects.class_id',$class_id);
		$this->db->where('class_subjects.subject',$id);
		$this->db->where('class_subjects.status',1);
		return $this->db->get()->row_array();
	}
	 
	 
	 
	 
	 
	 
	 
	 
	 /*
	 public function get_class_wise_student_list($class_id){
	 $this->db->select('users.class_name,users.name,users.u_id')->from('users');
		 $this->db->where('class_name',$class_id);
		 $this->db->where('role_id',7);
		 $this->db->where('status',1);
		 return $this->db->get()->result_array(); 
	 }
	 */
	 
	 
}
	
	
	
	
	
	
	
	