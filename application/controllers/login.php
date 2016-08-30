<?php
class Login extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->library('session');
	}

	function index()
	{
		if($this->session->userdata('user_id')):
			$data['title'] = 'Dashboard';
			$data['template'] = 'dashboard';
			$this->load->view('index',$data);
		else:
			$data['title'] = 'Login';
			$this->load->view('login',$data);
		endif;

	}

	function doLogout(){
		
		
		
		$this->session->unset_userdata('user_display_name');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_rule');

		redirect('backend');
	}

	function doLogin()
	{
		$this->form_validation->set_rules('user_login', 'Username', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE):
			$data['title'] = 'Login';
			$this->load->view('login',$data);
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
				if($res[0]->user_rule == 'Administrator'):
					redirect('backend/data_keb');
				else:
					redirect('dashboard');
				endif;
			else:
				redirect('backend');
			endif;
		endif;
	}
}
?>