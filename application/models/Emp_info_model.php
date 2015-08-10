<?php
class Emp_info_model extends ActiveRecord\Model {
	static $table_name = 'tbl_emp_info';
	static $primary_key = 'emp_id';

	public function insert_employee_data(){
		$this->form_validation->set_rules('txtEmpID', 'Employee ID', 'trim|required');
		$this->form_validation->set_rules('txtJobTitle', 'Job Title', 'trim|required');
		$this->form_validation->set_rules('txtEmploymentType', 'Employment Type', 'trim|required');
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

		$empInfo = array (
			'emp_id' => $this->input->post('txtEmpID'),
			'status' => 'Existing',
			'job_title_id' => $this->input->post('txtJobTitle'),
			'employment_type_id' => $this->input->post('txtEmploymentType'),
			'department_id' => $this->input->post('txtEmpDepartment')
			);
		$address = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'street' => $this->input->post('txtStreet'),
			'barangay' => $this->input->post('txtBarangay'),
			'city' => $this->input->post('txtCity'),
			'state' => $this->input->post('txtState'),
			'zip' => $this->input->post('txtZip'),
			'country' => $this->input->post('txtCountry')
			);
		$contact = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'mobile_number' => $this->input->post('txtMobile'),
			'tel_number' => $this->input->post('txtTelephone'),
			'email_address' => $this->input->post('txtEmail')
			);

		$personal = array (
			'emp_id' => $this->input->post('txtEmpID'),
			'first_name' => $this->input->post('txtFirstName'),
			'middle_name' => $this->input->post('txtMiddleName'),
			'last_name' => $this->input->post('txtLastName'),
			'birthday' => $this->input->post('txtBday'),
			'gender' => $this->input->post('txtFirstName'),
			'marital_status' => $this->input->post('txtStatus')
		);

		$id = array (
			'employee_id' => $this->input->post('txtEmpID')
		);

		
		if ($this->form_validation->run()) {	
			if (Emp_info_model::create($personal) && 
				Emp_history_model::create($empInfo) && 
				Emp_address_model::create($address) && 
				Emp_contact_model::create($contact) && 
				Emp_contact_person::create($id) &&
				Emp_school_model::create($id) &&
				Gov_id_model::create($id) &&
				Users::create($id) 
				) {
				$this->session->set_userdata('added', 1);
				redirect('ems/employees');
			}
		} else {
			return FALSE;
		}
	}
	
	public function updateInfo(){
		$data = array (
			'first_name' => $this->input->post('txtFirstName'),
			'middle_name' => $this->input->post('txtMiddleName'),
			'last_name' => $this->input->post('txtLastName'),
			'job_title' => $this->input->post('txtPosition'),
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

