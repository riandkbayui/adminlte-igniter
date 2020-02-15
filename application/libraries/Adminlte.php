<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminlte {

	private $ci;
	private $button_set;
	private $javascript = [];
	private $css = [];
	private $sidebar_id;
	private $sidebar_menu_id;
	private $group_id;

	public function __construct() {
		$this->ci =& get_instance();
	}

	public function is_logged_in($page='controller') {
		$login = $this->ci->session->userdata('login');

		switch ($page) {
			case 'controller':
				if (!$login) {
					redirect('login','refresh');
				}
				break;
			
			default:
				if ($login) {
					redirect('dashboard','refresh');
				}
				break;
		}
	}

	public function sidebar_active_id_list() {
		$sidebar_id = $this->sidebar_id;
		$parent_child['child'] = $sidebar_id;
		$index = 0;
		while ($sidebar_id > 0) {
			$sidebar = $this->ci->db->where('sidebar_id', $sidebar_id)->get('_sidebar')->row();
			$sidebar_id = $sidebar->sidebar_parent;
			if (!$sidebar_id) break;
			$parent_child['parents'][$index] = $sidebar_id;
			$index++;
		}
		return $parent_child;
	}

	public function sidebar_active_label_list() {
		$selector = 'sidebar_';
		$sidebar_id = $this->sidebar_id;
		$sidebar_label = $this->ci->db->where('sidebar_id', $sidebar_id)->get('_sidebar')->row('sidebar_label');
		$parent_child['child'] = $selector.strtolower(str_replace(' ', '-', $sidebar_label));
		$index = 0;
		while ($sidebar_id > 0) {
			$sidebar = $this->ci->db->where('sidebar_id', $sidebar_id)->get('_sidebar')->row();
			$sidebar_id = $sidebar->sidebar_parent;
			$sidebar_label = $this->ci->db->where('sidebar_id', $sidebar_id)->get('_sidebar')->row('sidebar_label');
			if (!$sidebar_id) break;
			$parent_child['parents'][$index] = $selector.strtolower(str_replace(' ', '-', $sidebar_label));
			$index++;
		}
		return $parent_child;
	}

	public function sidebar_id_set($id) {
		$this->sidebar_id = $id;
		return $this;
	}

	public function sidebar_id_get() {
		return $this->sidebar_id;
	}

	public function sidebar_menu_id_set($id) {
		$this->sidebar_menu_id = $id;
		return $this;
	}

	public function sidebar_menu_id_get() {
		return $this->sidebar_menu_id;
	}

	public function is_readable_menu_pages($return = false) {
		$read = $this->ci->db->where('group_id', $this->userlogin('group_id'))->where('sidebar_id', $this->sidebar_menu_id)->get('_sidebar_access')->row('read');
		if ($return) {
			return $read;
		} else {
			redirect('error.html','refresh');
		}
	}

	public function is_readable_pages($return = false) {
		$read = $this->ci->db->where('group_id', $this->userlogin('group_id'))->where('sidebar_id', $this->sidebar_id)->get('_sidebar_access')->row('read');
		if ($return) {
			return $read;
		} else {
			redirect('error.html','refresh');
		}
	}

	public function userlogin($get='') {
		$user_id = $this->ci->session->userdata('user_id');
		$user = $this->ci->db->where('user_id', $user_id)->get('_v_user')->row($get);
		return $user;
	}

	public function websetting($get='') {
		$web = $this->ci->db->get('_setting')->row($get);
		return $web;
	}

	public function view($view = "", $data = array()) {
		$partials['javascript'] = $this->javascript;
		$partials['css'] = $this->css;
		$partials['navbar'] = $this->ci->load->view('_adminlte/navbar', NULL, TRUE);
		$partials['sidebar'] = $this->ci->load->view('_adminlte/sidebar', ['readable'=>$this->is_readable_pages(true), 'id_sidebar'=>$this->sidebar_id], TRUE);
		$partials['contents'] = $this->ci->load->view($view, $data, TRUE);
		$partials['footer'] = $this->ci->load->view('_adminlte/footer', NULL, TRUE);
		$this->ci->load->view('_adminlte/layout', $partials, FALSE);
	}

	public function javascript_add($var) {
		array_push($this->javascript, $var);
		return $this;
	}

	public function css_add($var) {
		array_push($this->css, $var);
		return $this;
	}

	public function button_create($set = array(), $return = false) {

		$btn =  [
					"type"           => "button",
					"class"          => "btn btn-default btn-sm",
					"icon"           => "",
					"label"          => "Button",
					"onclick"        => "",
					"id"			 => "",
					"href"           => base_url(),
					"attribute"      => "",
					"security"		 => FALSE,
					"crud"			 => "", /* create, read, update, delete */
					"sidebar_id"	 => $this->sidebar_id,
					"group_id"		 => $this->userlogin('group_id'),
				];

		if (is_array($set) && sizeof($set) > 0) $btn = array_replace($btn, $set);
		$btn = json_decode(json_encode($btn));


		if ($btn->security) {
			$is_granted = $this->ci->db->where('sidebar_id', $btn->sidebar_id)->where('group_id', $btn->group_id)->get('_sidebar_access')->row($btn->crud);
			if ($is_granted) {
				switch ($btn->type) {

					case 'link':
						if ($return) {
							return "<a id='$btn->id' href='$btn->href' $btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</a>";
						} else {
							echo "<a id='$btn->id' href='$btn->href' $btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</a>";
						}
						break;
					
					default:
						if ($return) {
							return "<button id='$btn->id' onclick='$btn->onclick'$btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</button>";
						} else {
							echo "<button id='$btn->id' onclick='$btn->onclick'$btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</button>";
						}
						break;
				}
			}
		} else {
			switch ($btn->type) {

				case 'link':
					if ($return) {
						return "<a id='$btn->id' href='$btn->href' $btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</a>";
					} else {
						echo "<a id='$btn->id' href='$btn->href' $btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</a>";
					}
					break;
				
				default:
					if ($return) {
						return "<button id='$btn->id' onclick='$btn->onclick'$btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</button>";
					} else {
						echo "<button id='$btn->id' onclick='$btn->onclick'$btn->attribute class='$btn->class'><i class='$btn->icon'></i> $btn->label</button>";
					}
					break;
			}
		}
	}

}