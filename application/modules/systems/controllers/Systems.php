<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Systems extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->adminlte->is_logged_in();
		$this->load->model('m_systems', 'm');
	}

	public function index() {
		echo "Hello World! :)";
	}

	public function sess() {
		header('Content-Type: application/json');
		print_r($this->session->all_userdata());
	}

	public function sb() {
		$this->adminlte->sidebar_id_set('6');
		$str = $this->adminlte->sidebar_active_label_list();
		$id = $this->adminlte->sidebar_active_id_list();
		header('Content-Type: application/json');
		print_r($str);
		print_r($id);
	}

	public function me() {
		$this->adminlte->view('me');
	}

	public function me_save() {
		$this->m->user_save();
		redirect('dashboard','refresh');
	}

	public function grup() {
		$this->adminlte->sidebar_id_set('2');
		$this->adminlte->view('grup_index');
	}

	public function group_save() {
		$this->adminlte->sidebar_id_set('2');
		$this->m->group_save();
		redirect('systems/grup','refresh');
	}

	public function group_table_fetch() {
		$this->adminlte->sidebar_id_set('2');

		$config_edit = [
			'label' => 'Edit',
			'icon' => 'fa fa-edit',
			'type' => 'link',
			'href' => base_url('systems/group_form?id=$1'),
			'security' => true,
			'crud' => 'update',
		];
		$config_hapus = [
			'label' => 'Hapus',
			'icon' => 'fa fa-trash',
			'type' => 'button',
			'attribute'=>"data-toggle='modal' data-title='Hapus' data-url='".base_url('systems/group_modal/grup_hapus?id=$1')."'",
			'onclick' => 'remove(this)',
			'security' => true,
			'crud' => 'delete',
		];
		$action = $this->adminlte->button_create($config_edit, TRUE).' '.$this->adminlte->button_create($config_hapus, TRUE);
		$this->datatables->add_column('action', $action, 'group_id');
		echo $this->datatables->generate_json('_group');
	}

	public function group_form() {
		$this->adminlte->sidebar_id_set('2');
		$this->adminlte->view('grup_form');
	}

	public function group_delete() {
		$this->adminlte->sidebar_id_set('2');
		echo $this->m->group_delete();
	}

	public function user() {
		$this->adminlte->sidebar_id_set('3');
		$this->adminlte->view('user_index');
	}

	public function user_form() {
		$this->adminlte->sidebar_id_set('3');
		$this->adminlte->view('user_form');
	}

	public function user_table_fetch() {
		$this->adminlte->sidebar_id_set('3');
		$config_edit = [
			'label' => 'Edit',
			'icon' => 'fa fa-edit',
			'type' => 'link',
			'href' => base_url('systems/user_form?id=$1'),
			'security' => true,
			'crud' => 'update',
		];
		$config_hapus = [
			'label' => 'Hapus',
			'icon' => 'fa fa-trash',
			'type' => 'button',
			'attribute'=>"data-toggle='modal' data-title='Hapus' data-url='".base_url('systems/user_delete?id=$1')."'",
			'onclick' => 'remove(this)',
			'security' => true,
			'crud' => 'delete',
		];
		$action = $this->adminlte->button_create($config_edit, TRUE).' '.$this->adminlte->button_create($config_hapus, TRUE);
		$this->datatables->add_column('action', $action, 'user_id');
		$this->datatables->edit_column('status_id', $this->status('$1'), 'status_id');
		echo $this->datatables->generate_json('_user');
	}

	public function status($st) {
		if ($st) {
			return form_label('Aktif', '', []);
		} else {
			return form_label('Tidak Aktif', '', []);
		}
	}

	public function user_save() {
		$this->adminlte->sidebar_id_set('3');
		$this->m->user_save();
		redirect('systems/user','refresh');
	}

	public function user_delete() {
		$this->adminlte->sidebar_id_set('3');
		$this->m->user_delete();
	}

	public function sidebar() {
		$this->adminlte->sidebar_id_set('4');
		$this->adminlte->view('sidebar_index');
	}

	public function sidebar_modal($modal) {
		$this->adminlte->sidebar_id_set('4');
		$this->load->view($modal, NULL, FALSE);
	}

	public function sidebar_table_fetch() {
		$this->adminlte->sidebar_id_set('4');
		$config_edit = [
			'label' => 'Edit',
			'icon' => 'fa fa-edit',
			'type' => 'button',
			'attribute'=>"data-toggle='modal' data-title='Ubah' data-url='".base_url('systems/sidebar_modal/sidebar_form?id=$1')."'",
			'onclick' => 'launch_modal(this)',
			'security' => true,
			'crud' => 'update',
		];
		$config_hapus = [
			'label' => 'Hapus',
			'icon' => 'fa fa-trash',
			'type' => 'button',
			'attribute'=>"data-toggle='modal' data-title='Hapus' data-url='".base_url('systems/sidebar_delete?id=$1')."'",
			'onclick' => 'remove(this)',
			'security' => true,
			'crud' => 'delete',
		];
		$action = $this->adminlte->button_create($config_edit, TRUE).' '.$this->adminlte->button_create($config_hapus, TRUE);
		$this->datatables->add_column('action', $action, 'sidebar_id');
		$this->datatables->edit_column('sidebar_icon', '<i class="$1"></i>', 'sidebar_icon');
		echo $this->datatables->generate_json('_v_sidebar');
	}

	public function sidebar_index() {
		$this->adminlte->sidebar_id_set('4');
		$db = $this->db->where('sidebar_parent', $_GET['sidebar_parent'])->get('_v_sidebar')->num_rows();
		echo $db+1;
	}

	public function sidebar_save() {
		$this->adminlte->sidebar_id_set('4');
		echo $this->m->sidebar_save();
	}

	public function sidebar_delete() {
		$this->adminlte->sidebar_id_set('4');
		echo $this->m->sidebar_delete();
	}

	public function pengaturan() {
		$this->adminlte->sidebar_id_set('6');
		$set = $this->db->get('_setting')->row_array();
		$this->adminlte->view('pengaturan_index', $set);
	}

	public function pengaturan_save() {
		$this->db->set($_POST)->update('_setting');
		redirect('systems/pengaturan','refresh');
	}
}

/* End of file systems.php */
/* Location: ./application/modules/systems/controllers/systems.php */