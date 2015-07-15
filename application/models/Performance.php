<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 1:34 AM
 */
class Performance extends ActiveRecord\Model {
    static $table_name = 'tbl_emp_performance';
    static $primary_key = 'performance_id';

    public function add_evaluation(){
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
}