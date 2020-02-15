<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function auth() {
		$u = $this->input->post('user_mail');
		$p = $this->input->post('password');
		$set_session = array();
		$where_string = sprintf("(user_username = '%s' or user_email = '%s') and user_password = '%s'", $u, $u, md5($p));
		$row = $this->db->where($where_string)->get('_user');
		if ($row->num_rows()) {
			$set_session = [
				"login" => true,
				"user_id" => $row->row('user_id'),
			];
		} else {
			$set_session = [
				"login" => false,
			];
			$this->session->set_flashdata('fail', true);
		}

		$this->session->set_userdata( $set_session );
		return $set_session['login'];
	}
	

}

/* End of file M_auth.php */
/* Location: ./application/modules/auth/models/M_auth.php */