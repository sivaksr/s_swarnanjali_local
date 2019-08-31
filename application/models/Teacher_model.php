<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function save_teacher_modules($data){
		$this->db->insert('teacher_modules',$data);
		return $this->db->insert_id();
	}
	
	public function teacher_modules_list($s_id){
		$this->db->select('teacher_modules.*')->from('teacher_modules');
		$this->db->where('teacher_modules.s_id',$s_id);
		$this->db->where('teacher_modules.status!=',2);
		return $this->db->get()->result_array();	
	}
	public function edit_teacher_modules($s_id,$t_m_id){
	$this->db->select('teacher_modules.*')->from('teacher_modules');
	$this->db->where('teacher_modules.s_id',$s_id);
	$this->db->where('teacher_modules.t_m_id',$t_m_id);
	return $this->db->get()->row_array();	
	}
	public function check_module_exits($s_id,$modules){
	$this->db->select('teacher_modules.*')->from('teacher_modules');
	$this->db->where('teacher_modules.modules',$modules);
	$this->db->where('teacher_modules.s_id',$s_id);
	$this->db->where('teacher_modules.status',1);
	return $this->db->get()->row_array();	
	}
	public  function update_teacher_modules($t_m_id,$data){
		$this->db->where('t_m_id',$t_m_id);
		return $this->db->update('teacher_modules',$data);
	}
	/* teacher modules wise classes*/
	public function get_teacher_modules($s_id){
	$this->db->select('teacher_modules.t_m_id,teacher_modules.modules')->from('teacher_modules');
	$this->db->where('teacher_modules.s_id',$s_id);
	$this->db->where('teacher_modules.status',1);
	return $this->db->get()->result_array();	
	}
	public function save_teacher_module_wise_class($data){
		$this->db->insert('teacher_module_wise_class',$data);
		return $this->db->insert_id();
	}
	public function check_module_wise_class_exits($modules_name,$class){
	$this->db->select('teacher_module_wise_class.*')->from('teacher_module_wise_class');
	$this->db->where('teacher_module_wise_class.modules_name',$modules_name);
	$this->db->where('teacher_module_wise_class.class',$class);
	return $this->db->get()->row_array();	
	}
	public function teacher_modules_wise_class_list($s_id){
	$this->db->select('teacher_module_wise_class.*,teacher_modules.modules')->from('teacher_module_wise_class');
	$this->db->join('teacher_modules ', 'teacher_modules.t_m_id = teacher_module_wise_class.modules_name', 'left');
	$this->db->where('teacher_module_wise_class.s_id',$s_id);
	$this->db->where('teacher_module_wise_class.status!=',2);
	return $this->db->get()->result_array();	
	}
	public function edit_teacher_modules_wise_class($s_id,$t_m_c_id){
	$this->db->select('teacher_module_wise_class.*')->from('teacher_module_wise_class');
	$this->db->where('teacher_module_wise_class.s_id',$s_id);
	$this->db->where('teacher_module_wise_class.t_m_c_id',$t_m_c_id);
	return $this->db->get()->row_array();	
	}
	public  function update_teacher_modules_wise_class($t_m_c_id,$data){
		$this->db->where('t_m_c_id',$t_m_c_id);
		return $this->db->update('teacher_module_wise_class',$data);
	}
	
	
 }
	
	
	
	
	
	
	
	