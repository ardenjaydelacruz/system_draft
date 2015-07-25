<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends MY_Controller {
	public function __construct() {
		parent:: __construct();
		if ($this->session->userdata('logged_in') == false) {
            redirect('msi/login');
        }
	}

	public function employees_list(){
		$num = 0;
		if ($this->input->post('btnFilter')){
			$data['report'] =  $this->reports_model->filterEmployee();
			$num = count($data['report']);
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
}