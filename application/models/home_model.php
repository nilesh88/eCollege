<?php

class Home_model extends CI_Model {
	function get_data() {
		$this->db->order_by('posted', 'desc');
		$this->db->limit(5);
		$query = $this->db->get('Sales');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function get_item_data() {
		$id = $this->uri->segment(2);

		$this->db->select('Users.FirstName, Users.LastName, Users.Email, Users.User_Image, Users.joined, Sales.id, Sales.item, Sales.posted, Sales.price, Sales.on_campus, Sales.category, Sales.description, Sales.item_image');
		$this->db->from('Sales');
		$this->db->join('Users', 'Users.id = Sales.userid');
		$this->db->where('Sales.id', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$data = array();

			foreach ($query->result() as $row) {
				$data = $row;
			}

			return $data;
		}
		else {
			return FALSE;
		}
	}

	function get_item_nums() {
		$query = $this->db->get('Categories');

		if ($query->num_rows() > 0) {
			return $query->result();
		}
	}

	function get_categories() {
		$query = $this->db->get('Categories');

		if ($query->num_rows() > 0) {
			$data['categories'] = $query->result();

			return $data;
		}
		else {
			return FALSE;
		}
	}

	function get_item_category() {
		$category = $this->uri->segment(2);

		$this->db->where('category', $category);
		$this->db->order_by('posted', 'desc');
		$query = $this->db->get('Sales');

		if ($query->num_rows() > 0) {
			$data['rows'] = $query->result();

			return $data;
		}
		else {
			return FALSE;
		}
	}

	function login() {
		$data = array(
			'Email' => $this->input->post('emaierl'),
			'Password' => md5($this->input->post('password')),
			'activated' => 1
		);

		$query = $this->db->get_where('Users', $data);

		if ($query->num_rows() > 0) {
			$data = array();

			foreach ($query->result() as $row) {
				$data = $row;
			}

			return $data;
		}
		else {
			return FALSE;
		}
	}

	function is_activated($email) {
		$this->db->select('activated');
		$this->db->from('Users');
		$this->db->where('Email', $email);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$row = $query->row();

			if ($row->activated == strval(1)) {
				return TRUE;
			}
		}
		else {
			return FALSE;
		}
	}

	function is_activated_uri() {
		$code = $this->uri->segment(3);

		$this->db->select('activated');
		$this->db->from('Users');
		$this->db->where('activated', $code);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$row = $query->row();

			if ($row->activated == strval(0)) {
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
	}

	function register() {
		$code = random_string('alnum', 16);

		$data = array(
			'FirstName' => $this->input->post('firstName'),
			'LastName' => $this->input->post('lastName'),
			'Email' => $this->input->post('email'),
			'Password' => md5($this->input->post('password')),
			'activation_code' => $code
		);

		if ($query = $this->db->insert('Users', $data)) {
			$this->email->from('rightlag@gmail.com', 'eCollege Team');
			$this->email->to($this->input->post('email'));
			$this->email->subject('eCollege Registration Confirmation');
			$this->email->message('Please click ' . anchor('register/confirm/' . $code, 'here') . ' to activate your account.');

			$this->email->send();

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	function email_exists($email) {
		$query = $this->db->get_where('Users', array('Email' => $email));

		if ($query->num_rows() > 0) {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	function confirm($code) {
		$query = $this->db->get_where('Users', array('activation_code' => $code));

		if ($query->num_rows() > 0) {
			$data = array(
				'activated' => 1,
				'joined' => date('Y-m-d H:i:s')
			);

			$this->db->where('activation_code', $code);
			$this->db->update('Users', $data);

			return TRUE;
		}
		else {
			return FALSE;
		}
	}

	function reset() {
		$new_pass = random_string('alnum', 8);
		$email = $this->input->post('email');

		$data = array(
			'Password' => md5($new_pass)
		);

		$query = $this->db->get_where('Users', array('Email' => $email));

		if ($query->num_rows() > 0) {
			$this->db->where('Email', $email);
			$this->db->update('Users', $data);

			$this->email->from('rightlag@gmail.com', 'eCollege Team');
			$this->email->to($this->input->post('email'));
			$this->email->subject('eCollege Password Reset');
			$this->email->message(
				'You are receiving this email because you have requested to change your password.<br />' .
				'If you did not request to change your password, please disregard this email.<br />' .	
				'Your new password is: ' . $new_pass
			);

			$this->email->send();

			return TRUE;
		}
		else {
			return FALSE;
		}
	}
}