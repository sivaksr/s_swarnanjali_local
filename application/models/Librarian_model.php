<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Librarian_model extends CI_Model 

{
	function __construct() 
	{
		parent::__construct();
		$this->load->database("default");
	}
	
	public function book_details($data){
		$this->db->insert('books_list',$data);
		return $this->db->insert_id();
		
	}
	public function get_saved_user(){
		$this->db->select('*')->from('books_list');
		return $this->db->get()->result_array();
		
	}
	public function get_saved_user_edit($b_id){
		 $this->db->select('*')->from('books_list');
		$this->db->where('b_id',$b_id);
		return $this->db->get()->row_array();
	 }
	 
	 public  function save_issued_book($data){
		 $this->db->insert('issued_book',$data);
		 return $this->db->insert_id();
	 }
	 public function get_classwise_student_list($class_id){
		 $this->db->select('users.class_name,users.name,users.u_id')->from('users');
		 $this->db->where('class_name',$class_id);
		 $this->db->where('role_id',7);
		 $this->db->where('status',1);
		 return $this->db->get()->result_array();
		 
	 }
	 public  function get_issued_book_list($school_id){
		 $this->db->select('users.name,users.roll_number,books_list.book_number,books_list.book_title,books_list.author_name,books_list.publisher,books_list.department,issued_book.no_of_books_taken,issued_book.issued_date,issued_book.status,issued_book.i_b_id,issued_book.return_renew_date,issued_book.return_date')->from('issued_book');
		 $this->db->join('books_list', 'books_list.b_id = issued_book.b_id', 'left');
		 $this->db->join('users', 'users.u_id = issued_book.student_id', 'left');
		 $this->db->where('issued_book.s_id',$school_id);
		 return $this->db->get()->result_array();
	}
	public  function get_book_list($school_id){
		 $this->db->select('b_id,book_number,book_title,author_name')->from('books_list');
		 $this->db->where('books_list.s_id',$school_id);
		 $this->db->where('books_list.status',1);
		 return $this->db->get()->result_array();
	}
	
	public  function check_book_already_issued($s_id,$student_id,$book_no){
		$this->db->select('*')->from('issued_book');
		$this->db->where('issued_book.s_id',$s_id);
		$this->db->where('issued_book.student_id',$student_id);
		$this->db->where('issued_book.b_id',$book_no);
		$this->db->where('issued_book.status',1);
		return $this->db->get()->row_array();
	}
	
	public function libray_values($u_id){
		$this->db->select('u_id,s_id')->from('users');
		$this->db->where('u_id',$u_id);
		return $this->db->get()->row_array();
	}
	public  function get_student_issued_books_list($student_id){
		 $this->db->select('books_list.b_id,books_list.book_number')->from('issued_book');
		 $this->db->join('books_list', 'books_list.b_id = issued_book.b_id', 'left');
		 $this->db->where('issued_book.student_id',$student_id);
		 $this->db->where('issued_book.status',1);
		 $this->db->group_by('books_list.b_id');
		 return $this->db->get()->result_array();
	}
	public  function get_issued_book_details($book_id){
		$this->db->select('issued_date,i_b_id')->from('issued_book');
		$this->db->where('b_id',$book_id);
		return $this->db->get()->row_array();
	}
	function get_all_issued_book_details($i_b_id){
		$this->db->select('issued_book.*,users.u_id,users.name,books_list.book_number')->from('issued_book');
		$this->db->join('users', 'users.u_id = issued_book.student_id', 'left');
		$this->db->join('books_list', 'books_list.b_id = issued_book.b_id', 'left');
		$this->db->where('issued_book.i_b_id',$i_b_id);
		return $this->db->get()->row_array();
	}
	function get_resources_details($u_id){
		$this->db->select('u_id,role_id,s_id,name')->from('users');
		$this->db->where('users.u_id',$u_id);
		return $this->db->get()->row_array();
	}
	public  function get_school_lib_due_hours($s_id){
		$this->db->select('lib_book_due_time,fine_charge_amt')->from('schools');
		$this->db->where('schools.s_id',$s_id);
		return $this->db->get()->row_array();
	}
	public  function update_book_renew_details($b_i_id,$data){
		$this->db->where('i_b_id',$b_i_id);
		return  $this->db->update('issued_book',$data);
	}
	public  function adding_issued_book_fine_amount($fine){
		$this->db->insert('book_fine_list',$fine);
		return $this->db->insert_id();
	}
	public  function check_book_already($s_id,$book_number){
		$this->db->select('*')->from('books_list');
		$this->db->where('books_list.s_id',$s_id);
		$this->db->where('books_list.book_number',$book_number);
		return $this->db->get()->row_array();
	}
	public function book_list_order($s_id){
		$this->db->select('*')->from('books_list');
		$this->db->where('s_id',$s_id);
		return $this->db->get()->result_array();	
	}
	public function book_list_details($s_id,$b_id){
		$this->db->select('*')->from('books_list');
		$this->db->where('s_id',$s_id);
		$this->db->where('b_id',$b_id);
		return $this->db->get()->row_array();	
	}
      public function update_book_details($b_id,$data){
			$this->db->where('b_id',$b_id);
    	return $this->db->update("books_list",$data);
	}
	
	public function book_number_exit_details($b_id){
		  $this->db->select('*')->from('books_list');
		$this->db->where('b_id',$b_id);
		return $this->db->get()->row_array();
	}	  
	public function book_number_book_name($book_number){
		 $this->db->select('*')->from('books_list');
		$this->db->where('book_number',$book_number);
		return $this->db->get()->row_array();
	}
	public function status_details_data($b_id,$data){
	$this->db->where('b_id',$b_id);
     return $this->db->update('books_list',$data);
	 }
	public function delete_details_data($b_id){
		$this->db->where('b_id',$b_id);
		return $this->db->delete('books_list');
	}
	/* damage_book  */
	public function insert_book_damage_list($data){
	$this->db->insert('book_damage',$data);
		return $this->db->insert_id();	
		
	}
	public function damage_book_list_order($school_id){
	$this->db->select('users.name as username,books_list.book_number,class_list.name,section,book_damage.return_type,book_damage.price,book_damage.create_at')->from('book_damage');
		 $this->db->join('books_list', 'books_list.b_id = book_damage.i_b_id ', 'left');
		 $this->db->join('users', 'users.u_id = book_damage.student_id', 'left');
		 $this->db->join('class_list', 'class_list.id = book_damage.class_id', 'left');
		 $this->db->where('book_damage.s_id',$school_id);
		 return $this->db->get()->result_array();
	}
	
	public function books_number_list($s_id){
	$this->db->select('books_list.b_id,books_list.book_number')->from('books_list');
		$this->db->where('s_id',$s_id);
		$this->db->where('status',1);
		return $this->db->get()->result_array();	
	}
	
	public function class_wise_student_list($class_id){
	 $this->db->select('users.class_name,users.name,users.u_id')->from('users');
		 $this->db->where('class_name',$class_id);
		 $this->db->where('role_id',7);
		 $this->db->where('status',1);
		 return $this->db->get()->result_array();
		 
	 }
	  public  function get_issued_book_pending_list($school_id){
		 $this->db->select('users.name,users.roll_number,books_list.book_number,books_list.book_title,books_list.author_name,books_list.publisher,books_list.department,issued_book.no_of_books_taken,issued_book.issued_date,issued_book.status,issued_book.i_b_id,issued_book.return_renew_date,issued_book.return_date')->from('issued_book');
		 $this->db->join('books_list', 'books_list.b_id = issued_book.b_id', 'left');
		 $this->db->join('users', 'users.u_id = issued_book.student_id', 'left');
		 $this->db->where('issued_book.s_id',$school_id);
		 //$this->db->where('issued_book.status',1);
		 return $this->db->get()->result_array();
	}
	public  function get_issued_book_completed_list($school_id){
		 $this->db->select('users.name,users.roll_number,books_list.book_number,books_list.book_title,books_list.author_name,books_list.publisher,books_list.department,issued_book.no_of_books_taken,issued_book.issued_date,issued_book.status,issued_book.i_b_id,issued_book.return_renew_date')->from('issued_book');
		 $this->db->join('books_list', 'books_list.b_id = issued_book.b_id', 'left');
		 $this->db->join('users', 'users.u_id = issued_book.student_id', 'left');
		 $this->db->where('issued_book.s_id',$school_id);
		 $this->db->where('issued_book.status',0);
		 return $this->db->get()->result_array();
	}
	
	public  function get_student_issued_book_list($student_id){
		$this->db->select('books_list.book_number,books_list.b_id')->from('issued_book');
		$this->db->join('books_list', 'books_list.b_id = issued_book.b_id', 'left');
		$this->db->where('issued_book.student_id',$student_id);
		 $this->db->where('issued_book.status!=',0);
		 return $this->db->get()->result_array();
	}
	public  function get_total_books_list($s_id){
		$this->db->select('Count(books_list.b_id) as b_count')->from('books_list');
		$this->db->where('books_list.s_id',$s_id);
		$this->db->where('books_list.status ',1);	
		 return $this->db->get()->row_array();
	}
	public  function get_total_books_issued_list($s_id){
		$this->db->select('Count(issued_book.b_id) as b_i_count')->from('issued_book');
		$this->db->where('issued_book.s_id',$s_id);
		$this->db->where('issued_book.status ',1);	
		 return $this->db->get()->row_array();
	}
	public  function get_book_damage_list($s_id){
		$this->db->select('Count(book_damage.b_id) as b_d_count')->from('book_damage');
		$this->db->where('book_damage.s_id',$s_id);
		$this->db->where('book_damage.status ',1);	
		 return $this->db->get()->row_array();
	}
	
	public function status_return_book($i_b_id,$data){
	$this->db->where('i_b_id',$i_b_id);
     return $this->db->update('issued_book',$data);
	 }
	
	public function edit_renewal_list($s_id,$i_b_id){
	 $this->db->select('issued_book.*')->from('issued_book');
		$this->db->where('s_id',$s_id);
		$this->db->where('i_b_id',$i_b_id);
		return $this->db->get()->row_array();		
	}
	
	public function get_class_wise_student_list($class_id){
	 $this->db->select('users.class_name,users.name,users.u_id')->from('users');
		 $this->db->where('class_name',$class_id);
		 $this->db->where('role_id',7);
		 $this->db->where('status',1);
		 return $this->db->get()->result_array(); 
	 }
	public function update_renewal_book($i_b_id,$data){
	$this->db->where('i_b_id',$i_b_id);
     return $this->db->update('issued_book',$data);
	 }
	
	
}
	
	
	
