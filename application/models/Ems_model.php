<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ems_model extends CI_Model {
	public function filterEmployee(){
		$status = $this->input->post('txtStatus');
		$job_title = $this->input->post('txtJobTitle');
		$department = $this->input->post('txtDepartment');
		$employment_type = $this->input->post('txtEmploymentType');
		if ($status){ $this->db->where('status',$this->input->post('txtStatus'));}
		if ($job_title){ $this->db->where('job_title_name',$this->input->post('txtJobTitle'));}
		if ($department){ $this->db->where('department_name',$this->input->post('txtDepartment'));}
		if ($employment_type){ $this->db->where('employment_type',$this->input->post('txtEmploymentType'));}
		$query = $this->db->get('view_employees_list');
		$data = false;
		if ($query) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		} else {
			return false;
		}
		
	}
}