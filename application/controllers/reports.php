<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends MY_Controller {
	public function __construct() {
		parent:: __construct();
		$this->load->library('pdf'); // Load library
		if ($this->session->userdata('logged_in') == false) {
            redirect('msi/login');
        }
	}

	public function print_employees_list($data){
		$this->pdf->AddPage();
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
		$this->pdf->cell(0,20,"Employees List",0,0,'C');
		$this->pdf->Ln(); // title

		$rec = $data;
		$row_height = 6;
		$this->pdf->SetFillColor(232,232,255);
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10,6,'ID',1,0,'C',1);
		$this->pdf->Cell(43,6,'Employee Name',1,0,'C',1);
		$this->pdf->Cell(35,6,'Job Title',1,0,'C',1);
		$this->pdf->Cell(30,6,'Department',1,0,'C',1);
		$this->pdf->Cell(27,6,'Emp Type',1,0,'C',1);
		$this->pdf->Cell(18,6,'Status',1,0,'C',1);
		$this->pdf->Cell(22,6,'Date Hired',1,1,'C',1);
		$fill = false;
		$this->pdf->SetFont('Arial','',10);
		foreach ($rec as $row) {
			$this->pdf->SetFillColor(224,235,255);
		    $this->pdf->Cell(10,6,$row->emp_id,'LR',0,'C',$fill);
		    $this->pdf->Cell(43,6,$row->first_name.' '.$row->middle_name.' '.$row->last_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(35,6,$row->job_title_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(30,6,$row->department_name,'LR',0,'L',$fill);
		    $this->pdf->Cell(27,6,$row->employment_type,'LR',0,'L',$fill);
		    $this->pdf->Cell(18,6,$row->status,'LR',0,'L',$fill);
		    $this->pdf->Cell(22,6,$row->start_date,'LR',0,'C',$fill);
		    $this->pdf->Ln();
			$fill = !$fill;
		}
		$this->pdf->Cell(185,0,'','T'); //closing lines
	  
    	$this->pdf -> output ('your_file_pdf.pdf','I');     
    }

	public function employees_list(){
		$num = 0;
		if ($this->input->post('btnFilter') ){
			$data['report'] =  $this->reports_model->filterEmployee();
			$num = count($data['report']);

		}
		if ($this->input->post('btnPrint')){
			$emp =  $this->reports_model->filterEmployee();
			$this->print_employees_list($emp);
		}
		$data['departments'] = Departments_model::all();
		$data['employment_type'] = Employment_type_model::all();
		$data['job_titles'] = Job_titles_model::all();
        $data['employees'] = View_employees_list::all();
        $data['pageTitle'] = 'Employees Reports - MSInc.';
        $data['content'] = 'reports/employees_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}

	public function projects_list(){
		$num = 0;
		if ($this->input->post('btnFilter')){
			$data['project'] =  $this->reports_model->filterProject();
			$num = count($data['project']);
		} 
		$data ['client'] = Clients_model::all();
		$data['pageTitle'] = 'Projects Report - MSInc.';
        $data['content'] = 'reports/projects_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}

	public function project_workers(){
		$num = 0;
		if ($this->input->post('btnFilter')){
			$data['project'] =  $this->reports_model->getProjectWorkers();
			$num = count($data['project']);
		} 
		$data['projectName'] = Projects_model::all();
		$data['employee'] = View_employees_list::all();
		$data['pageTitle'] = 'Projects Report - MSInc.';
        $data['content'] = 'reports/project_workers';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}

	public function leave_list(){
		$num = 0;
		if ($this->input->post('btnFilter')){
			$data['leaves'] =  $this->reports_model->getLeavesLeft();
			$num = count($data['leaves']);
		} 
		$data['employee'] = View_employees_list::all();
		$data['pageTitle'] = 'Projects Report - MSInc.';
        $data['content'] = 'reports/leave_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}

	public function inventory_list(){
		$num = 0;
		if ($this->input->post('btnFilter')){
			$data['inventory'] =  $this->reports_model->getInventory();
			$num = count($data['inventory']);
		} 
		$data['category'] = Stock_category_model::all();
		$data['pageTitle'] = 'Inventory Report - MSInc.';
        $data['content'] = 'reports/inventory_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}

	public function asset_list(){
		$num = 0;
		if ($this->input->post('btnFilter')){
			$data['asset'] =  $this->reports_model->getAsset();
			$num = count($data['asset']);
		} 
		$data['category'] = Stock_category_model::all();
		$data['employees'] = View_employees_list::all();
		$data['pageTitle'] = 'Assigned Asset Report - MSInc.';
        $data['content'] = 'reports/asset_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}

	public function material_list(){
		$num = 0;
		if ($this->input->post('btnFilter')){
			$data['materials'] =  $this->reports_model->getMaterial();
			$num = count($data['materials']);
		} 
		$data['project'] = Projects_model::all();
		$data['pageTitle'] = 'Bill of Materials Report - MSInc.';
        $data['content'] = 'reports/material_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}
}