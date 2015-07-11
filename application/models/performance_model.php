<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Performance_model extends CI_Model {

	public function record_count(){
		return $this->db->count_all('emp_performance');
	}

	public function fetch_record($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("emp_performance");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

	public function view_performance(){
		return $this->db->get('emp_performance')->result();
	}

    public function add_evaluation(){
        $data = array (
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
            'final_rating' => ($this->input->post('txtRate1') + $this->input->post('txtRate2') + $this->input->post('txtRate3') + $this->input->post('txtRate4') + $this->input->post('txtRate5'))/5
        );

        $query = $this->db->insert('emp_performance',$data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function view_performance_details($id){
        $this->db->where('performance_id', $id);
        $query = $this->db->get('emp_performance');

        if ($query->result()){
            foreach ($query->result() as $row) {
                $records[] = $row; 
            }
            return $records;
        }
    }
}