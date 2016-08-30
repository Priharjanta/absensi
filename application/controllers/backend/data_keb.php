<?php

class Data_keb extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Datakeb_model');
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
		$config['base_url'] = site_url().'/backend/data_keb/index';
		$config['total_rows'] = count($this->Datakeb_model->getDatakeb('all',FALSE,FALSE,FALSE));
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
		$data['heading'] = 'Data Kebaktian';
		$data['title'] = $data['heading'].' - Kebaktian';
		$data['template'] = 'data_keb/index';
		$data['res'] = $this->Datakeb_model->getDatakeb('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
	}

	function add()
	{

		$this->form_validation->set_rules('keb_tgl_y', 'Tanggal Kebaktian (thn)','required');
		$this->form_validation->set_rules('keb_tgl_m', 'Tanggal Kebaktian (bln)','required');
		$this->form_validation->set_rules('keb_tgl_d', 'Tanggal Kebaktian (hr)','required');
		$this->form_validation->set_rules('keb_m_ib_id', 'Nama Ibadah','required');
		$this->form_validation->set_rules('keb_tema', 'Tema','required');
		$this->form_validation->set_rules('keb_pengkotbah', 'Pengkotbah','required');

		
		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] 	= 'Data Kebaktian';
			$data['title'] 		= $data['heading'].' - Kebaktian';
			$data['template'] 	= 'data_keb/add';
			$this->load->view('backend/index',$data);
		}
		else
		{
			$keb_tgl = $this->input->post('keb_tgl_y').'-'.$this->input->post('keb_tgl_m').'-'.$this->input->post('keb_tgl_d');
			$data = array
				(
					'keb_m_ib_id'		=>$this->input->post('keb_m_ib_id'),
					'keb_tgl'			=>$keb_tgl,
					'keb_tema'			=>$this->input->post('keb_tema'),
					'keb_pengkotbah'	=>$this->input->post('keb_pengkotbah'),
					'keb_liturgos'		=>$this->input->post('keb_liturgos'),
					'keb_majelis'		=>$this->input->post('keb_majelis'),
					'keb_pianis'		=>$this->input->post('keb_pianis'),
					'keb_organis'		=>$this->input->post('keb_organis'),
					'keb_tim_musik'		=>$this->input->post('keb_tim_musik'),
					'keb_pmdu_nyanyian'	=>$this->input->post('keb_pmdu_nyanyian'),
					'keb_nanyian'		=>$this->input->post('keb_nanyian'),
					'keb_ayat'			=>$this->input->post('keb_ayat'),
					'keb_persembahan'	=>$this->input->post('keb_persembahan'),
					'keb_mulmed_lcd'	=>$this->input->post('keb_mulmed_lcd'),
					'keb_penyambut'		=>$this->input->post('keb_penyambut'),
					'keb_kolektan'		=>$this->input->post('keb_kolektan'),
					'keb_ket'			=>$this->input->post('keb_ket'),
					'keb_aktif'			=>$this->input->post('keb_aktif')
				);
			$this->Datakeb_model->addDataKeb($data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data Kebaktian berhasil ditambahkan</div>');
			redirect('backend/data_keb');
		}	
	}

	function edit()
	{
		$this->form_validation->set_rules('keb_tgl_y', 'Tanggal Kebaktian (thn)','required');
		$this->form_validation->set_rules('keb_tgl_m', 'Tanggal Kebaktian (bln)','required');
		$this->form_validation->set_rules('keb_tgl_d', 'Tanggal Kebaktian (hr)','required');
		$this->form_validation->set_rules('keb_m_ib_id', 'Nama Ibadah','required');
		$this->form_validation->set_rules('keb_tema', 'Tema','required');
		$this->form_validation->set_rules('keb_pengkotbah', 'Pengkotbah','required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['heading'] = 'Data Kebaktian';
			$id = $this->uri->segment(4);
			$data['title'] = $data['heading'].' - Kebaktian';
			$data['template'] = 'data_keb/edit';
			$data['row'] = $this->Datakeb_model->getDatakeb(FALSE,$id,FALSE,FALSE);
			$this->load->view('backend/index',$data);
		}
		else
		{
			$keb_tgl = $this->input->post('keb_tgl_y').'-'.$this->input->post('keb_tgl_m').'-'.$this->input->post('keb_tgl_d');
			$data = array
				(
					'keb_m_ib_id'		=>$this->input->post('keb_m_ib_id'),
					'keb_tgl'			=>$keb_tgl,
					'keb_tema'			=>$this->input->post('keb_tema'),
					'keb_pengkotbah'	=>$this->input->post('keb_pengkotbah'),
					'keb_liturgos'		=>$this->input->post('keb_liturgos'),
					'keb_majelis'		=>$this->input->post('keb_majelis'),
					'keb_pianis'		=>$this->input->post('keb_pianis'),
					'keb_organis'		=>$this->input->post('keb_organis'),
					'keb_tim_musik'		=>$this->input->post('keb_tim_musik'),
					'keb_pmdu_nyanyian'	=>$this->input->post('keb_pmdu_nyanyian'),
					'keb_nanyian'		=>$this->input->post('keb_nanyian'),
					'keb_ayat'			=>$this->input->post('keb_ayat'),
					'keb_persembahan'	=>$this->input->post('keb_persembahan'),
					'keb_mulmed_lcd'	=>$this->input->post('keb_mulmed_lcd'),
					'keb_penyambut'		=>$this->input->post('keb_penyambut'),
					'keb_kolektan'		=>$this->input->post('keb_kolektan'),
					'keb_ket'			=>$this->input->post('keb_ket'),
					'keb_aktif'			=>$this->input->post('keb_aktif'),
					'keb_count_l'		=>$this->input->post('keb_count_l'),
					'keb_count_p'		=>$this->input->post('keb_count_p')
				);
			$id = $this->uri->segment(4);
			$this->Datakeb_model->editDatakeb($id,$data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil diupdate</div>');
			redirect('backend/data_keb/edit/'.$id);
		}
			
	}

	function delete($id)
	{
		$id = $this->uri->segment(4);
		$uri = $this->uri->segment(5);
		$this->Datakeb_model->deleteDatakeb($id);
		$count = count($this->Datakeb_model->getDatakeb('all',FALSE,FALSE,FALSE));
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil dihapus</div>');
		//getPage('bank','delete',$uri,$count);
		redirect('backend/data_keb');
	}
	
}