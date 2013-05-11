<?php

class Search extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
	}

	function index() {
		$data = array(
			'item' => $this->input->post('item')
		);
	}
}