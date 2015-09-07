<?php

class Users extends ActiveRecord\Model {
	static $table_name = 'tbl_user';
	static $primary_key = 'employee_id';

	public function userDetails(){
		$data = array(
			'username' => $this->input->post('txtUsername'),
			'password' => $this->encrpyt->encode($this->input->post('txtPassword')),
			'email' => $this->input->post('txtEmail'),
			'user_level' => $this->input->post('txtUserLevel')
		);
		return $data;
	}

	public function validInfo(){
		$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|is_unique[user_account.username]|min_length[6]');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('txtCPassword', 'Confirm Password', 'trim|required|matches[txtPassword]|min_length[8]');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
		$this->form_validation->set_rules('txtUserLevel', 'User Level', 'trim|required');
		$this->form_validation->set_message('is_unique', 'The Username is already taken.');
		if($this->form_validation->run()){
			RETURN TRUE;
		} else {
			RETURN FALSE;
		}
	}

	public function do_upload($id){
		// $this->upload_path = realpath(APPPATH.'../assets/images/profile');
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => 'assets/images/profile/',
			'overwrite' => TRUE
		);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		$image = $this->upload->data();
		$ems = Users::find($id);
		$ems->profile_image = $image['file_name'];
		$ems->save();
		
		if ($ems->save()) {
			$this->session->set_userdata('uploaded',1);
			if ($id == $this->session->userdata('employee_id')){
				$this->session->set_userdata('profile_image',$image['file_name']);
			}
			return true;
		} else {
			return false;
		}
	}

	public function login_employee($id){
		$user = Users::find($id);
		$user->logged = 1;
		$user->save();
	}

	public function logout_employee($id){
		$user = Users::find($id);
		$user->logged = 0;
		$user->save();
	}
}