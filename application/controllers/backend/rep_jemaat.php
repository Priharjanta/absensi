<?php

class Rep_jemaat extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Abskeb_model');
		$this->load->model('Jemaat_model');
		$this->load->helper('download');
		$this->load->library('html2pdf');
		$this->load->library('fpdf');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('backend');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('backend/no_access');
		endif;

	}

	function index()
	{

				$filter_y		= formatDate(MysqlDateNow(),'year_only');
				$filter_m		= formatDate(MysqlDateNow(),'month_only');

				$this->load->library('pagination');
				$offset = $this->uri->segment(7);
				$config['base_url'] = site_url().'/backend/rep_jemaat/perbulan/filter/'.$filter_y.'/'.$filter_m.'/';
				$config['total_rows'] = count($this->Abskeb_model->GetRepKebJmt('bln',FALSE,FALSE,$filter_m,$filter_y,FALSE));
				$config['per_page'] = $this->config->item('per_page');
				$config['uri_segment'] = '7';
					
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
					
				$data['urut'] = $this->uri->segment(7);
				$data['heading'] = 'Report Jemaat';
				$data['title'] = $data['heading'].' - Per Bulan '.$filter_m.' Tahun '.$filter_y;
				$data['template'] = 'rep_jemaat/index';
				$data['tab'] = 'perbulan';

					// FORM VARIABLE
				$data['form_id'] 		= 'cari_perbulan';
				$data['form_dst'] 		= 'cari_perbulan';
				$data['onclick_cari'] 	= 'CariPerbulan';
				$data['onclick_back'] 	= 'BackPerbulan';
				$data['form_dst'] 		= 'cari_perbulan';
				$data['key_nama'] 		= "";
				$data['filter']			= 'filter_perbulan';
				$data['date_time']		= $filter_y.'-'.$filter_m.'-01';
					// END OF FORM VARIABLE
				$data['res'] = $this->Abskeb_model->GetRepKebJmt('bln',$config['per_page'],$offset,$filter_m,$filter_y,FALSE);
				$this->pagination->initialize($config);
				$this->load->view('backend/index',$data);
			

	}

	function perbulan()
	{

		$this->form_validation->set_rules('key_nama', 'Nama harus diisi','required');

		if ($this->form_validation->run() == FALSE)
		{

			if($this->input->post('filter_bln_m')||$this->uri->segment(4) == 'filter')
			{

				if($this->input->post('filter_bln_m') && $this->input->post('filter_bln_y'))
				{
					$filter_m 	= $this->input->post('filter_bln_m');
					$filter_y	= $this->input->post('filter_bln_y');
				}
				else
				{
					$filter_m 	= $this->uri->segment(6);
					$filter_y	= $this->uri->segment(5);				
				}

				$this->load->library('pagination');
				$offset = $this->uri->segment(7);
				$config['base_url'] = site_url().'/backend/rep_jemaat/perbulan/filter/'.$filter_y.'/'.$filter_m.'/';
				$config['total_rows'] = count($this->Abskeb_model->GetRepKebJmt('bln',FALSE,FALSE,$filter_m,$filter_y,FALSE));
				$config['per_page'] = $this->config->item('per_page');
				$config['uri_segment'] = '7';
					
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
					
				$data['urut'] = $this->uri->segment(7);
				$data['heading'] = 'Report Jemaat';
				$data['title'] = $data['heading'].' - Per Bulan '.$filter_m.' Tahun '.$filter_y;
				$data['template'] = 'rep_jemaat/perbulan';
				$data['tab'] = 'perbulan';

					// FORM VARIABLE
				$data['form_id'] 		= 'cari_perbulan';
				$data['form_dst'] 		= 'cari_perbulan';
				$data['onclick_cari'] 	= 'CariPerbulan';
				$data['onclick_back'] 	= 'BackPerbulan';
				$data['form_dst'] 		= 'cari_perbulan';
				$data['key_nama'] 		= "";
				$data['filter']			= 'filter_perbulan';
				$data['date_time']		= $filter_y.'-'.$filter_m.'-01';
					// END OF FORM VARIABLE
				$data['res'] = $this->Abskeb_model->GetRepKebJmt('bln',$config['per_page'],$offset,$filter_m,$filter_y,FALSE);
				$this->pagination->initialize($config);
				$this->load->view('backend/index',$data);
					
			}

			else
			{
				$filter_y		= formatDate(MysqlDateNow(),'year_only');
				$filter_m		= formatDate(MysqlDateNow(),'month_only');

				$this->load->library('pagination');
				$offset = $this->uri->segment(7);
				$config['base_url'] = site_url().'/backend/rep_jemaat/perbulan/filter/'.$filter_y.'/'.$filter_m.'/';
				$config['total_rows'] = count($this->Abskeb_model->GetRepKebJmt('bln',FALSE,FALSE,$filter_m,$filter_y,FALSE));
				$config['per_page'] = $this->config->item('per_page');
				$config['uri_segment'] = '7';
					
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
					
				$data['urut'] = $this->uri->segment(7);
				$data['heading'] = 'Report Jemaat';
				$data['title'] = $data['heading'].' - Per Bulan '.$filter_m.' Tahun '.$filter_y;
				$data['template'] = 'rep_jemaat/perbulan';
				$data['tab'] = 'perbulan';

					// FORM VARIABLE
				$data['form_id'] 		= 'cari_perbulan';
				$data['form_dst'] 		= 'cari_perbulan';
				$data['onclick_cari'] 	= 'CariPerbulan';
				$data['onclick_back'] 	= 'BackPerbulan';
				$data['form_dst'] 		= 'cari_perbulan';
				$data['key_nama'] 		= "";
				$data['filter']			= 'filter_perbulan';
				$data['date_time']		= $filter_y.'-'.$filter_m.'-01';
					// END OF FORM VARIABLE
				$data['res'] = $this->Abskeb_model->GetRepKebJmt('bln',$config['per_page'],$offset,$filter_m,$filter_y,FALSE);
				$this->pagination->initialize($config);
				$this->load->view('backend/index',$data);
			}
				
		}
		else
		{
			$this->load->library('pagination');
					
			$filter_m 	= $this->input->post('filter_bln_m');
			$filter_y	= $this->input->post('filter_bln_y');

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
					
			$data['urut'] = $this->uri->segment(7);
			$data['heading'] = 'Report Jemaat';
			$data['title'] = $data['heading'].' - Per Bulan '.$filter_m.' Tahun '.$filter_y.' Keywords : '.$this->input->post('key_nama');
			$data['template'] = 'rep_jemaat/perbulan';
			$data['tab'] = 'perbulan';

					// FORM VARIABLE
			$data['form_id'] 		= 'cari_perbulan';
			$data['form_dst'] 		= 'cari_perbulan';
			$data['onclick_cari'] 	= 'CariPerbulan';
			$data['onclick_back'] 	= 'BackPerbulan';
			$data['form_dst'] 		= 'cari_perbulan';
			$data['key_nama'] 		= $this->input->post('key_nama');
			$data['filter']			= 'filter_perbulan';
			$data['date_time']		= $filter_y.'-'.$filter_m.'-01';
			$data['filter_tipe_sel']= $this->input->post('filter_perbulan');
					// END OF FORM VARIABLE
			$data['res'] = $this->Abskeb_model->GetRepKebJmt('bln_nama',FALSE,FALSE,$filter_m,$filter_y,$this->input->post('key_nama'));
			$this->pagination->initialize($config);
			$this->load->view('backend/index',$data);
		}

	}


	function pertahun()
	{

		$this->form_validation->set_rules('key_nama', 'Nama harus diisi','required');

		if ($this->form_validation->run() == FALSE)
		{

			if($this->input->post('filter_thn_y')||$this->uri->segment(4) == 'filter')
			{

				if($this->input->post('filter_thn_y'))
				{
					$filter_y	= $this->input->post('filter_thn_y');
				}
				else
				{
					$filter_y	= $this->uri->segment(5);				
				}

				$this->load->library('pagination');
				$offset = $this->uri->segment(6);
				$config['base_url'] = site_url().'/backend/rep_jemaat/pertahun/filter/'.$filter_y.'/';
				$config['total_rows'] = count($this->Abskeb_model->GetRepKebJmt('thn',FALSE,FALSE,FALSE,$filter_y,FALSE));
				$config['per_page'] = $this->config->item('per_page');
				$config['uri_segment'] = '6';
					
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
					
				$data['urut'] = $this->uri->segment(6);
				$data['heading'] = 'Report Jemaat';
				$data['title'] = $data['heading'].' - Per Tahun '.$filter_y;
				$data['template'] = 'rep_jemaat/pertahun';
				$data['tab'] = 'pertahun';

				// FORM VARIABLE
				$data['form_id'] 		= 'cari_pertahun';
				$data['form_dst'] 		= 'cari_pertahun';
				$data['onclick_cari'] 	= 'CariPertahun';
				$data['onclick_back'] 	= 'BackPertahun';
				$data['form_dst'] 		= 'cari_pertahun';
				$data['key_nama'] 		= "";
				$data['filter']			= 'filter_pertahun';
				$data['date_time']		= $filter_y.'-01-01';
				// END OF FORM VARIABLE
				$data['res'] = $this->Abskeb_model->GetRepKebJmt('thn',$config['per_page'],$offset,FALSE,$filter_y,FALSE);
				$this->pagination->initialize($config);
				$this->load->view('backend/index',$data);
					
			}

			else
			{
				$filter_y		= formatDate(MysqlDateNow(),'year_only');

				$this->load->library('pagination');
				$offset = $this->uri->segment(6);
				$config['base_url'] = site_url().'/backend/rep_jemaat/pertahun/filter/'.$filter_y.'/';
				$config['total_rows'] = count($this->Abskeb_model->GetRepKebJmt('thn',FALSE,FALSE,'FALSE',$filter_y,FALSE));
				$config['per_page'] = $this->config->item('per_page');
				$config['uri_segment'] = '6';
					
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
					
				$data['urut'] = $this->uri->segment(6);
				$data['heading'] = 'Report Jemaat';
				$data['title'] = $data['heading'].' - Per Tahun '.$filter_y;
				$data['template'] = 'rep_jemaat/pertahun';
				$data['tab'] = 'pertahun';

				// FORM VARIABLE
				$data['form_id'] 		= 'cari_pertahun';
				$data['form_dst'] 		= 'cari_pertahun';
				$data['onclick_cari'] 	= 'CariPertahun';
				$data['onclick_back'] 	= 'BackPertahun';
				$data['form_dst'] 		= 'cari_pertahun';
				$data['key_nama'] 		= "";
				$data['filter']			= 'filter_pertahun';
				$data['date_time']		= $filter_y.'-01-01';
				// END OF FORM VARIABLE

				$data['res'] = $this->Abskeb_model->GetRepKebJmt('thn',$config['per_page'],$offset,FALSE,$filter_y,FALSE);
				$this->pagination->initialize($config);
				$this->load->view('backend/index',$data);
			}
				
		}
		else
		{
			$this->load->library('pagination');
					
			$filter_y	= $this->input->post('filter_thn_y');

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
					
			$data['urut'] = $this->uri->segment(7);
			$data['heading'] = 'Report Jemaat';
			$data['title'] = $data['heading'].' - Per Tahun '.$filter_y.' Keywords : '.$this->input->post('key_nama');
			$data['template'] = 'rep_jemaat/pertahun';
			$data['tab'] = 'pertahun';

					// FORM VARIABLE
			$data['form_id'] 		= 'cari_pertahun';
			$data['form_dst'] 		= 'cari_pertahun';
			$data['onclick_cari'] 	= 'CariPertahun';
			$data['onclick_back'] 	= 'BackPertahun';
			$data['form_dst'] 		= 'cari_pertahun';
			$data['key_nama'] 		= $this->input->post('key_nama');
			$data['date_time']		= $filter_y.'-01-01';
			$data['filter']			= 'filter_pertahun';
					// END OF FORM VARIABLE
			$data['res'] = $this->Abskeb_model->GetRepKebJmt('thn_nama',FALSE,FALSE,FALSE,$filter_y,$this->input->post('key_nama'));
			$this->pagination->initialize($config);
			$this->load->view('backend/index',$data);
		}

	}

	function custom()
	{

		$this->form_validation->set_rules('key_nama', 'Nama harus diisi','required');

		if ($this->form_validation->run() == FALSE)
		{

			if($this->input->post('filter_dt_begin_y')||$this->uri->segment(4) == 'filter')
			{

				if($this->input->post('filter_dt_begin_y') && $this->input->post('filter_dt_end_y'))
				{
					$date_begin 	= $this->input->post('filter_dt_begin_y').'-'.$this->input->post('filter_dt_begin_m');
					$date_end		= $this->input->post('filter_dt_end_y').'-'.$this->input->post('filter_dt_end_m');
				}
				else
				{
					$date_begin		= $this->uri->segment(6);
					$date_end		= $this->uri->segment(5);				
				}

				$date_begin_qr		= $date_begin.'-01';
				$date_end_qr		= $date_end.'-31';

				$this->load->library('pagination');
				$offset = $this->uri->segment(7);
				$config['base_url'] = site_url().'/backend/rep_jemaat/custom/filter/'.$date_begin.'/'.$date_end.'/';
				$config['total_rows'] = count($this->Abskeb_model->GetRepKebJmt('custom',FALSE,FALSE,FALSE,FALSE,FALSE,$date_begin_qr,$date_end_qr));
				$config['per_page'] = $this->config->item('per_page');
				$config['uri_segment'] = '7';
					
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
					
				$data['urut'] = $this->uri->segment(7);
				$data['heading'] = 'Report Jemaat';
				$data['title'] = $data['heading'].' - Per '.formatDate($date_begin_qr.' 00:00:00','year_month_only_long').' s/d '.formatDate($date_end_qr.' 00:00:00','year_month_only_long');
				$data['template'] = 'rep_jemaat/custom';
				$data['tab'] = 'custom';

					// FORM VARIABLE
				$data['form_id'] 		= 'cari_custom';
				$data['form_dst'] 		= 'cari_custom';
				$data['onclick_cari'] 	= 'CariCustom';
				$data['onclick_back'] 	= 'BackCustom';
				$data['form_dst'] 		= 'cari_custom';
				$data['key_nama'] 		= "";
				$data['filter']			= 'filter_custom';
				$data['date_time_begin']		= $date_begin_qr;
				$data['date_time_end']			= $date_end_qr;
					// END OF FORM VARIABLE
				$data['res'] = $this->Abskeb_model->GetRepKebJmt('custom',$config['per_page'],$offset,FALSE,FALSE,FALSE,$date_begin_qr,$date_end_qr);
				$this->pagination->initialize($config);
				$this->load->view('backend/index',$data);
					
			}

			else
			{
				$date_begin		= formatDate(MysqlDateNow(),'year_month_only');
				$date_end		= formatDate(MysqlDateNow(),'year_month_only');

				$date_begin_qr		= $date_begin.'-01';
				$date_end_qr		= $date_end.'-31';

				$this->load->library('pagination');
				$offset = $this->uri->segment(7);
				$config['base_url'] = site_url().'/backend/rep_jemaat/custom/filter/'.$date_begin.'/'.$date_end.'/';
				$config['total_rows'] = count($this->Abskeb_model->GetRepKebJmt('custom',FALSE,FALSE,FALSE,FALSE,FALSE,$date_begin_qr,$date_end_qr));
				$config['per_page'] = $this->config->item('per_page');
				$config['uri_segment'] = '7';
					
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
					
				$data['urut'] = $this->uri->segment(7);
				$data['heading'] = 'Report Jemaat';
				$data['title'] = $data['heading'].' - Per '.formatDate(MysqlDateNow(),'year_month_only_long').' s/d '.formatDate(MysqlDateNow(),'year_month_only_long');
				$data['template'] = 'rep_jemaat/custom';
				$data['tab'] = 'custom';

				// FORM VARIABLE
				$data['form_id'] 		= 'cari_custom';
				$data['form_dst'] 		= 'cari_custom';
				$data['onclick_cari'] 	= 'CariCustom';
				$data['onclick_back'] 	= 'BackCustom';
				$data['form_dst'] 		= 'cari_custom';
				$data['key_nama'] 		= "";
				$data['filter']			= 'filter_custom';
				$data['date_time_begin']		= $date_begin_qr;
				$data['date_time_end']			= $date_end_qr;
					// END OF FORM VARIABLE
				$data['res'] = $this->Abskeb_model->GetRepKebJmt('custom',$config['per_page'],$offset,FALSE,FALSE,FALSE,$date_begin_qr,$date_end_qr);
				$this->pagination->initialize($config);
				$this->load->view('backend/index',$data);
			}
				
		}
		else
		{
			$this->load->library('pagination');
			$offset = $this->uri->segment(7);
					
			$date_begin 	= $this->input->post('filter_dt_begin_y').'-'.$this->input->post('filter_dt_begin_m');
			$date_end		= $this->input->post('filter_dt_end_y').'-'.$this->input->post('filter_dt_end_m');

			$date_begin_qr		= $date_begin.'-01';
			$date_end_qr		= $date_end.'-31';


			$data['urut'] = $this->uri->segment(7);
			$data['heading'] = 'Report Jemaat';
			$data['title'] = $data['heading'].' - Per '.formatDate($date_begin_qr.' 00:00:00','year_month_only_long').' s/d '.formatDate($date_end_qr.' 00:00:00','year_month_only_long') .' Keywords : '.$this->input->post('key_nama');
			$data['template'] = 'rep_jemaat/custom';
			$data['tab'] = 'custom';

			$config['per_page'] 		= $this->config->item('per_page');

				// FORM VARIABLE
			$data['form_id'] 		= 'cari_custom';
			$data['form_dst'] 		= 'cari_custom';
			$data['onclick_cari'] 	= 'CariCustom';
			$data['onclick_back'] 	= 'BackCustom';
			$data['form_dst'] 		= 'cari_custom';
			$data['key_nama'] 		= $this->input->post('key_nama');
			$data['filter']			= 'filter_perbulan';
			$data['filter']			= 'filter_custom';
			$data['date_time_begin']		= $date_begin_qr;
			$data['date_time_end']			= $date_end_qr;
					// END OF FORM VARIABLE
			$data['res'] = $this->Abskeb_model->GetRepKebJmt('custom_nama',$config['per_page'],$offset,FALSE,FALSE,$this->input->post('key_nama'),$date_begin_qr,$date_end_qr);
			$this->pagination->initialize($config);
			$this->load->view('backend/index',$data);
		}

	}

	function detail()
	{
		$this->load->library('pagination');
		$jmt_id = $this->uri->segment(4);
		$offset = $this->uri->segment(7);

		if($this->input->post('filter_dt_begin_y') || $this->input->post('filter_dt_end_y'))
		{
			$date_begin 	= $this->input->post('filter_dt_begin_y').'-'.$this->input->post('filter_dt_begin_m');
			$date_end		= $this->input->post('filter_dt_end_y').'-'.$this->input->post('filter_dt_end_m');
		}
		else
		{
			if($this->uri->segment(5) || $this->uri->segment(6) )
			{
				$date_begin 	= $this->uri->segment(5);
				$date_end		= $this->uri->segment(6);
			}
			else
			{
				$date_begin = formatDate(MysqlDateNow(),'year_only').'-01';
				$date_end = formatDate(MysqlDateNow(),'year_only').'-12';
			}
			
		}
		

		$date_begin_qr		= $date_begin.'-01';
		$date_end_qr		= $date_end.'-31';

		$data['urut'] = $this->uri->segment(7);
		$config['base_url'] = site_url().'/backend/rep_jemaat/detail/'.$jmt_id.'/'.$date_begin.'/'.$date_end.'/';
		$config['total_rows'] = count($this->Abskeb_model->GetRepKebByJmtId($jmt_id,FALSE,FALSE,$date_begin_qr,$date_end_qr));
		$config['per_page'] = $this->config->item('per_page');
		$config['uri_segment'] = '7';
					
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

		$data['heading'] = 'Report Jemaat Detail';
		$jmt_nama = getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$jmt_id);
		$data['title'] = $data['heading'].' - '.$jmt_nama;
		$data['template'] = 'rep_jemaat/detail';
		$data['date_time_begin']		= $date_begin_qr;
		$data['date_time_end']			= $date_end_qr;
		$data['total_hadir']			= $config['total_rows'];
		// END OF FORM VARIABLE
		$data['row_jmt'] = $this->Jemaat_model->getJemaat(FALSE,$jmt_id,FALSE,FALSE);
		$data['res_keb'] = $this->Abskeb_model->GetRepKebByJmtId($jmt_id,$config['per_page'],$offset,$date_begin_qr,$date_end_qr);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);

	}


	function cetak_all()
	{
		
		$data['arr_jmt'] = $this->Jemaat_model->getJemaat('all',FALSE,FALSE,FALSE);

		
		
		set_time_limit(200);
		ini_set('memory_limit', '2048M');
		ob_start();
		$this->load->view('backend/report_page/jemaat/cetak_all',$data);// buffer html ke view nya
		$content = ob_get_clean();
			
			// pdf starting..........
		try{
			$html2pdf = new HTML2PDF('L','A4','fr', false, 'ISO-8859-15',array(10,15,10,15)); //setting ukuran
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
			$html2pdf->Output('DATA_JEMAAT.pdf');
		}
		catch(HTML2PDF_exception $e) {
			echo $e;
			exit;
		}

		


		/*
		$this->fpdf->FPDF("L","cm","A4");

		$this->fpdf->SetMargins(1,1,1);

		
		$this->fpdf->AliasNbPages();
		//$this->fpdf->SetAutoPageBreak(FALSE,10);


		$this->fpdf->AddPage();

		$this->fpdf->SetFont('helvetica','B',12);



		$this->fpdf->Cell(30,0.7,'Daftar Jemaat GKI Bungur',0,0,'C');
		$this->fpdf->Ln();
		$this->fpdf->Cell(30,0.7,'Tahun : ',0,0,'C');

		$this->fpdf->Ln();

		$string = "We need to use the code two times, one time for finding the appropriate height and for creating table using the found height another time for creating table using the found height";


		$this->fpdf->Ln();

		$this->fpdf->Ln(1);

		$this->fpdf->SetFont('helvetica','',8);
		$this->WordWrap($string,10);
		//$this->fpdf->Write(0.5,"This paragraph has $nb lines:\n\n");
		$this->fpdf->Write(0.5,$string);



		$this->fpdf->Ln(1);
		$this->fpdf->SetFont('helvetica','B',8);
		$this->fpdf->Cell(1 , 0.7, 'No' , 1, 'LR', 'L');
		$this->fpdf->Write(0.5,$string);
		$this->fpdf->Cell(2 , 0.7, 'No Induk' , 1, 'LR', 'L');
		$this->fpdf->Cell(6 , 0.7, 'Nama' , 1, 'LR', 'L');
		$this->fpdf->Cell(2 , 0.7, 'Pria/Wanita' , 1, 'LR', 'L');
		$this->fpdf->Cell(3 , 0.7, 'Tgl. Lahir' , 1, 'LR', 'L');
		$this->fpdf->Cell(8 , 0.7, 'Alamat' , 1, 'LR', 'L');
		$this->fpdf->Cell(5 , 0.7, 'Telp/HP' , 1, 'LR', 'L');
		$i = 1;


		foreach($data['arr_jmt'] as $row)
		{
			$this->fpdf->Ln();
			$this->fpdf->SetFont('helvetica','',8);
			$this->fpdf->Cell(1 , 0.5, $i, 1, 'LR', 'L');
			$this->fpdf->Cell(2 , 0.5, $row['m_jmt_no_induk'], 1, 'LR', 'L');
			$this->fpdf->Cell(6 , 0.5, $row['m_jmt_nama'] , 1, 'LR', 'L');
			$this->fpdf->Cell(2 , 0.5, $row['m_jmt_jenkel'], 1, 'LR', 'L');
			$this->fpdf->Cell(3 , 0.5, $row['m_jmt_tgl_lhr'], 1, 'LR', 'L');
			$this->fpdf->Cell(8 , 0.5, $string , 1, 'LR', 'L');
			$this->fpdf->Cell(5 , 0.5, WordWrap($row['m_jmt_telp_1'].'/'.$row['m_jmt_hp_1']) , 1, 'LR', 'L');
			$i++;
		}

		$this->fpdf->SetY(-3);

		$this->fpdf->SetFont('helvetica','',6);

		$halaman = $this->fpdf->PageNo();
		$halaman1 = $halaman + 1;
		$this->fpdf->Cell(0,4,"Halaman $halaman dari {nb}",0,1,'R');

		$this->fpdf->Output("DATA_JEMAAT.pdf","I");
		*/

		
	}

	function WordWrap(&$text, $maxwidth)
	{
	    $text = trim($text);
	    if ($text==='')
	        return 0;
	    $space = $this->fpdf->GetStringWidth(' ');
	    $lines = explode("\n", $text);
	    $text = '';
	    $count = 0;

	    foreach ($lines as $line)
	    {
	        $words = preg_split('/ +/', $line);
	        $width = 0;

	        foreach ($words as $word)
	        {
	            $wordwidth = $this->fpdf->GetStringWidth($word);
	            if ($wordwidth > $maxwidth)
	            {
	                // Word is too long, we cut it
	                for($i=0; $i<strlen($word); $i++)
	                {
	                    $wordwidth = $this->fpdf->GetStringWidth(substr($word, $i, 1));
	                    if($width + $wordwidth <= $maxwidth)
	                    {
	                        $width += $wordwidth;
	                        $text .= substr($word, $i, 1);
	                    }
	                    else
	                    {
	                        $width = $wordwidth;
	                        $text = rtrim($text)."\n".substr($word, $i, 1);
	                        $count++;
	                    }
	                }
	            }
	            elseif($width + $wordwidth <= $maxwidth)
	            {
	                $width += $wordwidth + $space;
	                $text .= $word.' ';
	            }
	            else
	            {
	                $width = $wordwidth + $space;
	                $text = rtrim($text)."\n".$word.' ';
	                $count++;
	            }
	        }
	        $text = rtrim($text)."\n";
	        $count++;
	    }
	    $text = rtrim($text);
	    return $count;
	}
	
}