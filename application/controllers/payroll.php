<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payroll extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('attendance_model');
		$this->load->model('allowance_model');
		$this->load->model('taxes_model');
		$this->load->helper('form');
		$this->load->library('validation');
	}
	
	// ------------------------------------------------------------ 
	// Attendance 
	// ------------------------------------------------------------
	
	public function attendance(){
		$data = array();
		$data['attendance'] = array();
		$data['months'] = $this->generateMonths();
		$data['years'] = $this->generateYears();
		$data['employees'] = view_job_history::all();
		$post = $this->input->post();
		if($post){
			$data['attendance'] = $this->attendance_model->generateAttendanceEmployee($post['cboEmployee'], $post['cboMonth'], $post['cboYear']);
		}
		
        $data['pageTitle'] = 'Attendance - MSInc.';
        $data['content'] = 'attendance/attendance_view';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	// ------------------------------------------------------------ 
	// Request Entry 
	// ------------------------------------------------------------
	
	public function requestentry(){
		$this->form_validation->set_rules('txtDate', 'Date Value', 'trim|required');
		$this->form_validation->set_rules('txtTimeIn', 'Time In', 'trim|required');
		$this->form_validation->set_rules('txtTimeOut', 'Time Out', 'trim|required');
		
		$data['empID'] = $this->input->get('empid');
		$data['date'] = $this->input->get('date');
		
		if ($this->form_validation->run()){
			$post = $this->input->post();
			if ($this->attendance_model->insert_requestentry($post['txtEmpID'], $post['txtDate'], $post['txtTimeIn'], $post['txtTimeOut'])){
				$this->session->set_userdata('added',1);
				redirect('payroll/attendance');
			} 
		}
		$data['pageTitle'] = 'Request Entry - MSInc.';
        $data['content'] = 'attendance/requestentry_add';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function requestentry_table(){
		$data['months'] = $this->generateMonths();
		$data['years'] = $this->generateYears();
		$data['mode'] = $this->input->get('mode')?$this->input->get('mode'):'';
		$data['post'] = $this->input->post();
		if($data['post']){
			$data['requestentry'] = $this->attendance_model->view_requestentry($data['mode'], $data['post']['cboMonth'], $data['post']['cboYear']);
		}else{
			$data['requestentry'] = $this->attendance_model->view_requestentry($data['mode']);
		}
		$data['pageTitle'] = 'View Request Entries - MSInc.';
        $data['content'] = 'attendance/requestentry_approve';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function approverequestentry(){
		$req_id = $this->input->get('req_id');
		$approve = $this->input->get('action')=='approve'?1:0;
		$this->attendance_model->approve_requestentry($req_id, 1, $approve);
		redirect('attendance/requestentry_table');
	}
	
	// ------------------------------------------------------------ 
	// Allowances
	// ------------------------------------------------------------
	
	public function allowances(){
		$data = array();
		$data['allowances'] = $this->allowance_model->view_allowances();
		$data['pageTitle'] = 'Allowances - MSInc.';
        $data['content'] = 'allowance/allowances_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function allowances_add(){
		$this->form_validation->set_rules('txtAllowanceType', 'Allowance Type', 'trim|required');
		$this->form_validation->set_rules('txtAmount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('txtPercentage', 'Percentage', 'trim|required|numeric');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			if(Allowance_model::insert_allowances($post['txtAllowanceType'], $post['txtAmount'], $post['txtPercentage'])){
				$this->session->set_userdata('added', 1);
				redirect("payroll/allowances");
			}
		}
		
		$data = array();
		$data['pageTitle'] = 'Add Allowance Type - MSInc.';
        $data['content'] = 'allowance/allowance_add';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function allowances_edit(){
		$allowanceID = $this->input->get('id');
		$this->form_validation->set_rules('txtAllowanceType', 'Allowance Type', 'trim|required');
		$this->form_validation->set_rules('txtAmount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('txtPercentage', 'Percentage', 'trim|required|numeric');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			$active = 0;
			if($post['chkStatus']) $active = 1;
			if(Allowance_model::update_allowances($post['txtAllowanceID'], $post['txtAllowanceType'], $post['txtAmount'], $post['txtPercentage'], $active)){
				$this->session->set_userdata('edited', 1);
				redirect("payroll/allowances");
			}
		}
		
		$data = array();
		$data['allowance'] = $this->allowance_model->view_allowances($allowanceID);
		$data['pageTitle'] = 'Edit Allowance Type - MSInc.';
        $data['content'] = 'allowance/allowance_edit';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	} 
	
	public function allowances_delete(){
		$get = $this->input->get();
		if($get){
			$this->allowance_model->delete_allowances($get['id']);
		}
		$this->session->set_userdata('deleted', 1);
		redirect('payroll/allowances');
	} 
	
	// ------------------------------------------------------------ 
	// Taxes
	// ------------------------------------------------------------
	
	public function taxes(){
		$data = array();
		$data['taxes'] = $this->taxes_model->view_taxes();
		$data['pageTitle'] = 'Taxes - MSInc.';
        $data['content'] = 'taxes/taxes_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function taxes_add(){
		$this->form_validation->set_rules('txtTaxType', 'Tax Type', 'trim|required');
		$this->form_validation->set_rules('txtAmount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('txtPercentage', 'Percentage', 'trim|required|numeric');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			$range_active = 0;
			if($post['chkRangeActive']) $range_active = 1;
			if(Taxes_model::insert_taxes($post['txtTaxType'], $post['txtAmount'], $post['txtPercentage'], $range_active)){
				$this->session->set_userdata('added', 1);
				redirect("payroll/taxes");
			}
		}
		
		$data = array();
		$data['pageTitle'] = 'Add Tax Type - MSInc.';
        $data['content'] = 'taxes/taxes_add';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function taxes_edit(){
		$taxID = $this->input->get('id');
		$this->form_validation->set_rules('txtTaxType', 'Tax Type', 'trim|required');
		$this->form_validation->set_rules('txtAmount', 'Amount', 'trim|required|numeric');
		$this->form_validation->set_rules('txtPercentage', 'Percentage', 'trim|required|numeric');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			$active = 0;
			if($post['chkStatus']) $active = 1;
			$range_active = 0;
			if($post['chkRangeActive']) $range_active = 1;
			if(Taxes_model::update_taxes($post['txtTaxID'], $post['txtTaxType'], $post['txtAmount'], $post['txtPercentage'], $active, $range_active)){
				$this->session->set_userdata('edited', 1);
				redirect("payroll/taxes");
			}
		}
		
		$data = array();
		$data['tax'] = $this->taxes_model->view_taxes($taxID);
		$data['pageTitle'] = 'Edit Tax Type - MSInc.';
        $data['content'] = 'taxes/taxes_edit';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	} 
	
	public function taxes_delete(){
		$get = $this->input->get();
		if($get){
			$this->taxes_model->delete_taxes($get['id']);
		}
		$this->session->set_userdata('deleted', 1);
		redirect('payroll/taxes');
	} 
	
	public function tax_range(){
		$get = $this->input->get();
		if($get){
			$data['tax'] = Taxes_model::view_taxes($get['id']);
			$data['tax_ranges'] = $this->taxes_model->view_tax_range($get['id']);
		}
		$data['pageTitle'] = 'Tax Range - MSInc.';
        $data['content'] = 'taxes/tax_range_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function tax_range_add(){
		$get = $this->input->get();
		if($get){
			$data['tax_id'] = $get['id'];
		}
		$this->form_validation->set_rules('txtAmountFrom', 'Amount from', 'trim|required|numeric');
		$this->form_validation->set_rules('txtAmountTo', 'Amount to', 'trim|required|numeric');
		$this->form_validation->set_rules('txtAmountDeducted', 'Amount deducted', 'trim|required|numeric');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			if(Taxes_model::insert_tax_range($post['txtTaxID'], $post['txtAmountFrom'], $post['txtAmountTo'], $post['txtAmountDeducted'])){
				$this->session->set_userdata('added', 1);
				redirect("payroll/tax_range?id=" . $post['txtTaxID']);
			}
		}
		
		$data['pageTitle'] = 'Add Tax Range - MSInc.';
        $data['content'] = 'taxes/tax_range_add';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function tax_range_edit(){
		$get = $this->input->get();
		$this->form_validation->set_rules('txtAmountFrom', 'Amount from', 'trim|required|numeric');
		$this->form_validation->set_rules('txtAmountTo', 'Amount to', 'trim|required|numeric');
		$this->form_validation->set_rules('txtAmountDeducted', 'Amount deducted', 'trim|required|numeric');
		
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			if(Taxes_model::update_tax_range($post['txtTaxRangeID'], $post['txtAmountFrom'], $post['txtAmountTo'], $post['txtAmountDeducted'])){
				$this->session->set_userdata('edited', 1);
				redirect("payroll/tax_range?id=" . $post['txtTaxID']);
			}
		}
		
		$data = array();
		$data['tax_range'] = Taxes_model::view_tax_range_details($get['id']);
		$data['pageTitle'] = 'Edit Tax Range - MSInc.';
        $data['content'] = 'taxes/tax_range_edit';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	} 
	
	public function tax_range_delete(){
		$get = $this->input->get();
		$tax = Taxes_model::view_tax_range_details($get['id']);
		$taxID = $tax->tax_id;
		if($get){
			$this->taxes_model->delete_tax_range($get['id']);
		}
		$this->session->set_userdata('deleted', 1);
		redirect("payroll/tax_range?id=" . $taxID);
	} 
	
	// ------------------------------------------------------------ 
	// Payroll  
	// ------------------------------------------------------------
	
	public function payroll_index(){
		$data = array();
		$data['salary_dates'] = $this->attendance_model->cutoffDates();
		$data['payslip'] = array();
		$data['post'] = $this->input->post();
		if($data['post']){
			$data['payslip'] = $this->attendance_model->retrievePayslips($data['post']['cboDate']);
		}
		$data['pageTitle'] = 'Payroll - MSInc.';
        $data['content'] = 'payroll/payroll';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function add_payslip(){
		//$this->load->helper(array('form', 'url'));
		$this->form_validation->set_rules('cboEmployee', 'Employee', 'trim|required');
		$this->form_validation->set_rules('txtPayrollDate', 'Pay Date', 'trim|required');
		$this->form_validation->set_rules('txtStartDate', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('txtEndDate', 'End Date', 'trim|required');

		$data = array();
		//$data['employees'] = $this->attendance_model->view_employees();
		$data['employees'] = view_job_history::all();
		//print_r($data['employees']);
		$data['payslip'] = array();
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			$data['record'] = $this->attendance_model->generate_payslip($post['cboEmployee'], $post['txtStartDate'], $post['txtEndDate']);
			$data['post'] = array(
				"cboEmployee"=>$post['cboEmployee'],
				"txtPayrollDate"=>$post['txtPayrollDate'],
				"txtStartDate"=>$post['txtStartDate'],
				"txtEndDate"=>$post['txtEndDate']);
			if(isset($post['btnGenerate']) and $post['hidID']!=null){
				$insert_payslip = array(
					'emp_id'=>$post['hidID'],
					'payslip_date'=>$post['hidPayDate'],
					'start_date'=>$post['hidPayStart'],
					'end_date'=>$post['hidPayEnd'],
					'monthly_rate'=>$data['record']['employee']->salary,
					'basic_salary'=>$data['record']['employee']->salary/2,
					'total_overtime'=>$data['record']['total_overtime'],
					'total_tardiness'=>$data['record']['total_tardiness'],
					'days_absent'=>$data['record']['total_absent'],
					'total_absent_amount'=>$data['record']['total_absent_amount'],
					'total_allowances'=>$data['record']['total_allowance'],
					'total_taxes'=>$data['record']['total_tax'],
					'gross_pay'=>$data['record']['gross_income'],
					'net_pay'=>$data['record']['net_income'],
					"allowances"=>$data['record']['allowances'],
					"taxes"=>$data['record']['taxes'],
					'remarks'=>"");
				$this->attendance_model->insert_payslip($insert_payslip);
				$this->session->set_userdata('added', 1);
			}
		} else {
			$data['record'] = array(
				"attendance"=>array(),
				"allowances"=>array(),
				"taxes"=>array(),
				"employee"=>array(),
				"cutoffsalary"=>0,
				"perdaysalary"=>0,
				"total"=>array(),
				"total_absent"=>0,
				"total_overtime"=>0,
				'total_tardiness'=>0,
				"total_absent_amount"=>0,
				"total_allowance"=>0,
				"total_tax"=>0,
				"net_income"=>0,
				"gross_income"=>0);
		}
		
		/*
		$data = array();
		$data['payslip'] = array();
		$data['record'] = array(
			"attendance"=>array(),
			"allowances"=>array(),
			"taxes"=>array(),
			"employee"=>array(),
			"cutoffsalary"=>0,
			"perdaysalary"=>0,
			"total"=>array(),
			"total_absent"=>0,
			"total_overtime"=>0,
			'total_tardiness'=>0,
			"total_absent_amount"=>0,
			"total_allowance"=>0,
			"total_tax"=>0,
			"net_income"=>0,
			"gross_income"=>0);
		$data['employees'] = $this->attendance_model->view_employees();
		$post = $this->input->post();
		if($post){
			//$data['payslip'] = $this->attendance_model->retrievePayslipDates($post['cboDate']);
			//$data['record'] = $this->attendance_model->generate_payslip(1, '2015-06-01', '2015-06-15');
			$data['record'] = $this->attendance_model->generate_payslip($post['cboEmployee'], $post['txtStartDate'], $post['txtEndDate']);
			//$data['post'] = $post;
			/*$data['post'] = array(
				"cboEmployee"=>1,
				"txtPayrollDate"=>'2015-06-20',
				"txtStartDate"=>'2015-06-01',
				"txtEndDate"=>'2015-06-15');/
			$data['post'] = array(
				"cboEmployee"=>$post['cboEmployee'],
				"txtPayrollDate"=>'2015-06-20',
				"txtStartDate"=>$post['txtStartDate'],
				"txtEndDate"=>$post['txtEndDate']);
			if($this->input->get('generate')){
				$insert_payslip = array(
					'emp_id'=>$post['hidID'],
					'payslip_date'=>$post['hidPayDate'],
					'start_date'=>$post['hidPayStart'],
					'end_date'=>$post['hidPayEnd'],
					'monthly_rate'=>$data['record']['employee']->salary,
					'basic_salary'=>$data['record']['employee']->salary/2,
					'total_overtime'=>$data['record']['total_overtime'],
					'total_tardiness'=>$data['record']['total_tardiness'],
					'days_absent'=>$data['record']['total_absent'],
					'total_absent_amount'=>$data['record']['total_absent_amount'],
					'total_allowances'=>$data['record']['total_allowance'],
					'total_taxes'=>$data['record']['total_tax'],
					'gross_pay'=>$data['record']['gross_income'],
					'net_pay'=>$data['record']['net_income'],
					"allowances"=>$data['record']['allowances'],
					"taxes"=>$data['record']['taxes'],
					'remarks'=>"");
				$this->attendance_model->insert_payslip($insert_payslip);
			}
		}*/
		$data['pageTitle'] = 'Generate Payslip - MSInc.';
        $data['content'] = 'payroll/generate_payslip';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function multiple_payslips(){
		//$this->output->enable_profiler(TRUE);
		$this->form_validation->set_rules('txtPayrollDate', 'Pay Date', 'trim|required');
		$this->form_validation->set_rules('txtStartDate', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('txtEndDate', 'End Date', 'trim|required');
		
		$data = array();
		$data['payslips'] = array();
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			$emp_ids = $this->attendance_model->retrieveEmployeesFromCutoff($post['txtStartDate'], $post['txtEndDate']);
			foreach($emp_ids as $id){
				//$data['payslip'] = $this->attendance_model->retrievePayslipDates($post['cboDate']);
				$data['record'] = $this->attendance_model->generate_payslip($id->emp_id, $post['txtStartDate'], $post['txtEndDate']);
				//$data['post'] = $post;
				$data['post'] = array(
					"txtPayrollDate"=>$post['txtPayrollDate'],
					"txtStartDate"=>$post['txtStartDate'],
					"txtEndDate"=>$post['txtEndDate']);
				if(isset($post['btnGenerate'])){
					$insert_payslip = array(
						'emp_id'=>$id->emp_id,
						'payslip_date'=>$post['hidPayDate'],
						'start_date'=>$post['hidPayStart'],
						'end_date'=>$post['hidPayEnd'],
						'monthly_rate'=>$data['record']['employee']->salary,
						'basic_salary'=>$data['record']['employee']->salary/2,
						'total_overtime'=>$data['record']['total_overtime'],
						'total_tardiness'=>$data['record']['total_tardiness'],
						'days_absent'=>$data['record']['total_absent'],
						'total_absent_amount'=>$data['record']['total_absent_amount'],
						'total_allowances'=>$data['record']['total_allowance'],
						'total_taxes'=>$data['record']['total_tax'],
						'gross_pay'=>$data['record']['gross_income'],
						'net_pay'=>$data['record']['net_income'],
						"allowances"=>$data['record']['allowances'],
						"taxes"=>$data['record']['taxes'],
						'remarks'=>"");
					$this->attendance_model->insert_payslip($insert_payslip);
					$this->session->set_userdata('added', 1);
				}
				array_push($data['payslips'], $data['record']);
			}
		} else {
			$data['record'] = array(
				"attendance"=>array(),
				"allowances"=>array(),
				"taxes"=>array(),
				"employee"=>array(),
				"cutoffsalary"=>0,
				"perdaysalary"=>0,
				"total"=>array(),
				"total_absent"=>0,
				"total_overtime"=>0,
				'total_tardiness'=>0,
				"total_absent_amount"=>0,
				"total_allowance"=>0,
				"total_tax"=>0,
				"net_income"=>0,
				"gross_income"=>0);
		}
		
		/*
		$post = $this->input->post();
		if($post){
			$emp_ids = $this->attendance_model->retrieveEmployeesFromCutoff('2015-06-01', '2015-06-15');
			foreach($emp_ids as $id){
				//$data['payslip'] = $this->attendance_model->retrievePayslipDates($post['cboDate']);
				$data['record'] = $this->attendance_model->generate_payslip($id->emp_id, '2015-06-01', '2015-06-15');
				//$data['post'] = $post;
				$data['post'] = array(
					"cboEmployee"=>1,
					"txtPayrollDate"=>'2015-06-20',
					"txtStartDate"=>'2015-06-01',
					"txtEndDate"=>'2015-06-15');
				if(isset($post('btnGenerate'))){
					$insert_payslip = array(
						'emp_id'=>$id->emp_id,
						'payslip_date'=>$post['hidPayDate'],
						'start_date'=>$post['hidPayStart'],
						'end_date'=>$post['hidPayEnd'],
						'monthly_rate'=>$data['record']['employee']->salary,
						'basic_salary'=>$data['record']['employee']->salary/2,
						'total_overtime'=>$data['record']['total_overtime'],
						'total_tardiness'=>$data['record']['total_tardiness'],
						'days_absent'=>$data['record']['total_absent'],
						'total_absent_amount'=>$data['record']['total_absent_amount'],
						'total_allowances'=>$data['record']['total_allowance'],
						'total_taxes'=>$data['record']['total_tax'],
						'gross_pay'=>$data['record']['gross_income'],
						'net_pay'=>$data['record']['net_income'],
						"allowances"=>$data['record']['allowances'],
						"taxes"=>$data['record']['taxes'],
						'remarks'=>"");
					$this->attendance_model->insert_payslip($insert_payslip);
				}
				array_push($data['payslips'], $data['record']);
			}
		}*/
		$data['pageTitle'] = 'Add Multiple Payslips - MSInc.';
        $data['content'] = 'payroll/multiple_payslips';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function print_payslip(){
		$payslip_id = $this->input->get('id');
		$data['record'] = $this->attendance_model->getPayslipDetails($payslip_id);
		
		$data['pageTitle'] = 'Payslip Details - MSInc.';
        $this->load->view('payroll/print_payslip', $data);
	}
	
	public function delete_payslip(){
		$get = $this->input->get();
		if($get){
			$this->attendance_model->delete_payslip($get['id']);
		}
		redirect('attendance/payroll');
	}
	
	// ------------------------------------------------------------ 
	// Common 
	// ------------------------------------------------------------
	
}

?>