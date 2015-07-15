<?php

class Users extends ActiveRecord\Model {
	static $table_name = 'tbl_user';
	static $primary_key = 'user_id';

	public function userDetails(){
		$data = array(
			'username' => $this->input->post('txtUsername'),
			'password' => md5($this->input->post('txtPassword')),
			'email' => $this->input->post('txtEmail'),
			'user_level' => $this->input->post('txtUserLevel'),
			'secret_question' => $this->input->post('txtQuestionList'),
			'secret_answer' => $this->input->post('txtAnswer')
		);
		return $data;
	}

	public function validInfo(){
		$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|is_unique[user_account.username]|min_length[6]');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('txtCPassword', 'Confirm Password', 'trim|required|matches[txtPassword]|min_length[8]');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
		$this->form_validation->set_rules('txtUserLevel', 'User Level', 'trim|required');
		$this->form_validation->set_rules('txtQuestionList', 'Secret Question', 'trim|required');
		$this->form_validation->set_rules('txtAnswer', 'Secret Answer', 'trim|required');
		$this->form_validation->set_message('is_unique', 'The Username is already taken.');
		if($this->form_validation->run()){
			RETURN TRUE;
		} else {
			RETURN FALSE;
		}
	}

	public function validLogin(){
		$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|callback_validate_data');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|md5');
		if($this->form_validation->run()){
			RETURN TRUE;
		} else {
			RETURN FALSE;
		}
	}
}