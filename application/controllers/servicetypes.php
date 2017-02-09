<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicetypes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_logged_in')!=TRUE)
			redirect("login");
//		$this->load->model("media_model");
		$this->load->model("users_model");
		$this->load->model("ServiceType_model");
		$this->load->model("Renewables_model");
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
		$data['ServiceTypes']=$this->ServiceType_model->all();
		if(count($data['ServiceTypes'])>0){
			foreach($data['ServiceTypes'] as $st){
				$clientids=$this->Renewables_model->service_accounts($st->service_type_ID);
				
				if($clientids!=null)
					$st->num_clients=count(array_unique($clientids));
				else
					$st->num_clients=0;
			}
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
		$data['title']="Service Types";
		if($this->input->post('service_type')){
			$inputs=array("name"=>$this->input->post('service_type'));
			if($this->input->post('renewable')!=null){
				$inputs['renewable']=true;
			}
			$this->ServiceType_model->add($inputs);
			redirect("ServiceTypes");
		}

		$this->load->view('servicetypes',$data);
	}

	public function edit($ID)
	{
		$data=$this->common();
		$data['title']="Service Types";
		$data['ServiceTypeInfo']=$this->ServiceType_model->select($ID);
		if($this->input->post('service_type')){
			$inputs=array("name"=>$this->input->post('service_type'));
			if($this->input->post('renewable')!=null){
				$inputs['renewable']=true;
			}
			$this->ServiceType_model->update($ID,$inputs);	
			redirect("ServiceTypes");
		}
		$this->load->view('servicetypes',$data);
	}

}