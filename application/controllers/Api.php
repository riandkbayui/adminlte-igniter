<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index() {
		$query = 'select satu, dua, tiga from _sidebar';
		$mid_string =  $this->get_string_between($query, 'select', 'from');
		// $this->db->db_debug = FALSE;
		// $result = $this->db->query(urldecode($query));
		// if ($result) {
		// 	$res = $result->row();
		// 	$res = json_decode(json_encode($res), TRUE);
		// 	echo "<pre>";
		// 	print_r (implode(', ', array_keys($res)));
		// 	echo "</pre>";
		// } else {
		// 	echo "<pre>";
		// 	print_r ($this->db->error());
		// 	echo "</pre>";
		// }
	}

	function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */