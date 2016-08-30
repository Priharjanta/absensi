<?php

class Data_keb extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Datakeb_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		endif;

	}

	function index()
	{
		$this->load->library('pagination');
		$offset = $this->uri->segment(3);
		$config['base_url'] = site_url().'/data_keb/index';
		$config['total_rows'] = count($this->Datakeb_model->getDatakeb('all',FALSE,FALSE,FALSE));
		$config['per_page'] = $this->config->item('per_page');
		$config['uri_segment'] = '3';
		
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
		
		$data['urut'] = $this->uri->segment(3);
		$data['heading'] = 'Data Kebaktian';
		$data['title'] = $data['heading'].' - Kebaktian';
		$data['template'] = 'data_keb/index';
		$data['res'] = $this->Datakeb_model->getDatakeb('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('index',$data);
	}
	
}