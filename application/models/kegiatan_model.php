<?php
class Kegiatan_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getKegiatan($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('m_keg_id',$id);
			return $this->db->get('tb_m_kegiatan')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('m_keg_id','desc');
			return $this->db->get('tb_m_kegiatan')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_m_kegiatan')->result_array();
		endif;
	}

	function addKegiatan($data)
	{
		$this->db->insert('tb_m_kegiatan',$data);
	}

	function editKegiatan($id,$data)
	{
		$this->db->where('m_keg_id',$id);
		$this->db->update('tb_m_kegiatan',$data);
	}

	function deleteKegiatan($id){
		$this->db->where('m_keg_id',$id);
		$this->db->delete('tb_m_kegiatan');
	}
	
	
}

