<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_auth', 'm');
	}

	public function index() {
		$this->adminlte->is_logged_in('login');
		$this->load->view('login');
	}

	public function login_action() {
		$auth = $this->m->auth();
		if ($auth) {
			redirect('dashboard','refresh');
		} else {
			redirect('login','refresh');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('login','refresh');
	}

}

/* End of file Auth.php */
/* Location: ./application/modules/auth/controllers/Auth.php */