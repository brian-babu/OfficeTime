<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quotations_model extends CI_Model{
	
	public function all()
	{
		$query = $this->db->get('quotations');
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
		$query = $this->db->get_where('clients', array("mobile" => $data['mobile']));
		if($query->num_rows()==0)
		{
			$this->db->insert("clients",$data);
			return true;
		}
	}

	public function select($ID)
	{
		$query = $this->db->get_where('clients', array("client_ID" => $ID));
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

		$query = $this->db->get_where('clients', array("client_ID" => $ID));
		if($query->num_rows()==1)
		{
			$this->db->where('client_ID', $ID);
			$this->db->update('clients', $data);
		}
	}
}