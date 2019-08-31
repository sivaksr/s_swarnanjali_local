<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function save_class_books($data){
	$this->db->insert('class_books',$data);
	return $this->db->insert_id();
		
	}
	 public function get_class_wise_books_list($s_id){
	$this->db->select('class_books.*,class_list.name,class_list.section')->from('class_books');
	$this->db->join('class_list ', 'class_list.id = class_books.class_id', 'left');
	$this->db->where('class_books.s_id', $s_id);
	$this->db->where('class_books.status !=', 2);
	return $this->db->get()->result_array();
  }

	public function edit_class_wise_books_list($s_id,$id){
	$this->db->select('class_books.*,class_list.name,class_list.section')->from('class_books');
	$this->db->join('class_list ', 'class_list.id = class_books.class_id', 'left');
	$this->db->where('class_books.s_id', $s_id);
	$this->db->where('class_books.id', $id);
	return $this->db->get()->row_array();
	}
	
	public function update_class_wise_books($id,$data){
	$this->db->where('id',$id);
    return $this->db->update("class_books",$data);		
	}	
	public function delete_class_wise_book($id){
	$this->db->where('id',$id);
	return $this->db->delete('class_books');
	}	
	
	 public function check_book($class_id,$id){
	$this->db->select('class_books.id')->from('class_books');
	$this->db->where('class_books.class_id',$class_id);
	$this->db->where('class_books.books',$id);
	return $this->db->get()->row_array();
	}
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
}
	
	
	
	
	
	
	
	