<?php

class View extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
	}

	function index() {
		$data = array();

		if ($result = $this->home_model->get_item_data()) {
			$data = array(
				'id' => $result->id,
				'first_name' => $result->FirstName,
				'last_name' => $result->LastName,
				'email' => $result->Email,
				'user_image' => $result->User_Image,
				'joined' => $result->joined,
				'item' => $result->item,
				'posted' => $result->posted,
				'price' => $result->price,
				'on_campus' => $result->on_campus,
				'category' => $result->category,
				'description' => $result->description,
				'item_image' => $result->item_image,
				'logged_in' => $this->session->userdata('logged_in')
			);
		}

		$this->load->view('item_view', $data);
	}
}