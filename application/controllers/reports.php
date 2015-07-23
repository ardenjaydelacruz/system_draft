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
			$this->load->model('ems_model');
			if ($this->ems_model->filterEmployee()!=false){
				$data['report'] =  $this->ems_model->filterEmployee();
				$num = count($data['report']);
			} else {
				$data['report'] = false;
			}
			// $data['report'] = View_employee_info::find('all',array('conditions' => array('project_id=?',$id)));
		}
		$data['departments'] = Departments_model::all();
		$data['employment_type'] = Employment_type_model::all();
		$data['job_titles'] = Job_titles_model::all();
        $data['employees'] = View_employees_list::all();
        $data['pageTitle'] = 'Employees - MSInc.';
        $data['content'] = 'reports/employees_list';
        $this->load->view($this->master_layout, $data);
        if ($num!=0){ $this->display_notif($num.' record found!'); }
	}
}