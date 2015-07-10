<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ems_model extends CI_Model {

	public function toast($message, $type)
	{
		$data['message'] = $message;
		if ($type == 'success') {
			$this->load->view('components/toast_success', $data);
		} elseif ($type == 'error') {
			$this->load->view('components/toast_error', $data);
		}
	}

	public function check_userlevel()
	{
		$userLevel = $this->session->userdata('user_level');
		$firstname = $this->session->userdata('first_name');
		$data['total_employee'] = $this->ems_model->total_employees();
		$data['total_asset'] = $this->ams_model->total_assets();
		if ($userLevel == 'Administrator') {
			$this->load->view('components/admin_dashboard', $data);
		} elseif ($userLevel == 'Manager') {
			$this->load->view('components/manager_dashboard', $data);
		} elseif ($userLevel == 'Employee') {
			$this->load->view('components/employee_dashboard', $data);
		}
		$this->load->view('components/footer');
		if ($this->session->userdata('welcome')) {
			$this->toast('Welcome! ' . $userLevel . ' ' . $firstname, 'success');
			$this->session->unset_userdata('welcome');
		}
	}
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

	public function employees_table()
	{
		$config["base_url"] = base_url() . "employee/employees";
		$config["total_rows"] = $this->ems_model->total_employees();
		$config["per_page"] = 15;
		$config["uri_segment"] = 3;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		$config['full_tag_open'] = '<ul class="pagination zero">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['total_employee'] = $this->ems_model->total_employees();
		$data["record"] = $this->ems_model->fetch_record($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();

		$this->load->view("employee/employees_table", $data);

		$this->load->view('components/footer');
		if ($this->session->userdata('added')) {
			$this->toast('Successful! Record has been added.', 'success');
			$this->session->unset_userdata('added');
		}
		if ($this->session->userdata('deleted')) {
			$this->toast('Successful! Record has been deleted.', 'success');
			$this->session->unset_userdata('deleted');
		}
		if ($this->session->userdata('edited')) {
			$this->toast('Successful! Record has been updated.', 'success');
			$this->session->unset_userdata('edited');
		}
		if ($this->session->userdata('uploaded')) {
			$this->toast('Successful! Photo has been changed.', 'success');
			$this->session->unset_userdata('uploaded');
		}

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
				'emp_id' => $row->emp_id,
				'emp_firstname' => $row->first_name,
				'emp_middlename' => $row->middle_name,
				'emp_lastname' => $row->last_name
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
