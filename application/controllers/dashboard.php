<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
//		$this->load->model("media_model");
		$this->load->model("users_model");
		$this->load->model("settings_model");
	}
	
	function is_logged_in()
	{
		if($this->session->userdata('is_logged_in')!=TRUE)
			redirect("login");
	}

	private function common()
	{
		$userid=explode(" ",$this->session->userdata('userid'));
		$name=explode(" ",$this->session->userdata('name'));
		$data['name']=$name[0];
		$data['userid']=$userid[0];
		// find avatar media id
		$avatar=$this->users_model->getuserinfo($this->session->userdata('userid'),"profile_pic");
		if($avatar->profile_pic==0){
			$data['profile_pic']=base_url()."assets/dist/img/avatar5.png";	
		}
		else
		{
//			$avatar=$this->media_model->getmediainfo($avatar->avatar_media_id,"media_url");
	//		$data['profle_pic']=$avatar->media_url;
		}
		$data['settings']=$this->settings_model->getAll();
		foreach($data['settings'] as $setting){
			$data[$setting->settings_code]=$setting->settings_value;
		}
		return $data;	
	}
		
	public function index()
	{
		$data=$this->common();
		$data['title']="Dashboard";
		$this->load->view('dashboard',$data);
	}
}