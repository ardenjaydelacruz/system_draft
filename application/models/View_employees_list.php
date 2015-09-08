<?php
class View_employees_list extends ActiveRecord\Model {
	static $table_name = 'view_employees_list';
	static $primary_key = 'emp_id';

	public function getEmpInfo(){
		$user = View_users_model::find_by_username($this->input->post('txtUsername'));
		return View_employees_list::find($user->employee_id);
	}
}