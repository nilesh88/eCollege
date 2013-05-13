<?php

class Members_model extends CI_Model {
	function get_user_data() {
		$id = $this->session->userdata('id');

		$query = $this->db->get_where('Users', array('id' => $id));

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

	function get_user_items() {
		$id = $this->session->userdata('id');

		$this->db->select('id, item, posted, price, category, item_image');
		$this->db->from('Sales');
		$this->db->where('userid', $id);
		$this->db->order_by('posted', 'desc');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function get_item_data() {
		$id = $this->uri->segment(3);

		$query = $this->db->get_where('Sales', array('id' => $id));

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

	function create($data) {
		$this->db->insert('Sales', $data);
	}

	function update($data) {
		$id = $this->uri->segment(3);

		$query = $this->db->get_where('Sales', array('id' => $id));

		if ($query->num_rows() > 0) {

			$this->db->where('id', $id);
			$this->db->update('Sales', $data);
		}
		else {
			return FALSE;
		}
	}

	function edit($data) {
		$id = $this->session->userdata('id');

		$query = $this->db->get_where('Users', array('id' => $id));

		if ($query->num_rows() > 0) {

			$this->db->where('id', $id);
			$this->db->update('Users', $data);
		}
		else {
			return FALSE;
		}
	}

	function password() {
		$id = $this->session->userdata('id');

		$password = md5($this->input->post('newPassConf'));

		$query = $this->db->get_where('Users', array('id' => $id));

		if ($query->num_rows() > 0) {
			$this->db->where('id', $id);
			$this->db->update('Users', array('Password' => $password));
		}
		else {
			return FALSE;
		}
	}

	function delete() {
		$id = $this->uri->segment(3);

		$this->db->where('id', $id);
		$this->db->delete('Sales');

		return TRUE;
	}

	function category_options() {
		$category_options = array('' => 'Select Category');

		$this->db->select('category');
		$this->db->from('Categories');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$category_options[$row->category] = $row->category;
			}

			return $category_options;
		}
		else {
			return FALSE;
		}
	}
}