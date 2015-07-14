<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Attendance extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('attendance_model');
		$this->load->helper('form');
		$this->load->library('validation');
	}
	
	// ------------------------------------------------------------ 
	// Attendance 
	// ------------------------------------------------------------
	
	public function index(){
		$this->display_navbar('Attendance - MSInc.');
		$this->load->view('components/sidebar_admin');
		$data = array();
		$data['attendance'] = array();
		$data['months'] = $this->generateMonths();
		$data['years'] = $this->generateYears();
		$data['employees'] = $this->attendance_model->view_employees();
		$post = $this->input->post();
		if($post){
			$data['attendance'] = $this->attendance_model->generateAttendance($post['cboEmployee'], $post['cboMonth'], $post['cboYear']);
		}
		
		$this->load->view('attendance/attendance_view', $data);
    	$this->load->view('components/footer');
	}
	
	public function removeattendance(){
		$id = $this->input->get('empid');
		$date = $this->input->get('date');
		$this->attendance_model->delete_attendance($id, $date);
		$this->session->set_userdata('deleted',1);
		redirect('attendance/index');
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
				redirect('attendance/index');
			} 
		}
		
		$this->load->view('components/sidebar_admin');
		$this->display_navbar('Request Entry - MSInc.');
		$this->load->view('attendance/requestentry_add', $data);
    	$this->load->view('components/footer');
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
		
		$this->display_navbar('View Request Entry - MSInc.');
		$this->load->view('components/sidebar_admin');
		$this->load->view('attendance/requestentry_approve', $data);
    	$this->load->view('components/footer');
	}
	
	public function approverequestentry(){
		$req_id = $this->input->get('req_id');
		$approve = $this->input->get('action')=='approve'?1:0;
		$this->attendance_model->approve_requestentry($req_id, 1, $approve);
		redirect('attendance/requestentry_table');
	}
	
	// ------------------------------------------------------------ 
	// Payroll  
	// ------------------------------------------------------------
	
	public function payroll(){
		$this->display_navbar('Payroll - MSInc.');
		$this->load->view('components/sidebar_admin');
		$data = array();
		$data['salary_dates'] = $this->attendance_model->cutoffDates();
		$data['payslip'] = array();
		$data['post'] = $this->input->post();
		if($data['post']){
			$data['payslip'] = $this->attendance_model->retrievePayslips($data['post']['cboDate']);
		}
		
		$this->load->view('payroll/payroll', $data);
    	$this->load->view('components/footer');
	}
	
	public function add_payslip(){
		$this->display_navbar('Add Payslip - MSInc.');
		$this->load->view('components/sidebar_admin');
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
			$data['record'] = $this->attendance_model->generate_payslip(1, '2015-06-01', '2015-06-15');
			//$data['post'] = $post;
			$data['post'] = array(
				"cboEmployee"=>1,
				"txtPayrollDate"=>'2015-06-20',
				"txtStartDate"=>'2015-06-01',
				"txtEndDate"=>'2015-06-15');
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
		}
		$this->load->view('payroll/generate_payslip', $data);
    	$this->load->view('components/footer');
	}
	
	public function multiple_payslips(){
		$this->display_navbar('Add Multiple Payslips - MSInc.');
		$this->load->view('components/sidebar_admin');
		$data = array();
		$data['payslips'] = array();
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
				if($this->input->get('generate')){
					$insert_payslip = array(
						'emp_id'=>$id->emp_id,
						'payslip_date'=>$post['hidPayDate'],
						'start_date'=>$post['hidPayStart'],
						'end_date'=>$post['hidPayEnd'],
						'monthly_rate'=>$data['record']['employee']->salary,
						'basic_salary'=>$data['record']['employee']->salary/2,
						'total_overtime'=>$data['record']['total_overtime'],
						'total_tardiness'=>$data['record']['total_tardiness'],
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
		}
		$this->load->view('payroll/multiple_payslips', $data);
    	$this->load->view('components/footer');
	}
	
	public function print_payslip(){
		$data['pageTitle'] = "Payslip Details - MSInc.";
		$payslip_id = $this->input->get('id');
		$data['record'] = $this->attendance_model->getPayslipDetails($payslip_id);
		
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
	
	public function display_navbar($title){
		//$logged = $this->is_logged_in();
		$logged = false;
		$data['pageTitle'] = $title;
		$this->load->view('init', $data);
		if($this->session->userdata('logged_in')==true){
			$data['user_level'] = $this->session->userdata('user_level');
			$data['firstname']  = $this->session->userdata('first_name');
			$data['lastname']  = $this->session->userdata('last_name');
			$data['profile_image'] = $this->session->userdata('image');
			$this->load->view('components/navbar_logged', $data);
			$this->load->view('components/sidebar_admin', $data);
			$this->load->model('Employees_model');
		} else {
			$this->load->view('components/navbar', $data);
		}
	}
	
	public function generateMonths(){
		$months = array();
		array_push($months, array("id"=>"01", "value"=>"January"));
		array_push($months, array("id"=>"02", "value"=>"February"));
		array_push($months, array("id"=>"03", "value"=>"March"));
		array_push($months, array("id"=>"04", "value"=>"April"));
		array_push($months, array("id"=>"05", "value"=>"May"));
		array_push($months, array("id"=>"06", "value"=>"June"));
		array_push($months, array("id"=>"07", "value"=>"July"));
		array_push($months, array("id"=>"08", "value"=>"August"));
		array_push($months, array("id"=>"09", "value"=>"September"));
		array_push($months, array("id"=>"10", "value"=>"October"));
		array_push($months, array("id"=>"11", "value"=>"November"));
		array_push($months, array("id"=>"12", "value"=>"December"));
		return $months;
	}
	
	public function generateYears($order = 'asc'){
		$years = array();
		if($order=='asc'){
			$yearStart = 1970;
			$yearEnd = date("Y");
			for($year=$yearEnd; $year>=intval($yearStart); $year--){
				array_push($years, $year);
			}
		}else if($order=='desc'){
			$yearStart = date("Y");
			$yearEnd = 1970;
			for($year=$yearEnd; $year<=intval($yearStart); $year++){
				array_push($years, $year);
			}
		}
		return $years;
	}
	
}

?>