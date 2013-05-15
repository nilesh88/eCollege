<?php

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>');
	}

	function index() {
		$data = array();
		
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback_is_valid_email|callback_email_exists|callback_is_activated');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['main_content'] = 'login_view';

			$this->load->view('includes/template', $data);
		}
		else {
			if ($result = $this->home_model->login()) {
				$data = array(
					'id' => intval($result->id),
					'FirstName' => $result->FirstName,
					'LastName' => $result->LastName,
					'User_Image' => $result->User_Image,
					'logged_in' => TRUE
				);

				$this->session->set_userdata($data);

				redirect('members', 'refresh');
			}
			else {
				$data['error'] = 'Incorrect password';
				$this->load->view('login_view', $data);
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

	function email_exists($email) {
		if ($this->home_model->email_exists($email)) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('email_exists', 'This account does not exist.');

			return FALSE;
		}
	}

	function is_activated($email) {
		if ($this->home_model->is_activated($email)) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('is_activated', 'The account you are trying to log in with has not been activated.');

			return FALSE;
		}
	}
}