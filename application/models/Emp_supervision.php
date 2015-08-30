<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 11:59 PM
 */
class Emp_supervision extends ActiveRecord\Model {
    static $table_name = 'tbl_supervisions';
    static $primary_key = 'supervisor_id';

    public function updateSupervision(){
		$data = array (
			'supervisor_id' => $this->input->post('txtSupervisor'),
			'employee_id' => $this->input->post('txtEmployee'),
			'assigned_date' => date('Y-m-d')
			);

		if(Emp_supervision::create($data)){
	            $this->session->set_userdata('edited', 1);
	            Audit_trail_model::auditSupervision($data);
	            redirect("ems/supervisions");
	        }
	}
}