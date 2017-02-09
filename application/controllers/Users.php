<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_logged_in')!=TRUE)
			redirect("login");
//		$this->load->model("media_model");
		$this->load->model("ServiceType_model");
		$this->load->model("Users_model");
		$this->load->model("Pages_model");
		$this->load->model("settings_model");
	}

	private function common()
	{
		$userid=explode(" ",$this->session->userdata('userid'));
		$name=explode(" ",$this->session->userdata('name'));
		$data['name']=$name[0];
		$data['userid']=$userid[0];
		// find avatar media id
		$avatar=$this->Users_model->getuserinfo($this->session->userdata('userid'),"profile_pic");
		if($avatar->profile_pic==0){
			$data['profile_pic']=base_url()."assets/dist/img/avatar5.png";	
		}
		else
		{
//			$avatar=$this->media_model->getmediainfo($avatar->avatar_media_id,"media_url");
	//		$data['profle_pic']=$avatar->media_url;
		}
		$data['Pages']=$this->Pages_model->all();
		$data['settings']=$this->settings_model->getAll();
		foreach($data['settings'] as $setting){
			$data[$setting->settings_code]=$setting->settings_value;
		}
		return $data;	
	}

	public function index()
	{
		$data=$this->common();
		$data['title']="Users";
		if($this->input->post('add_user')!=null){
		if(strlen($this->input->post('name'))==0||$this->input->post('name')==" "){ $data['errors'][]="Enter Name"; }
		if(strlen($this->input->post('email'))==0||$this->input->post('email')==" "){ $data['errors'][]="Enter Email"; }
		if(strlen($this->input->post('username'))==0||$this->input->post('username')==" "){ $data['errors'][]="Enter Username"; }
		if(strlen($this->input->post('mobile'))==0||$this->input->post('mobile')==" "){ $data['errors'][]="Enter Mobile"; }
		if(strlen($this->input->post('password'))==0||$this->input->post('password')==" "){ $data['errors'][]="Enter Password"; }
		if(strlen($this->input->post('retype_password'))==0||$this->input->post('retype_password')==" "){ $data['errors'][]="Please Retype the password"; }
		if($this->input->post('password')!=$this->input->post('retype_password')){ $data['errors'][]="Password do no match";  }
			if(!isset($data['errors'])) {
				
		$config['algorithm'] = 'whirlpool';
		$config['iterations'] = 500;
		$config['hash_length'] = 64;
		$config['salt_length'] = 16;
		$this->pbkdf2->initialize($config);
		
				$pbkdf2 = $this->pbkdf2->encrypt($this->input->post('password'));

				$inputs=array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'),
					'username' => $this->input->post('username'),
					'password' => $pbkdf2['hash'],
				);
				$result=$this->Users_model->add($inputs);
				if($result===true){ // if the is 'true' and nothing else 
					foreach ($data['Pages'] as $page) {
						@$pages[]=array('user_id'=>$this->db->insert_id(),
							'page_id'=>$page->page_id,
							'page_access'=>$page->page_default_access);
					}					
					$this->Pages_model->insert_access($pages);
					if($this->input->post('send_config')!=null){
						$msg="Hi ".$this->input->post('name')."\n
						Please find the below given Portal Credentials\n
						Username: ".$this->input->post('username')."\n
						Password: ".$this->input->post('password')."
						";
						@mail($this->input->post('email'), 'Login Credentials for Portal', $msg);
					}
					redirect("Users/Permissions");
				}
				else{
					$data['errors'][]=$result;
				}
			}
		}
		$data['Users']=$this->Users_model->all();
		$this->load->view('users',$data);
	}

	public function edit($ID)
	{
		$data=$this->common();
		$data['title']="Users";
		$data['UserInfo']=$this->Users_model->select($ID);
		if($this->input->post('edit_user')!=null){
			if($this->input->post('password')==$this->input->post('retype_password')){
				$pbkdf2 = $this->pbkdf2->encrypt($this->input->post('password'));
				$inputs=array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'mobile' => $this->input->post('mobile'),
					'username' => $this->input->post('username'),
					'password' => $pbkdf2['hash'],
				);
				$result=$this->Users_model->edit($ID,$inputs);
				if($result===true){ // if the is 'true' and nothing else 
					redirect("Users");
				}
				else{
					$data['errors'][]=$result;
				}
			}
		}
		$data['Users']=$this->Users_model->all();
		$this->load->view('users',$data);
	}

	public function permissions(){
		$data=$this->common();
		$data['title']="User Permissions";
		$data['Users']=$this->Users_model->all();
		foreach ($data['Users'] as $user) {
			foreach ($data['Pages'] as $page) {
				$accessinfo=$this->Pages_model->get_access_info($user->ID,$page->page_id);
				if($accessinfo==false){ $accessinfo[0]="0"; }
				$data['user_perms'][]=array('userid'=>$user->ID,'pageid'=>$page->page_id, 'pageaccess'=>$accessinfo[0]);
//				echo $user->ID." - ".$page->page_id." - ".$accessinfo[0]."<br>";
			}
		}
		//var_dump($data['user_perms']);
		
		$this->load->view('user_perms',$data);	
	}

	public function access_change(){
		$accessinfo=$this->Pages_model->get_access_info($this->input->post('user_id'), $this->input->post('page_id'));
		if($accessinfo==false){ $accessinfo[0]="0"; }
//		echo $accessinfo[0];
		$data['page_access']=0;
		if($accessinfo[0]==0){$data['page_access']=1;}
		
		$result=$this->Pages_model->update_access_info($this->input->post('user_id'), $this->input->post('page_id'),$data);	
	}
}