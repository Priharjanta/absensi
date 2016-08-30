<?php
class Wilayah_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getWilayah($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('m_wil_id',$id);
			return $this->db->get('tb_m_wil')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('m_wil_id','desc');
			return $this->db->get('tb_m_wil')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_m_wil')->result_array();
		endif;
	}

	function addWilayah($data)
	{
		$this->db->insert('tb_m_wil',$data);
	}

	function editWilayah($id,$data)
	{
		$this->db->where('m_wil_id',$id);
		$this->db->update('tb_m_wil',$data);
	}

	function deleteWilayah($id){
		$this->db->where('m_wil_id',$id);
		$this->db->delete('tb_m_wil');
	}
	
	
}

