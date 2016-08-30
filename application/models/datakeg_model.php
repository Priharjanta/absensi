<?php
class Datakeg_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getDatakeg($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('keg_id',$id);
			return $this->db->get('tb_kegiatan')->row();
		elseif($query=='all'):
			$this->db->join('tb_m_kegiatan','tb_m_kegiatan.m_keg_id = tb_kegiatan.keg_m_keg_id');
			$this->db->limit($limit,$offset);
			$this->db->order_by('keg_id','desc');
			return $this->db->get('tb_kegiatan')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_kegiatan')->result_array();
		endif;
	}


	function addDatakeg($data)
	{
		$this->db->insert('tb_kegiatan',$data);
	}

	function editDatakeg($id,$data)
	{
		$this->db->where('keg_id',$id);
		$this->db->update('tb_kegiatan',$data);
	}

	function deleteDatakeg($id){
		$this->db->where('keg_id',$id);
		$this->db->delete('tb_kegiatan');
	}
	
	
}

