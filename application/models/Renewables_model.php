<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Renewables_model extends CI_Model{
	
	public function all()
	{
		$this->db->select('*');
		$this->db->from('hosting_accounts');
		$this->db->join('service_type', 'hosting_accounts.service_type_ID = service_type.service_type_ID');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	public function add($data)
	{
		$query = $this->db->get_where('hosting_accounts', array("towards" => $data['towards']));
		if($query->num_rows()==0)
		{
			$this->db->insert("hosting_accounts",$data);
			return true;
		}
	}

	public function select($ID)
	{
		$query = $this->db->get_where('hosting_accounts', array("ID" => $ID));
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}

	public function select_NotifyUser($ID)
	{
		$this->db->select('*');
		$this->db->from('hosting_accounts');
		$this->db->join('clients', 'hosting_accounts.client_ID = clients.client_ID');
		$this->db->join('service_type', 'hosting_accounts.service_type_ID = service_type.service_type_ID');
		$this->db->where('hosting_accounts.ID', $ID);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	public function update($ID,$data){
		$query = $this->db->get_where('hosting_accounts', array("ID" => $ID));
		if($query->num_rows()==1)
		{
			$this->db->where('ID', $ID);
			$this->db->update('hosting_accounts', $data);
		}
	}

	public function service_accounts($ID)
	{
		$query = $this->db->get_where('hosting_accounts', array("service_type_ID" => $ID));
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row->client_ID;
			}
			return $data;
		}
	}

	public function free_service_expiry(){
		$query = $this->db->query("SELECT * FROM hosting_accounts WHERE charge=0 AND expiry_date >".strtotime("+0 days")." AND expiry_date <".strtotime("+7 days"));
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row) {
				$data[]=$row;
			}
			return $data;
		}
	}

	public function expires($days){
		switch($days)
		{
			case "7":
	//		echo "SELECT * FROM hosting_accounts WHERE charge=0 AND expiry_date >".strtotime("+0 days")." AND expiry_date <".strtotime("+7 days");
				$query = $this->db->query("SELECT * FROM hosting_accounts WHERE charge!=0 AND expiry_date >".strtotime("+0 days")." AND expiry_date <".strtotime("+7 days"));
	//			echo $query->num_rows();
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row) {
						$data[]=$row;
					}
					return $data;
				}
			break;

			case "15":
	//		echo "SELECT * FROM hosting_accounts WHERE charge=0 AND expiry_date >".strtotime("+0 days")." AND expiry_date <".strtotime("+7 days");
				$query = $this->db->query("SELECT * FROM hosting_accounts WHERE charge!=0 AND expiry_date >".strtotime("+7 days")." AND expiry_date <".strtotime("+15 days"));
	//			echo $query->num_rows();
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row) {
						$data[]=$row;
					}
					return $data;
				}
			break;

			case "30":
	//		echo "SELECT * FROM hosting_accounts WHERE charge=0 AND expiry_date >".strtotime("+0 days")." AND expiry_date <".strtotime("+7 days");
				$query = $this->db->query("SELECT * FROM hosting_accounts WHERE charge!=0 AND expiry_date >".strtotime("+15 days")." AND expiry_date <".strtotime("+30 days"));
	//			echo $query->num_rows();
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row) {
						$data[]=$row;
					}
					return $data;
				}
			break;
			default:
				$query = $this->db->query("SELECT * FROM hosting_accounts WHERE charge!=0 AND expiry_date <".strtotime("+".$days." days"));
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row) {
						$data[]=$row;
					}
					return $data;
				}
			break;


		}

	}
}