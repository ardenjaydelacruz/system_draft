<?php
class Leaves_model extends ActiveRecord\Model {
	static $table_name = 'leaves';
	static $primary_key = 'leave_id';

	public function leave_details(){
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
		return $data;
	}
}