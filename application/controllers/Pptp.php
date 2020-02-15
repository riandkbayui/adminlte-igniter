<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pptp extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		header('Content-Type: application/json');
		require_once(APPPATH . 'third_party/ultimatewebscrapper/web_browser.php');
		require_once(APPPATH . 'third_party/ultimatewebscrapper/tag_filter.php');
	}

	public function index() {
		$url = "https://www.vpnjantit.com/create-free-account.html?server=indo&type=PPTP&negara=Indonesia";
		$web = new WebBrowser(array("extractforms" => true));
		$result = $web->Process($url);
		$form = $result["forms"][0];
		$form->SetFormValue("user", "adminlte");
		$form->SetFormValue("pass", "1");
		$form_request = $form->GenerateFormRequest();
		$create = $web->Process($form_request["url"], $form_request["options"]);
		$contents = $create['body'];
		$DOM = new DOMDocument;
		libxml_use_internal_errors(true);
		$DOM->loadHTML($contents);
		$items = $DOM->getElementById('bdata')->getElementsByTagName('tr');
	}

	public function run() {
		$url = base_url('pptp/view');
		$web = new WebBrowser(array("extractforms" => true));
		$result = $web->Process($url);
		$start = stripos($result['body'], '<h5>Congratulation! Your PPTP Account successfully created!');
		$end = strripos($result['body'], 'Days</h5>');
		$find = substr($result['body'], $start, 290);
		$DOM = new DOMDocument;
        libxml_use_internal_errors(true);
        $DOM->loadHTML($find);
		$items = $DOM->getElementsByTagName('h5');
		print_r($items);
	}

	public function view() {
		$this->load->view('pptp');
	}

}

/* End of file Pptp.php */
/* Location: ./application/controllers/Pptp.php */