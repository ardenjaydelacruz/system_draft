<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reports_model extends CI_Model {
	public function filterEmployee(){
		$status = $this->input->post('txtStatus');
		$job_title = $this->input->post('txtJobTitle');
		$department = $this->input->post('txtDepartment');
		$employment_type = $this->input->post('txtEmploymentType');
		if ($status){ $this->db->where('status',$this->input->post('txtStatus'));}
		if ($job_title){ $this->db->where('job_title_name',$job_title);}
		if ($department){ $this->db->where('department_name',$department);}
		if ($employment_type){ $this->db->where('employment_type',$employment_type);}
		return $this->db->get('view_employees_list')->result();
	}

	public function filterProject(){
		$status = $this->input->post('txtStatus');
		$client = $this->input->post('txtClient');
		if ($status=="Active"){
			$this->db->where('ending_date >=', date('Y-m-d'));
		} elseif ($status=="Inactive") {
			$this->db->where('ending_date <', date('Y-m-d'));
		}
		if ($client){ $this->db->where('client_name',$client);}
		return $this->db->get('view_project_cost')->result();
	}

	public function getProjectWorkers(){
		$project = $this->input->post('txtProjectName');
		$employee = $this->input->post('txtEmployee');
		if ($project!='000'){ $this->db->where('project_name',$project);}
		if ($employee!='000'){ $this->db->where('emp_id',$employee);}
		return $this->db->get('view_project_workers')->result();
	}

	public function getLeavesLeft(){
		$category = $this->input->post('txtEmployee');
		if ($employee){ $this->db->where('emp_id',$employee);}
		return $this->db->get('view_leave_remaining')->result();
	}

	public function getInventory(){
		$category = $this->input->post('txtCategory');
		if ($category){ $this->db->where('category_name',$category);}
		return $this->db->get('view_stocks')->result();
	}

	public function getAsset(){
		$category = $this->input->post('txtCategory');
		$employee = $this->input->post('txtEmployee');
		$status = $this->input->post('txtStatus');
		if ($status){ $this->db->where('asset_status',$this->input->post('txtStatus'));}
		if ($employee){ $this->db->where('emp_id',$employee);}
		if ($category){ $this->db->where('category_name',$category);}
		return $this->db->get('View_assigned_assets')->result();
	}
}