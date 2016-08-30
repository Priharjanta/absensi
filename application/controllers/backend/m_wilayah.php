<?php

class M_Wilayah extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Wilayah_model');
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
		$config['base_url'] = site_url().'/backend/m_wilayah/index';
		$config['total_rows'] = count($this->Wilayah_model->getWilayah('all',FALSE,FALSE,FALSE));
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
		$data['title'] = $data['heading'].' - Wilayah';
		$data['template'] = 'm_wilayah/index';
		$data['res'] = $this->Wilayah_model->getWilayah('all',FALSE,$config['per_page'],$offset);

		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function add()
	{

		$this->form_validation->set_rules('m_wil_name', 'Nama Wilayah','required');
		$this->form_validation->set_rules('m_wil_koord_name', 'Nama Koord / KA','required');
		$this->form_validation->set_rules('m_wil_area', 'Area / Wilayah','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] 	= 'Master Data';
			$data['title'] 		= $data['heading'].' - Wilayah';
			$data['template'] 	= 'm_wilayah/add';
			$this->load->view('backend/index',$data);
		}
		else
		{
			$data = array
				(
				'm_wil_name'			=>$this->input->post('m_wil_name'),
				'm_wil_koord_name'		=>$this->input->post('m_wil_koord_name'),
				'm_wil_koord_jmt_id'	=>$this->input->post('m_wil_koord_jmt_id'),
				'm_wil_phone'			=>$this->input->post('m_wil_phone'),
				'm_wil_area'			=>$this->input->post('m_wil_area')
				);
			$this->Wilayah_model->addWilayah($data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data Wilayah berhasil ditambahkan</div>');
			redirect('backend/m_wilayah');
		}	
	}

	function edit()
	{
		$this->form_validation->set_rules('m_wil_name', 'Nama Wilayah','required');
		$this->form_validation->set_rules('m_wil_koord_name', 'Nama Koord / KA','required');
		$this->form_validation->set_rules('m_wil_area', 'Area / Wilayah','required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] = 'Master Data';
			$id = $this->uri->segment(4);
			$data['title'] = $data['heading'].' - Wilayah';
			$data['template'] = 'm_wilayah/edit';
			$data['row'] = $this->Wilayah_model->getWilayah(FALSE,$id,FALSE,FALSE);
			$this->load->view('backend/index',$data);
		}
		else
		{
			$data = array
				(
				'm_wil_name'			=>$this->input->post('m_wil_name'),
				'm_wil_koord_name'		=>$this->input->post('m_wil_koord_name'),
				'm_wil_koord_jmt_id'	=>$this->input->post('m_wil_koord_jmt_id'),
				'm_wil_phone'			=>$this->input->post('m_wil_phone'),
				'm_wil_area'			=>$this->input->post('m_wil_area')
				);
			$id = $this->uri->segment(4);
			$this->Wilayah_model->editWilayah($id,$data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil diupdate</div>');
			redirect('backend/m_wilayah/edit/'.$id);
		}
			
	}

	function delete($id)
	{
		$id = $this->uri->segment(4);
		$uri = $this->uri->segment(5);
		$this->Wilayah_model->deleteWilayah($id);
		$count = count($this->Wilayah_model->getWilayah('all',FALSE,FALSE,FALSE));
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil dihapus</div>');
		//getPage('bank','delete',$uri,$count);
		redirect('backend/m_wilayah');
	}
	
}