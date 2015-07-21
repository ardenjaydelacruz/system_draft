<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ems extends MY_Controller
{
    public function __construct()
    {
        parent:: __construct();
        if ($this->session->userdata('logged_in') == false) {
            redirect('msi/login');
        }
    }

    public function dashboard()
    {
        $data['total_employee'] = count(View_employee_info::find('all'));
        $data['total_asset'] = count(Assets_model::find('all'));
        $data['pageTitle'] = 'Dashboard - MSInc.';
        $data['content'] = 'components/admin_dashboard';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
    }

    public function employees()
    {
        $data['total_employee'] = count(View_employees_list::find('all'));
        $data['record'] = View_employees_list::all();
        $data['pageTitle'] = 'Employees - MSInc.';
        $data['content'] = 'employee/employees_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
    }

    public function search_employee()
    {
        $text = $this->input->post('txtSearch');
        if ($this->input->post('txtSearch')) {
            $data['total_employee'] = count(View_employee_info::find('all'));
            $data['record'] = View_employee_info::find('all', array('conditions' => "emp_id LIKE '%$text%' OR first_name LIKE '%$text%'"));
            $data['pageTitle'] = 'Search Employee - MSInc.';
            $data['content'] = 'employee/employees_table';
            $this->load->view($this->master_layout, $data);
            $this->display_notif();
        } else {
            redirect('ems/employees');
        }
    }

    public function add_employee()
    {
        Emp_info_model::insert_employee_data();
        $data['pageTitle'] = 'Add Employees - MSInc.';
        $data['content'] = 'employee/add_employee';
        $this->load->view($this->master_layout, $data);
    }

    public function delete_employee()
    {
        $emp = Emp_info_model::find($this->input->get('emp_id'));
        $emp->delete();
        $this->session->set_userdata('deleted', 1);
        redirect('ems/employees');
    }

    public function view_details()
    {
        $id = $this->input->get('emp_id');
        $data['record'] = Dependent_model::find('all',array('conditions'=>"employee_id =$id")); //get dependents by id
        $data['leaves_left'] = Leaves_left_model::find('all',array('conditions'=>"emp_id =$id"));
        $data['asset'] = View_assigned_assets_model::find('all',array('conditions'=>"emp_id =$id"));
        $data['project'] = View_project_workers::find('all',array('conditions'=>"emp_id =$id"));
        $data['row'] = View_employee_info::find($id); //get user details by id
        $data['pageTitle'] = 'Employee Details - MSInc.';
        $data['content'] = 'employee/employee_details';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
    }

    public function view_accounts()
    {
        $data['record'] = Users::all();
        $data['pageTitle'] = 'User Accounts - MSInc.';
        $data['content'] = 'employee/view_user';
        $this->load->view($this->master_layout, $data);
    }

    public function update_employee()
    {
        $id = $this->input->get('emp_id');
        $ems = Emp_info_model::find($id);
        $user = Users::find_by_employee_id($id);

        if ($ems->update_attributes(Emp_info_model::updateInfo()) || $user->update_attributes(Users::userDetails())) {
            $this->session->set_userdata('edited', 1);
            redirect("ems/view_details?emp_id=$id");
        }
        $data['pageTitle'] = 'Update Details - MSInc.';
        $data['content'] = 'employee/view_user';
        $this->load->view($this->master_layout, $data);
    }

    public function upload_image()
    {
        $id = $this->input->get('emp_id');
        if ($this->input->post('btnUpload')) {
            if (Emp_info_model::do_upload($id)) {
                redirect("ems/view_details?emp_id=$id");
            }
        }
    }

    public function view_performance()
    {
        $data['total_performance'] = count(Performance::all());
        $data["record"] = Performance::find('all');
        $data['pageTitle'] = 'View Performance - MSInc.';
        $data['content'] = 'employee/performance_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
    }

    public function view_performance_details()
    {
        $data['row'] = Performance::find($this->input->get('performance_id'));
        $data['pageTitle'] = 'Performance Details - MSInc.';
        $data['content'] = 'employee/performance_details';
        $this->load->view($this->master_layout, $data);
    }

    public function evaluate_employee()
    {
        $row = Emp_info_model::find($this->input->get('emp_id'));
        $data['name'] = $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name;
        $data['pageTitle'] = 'Evaluate Employee - MSInc.';
        $data['content'] = 'employee/evaluate_employee';
        $this->load->view($this->master_layout, $data);
    }

    public function process_evaluation()
    {
        Performance::add_evaluation();
    }

    public function leaves_table()
    {
        $data['record'] = Leaves_model::all();
        $data['pageTitle'] = 'Leaves - MSInc.';
        $data['content'] = 'employee/leaves_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
    }

    public function request_leave()
    {
        $id = $this->input->get('emp_id');
        $data['row'] = Emp_info_model::find($id);
        $data['pageTitle'] = 'Request Leave - MSInc.';
        $data['content'] = 'employee/request_leave';
        $this->load->view($this->master_layout, $data);
    }

    public function process_leave()
    {
        $details = Leaves_model::leave_details();
        if ($leave = Leaves_model::create($details)) {
            $this->session->set_userdata('added', 1);
            redirect('ems/leaves_table');
        }
    }

    public function update_leave_status()
    {
        if ($this->input->get('leave_status') == 'Approved') {
            $data = Emp_info_model::find($this->input->get('emp_id'));
            $data->leaves = $this->input->get('leaves') - $this->input->get('days');
            $data->save();
        }
        $details = array(
            'status' => $this->input->get('leave_status'),
            'approved_by' => $this->session->userdata('user_level') . ' ' . $this->session->userdata('first_name'),
            'date_approved' => date("Y-m-d")
        );
        $approved = Leaves_model::find($this->input->get('leave_id'));
        if ($approved->update_attributes($details)) {
            redirect('ems/leaves_table');
        }
    }

    public function view_leave_details()
    {
        $data['row'] = Leaves_model::find($this->input->get('leave_id'));
        $data['pageTitle'] = 'Leave Details - MSInc.';
        $data['content'] = 'employee/leave_details';
        $this->load->view($this->master_layout, $data);
    }

    public function promotion()
    {
        $data['pageTitle'] = 'Promotion - MSInc.';
        $data['content'] = 'employee/upload';
        $this->load->view($this->master_layout, $data);
    }

    public function view_projects(){
        $data['record'] = View_project_cost_model::all(); 
        $data['pageTitle'] = 'Projects - MSInc.';
        $data['content'] = 'employee/project_table';
        $this->load->view($this->master_layout,$data);
        $this->display_notif();
    }

    public function view_personnel(){
        $id = $this->input->get('project_id');
        $data['project'] = View_project_workers::find('all',array('conditions' => array('project_id=?',$id)));
        $data['pageTitle'] = 'Project Personnel- MSInc.';
        $data['content'] = 'employee/project_personnel';
        $this->load->view($this->master_layout,$data);
    }

    public function add_personnel(){
        Project_worker_model::addPersonnel();
        $data['project'] = Projects_model::all();
        $data['employee'] = Emp_info_model::all();
        $data['pageTitle'] = 'Project Personnel- MSInc.';
        $data['content'] = 'employee/add_personnel';
        $this->load->view($this->master_layout,$data);
    }
}
