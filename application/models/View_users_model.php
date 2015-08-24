<?php

class View_users_model extends ActiveRecord\Model {
	static $table_name = 'view_users';
	static $primary_key = 'employee_id';

	public function set_session(){
		$row = View_users_model::find_by_username($this->input->post('txtUsername'));
	
		$session_data = array(
			'employee_id' => $row->employee_id,
			'username'   => $row->username,
			'user_level' => $row->user_level,
			'logged_in'  => TRUE,
			'first_name' => $row->first_name,
			'last_name'  => $row->last_name,
			'profile_image'  => $row->profile_image
			);
		$this->session->set_userdata($session_data);
	}	

	public function login_employee(){
		$row = View_users_model::find_by_username($this->input->post('txtUsername'));
		if($row != NULL){
			if ($row->password == md5($this->input->post('txtPassword'))){
				return 'Success';
			} else {
				return 'Incorrect password';
			}
		} else {
			return 'Not registered';
		}
	}

	public function mobile_login_employee(){
		$row = View_users_model::find_by_username($this->input->post('txtUsername'));
		if($row != NULL){
			if ($row->password == md5($this->input->post('txtPassword'))){
				return 'Success';
			} else {
				return 'Incorrect password';
			}
		} else {
			return 'Not registered';
		}
	}
}