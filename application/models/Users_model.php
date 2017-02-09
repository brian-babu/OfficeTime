<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users_model extends CI_Model{
	
	public function all()
	{
		$query = $this->db->get('users');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}

	public function getusername($username){
		/* Used while logging in.
		Checking if a username exists for comparing the entered password*/
		$this->db->select('ID, password, name');
		$query = $this->db->get_where('users', array("username" => $username));
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				return $row;
			}
		}
		else
			return false;
	}

	public function select($ID)
	{
		$query = $this->db->get_where('users', array("ID" => $ID));
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	

	public function record_login_activity($userid){
		/* Used after successful password match and for updating the user's login acitvity*/
		$query = $this->db->get_where('users', array("ID" => $userid));
		if($query->num_rows()==1)
		{
			$data=array(
				"last_login"	=>	$_SERVER['REMOTE_ADDR']
			);
			$this->db->where('ID', $userid);
			$this->db->update('users', $data);
		}
	}
	
	public function getuserinfo($userid,$fields=NULL)
	{
		/*A hybrid function which returns the userinfo,
		By default $fields is NULL and if specified the exact field will be returned*/
		if($fields!=NULL)
			$query = $this->db->select($fields);
		$query = $this->db->get_where('users', array("ID" => $userid));
		if($query->num_rows()==1){
			foreach ($query->result() as $row){
				return $row;
			}
		}
		return false;
	}
	
	public function getAlluserinfo($fields=NULL)
	{
		/*A hybrid function which returns the userinfo,
		By default $fields is NULL and if specified the exact field will be returned*/
		if($fields!=NULL)
			$query = $this->db->select($fields);			
		$query = $this->db->get('users');
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
		return false;
	}
	
	public function add($data)
	{
		$query = $this->db->get_where('users', array("email"=>$data['email']));
		if($query->num_rows()==0)
		{
			$query1 = $this->db->get_where('users', array("username"=>$data['username']));
			if($query1->num_rows()==0)
			{
				
				$query2 = $this->db->get_where('users', array("mobile"=>$data['mobile']));
				if($query2->num_rows()==0)
				{
					$this->db->insert("users",$data);
					return true;
				}
				else
					return "User with same phone already exists!";
			}
			else
				return "User with same username already exists!";
		}
		else
			return "User with same email already exists!";
	}
	
	public function edit($ID,$data){
		$query1 = $this->db->get_where('users', array("ID"=>$ID));
		if($query1->num_rows()==1){
			$query=$this->db->get_where('users', array('email'=>$data['email'],'ID!='=> $ID));
			if($query->num_rows()==0)
			{
				$query1 = $this->db->get_where('users', array("mobile"=>$data['mobile'],'ID!='=> $ID));
				if($query1->num_rows()==0)
				{
					$this->db->where('ID', $ID);
					$this->db->update('users', $data);
					return true;
				}
				else
					return "User with same mobile already exists!";
			}
			else
				return "User with same email already exists!";
		}
	}

	public function toggle_access($ID,$data){

		$query = $this->db->get_where('users', array("ID"=>$ID));
		if($query->num_rows()>0)
		{
			$this->db->where('ID', $ID);
			$this->db->update('users', $data);
			return true;
		}
		else
			return false;
	}
}