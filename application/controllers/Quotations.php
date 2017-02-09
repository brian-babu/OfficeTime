<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotations extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Muscat');
		if($this->session->userdata('is_logged_in')!=TRUE)
			redirect("login");
//		$this->load->model("media_model");
		$this->load->model("users_model");
		$this->load->model("ServiceType_model");
		$this->load->model("Clients_model");
		$this->load->model("Renewables_model");
		$this->load->model("EmailTemplates_model");
		$this->load->model("Quotations_model");
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
		$data['ServiceTypes']=$this->ServiceType_model->custom("renewable",1);
		$data['Quotations']=$this->Quotations_model->all();
		$data['clients']=$this->Clients_model->all();
		$data['free_service_expiry']=$this->Renewables_model->free_service_expiry();
		$data['settings']=$this->settings_model->getAll();
		foreach($data['settings'] as $setting){
			$data[$setting->settings_code]=$setting->settings_value;
		}
		return $data;	
	}

	public function index()
	{
		$data=$this->common();
		$data['title']="Quotations";
		if($this->input->post('add_quotation')!=null){
			$inputs=array(
				'client_id' => $this->input->post('client'),
				'towards' => $this->input->post('towards'),
				'charge' => $this->input->post('charge'),
				'service_type_ID' => $this->input->post('service_type'),
				'creation_date' => strtotime($this->input->post('creationdate')),
				'expiry_date' => strtotime($this->input->post('expirydate')),
				'remarks	' => $this->input->post('remarks'));
				
			$this->Quotations_model->add($inputs);
			redirect("Quotations");
		}

		$this->load->view('Quotations',$data);
	}

	public function edit($ID)
	{
		$data=$this->common();
		$data['title']="Quotations";
		$data['RenewablesInfo']=$this->Renewables_model->select($ID);
		if($this->input->post('edit_account')!=null){
			$inputs=array(
				'client_id' => $this->input->post('client'),
				'towards' => $this->input->post('towards'),
				'charge' => $this->input->post('charge'),
				'service_type_ID' => $this->input->post('service_type'),
				'creation_date' => strtotime($this->input->post('creationdate')),
				'expiry_date' => strtotime($this->input->post('expirydate')),
				'remarks	' => $this->input->post('remarks'));
			$this->Renewables_model->update($ID,$inputs);	
			redirect("Quotations");
		}
		$this->load->view('Quotations',$data);
	}

	public function NotifyUser(){
		if($this->input->post('HA_ids')!=null){
			$data=$this->common();
			$data['EmailTemplates']=$this->EmailTemplates_model->all();
			$data['title']="Expiry Notification for Users";
			$data['ha_ids']=$this->input->post('HA_ids');
			$ha_ids=explode("/",$this->input->post('HA_ids'));
			foreach ($ha_ids as $id) {
				$data['client_account_info'][]=$this->Renewables_model->select_NotifyUser($id);
			}
//			var_dump($data['client_account_info']);
//			exit;
			$data['notify_type']=$this->input->post('notify_type');
			$this->load->view('NotifyUser',$data);
		}
		else
		{
			redirect("Quotations");
		}

	}

	public function NotifyUser_fetchcontent(){

		$email_tmpl=$this->EmailTemplates_model->select($this->input->post('email_tmpl_id'));
		foreach ($email_tmpl as $info) {
		//	print_r($info)."<br>"; // for debugging
		//	echo $info->email_tmpl_content;
			$content['subject']=$info->email_tmpl_subject;
			$content['content']=$info->email_tmpl_content;
			$data[]=$content;
		}
		echo json_encode($data);
	}

	public function NotifyUser_Previews($jQuery=null){
		$ha_ids=explode("/",$this->input->post('ha_ids'));


		$template_subject=$this->input->post('email_tmpl_subject');
		$template_content=$this->input->post('email_tmpl_content');
		foreach ($ha_ids as $id) {
			$client_account_info=$this->Renewables_model->select_NotifyUser($id);
			$template_content_edit=str_replace("{client_title}",$client_account_info[0]->title,$template_content);
			$template_subject_edit=str_replace("{client_title}",$client_account_info[0]->title,$template_subject);
			
			$template_content_edit=str_replace("{client_name}",$client_account_info[0]->contact_name,$template_content_edit);
			$template_subject_edit=str_replace("{client_name}",$client_account_info[0]->title,$template_subject_edit);

			$template_content_edit=str_replace("{service_type_name}",$client_account_info[0]->name,$template_content_edit);
			$template_subject_edit=str_replace("{service_type_name}",$client_account_info[0]->name,$template_subject_edit);

			$template_content_edit=str_replace("{towards_name}",$client_account_info[0]->towards,$template_content_edit);
			$template_subject_edit=str_replace("{towards_name}",$client_account_info[0]->towards,$template_subject_edit);

			$this->load->helper('date');
			$expiry=str_replace(" 00:00:00 CET","",standard_date("DATE_RFC850",$client_account_info[0]->expiry_date));
			$template_content_edit=str_replace("{expiry_date}",$expiry,$template_content_edit);

			$content['id']=$id;
			$content['client_id']=$client_account_info[0]->client_ID;
			$content['subject']=$template_subject_edit;
			$content['name']=$client_account_info[0]->contact_name;
			$content['towards']=$client_account_info[0]->towards;
			$content['email']=$client_account_info[0]->email;
			$content['content']=$template_content_edit;
			$data[]=$content;
		}
		if($jQuery!=null)
			echo json_encode($data);
		else
			return $data;
	
//		echo implode($template_content['content']);
	}

	public function SendNotification(){
		$email_tmpl=$this->EmailTemplates_model->select($this->input->post('email_tmpl_id'));
		$template_subject=$this->input->post("email_tmpl_subject");
		$template_content=$this->input->post("email_tmpl_content");
		$mails=$this->NotifyUser_Previews(0);
		// var_dump($mails); 
		foreach ($mails as $mail) {
			$headers = "From: support@cirkle-it.com\r\n";
			$headers .= "CC: support@cirkle-it.com\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$content="<html><head><link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'></head><body style='margin: 5px; font-family: Open Sans, sans-serif;'><div style='border: 1px solid #ccc; padding: 20px; font-size: 15px;'>".$mail['content']."</div></body></html>";
			if(mail($mail['email'],$mail['subject'],$content,$headers)==true){
				/* need to put code for inserting notifications in the database */
				$data=array(
					"client_id" => $mail['client_id'],
					"sent_date" => strtotime("now"),
					"renewables_id" => $mail['id']
					);
				$this->notifications_model->add($data);
			}
			else
				$error=1;
		}
		if(!isset($error)){
			redirect("Quotations");
		}
		else
			$this->NotifyUser();
	}

}