<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->adminlte->is_logged_in();
	}

	public function index() {
		$this->adminlte->sidebar_id_set('1');
		$this->adminlte->view('welcome_message');
	}
}
