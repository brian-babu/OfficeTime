<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model{

	public function getAll()
	{
		$query = $this->db->get('settings');
		if($query->num_rows()>0)
		{
			return $query->result();
		}
	}
}