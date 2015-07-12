<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {

	/* =====================================
				LOGIN /REGISTRATION
	   ===================================== */

	public function get_profile(){
		$this->db->select('*');
		$this->db->from('user_account');
		$this->db->join('employees','employees.emp_id = user_account.employee_id');
		$this->db->where('username',$this->input->post('txtUsername'));
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();

		if ($query->result()){
			$session_data = array(
				'image' => $row->image,
				'first_name' => $row->first_name
				);
			$this->session->set_userdata($session_data);
		}
	}

	public function login_employee(){
		$this->db->where('username',$this->input->post('txtUsername'));
		$query = $this->db->get('user_account');
		$this->db->limit(1);
		$row = $query->row();
		
		if($query->num_rows()){
			if ($row->password == md5($this->input->post('txtPassword'))){
				return 'login success';
			} else {
				return 'Incorrect password';
			}
		} else {
			return 'Not registered';
		}
	}

	public function set_session(){
		$this->db->where('username',$this->input->post('txtUsername'));
		$query = $this->db->get('user_account');
		$this->db->limit(1);
		$row = $query->row();

		if ($query->result()){
			$session_data = array(
				'user_id' => $row->user_id,
				'username' => $row->username,
				'user_level' => $row->user_level,
				'first_name' => $row->first_name,
				'logged_in' => TRUE
				);
			$this->session->set_userdata($session_data);
		}
	}

	/* =====================================
				FORGOT PASSWORD
	   ===================================== */

	public function is_registered(){
		$this->db->where('username',$this->input->post('txtUserChange'));
		$query = $this->db->get('user_account');
		$row = $query->row();

		if($query->num_rows()){
			$data = array (
				'user' => $row->username
				);
			$this->session->set_userdata($data);
			return true;
		} else {
			return false;
		}
	}

	public function valid_answer(){
		$this->db->where('username',$this->session->userdata('user'));
		$query = $this->db->get('user_account');
	
		foreach ($query->result() as $row){
			$question = $row->secret_question;		
			$answer = $row->secret_answer;
		}

		if($query->num_rows()){
			if ($question == $this->input->post('txtQuestion')){
				if ($answer  == $this->input->post('txtAnswer')){
					return 'success';
				} else {
					return 'error';
				}			
			} else {
				return 'error';
			}
		}
	}

	public function update_password(){
		$this->db->where('username',$this->session->userdata('user'));
		$data = array (
			'password' => md5($this->input->post('txtNewPass'))
			);
		$query = $this->db->update('user_account',$data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function view_accounts(){
		return $this->db->get('user_account')->result();
	}

	public function find_account($id){
		$this->db->where('employee_id',$id);
		return $this->db->get('user_account')->result();
	}

	public function update_account($id){
		$this->db->where('employee_id',$id);

		$data = array (
			'username' => $this->input->post('txtUsername'),
			'password' => md5($this->input->post('txtPassword')),
			'email' => $this->input->post('txtEmail'), 
			'secret_question' => $this->input->post('txtSecretQuestion'),
			'secret_answer' => $this->input->post('txtSecretAnswer')
			);
		$query = $this->db->update('user_account',$data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}


}