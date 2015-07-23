<?php
class view_employee_info extends ActiveRecord\Model {
	static $table_name = 'view_employee_info';
	static $primary_key = 'emp_id';

	public function findEmployee(){
		if ($this->input->get('btnFilter')){
			$emp = View_employee_info::find('all', array('conditions' => "status = '$this->post->get('txtStatus')'"));
			return $emp;
		}
	}
}