<?php
class Abskeb_model extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getAbskeb($query=FALSE,$id=FALSE,$limit=FALSE,$offset=FALSE,$keb_id=FALSE)
	{
		if (!$query):
			$this->db->where('hdr_keb_id',$id);
			return $this->db->get('tb_hdr_kebaktian')->row();
		elseif($query=='all'):
			$this->db->limit($limit,$offset);
			$this->db->order_by('hdr_keb_id','desc');
			return $this->db->get('tb_hdr_kebaktian')->result_array();
		elseif($query=='byKebId'):
			$this->db->select('tb_m_jemaat.m_jmt_nama');
			$this->db->select('tb_m_jemaat.m_jmt_id');
			$this->db->select('tb_m_jemaat.m_jmt_jenkel');
			$this->db->select('tb_m_jemaat.m_jmt_telp_1');
			$this->db->select('tb_m_jemaat.m_jmt_hp_1');
			$this->db->select('tb_hdr_kebaktian.*');
			$this->db->join('tb_m_jemaat', 'tb_m_jemaat.m_jmt_id = tb_hdr_kebaktian.hdr_m_jmt_id');
			$this->db->where('hdr_keb_keb_id',$keb_id);
			$this->db->limit($limit,$offset);
			$this->db->order_by('hdr_keb_datetime','desc');
			return $this->db->get('tb_hdr_kebaktian')->result_array();
		elseif($query=='byKebIdPria'):
			$this->db->select('tb_m_jemaat.m_jmt_nama');
			$this->db->select('tb_m_jemaat.m_jmt_id');
			$this->db->select('tb_m_jemaat.m_jmt_jenkel');
			$this->db->select('tb_m_jemaat.m_jmt_telp_1');
			$this->db->select('tb_m_jemaat.m_jmt_hp_1');
			$this->db->select('tb_hdr_kebaktian.*');
			$this->db->join('tb_m_jemaat', 'tb_m_jemaat.m_jmt_id = tb_hdr_kebaktian.hdr_m_jmt_id');
			$this->db->where('hdr_keb_keb_id',$keb_id);
			$this->db->where('tb_m_jemaat.m_jmt_jenkel','Pria');
			$this->db->limit($limit,$offset);
			$this->db->order_by('hdr_keb_datetime','desc');
			return $this->db->get('tb_hdr_kebaktian')->result_array();
		elseif($query=='byKebIdWanita'):
			$this->db->select('tb_m_jemaat.m_jmt_nama');
			$this->db->select('tb_m_jemaat.m_jmt_id');
			$this->db->select('tb_m_jemaat.m_jmt_jenkel');
			$this->db->select('tb_m_jemaat.m_jmt_telp_1');
			$this->db->select('tb_m_jemaat.m_jmt_hp_1');
			$this->db->select('tb_hdr_kebaktian.*');
			$this->db->join('tb_m_jemaat', 'tb_m_jemaat.m_jmt_id = tb_hdr_kebaktian.hdr_m_jmt_id');
			$this->db->where('hdr_keb_keb_id',$keb_id);
			$this->db->where('tb_m_jemaat.m_jmt_jenkel','Wanita');
			$this->db->limit($limit,$offset);
			$this->db->order_by('hdr_keb_datetime','desc');
			return $this->db->get('tb_hdr_kebaktian')->result_array();
		elseif($query=='load'):
			return $this->db->get('tb_hdr_kebaktian')->result_array();
		endif;
	}


	function addAbskeb($data)
	{
		$this->db->insert('tb_hdr_kebaktian',$data);
	}

	function editAbskeb($id,$data)
	{
		$this->db->where('hdr_keb_id',$id);
		$this->db->update('tb_hdr_kebaktian',$data);
	}

	function deleteAbskeb($id){
		$this->db->where('hdr_keb_id',$id);
		$this->db->delete('tb_hdr_kebaktian');
	}


	// QUERY REPORT
	/*

	SELECT
	COUNT(hdr_m_jmt_id) AS COUNT_JMT,
	tb_hdr_kebaktian.hdr_keb_datetime,
	tb_hdr_kebaktian.hdr_keb_id,
	tb_m_jemaat.m_jmt_id,
	tb_m_jemaat.m_jmt_nama,
	tb_m_jemaat.m_jmt_no_induk
	FROM
	tb_m_jemaat
	LEFT OUTER JOIN  tb_hdr_kebaktian ON tb_m_jemaat.m_jmt_id = tb_hdr_kebaktian.hdr_m_jmt_id
	GROUP BY
	tb_m_jemaat.m_jmt_id order by COUNT_JMT DESC

	*/

	function GetRepKebJmt($filter=FALSE,$limit=FALSE,$offset=FALSE,$month=FALSE,$year=FALSE,$key_name=FALSE,$date_begin=FALSE,$date_end=FALSE)
	{
		if(!$filter)
		{

			$select =   array(
				'tb_m_jemaat.m_jmt_id',
				'tb_m_jemaat.m_jmt_nama',
				'tb_m_jemaat.m_jmt_no_induk',
                'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_hdr_kebaktian.hdr_keb_id',
                'count(hdr_m_jmt_id) AS count_jmt'
            );  
            $this->db->select($select);
            $this->db->from('tb_m_jemaat');
			$this->db->join('tb_hdr_kebaktian', 'tb_hdr_kebaktian.hdr_m_jmt_id = tb_m_jemaat.m_jmt_id','left outer');
			$this->db->group_by('tb_m_jemaat.m_jmt_id');
			$this->db->limit($limit,$offset);
			$this->db->order_by('count_jmt','desc');
			return $this->db->get()->result_array();
		}
		elseif($filter=='bln')
		{

			//SELECT * FROM Project WHERE MONTH(DueDate) = 1 AND YEAR(DueDate) = 2010


			$date_filter = $year.'-'.$month.'-01';
			$select =   array(
				'tb_m_jemaat.m_jmt_id',
				'tb_m_jemaat.m_jmt_nama',
				'tb_m_jemaat.m_jmt_no_induk',
                'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_hdr_kebaktian.hdr_keb_id',
                'count(hdr_m_jmt_id) AS count_jmt'
            );  
            $this->db->select($select);
            $this->db->from('tb_m_jemaat');
			$this->db->join('tb_hdr_kebaktian', 'tb_hdr_kebaktian.hdr_m_jmt_id = tb_m_jemaat.m_jmt_id','left outer');
			$this->db->group_by('tb_m_jemaat.m_jmt_id');
			$this->db->where("tb_hdr_kebaktian.hdr_keb_datetime IS NULL OR MONTH(tb_hdr_kebaktian.hdr_keb_datetime) = $month");
			$this->db->where("YEAR(tb_hdr_kebaktian.hdr_keb_datetime)  = $year");
			$this->db->where("tb_m_jemaat.m_jmt_aktif  = 'Ya'");
			$this->db->limit($limit,$offset);
			$this->db->order_by('count_jmt','desc');
			return $this->db->get()->result_array();
		}
		elseif($filter=='bln_nama')
		{

			//SELECT * FROM Project WHERE MONTH(DueDate) = 1 AND YEAR(DueDate) = 2010

			$date_filter = $year.'-'.$month.'-01';
			$select =   array(
				'tb_m_jemaat.m_jmt_id',
				'tb_m_jemaat.m_jmt_nama',
				'tb_m_jemaat.m_jmt_no_induk',
                'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_hdr_kebaktian.hdr_keb_id',
                'count(hdr_m_jmt_id) AS count_jmt'
            );  
            $this->db->select($select);
            $this->db->from('tb_m_jemaat');
			$this->db->join('tb_hdr_kebaktian', 'tb_hdr_kebaktian.hdr_m_jmt_id = tb_m_jemaat.m_jmt_id','left outer');
			$this->db->group_by('tb_m_jemaat.m_jmt_id');
			$this->db->where("MONTH(tb_hdr_kebaktian.hdr_keb_datetime) = $month");
			$this->db->where("YEAR(tb_hdr_kebaktian.hdr_keb_datetime)  = $year");
			$this->db->where("tb_m_jemaat.m_jmt_aktif  = 'Ya'");
			$this->db->like('tb_m_jemaat.m_jmt_nama', $key_name);
			$this->db->limit($limit,$offset);
			$this->db->order_by('count_jmt','desc');
			return $this->db->get()->result_array();
		}

		elseif($filter=='thn')
		{

			//SELECT * FROM Project WHERE MONTH(DueDate) = 1 AND YEAR(DueDate) = 2010


			$date_filter = $year.'-01-01';
			$select =   array(
				'tb_m_jemaat.m_jmt_id',
				'tb_m_jemaat.m_jmt_nama',
				'tb_m_jemaat.m_jmt_no_induk',
                'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_hdr_kebaktian.hdr_keb_id',
                'count(hdr_m_jmt_id) AS count_jmt'
            );  
            $this->db->select($select);
            $this->db->from('tb_m_jemaat');
			$this->db->join('tb_hdr_kebaktian', 'tb_hdr_kebaktian.hdr_m_jmt_id = tb_m_jemaat.m_jmt_id','left outer');
			$this->db->group_by('tb_m_jemaat.m_jmt_id');
			$this->db->where("(tb_hdr_kebaktian.hdr_keb_datetime IS NULL OR YEAR(tb_hdr_kebaktian.hdr_keb_datetime) = $year)");
			$this->db->where("tb_m_jemaat.m_jmt_aktif  = 'Ya'");
			$this->db->limit($limit,$offset);
			$this->db->order_by('count_jmt','desc');
			return $this->db->get()->result_array();
		}
		elseif($filter=='thn_nama')
		{

			//SELECT * FROM Project WHERE MONTH(DueDate) = 1 AND YEAR(DueDate) = 2010

			$date_filter = $year.'-01-01';
			$select =   array(
				'tb_m_jemaat.m_jmt_id',
				'tb_m_jemaat.m_jmt_nama',
				'tb_m_jemaat.m_jmt_no_induk',
                'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_hdr_kebaktian.hdr_keb_id',
                'count(hdr_m_jmt_id) AS count_jmt'
            );  
            $this->db->select($select);
            $this->db->from('tb_m_jemaat');
			$this->db->join('tb_hdr_kebaktian', 'tb_hdr_kebaktian.hdr_m_jmt_id = tb_m_jemaat.m_jmt_id','left outer');
			$this->db->group_by('tb_m_jemaat.m_jmt_id');
			$this->db->where("YEAR(tb_hdr_kebaktian.hdr_keb_datetime) = $year");
			$this->db->where("tb_m_jemaat.m_jmt_aktif  = 'Ya'");
			$this->db->like('tb_m_jemaat.m_jmt_nama', $key_name);
			$this->db->limit($limit,$offset);
			$this->db->order_by('count_jmt','desc');
			return $this->db->get()->result_array();
		}

		elseif($filter=='custom')
		{

			//SELECT * FROM Project WHERE MONTH(DueDate) = 1 AND YEAR(DueDate) = 2010


			$date_filter = $year.'-'.$month.'-01';
			$select =   array(
				'tb_m_jemaat.m_jmt_id',
				'tb_m_jemaat.m_jmt_nama',
				'tb_m_jemaat.m_jmt_no_induk',
                'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_hdr_kebaktian.hdr_keb_id',
                'count(hdr_m_jmt_id) AS count_jmt'
            );  
            $this->db->select($select);
            $this->db->from('tb_m_jemaat');
			$this->db->join('tb_hdr_kebaktian', 'tb_hdr_kebaktian.hdr_m_jmt_id = tb_m_jemaat.m_jmt_id','left outer');
			$this->db->group_by('tb_m_jemaat.m_jmt_id');
			$this->db->where("(tb_hdr_kebaktian.hdr_keb_datetime BETWEEN '$date_begin' AND '$date_end') OR (tb_hdr_kebaktian.hdr_keb_datetime IS NULL) ");
			$this->db->where("tb_m_jemaat.m_jmt_aktif  = 'Ya'");
			$this->db->limit($limit,$offset);
			$this->db->order_by('count_jmt','desc');
			return $this->db->get()->result_array();
		}
		elseif($filter=='custom_nama')
		{

			//SELECT * FROM Project WHERE MONTH(DueDate) = 1 AND YEAR(DueDate) = 2010

			$date_filter = $year.'-'.$month.'-01';
			$select =   array(
				'tb_m_jemaat.m_jmt_id',
				'tb_m_jemaat.m_jmt_nama',
				'tb_m_jemaat.m_jmt_no_induk',
                'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_hdr_kebaktian.hdr_keb_id',
                'count(hdr_m_jmt_id) AS count_jmt'
            );  
            $this->db->select($select);
            $this->db->from('tb_m_jemaat');
			$this->db->join('tb_hdr_kebaktian', 'tb_hdr_kebaktian.hdr_m_jmt_id = tb_m_jemaat.m_jmt_id','left outer');
			$this->db->group_by('tb_m_jemaat.m_jmt_id');
			$this->db->where("(tb_hdr_kebaktian.hdr_keb_datetime BETWEEN '$date_begin' AND '$date_end')");
			$this->db->where("tb_m_jemaat.m_jmt_aktif  = 'Ya'");
			$this->db->like('tb_m_jemaat.m_jmt_nama', $key_name);
			$this->db->limit($limit,$offset);
			$this->db->order_by('count_jmt','desc');
			return $this->db->get()->result_array();
		}


	}


	/*

	SELECT
	tb_hdr_kebaktian.hdr_keb_keb_id,
	tb_kebaktian.keb_tgl,
	tb_kebaktian.keb_tema,
	tb_m_ibadah.m_ib_name,
	tb_kebaktian.keb_m_ib_id,
	tb_kebaktian.keb_id,
	tb_m_jemaat.m_jmt_nama,
	tb_m_jemaat.m_jmt_id
	FROM
	tb_hdr_kebaktian
	INNER JOIN tb_kebaktian ON tb_hdr_kebaktian.hdr_keb_keb_id = tb_kebaktian.keb_id
	INNER JOIN tb_m_ibadah ON tb_kebaktian.keb_m_ib_id = tb_m_ibadah.m_ib_id
	INNER JOIN tb_m_jemaat ON tb_m_jemaat.m_jmt_id = tb_hdr_kebaktian.hdr_m_jmt_id
	WHERE tb_m_jemaat.m_jmt_id = $jmt_id
	*/
	function GetRepKebByJmtId($jmt_id=FALSE,$limit=FALSE,$offset=FALSE,$date_begin=FALSE,$date_end=FALSE)
	{
			$select =   array(
				'tb_hdr_kebaktian.hdr_keb_keb_id',
				'tb_hdr_kebaktian.hdr_keb_datetime',
				'tb_kebaktian.keb_tgl',
				'tb_kebaktian.keb_tema',
				'tb_m_ibadah.m_ib_name',
				'tb_kebaktian.keb_m_ib_id',
				'tb_kebaktian.keb_id'
            );  
            $this->db->select($select);
            $this->db->from('tb_hdr_kebaktian');
            $this->db->join('tb_kebaktian', 'tb_hdr_kebaktian.hdr_keb_keb_id = tb_kebaktian.keb_id','left outer');
            $this->db->join('tb_m_ibadah', 'tb_kebaktian.keb_m_ib_id = tb_m_ibadah.m_ib_id','left outer');
            $this->db->where("(tb_hdr_kebaktian.hdr_keb_datetime BETWEEN '$date_begin' AND '$date_end')");
            $this->db->where("tb_hdr_kebaktian.hdr_m_jmt_id = $jmt_id");
            $this->db->limit($limit,$offset);
			$this->db->order_by('tb_hdr_kebaktian.hdr_keb_datetime','desc');
			return $this->db->get()->result_array();
	}


	
}

