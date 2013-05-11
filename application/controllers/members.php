<?php

class Members extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->logged_in();
		$this->load->model('members_model');
		$this->form_validation->set_error_delimiters('<span style="color:#b94a48;" class="help-inline">', '</span>');
	}

	function index() {
		$data = array();

		if ($result = $this->members_model->get_user_items()) {
			$data['rows'] = $result;
		}

		$this->load->view('members_view', $data);
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

	function create() {
		$data = array();

		$this->form_validation->set_rules('item', 'item', 'trim|required');
		$this->form_validation->set_rules('price', 'price', 'trim|required|numeric|less_than[500]|greater_than[-1]');
		$this->form_validation->set_rules('description', 'description', 'trim|required|max_length[500]');
		$this->form_validation->set_rules('category', 'category', 'trim|required');
		if (!empty($_FILES['userfile']['name'])) {
			$this->form_validation->set_rules('userfile', 'image', 'callback_do_upload');
		}

		$data['category_options'] = $this->members_model->category_options();

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('create_view', $data);
		}
		else {
			$id = $this->session->userdata('id');

			if ($this->do_upload('userfile')) {
				$file = $this->upload->data();

				$data = array(
					'userid' => $id,
					'item' => $this->input->post('item'),
					'posted' => date('Y-m-d H:i:s'),
					'price' => $this->input->post('price'),
					'description' => $this->input->post('description'),
					'category' => $this->input->post('category'),
					'on_campus' => $this->input->post('on_campus'),
					'item_image' => $file['file_name']
				);

				$this->create_thumbs();
			}
			else {
				$data = array(
					'userid' => $id,
					'item' => $this->input->post('item'),
					'posted' => date('Y-m-d H:i:s'),
					'price' => $this->input->post('price'),
					'description' => $this->input->post('description'),
					'category' => $this->input->post('category'),
					'on_campus' => $this->input->post('on_campus')
				);
			}

			$this->members_model->create($data);
			
			$this->session->set_flashdata('message', '<div class="alert alert-success animated fadeIn"><button type="button" class="close" data-dismiss="alert">&times;</button>Record created successfully.</div>');
			redirect('members');
		}
	}

	function update() {
		$data = array();
		
		$this->form_validation->set_rules('item', 'item', 'trim|required');
		$this->form_validation->set_rules('price', 'price', 'trim|required|numeric|less_than[500]|greater_than[-1]');
		$this->form_validation->set_rules('description', 'description', 'trim|required');
		$this->form_validation->set_rules('category', 'category', 'trim|required');
		if (!empty($_FILES['userfile']['name'])) {
			$this->form_validation->set_rules('userfile', 'image', 'callback_do_upload');
		}

		if ($result = $this->members_model->get_item_data()) {
			$data = array(
				'id' => $result->id,
				'item' => $result->item,
				'price' => $result->price,
				'description' => $result->description,
				'category' => $result->category,
				'on_campus' => $result->on_campus,
				'item_image' => $result->item_image
			);

			$data['category_options'] = $this->members_model->category_options();

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('update_view', $data);
			}
			else {
				if ($this->do_upload('userfile')) {
					$file = $this->upload->data();

					$data = array(
						'item' => $this->input->post('item'),
						'price' => $this->input->post('price'),
						'description' => $this->input->post('description'),
						'category' => $this->input->post('category'),
						'on_campus' => $this->input->post('on_campus'),
						'item_image' => $file['file_name']
					);

					$this->create_thumbs();
				}
				else {
					$data = array(
						'item' => $this->input->post('item'),
						'price' => $this->input->post('price'),
						'description' => $this->input->post('description'),
						'category' => $this->input->post('category'),
						'on_campus' => $this->input->post('on_campus')
					);
				}

				$this->members_model->update($data);

				$this->session->set_flashdata('message', '<div class="alert alert-success animated fadeIn"><button type="button" class="close" data-dismiss="alert">&times;</button>Record updated successfully.</div>');
				redirect('members');
			}
		}
	}

	function delete() {
		$this->members_model->delete();
		redirect('members');
	}

	function logout() {
		$this->session->sess_destroy();
		redirect('home', 'refresh');
	}

	function logged_in() {
		$logged_in = $this->session->userdata('logged_in');

		if (!isset($logged_in) || $logged_in != TRUE) {
			$this->session->set_flashdata('error', '<div class="alert alert-error animated fadeIn"><button type="button" class="close" data-dismiss="alert">&times;</button>You must be logged in to view this page.</div>');
			redirect('login', 'refresh');
		}
	}
}