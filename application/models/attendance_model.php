<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Attendance_model extends MY_Model {

	public function index(){
		return true;
	}

	public function view_employees(){
		return Emp_info_model::all();
	}
	
	public function get_records($query){
		$result = $this->db->query($query);
		return $result->result();
	}
	
	public function get_row($query){
		$result = $this->db->query($query);
		return $result->row();
	}
	
	// ------------------------------------------------------------ 
	// Attendance 
	// ------------------------------------------------------------
  
	public function view_attendance($empID, $date){
		$this->db->select('time_in, time_out, man_hours, tardiness, overtime');
		$this->db->where('emp_id',$empID);
		$this->db->where('logdate',$date);
		$this->db->order_by('logdate');
		$result = $this->db->get('view_attendance');
		return $result->row();
	}
	
	public function insert_attendance($empID, $date, $timein, $timeout, $sysdate=''){
		if($sysdate=='') $sysdate=date("m-d-Y H:i:s");
		$data = array(
			array(
				'emp_id'=>$empID,
				'datelog'=>$date,
				'datetimelog'=>$timein,
				'event'=>'IN',
				'datetimefetch'=>$sysdate
			),
			array(
				'emp_id'=>$empID,
				'datelog'=>$date,
				'datetimelog'=>$timein,
				'event'=>'OUT',
				'datetimefetch'=>$sysdate
			));	
		$this->db->insert_batch('tbl_attendance', $data); 
	}
	
	public function delete_attendance($empID, $date){
		$this->db->delete('tbl_attendance', array('emp_id'=>$empID, 'datelog'=>$date.' 00.00.00')); 
	}
	
	public function getAttendance($empID, $start_date, $end_date){
		$query = "SELECT IFNULL(att.emp_id, '') as emp_id, IFNULL(att.time_in, '') as time_in, IFNULL(att.time_out, '') as time_out, 
				IFNULL(att.man_hours, '') as man_hours, IFNULL(att.tardiness, '') as tardiness, IFNULL(att.overtime, '') as overtime, 
				IF(ISNULL(att.datelog) AND (DATE_FORMAT(a.date_value, '%w')!=0 AND DATE_FORMAT(a.date_value, '%w')!=6), 1, 0) as absent,
				DATE_FORMAT(a.date_value, '%Y-%m-%d') as datevalue, DAYNAME(a.date_value) as weekday, DATE_FORMAT(a.date_value, '%M %d, %Y') as datelog 
			FROM (select curdate() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY as date_value from (select 0 as a union all select 1 union all select 2 	union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as a cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as b cross join (select 0 as a union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) as c ) a
			LEFT JOIN (SELECT datelog, emp_id, time_in, time_out, man_hours, tardiness, overtime FROM view_attendance 
				WHERE datelog BETWEEN '" .$start_date . "' AND '" .$end_date . "' AND emp_id = " . $empID . ") att ON a.date_value = att.datelog  
			WHERE a.date_value BETWEEN '" .$start_date . "' AND '" .$end_date . "' ORDER BY a.date_value";
		$result = $this->db->query($query);
		return $result->result();
	}
	
	/*public function getAttendance($empID, $start_date, $end_date){
		$attendance = array();
		$start_date = new DateTime($start_date);
		$end_date = new DateTime($end_date);
		$end_date = $end_date->modify('+1 day'); 
		$period = new DatePeriod($start_date, new DateInterval('P1D'), $end_date);
		foreach($period as $date){
			$row = $this->view_attendance($empID, $date->format("m/d/Y"));
			$time_in = "";
			$time_out = "";
			$man_hours = "";
			$tardiness = "";
			$overtime = "";
			$absent = 0;
			if(count($row)!=0){
				$time_in = $row->time_in;
				$time_out = $row->time_out;
				$man_hours = $row->man_hours;
				$tardiness = ($row->tardiness>=0?$row->tardiness:"");
				$overtime = ($row->overtime>=0?$row->overtime:"");
			}else if($date->format("D")!='Sat' AND $date->format("D")!='Sun'){
				$absent = 1;
			}
			array_push($attendance, array(
				"emp_id"=>$empID,
				"datevalue"=>$date->format("Y-m-d"), 
				"datelog"=>$date->format("M d, Y"), 
				"weekday"=>$date->format("D"), 
				"time_in"=>$time_in, 
				"time_out"=>$time_out,
				"absent"=>$absent,
				"man_hours"=>$man_hours,
				"tardiness"=>$tardiness,
				"overtime"=>$overtime));
		}
		return $attendance;
	}*/
	
	public function generateAttendanceEmployee($empID, $month, $year){
		$attendance = array();
		$start_date = new DateTime("$year-$month-01");
		$end_date = new DateTime($start_date->format('Y-m-t'));
		$attendance = Attendance_model::getAttendance($empID, $start_date->format('Y-m-d'), $end_date->format('Y-m-d'));
		/*
		$end_date = $end_date->modify('+1 day'); 
		$period = new DatePeriod($start_date, new DateInterval('P1D'), $end_date);
		foreach($period as $date){
			//$row = $this->view_attendance($empID, $date->format("m/d/Y"));
			
			$this->db->select('time_in, time_out, man_hours, tardiness, overtime');
			$this->db->where('emp_id',$empID);
			$this->db->where('logdate',$date->format("m/d/Y"));
			$this->db->order_by('logdate');
			$result = $this->db->get('view_attendance');
			$row = $result->row();
		
			$time_in = "";
			$time_out = "";
			$man_hours = 0;
			$tardiness = 0;
			$overtime = 0;
			if(count($row)!=0){
				$time_in = $row->time_in;
				$time_out = $row->time_out;
				$man_hours = $row->man_hours; 
				$tardiness = $row->tardiness;
				$overtime = $row->overtime;
			}
			array_push($attendance, array(
				"emp_id"=>$empID,
				"datevalue"=>$date->format("Y-m-d"), 
				"datelog"=>$date->format("M d, Y"), 
				"weekday"=>$date->format("D"), 
				"time_in"=>$time_in, 
				"time_out"=>$time_out,
				"man_hours"=>$man_hours, 
				"tardiness"=>$tardiness,
				"overtime"=>$overtime));
		}*/
		return $attendance;
	}
	
	// ------------------------------------------------------------ 
	// Request Entry 
	// ------------------------------------------------------------
	
	public function view_requestentry($mode, $month=FALSE, $year=FALSE){
		$this->output->enable_profiler(TRUE);
		if($mode!=''){
			$this->db->where('approved', $mode=='approved'?1:0);
		}else{
			$this->db->where('approved', NULL);
		}
		if($month){
			$this->db->where("month(`date_value`)", $month);
		}
		if($year){
			$this->db->where("year(`date_value`)", $year);
		}
		$result = $this->db->get('tbl_requestentry');
		return $result->result();
	}
	
	public function insert_requestentry($empID, $date, $timein, $timeout){
		$sysdate=date("m-d-Y H:i:s");
		$data = array(
				'emp_id'=>$empID,
				'date_value'=>$date,
				'time_in'=>$timein,
				'time_out'=>$timeout,
				'date_requested'=>$sysdate
			);	
		print_r($data);
		$query = $this->db->insert('tbl_requestentry', $data); 
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_requestentry($reqID, $date, $timein, $timeout){
		$sysdate=date("m-d-Y H:i:s");
		$this->db->where('req_id', $reqID);
		$data = array(
				'date_value'=>$date,
				'time_in'=>$timein,
				'time_out'=>'OUT',
				'date_requested'=>$sysdate
			);	
		$query = $this->db->update('tbl_requestentry', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function approve_requestentry($reqID, $empID, $approve){
		$sysdate=date("m-d-Y H:i:s");
		$this->db->where('req_id', $reqID);
		$data = array (
			'approved' => $approve,
			'approved_by' => $empID,
			'date_approved' => $sysdate
			);

		$query = $this->db->update('tbl_requestentry', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function delete_requestentry($reqID){
		$this->db->delete('tbl_requestentry', array('req_id'=>$reqID)); 
	}
	
	// ------------------------------------------------------------ 
	// Payroll
	// ------------------------------------------------------------
	
	public function cutoffDates(){
		$query = "SELECT DISTINCT payslip_date, DATE_FORMAT(payslip_date, '%b %d, %Y') as payslip_date_format " .
			"FROM tbl_payslip";
		$result = $this->db->query($query);
		return $result->result();
	}
	
	public function retrieveEmployeeInfo($emp_id){
		//$this->output->enable_profiler(TRUE);
		$this->db->select('emp_id, first_name, middle_name, last_name, job_title_name, department_name, salary');
		$this->db->where('emp_id', $emp_id);
		$result = $this->db->get('view_job_history');
		return $result->row();
	}
	
	public function retrievePayslips($salary_date){
		//$this->output->enable_profiler(TRUE);
		$result = $this->db->get_where('view_payslip', array('payslip_date' => $salary_date));
		return $result->result();
	}
	
	public function getPayslipDetails($payslip_id){
		$query = "SELECT *, DATE_FORMAT(payslip_date, '%b %d, %Y') as payslip_date_format, " .
			"DATE_FORMAT(start_date, '%b %d, %Y') as start_date_format, DATE_FORMAT(end_date, '%b %d, %Y') as end_date_format " .
			"FROM tbl_payslip " .
			"WHERE payslip_id = " . $payslip_id;
		$payslip_details = $this->db->query($query);
		//$payslip_details = $this->db->get_where('tbl_payslip', array('payslip_id' => $payslip_id));
		$employee = $this->retrieveEmployeeInfo($payslip_details->row('emp_id'));
		$payslip_allowances = $this->db->get_where('view_payslip_allowances', array('payslip_id' => $payslip_id));
		$payslip_taxes = $this->db->get_where('view_payslip_taxes', array('payslip_id' => $payslip_id));
		$payslip = array(
			'employee'=>$employee,
			'payslip'=>$payslip_details->row(),
			'payslip_allowances'=>$payslip_allowances->result(),
			'payslip_taxes'=>$payslip_taxes->result());
		return $payslip;
	}
	
	public function retrieveEmployeesFromCutoff($start_date, $end_date){
		$this->db->distinct();
		$this->db->select('emp_id');
		$result = $this->db->get_where("view_attendance", "datelog BETWEEN '$start_date' AND '$end_date'");
		return $result->result();
	}
	
	public function insert_payslip($payslip){
		$data = array(
			'emp_id'=>$payslip['emp_id'],
			'payslip_date'=>$payslip['payslip_date'],
			'start_date'=>$payslip['start_date'],
			'end_date'=>$payslip['end_date'],
			'monthly_rate'=>$payslip['monthly_rate'],
			'basic_salary'=>$payslip['basic_salary'],
			'total_overtime'=>$payslip['total_overtime'],
			'total_tardiness'=>$payslip['total_tardiness'],
			'days_absent'=>$payslip['days_absent'],
			'total_absent_amount'=>$payslip['total_absent_amount'],
			'total_allowances'=>$payslip['total_allowances'],
			'total_taxes'=>$payslip['total_taxes'],
			'gross_pay'=>$payslip['gross_pay'],
			'net_pay'=>$payslip['net_pay'],
			'remarks'=>$payslip['remarks']);
		$query = $this->db->insert('tbl_payslip', $data); 
		if (!$query) {
			return false;
		}
		$payslip_id =$this->db->insert_id();
		$allowances = array();
		$taxes = array();
		foreach($payslip['allowances'] as $row){
			array_push($allowances, array(
				'payslip_id'=>$payslip_id,
				'allowance_id'=>$row->allowance_id,
				'percentage'=>$row->percentage,
				'percentage_amount'=>$row->computation,
				'fixed_amount'=>$row->amount,
				'total'=>$row->total));
		}
		foreach($payslip['taxes'] as $row){
			array_push($taxes, array(
				'payslip_id'=>$payslip_id,
				'tax_id'=>$row->tax_id,
				'percentage'=>$row->percentage,
				'percentage_amount'=>$row->computation,
				'fixed_amount'=>$row->amount,
				'total'=>$row->total));
		}
		$this->db->insert_batch('tbl_payslip_allowances', $allowances);
		$this->db->insert_batch('tbl_payslip_taxes', $taxes);
	}
	
	public function delete_payslip($payslip_id){
		$this->db->where('payslip_id', $payslip_id);
		$this->db->delete('tbl_payslip_allowances'); 
		$this->db->where('payslip_id', $payslip_id);
		$this->db->delete('tbl_payslip_taxes'); 
		$this->db->where('payslip_id', $payslip_id);
		$this->db->delete('tbl_payslip'); 
	}
	
	public function retrieveTotalHours($emp_id, $start_date, $end_date){
		//$start_date = '2015-06-01';
		//$end_date = '2015-06-15';
		$query = "SELECT fn_getTotalManHours(1, '$start_date', '$end_date') as manhours, " .
					"fn_getTotalTardiness(1, '$start_date', '$end_date') as tardiness, " .
					"fn_getTotalOvertime(1, '$start_date', '$end_date') as overtime
				FROM dual";
		$result = $this->db->query($query);
		return $result->row();
	}
	
	public function generate_payslip($empid, $start_date, $end_date){
		$data['employee'] = $this->retrieveEmployeeInfo($empid);
		$data['cutoffsalary'] = $data['employee']->salary/2;
		$data['perdaysalary'] = ($data['employee']->salary*12)/261;
		$data['perhoursalary'] = $data['perdaysalary']/8;
		
		$data['attendance'] = $this->getAttendance($empid, $start_date, $end_date);
		$data['allowances'] = $this->computeAllowances(Allowance_model::view_allowances(), $data['cutoffsalary']);
		$data['total']  = $this->retrieveTotalHours($empid, $start_date, $end_date);
		
		$data['total_absent'] = $this->totalAbsent($data['attendance']);
		$data['total_overtime'] = $data['total']->overtime*($data['perhoursalary']*1.25);
		$data['total_tardiness'] = $data['total']->tardiness*($data['perhoursalary']*1.25);
		$data['total_absent_amount'] = $data['total_absent'] * $data['perdaysalary'];
		$data['total_allowance'] = $this->totalAmount($data['allowances']);
		$data['gross_income'] = $data['cutoffsalary'] + $data['total_allowance'] + $data['total_overtime'] - $data['total_absent_amount'] - $data['total_tardiness'];
		
		$data['taxes'] = $this->computeTaxes(Taxes_model::view_taxes(), $data['gross_income']);
		
		$data['total_tax'] = $this->totalAmount($data['taxes']);
		
		$data['net_income'] = $data['gross_income'] - $data['total_tax'];
		$records = array(
			"attendance"=>$data['attendance'],
			"allowances"=>$data['allowances'],
			"taxes"=>$data['taxes'],
			"employee"=>$data['employee'],
			"cutoffsalary"=>$data['cutoffsalary'],
			"perdaysalary"=>$data['perdaysalary'],
			"total"=>$data['total'],
			"total_absent"=>$data['total_absent'],
			"total_overtime"=>$data['total_overtime'],
			"total_tardiness"=>$data['total_tardiness'],
			"total_absent_amount"=>$data['total_absent_amount'],
			"total_allowance"=>$data['total_allowance'],
			"total_tax"=>$data['total_tax'],
			"net_income"=>$data['net_income'],
			"gross_income"=>$data['gross_income']);
			
		return $records;
	}
	
	public function computeAllowances($allowances, $cutoffsalary){
		for($ctr=0; $ctr<=count($allowances)-1; $ctr++){
			$allowances[$ctr]->computation = $allowances[$ctr]->percentage*$cutoffsalary;
			$allowances[$ctr]->total = $allowances[$ctr]->computation + $allowances[$ctr]->amount;
		}
		return $allowances;
	}
	
	public function computeTaxes($taxes, $gross_salary){
		for($ctr=0; $ctr<=count($taxes)-1; $ctr++){
			$taxes[$ctr]->computation = $taxes[$ctr]->percentage*$gross_salary;
			$taxes[$ctr]->total = $taxes[$ctr]->computation + $taxes[$ctr]->amount;
		}
		return $taxes;
	}
	
	public function totalAmount($data){
		$total = 0;
		foreach($data as $row){
			$total += $row->total;
		}
		return $total;
	}
	
	public function totalAbsent($attendance){
		$total = 0;
		foreach($attendance as $row){
			$total += $row->absent;
		}
		return $total;
	}
 
}
?>