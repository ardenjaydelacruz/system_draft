<?php
class Audit_trail_model extends ActiveRecord\Model {
    static $table_name = 'tbl_audit_trail';
    static $primary_key = 'audit_trail_id';

    public function auditLogin(){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('username'),
    		'action' => 'Logged in'
    		);
    	Audit_trail_model::create($data);
    }
    public function auditLogout(){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('username'),
    		'action' => 'Logged out'
    		);
    	Audit_trail_model::create($data);
    }

    public function auditAddEmp($id){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('username'),
    		'action' => 'CREATED Employee Profile',
    		'employee_id' => $id
    		);
    	Audit_trail_model::create($data);
    }
    public function auditDeleteEmp($id){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('username'),
    		'action' => 'DELETED Employee Profile',
    		'employee_id' => $id
    		);
    	Audit_trail_model::create($data);
    }
}