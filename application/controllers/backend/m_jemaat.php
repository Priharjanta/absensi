<?php

class M_jemaat extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Jemaat_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('backend');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('backend/no_access');
		endif;

	}

	function index()
	{
		$this->load->library('pagination');
		$offset = $this->uri->segment(4);
		$config['base_url'] = site_url().'/backend/m_jemaat/index';
		$config['total_rows'] = count($this->Jemaat_model->getJemaat('all',FALSE,FALSE,FALSE));
		$config['per_page'] = $this->config->item('per_page');
		$config['uri_segment'] = '4';
		
		// pagination config
		$config['per_page'] 		= $this->config->item('per_page');
		$config['full_tag_open'] 	= $this->config->item('full_tag_open');
		$config['full_tag_close'] 	= $this->config->item('full_tag_close');
		$config['num_tag_open'] 	= $this->config->item('num_tag_open');
		$config['num_tag_close'] 	= $this->config->item('num_tag_close');
		$config['cur_tag_open'] 	= $this->config->item('cur_tag_open');
		$config['cur_tag_close'] 	= $this->config->item('cur_tag_close');
		$config['next_tag_open'] 	= $this->config->item('next_tag_open');
		$config['next_tagl_close'] 	= $this->config->item('next_tagl_close');
		$config['prev_tag_open'] 	= $this->config->item('prev_tag_open');
		$config['prev_tagl_close'] 	= $this->config->item('prev_tagl_close');
		$config['first_tag_open'] 	= $this->config->item('first_tag_open');
		$config['first_tagl_close'] = $this->config->item('first_tagl_close');
		$config['last_tag_open'] 	= $this->config->item('last_tag_open');
		$config['last_tagl_close'] 	= $this->config->item('last_tagl_close');
		
		$data['urut'] = $this->uri->segment(4);
		$data['heading'] = 'Master Data';
		$data['title'] = $data['heading'].' - Jemaat';
		$data['template'] = 'm_jemaat/index';
		$data['res'] = $this->Jemaat_model->getJemaat('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}


	function cari()
	{

		$this->form_validation->set_rules('cari_nama', 'Nama Jemaat','required|alpha');

		if ($this->form_validation->run() == FALSE)
		{
			$message = 'Mohon isi nama (alphabet only)';
			$this->session->set_flashdata('message_type_popup', "<script>window.alert(\"" . $message . "\");</script>");
			redirect('backend/m_jemaat');
		}

		else
		{
			$key = $this->input->post('cari_nama');
			$this->load->library('pagination');
			$offset = $this->uri->segment(4);
			$config['per_page'] 		= $this->config->item('per_page');
			$data['urut'] = $this->uri->segment(4);
			$data['heading'] = 'Master Data';
			$data['title'] = $data['heading'].' - Pencarian Keywords : '.$key;
			$data['template'] = 'm_jemaat/index';
			$data['key'] = $key;
			$data['res'] = $this->Jemaat_model->getJemaat('cari',FALSE,FALSE,FALSE,$key);
			$this->pagination->initialize($config);
			$this->load->view('backend/index',$data);
		}


	}

	function add()
	{
		$this->form_validation->set_rules('m_jmt_nama', 'Nama Jemaat','required');
		$this->form_validation->set_rules('m_jmt_jenkel', 'Jenis Kelamin','required');
		//$this->form_validation->set_rules('m_jmt_tgl_lhr', 'Tanggal Lahir','required');
		//$this->form_validation->set_rules('m_jmt_tmpt_lhr', 'Tempat Lahir','required');
		
		//$this->form_validation->set_rules('m_jmt_status_kawin', 'Status Perkawinan','required');
		//$this->form_validation->set_rules('m_jmt_tgl_menikah', 'Tanggal menikah','required');
		//$this->form_validation->set_rules('m_jmt_alamat_1', 'Alamat Utama','required');
		//$this->form_validation->set_rules('m_jmt_prov_id_1', 'Provinsi','required');
		//$this->form_validation->set_rules('m_jmt_kab_id_1', 'Kabupaten','required');
		//$this->form_validation->set_rules('m_jmt_kec_id_1', 'Kecamatan','required');
		$this->form_validation->set_rules('m_jmt_telp_1', 'Telpon','required');

		//$this->form_validation->set_rules('m_jmt_prov_id_2', 'Alamat Opsional','required');
		//$this->form_validation->set_rules('m_jmt_kab_id_2', 'Kabupaten','required');
		//$this->form_validation->set_rules('m_jmt_kec_id_2', 'Kecamatan','required');
		//$this->form_validation->set_rules('m_jmt_telp_2', 'Telepon','required');
		//$this->form_validation->set_rules('m_jmt_baptis', 'Sudah Baptis','required');
		//$this->form_validation->set_rules('m_jmt_grj_baptis', 'Gereja tempat Baptis','required');
		//$this->form_validation->set_rules('m_jmt_tgl_baptis', 'Tanggal Baptis','required');
		//$this->form_validation->set_rules('m_jmt_sidi', 'Pengakuan Percaya','required');
		//$this->form_validation->set_rules('m_jmt_grj_sidi', 'Gereja tempat Pengakuan Percaya','required');
		//$this->form_validation->set_rules('m_jmt_tgl_sidi', 'Tanggal Pengakuan Percaya','required');
		//$this->form_validation->set_rules('m_jmt_grj_asal', 'Gereja Asal','required');
		//$this->form_validation->set_rules('m_jmt_aktif', 'Aktif','required');
		//$this->form_validation->set_rules('m_jmt_ket', 'Keterangan','required');
		//$this->form_validation->set_rules('m_jmt_parent_child_id', 'Hubungan keluarga','required');
		//$this->form_validation->set_rules('m_jmt_parent_child_hub', 'Jenis hubungan keluarga','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] = 'Master Data';
			$data['title'] = $data['heading'].' - Jemaat';
			$data['template'] = 'm_jemaat/add';
			$this->load->view('backend/index',$data);
		}
		else
		{
			$m_jmt_tgl_lhr 		= $this->input->post('m_jmt_tgl_lhr_y').'-'.$this->input->post('m_jmt_tgl_lhr_m').'-'.$this->input->post('m_jmt_tgl_lhr_d');
			$m_jmt_tgl_menikah	= $this->input->post('m_jmt_tgl_menikah_y').'-'.$this->input->post('m_jmt_tgl_menikah_m').'-'.$this->input->post('m_jmt_tgl_menikah_d');
			$m_jmt_tgl_baptis	= $this->input->post('m_jmt_tgl_baptis_y').'-'.$this->input->post('m_jmt_tgl_baptis_m').'-'.$this->input->post('m_jmt_tgl_baptis_d');
			$m_jmt_tgl_sidi		= $this->input->post('m_jmt_tgl_sidi_y').'-'.$this->input->post('m_jmt_tgl_sidi_m').'-'.$this->input->post('m_jmt_tgl_sidi_d');
			$m_jmt_tgl_masuk	= $this->input->post('m_jmt_tgl_masuk_y').'-'.$this->input->post('m_jmt_tgl_masuk_m').'-'.$this->input->post('m_jmt_tgl_masuk_d');
			$id = $this->uri->segment(4);
			$data = array
				(
				'm_jmt_no_induk'		=>$this->input->post('m_jmt_no_induk'),
				'm_jmt_nama'			=>strtoupper($this->input->post('m_jmt_nama')),
				'm_jmt_jenkel'			=>$this->input->post('m_jmt_jenkel'),
				'm_jmt_tgl_lhr'			=>$m_jmt_tgl_lhr,
				'm_jmt_tmpt_lhr'		=>$this->input->post('m_jmt_tmpt_lhr'),
				'm_jmt_status_kawin'	=>$this->input->post('m_jmt_status_kawin'),
				'm_jmt_tgl_menikah'		=>$m_jmt_tgl_menikah,
				'm_jmt_wil_id'			=>$this->input->post('m_jmt_wil_id'),
				'm_jmt_alamat_1'		=>$this->input->post('m_jmt_alamat_1'),
				'm_jmt_prov_id_1'		=>$this->input->post('m_jmt_prov_id_1'),
				'm_jmt_kab_id_1'		=>$this->input->post('m_jmt_kab_id_1'),
				'm_jmt_kec_id_1'		=>$this->input->post('m_jmt_kec_id_1'),
				'm_jmt_telp_1'			=>$this->input->post('m_jmt_telp_1'),
				'm_jmt_alamat_2'		=>$this->input->post('m_jmt_alamat_2'),
				'm_jmt_prov_id_2'		=>$this->input->post('m_jmt_prov_id_2'),
				'm_jmt_kab_id_2'		=>$this->input->post('m_jmt_kab_id_2'),
				'm_jmt_kec_id_2'		=>$this->input->post('m_jmt_kec_id_2'),
				'm_jmt_telp_2'			=>$this->input->post('m_jmt_telp_2'),
				'm_jmt_baptis'			=>$this->input->post('m_jmt_baptis'),
				'm_jmt_anggota'			=>$this->input->post('m_jmt_anggota'),
				'm_jmt_grj_baptis'		=>$this->input->post('m_jmt_grj_baptis'),
				'm_jmt_tgl_baptis'		=>$m_jmt_tgl_baptis,
				'm_jmt_sidi'			=>$this->input->post('m_jmt_sidi'),
				'm_jmt_grj_sidi'		=>$this->input->post('m_jmt_grj_sidi'),
				'm_jmt_tgl_sidi'		=>$m_jmt_tgl_sidi,
				'm_jmt_grj_asal'		=>$this->input->post('m_jmt_grj_asal'),
				'm_jmt_tgl_masuk'		=>$m_jmt_tgl_masuk,
				'm_jmt_aktif'			=>$this->input->post('m_jmt_aktif'),
				'm_jmt_ket'				=>$this->input->post('m_jmt_ket'),
				'm_jmt_parent_child_id'	=>$this->input->post('m_jmt_parent_child_id'),
				'm_jmt_parent_child_hub'=>$this->input->post('m_jmt_parent_child_hub')
				);
			$this->Jemaat_model->addJemaat($data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data jemaat berhasil ditambahkan</div>');
			redirect('backend/m_jemaat');
		}	
	}

	function edit()
	{
		$this->form_validation->set_rules('m_jmt_nama', 'Nama Jemaat','required');
		$this->form_validation->set_rules('m_jmt_jenkel', 'Jenis Kelamin','required');
		//$this->form_validation->set_rules('m_jmt_tgl_lhr', 'Tanggal Lahir','required');
		//$this->form_validation->set_rules('m_jmt_tmpt_lhr', 'Tempat Lahir','required');

		//$this->form_validation->set_rules('m_jmt_status_kawin', 'Status Perkawinan','required');
		//$this->form_validation->set_rules('m_jmt_tgl_menikah', 'Tanggal menikah','required');
		//$this->form_validation->set_rules('m_jmt_alamat_1', 'Alamat Utama','required');
		//$this->form_validation->set_rules('m_jmt_prov_id_1', 'Provinsi','required');
		//$this->form_validation->set_rules('m_jmt_kab_id_1', 'Kabupaten','required');
		//$this->form_validation->set_rules('m_jmt_kec_id_1', 'Kecamatan','required');
		$this->form_validation->set_rules('m_jmt_telp_1', 'Telpon','required');

		//$this->form_validation->set_rules('m_jmt_prov_id_2', 'Alamat Opsional','required');
		//$this->form_validation->set_rules('m_jmt_kab_id_2', 'Kabupaten','required');
		//$this->form_validation->set_rules('m_jmt_kec_id_2', 'Kecamatan','required');
		//$this->form_validation->set_rules('m_jmt_telp_2', 'Telepon','required');
		//$this->form_validation->set_rules('m_jmt_baptis', 'Sudah Baptis','required');
		//$this->form_validation->set_rules('m_jmt_grj_baptis', 'Gereja tempat Baptis','required');
		//$this->form_validation->set_rules('m_jmt_tgl_baptis', 'Tanggal Baptis','required');
		//$this->form_validation->set_rules('m_jmt_sidi', 'Pengakuan Percaya','required');
		//$this->form_validation->set_rules('m_jmt_grj_sidi', 'Gereja tempat Pengakuan Percaya','required');
		//$this->form_validation->set_rules('m_jmt_tgl_sidi', 'Tanggal Pengakuan Percaya','required');
		//$this->form_validation->set_rules('m_jmt_grj_asal', 'Gereja Asal','required');
		//$this->form_validation->set_rules('m_jmt_aktif', 'Aktif','required');
		//$this->form_validation->set_rules('m_jmt_ket', 'Keterangan','required');
		//$this->form_validation->set_rules('m_jmt_parent_child_id', 'Hubungan keluarga','required');
		//$this->form_validation->set_rules('m_jmt_parent_child_hub', 'Jenis hubungan keluarga','required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] = 'Master Data';
			$id = $this->uri->segment(4);
			$data['title'] = $data['heading'].' - Jemaat';
			$data['template'] = 'm_jemaat/edit';
			$data['row'] = $this->Jemaat_model->getJemaat(FALSE,$id,FALSE,FALSE);
			$this->load->view('backend/index',$data);
		}
		else
		{
			$m_jmt_tgl_lhr 		= $this->input->post('m_jmt_tgl_lhr_y').'-'.$this->input->post('m_jmt_tgl_lhr_m').'-'.$this->input->post('m_jmt_tgl_lhr_d');
			$m_jmt_tgl_menikah	= $this->input->post('m_jmt_tgl_menikah_y').'-'.$this->input->post('m_jmt_tgl_menikah_m').'-'.$this->input->post('m_jmt_tgl_menikah_d');
			$m_jmt_tgl_baptis	= $this->input->post('m_jmt_tgl_baptis_y').'-'.$this->input->post('m_jmt_tgl_baptis_m').'-'.$this->input->post('m_jmt_tgl_baptis_d');
			$m_jmt_tgl_sidi		= $this->input->post('m_jmt_tgl_sidi_y').'-'.$this->input->post('m_jmt_tgl_sidi_m').'-'.$this->input->post('m_jmt_tgl_sidi_d');
			$m_jmt_tgl_masuk	= $this->input->post('m_jmt_tgl_masuk_y').'-'.$this->input->post('m_jmt_tgl_masuk_m').'-'.$this->input->post('m_jmt_tgl_masuk_d');
			$id = $this->uri->segment(4);
			$finger_id = str_replace(" ","",$this->input->post('m_jmt_finger_id'));
			$data = array
				(
				'm_jmt_no_induk'		=>$this->input->post('m_jmt_no_induk'),
				'm_jmt_finger_id'	=>mysql_real_escape_string($finger_id),
				'm_jmt_nama'			=>strtoupper($this->input->post('m_jmt_nama')),
				'm_jmt_jenkel'			=>$this->input->post('m_jmt_jenkel'),
				'm_jmt_tgl_lhr'			=>$m_jmt_tgl_lhr,
				'm_jmt_tmpt_lhr'		=>$this->input->post('m_jmt_tmpt_lhr'),
				'm_jmt_status_kawin'	=>$this->input->post('m_jmt_status_kawin'),
				'm_jmt_tgl_menikah'		=>$m_jmt_tgl_menikah,
				'm_jmt_wil_id'			=>$this->input->post('m_jmt_wil_id'),
				'm_jmt_alamat_1'		=>$this->input->post('m_jmt_alamat_1'),
				'm_jmt_prov_id_1'		=>$this->input->post('m_jmt_prov_id_1'),
				'm_jmt_kab_id_1'		=>$this->input->post('m_jmt_kab_id_1'),
				'm_jmt_kec_id_1'		=>$this->input->post('m_jmt_kec_id_1'),
				'm_jmt_telp_1'			=>$this->input->post('m_jmt_telp_1'),
				'm_jmt_alamat_2'		=>$this->input->post('m_jmt_alamat_2'),
				'm_jmt_prov_id_2'		=>$this->input->post('m_jmt_prov_id_2'),
				'm_jmt_kab_id_2'		=>$this->input->post('m_jmt_kab_id_2'),
				'm_jmt_kec_id_2'		=>$this->input->post('m_jmt_kec_id_2'),
				'm_jmt_telp_2'			=>$this->input->post('m_jmt_telp_2'),
				'm_jmt_baptis'			=>$this->input->post('m_jmt_baptis'),
				'm_jmt_anggota'			=>$this->input->post('m_jmt_anggota'),
				'm_jmt_grj_baptis'		=>$this->input->post('m_jmt_grj_baptis'),
				'm_jmt_tgl_baptis'		=>$m_jmt_tgl_baptis,
				'm_jmt_sidi'			=>$this->input->post('m_jmt_sidi'),
				'm_jmt_grj_sidi'		=>$this->input->post('m_jmt_grj_sidi'),
				'm_jmt_tgl_sidi'		=>$m_jmt_tgl_sidi,
				'm_jmt_grj_asal'		=>$this->input->post('m_jmt_grj_asal'),
				'm_jmt_tgl_masuk'		=>$m_jmt_tgl_masuk,
				'm_jmt_aktif'			=>$this->input->post('m_jmt_aktif'),
				'm_jmt_ket'				=>$this->input->post('m_jmt_ket'),
				'm_jmt_parent_child_id'	=>$this->input->post('m_jmt_parent_child_id'),
				'm_jmt_parent_child_hub'=>$this->input->post('m_jmt_parent_child_hub')
				);
			$this->Jemaat_model->editJemaat($id,$data);
			$this->session->set_flashdata('message_type','<div class="alert alert-success">Data berhasil diupdate</div>');
			redirect('backend/m_jemaat/edit/'.$id);
		}
			
	}

	function delete($id)
	{
		$id = $this->uri->segment(4);
		$uri = $this->uri->segment(5);
		$this->Jemaat_model->deleteJemaat($id);
		$count = count($this->Jemaat_model->getJemaat('all',FALSE,FALSE,FALSE));
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data jemaat berhasil dihapus</div>');
		//getPage('bank','delete',$uri,$count);
		redirect('backend/m_jemaat');
	}


	function ajaxShowKab()
	{

		$onChange 	=$this->uri->segment(6);
		$prov_id 	=$this->uri->segment(5);
		$field_name	=$this->uri->segment(4);


		$this->db->where('kab_prov_id',$prov_id);
		$res = $this->db->get('tb_kabupaten')->result_array();
		
		
		$output = "<select class='form-control' name='$field_name' id='$field_name' onChange='$onChange(this.value)'>";
		$output .= "<option  value=''> - Pilih -</option>";
        foreach ($res as $kab):
             $output .= "<option  value='".$kab['kab_id']."'>".$kab['kab_name']."</option>";
        endforeach;
		
		
		echo $output;
	}


	function ajaxShowKotKec()
	{

		$prov_id 	=$this->uri->segment(6);
		$kab_id 	=$this->uri->segment(5);
		$field_name	=$this->uri->segment(4);


		if($kab_id):

			$this->db->where('kotkec_kab_id',$kab_id);
			$this->db->where('kotkec_prov_id',$prov_id);
			$res = $this->db->get('tb_kotkec')->result_array();
			
			$output = "<select class='form-control' name='$field_name' id='$field_name'>";
			$output .= "<option  value=''> - Pilih -</option>";
	        foreach ($res as $kotkec):
	             $output .= "<option  value='".$kotkec['kotkec_id']."'>".$kotkec['kotkec_name']."</option>";
	        endforeach;
		else:
			$output = "<select class='form-control' name='$field_name' id='$field_name'>";
	        $output .= "<option  value=''> - Pilih -</option>";
	    endif;
			
		echo $output;
	}
	
}