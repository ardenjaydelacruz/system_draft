<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payroll extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('attendance_model');
		$this->load->model('allowance_model');
		$this->load->model('taxes_model');
		$this->load->helper('form');
		$this->load->library('validation');
		$this->load->library('csvreader');
	}
	
	// ------------------------------------------------------------ 
	// Attendance 
	// ------------------------------------------------------------
	
	public function attendance(){
		$data = array();
		$data['attendance'] = array();
		$data['months'] = $this->generateMonths();
		$data['years'] = $this->generateYears();
		$data['employees'] = View_job_history::all();
		$data['post'] = $this->input->post();
		if($data['post']){
			$data['attendance'] = $this->attendance_model->generateAttendanceEmployee($data['post']['cboEmployee'], $data['post']['cboMonth'], $data['post']['cboYear']);
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
		$this->form_validation->set_rules('txtRemarks', 'Remarks', 'trim|required');
		
		if($this->input->get('empid')){
			$data['empID'] = $this->input->get('empid');
		}else{
			$data['empID'] = $this->session->userdata('employee_id');
		}
		$data['date'] = $this->input->get('date');
		
		if ($this->form_validation->run()){
			$post = $this->input->post();
			if ($this->attendance_model->insert_requestentry($post['txtEmpID'], $post['txtDate'], $post['txtTimeIn'], $post['txtTimeOut'], $_POST['txtRemarks'])){
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
		$this->attendance_model->approve_requestentry($req_id, $this->session->userdata('employee_id'), $approve);
		redirect('payroll/requestentry_table');
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
		
		$get = $this->input->get();
		if($get){
			$this->taxes_model->delete_taxes($get['id']);
		}
		$this->session->set_userdata('deleted', 1);
		redirect('payroll/taxes');
	} 
	
	// ------------------------------------------------------------ 
	// Payroll  
	// ------------------------------------------------------------
	
	public function payroll_index(){
		$data = array();
		$data['payslip'] = array();
		$data['post'] = $this->input->post();
	if ($this->session->userdata('user_level') == 'Administrator' or $this->session->userdata('user_level') == 'Finance Manager') {
			$data['salary_dates'] = $this->attendance_model->cutoffDates();
            if($data['post']){
				$data['payslip'] = $this->attendance_model->retrievePayslips($data['post']['cboDate']);
			}
        }else{
			$data['salary_dates'] = $this->attendance_model->cutoffDates($this->session->userdata('employee_id'));
			if($data['post']){
				$data['payslip'] = $this->attendance_model->retrieveEmployeePayslips($this->session->userdata('employee_id'));
			}else{
				$data['payslip'] = $this->attendance_model->retrieveEmployeePayslips($this->session->userdata('employee_id'), $data['post']['cboDate']);
			}
		}
		//print_r($this->session);
		$data['pageTitle'] = 'Payroll - MSInc.';
        $data['content'] = 'payroll/payroll';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function add_payslip(){
		$this->form_validation->set_rules('cboEmployee', 'Employee', 'trim|required');
		$this->form_validation->set_rules('txtPayrollDate', 'Pay Date', 'trim|required');
		$this->form_validation->set_rules('txtStartDate', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('txtEndDate', 'End Date', 'trim|required');

		$data = array();
		$data['employees'] = View_job_history::all();
		$data['payslip'] = array();
		if ($this->form_validation->run()) {
			$post = $this->input->post();
			if(isset($post['btnGenerate']) and isset($post['hidID1'])){
				$allowances_count = $post['hidAllowanceCount1'];
				$allowances = array();
				for($ctr=1;$ctr<=$allowances_count;$ctr++){
					if(isset($post['chkAllowance1-' . $ctr])){
						array_push($allowances, array(
							'allowance_id'=>$post['hidAllowanceID1-' . $ctr],
							'percentage'=>$post['hidAllowancePercentage1-' . $ctr],
							'computation'=>$post['hidAllowanceComputation1-' . $ctr],
							'amount'=>$post['hidAllowanceAmount1-' . $ctr],
							'total'=>$post['txtAllowanceTotal1-' . $ctr]));
					}
				}
				$taxes_count = $post['hidTaxCount1'];
				$taxes = array();
				for($ctr=1;$ctr<=$taxes_count;$ctr++){
					if(isset($post['chkTax1-' . $ctr])){
						array_push($taxes, array(
							'tax_id'=>$post['hidTaxID1-' . $ctr],
							'percentage'=>isset($post['hidTaxPercentage1' . $ctr])?$post['hidTaxPercentage1-' . $ctr]:0,
							'computation'=>isset($post['hidTaxComputation1' . $ctr])?$post['hidTaxComputation1-' . $ctr]:0,
							'amount'=>isset($post['hidTaxAmount1' . $ctr])?$post['hidTaxAmount1-' . $ctr]:0,
							'total'=>$post['txtTaxTotal1-' . $ctr]));
					}
				}
				$insert_payslip = array(
					'emp_id'=>$post['hidID1'],
					'payslip_date'=>$post['hidPayDate'],
					'start_date'=>$post['hidPayStart'],
					'end_date'=>$post['hidPayEnd'],
					'monthly_rate'=>$post['hidMonthlyRate1'],
					'basic_salary'=>$post['hidBasicSalary1'],
					'total_overtime'=>$post['hidTotalOvertime1'],
					'total_tardiness'=>$post['hidTotalTardiness1'],
					'days_absent'=>$post['hidTotalAbsent1'],
					'total_absent_amount'=>$post['hidTotalAbsentAmount1'],
					'total_allowances'=>$post['hidTotalAllowance1'],
					'total_taxes'=>$post['hidTotalTax1'],
					'gross_pay'=>$post['hidGrossIncome1'],
					'net_pay'=>$post['hidNetIncome1'],
					"allowances"=>$allowances,
					"taxes"=>$taxes,
					'remarks'=>"");
				$this->attendance_model->insert_payslip($insert_payslip);
				//print_r($insert_payslip);
				$this->session->set_userdata('added', 1);
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
			}else{
				$data['record'] = $this->attendance_model->generate_payslip($post['cboEmployee'], $post['txtStartDate'], $post['txtEndDate']);
				$data['post'] = array(
					"cboEmployee"=>$post['cboEmployee'],
					"txtPayrollDate"=>$post['txtPayrollDate'],
					"txtStartDate"=>$post['txtStartDate'],
					"txtEndDate"=>$post['txtEndDate']);
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
		$data['pageTitle'] = 'Generate Payslip - MSInc.';
        $data['content'] = 'payroll/generate_payslip';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	public function save_payslip(){
		$data = array();
		$data['employees'] = View_job_history::all();
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
			if(isset($post['btnGenerate'])){
				$employee_count = $post["hidTotalEmp"];
				$data['post'] = array(
					"txtPayrollDate"=>$post['txtPayrollDate'],
					"txtStartDate"=>$post['txtStartDate'],
					"txtEndDate"=>$post['txtEndDate']);
					
				for($empctr=1;$empctr<=$employee_count;$empctr++){
					$tempAllowance = Attendance_model::computeAllowances(Allowance_model::view_allowances(), $post['hidBasicSalary' . $empctr], 2);
					$tempTaxes = Attendance_model::computeTaxes(Taxes_model::compute_taxes($post['hidBasicSalary' . $empctr]), $post['hidBasicSalary' . $empctr], 2);
					
					$allowances = array();
					foreach($tempAllowance as $row){
						if($row->active==1){
							array_push($allowances, array(
								'allowance_id'=>$row->allowance_id,
								'percentage'=>$row->percentage,
								'computation'=>$row->computation,
								'amount'=>$row->amount,
								'total'=>$row->total));
						}
						
					}
					$taxes = array();
					foreach($tempTaxes as $row){
						if($row->active==1){
							if($row->ranges_active==1){
								array_push($taxes, array(
									'tax_id'=>$row->tax_id,
									'percentage'=>$row->percentage,
									'computation'=>$row->computation,
									'amount'=>$row->amount,
									'total'=>$row->total));
							}else{
								array_push($taxes, array(
									'tax_id'=>$row->tax_id,
									'percentage'=>0,
									'computation'=>0,
									'amount'=>0,
									'total'=>$row->total));
							}
						}
					}
					$insert_payslip = array(
						'emp_id'=>$post['hidID' . $empctr],
						'payslip_date'=>$post['hidPayDate'],
						'start_date'=>$post['hidPayStart'],
						'end_date'=>$post['hidPayEnd'],
						'monthly_rate'=>$post['hidMonthlyRate' . $empctr],
						'basic_salary'=>$post['hidBasicSalary' . $empctr],
						'total_overtime'=>$post['hidTotalOvertime' . $empctr],
						'total_tardiness'=>$post['hidTotalTardiness' . $empctr],
						'days_absent'=>$post['hidTotalAbsent' . $empctr],
						'total_absent_amount'=>$post['hidTotalAbsentAmount' . $empctr],
						'total_allowances'=>$post['hidTotalAllowance' . $empctr],
						'total_taxes'=>$post['hidTotalTax' . $empctr],
						'gross_pay'=>$post['hidGrossIncome' . $empctr],
						'net_pay'=>$post['hidNetIncome' . $empctr],
						"allowances"=>$allowances,
						"taxes"=>$taxes,
						'remarks'=>"");
					$this->attendance_model->insert_payslip($insert_payslip);
					//print_r($insert_payslip);
					$this->session->set_userdata('added', 1);
				}
			}else{
				$emp_ids = $this->attendance_model->retrieveEmployeesFromCutoff($post['txtStartDate'], $post['txtEndDate']);
				foreach($emp_ids as $id){
					//$data['payslip'] = $this->attendance_model->retrievePayslipDates($post['cboDate']);
					$data['record'] = $this->attendance_model->generate_payslip($id->emp_id, $post['txtStartDate'], $post['txtEndDate']);
					//$data['post'] = $post;
					$data['post'] = array(
						"txtPayrollDate"=>$post['txtPayrollDate'],
						"txtStartDate"=>$post['txtStartDate'],
						"txtEndDate"=>$post['txtEndDate']);
					/*if(isset($post['btnGenerate'])){
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
					}*/
					array_push($data['payslips'], $data['record']);
				}
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
        $this->load->view('admin/payroll/print_payslip', $data);
	}
	
	public function delete_payslip(){
		$get = $this->input->get();
		if($get){
			$this->attendance_model->delete_payslip($get['id']);
		}
		redirect('attendance/payroll');
	}
	
	public function attendance_upload(){
		$config = array(
			'allowed_types' => 'csv',
			'upload_path' => 'assets/csv/',
			'overwrite' => TRUE
		);
		$this->load->library('csvreader');
		$this->load->library('upload',$config);
		$data['post'] = $this->input->post();
		if($data['post']){
			if(isset($data['post']['btnUpload'])){
				if (!$this->upload->do_upload()) {
					$data['error'] =  $this->upload->display_errors(); 
				}
				$data['csv'] = $this->upload->data();
				$result = $this->csvreader->parse_file($data['csv']['full_path']);

				$data['csvData'] = $result;
			}else if(isset($data['post']['btnSave'])){
				$result = $this->csvreader->parse_file($data['post']['hidPath']);
				Attendance_model::upload_attendance($result);
				$this->session->set_userdata('added',1);
				redirect('payroll/attendance');
			}
		}
		
		$data['pageTitle'] = 'Upload Attendance - MSInc.';
        $data['content'] = 'attendance/attendance_upload';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
	}
	
	// ------------------------------------------------------------ 
	// Common 
	// ------------------------------------------------------------
	
}

?>