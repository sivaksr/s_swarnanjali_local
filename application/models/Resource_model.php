<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resource_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	public function save_rsources($data){
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	public  function get_resource_list($u_id){
		$this->db->select('users.*,role.name as role_name')->from('users');
		$this->db->join('role', 'role.id = users.role_id', 'left');

		$this->db->where('users.role_id !=',1);
		$this->db->where('users.role_id !=',2);
		$this->db->where('users.status !=',2);
		$this->db->where('users.create_by',$u_id);
		$this->db->order_by('users.u_id',"DESC");
		return $this->db->get()->result_array();
	}
	function get_resources_details($u_id){
		$this->db->select('users.*')->from('users');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
	
	public  function check_email_exits($email){
		$this->db->select('email')->from('users');
		$this->db->where('email',$email);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	public  function check_mobile_exits($mobile){
		$this->db->select('u_id,mobile,role_id')->from('users');
		$this->db->where('mobile',$mobile);
		$this->db->where('status',1);
		return $this->db->get()->row_array();
	}
	

}