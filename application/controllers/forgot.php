<?php

class Forgot extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
	}

	function index() {
		$data = array();

		$this->form_validation->set_rules('email', 'email', 'trim|required|callback_is_valid_email');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('forgot_view');
		}
		else {
			if ($this->home_model->reset()) {
				redirect('home', 'refresh');
			}
		}
	}

	function is_valid_email($email) {
		$email = preg_match("/.+@.+\.edu/", $email);

		if ($email) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('is_valid_email', 'Email must end in .edu');
			return FALSE;
		}
	}
}