<?php

class No_access extends Controller {

	function __construct()
	{
		parent::Controller();
	}

	function index()
	{
		$data['title'] = 'No access';
		$this->load->view('backend/no_access',$data);
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/backend/user.php */
