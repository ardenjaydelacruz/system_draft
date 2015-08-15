<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ems extends MY_Controller
{
    public function __construct()
    {
        parent:: __construct();
       
    }

    public function dashboard()
    {
        $data['total_employee'] = count(View_employees_list::find('all'));
        $data['total_asset'] = count(Projects_model::find('all'));
        $data['total_projects'] = count(Projects_model::find('all'));
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
        $data['departments'] = Departments_model::all();
        $data['job_titles'] = Job_titles_model::all();
        $data['employment_type'] = Employment_type_model::all();
        $data['pageTitle'] = 'Add Employees - MSInc.';
        $data['content'] = 'employee/add_employee';
        $this->load->view($this->master_layout, $data);
    }

    public function delete_employee()
    {
       Emp_info_model::deleteEmployee();
    }

    public function view_details()
    {
        $id = $this->input->get('emp_id');
        $data['departments'] = Departments_model::all();
        $data['job_titles'] = Job_titles_model::all();
        $data['employment_type'] = Employment_type_model::all();
        
        $data['record']    = Dependent_model::find('all',array('conditions'=>"employee_id =$id")); //get dependents by id
        $data['info']      = Emp_info_model::find($id); //Tab 1a - Personal Tab
        $data['gov_id']    = Gov_id_model::find($id); //Tab 1b - Gov ID Tab
        $data['address']   = Emp_address_model::find($id); //Tab 2a - Contact Tab
        $data['contact']   = Emp_contact_model::find($id); //Tab 2b - Contact Tab
        $data['contactP']  = Emp_contact_person::find($id); //Tab 2c - Contact Tab
        $data['school']    = Emp_school_model::find($id); //Tab 3 - School Tab
        $data['job_hist']  = Job_history_model::find('all',array('conditions'=>"employee_id =$id")); //Tab 4 - Job History Tab
        $data['emp']       = View_job_history::find($id); //Tab 5 - Employment Tab
        $data['leaves']    = View_leave_remaining::find('all',array('conditions'=>"emp_id =$id")); //Tab 6 - Leaves Tab
        $data['asset']     = View_assigned_assets_model::find('all',array('conditions'=>"emp_id =$id")); //Tab 7 - Asset Tab
        $data['project']   = View_project_workers::find('all',array('conditions'=>"emp_id =$id")); //Tab 8 - Project Tab
        $data['account']   = Users::find_by_employee_id($id); //Tab 9 - Users Tab

        $data['pageTitle'] = 'Employee Details - MSInc.';
        $data['content']   = 'employee/employee_details';
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
        Emp_info_model::updateEmployee();
        $data['pageTitle'] = 'Update Details - MSInc.';
        $data['content'] = 'employee/view_user';
        $this->load->view($this->master_layout, $data);
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
        if ($this->input->get('leave_status')){
            Leave_request_model::update_leave();
        }
        $data['record'] = View_leaves_request::all();
        $data['pageTitle'] = 'Leaves - MSInc.';
        $data['content'] = 'employee/leaves_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();

    }

    public function request_leave()
    {
        if($this->input->post('btnSubmit')){
            Leave_request_model::process_leave_request();
        }
        $id = $this->input->get('emp_id');
        $data['row'] = Emp_info_model::find($id);
        $data['leave_type'] = Leave_type_model::all();
        $data['pageTitle'] = 'Request Leave - MSInc.';
        $data['content'] = 'employee/request_leave';
        $this->load->view($this->master_layout, $data);

    }

    public function view_leave_details()
    {
        $data['row'] = View_leaves_request::find($this->input->get('leave_request_id'));
        $data['pageTitle'] = 'Leave Details - MSInc.';
        $data['content'] = 'employee/leave_details';
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

    public function export_db(){
        // Load the DB utility class
        $this->load->dbutil();

        $prefs = array(
                'format'      => 'zip',             // gzip, zip, txt
                'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
              );

        $backup = $this->dbutil->backup($prefs);
        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('./', $backup); 
        $date = date('m-d-Y');
        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download("Backup - $date.zip", $backup);
    }

    // public function upload_image()
    // {
    //     $id = $this->input->get('emp_id');
    //     if ($this->input->post('btnUpload')) {
    //         if (Users::do_upload($id)) {
    //             dump(Users::do_upload($id));
    //             redirect("ems/view_details?emp_id=$id");
    //         }
    //     }
    // }
}
