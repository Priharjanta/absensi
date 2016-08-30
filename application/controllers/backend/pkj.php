<?php

class Pkj extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('Pkj_model');
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
		$config['base_url'] = site_url().'/backend/pkj/index';
		$config['total_rows'] = count($this->Pkj_model->getPkj('all',FALSE,FALSE,FALSE));
		$config['per_page'] = $this->config->item('per_page');
		$config['uri_segment'] = '4';
		
		$data['urut'] = $this->uri->segment(4);
		$data['heading'] = 'Pelayanan';
		$data['title'] = $data['heading'].' - Perkunjungan';
		$data['template'] = 'pkj/index';
		$data['res'] = $this->Pkj_model->getPkj('all',FALSE,$config['per_page'],$offset);
		$this->pagination->initialize($config);
		$this->load->view('backend/index',$data);
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

	function add()
	{
		$this->form_validation->set_rules('pkj_tgl_y', 'Tanggal (thn)','required');
		$this->form_validation->set_rules('pkj_tgl_m', 'Tanggal (bln)','required');
		$this->form_validation->set_rules('pkj_tgl_d', 'Tanggal (hr)','required');
		$this->form_validation->set_rules('pkj_m_jmt_id', 'Nama Jemaat','required');
		$this->form_validation->set_rules('pkj_pic', 'PIC', 'required');
		$this->form_validation->set_rules('pkj_status', 'Status', 'required');
		
		if ($this->form_validation->run() == FALSE):
			if($this->input->post('pkj_tim') || $this->input->post('pkj_m_jmt_id'))
			{
				$data['pkj_tim'] 		= $this->input->post('pkj_tim');
				$data['jmt_nama'] 		= getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$this->input->post('pkj_m_jmt_id'));
				$data['pkj_m_jmt_id']	= $this->input->post('pkj_m_jmt_id');
			}
			else
			{
				$data['pkj_tim'] 	 = "";
				$data['jmt_nama'] 	 = "";
				$data['pkj_m_jmt_id']= "";

			}
			$data['heading'] = 'Pelayanan';
			$data['title'] = $data['heading'].' - Perkunjungan - Tambah';
			$data['template'] = 'pkj/add';
			$this->load->view('backend/index',$data);
		else:
			$est_date = $this->input->post('pkj_tgl_y').'-'.$this->input->post('pkj_tgl_m').'-'.$this->input->post('pkj_tgl_d');
			$data = array('pkj_est_date'=>$est_date,
						  'pkj_m_jmt_id'=>$this->input->post('pkj_m_jmt_id'),
						  'pkj_status'=>$this->input->post('pkj_status'),
						  'pkj_tim'=>$this->input->post('pkj_tim'),
						  'pkj_pic'=>$this->input->post('pkj_pic'),
						  'pkj_created'=>mysqlDateNow()
						  );
			$this->Pkj_model->addPkj($data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data perkunjungan berhasil ditambahkan</div>');
			redirect('backend/pkj');
		endif;
	}

	function edit()
	{
		$this->form_validation->set_rules('pkj_tgl_y', 'Tanggal (thn)','required');
		$this->form_validation->set_rules('pkj_tgl_m', 'Tanggal (bln)','required');
		$this->form_validation->set_rules('pkj_tgl_d', 'Tanggal (hr)','required');
		$this->form_validation->set_rules('pkj_m_jmt_id', 'Nama Jemaat','required');
		$this->form_validation->set_rules('pkj_pic', 'PIC', 'required');
		$this->form_validation->set_rules('pkj_status', 'Status', 'required');
		
		if ($this->form_validation->run() == FALSE):
			if($this->input->post('pkj_tim') || $this->input->post('pkj_m_jmt_id'))
			{
				$data['pkj_tim'] 		= $this->input->post('pkj_tim');
				$data['jmt_nama'] 		= getDataTableById('tb_m_jemaat','m_jmt_nama','m_jmt_id',$this->input->post('pkj_m_jmt_id'));
				$data['pkj_m_jmt_id']	= $this->input->post('pkj_m_jmt_id');
			}
			else
			{
				$data['pkj_tim'] 	 = "";
				$data['jmt_nama'] 	 = "";
				$data['pkj_m_jmt_id']= "";

			}
			$id = $this->uri->segment(4);
			$data['row']		= $this->Pkj_model->getPkj(FALSE,$id,FALSE,FALSE);
			$data['heading'] 	= 'Pelayanan';
			$data['title'] 		= $data['heading'].' - Perkunjungan - Edit';
			$data['template'] 	= 'pkj/edit';
			$this->load->view('backend/index',$data);
		else:
			$id = $this->uri->segment(4);
			$est_date = $this->input->post('pkj_tgl_y').'-'.$this->input->post('pkj_tgl_m').'-'.$this->input->post('pkj_tgl_d');
			$data = array('pkj_est_date'=>$est_date,
						  'pkj_m_jmt_id'=>$this->input->post('pkj_m_jmt_id'),
						  'pkj_status'=>$this->input->post('pkj_status'),
						  'pkj_tim'=>$this->input->post('pkj_tim'),
						  'pkj_pic'=>$this->input->post('pkj_pic'),
						  'pkj_created'=>mysqlDateNow()
						  );
			$this->Pkj_model->editPkj($id,$data);
			$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data perkunjungan berhasil diupdate</div>');
			redirect('backend/pkj');
		endif;
	}
	
	function delete()
	{
		$id = $this->uri->segment(4);
		$uri = $this->uri->segment(5);
		$this->User_model->deleteUser($id);
		$count = count($this->User_model->getUser('all',FALSE,FALSE,FALSE));
		$this->session->set_flashdata('message_type','<div id="alert_box" class="alert alert-success">Data berhasil dihapus</div>');
		getPage('user','delete',$uri,$count);
	}	
}

/* End of file user.php */
/* Location: ./system/application/controllers/backend/user.php */
