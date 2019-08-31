<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Homepage extends CI_Controller {
public function __construct() 
	{
		parent::__construct();	
			$this->load->model('Homepage_model');
	}
	public function index()
	{	
		
				
	$this->load->view('homepage/header');
	$this->load->view('page/index');
	$this->load->view('html/footer');
				
		
	}
	
	public function program()
	{	
		
				
	$this->load->view('homepage/header');
	$this->load->view('page/program-content');
	$this->load->view('html/footer');
				
		
	}
	
	
}

