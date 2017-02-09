<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		$this->load->model("users_model");
		$this->load->model("settings_model");
	}
	
	function is_logged_in()
	{
		if($this->session->userdata('is_logged_in')==TRUE)
			redirect("dashboard");
	}
	
	public function index()
	{
		$config['algorithm'] = 'whirlpool';
		$config['iterations'] = 500;
		$config['hash_length'] = 64;
		$config['salt_length'] = 16;
		$this->pbkdf2->initialize($config);

	//	$pbkdf2 = $this->pbkdf2->encrypt("admin", TRUE);
	//	var_dump($pbkdf2);
	//	exit;
		
		$data = array(
		"title"	=>	"Admin Login");
		
		if(isset($_POST['submit'])) {
	
			$username=$this->input->post("username", TRUE);
			$password = $this->input->post('password', TRUE);
			
			$user = $this->users_model->getusername($username);
			if($user!=false) {
				$pbkdf2 = $this->pbkdf2->encrypt($password, $user->password);
				// check if password are EXACTLY the same
				if ($pbkdf2['hash'] === $user->password) {
					if($this->input->post("remember", TRUE)==true){
						$cookie = array(
							'name'   => $username,
							'value'  => md5($pbkdf2['hash']),
							'expire' => '86500',
							'domain' => '.localhost',
							'path'   => '/',
							'prefix' => 'user_',
							'secure' => TRUE
						);
						
						$this->input->set_cookie($cookie);	
					}
					$data=array(
						"userid" => $user->ID,
						"username" => $username,
						"name" => $user->name,
						"user_type" => 2,
						"is_logged_in" => TRUE);
					$this->session->set_userdata($data);
				//	$this->users_model->record_login_activity($user->ID);
					redirect('dashboard');		
				}
				else
				{
					$data['error']="Invalid Username / Password";
				}
			}

				
		}
		$data['settings']=$this->settings_model->getAll();
		foreach($data['settings'] as $setting){
			$data[$setting->settings_code]=$setting->settings_value;
		}
		$this->load->view('login',$data);
	}
}