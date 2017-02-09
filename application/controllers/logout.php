<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model("users_model");
	}
	
	function is_logged_in()
	{
		if($this->session->userdata('is_logged_in')==TRUE)
		{
			$this->session->sess_destroy();
		}
	}
	
	public function index()
	{
		redirect('login');
	}
}