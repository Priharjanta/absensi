<?php
class Abskeg_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getAbskeg($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE,$keg_id=FALSE)
	{
		if (!$query):
			$this->db->where('hdr_keg_id',$id);
			return $this->db->get('tb_hdr_kegiatan')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('hdr_keg_id','desc');
			return $this->db->get('tb_hdr_kegiatan')->result_array();
		elseif($query=='byKegId'):
			$this->db->select('tb_m_jemaat.m_jmt_nama');
			$this->db->select('tb_m_jemaat.m_jmt_id');
			$this->db->select('tb_m_jemaat.m_jmt_jenkel');
			$this->db->select('tb_m_jemaat.m_jmt_telp_1');
			$this->db->select('tb_hdr_kegiatan.*');
			$this->db->join('tb_m_jemaat', 'tb_m_jemaat.m_jmt_id = tb_hdr_kegiatan.hdr_keg_m_jmt_id');
			$this->db->where('hdr_keg_keg_id',$keg_id);
			$this->db->limit($limit,$offset);
			$this->db->order_by('hdr_keg_datetime','desc');
			return $this->db->get('tb_hdr_kegiatan')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_hdr_kegiatan')->result_array();
		endif;
	}


	function addAbskeg($data)
	{
		$this->db->insert('tb_hdr_kegiatan',$data);
	}

	function editAbskeg($id,$data)
	{
		$this->db->where('hdr_keg_id',$id);
		$this->db->update('tb_hdr_kegiatan',$data);
	}

	function deleteAbskeg($id){
		$this->db->where('hdr_keg_id',$id);
		$this->db->delete('tb_hdr_kegiatan');
	}
	
}

