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
				'username' => $row->username,
				'user_level' => $row->user_level,
				'logged_in' => TRUE
				);
			$this->session->set_userdata($session_data);
		}
	}
}