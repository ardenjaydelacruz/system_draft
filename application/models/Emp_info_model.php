<?php
class Emp_info_model extends ActiveRecord\Model {
	static $table_name = 'tbl_emp_info';
	static $primary_key = 'emp_id';

	public function updateEmployee(){
		$id = $this->input->get('emp_id');
	    if($this->input->post('btnAddJob')){
	        if(Job_history_model::create(Emp_info_model::jobInfo())){
	            $this->session->set_userdata('edited', 1);
	            redirect("ems/view_details?emp_id=$id");
	        }
	    }
	    if($this->input->post('btnAddDependents')){
	        if(Dependent_model::create(Emp_info_model::dependentInfo())){
	            $this->session->set_userdata('edited', 1);
	            redirect("ems/view_details?emp_id=$id");
	        }
	    }
	    
		$ems      = Emp_info_model::find($id);
		$gov      = Gov_id_model::find($id);
		$address  = Emp_address_model::find($id);
		$contact  = Emp_contact_model::find($id);
		$contactP = Emp_contact_person::find($id);
		$school   = Emp_school_model::find($id);
		$emp      = Emp_history_model::find($id);
		$user     = Users::find_by_employee_id($id);

	    if ($ems->update_attributes(Emp_info_model::personalInfo()) && 
	        $gov->update_attributes(Emp_info_model::govInfo()) && 
	        $address->update_attributes(Emp_info_model::addressInfo()) && 
	        $contact->update_attributes(Emp_info_model::contactInfo()) && 
	        $contactP->update_attributes(Emp_info_model::contactPerson()) && 
	        $school->update_attributes(Emp_info_model::schoolInfo()) && 
	        $emp->update_attributes(Emp_info_model::employmentInfo()) && 
	        $user->update_attributes(Emp_info_model::accountInfo())) {
	        $this->session->set_userdata('edited', 1);
	    	Audit_trail_model::auditUpdateEmp($id);
	        redirect("ems/view_details?emp_id=$id");
	    }
	}

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

		// $empid = count(Emp_info_model::all())+1;
		$empInfo = array (
			'emp_id' => $this->input->post('txtEmpID'),
			'status' => 'Existing',
			'job_title_id' => $this->input->post('txtJobTitle'),
			'employment_type_id' => $this->input->post('txtEmploymentType'),
			'department_id' => $this->input->post('txtEmpDepartment'),
			'start_date' => date('Y-m-d'),
			'end_date' => date('Y-m-d'),
			'probationary_date' => date('Y-m-d'),
			'permanency_date' => date('Y-m-d')
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
			'gender' => $this->input->post('txtGender'),
			'marital_status' => $this->input->post('txtStatus')
		);

		$id = array (
			'employee_id' => $this->input->post('txtEmpID')
		);

		$acc = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'profile_image' => 'default.jpg',
			'user_level' => 'EMP'
			);
		
		$leave1 = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'leave_type_id' => 'BL',
			'days' => 0
			);

		$leave2 = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'leave_type_id' => 'MTL',
			'days' => 0
			);

		$leave3 = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'leave_type_id' => 'MNL',
			'days' => 0
			);

		$leave4 = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'leave_type_id' => 'PL',
			'days' => 0
			);

		$leave5 = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'leave_type_id' => 'SL',
			'days' => 0
			);

		$leave6 = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'leave_type_id' => 'VL',
			'days' => 0
			);

		$leave7 = array (
			'employee_id' => $this->input->post('txtEmpID'),
			'leave_type_id' => 'BL',
			'days' => 0
			);

		if ($this->form_validation->run()) {	
			if (Emp_info_model::create($personal) && 
				Emp_history_model::create($empInfo) && 
				Emp_address_model::create($address) && 
				Emp_contact_model::create($contact) && 
				Emp_contact_person::create($id) &&
				Emp_school_model::create($id) &&
				Gov_id_model::create($id) &&
				Users::create($acc) &&
				Leave_left_model::create($leave1) &&
				Leave_left_model::create($leave2) &&
				Leave_left_model::create($leave3) &&
				Leave_left_model::create($leave4) &&
				Leave_left_model::create($leave5) &&
				Leave_left_model::create($leave6) &&
				Leave_left_model::create($leave7)
				) {
				$this->session->set_userdata('added', 1);
				Audit_trail_model::auditAddEmp($this->input->post('txtEmpID'));
				redirect('ems/employees');
			}
		} else {
			return FALSE;
		}
	}
	
	public function deleteEmployee(){
		$id       = $this->input->get('emp_id');
        $emp      = Emp_info_model::find($id);
        $info     = Emp_info_model::find($id); //Tab 1a - Personal Tab
        $gov_id   = Gov_id_model::find($id); //Tab 1b - Gov ID Tab
        $address  = Emp_address_model::find($id); //Tab 2a - Contact Tab
        $contact  = Emp_contact_model::find($id); //Tab 2b - Contact Tab
        $contactP = Emp_contact_person::find($id); //Tab 2c - Contact Tab
        $school   = Emp_school_model::find($id); //Tab 3 - School Tab
        $emp_hist = Emp_history_model::find($id); //Tab 5 - Employment Tab
        $account  = Users::find_by_employee_id($id); //Tab 9 - Users Tab
        $emp->delete();
        $info->delete();
        $gov_id->delete();
        $address->delete();
        $contact->delete();
        $contactP->delete();
        $school->delete();
        $emp_hist->delete();
        $account->delete();
        $this->session->set_userdata('deleted', 1);
        Audit_trail_model::auditDeleteEmp($id);
        redirect('ems/employees');
	}

	

	public function personalInfo(){
		$data = array (
			'first_name' => $this->input->post('txtFirstName'),
			'middle_name' => $this->input->post('txtMiddleName'),
			'last_name' => $this->input->post('txtLastName'),
			'birthday' => $this->input->post('txtBirthday'),
			'gender' => $this->input->post('txtGender'),
			'marital_status' => $this->input->post('txtMaritalStatus')
		);
		return $data;
	}

	public function govInfo(){
		$data = array (
			'sss_no' => $this->input->post('txtSSS'),
			'pagibig_no' => $this->input->post('txtPagibig'),
			'philhealth_no' => $this->input->post('txtPhilhealth'),
			'tin' => $this->input->post('txtTIN')
		);
		return $data;
	}

	public function addressInfo(){
		$data = array(
			'street' => $this->input->post('txtStreet'),
			'barangay' => $this->input->post('txtBarangay'),
			'city' => $this->input->post('txtCity'),
			'state' => $this->input->post('txtState'),
			'zip' => $this->input->post('txtZip'),
			'country' => $this->input->post('txtCountry')
		);
		return $data;
	}

	public function contactInfo(){
		$data = array(
			'mobile_number' => $this->input->post('txtMobile'),
			'tel_number' => $this->input->post('txtTelephone'),
			'email_address' => $this->input->post('txtEmailAd')
		);
		return $data;
	}

	public function contactPerson(){
		$data = array(
			'contact_person' => $this->input->post('txtContactPerson'),
			'contact_num' => $this->input->post('txtContactNum'),
			'contact_rel' => $this->input->post('txtContactRel')
		);
		return $data;
	}

	public function schoolInfo(){
		$data = array(
			'primary_name' => $this->input->post('txtSchoolName1'),
			'primary_address' => $this->input->post('txtSchoolAddress1'),
			'primary_year' => $this->input->post('txtSchoolYear1'),
			'secondary_name' => $this->input->post('txtSchoolName2'),
			'secondary_address' => $this->input->post('txtSchoolAddress2'),
			'secondary_year' => $this->input->post('txtSchoolYear2'),
			'tertiary_name' => $this->input->post('txtSchoolName3'),
			'tertiary_address' => $this->input->post('txtSchoolAddress3'),
			'tertiary_year' => $this->input->post('txtSchoolYear3')
		);
		return $data;
	}

	public function employmentInfo(){
		$data = array(
			'status' => $this->input->post('txtStatus'),
			'employment_type_id' => $this->input->post('txtEmploymentType'),
			'job_title_id' => $this->input->post('txtJobTitle'),
			'department_id' => $this->input->post('txtDepartment'),
			'start_date' => $this->input->post('txtStartDate'),
			'end_date' => $this->input->post('txtEndDate'),
			'probationary_date' => $this->input->post('txtProbationaryDate'),
			'permanency_date' => $this->input->post('txtPermanencyDate'),
			'salary' => $this->input->post('txtSalary'),
			'pay_grade' => $this->input->post('txtPayGrade')
		);
		return $data;
	}

	public function accountInfo(){
		$data = array(
			'username' => $this->input->post('txtUsername'),
			'password' => md5($this->input->post('txtPassword')),
			'user_level' => $this->input->post('txtUserLevel'),
			'secret_question' => $this->input->post('txtSecretQuestion'),
			'secret_answer' => $this->input->post('txtSecretAnswer')
		);
		return $data;
	}

	public function jobInfo(){
		$data = array(
			'employee_id' => $this->input->get('emp_id'),
			'company_name' => $this->input->post('txtCompanyName'),
			'company_address' => $this->input->post('txtCompanyAddress'),
			'years_stayed' => $this->input->post('txtJobHistYears'),
			'job_title' => $this->input->post('txtJobHistTitle')
		);
		return $data;
	}

	public function dependentInfo(){
		$data = array(
			'employee_id' => $this->input->get('emp_id'),
			'dependent_fname' => $this->input->post('txtDFirstName'),
			'dependent_lname' => $this->input->post('txtDLastName'),
			'relationship' => $this->input->post('txtRelationship')
		);
		return $data;
	}

	public function updateLeave($id){
		$leave1 = Leave_left_model::find_by_employee_id_and_leave_type_id($id,'BL');
		$data1 = array (
			'days' => $leave1->days + $this->input->post('txtBirthdayLeave')
			);
		$leave1->update_attributes($data1);

		$leave2 = Leave_left_model::find_by_employee_id_and_leave_type_id($id,'MNL');
		$data2 = array (
			'days' => $leave2->days + $this->input->post('txtMandatoryLeave')
			);
		$leave2->update_attributes($data2);

		$leave3 = Leave_left_model::find_by_employee_id_and_leave_type_id($id,'PL');
		$data3 = array (
			'days' => $leave3->days + $this->input->post('txtPaternityLeave')
			);
		$leave3->update_attributes($data3);

		$leave4 = Leave_left_model::find_by_employee_id_and_leave_type_id($id,'MTL');
		$data4 = array (
			'days' => $leave4->days + $this->input->post('txtMaternityLeave')
			);
		$leave4->update_attributes($data4);

		$leave5 = Leave_left_model::find_by_employee_id_and_leave_type_id($id,'SL');
		$data5 = array (
			'days' => $leave5->days + $this->input->post('txtSickLeave')
			);
		$leave5->update_attributes($data5);

		$leave6 = Leave_left_model::find_by_employee_id_and_leave_type_id($id,'VL');
		$data6 = array (
			'days' => $leave6->days + $this->input->post('txtVacationLeave')
			);
		$leave6->update_attributes($data6);

		redirect("ems/view_details?emp_id=$id");
	}
}

