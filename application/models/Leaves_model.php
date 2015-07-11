<?php
class Leaves_model extends ActiveRecord\Model {
	static $table_name = 'leaves';
	static $primary_key = 'leave_id';

	public function makeLeave($id,$name,$leaves){
		$date1 = new DateTime($this->input->post('leaveStarts'));
		$date2 = new DateTime($this->input->post('leaveEnds'));
		$interval = $date1->diff($date2);
		$data = array (
			'employee_name' => $name,
			'start_date' => $this->input->post('leaveStarts'),
			'end_date' => $this->input->post('leaveEnds'),
			'days' => $interval->days+1,
			'employee_id' =>$id,
			'leaves_left'=> $leaves,
			'date_approved' => 0,
			'type' => $this->input->post('type')
		);
		$query = $this->db->insert('leaves',$data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_leave($leave_id,$emp_id,$status,$days,$leaves){
		if($status=='Approved'){
			$this->db->where('emp_id',$emp_id);
			$record = array(
				'leaves' => $leaves-$days
			);
			$query = $this->db->update('employees',$record);
		}

		$this->db->where('leave_id', $leave_id);
		$data = array(
			'status' => $status,
			'approved_by' => $this->session->userdata('user_level'). ' ' . $this->session->userdata('first_name'),
			'date_approved' => date("Y-m-d")
		);

		$query = $this->db->update('leaves',$data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
}