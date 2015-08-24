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
		$employee = $this->input->post('txtEmployee');
		if ($employee){ $this->db->where('emp_id',$employee);}
		return $this->db->get('view_leave_left')->result();
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

	public function getMaterial(){
		$project = $this->input->post('txtProject');
		if ($project){ $this->db->where('project_id',$project);}
		return $this->db->get('view_materials')->result();
	}

	public function generateAttendanceDaily($date){
		$this->db->select('emp_id, first_name, middle_name, last_name, job_title_name, time_in, time_out, man_hours, tardiness, overtime');
		$this->db->where('datelog', $date);
		$this->db->order_by('last_name, first_name');
		return $this->db->get('view_attendance')->result();
	}
	
	public function getPayslipDetails($payslip_id){
		$query = "SELECT *, DATE_FORMAT(payslip_date, '%b %d, %Y') as payslip_date_format, " .
			"DATE_FORMAT(start_date, '%b %d, %Y') as start_date_format, DATE_FORMAT(end_date, '%b %d, %Y') as end_date_format " .
			"FROM tbl_payslip " .
			"WHERE payslip_id = " . $payslip_id;
		$payslip_details = $this->db->query($query);
		//$payslip_details = $this->db->get_where('tbl_payslip', array('payslip_id' => $payslip_id));
		//$employee = $this->retrieveEmployeeInfo($payslip_details->row('emp_id'));
		$employee = View_employee_info::find($payslip_details->row('emp_id'));
		$payslip_allowances = $this->db->get_where('view_payslip_allowances', array('payslip_id' => $payslip_id));
		$payslip_taxes = $this->db->get_where('view_payslip_taxes', array('payslip_id' => $payslip_id));
		$payslip = array(
			'employee'=>$employee,
			'payslip'=>$payslip_details->row(),
			'payslip_allowances'=>$payslip_allowances->result(),
			'payslip_taxes'=>$payslip_taxes->result());
		return $payslip;
	}
}