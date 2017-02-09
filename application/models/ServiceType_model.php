<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ServiceType_model extends CI_Model{
	
	public function all()
	{
		$query = $this->db->get('service_type');
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
		$query = $this->db->get_where('service_type', array("name" => $data['name']));
		if($query->num_rows()==0)
		{
			$this->db->insert("service_type",$data);
			return true;
		}
	}

	public function custom($field,$value)
	{
		$query = $this->db->get_where('service_type', array($field => $value));
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}

	public function select($ID)
	{
		$query = $this->db->get_where('service_type', array("service_type_ID" => $ID));
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

		$query = $this->db->get_where('service_type', array("service_type_ID" => $ID));
		if($query->num_rows()==1)
		{
			$this->db->where('service_type_ID', $ID);
			$this->db->update('service_type', $data);
		}
	}
}