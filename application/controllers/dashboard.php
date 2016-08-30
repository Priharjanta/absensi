<?php
class Dashboard extends Controller {

function __construct()
	{
		parent::Controller();
		$this->load->helper('bantuan_helper');
		$this->load->model('User_model');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('login');
		endif;
	}

	function index()
	{

		$data['arr_keb'] = getKebByDate(formatDate(mysqlDateNow(),'date_only'));
		$data['arr_keg'] = getKegByDate(formatDate(mysqlDateNow(),'date_only'));
		$data['heading'] = 'Dashboard';
		$data['title'] = $data['heading'].' - Frontend';
		$data['template'] = 'dashboard';
		$this->load->view('index',$data);

	}


	function doLogout()
	{
		$this->session->unset_userdata('user_display_name');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_rule');

		redirect('login');
	}
}
?>