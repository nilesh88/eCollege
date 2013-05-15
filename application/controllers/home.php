<?php

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
	}

	function index() {
		$data = array();

		if ($result = $this->home_model->get_data()) {
			$data['rows'] = $result;
		}

		$data['main_content'] = 'home_view';

		$this->load->view('includes/template', $data);
	}
}