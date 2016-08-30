<?php

class Abs_keg extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Abskeg_model');
		$this->load->model('Datakeg_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('backend');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('backend/no_access');
		endif;

	}

	function view()
	{
		$this->load->library('pagination');
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

		if($this->uri->segment(4) == 'hdr'):

			$keg_id = $this->uri->segment(5);
			$offset = $this->uri->segment(6);
			$config['base_url'] = site_url().'/backend/abs_keg/view/hdr/'.$keg_id.'/';
			$config['total_rows'] = count($this->Abskeg_model->getAbskeg('byKegId',FALSE,FALSE,FALSE,$keg_id));
			$config['per_page'] = $this->config->item('per_page');
			$config['uri_segment'] = '6';


			$qr_keg = $this->db->query("
						SELECT 
							tb_kegiatan.*,
							tb_m_kegiatan.*
						FROM 
							tb_kegiatan
						JOIN 
							tb_m_kegiatan ON tb_m_kegiatan.m_keg_id = tb_kegiatan.keg_m_keg_id
						WHERE 
							tb_kegiatan.keg_id = $keg_id")->row();
			
			$data['urut'] = $this->uri->segment(5);
			$data['row_ibkeg'] = $qr_keg;
		
			$data['urut'] = $this->uri->segment(6);
			$data['heading'] = 'Data Kehadiran';
			$data['keg_id']  = $keg_id;
			$data['title'] = $data['heading'].' - '.$qr_keg->m_keg_name.' - '.$qr_keg->keg_date;
			$data['template'] = 'abs_keg/view_hdr';
			$data['res'] = $this->Abskeg_model->getAbskeg('byKegId',FALSE,$config['per_page'],$offset,$keg_id);
			$this->pagination->initialize($config);
			$this->load->view('backend/index',$data);

		else:

			$offset = $this->uri->segment(4);
			$config['base_url'] = site_url().'/backend/abs_keg/view/';
			$config['total_rows'] = count($this->Datakeg_model->getDatakeg('all',FALSE,FALSE,FALSE));
			$config['per_page'] = $this->config->item('per_page');
			$config['uri_segment'] = '4';
			
			$data['urut'] = $this->uri->segment(4);
			$data['heading'] = 'Data Kehadiran';
			$data['title'] = $data['heading'].' - List Kegiatan';
			$data['template'] = 'abs_keg/view_list';
			$data['res'] = $this->Datakeg_model->getDatakeg('all',FALSE,$config['per_page'],$offset);
			$this->pagination->initialize($config);
			$this->load->view('backend/index',$data);
		endif;
	}


	function searchJemaat()
	{

		$list = searchJmt($_POST['keyword']);

		foreach ($list as $rs) 
		{
			// put in bold the written text
			$m_jmt_nama = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['m_jmt_nama']);
			// add new option
		    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['m_jmt_nama']).'\',\''.$rs['m_jmt_id'].'\')"><a tabindex="-1" href="#">'.$m_jmt_nama.'</a></li>';

		}


	}


	function add_abs()
	{

		$this->form_validation->set_rules('hdr_keg_m_jmt_id', 'Nama Jemaat','required');
		
		if ($this->form_validation->run() == FALSE)
		{

			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-danger">Data Jemaat tidak terdaftar</div>');
			redirect('backend/abs_keg/view/hdr/'.$this->input->post('hdr_keg_keg_id'));
		}
		else
		{
			$data = array
					(
						'hdr_keg_keg_id'		=>$this->input->post('hdr_keg_keg_id'),
						'hdr_keg_m_jmt_id'		=>$this->input->post('hdr_keg_m_jmt_id'),
						'hdr_keg_datetime'		=>mysqlDateNow(),
						'hdr_keg_ket'			=>$this->input->post('hdr_keg_ket')
					);
			$this->Abskeg_model->addAbskeg($data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data Kehadiran berhasil ditambahkan</div>');
			redirect('backend/abs_keg/view/hdr/'.$this->input->post('hdr_keg_keg_id'));
		}
			
	}


	function del_abs()
	{
		$abs_keg_id = $this->uri->segment(5);
		$keg_id 	= $this->uri->segment(4);

		$this->Abskeg_model->deleteAbskeg($abs_keg_id);

		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data Kehadiran berhasil dihapus</div>');
		redirect('backend/abs_keg/view/hdr/'.$keg_id);
	}
	
}