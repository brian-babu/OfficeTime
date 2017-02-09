<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications_model extends CI_Model{
	
	public function last($clientid, $haid)
	{
		
		$this->db->select('sent_date');
		$this->db->from('notifications');
		$this->db->where(array('client_id'=>$clientid,
			'renewables_id'=>$haid));
		$this->db->order_by('sent_date');
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
		$this->db->insert("notifications",$data);
		return true;
	}
}