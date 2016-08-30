<?php
class Datakeb_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getDatakeb($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('keb_id',$id);
			$this->db->join('tb_m_ibadah','tb_m_ibadah.m_ib_id = tb_kebaktian.keb_m_ib_id');
			return $this->db->get('tb_kebaktian')->row();
		elseif($query=='all'):
			$this->db->join('tb_m_ibadah','tb_m_ibadah.m_ib_id = tb_kebaktian.keb_m_ib_id');
			$this->db->limit($limit,$offset);
			$this->db->order_by('keb_tgl','desc');
			return $this->db->get('tb_kebaktian')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_kebaktian')->result_array();
		endif;
	}


	function addDatakeb($data)
	{
		$this->db->insert('tb_kebaktian',$data);
	}

	function editDatakeb($id,$data)
	{
		$this->db->where('keb_id',$id);
		$this->db->update('tb_kebaktian',$data);
	}

	function deleteDatakeb($id){
		$this->db->where('keb_id',$id);
		$this->db->delete('tb_kebaktian');
	}
	
	
}

