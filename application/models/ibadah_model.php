<?php
class Ibadah_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getIbadah($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('m_ib_id',$id);
			return $this->db->get('tb_m_ibadah')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('m_ib_id','desc');
			return $this->db->get('tb_m_ibadah')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_m_ibadah')->result_array();
		endif;
	}

	function addIbadah($data)
	{
		$this->db->insert('tb_m_ibadah',$data);
	}

	function editIbadah($id,$data)
	{
		$this->db->where('m_ib_id',$id);
		$this->db->update('tb_m_ibadah',$data);
	}

	function deleteIbadah($id){
		$this->db->where('m_ib_id',$id);
		$this->db->delete('tb_m_ibadah');
	}
	
	
}

