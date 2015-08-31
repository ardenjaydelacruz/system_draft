<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 1:34 AM
 */
class Performance extends ActiveRecord\Model {
    static $table_name = 'tbl_evaluation';
    static $primary_key = 'evaluation_id';


    public function add_evaluation(){
         $data = array(
            'assessee_id'     => $this->input->post('txtEmpID'),
            'assessor_id'     => $this->session->userdata('employee_id'),
            'evaluation_desc' => $this->input->post('txtEvalTitle')
        );

        $eval = (count(Evaluation_model::all()))+1;
        // $rate1 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 1,
        //     'rate'          => $this->input->post('txtRate1'),
        //     );
        // $rate2 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 2,
        //     'rate'          => $this->input->post('txtRate2'),
        //     );
        // $rate3 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 3,
        //     'rate'          => $this->input->post('txtRate3'),
        //     );
        // $rate4 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 4,
        //     'rate'          => $this->input->post('txtRate4'),
        //     );
        // $rate5 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 5,
        //     'rate'          => $this->input->post('txtRate5'),
        //     );
        // $rate6 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 6,
        //     'rate'          => $this->input->post('txtRate6'),
        //     );
        // $rate7 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 7,
        //     'rate'          => $this->input->post('txtRate7'),
        //     );
        // $rate8 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 8,
        //     'rate'          => $this->input->post('txtRate8'),
        //     );
        // $rate9 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 9,
        //     'rate'          => $this->input->post('txtRate9'),
        //     );
        // $rate10 = array (
        //     'evaluation_id' => $eval,
        //     'criteria_id'   => 10,
        //     'rate'          => $this->input->post('txtRate10'),
        //     );
        $rate = array (
            'evaluation_id' => $eval,
            'rate1'          => $this->input->post('txtRate1'),
            'rate2'          => $this->input->post('txtRate2'),
            'rate3'          => $this->input->post('txtRate3'),
            'rate4'          => $this->input->post('txtRate4'),
            'rate5'          => $this->input->post('txtRate5'),
            'rate6'          => $this->input->post('txtRate6'),
            'rate7'          => $this->input->post('txtRate7'),
            'rate8'          => $this->input->post('txtRate8'),
            'rate9'          => $this->input->post('txtRate9'),
            'rate10'          => $this->input->post('txtRate10')
            );
        if (Performance::create($data)) {
            // Evaluation_rate::create($rate1);
            // Evaluation_rate::create($rate2);
            // Evaluation_rate::create($rate3);
            // Evaluation_rate::create($rate4);
            // Evaluation_rate::create($rate5);
            // Evaluation_rate::create($rate6);
            // Evaluation_rate::create($rate7);
            // Evaluation_rate::create($rate8);
            // Evaluation_rate::create($rate9);
            // Evaluation_rate::create($rate10);
            Evaluation_rate::create($rate);
            $this->session->set_userdata('added', 1);
            Audit_trail_model::auditPerformance($data);
            if ($this->session->userdata('user_level')=='Administrator') {
                redirect('ems/view_performance');
            } else {
                redirect('ems/evaluate_performance');
            }
            
        }
    }
}