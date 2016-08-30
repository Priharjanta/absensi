<?php
class Dashboard extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
		if(!$this->session->userdata('user_id') && !$this->session->userdata('user_display_name') ):
			redirect('backend');
		elseif($this->session->userdata('user_rule')=='Frontend'):
			redirect('backend/no_access');
		endif;
	}

	function index()
	{
		if($this->session->userdata('user_id')):
			$data['title'] = 'Dashboard';
			$data['template'] = 'dashboard';
			$this->load->view('backend/index',$data);
		else:
			$data['title'] = 'Login';
			$this->load->view('login',$data);
		endif;

	}

	function doLogout(){
		
		
		
		$this->session->unset_userdata('user_display_name');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_rule');

		redirect('login');
	}

	function doLogin()
	{
		$this->form_validation->set_rules('user_login', 'Username', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE):
			$data['title'] = 'Login';
			$this->load->view('backend/login',$data);
		else:
			$username = $this->input->post('user_login');
			$password = md5($this->input->post('user_password'));
			$this->db->where('user_login',$username);
			$this->db->where('user_password',$password);
			$res = $this->db->get('tb_user')->result();

			if (count($res) > 0):
				$this->session->set_userdata('user_id',$res[0]->user_id );
				$this->session->set_userdata('user_display_name',$res[0]->user_login);
				$this->session->set_userdata('user_rule',$res[0]->user_rule);
				redirect('backend/data_keb');
			else:
				redirect('backend');
			endif;
		endif;
	}
}
?>