<?php

class Register extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
	}

	function index() {
		$data = array();
		
		$this->form_validation->set_rules('firstName', 'first name', 'trim|required');
		$this->form_validation->set_rules('lastName', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_is_valid_email|callback_email_exists');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password_confirm', 'password confirmation', 'trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE) {
			$data['main_content'] = 'register_view';

			$this->load->view('includes/template', $data);
		}
		else {
			if ($this->home_model->register()) {
				$data = array(
					'title' => 'Confirmation Needed',
					'content' => 'Check your email for the confirmation message.'
				);
				
				$this->load->view('register_success_view', $data);
			}
		}
	}

	public function confirm() {
		$data = array();

		$code = $this->uri->segment(3);

		if (!strlen($code)) {
			$data = array(
				'title' => 'Error',
				'content' => 'No registration code in URL.'
			);

			$this->load->view('register_success_view', $data);
		}
		else {
			if (!$this->home_model->is_activated_uri()) {
				$data = array(
					'title' => 'Error',
					'content' => 'This account has already been activated.',
					'link' => anchor('login', 'Click here to sign in', 'class="btn btn-large btn-success"')
				);
			}
			else {
				$query = $this->home_model->confirm($code);

				$data = array(
					'title' => 'Success!',
					'content' => 'You are now registered.',
					'link' => anchor('login', 'Click here to sign in', 'class="btn btn-large btn-success"')
				);
			}

			$this->load->view('register_success_view', $data);
		}
	}

	function email_exists($email) {
		if ($this->home_model->email_exists($email)) {
			$this->form_validation->set_message('email_exists', 'This email is already registered.');

			return FALSE;
		}
		else {
			return TRUE;
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