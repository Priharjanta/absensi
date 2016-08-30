<?php
class Jemaat_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getJemaat($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE,$key=FALSE)
	{
		if (!$query):
			$this->db->where('m_jmt_id',$id);
			return $this->db->get('tb_m_jemaat')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('m_jmt_id','desc');
			return $this->db->get('tb_m_jemaat')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_m_jemaat')->result_array();
		elseif($query=='cari'):
			$this->db->like('m_jmt_nama', $key); 
			return $this->db->get('tb_m_jemaat')->result_array();
		endif;
	}

	function addJemaat($data)
	{
		$this->db->insert('tb_m_jemaat',$data);
	}

	function editJemaat($id,$data)
	{
		$this->db->where('m_jmt_id',$id);
		$this->db->update('tb_m_jemaat',$data);
	}

	function deleteJemaat($id){
		$this->db->where('m_jmt_id',$id);
		$this->db->delete('tb_m_jemaat');
	}
	
	
}

