<?php

class Category extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
	}

	function index() {
		$data = array();

		$data['logged_in'] = $this->session->userdata('logged_in');
		$data['cat'] = $this->uri->segment(2);

		if ($result = $this->home_model->get_item_category()) {
			$data['rows'] = $result['rows'];
		}

		if ($result = $this->home_model->get_categories()) {
			$data['categories'] = $result['categories'];
		}

		$this->load->view('category_view', $data);
	}
}