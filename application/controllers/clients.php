<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clients extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_logged_in')!=TRUE)
			redirect("login");
//		$this->load->model("media_model");
		$this->load->model("users_model");
		$this->load->model("ServiceType_model");
		$this->load->model("clients_model");
		$this->load->model("settings_model");
	}

	private function common()
	{/*
		$user_perms=$this->users_model->getuserinfo($this->session->userdata('userid'),"user_permissions");
		$perms=json_decode($user_perms->user_permissions);
		foreach($perms as $perm){
			for($i=0;$i<count($perm);$i++){
				if(substr_count(current_url(),$perm[$i]->page_name)>0&&$perm[$i]->page_access==0)
					redirect("Error404");
			}
		};*/
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
		$data['title']="Clients";
		if($this->input->post('add_client')!=null){
			
			$inputs=array(
				'title' => $this->input->post('title'),
				'company_name' => $this->input->post('company_name'),
				'contact_name' => $this->input->post('contact_name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'));
			$this->clients_model->add($inputs);
			redirect("clients");
		}
		$data['clients']=$this->clients_model->all();
		$this->load->view('clients',$data);
	}

	public function edit($ID)
	{
		$data=$this->common();
		$data['title']="Clients";
		$data['clientInfo']=$this->clients_model->select($ID);
		if($this->input->post('edit_client')!=null){
			$inputs=array(
				'title' => $this->input->post('title'),
				'company_name' => $this->input->post('company_name'),
				'contact_name' => $this->input->post('contact_name'),
				'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'));
			$this->clients_model->update($ID,$inputs);	
			redirect("clients");
		}
		$data['clients']=$this->clients_model->all();
		$this->load->view('clients',$data);
	}

}