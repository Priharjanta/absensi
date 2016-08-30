<?php


function jin_get_address() { 
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
}
 
function strleft($s1, $s2) { 
	return substr($s1, 0, strpos($s1, $s2)); 
}

/**
* function templogin
* helper yang berfungsi menyimpan log member yg telah login
*/

function memLogin()
{
	$ci=& get_instance();
	$sesId = $ci->session->userdata('session_id');
	
	$ci->db->where('session_id',$sesId);
	$ci->db->join('tb_member','tb_member.member_id = tb_temp_login.temp_mem_id');
	$query = $ci->db->get('tb_temp_login');
	$custLog = $query->result_array();
	$num_cart = $query->num_rows();
		//jika cust ada sesuai session
		if($num_cart>0):
			$log=$num_cart;
		else:
			$log=0;
		endif;
	return $log;
}

function searchJmt($keyword)
{	
	$keyword = '%'.$keyword.'%';
	$ci=& get_instance();
	$qr_jmt = $ci->db->query("
			SELECT 
				m_jmt_nama,
				m_jmt_tgl_lhr,
				m_jmt_id,
				m_jmt_alamat_1
			FROM 
				tb_m_jemaat
			WHERE 
				m_jmt_nama
			LIKE '$keyword' ORDER BY m_jmt_nama ASC LIMIT 0, 30"
		);

	return $qr_jmt->result_array();

}

function searchPerBulan($keyword)
{	
	$keyword = '%'.$keyword.'%';
	$ci=& get_instance();
	$qr_jmt = $ci->db->query("
			SELECT 
				m_jmt_nama,
				m_jmt_id,
				m_jmt_no_induk
			FROM 
				tb_m_jemaat
			WHERE 
				m_jmt_nama
			LIKE '$keyword' ORDER BY m_jmt_nama ASC LIMIT 0, 10"
		);

	return $qr_jmt->result_array();

}

function CompareDateTime($type=FALSE,$dt_tm_now=FALSE,$dt_tm_compare=FALSE)
{
	
	if($type == 'now')
	{
		$date_time_now 		= strtotime($dt_tm_now);
		$date_time_compare	= strtotime($dt_tm_compare);

		if($date_time_now > $date_time_compare)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

}

function cekHadir($tab,$jmt_id,$tab_id)
{
	$ci=& get_instance();
	if($tab == 'keb'){
		$ci->db->select('hdr_m_jmt_id');
		$ci->db->where('hdr_m_jmt_id',$jmt_id);
		$ci->db->where('hdr_keb_keb_id',$tab_id);
		$res = $ci->db->get('tb_hdr_kebaktian')->result_array();
	}	
	elseif ($tab == 'keg') {
		$ci->db->select('hdr_m_keg_jmt_id');
		$ci->db->where('hdr_m_jmt_keg_id',$id);
		$ci->db->where('hdr_keg_keg_id',$tab_id);
		$res = $ci->db->get('tb_hdr_kebaktian')->result_array();
	}
	if(count($res)>0){
		return FALSE;
	}
	else{
		return TRUE;
	}
}

function getKebByDate($date)
{
	$ci=& get_instance();
	$query = $ci->db->query(
		"SELECT 
			COUNT(tb_hdr_kebaktian.hdr_m_jmt_id) AS count_jemaat,
			tb_m_ibadah.*,
			tb_kebaktian.* 
		FROM 
			tb_kebaktian
		JOIN 
			tb_m_ibadah ON tb_m_ibadah.m_ib_id = tb_kebaktian.keb_m_ib_id 
		LEFT OUTER JOIN 
			tb_hdr_kebaktian ON tb_hdr_kebaktian.hdr_keb_keb_id = tb_kebaktian.keb_id
		WHERE keb_tgl = '$date'
		GROUP BY tb_kebaktian.keb_id");

	return $query->result_array();

}

function getKegByDate($date)
{
	$ci=& get_instance();
	$query = $ci->db->query(
		"SELECT 
			COUNT(tb_hdr_kegiatan.hdr_keg_m_jmt_id) AS count_jemaat,
			tb_m_kegiatan.*,
			tb_kegiatan.* 
		FROM 
			tb_kegiatan
		JOIN 
			tb_m_kegiatan ON tb_m_kegiatan.m_keg_id = tb_kegiatan.keg_m_keg_id 
		LEFT OUTER JOIN 
			tb_hdr_kegiatan ON tb_hdr_kegiatan.hdr_keg_keg_id = tb_kegiatan.keg_id
		WHERE keg_date = '$date'
		GROUP BY tb_kegiatan.keg_id");

	return $query->result_array();
}

function getDataTableById($table_name,$field_name,$field_id,$id)
{
	$ci=& get_instance();
	$ci->db->select($field_name);
	$ci->db->where($field_id,$id);
	$row = $ci->db->get($table_name)->row();

	return $row->$field_name;

}

function cekKehadiran($count=FALSE,$tab,$type,$id,$datetime)
{
	$ci=& get_instance();
	if($tab == 'keb'):
		if($type == 'late'):
			$query = $ci->db->query(
					"SELECT *
						FROM tb_hdr_kebaktian
					WHERE 
						tb_hdr_kebaktian.hdr_keb_datetime > '$datetime' 
					AND 
						tb_hdr_kebaktian.hdr_keb_keb_id = $id
						")->result_array();
		elseif ($type == 'ontime') :
			$query = $ci->db->query(
					"SELECT *
						FROM tb_hdr_kebaktian
					WHERE 
						tb_hdr_kebaktian.hdr_keb_datetime <= '$datetime' 
					AND 
						tb_hdr_kebaktian.hdr_keb_keb_id = $id
						")->result_array();
		elseif ($type == 'all') :
			$query = $ci->db->query(
					"SELECT *
						FROM tb_hdr_kebaktian
					WHERE 
						tb_hdr_kebaktian.hdr_keb_keb_id = $id
						")->result_array();
		endif;
		if(!$count):
			return $query;
		else:
			$count = count($query);
			return $count;
		endif;
	elseif($tab == 'keg'):
		if($type == 'late'):
			$query = $ci->db->query(
					"SELECT *
						FROM tb_hdr_kegiatan
					WHERE 
						tb_hdr_kegiatan.hdr_keg_datetime > '$datetime'
					AND 
						tb_hdr_kegiatan.hdr_keg_keg_id = $id
						")->result_array();
		elseif ($type == 'ontime') :
			$query = $ci->db->query(
					"SELECT *
						FROM tb_hdr_kegiatan
					WHERE 
						tb_hdr_kegiatan.hdr_keg_datetime <= '$datetime'
					AND 
						tb_hdr_kegiatan.hdr_keg_keg_id = $id
						")->result_array();
		elseif ($type == 'all') :
			$query = $ci->db->query(
					"SELECT *
						FROM tb_hdr_kegiatan
					WHERE 
						tb_hdr_kegiatan.hdr_keg_keg_id = $id
						")->result_array();
		endif;
		if(!$count):
			return $query;
		else:
			$count = count($query);
			return $count;
		endif;
	endif;
}
/**
* function dropdown
* helper untuk handle semua form dropdown
*/

function wilayahDropdown($selected=FALSE,$field_name=FALSE,$onChange=FALSE)
{
	$ci=& get_instance();
    $ci->load->Model('Wilayah_model');
    $res = $ci->Wilayah_model->getWilayah('all',FALSE,FALSE,FALSE);
    	$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)'>";
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($res as $row):
		    	if($selected):
		    		if($row["m_wil_id"]==$selected):
						$output .= "<option value='".$row["m_wil_id"]."' selected='selected'>".$row['m_wil_name']."</option>";
					else:
						$output .= "<option value='".$row["m_wil_id"]."'>".$row['m_wil_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$row["m_wil_id"]."'>".$row['m_wil_name']."</option>";
		    	endif;
		    endforeach;
	    $output .= "</select>";
    return $output;
}


function ibadahDropdown($selected=FALSE,$field_name=FALSE,$onChange=FALSE)
{
	$ci=& get_instance();
    $ci->load->Model('Ibadah_model');
    $res = $ci->Ibadah_model->getIbadah('all',FALSE,FALSE,FALSE);
    	$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)'>";
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($res as $row):
		    	if($selected):
		    		if($row["m_ib_id"]==$selected):
						$output .= "<option value='".$row["m_ib_id"]."' selected='selected'>".$row['m_ib_name']."</option>";
					else:
						$output .= "<option value='".$row["m_ib_id"]."'>".$row['m_ib_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$row["m_ib_id"]."'>".$row['m_ib_name']."</option>";
		    	endif;
		    endforeach;
	    $output .= "</select>";
    return $output;
}


function kegiatanDropdown($selected=FALSE,$field_name=FALSE,$onChange=FALSE)
{
	$ci=& get_instance();
    $ci->load->Model('Kegiatan_model');
    $res = $ci->Kegiatan_model->getKegiatan('all',FALSE,FALSE,FALSE);
    	$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)'>";
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($res as $row):
		    	if($selected):
		    		if($row["m_keg_id"]==$selected):
						$output .= "<option value='".$row["m_keg_id"]."' selected='selected'>".$row['m_keg_name']."</option>";
					else:
						$output .= "<option value='".$row["m_keg_id"]."'>".$row['m_keg_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$row["m_keg_id"]."'>".$row['m_keg_name']."</option>";
		    	endif;
		    endforeach;
	    $output .= "</select>";
    return $output;
}

function yesnoDropDown($notyet=FALSE,$field_name,$selected)
{
	$class = 'class="form-control"';
	if($notyet):
		$options = array(
				  '' => '- Pilih -',
                  'Ya'=> 'Ya',
                  'Belum' => 'Belum',
                  'Unknown' => 'Unknown'
                );	
	else:
		$options = array(
				  '' => '- Pilih -',
                  'Ya'=> 'Ya',
                  'Tidak' => 'Tidak',
                  'Unknown' => 'Unknown'
                );	
	endif;
	return form_dropdown($field_name,$options,$selected,$class);
}

function kawinDropDown($selected)
{
	$class = 'class="form-control"';
	$options = array(
				  '' => '- Pilih -',
                  'Kawin'=> 'Kawin',
                  'Belum Kawin' => 'Belum Kawin',
                  'Unknown' => 'Unknown'
                );
	return form_dropdown('m_jmt_status_kawin',$options,$selected,$class);
}  

function jenkelDropdown($selected,$attr=FALSE)
{
	$class = "id='$attr' class='form-control' style='width:100px;'";
	$options = array(
				  '' => '- Pilih -',
                  'Pria'=> 'Pria',
                  'Wanita' => 'Wanita'
                );
	return form_dropdown('m_jmt_jenkel',$options,$selected,$class);
} 

function pkjStatusDropdown($selected,$attr=FALSE)
{
	$class = "id='$attr' class='form-control' style='width:100px;'";
	$options = array(
				  '' => '- Pilih -',
                  'Plan'=> 'Plan',
                  'Proses' => 'Proses',
                  'Selesai' => 'Selesai'
                );
	return form_dropdown($attr,$options,$selected,$class);
} 

function FilterTipeDropDown($tipe=FALSE,$name=FALSE,$selected=FALSE)
{
	$class = 'class="form-control" style="width:150px;"';

	if($tipe == 'perbulan')
	{
		$options = array(
                  'bln'			=> 'Bulan Saja',
                  'bln_nama' 	=> 'Bulan dan Nama'
                  );

	}
	elseif($tipe == 'pertahun')
	{
		$options = array(
                  'thn'			=> 'Tahun Saja',
                  'thn_nama' 	=> 'Tahun dan Nama'
                  );
	}
	elseif($tipe == 'custom')
	{

	}
	

	return form_dropdown($name,$options,$selected,$class);
} 


// tanggalan

function getTh($ket,$var)
{
	if($ket == 'plus'):
		$dt = explode('-',date('Y-m-d'));
		$th = $dt[0] + $var;
	elseif($ket == 'min'):
		$dt = explode('-',date('Y-m-d'));
		$th = $dt[0] - $var;
	endif;
	return $th;
}

function dateDropdown($name,$date=FALSE,$th_st=FALSE,$th_end=FALSE)
{
	$ci=& get_instance();
	if($date){
	$dt = explode('-',$date);
	$year = $dt[0];
	$mon = $dt[1];
	$day = $dt[2];
	}
	
	$ret = '<select class="form-control" name="'.$name.'_d"  style="width:70px;">';
	$ret .= '<option value="">Hr</option>';
	for ($i=1;$i<32;$i++):
		$val=$i;
		if($val < 10):
			$val = '0'.$val;
		endif;
		if ($date):
			if($val == $day):
				$ret .= '<option value="'.$val.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$val.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$val.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select> ';

	$month = array	('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
	$ret .= '<select class="form-control" name="'.$name.'_m"  style="width:72px;">';
	$ret .= '<option value="">Bln</option>';
	for ($i=0;$i<12;$i++):
		$val=$i+1;
		if($val < 10):
			$val = '0'.$val;
		endif;
		if ($date):
			if($val == $mon):
				$ret .= '<option value="'.$val.'" selected="selected">'.$month[$i].'</option>';
			else:
				$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
			endif;
		else:
			$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
		endif;
	endfor;
	$ret .='</select> ';
	

	$minyear = $th_st;
	$plusyear = $th_end;

	$ret .= '<select class="form-control" name="'.$name.'_y" style="width:80px;">';
	$ret .= '<option value="">Thn</option>';
	for ($i=$minyear;$i<=$plusyear;$i++):
		if ($date):
			if($i==$year):
				$ret .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$i.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$i.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select>';
return $ret;

}

function bulanDropdown($name,$date=FALSE,$th_st=FALSE,$th_end=FALSE)
{

	$ci=& get_instance();
	if($date){
	$dt = explode('-',$date);
	$year = $dt[0];
	$mon = $dt[1];
	$day = $dt[2];
	}
	
	
	$month = array	('Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des');
	$ret = '<select class="form-control" name="'.$name.'_m"  style="width:80px;">';
	for ($i=0;$i<12;$i++):
		$val=$i+1;
		if($val < 10):
			$val = '0'.$val;
		endif;
		if ($date):
			if($val == $mon):
				$ret .= '<option value="'.$val.'" selected="selected">'.$month[$i].'</option>';
			else:
				$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
			endif;
		else:
			$ret .= '<option value="'.$val.'">'.$month[$i].'</option>';
		endif;
	endfor;
	$ret .='</select> ';
	

	$minyear = $th_st;
	$plusyear = $th_end;

	$ret .= '<select class="form-control" name="'.$name.'_y" style="width:80px;">';
	for ($i=$minyear;$i<=$plusyear;$i++):
		if ($date):
			if($i==$year):
				$ret .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$i.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$i.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select>';
return $ret;

}

function tahunDropdown($name,$date=FALSE,$th_st=FALSE,$th_end=FALSE)
{

	$ci=& get_instance();
	if($date){
	$dt = explode('-',$date);
	$year = $dt[0];
	$mon = $dt[1];
	$day = $dt[2];
	}

	$minyear = $th_st;
	$plusyear = $th_end;

	$ret = '<select class="form-control" name="'.$name.'_y" style="width:80px;">';
	for ($i=$minyear;$i<=$plusyear;$i++):
		if ($date):
			if($i==$year):
				$ret .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			else:
				$ret .= '<option value="'.$i.'">'.$i.'</option>';
			endif;
		else:
			$ret .= '<option value="'.$i.'">'.$i.'</option>';
		endif;
	endfor;
	$ret .='</select>';
return $ret;

}

// function time_drop_down()
// param
//  - type : char
//  - selected : char
//  - h : int
//  - m : int
//  - s : int

function timeDropDown($type = FALSE,$name=FALSE, $selected = FALSE)
{

	$class_id = 'class="form-control" style="width:70px;"';

	$ci=& get_instance();
	$arr = array();
	if ($type == 'h')
	{
		$arr['']='hh';
		for($i = 0; $i <= 23; $i++)
		{
			if (strlen($i) == 1)
			{
				$arr['0'.$i] = '0'.$i;
			}
			else
			{
				$arr[$i] = $i;
			}
			
		}
		$h_val= $arr;
		$options = $h_val;
	}
	else if ($type == 'm' || $type == 's')
	{
		if ($name == 'slot_time')
		{
			$min = 60;
		}
		else
		{
			$min = 59;
		}
		
		if($type == 'm')
		{
			$arr['']='mm';
		}
		else
		{
			$arr['']='ss';
		}
		
		for($i = 0; $i <= $min; $i++)
		{
			
			if (strlen($i) == 1)
			{
				$arr['0'.$i] = '0'.$i;
			}
			else
			{
				$arr[$i] = $i;
			}
		}
		
		$m_s_val = $arr;
		$options = $m_s_val;
	}
	return form_dropdown($name,$options,$selected,$class_id);
}

function provDropdown($selected=FALSE,$field_name=FALSE,$onChange=FALSE)
{
	$ci=& get_instance();
	$ci->db->select('prov_id,prov_name');
	$row = $ci->db->get('tb_prov')->result_array();
    	$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)'>";
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($row as $row):
		    	if($selected):
		    		if($row["prov_id"]==$selected):
						$output .= "<option value='".$row["prov_id"]."' selected='selected'>".$row['prov_name']."</option>";
					else:
						$output .= "<option value='".$row["prov_id"]."'>".$row['prov_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$row["prov_id"]."'>".$row['prov_name']."</option>";
		    	endif;
		    endforeach;
	    $output .= "</select>";
    return $output;
}

function kabDropdown($prov_id=FALSE,$selected=FALSE,$field_name=FALSE,$onChange=FALSE)
{
	$ci=& get_instance();
	$ci->db->where('kab_prov_id',$prov_id);
	$kab = $ci->db->get('tb_kabupaten')->result_array();
	
	$output = "<select id='$field_name' class='form-control' name='$field_name' onChange='$onChange(this.value)'>";
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($kab as $kab):
		    	if($selected):
		    		if($kab["kab_id"]==$selected):
						$output .= "<option value='".$kab["kab_id"]."' selected='selected'>".$kab['kab_name']."</option>";
					else:
						$output .= "<option value='".$kab["kab_id"]."'>".$kab['kab_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$kab["kab_id"]."'>".$kab['kab_name']."</option>";
		    	endif;
		    endforeach;
	$output .= "</select>";
	return $output;
}
function kotkecDropDown($prov_id=FALSE,$kab_id=FALSE,$selected=FALSE,$field_name=FALSE)
{
	$ci=& get_instance();
	$ci->db->where('kotkec_prov_id',$prov_id);
	$ci->db->where('kotkec_kab_id',$kab_id);
	$row = $ci->db->get('tb_kotkec')->result_array();
    	$output = "<select id='kotkec_id' class='form-control' name='$field_name'>";
			$output .= "<option value=''> - Pilih - </option>";
		    foreach($row as $row):
		    	if($selected):
		    		if($row["kotkec_id"]==$selected):
						$output .= "<option value='".$row["kotkec_id"]."' selected='selected'>".$row['kotkec_name']."</option>";
					else:
						$output .= "<option value='".$row["kotkec_id"]."'>".$row['kotkec_name']."</option>";
					endif;
		    	else:
		    		$output .= "<option value='".$row["kotkec_id"]."'>".$row['kotkec_name']."</option>";
		    	endif;
		    endforeach;
	    $output .= "</select>";
    return $output;
}


function ruleDropdown($selected)
{
	$class_id = 'class="form-control"';
	$options = array(
				'Frontend' => 'Frontend',
                'Administrator' => 'Administrator'
			);
	return form_dropdown('user_rule',$options,$selected,$class_id);
}


function getBerita()
{
	$ci=& get_instance();
	$ci->db->where('page','berita');
	$ci->db->where('published','Ya');
	$ci->db->limit(3);
	$ci->db->order_by('konten_id','desc');
	$query = $ci->db->get('tb_konten');
	$res = $query->result_array();
	
	$i=1;
	foreach($res as $row):
		echo '<div class="news_list">';
			echo '<div class="news_title_list"><a href="#">'.$row['judul'].'</a></div>';
			echo '<strong>'.formatDate($row['date'],'short').'</strong>';
			echo character_limiter($row['isi_konten'],200);
			echo '<a href="#news'.$i.'" rel="facebox">more</a>';
		echo '</div>';
		
		echo '<div id="news'.$i.'" style="display:none">';
		echo '<strong>'.$row['judul'].'</strong><br />';
		echo '<strong>'.formatDate($row['date'],'short').'</strong><br />';
		echo $row['isi_konten'];
		echo '</div>';
	$i++;
	endforeach;
	echo '<a href='.site_url().'/konten/archive>Archive</a>';
	echo '<br /><br />';
	
	
}

/**
* function getterms
* fungsi sidebar berita
*/
function getTerms($terms=FALSE)
{
	$ci=& get_instance();
	$ci->db->where('page',$terms);
	$query = $ci->db->get('tb_konten');
	$row = $query->row();
	
	echo '<div id="info" style="display:none">';
	echo '<strong>'.$row->judul.'</strong>';
	echo $row->isi_konten;
	echo '</div>';

}

function alias($string)
{
	$ci=& get_instance();
	return strtolower(url_title($string));
}

function getProdukDetail($id)
{
	$ci=& get_instance();
	$ci->db->where('produk_id',$id);
	return $ci->db->get('tb_produk')->row();
}

function getProductCatDetail($productCat_id)
{
	$ci=& get_instance();
	$ci->db->where('product_cat_id',$productCat_id);
	return $ci->db->get('tb_produk_cat')->row();
}

/**
* function loadTinyMCE
* @uses loadTinyMCE($theme) $theme = advance, simple
* @filesource application/helpers/ies_helper.php
*/
function loadTinyMCE($ret='name')
{
	if($ret == 'simple'):
		$output = '
		<script type="text/javascript" src="'.base_url().'assets/js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "specific_textareas",
			editor_selector : "mceEditor",

			theme : "advanced",
			plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,|,undo,redo,|,bullist,numlist,outdent,indent,blockquote,|,link,unlink,|,pastetext,pasteword,|,preview",
			theme_advanced_buttons2 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,media,advhr,|,fullscreen",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : false,

			// Example content CSS (should be your site CSS)
			content_css : "'. base_url().'assets/js/tiny_mce/css/content.css",

		})
		</script>
		';
	elseif($ret=='medium'):
		$output = '
		<script type="text/javascript" src="'.base_url().'assets/js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "specific_textareas",
					editor_selector : "mceEditor",
					relative_urls : false,
					remove_script_host : false,
					document_base_url : "'.base_url().'",

					theme : "advanced",
					plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

					// Theme options
					theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,cut,copy,paste,pastetext,pasteword",
					theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code",
					theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,media,advhr,|,fullscreen",
					theme_advanced_buttons4 : "cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,insertdate,inserttime,preview,|,forecolor,backcolor",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					theme_advanced_resize_horizontal : false,

					// Example content CSS (should be your site CSS)
					content_css : "'. base_url().'assets/js/tiny_mce/css/content.css",

					// Drop lists for link/image/media/template dialogs
					template_external_list_url : "lists/template_list.js",
					external_link_list_url : "lists/link_list.js",
					external_image_list_url : "lists/image_list.js",
					media_external_list_url : "lists/media_list.js",

				});
			</script>
		';
	elseif($ret=='advance'):
		$output = '
		<script type="text/javascript" src="'.base_url().'assets/js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript">
				tinyMCE.init({
					// General options
					mode : "specific_textareas",
					editor_selector : "mceEditor",

					theme : "advanced",
					plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

					// Theme options
					theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
					theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",
					theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,fullscreen",
					theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,|,insertdate,inserttime,preview,|,forecolor,backcolor",
					theme_advanced_toolbar_location : "top",
					theme_advanced_toolbar_align : "left",
					theme_advanced_statusbar_location : "bottom",
					theme_advanced_resizing : true,
					theme_advanced_resize_horizontal : false,

					// Example content CSS (should be your site CSS)
					content_css : "'. base_url().'assets/js/tiny_mce/css/content.css",

					// Drop lists for link/image/media/template dialogs
					template_external_list_url : "lists/template_list.js",
					external_link_list_url : "lists/link_list.js",
					external_image_list_url : "lists/image_list.js",
					media_external_list_url : "lists/media_list.js",

					// Style formats
					style_formats : [
						{title : "Bold text", inline : "b"},
						{title : "Red text", inline : "span", styles : {color : "#ff0000"}},
						{title : "Red header", block : "h1", styles : {color : "#ff0000"}},
						{title : "Example 1", inline : "span", classes : "example1"},
						{title : "Example 2", inline : "span", classes : "example2"},
						{title : "Table styles"},
						{title : "Table row 1", selector : "tr", classes : "tablerow1"}
					],

					// Replace values for the template plugin
					template_replace_values : {
						username : "Some User",
						staffid : "991234"
					}
				});
			</script>
		';
	endif;
	echo $output;
}

/**
* function option
* helper untuk mengambil data dari tabel tb_option
*/

function getOption($name=FALSE)
{
	$ci=& get_instance();
	$ci->load->database();

	$ci->db->select('option_name, option_value');
	$ci->db->where('option_name',$name);
	$ci->db->limit(1);
	$ret = $ci->db->get('tb_option')->row_array();

	$output = $ret['option_value'];
	return $output;
}



/**
* function makeslug
* digunakan untuk mereplace spasi ketika akan ditampilkan di url address
*/

function makeslug($string){
	$slug= strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $string));
	$slug = str_replace(" ", "-", $slug);
	return $slug;
}
/**
* function memformat harga
* digunakan membuat format rupiaah
*/

function formatHarga($n,$lengkap=FALSE) {
	// first strip any formatting;
	$n = (0+str_replace(",","",$n));

	// is this a number?
	if(!is_numeric($n)) return false;

	if($lengkap)$n = number_format($n,0,",",".");
	// now filter it;
	else if($n>1000000000000) $n= number_format(round(($n/1000000000000),0,",","."),1).' trilyun';
	else if($n>1000000000) $n= number_format(round(($n/1000000000),0,",","."),1).' milyar';
	else if($n>1000000) $n= number_format(round(($n/1000000),1),0,",",".").' juta';
	else if($n>1000) $n= number_format(round(($n/1000),1),0,",",".").' ribu';

	return "Rp ".$n ;
}

/*
Fungsi convert tanggal ke tanggalan indonesia
*/
function indDate($date) 
{
	$arr_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$arr_date = explode("-", $date);
	$arr_date[1] = intval($arr_date[1]);
	$arr_date[2] = intval($arr_date[2]);
	return $arr_date[2].' '.$arr_bulan[$arr_date[1] - 1].' '.$arr_date[0];
}

function dateTimeSubct($dtm,$dtm_calc)
{
	$ref = new DateTime($dtm);
	$val = new DateTime($dtm_calc);
	$calc = $val->diff($ref);

	if($val < $ref)
	{
		$arr_dtm = array(
			'year' => $calc->y,
		 	'month' => $calc->m, 
		 	'days' => $calc->d, 
		 	'hours' => $calc->h,
		 	'minutes' => $calc->i,
		 	'seconds' => $calc->s);

		//echo $calc->d.' hari'.' '.$calc->h.' jam ' . $calc->i.' menit';
		return $arr_dtm;
	}
	else
	{
		return FALSE;
	}
		
}




function mysqlDateNow()
{
	$ci=& get_instance();
	$date_now = $ci->db->query("SELECT NOW() as date_now")->row();
	return $date_now->date_now;
}

/**
* function formatDate
* @uses mmemformat tanggal
*/
function formatDate($date, $format='name')
{
	$ci=& get_instance();

	if($format=='long'):
		$unix_date = human_to_unix($date);
		return date('l, jS F, Y - H:i:s',$unix_date);
	elseif($format=='medium1'):
		$unix_date = human_to_unix($date);
		return date('jS M, Y - H:i',$unix_date);
	elseif($format=='medium2'):
		$unix_date = human_to_unix($date);
		return date('jS F, Y',$unix_date);
	elseif($format=='short'):
		$unix_date = human_to_unix($date);
		return date('d-M-Y',$unix_date);
	elseif($format=='ampm'):
		$unix_date = human_to_unix($date);
		return date('d M Y g:ia',$unix_date);
	elseif($format=='short1'):
		$unix_date = human_to_unix($date);
		return date('d M Y - H:i:s',$unix_date);
	elseif($format=='rssdate'):
		$unix_date = human_to_unix($date);
		return date('D, j M Y H:i:s +0700',$unix_date);
	elseif($format=='sitemap_date'):
		$unix_date = human_to_unix($date);
		return date('Y-m-d',$unix_date);
	elseif($format=='admin_date'):
		$unix_date = human_to_unix($date);
		return date('d-M-Y',$unix_date);
	elseif($format=='time_only'):
		$unix_date = human_to_unix($date);
		return date('H:i:s',$unix_date);
	elseif($format=='date_only'):
		$unix_date = human_to_unix($date);
		return date('Y-m-d',$unix_date);
	elseif($format=='year_only'):
		$unix_date = human_to_unix($date);
		return date('Y',$unix_date);
	elseif($format=='month_only'):
		$unix_date = human_to_unix($date);
		return date('m',$unix_date);
	elseif($format=='year_month_only'):
		$unix_date = human_to_unix($date);
		return date('Y-m',$unix_date);
	elseif($format=='year_month_only_long'):
		$unix_date = human_to_unix($date);
		return date('M-Y',$unix_date);
	elseif($format=='timespan'):
		$unix_date = human_to_unix($date);
		return timespan($unix_date,now());
	else:
		return false;
	endif;

}
/**
* function crop image
* @uses croping gambar agar lebih kecil, 
* menggunaklan lib dari ci -> GD2
*/

function cropImage($image,$size,$filename,$ext,$filepath)
{
	$ci =& get_instance();

	$image_size = getimagesize($image);
	$image_width = $image_size['0'];
	$image_height = $image_size['1'];

	$config['image_library'] = 'gd2';
	$config['source_image'] = $image;
	$config['new_image'] = $filename.'_'.$size.'x'.$size.$ext;
	$config['maintain_ratio'] = FALSE;
	if($image_width > $image_height):
		$config['height'] = $image_height;
		$config['width'] = $image_height;
	elseif($image_width < $image_height):
		$config['height'] = $image_width;
		$config['width'] = $image_width;
	else:
		$config['height'] = $image_width;
		$config['width'] = $image_width;
	endif;

	if($image_width > $image_height):
		$config['x_axis'] = (5/100)*$image_width;
		$config['y_axis'] = '0';
	elseif($image_width < $image_height):
		$config['x_axis'] = '0';
		$config['y_axis'] = (5/100)*$image_height;
	else:
		$config['x_axis'] = (5/100)*$image_width;
		$config['y_axis'] = '0';
	endif;
	$ci->image_lib->initialize($config);
	$ci->image_lib->crop();

	$ci->image_lib->clear();

	$config2['image_library'] = 'gd2';
	$config2['source_image'] = $filepath.$config['new_image'];
	$config2['maintain_ratio'] = TRUE;
	$config2['height'] = $size;
	$config2['width'] = $size;

	$ci->image_lib->initialize($config2);
	$ci->image_lib->resize();

	return $filename.'_150x150'.$ext;

}

/**
* function resize
* @uses merubah atau mengganti ukuran gambar
* menggunaklan lib dari ci -> GD2
*/

function resizeImage($image,$width,$height,$filename,$ext,$filepath)
{
	
	$ci =& get_instance();

	$config['image_library'] = 'gd2';
	$config['source_image'] = $image;
	$config['new_image'] = $filename.'_'.$width.'x'.$height.$ext;
	$config['maintain_ratio'] = TRUE;
	$config['height'] = $height;
	$config['width'] = $width;

	$ci->image_lib->initialize($config);
	$ci->image_lib->resize();

	$image_size = getimagesize($filepath.$config['new_image']);
	$image_width = $image_size['0'];
	$image_height = $image_size['1'];
	rename($filepath.$config['new_image'],$filepath.$filename.'_'.$image_width.'x'.$image_height.$ext);
	return $filename.'_'.$image_width.'x'.$image_height.$ext;
	$ci->image_lib->clear();
}

function getPage($control=FALSE,$page=FALSE,$uri=FALSE,$count=FALSE)// fungsi buat halaman tetangga// uri-> buat ndetek row ke berapa yg di pilih
{
        $ci=& get_instance();
        if ($page == 'new') // jka insert
        {
                $div = $count/$ci->config->item('per_page');// tergantung sama pagination nya.. 
                $mod = $count % $ci->config->item('per_page');// cari halaman yg ga ganjil
                
                $x = explode('.',$div);
                $y = $x[0];
                $last_page = $y * $ci->config->item('per_page');
                $minus = $last_page - $ci->config->item('per_page');
                $last_page2 = $minus;
                
                if ($mod == '0'):
                redirect('backend/'.$control.'/index/'.$last_page2);
                elseif ($count >= $ci->config->item('per_page')):
                redirect('backend/'.$control.'/index/'.$last_page);
                else:
                redirect('backend/'.$control.'/');
                endif;
        }
        elseif ($page == 'edit') // jika edit
        {
                $p = $uri - 1;
                if ($p == 0):
                        $page = $uri;
                else:
                        $page = $p;
                endif;
                
                $div = $page/$ci->config->item('per_page');
                $mod = $page % $page/$ci->config->item('per_page');
                $x = explode('.',$div);
                $y = $x[0];
                
                $edit_page = $y * $ci->config->item('per_page');
                $edit_page2 = $edit_page - $ci->config->item('per_page');
                $plus = $edit_page +1;

                if ($page < $ci->config->item('per_page')):
                        redirect('backend/'.$control.'/');
                elseif ($page > $ci->config->item('per_page')):
                        redirect('backend/'.$control.'/index/'.$edit_page);
                elseif (($page == $plus) || $mod == 0 ):
                        redirect('backend/'.$control.'/index/'.$edit_page);
                endif;
        }
        elseif ($page == 'delete')// dan jika hapus
        {
                $p = $uri - 1;
                if ($p == 0):
                        $page = $uri;
                else:
                        $page = $p;
                endif;
                                        
                $div = $page/$ci->config->item('per_page');
                $mod = $page % $page/$ci->config->item('per_page');
                $x = explode('.',$div);
                $y = $x[0];
                                
                $edit_page = $y * $ci->config->item('per_page');
                $edit_page2 = $edit_page - $ci->config->item('per_page');
                $plus = $edit_page +1;

                if ($page < $ci->config->item('per_page') || $count == $ci->config->item('per_page')):
                        redirect('backend/'.$control.'/');
                elseif ($page >= $ci->config->item('per_page') ):
                        redirect('backend/'.$control.'/index/'.$edit_page);
                elseif ((($page + 1) == $plus) || $mod == 0 ):
                        redirect('backend/'.$control.'/index/'.$edit_page2);
                endif;
        }
}




