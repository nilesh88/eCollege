<?php

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();

		$this->load->model('home_model');
	}

	function index() {
		$data = array();

		$data['main_content'] = 'home_view';

		$limit = 6;
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		$data['logged_in'] = $this->session->userdata('logged_in');

		if ($result = $this->home_model->get_data($limit, $offset)) {
			$data['rows'] = $result['rows'];
			$data['num_rows'] = $result['num_rows'];

			$config['base_url'] = site_url('home');
			$config['total_rows'] = $data['num_rows'];
			$config['per_page'] = $limit;
			$config['uri_segment'] = 2;
			$config['full_tag_open'] = '<div class="pagination pull-right"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_link'] = '&laquo; First';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_link'] = 'Last &raquo;';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = 'Next &rarr;';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&larr; Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
		}

		if ($result = $this->home_model->get_categories()) {
			$data['categories'] = $result['categories'];
		}

		$this->load->view('includes/template', $data);
	}
}