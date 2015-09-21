<?php
class Leave_request_model extends ActiveRecord\Model {
    static $table_name = 'tbl_leave_request';
    static $primary_key = 'id';

    public function update_leave(){
    	if ($this->input->get('leave_status') == 'Approved') {
	        $emp = leave_left_model::find_by_employee_id_and_leave_type_id($this->input->get('emp_id'),$this->input->get('leave_id'));
	        $days = $emp->days - $this->input->get('days');
	        $this->reports_model->update_leave($this->input->get('emp_id'),$this->input->get('leave_id'),$days);
	    }
	    $details = array(
			'leave_status'  => $this->input->get('leave_status'),
			'approved_by'   => $this->session->userdata('user_level') . ' ' . $this->session->userdata('first_name')
	    );
	    $approved = Leave_request_model::find($this->input->get('leave_request_id'));
	    if ($approved->update_attributes($details)) {
	    	Audit_trail_model::auditUpdateLeave($details);
	        redirect('ems/leaves_table');
	    }
    }	

    public function leave_details(){
		$leave_type = Leave_left_model::find_by_employee_id_and_leave_type_id($this->input->get('emp_id'),$this->input->post('txtLeaveType'));
		$leaves     = $leave_type->days;
		$data       = array(
			'leave_start'   => $this->input->post('leaveStarts'),
			'leave_end'     => $this->input->post('leaveEnds'),
			'days'			=> Leave_request_model::getLeaveDays($this->input->post('leaveStarts'),$this->input->post('leaveEnds')),
			'employee_id'   => $this->input->get('emp_id'),
			'leave_left'    => $leaves,
			'date_approved' => 0,
			'leave_status'  => 'Pending',
			'leave_type'    => $this->input->post('txtLeaveType'),
			'leave_reason'  => $this->input->post('txtReason')
		);
		return $data;
	}

	public function process_leave_request(){
		$details = Leave_request_model::leave_details();
        if ($leave = Leave_request_model::create($details)) {
            $this->session->set_userdata('added', 1);
            Audit_trail_model::auditLeave($details);
            if($this->session->userdata('user_level')=='Employee'){
            	redirect('ems/emp_dashboard');
            } else {
            	redirect('ems/leaves_table');
            }
        }
	}

	public function getLeaveDays($date1,$date2){
		$start = strtotime($date1);
		$end = strtotime($date2);
		$count = 0;
		while(date('Y-m-d', $start) < date('Y-m-d', $end)){
		  $count += date('N', $start) < 6 ? 1 : 0;
		  $start = strtotime("+1 day", $start);
		}
		return $count+1;
	}

	public function mobile_leave_details(){
		$leave_type = Leave_left_model::find_by_employee_id_and_leave_type_id($this->input->post('emp_id'),$this->input->post('txtLeaveType'));
		$leaves     = $leave_type->days;
		$data       = array(
			'leave_start'   => $this->input->post('leaveStarts'),
			'leave_end'     => $this->input->post('leaveEnds'),
			'days'			=> Leave_request_model::getLeaveDays($this->input->post('leaveStarts'),$this->input->post('leaveEnds'))-1,
			'employee_id'   => $this->input->post('emp_id'),
			'leave_left'    => $leaves,
			'date_approved' => 0,
			'leave_status'  => 'Pending',
			'leave_type'    => $this->input->post('txtLeaveType'),
			'leave_reason'  => $this->input->post('txtReason')
		);
		return $data;
	}

	public function mobile_process_leave(){
		if (!empty($this->input->post('emp_id')) &&
			!empty($this->input->post('leaveStarts')) &&
			!empty($this->input->post('leaveEnds')) &&
			!empty($this->input->post('txtLeaveType')) &&
			!empty($this->input->post('txtReason')) ){

			$details = Leave_request_model::mobile_leave_details();
			$leave = Leave_request_model::create($details);
	        if ($leave) {
	            Audit_trail_model::auditLeave($details);
	            $response['message'] = 'Leave Request is successfully submitted';
	        } else {
	        	$response['message'] = 'Error';
	        }
	    } else {
	    	$response['message'] = 'Please complete the information';
	    }
	    echo json_encode($response);
	}
}