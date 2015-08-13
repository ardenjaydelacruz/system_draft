<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends MY_Controller {
	public function __construct() {
		parent:: __construct();
		
		if ($this->session->userdata('logged_in') == false) {
            redirect('msi/login');
        }
	}

	public function print_employees_list($data){
		$this->print_reports_model->pdf_employees_list($data);
    }

	public function print_project_workers($data){
		$this->print_reports_model->pdf_project_workers($data);
    }

    public function print_leave_list($data){
		$this->print_reports_model->pdf_leave_list($data);
    }

    public function print_inventory_list($data){
		$this->print_reports_model->pdf_inventory_list($data);
    }

    public function print_asset_list($data){
		$this->print_reports_model->pdf_asset_list($data);
    }

    public function print_material_list($data){
		$this->print_reports_model->pdf_material_list($data);
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
		if ($this->input->post('btnPrint')){
			$personnel =  $this->reports_model->getProjectWorkers();
			$this->print_project_workers($personnel);
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
		if ($this->input->post('btnPrint')){
			$leave =  $this->reports_model->getLeavesLeft();
			$this->print_leave_list($leave);
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
		if ($this->input->post('btnPrint')){
			$inventory =  $this->reports_model->getInventory();
			$this->print_inventory_list($inventory);
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
		if ($this->input->post('btnPrint')){
			$asset =  $this->reports_model->getAsset();
			$this->print_asset_list($asset);
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
		if ($this->input->post('btnPrint')){
			$materials = $this->reports_model->getMaterial();
			$this->print_material_list($materials);
		} 
		$data['project'] = Projects_model::all();
		$data['pageTitle'] = 'Bill of Materials Report - MSInc.';
        $data['content'] = 'reports/material_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif('Successful! '.$num.' record found'); }
	}

	public function audit_trail(){
		$data['audit'] = Audit_trail_model::all();
		$data['pageTitle'] = 'Audit Trail - MSInc.';
        $data['content'] = 'reports/audit_trail';
        $this->load->view($this->master_layout, $data);
	}
}