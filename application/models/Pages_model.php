<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model{
	
	public function all()
	{
		$this->db->select('*');
		$this->db->from('pages');
		$this->db->order_by('page_order');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
				/*
				$this->db->select('*');
				$this->db->from('pages');
				$this->db->where("page_parent",$row->page_id);
				$this->db->order_by('page_order');
				$query1 = $this->db->get();
				if($query1->num_rows()>0) {
					foreach ($query1->result() as $row1) {
						$data[]=array("subpages"=>$row1);
						echo "- >".$row1->page_id;
					}
				}*/
			}

			return $data;
		}
	}
	
	public function add($data)
	{
		$query = $this->db->get_where('pages', array("page_name" => $data['page_name']));
		if($query->num_rows()==0) {
			$this->db->insert("pages",$data);
		}
		return true;
	}

	public function select($ID)
	{
		$query = $this->db->get_where('pages', array("page_id" => $ID));
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
		$query = $this->db->get_where('pages', array("page_id" => $ID));
		if($query->num_rows()==1)
		{
			$this->db->where('page_id', $ID);
			$this->db->update('pages', $data);
		}
	}

	public function insert_access($data){
		for($i=0;$i<count($data);$i++){
			$query = $this->db->get_where('user_page_access', array("page_id" => $data[$i]['page_id'],
				"user_id" => $data[$i]['user_id']));
			if($query->num_rows()==0) {
				$this->db->insert("user_page_access",$data[$i]);
			}
		}
		return true;
	}
	public function get_access_info($userid, $pageid){
		$query = $this->db->get_where('user_page_access', array("page_id" => $pageid,
			"user_id" => $userid));
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row->page_access;
			}
			return $data;
		}
		return false;
	}
	public function update_access_info($userid, $pageid, $data){

		$query = $this->db->get_where('user_page_access', array("page_id" => $pageid,
			"user_id" => $userid));
		if($query->num_rows()>0)
		{
			$this->db->where('page_id', $pageid);
			$this->db->where('user_id', $userid);
			$this->db->update('user_page_access', $data);
			return $data;
		}
		else{
			$data['page_id']=$pageid;
			$data['user_id']=$userid;
			$this->db->insert("user_page_access",$data);
		}
		return false;
	}
}