<?php
class User_model extends Model
{
	function User_model()
	{
		parent::Model();
	}
	
	function getUser($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('user_id',$id);
			return $this->db->get('tb_user')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('user_id','desc');
			return $this->db->get('tb_user')->result_array();
		endif;
	}
	
	function addUser($data)
	{
		$this->db->insert('tb_user',$data);
	}
	
	function editUser($id,$data)
	{
		$this->db->where('user_id',$id);
		$this->db->update('tb_user',$data);
	}
	
	function deleteUser($id){
		$this->db->where('user_id',$id);
		$this->db->delete('tb_user');
	}
}
