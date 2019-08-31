<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();	
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('user_agent');
		$this->load->helper('directory');
		$this->load->helper('security');
		$this->load->library('zend');
		$this->load->model('Home_model');
		
		}
	public function index()
	{	
			$this->load->view('homepage/header');
			$this->load->view('homepage/index');
			$this->load->view('homepage/footer');
	}
	
	
	
	
	
	
	
}
