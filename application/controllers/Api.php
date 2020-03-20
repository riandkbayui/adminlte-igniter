<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function indexn() {
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

	public function push() {
		$data = array(
		    'name' => 'ini nama',
			'title' => 'Judul Api',
			'url' => 'https://demo-pakankucing.sanscoding.com',
			'icon' => 'https://demo-pakankucing.sanscoding.com/assets/dist/img/avatar5.png',
			'message' => 'ini pesan a'
		);
		 
		$payload = json_encode($data);
		 
		// Prepare new cURL resource
		$ch = curl_init('https://api.foxpush.com/v1/campaigns/create/');
		// $ch = curl_init('adminlte/api/receive');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		 
		// Set HTTP Header for POST request 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    // 'Content-Type: application/json',
		    // 'Content-Length: ' . '300',
			'FOXPUSH_DOMAIN: demo-pakankucing.sanscoding.com',
			'FOXPUSH_TOKEN: grQ4Gp1fFnciFsCHnosZlQ',
		));
		 
		// Submit the POST request
		$result = curl_exec($ch);
		 
		// Close cURL session handle
		curl_close($ch);

		header('Content-Type: application/json');
		print_r($result);
		print_r($data);
	}

	public function receive() {
		print_r($_POST);
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */