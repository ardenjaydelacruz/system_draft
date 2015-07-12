<?php
class Employees_model extends ActiveRecord\Model {
	static $table_name = 'employees';
	static $primary_key = 'emp_id';

	public function insert_employee_data(){
		$this->form_validation->set_rules('txtEmpID', 'Employee ID', 'trim|required');
		$this->form_validation->set_rules('txtEmpPosition', 'Position', 'trim|required');
		$this->form_validation->set_rules('txtEmpStatus', 'Employee Status', 'trim|required');
		$this->form_validation->set_rules('txtEmpDepartment', 'Employee Department', 'trim|required');

		$this->form_validation->set_rules('txtFirstName', 'First Name', 'trim|required');
		$this->form_validation->set_rules('txtMiddleName', 'Middle Name', 'trim');
		$this->form_validation->set_rules('txtLastName', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('txtGender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('txtBday', 'Birthday', 'trim|required');
		$this->form_validation->set_rules('txtStatus', 'Marital Status', 'trim|required');

		$this->form_validation->set_rules('txtStreet', 'Street', 'trim|required');
		$this->form_validation->set_rules('txtBarangay', 'Barangay', 'trim|required');
		$this->form_validation->set_rules('txtCity', 'City', 'trim|required');
		$this->form_validation->set_rules('txtState', 'State', 'trim|required');
		$this->form_validation->set_rules('txtZip', 'Zip Code', 'trim|required');
		$this->form_validation->set_rules('txtCountry', 'Country', 'trim|required');

		if ($this->form_validation->run()) {
			$details = Employees_model::employeeInfo();
			if (Employees_model::create($details)) {
				$this->session->set_userdata('added', 1);
				redirect('ems/employees');
			}
		} else {
			return FALSE;
		}
	}

	public function employeeInfo(){
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
		return $data;
	}

	public function updateInfo(){
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
		return $data;
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
		$ems = Employees_model::find($id);
		$ems->image = $image['file_name'];
		$ems->save();
		if ($ems->save()) {
			$this->session->set_userdata('uploaded',1);
			$this->session->set_userdata('profile_image',$image['file_name']);
			return true;
		} else {
			return false;
		}

	}


}

