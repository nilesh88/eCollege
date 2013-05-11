<?php

class Settings extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->logged_in();
		$this->load->model('members_model');
		$this->form_validation->set_error_delimiters('<span style="color:#b94a48;" class="help-inline">', '</span>');
	}

	function do_upload() {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = '2000';
		$config['encrypt_name'] = TRUE;

		$this->upload->initialize($config);

		if ($this->upload->do_upload()) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('do_upload', $this->upload->display_errors('', ''));

			return FALSE;
		}
	}

	function create_thumbs() {
		$this->load->library('image_lib');

		$file = $this->upload->data();

		$sizes = array(
			'thumb' => array(32, 32),
			'medium' => array(64, 64),
			'large' => array(128, 128),
			'xlarge' => array(512, 512),
			'home' => array(300, 200)
		);

		foreach ($sizes as $size) {
			$config = array(
				'image_library' => 'gd2',
				'source_image' => $file['full_path'],
				'new_image' => './uploads/thumbs/' . $size[0] . 'x' . $size[1],
				'maintain_ratio' => TRUE,
				'width' => $size[0],
				'height' => $size[1]
			);

			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();
		}
	}

	function profile() {
		$data = array();
		
		$this->form_validation->set_rules('firstName', 'first name', 'trim|required');
		$this->form_validation->set_rules('lastName', 'last name', 'trim|required');
		if (!empty($_FILES['userfile']['name'])) {
			$this->form_validation->set_rules('userfile', 'image', 'callback_do_upload');
		}

		if ($result = $this->members_model->get_user_data()) {
			$data = array(
				'id' => $result->id,
				'first_name' => $result->FirstName,
				'last_name' => $result->LastName,
				'email' => $result->Email,
				'user_image' => $result->User_Image
			);

			if ($this->form_validation->run() == FALSE) {
				$data['main_content'] = 'edit_view';
				$this->load->view('includes/template', $data);
			}
			else {
				if ($this->do_upload('userfile')) {
					$file = $this->upload->data();

					$data = array(
						'FirstName' => $this->input->post('firstName'),
						'LastName' => $this->input->post('lastName'),
						'User_Image' => $file['file_name']
					);

					$this->create_thumbs();
				}
				else {
					$data = array(
						'FirstName' => $this->input->post('firstName'),
						'LastName' => $this->input->post('lastName')
					);
				}

				$this->members_model->edit($data);

				$this->session->set_userdata($data);
				$this->session->set_flashdata('message', '<div class="alert alert-success animated fadeIn"><button type="button" class="close" data-dismiss="alert">&times;</button>User profile updated successfully.</div>');
				redirect('members');
			}
		}
	}

	function password() {
		$this->form_validation->set_rules('newPass', 'new password', 'trim|required');
		$this->form_validation->set_rules('newPassConf', 'new password confirmation', 'trim|required|matches[newPass]');

		if ($this->form_validation->run() == FALSE) {
			$data['main_content'] = 'edit_password_view';
			$this->load->view('includes/template', $data);
		}
		else {
			$this->members_model->password();

			$this->session->set_flashdata('message', '<div class="alert alert-success animated fadeIn"><button type="button" class="close" data-dismiss="alert">&times;</button>Password successfully updated.</div>');
			redirect('members');
		}
	}

	function logged_in() {
		$logged_in = $this->session->userdata('logged_in');

		if (!isset($logged_in) || $logged_in != TRUE) {
			$this->session->set_flashdata('error', '<div class="alert alert-error animated fadeIn"><button type="button" class="close" data-dismiss="alert">&times;</button>You must be logged in to view this page.</div>');
			
			redirect('login', 'refresh');
		}
	}
}