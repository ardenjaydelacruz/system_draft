<?php
class Employees_model extends ActiveRecord\Model {
	static $table_name = 'employees';
	static $primary_key = 'emp_id';

	public function valid_emp_data(){
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
			return TRUE;
		} else {
			return FALSE;
		}

	}
}

