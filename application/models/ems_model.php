<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ems_model extends CI_Model {
	
	public function total_employees(){
		return $this->db->count_all('employees');
	}

	public function total_projects(){
		return $this->db->count_all('employees');
	}

	public function fetch_record($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get("employees");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
   }

	public function add_record(){
		$data = array (
			'emp_id' => $this->input->post('txtEmpId'),
			'first_name' => $this->input->post('txtFirstName'),
			'middle_name' => $this->input->post('txtMiddleName'),
			'last_name' => $this->input->post('txtLastName'),
			'position' => $this->input->post('txtEmpPosition'),
			'status' => $this->input->post('txtEmpStatus'),
			'department' => $this->input->post('txtEmpDepartment'),
			'birthday' => $this->input->post('txtBday'),
			'gender' => $this->input->post('txtFirstName'),
			'marital_status' => $this->input->post('txtStatus'),
			'street' => $this->input->post('txtStreet'),
			'barangay' => $this->input->post('txtBarangay'),
			'city' => $this->input->post('txtCity'),
			'state' => $this->input->post('txtState'),
			'zip' => $this->input->post('txtZip'),
			'country' => $this->input->post('txtCountry'),
			'mobile_number' => $this->input->post('txtMobile'),
			'tel_number' => $this->input->post('txtTelephone'),
			'email_address' => $this->input->post('txtEmail'),
			'contact_person' => $this->input->post('txtContactPerson'),
			'contact_num' => $this->input->post('txtContactNumber'),
			'contact_rel' => $this->input->post('txtContactRel')
		);

		$query = $this->db->insert('employees',$data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_employee($id){
		$this->db->where('emp_id', $id);
		$query = $this->db->delete('employees');
	}

	public function view_emp_details($id){
		$this->db->where('emp_id', $id);
		$query = $this->db->get('employees');

		if ($query->result()){
			foreach ($query->result() as $row) {
				$records[] = $row;
			}
			return $records;
		}
	}

	public function update_record($id){
		$this->db->where('emp_id',$id);
		$data = array (
			'first_name' => $this->input->post('txtFirstName'),
			'middle_name' => $this->input->post('txtMiddleName'),
			'last_name' => $this->input->post('txtLastName'),
			'position' => $this->input->post('txtPosition'),
			'status' => $this->input->post('txtStatus'),
			'department' => $this->input->post('txtDepartment'),
			'leaves' => $this->input->post('txtLeaves'),
			'birthday' => $this->input->post('txtBirthday'),
			'gender' => $this->input->post('txtGender'),
			'marital_status' => $this->input->post('txtMaritalStatus'),
			'street' => $this->input->post('txtStreet'),
			'barangay'=> $this->input->post('txtBarangay'),
			'city' => $this->input->post('txtCity'),
			'zip' => $this->input->post('txtZip'),
			'state' => $this->input->post('txtState'),
			'country' => $this->input->post('txtCountry'),
			'mobile_number' => $this->input->post('txtMobile'),
			'tel_number' => $this->input->post('txtTelephone'),
			'contact_person' => $this->input->post('txtContactPerson'),
			'contact_rel' => $this->input->post('txtContactRel'),
			'contact_num' => $this->input->post('txtContactNum'),
			'email_address'=> $this->input->post('txtEmail')
			);

			$query = $this->db->update('employees',$data);
			if ($query) {
				return true;
			} else {
				return false;
			}
	}

	public function search_employee() {
		$match = $this->input->post('txtSearch');
		$this->db->like('emp_id',$match);
		$this->db->or_like('first_name',$match);
		$this->db->or_like('last_name',$match);
		$this->db->or_like('city',$match);
		$query = $this->db->get('employees');
		return $query->result();
	}

	public function get_employee($id){
		$this->db->where('emp_id',$id);
		$query = $this->db->get('employees');
		$row = $query->row();
		if($query->result()){
			$session_data = array(
				'name' => $row->first_name.' '.$row->middle_name.' '.$row->last_name
				);
			$this->session->set_userdata($session_data);
		}
	}

	public function do_upload($id){
		// $this->upload_path = realpath(APPPATH.'../assets/images/profile');

		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => 'assets/images/profile/'
		);

		$this->load->library('upload',$config);

		$this->upload->do_upload();
		$image = $this->upload->data();

		$this->db->where('emp_id',$id);

		$data = array (
			'image' => $image['file_name']
			);
		$query = $this->db->update('employees',$data);
		if ($query) {
				$this->session->set_userdata('uploaded',1);
				$this->session->set_userdata('profile_image',$image['file_name']);
				return true;
			} else {
				return false;
			}

	}
}
