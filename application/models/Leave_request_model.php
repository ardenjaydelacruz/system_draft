<?php
class Leave_request_model extends ActiveRecord\Model {
    static $table_name = 'tbl_leave_request';
    static $primary_key = 'id';

    public function update_leave(){
    	if ($this->input->get('leave_status') == 'Approved') {
	        $emp = leave_left_model::find_by_employee_id_and_leave_type_id($this->input->get('emp_id'),$this->input->get('leave_id'));
	        $emp->days -= $this->input->get('days');
	        $emp->save();
	    }
	    $details = array(
			'leave_status'  => $this->input->get('leave_status'),
			'approved_by'   => $this->session->userdata('user_level') . ' ' . $this->session->userdata('first_name'),
			'date_approved' => date("Y-m-d"),
	    );
	    $approved = Leave_request_model::find($this->input->get('leave_request_id'));
	    if ($approved->update_attributes($details)) {
	        redirect('ems/leaves_table');
	    }
    }	

    public function leave_details(){
		$leave_type = Leave_left_model::find_by_employee_id_and_leave_type_id($this->input->get('emp_id'),$this->input->post('txtLeaveType'));
		$leaves     = $leave_type->days;
		$data       = array(
			'leave_start'   => $this->input->post('leaveStarts'),
			'leave_end'     => $this->input->post('leaveEnds'),
			'employee_id'   => $this->input->get('emp_id'),
			'leave_left'    => $leaves,
			'date_approved' => 0,
			'leave_status'  => 'Pending',
			'leave_type'    => $this->input->post('txtLeaveType'),
			'leave_reason'    => $this->input->post('txtReason')
		);
		return $data;
	}

	public function process_leave_request(){
		$details = Leave_request_model::leave_details();
        if ($leave = Leave_request_model::create($details)) {
            $this->session->set_userdata('added', 1);
            redirect('ems/leaves_table');
        }
	}
}