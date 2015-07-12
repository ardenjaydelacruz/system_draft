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
        $data['total_employee'] = count(Employees_model::find('all'));
        $data['total_asset'] = count(Assets_model::find('all'));
        $data['pageTitle'] = 'Dashboard - MSInc.';
        $data['content'] = 'components/admin_dashboard';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();

    }

    public function employees()
    {
        // $config["base_url"] = base_url() . "employee/employees";
        // $config["total_rows"] = $this->ems_model->total_employees();
        // $config["per_page"] = 15;
        // $config["uri_segment"] = 3;
        // $choice = $config["total_rows"] / $config["per_page"];
        // $config["num_links"] = round($choice);
        // $config['full_tag_open'] = '<ul class="pagination zero">';
        // $config['full_tag_close'] = '</ul>';
        // $config['first_link'] = false;
        // $config['last_link'] = false;
        // $config['first_tag_open'] = '<li>';
        // $config['first_tag_close'] = '</li>';
        // $config['prev_link'] = '&laquo';
        // $config['prev_tag_open'] = '<li class="prev">';
        // $config['prev_tag_close'] = '</li>';
        // $config['next_link'] = '&raquo';
        // $config['next_tag_open'] = '<li>';
        // $config['next_tag_close'] = '</li>';
        // $config['last_tag_open'] = '<li>';
        // $config['last_tag_close'] = '</li>';
        // $config['cur_tag_open'] = '<li class="active"><a href="#">';
        // $config['cur_tag_close'] = '</a></li>';
        // $config['num_tag_open'] = '<li>';
        // $config['num_tag_close'] = '</li>';
        // $this->pagination->initialize($config);
        // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // $data['total_employee'] = $this->ems_model->total_employees();
        // $data["record"] = $this->ems_model->fetch_record($config["per_page"], $page);
        // $data["links"] = $this->pagination->create_links();

        $data['total_employee'] = count(Employees_model::find('all'));
        $data['record'] = Employees_model::all();
        $data['pageTitle'] = 'Employees - MSInc.';
        $data['content'] = 'employee/employees_table';
        $this->load->view($this->master_layout, $data);
        $this->display_notif();
    }

    public function search_employee()
    {
        if ($this->input->post('txtSearch')) {
            $data['total_employee'] = count(Employees_model::find('all'));
            $data['record'] = $this->ems_model->search_employee();
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
        $this->form_validation->set_rules('txtEmpID', 'Employee ID', 'trim|required');
        $this->form_validation->set_rules('txtEmpPosition', 'Position', 'trim|required');
        $this->form_validation->set_rules('txtEmpStatus', 'Employee Status', 'trim|required');
        $this->form_validation->set_rules('txtEmpDepartment', 'Employee Department', 'trim|required');

        $this->form_validation->set_rules('txtFirstName', 'First Name', 'trim|required');
        $this->form_validation->set_rules('txtMiddleName', 'Middle Name', 'trim');
        $this->form_validation->set_rules('txtLastName', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('txtGender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('txtBday', 'Birthday', 'trim|required');
        $this->form_validation->set_rules('txtStatus', 'Marital Status', 'trim|required');

        $this->form_validation->set_rules('txtStreet', 'Street', 'trim|required');
        $this->form_validation->set_rules('txtBarangay', 'Barangay', 'trim|required');
        $this->form_validation->set_rules('txtCity', 'City', 'trim|required');
        $this->form_validation->set_rules('txtState', 'State', 'trim|required');
        $this->form_validation->set_rules('txtZip', 'Zip Code', 'trim|required');
        $this->form_validation->set_rules('txtCountry', 'Country', 'trim|required');

        if ($this->form_validation->run()) {
            if ($this->ems_model->add_record()) {
                $this->session->set_userdata('added', 1);
                redirect('ems/employees');
            }
        }
        $data['pageTitle'] = 'Add Employees - MSInc.';
        $data['content'] = 'employee/add_employee';
        $this->load->view($this->master_layout, $data);
    }

    public function delete_employee()
    {
        $emp = Employees_model::find($this->input->get('emp_id'));
        $emp->delete();
        $this->session->set_userdata('deleted', 1);
        redirect('ems/employees');
    }

    public function view_details()
    {
        $id = $this->input->get('emp_id');
        $data['account'] = $this->login_model->find_account($id);
        $data['row'] = Employees_model::find($id); //get user details by id
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

    // public function edit_employee()
    // {
    //     $id = $this->input->get('emp_id');
    //     $data['record'] = $this->ems_model->view_emp_details($id);
    //     $data['pageTitle'] = 'Edit Details - MSInc.';
    //     $data['content'] = 'employee/edit_employee';
    //     $this->load->view($this->master_layout,$data);
    // }

    public function update_employee()
    {
        $id = $this->input->get('emp_id');
        if ($this->ems_model->update_record($id) || $this->login_model->update_account($id)) {
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
            if ($this->ems_model->do_upload($id)) {
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
        $row = Employees_model::find($this->input->get('emp_id'));
        $data['name'] = $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name;
        $data['pageTitle'] = 'Evaluate Employee - MSInc.';
        $data['content'] = 'employee/evaluate_employee';
        $this->load->view($this->master_layout, $data);
    }

    public function process_evaluation()
    {
        $data = array(
            'employee_name' => $this->session->userdata('name'),
            'evaluators' => $this->session->userdata('first_name'),
            'description' => $this->input->post('txtEvalTitle'),
            'criteria1' => $this->input->post('txtCriteria1'),
            'criteria2' => $this->input->post('txtCriteria2'),
            'criteria3' => $this->input->post('txtCriteria3'),
            'criteria4' => $this->input->post('txtCriteria4'),
            'criteria5' => $this->input->post('txtCriteria5'),
            'rate1' => $this->input->post('txtRate1'),
            'rate2' => $this->input->post('txtRate2'),
            'rate3' => $this->input->post('txtRate3'),
            'rate4' => $this->input->post('txtRate4'),
            'rate5' => $this->input->post('txtRate5'),
            'final_rating' => ($this->input->post('txtRate1') + $this->input->post('txtRate2') + $this->input->post('txtRate3') + $this->input->post('txtRate4') + $this->input->post('txtRate5')) / 5
        );
        if (Performance::create($data)) {
            $this->session->unset_userdata('name');
            $this->session->set_userdata('added', 1);
            redirect('ems/view_performance');
        }
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
        $data['row'] = Employees_model::find($id);
        $data['pageTitle'] = 'Request Leave - MSInc.';
        $data['content'] = 'employee/request_leave';
        $this->load->view($this->master_layout, $data);
    }

    public function process_leave()
    {
        $this->form_validation->set_rules('leaveStarts', 'Leave Starts', 'trim|required');
        $this->form_validation->set_rules('leaveEnds', 'Leave Ends', 'trim|required');
        $this->form_validation->set_rules('type', 'Type of leave', 'trim|required');
        $date1 = new DateTime($this->input->post('leaveStarts'));
        $date2 = new DateTime($this->input->post('leaveEnds'));
        $interval = $date1->diff($date2);
        $data = array(
            'employee_name' => $this->input->get('emp_name'),
            'start_date' => $this->input->post('leaveStarts'),
            'end_date' => $this->input->post('leaveEnds'),
            'days' => $interval->days + 1,
            'employee_id' => $this->input->get('emp_id'),
            'leaves_left' => $this->input->get('leaves'),
            'date_approved' => 0,
            'type' => $this->input->post('type')
        );
        if ($this->form_validation->run()) {
            if ($leave = Leaves_model::create($data)) {
                $this->session->set_userdata('added', 1);
                redirect('ems/leaves_table');
            }
        }
    }

    public function update_leave_status()
    {
        if ($this->input->get('leave_status') == 'Approved') {
            $data = Employees_model::find($this->input->get('emp_id'));
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
}
