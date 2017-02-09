<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailTemplates extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_logged_in')!=TRUE)
			redirect("login");
//		$this->load->model("media_model");
		$this->load->model("users_model");
		$this->load->model("Clients_model");
		$this->load->model("EmailTemplates_model");
		$this->load->model("settings_model");
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
		$data['Clients']=$this->Clients_model->all();
		$data['EmailTemplates']=$this->EmailTemplates_model->all();
		$data['title']="Email Templates";
		$data['settings']=$this->settings_model->getAll();
		foreach($data['settings'] as $setting){
			$data[$setting->settings_code]=$setting->settings_value;
		}
		return $data;	
	}

	public function index()
	{
		$data=$this->common();
		if($this->input->post('new_template')!=null){

			$inputs=array(
				'email_tmpl_title' => $this->input->post('title'),
				'email_tmpl_subject' => $this->input->post('subject'),
				'email_tmpl_content' => $this->input->post('content'));
			$this->EmailTemplates_model->add($inputs);
			redirect("EmailTemplates");
		}
		$this->load->view('EmailTemplates',$data);
	}

	public function edit($ID)
	{
		$data=$this->common();
		$data['EmailTemplateInfo']=$this->EmailTemplates_model->select($ID);
		if($this->input->post('edit_template')!=null){
			$inputs=array(
				'email_tmpl_subject' => $this->input->post('subject'),
				'email_tmpl_content' => $this->input->post('content'));
			$this->EmailTemplates_model->update($ID,$inputs);
			redirect("EmailTemplates");	
		}
		$this->load->view('EmailTemplates',$data);
	}
}