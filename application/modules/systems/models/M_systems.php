<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_systems extends CI_Model {
	
	public function group_save() {
		$id = $this->input->post('group_id');
		if (isset($id)) {
			$this->db->set(['group_label'=>$_POST['group_label']]);
			$this->db->where('group_id', $id);
			$this->db->update('_group');
		} else {
			$this->db->set(['group_label'=>$_POST['group_label']]);
			$this->db->insert('_group');
			$id = $this->db->insert_id();
		}
		$this->sidebar_access_save($id);
		return $this->db->affected_rows();
	}

	private function sidebar_access_save($group_id) {
		$sidebar_id = $_POST['sidebar_id'];
		$this->db->where('group_id', $group_id)->delete('_sidebar_access');
		foreach ($sidebar_id as $key => $id) {

			$create     = @$_POST['create'][$id] ?: '0';
			$read       = @$_POST['read'][$id] ?: '0';
			$update     = @$_POST['update'][$id] ?: '0';
			$delete     = @$_POST['delete'][$id] ?: '0';

			$set = [
				"group_id" => $group_id,
				"sidebar_id" => $id,
				"create" => $create,
				"read" => $read,
				"update" => $update,
				"delete" => $delete,
			];
			$this->db->set($set)->insert('_sidebar_access');
		}
	}

	public function group_delete() {
		$id = $this->input->post('group_id');
		$this->db->where('group_id', $id);
		$this->db->delete('_group');
		return $this->db->affected_rows();
	}

	public function group_get($is_array = FALSE) {
		$id = $this->input->get('id');
		if (isset($id)) {
			$this->db->where('group_id', $id);
			return $is_array ? $this->db->get('_group')->row_array() : $this->db->get('_group')->row();
		} else {
			$this->db->get('_group');
			return $is_array ? $this->db->get('_group')->result_array() : $this->db->get('_group')->result();
		}
	}

	public function user_save() {
		$id = $this->input->post('user_id');
		$_POST['user_birth_date'] = date_id_to_mysql($_POST['user_birth_date']);
		if ($this->input->post('user_password')) $_POST['user_password'] = md5($_POST['user_password']);
		if (isset($id)) {
			$this->db->set($_POST);
			$this->db->where('user_id', $id);
			$this->db->update('_user');
		} else {
			$this->db->set($_POST);
			$this->db->insert('_user');
		}
		return $this->db->affected_rows();
	}

	public function user_delete() {
		$id = $this->input->get('id');
		$this->db->where('user_id', $id);
		$this->db->delete('_user');
		return $this->db->affected_rows();
	}

	public function sidebar_save() {
		$id = $this->input->post('sidebar_id');
		if (isset($id)) {
			$this->db->set($_POST);
			$this->db->where('sidebar_id', $id);
			$this->db->update('_sidebar');
		} else {
			$this->db->set($_POST);
			$this->db->insert('_sidebar');
		}
		return $this->db->affected_rows();
	}

	public function sidebar_delete() {
		$id = $this->input->get('id');
		$this->db->where('sidebar_id', $id);
		$this->db->delete('_sidebar');
		return $this->db->affected_rows();
	}

}

/* End of file M_systems.php */
/* Location: ./application/modules/systems/models/M_systems.php */