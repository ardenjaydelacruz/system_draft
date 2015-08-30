<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 11:59 PM
 */
class Project_worker_model extends ActiveRecord\Model {
    static $table_name = 'tbl_project_workers';
    static $primary_key = 'project_id';

    public function addPersonnel(){
    	$this->form_validation->set_rules('txtProjectID', 'Project ID', 'trim|required');
        $this->form_validation->set_rules('txtEmployee', 'Employee Name', 'trim|required');
        $this->form_validation->set_rules('txtDateIssued', 'Assign Date', 'trim|required');

        $data = array (
    		"project_id" => $this->input->post('txtProjectID'),
    		"employee_id" => $this->input->post('txtEmployee'),
    		"assigned_date" => $this->input->post('txtDateIssued')
    		);

        if ($this->form_validation->run()){
            if (Project_worker_model::create($data)){
                $this->session->set_userdata('added',1);
                Audit_trail_model::auditProjectPersonnel($data);
                redirect('ems/view_projects');
            }
        }
    }
}

