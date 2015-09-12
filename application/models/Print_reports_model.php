<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Print_reports_model extends CI_Model {
	public function __construct(){
		parent::__construct();
		$this->load->library('pdf'); // Load library
	}

	public function pdf_header($title, $orientation='P'){
		$this->pdf->AddPage($orientation);
		$this->pdf->SetMargins(15,15,15);
		$this->pdf->setDisplayMode ('fullpage');
		$this->pdf->Image('assets/images/logo.png',15,10,30);
		$this->pdf->SetX('47');
		$this->pdf->setFont ('Arial','B',15);
		$this->pdf->cell(0,7,"Multistyle Specialist Inc.",0,0);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->cell(0,8,"Date: ".date("m-d-Y"),0,1,'R');
		$this->pdf->SetX('47');
		$this->pdf->SetFont('Arial','I',11);
		$this->pdf->cell(0,5,"Address: 577 Jenny's Avenue, Maybunga, Pasig City",0,1);
		$this->pdf->SetX('47');
		$this->pdf->cell(0,5,"Contact Number: 223132323",0,1);
		$this->pdf->SetY('30');
		$this->pdf->Cell(0,0,'','T'); 
		$this->pdf->Ln(); // header

		$this->pdf->setFont ('Arial','B',18);
		$this->pdf->cell(0,20,$title,0,0,'C');
		$this->pdf->Ln(); // title
	}
	public function pdf_employees_list($data){
		$this->pdf_header('Employees List','L');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetFillColor(232,232,255);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(20,6,'ID',1,0,'C',1);
		$this->pdf->Cell(60,6,'Employee Name',1,0,'C',1);
		$this->pdf->Cell(40,6,'Job Title',1,0,'C',1);
		$this->pdf->Cell(30,6,'Department',1,0,'C',1);
		$this->pdf->Cell(40,6,'Emp Type',1,0,'C',1);
		$this->pdf->Cell(30,6,'Status',1,0,'C',1);
		$this->pdf->Cell(30,6,'Date Hired',1,1,'C',1);
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(224,235,255);
		    $this->pdf->Cell(20,6,$row->emp_id,'LR',0,'C',$fill);
		    $this->pdf->Cell(60,6,$row->first_name.' '.$row->middle_name.' '.$row->last_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(40,6,$row->job_title_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(30,6,$row->department_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(40,6,$row->employment_type,'LR',0,'L',$fill);
		    $this->pdf->Cell(30,6,$row->status,'LR',0,'L',$fill);
		    $this->pdf->Cell(30,6,$row->start_date,'LR',0,'C',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(250,0,'','T'); //closing lines
    	$this->pdf -> output ('employees_list.pdf','I');
	}
	public function pdf_project_workers($data){
		$this->pdf_header('Projects Personnel Report');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(10);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(40,6,'Project ID',1,0,'C',1);
		$this->pdf->Cell(50,6,'Project Name',1,0,'C',1);
		$this->pdf->Cell(50,6,'Employee Name',1,0,'C',1);
		$this->pdf->Cell(45,6,'Assigned Date',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
		    $this->pdf->Cell(40,6,$row->project_id,'LR',0,'C',$fill);
		    $this->pdf->Cell(50,6,$row->project_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(50,6,$row->name,'LR',0,'L',$fill);
		    $this->pdf->Cell(45,6,$row->assigned_date,'LR',0,'L',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(185,0,'','T'); //closing lines
    $this->pdf -> output ('project_workers.pdf','I');
	}
	public function pdf_leave_list($data){
		$this->pdf_header('Leave Report');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(65,6,'Employee Name',1,0,'C',1);
		$this->pdf->Cell(40,6,'Sick',1,0,'C',1);
		$this->pdf->Cell(40,6,'Vacation',1,0,'C',1);
		$this->pdf->Cell(40,6,'Total',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
		    $this->pdf->Cell(65,6,$row->name,'LR',0,'L',$fill);
		    $this->pdf->Cell(40,6,$row->SL,'LR',0,'C',$fill);
		    $this->pdf->Cell(40,6,$row->VL,'LR',0,'C',$fill);
		    $this->pdf->Cell(40,6,$row->SL+$row->VL,'LR',0,'C',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(185,0,'','T'); //closing lines
    $this->pdf -> output ('Leave_report.pdf','I');
	}
	public function pdf_inventory_list($data){
		$this->pdf_header('Inventory Report');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(20,6,'Item ID',1,0,'C',1);
		$this->pdf->Cell(50,6,'Item Name',1,0,'C',1);
		$this->pdf->Cell(50,6,'Category',1,0,'C',1);
		$this->pdf->Cell(30,6,'Quantity',1,0,'C',1);
		$this->pdf->Cell(35,6,'Price/pc.',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
				$this->pdf->Cell(20,6,$row->item_id,'LR',0,'C',$fill);
		    $this->pdf->Cell(50,6,$row->item_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(50,6,$row->category_name,'LR',0,'C',$fill);
		    $this->pdf->Cell(30,6,$row->quantity,'LR',0,'C',$fill);
		    $this->pdf->Cell(35,6,$row->price,'LR',0,'C',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(185,0,'','T'); //closing lines
    $this->pdf -> output ('Inventory_report.pdf','I');
	}
	public function pdf_asset_list($data){
		$this->pdf_header('Assigned Asset Report');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(20,6,'Asset ID',1,0,'C',1);
		$this->pdf->Cell(50,6,'Asset Name',1,0,'C',1);
		$this->pdf->Cell(35,6,'Category',1,0,'C',1);
		$this->pdf->Cell(30,6,'Status',1,0,'C',1);
		$this->pdf->Cell(50,6,'Assigned Employee',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
				$this->pdf->Cell(20,6,$row->asset_id,'LR',0,'C',$fill);
		    $this->pdf->Cell(50,6,$row->asset_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(35,6,$row->category_name,'LR',0,'C',$fill);
		    $this->pdf->Cell(30,6,$row->asset_status,'LR',0,'C',$fill);
		    $this->pdf->Cell(50,6,$row->name,'LR',0,'L',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(185,0,'','T'); //closing lines
    $this->pdf -> output ('Inventory_report.pdf','I');
	}
	public function pdf_material_list($data){
		$this->pdf_header('Materials Report');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(20,6,'Item ID',1,0,'C',1);
		$this->pdf->Cell(35,6,'Item Name',1,0,'C',1);
		$this->pdf->Cell(20,6,'Quantity',1,0,'C',1);
		$this->pdf->Cell(20,6,'Price',1,0,'C',1);
		$this->pdf->Cell(20,6,'Total Price',1,0,'C',1);
		$this->pdf->Cell(45,6,'Project Name',1,0,'C',1);
		$this->pdf->Cell(25,6,'Date Issued',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
			$this->pdf->Cell(20,6,$row->item_id,'LR',0,'C',$fill);
			$this->pdf->Cell(35,6,$row->item_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(20,6,$row->quantity,'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,$row->price,'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,($row->quantity*$row->price),'LR',0,'C',$fill);
		    $this->pdf->Cell(45,6,$row->project_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(25,6,$row->date_issued,'LR',0,'L',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(185,0,'','T'); //closing lines
    $this->pdf -> output ('Inventory_report.pdf','I');
	}
	public function pdf_attendance_daily($data){
		$this->pdf_header('Attendance Report', 'L');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(5,6,'#',1,0,'C',1);
		$this->pdf->Cell(20,6,'Emp ID',1,0,'C',1);
		$this->pdf->Cell(60,6,'Employee Name',1,0,'C',1);
		$this->pdf->Cell(55,6,'Position',1,0,'C',1);
		$this->pdf->Cell(25,6,'Time In',1,0,'C',1);
		$this->pdf->Cell(25,6,'Time Out',1,0,'C',1);
		$this->pdf->Cell(20,6,'Man Hours',1,0,'C',1);
		$this->pdf->Cell(20,6,'Tardiness',1,0,'C',1);
		$this->pdf->Cell(20,6,'Overtime',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		$ctr = 1;
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
			$this->pdf->Cell(5,6,$ctr,'LR',0,'C',$fill);
			$this->pdf->Cell(20,6,$row->emp_id,'LR',0,'C',$fill);
		    $this->pdf->Cell(60,6,$row->last_name . ", " . $row->first_name . " " . $row->middle_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(55,6,$row->job_title_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(25,6,$row->time_in,'LR',0,'C',$fill);
		    $this->pdf->Cell(25,6,$row->time_out,'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,$row->man_hours,'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,$row->tardiness,'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,$row->overtime,'LR',0,'C',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
			$ctr++;
		}
		$this->pdf->Cell(250,0,'','T'); //closing lines
    $this->pdf->output('attendance-daily.pdf','I');
	}
	public function pdf_attendance_employee($data){
		$this->pdf_header('Employee Attendance Report');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(40,6,'Date',1,0,'C',1);
		$this->pdf->Cell(15,6,'Day',1,0,'C',1);
		$this->pdf->Cell(25,6,'Time In',1,0,'C',1);
		$this->pdf->Cell(25,6,'Time Out',1,0,'C',1);
		$this->pdf->Cell(30,6,'Remarks',1,0,'C',1);
		$this->pdf->Cell(20,6,'Man Hours',1,0,'C',1);
		$this->pdf->Cell(20,6,'Tardiness',1,0,'C',1);
		$this->pdf->Cell(20,6,'Overtime',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
			$this->pdf->Cell(40,6,$row->datelog,'LR',0,'C',$fill);
			$this->pdf->Cell(15,6,substr($row->weekday,0,3),'LR',0,'C',$fill);
		    $this->pdf->Cell(25,6,$row->time_in,'LR',0,'C',$fill);
		    $this->pdf->Cell(25,6,$row->time_out,'LR',0,'C',$fill);
		    $this->pdf->Cell(30,6,' ','LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,$row->man_hours,'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,$row->tardiness,'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,$row->overtime,'LR',0,'C',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(185,0,'','T'); //closing lines
    $this->pdf->output('attendance-employee.pdf','I');
	}
	public function pdf_payslip_list($data){
		$this->pdf_header('Payslip Report', 'L');
		$rec = $data;
		$row_height = 6;
		$this->pdf->SetRightMargin(15);
		$this->pdf->SetFillColor(158, 255, 158);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(5,6,'#',1,0,'C',1);
		$this->pdf->Cell(20,6,'Emp ID',1,0,'C',1);
		$this->pdf->Cell(60,6,'Employee Name',1,0,'C',1);
		$this->pdf->Cell(25,6,'Basic Salary',1,0,'C',1);
		$this->pdf->Cell(20,6,'Overtime',1,0,'C',1);
		$this->pdf->Cell(20,6,'Allowances',1,0,'C',1);
		$this->pdf->Cell(25,6,'Gross Pay',1,0,'C',1);
		$this->pdf->Cell(15,6,'Absent',1,0,'C',1);
		$this->pdf->Cell(15,6,'Tardy',1,0,'C',1);
		$this->pdf->Cell(20,6,'Taxes',1,0,'C',1);
		$this->pdf->Cell(25,6,'Net Pay',1,0,'C',1);
		$this->pdf->Ln();
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		$ctr = 1;
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(235, 235, 236);
			$this->pdf->Cell(5,6,$ctr,'LR',0,'C',$fill);
			$this->pdf->Cell(20,6,$row->emp_id,'LR',0,'C',$fill);
		    $this->pdf->Cell(60,6,$row->last_name . ", " . $row->first_name . " " . $row->middle_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(25,6,number_format($row->basic_salary, 2, ".", ","),'LR',0,'R',$fill);
		    $this->pdf->Cell(20,6,number_format($row->total_overtime, 2, ".", ","),'LR',0,'R',$fill);
		    $this->pdf->Cell(20,6,number_format($row->total_allowances, 2, ".", ","),'LR',0,'R',$fill);
		    $this->pdf->Cell(25,6,number_format($row->gross_pay, 2, ".", ","),'LR',0,'R',$fill);
		    $this->pdf->Cell(15,6,$row->days_absent,'LR',0,'C',$fill);
		    $this->pdf->Cell(15,6,number_format($row->total_tardiness, 2, ".", ","),'LR',0,'C',$fill);
		    $this->pdf->Cell(20,6,number_format($row->total_taxes, 2, ".", ","),'LR',0,'R',$fill);
		    $this->pdf->Cell(25,6,number_format($row->net_pay, 2, ".", ","),'LR',0,'R',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
			$ctr++;
		}
		$this->pdf->Cell(250,0,'','T'); //closing lines
    $this->pdf->output('payslip_list.pdf','I');
	}

}