<?php

class Users extends ActiveRecord\Model {
	static $table_name = 'tbl_user';
	static $primary_key = 'employee_id';

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

	public function do_upload($id){
		// $this->upload_path = realpath(APPPATH.'../assets/images/profile');
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => 'assets/images/profile/',
			'max_width' => '1024',
			'max_height' => '768',
			'max_size' => '2048KB',
			'overwrite' => TRUE
		);
		$this->load->library('upload',$config);
		$this->upload->do_upload();
		$info = array (
			'image_width' => 512,
			'image_height' => 512
			);
		$image = $this->upload->data($info);
		$ems = Users::find($id);
		$ems->profile_image = $image['file_name'];
		$ems->save();
		
		if ($ems->save()) {
			$this->session->set_userdata('uploaded',1);
			$this->session->set_userdata('profile_image',$image['file_name']);
			return true;
		} else {
			return false;
		}

	}
}