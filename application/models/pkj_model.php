<?php
class Pkj_model extends Model
{
	function Pkj_model()
	{
		parent::Model();
	}
	
	function getPkj($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE)
	{
		if (!$query):
			$this->db->where('pkj_id',$id);
			return $this->db->get('tb_perkunjungan')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('pkj_id','desc');
			return $this->db->get('tb_perkunjungan')->result_array();
		endif;
	}
	
	function addPkj($data)
	{
		$this->db->insert('tb_perkunjungan',$data);
	}
	
	function editPkj($id,$data)
	{
		$this->db->where('pkj_id',$id);
		$this->db->update('tb_perkunjungan',$data);
	}
	
	function deletePkj($id){
		$this->db->where('pkj_id',$id);
		$this->db->delete('tb_perkunjungan');
	}
}
