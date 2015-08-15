<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model {

	/* =====================================
				LOGIN /REGISTRATION
	   ===================================== */

	

	// public function login_employee(){
	// 	$this->db->where('username',$this->input->post('txtUsername'));
	// 	$query = $this->db->get('tbl_user');
	// 	$this->db->limit(1);
	// 	$row = $query->row();
		
	// 	if($query->num_rows()){
	// 		if ($row->password == md5($this->input->post('txtPassword'))){
	// 			return 'login success';
	// 		} else {
	// 			return 'Incorrect password';
	// 		}
	// 	} else {
	// 		return 'Not registered';
	// 	}
	// }

	
}