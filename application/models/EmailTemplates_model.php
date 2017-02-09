<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailTemplates_model extends CI_Model{
	
	public function all()
	{
		$query = $this->db->get('email_templates');
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
		$query = $this->db->get_where('email_templates', array("email_tmpl_title" => $data['title']));
		if($query->num_rows()==0)
		{
			$this->db->insert("email_templates",$data);
			return true;
		}
	}

	public function custom($field,$value)
	{
		$query = $this->db->get_where('email_templates', array($field => $value));
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
		$query = $this->db->get_where('email_templates', array("email_tmpl_id" => $ID));
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

		$query = $this->db->get_where('email_templates', array("email_tmpl_id" => $ID));
		if($query->num_rows()==1)
		{
			$this->db->where('email_tmpl_id', $ID);
			$this->db->update('email_templates', $data);
		}
	}
}