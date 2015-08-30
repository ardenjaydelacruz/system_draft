<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 11:59 PM
 */
class Projects_model extends ActiveRecord\Model {
    static $table_name = 'tbl_project';
    static $primary_key = 'project_id';

    public function projectDetails(){
        $data = array (
            'project_id' => $this->input->post('txtProjectID'),
            'project_name' => $this->input->post('txtProjectName'),
            'client' => $this->input->post('txtClient'),
            'starting_date' => $this->input->post('txtStartingDate'),
            'ending_date' => $this->input->post('txtEndingDate')
        );
        return $data;
    }
    public function insertProject(){
        $this->form_validation->set_rules('txtProjectID', 'Project ID', 'trim|required');
        $this->form_validation->set_rules('txtProjectName', 'Project Name', 'trim|required');
        $this->form_validation->set_rules('txtClient', 'Client Name', 'trim|required');
        $this->form_validation->set_rules('txtStartingDate', 'Starting Date', 'trim|required');
        $this->form_validation->set_rules('txtEndingDate', 'Ending Date', 'trim|required');

        if ($this->form_validation->run()){
            if (Projects_model::create(Projects_model::projectDetails())){
                $this->session->set_userdata('added',1);
                Audit_trail_model::auditNewProject($this->input->post('txtProjectName'));
                redirect('ams/view_projects');
            }
        }
    }
}