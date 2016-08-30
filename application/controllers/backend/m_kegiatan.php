<?php

class m_kegiatan extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Kegiatan_model');
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
		$config['base_url'] = site_url().'/backend/m_kegiatan/index';
		$config['total_rows'] = count($this->Kegiatan_model->getKegiatan('all',FALSE,FALSE,FALSE));
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
		$data['title'] = $data['heading'].' - Kegiatan';
		$data['template'] = 'm_kegiatan/index';
		$data['res'] = $this->Kegiatan_model->getKegiatan('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function add()
	{
		$this->form_validation->set_rules('m_keg_name', 'Nama Kegiatan','required');
		$this->form_validation->set_rules('m_keg_start_time_h', 'Waktu mulai (H)','required');
		$this->form_validation->set_rules('m_keg_start_time_m', 'Waktu mulai (M)','required');
		$this->form_validation->set_rules('m_keg_start_time_s', 'Waktu mulai (S)','required');
		$this->form_validation->set_rules('m_keg_end_time_h', 'Waktu berakhir (H)','required');
		$this->form_validation->set_rules('m_keg_end_time_m', 'Waktu berakhir (M)','required');
		$this->form_validation->set_rules('m_keg_end_time_s', 'Waktu berakhir (S)','required');
		//$this->form_validation->set_rules('m_keg_ket', 'Keterangan','required');
		//$this->form_validation->set_rules('m_keg_lokasi', 'Tempat/Lokasi','required');
		$this->form_validation->set_rules('m_keg_aktif', 'Aktif','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] = 'Master Data';
			$data['title'] = $data['heading'].' - Kegiatan';
			$data['template'] = 'm_kegiatan/add';
			$this->load->view('backend/index',$data);
		}
		else
		{
			$m_keg_start_time 	= $this->input->post('m_keg_start_time_h').':'.$this->input->post('m_keg_start_time_m').':'.$this->input->post('m_keg_start_time_s');
			$m_keg_end_time 	= $this->input->post('m_keg_end_time_h').':'.$this->input->post('m_keg_end_time_m').':'.$this->input->post('m_keg_end_time_s');
			$data = array
				(
				'm_keg_name'		=>$this->input->post('m_keg_name'),
				'm_keg_start_time'	=>$m_keg_start_time,
				'm_keg_end_time'	=>$m_keg_end_time,
				'm_keg_lokasi'		=>$this->input->post('m_keg_lokasi'),
				'm_keg_ket'			=>$this->input->post('m_keg_ket'),
				'm_keg_aktif'		=>$this->input->post('m_keg_aktif')
				);
			$this->Kegiatan_model->addKegiatan($data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data kegiatan berhasil ditambahkan</div>');
			redirect('backend/m_kegiatan');
		}	
	}

	function edit()
	{
		$this->form_validation->set_rules('m_keg_name', 'Nama Kegiatan','required');
		$this->form_validation->set_rules('m_keg_start_time_h', 'Waktu mulai (H)','required');
		$this->form_validation->set_rules('m_keg_start_time_m', 'Waktu mulai (M)','required');
		$this->form_validation->set_rules('m_keg_start_time_s', 'Waktu mulai (S)','required');
		$this->form_validation->set_rules('m_keg_end_time_h', 'Waktu berakhir (H)','required');
		$this->form_validation->set_rules('m_keg_end_time_m', 'Waktu berakhir (M)','required');
		$this->form_validation->set_rules('m_keg_end_time_s', 'Waktu berakhir (S)','required');
		//$this->form_validation->set_rules('m_keg_ket', 'Keterangan','required');
		//$this->form_validation->set_rules('m_keg_lokasi', 'Tempat/Lokasi','required');
		$this->form_validation->set_rules('m_keg_aktif', 'Aktif','required');


		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] = 'Master Data';
			$id = $this->uri->segment(4);
			$data['title'] = $data['heading'].' - Kegiatan';
			$data['template'] = 'm_kegiatan/edit';
			$data['row'] = $this->Kegiatan_model->getKegiatan(FALSE,$id,FALSE,FALSE);
			$this->load->view('backend/index',$data);
		}
		else
		{
			$m_keg_start_time 	= $this->input->post('m_keg_start_time_h').':'.$this->input->post('m_keg_start_time_m').':'.$this->input->post('m_keg_start_time_s');
			$m_keg_end_time 		= $this->input->post('m_keg_end_time_h').':'.$this->input->post('m_keg_end_time_m').':'.$this->input->post('m_keg_end_time_s');
			$id = $this->uri->segment(4);
			$data = array
				(
				'm_keg_name'		=>$this->input->post('m_keg_name'),
				'm_keg_start_time'	=>$m_keg_start_time,
				'm_keg_end_time'	=>$m_keg_end_time,
				'm_keg_lokasi'		=>$this->input->post('m_keg_lokasi'),
				'm_keg_ket'			=>$this->input->post('m_keg_ket'),
				'm_keg_aktif'		=>$this->input->post('m_keg_aktif')
				);
			$this->Kegiatan_model->editKegiatan($id,$data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil diupdate</div>');
			redirect('backend/m_kegiatan/edit/'.$id);
		}
			
	}

	function delete($id)
	{
		$id = $this->uri->segment(4);
		$uri = $this->uri->segment(5);
		$this->Kegiatan_model->deleteKegiatan($id);
		$count = count($this->Kegiatan_model->getKegiatan('all',FALSE,FALSE,FALSE));
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil dihapus</div>');
		//getPage('bank','delete',$uri,$count);
		redirect('backend/m_kegiatan');
	}
	
}