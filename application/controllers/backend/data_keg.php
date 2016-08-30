<?php

class Data_keg extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Datakeg_model');
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
		$config['base_url'] = site_url().'/backend/data_keg/index';
		$config['total_rows'] = count($this->Datakeg_model->getDatakeg('all',FALSE,FALSE,FALSE));
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
		$data['heading'] = 'Data Kegiatan';
		$data['title'] = $data['heading'].' - Kegiatan';
		$data['template'] = 'data_keg/index';
		$data['res'] = $this->Datakeg_model->getDatakeg('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function add()
	{

		$this->form_validation->set_rules('keg_date_y', 'Tanggal Kegiatan (thn)','required');
		$this->form_validation->set_rules('keg_date_m', 'Tanggal Kegiatan (bln)','required');
		$this->form_validation->set_rules('keg_date_d', 'Tanggal Kegiatan (hr)','required');
		$this->form_validation->set_rules('keg_m_keg_id', 'Nama Kegiatan','required');
		$this->form_validation->set_rules('keg_tema', 'Tema','required');
		$this->form_validation->set_rules('keg_pembicara', 'Pembicara','required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] 	= 'Data Kegiatan';
			$data['title'] 		= $data['heading'].' - Kegiatan';
			$data['template'] 	= 'data_keg/add';
			$this->load->view('backend/index',$data);
		}
		else
		{
			$keg_date = $this->input->post('keg_date_y').'-'.$this->input->post('keg_date_m').'-'.$this->input->post('keg_date_d');

			$keg_opt_start_date = $this->input->post('keg_opt_start_date_time_y').'-'.$this->input->post('keg_opt_start_date_time_m').'-'.$this->input->post('keg_opt_start_date_time_d');
			$keg_opt_start_time = $this->input->post('keg_opt_start_date_time_h').'-'.$this->input->post('keg_opt_start_date_time_min').'-'.$this->input->post('keg_opt_start_date_time_s');
			$keg_opt_start_date_time = $keg_opt_start_date.' '.$keg_opt_start_time;

			$keg_opt_end_date = $this->input->post('keg_opt_end_date_time_y').'-'.$this->input->post('keg_opt_end_date_time_m').'-'.$this->input->post('keg_opt_end_date_time_d');
			$keg_opt_end_time = $this->input->post('keg_opt_end_date_time_h').'-'.$this->input->post('keg_opt_end_date_time_min').'-'.$this->input->post('keg_opt_end_date_time_s');
			$keg_opt_end_date_time = $keg_opt_end_date.' '.$keg_opt_end_time;

			$data = array
				(
					'keg_m_keg_id'					=>$this->input->post('keg_m_keg_id'),
					'keg_date'						=>$keg_date,
					'keg_opt_start_date_time'		=>$keg_opt_start_date_time,
					'keg_opt_end_date_time'			=>$keg_opt_end_date_time,
					'keg_tema'						=>$this->input->post('keg_tema'),
					'keg_pembicara'					=>$this->input->post('keg_pembicara'),
					'keg_ayat'						=>$this->input->post('keg_ayat'),
					'keg_ket'						=>$this->input->post('keg_ket'),
					'keg_aktif'						=>$this->input->post('keg_aktif')
				);
			$this->Datakeg_model->addDatakeg($data);
			
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data Kegiatan berhasil ditambahkan</div>');
			redirect('backend/data_keg');
		}	
	}

	function edit()
	{
		$this->form_validation->set_rules('keg_date_y', 'Tanggal Kegiatan (thn)','required');
		$this->form_validation->set_rules('keg_date_m', 'Tanggal Kegiatan (bln)','required');
		$this->form_validation->set_rules('keg_date_d', 'Tanggal Kegiatan (hr)','required');
		$this->form_validation->set_rules('keg_m_keg_id', 'Nama Kegiatan','required');
		$this->form_validation->set_rules('keg_tema', 'Tema','required');
		$this->form_validation->set_rules('keg_pembicara', 'Pembicara','required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] = 'Data Kegiatan';
			$id = $this->uri->segment(4);
			$data['title'] = $data['heading'].' - Kegiatan';
			$data['template'] = 'data_keg/edit';
			$data['row'] = $this->Datakeg_model->getDatakeg(FALSE,$id,FALSE,FALSE);
			$this->load->view('backend/index',$data);
		}
		else
		{
			$keg_date = $this->input->post('keg_date_y').'-'.$this->input->post('keg_date_m').'-'.$this->input->post('keg_date_d');

			$keg_opt_start_date = $this->input->post('keg_opt_start_date_time_y').'-'.$this->input->post('keg_opt_start_date_time_m').'-'.$this->input->post('keg_opt_start_date_time_d');
			$keg_opt_start_time = $this->input->post('keg_opt_start_date_time_h').'-'.$this->input->post('keg_opt_start_date_time_min').'-'.$this->input->post('keg_opt_start_date_time_s');
			$keg_opt_start_date_time = $keg_opt_start_date.' '.$keg_opt_start_time;

			$keg_opt_end_date = $this->input->post('keg_opt_end_date_time_y').'-'.$this->input->post('keg_opt_end_date_time_m').'-'.$this->input->post('keg_opt_end_date_time_d');
			$keg_opt_end_time = $this->input->post('keg_opt_end_date_time_h').'-'.$this->input->post('keg_opt_end_date_time_min').'-'.$this->input->post('keg_opt_end_date_time_s');
			$keg_opt_end_date_time = $keg_opt_end_date.' '.$keg_opt_end_time;

			$data = array
				(
					'keg_m_keg_id'					=>$this->input->post('keg_m_keg_id'),
					'keg_date'						=>$keg_date,
					'keg_opt_start_date_time'		=>$keg_opt_start_date_time,
					'keg_opt_end_date_time'			=>$keg_opt_end_date_time,
					'keg_tema'						=>$this->input->post('keg_tema'),
					'keg_pembicara'					=>$this->input->post('keg_pembicara'),
					'keg_ayat'						=>$this->input->post('keg_ayat'),
					'keg_ket'						=>$this->input->post('keg_ket'),
					'keg_aktif'						=>$this->input->post('keg_aktif')
				);
			$id = $this->uri->segment(4);
			$this->Datakeg_model->editDatakeg($id,$data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil diupdate</div>');
			redirect('backend/data_keg/edit/'.$id);
		}
			
	}

	function delete($id)
	{
		$id = $this->uri->segment(4);
		$uri = $this->uri->segment(5);
		$this->Datakeg_model->deleteDatakeg($id);
		$count = count($this->Datakeg_model->getDatakeg('all',FALSE,FALSE,FALSE));
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil dihapus</div>');
		//getPage('bank','delete',$uri,$count);
		redirect('backend/data_keg');
	}
	
}