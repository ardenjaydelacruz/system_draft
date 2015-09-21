\<?php
class Audit_trail_model extends ActiveRecord\Model {
    static $table_name = 'tbl_audit_trail';
    static $primary_key = 'audit_trail_id';

    public function auditLogin(){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('first_name'),
    		'action' => 'Logged in'
    		);
    	Audit_trail_model::create($data);
    }
    public function auditLogout(){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('first_name'),
    		'action' => 'Logged out'
    		);
    	Audit_trail_model::create($data);
    }

    public function auditAddEmp($id){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('first_name'),
    		'action' => 'CREATED Employee Profile',
    		'employee_id' => $id
    		);
    	Audit_trail_model::create($data);
    }
    
    public function auditDeleteEmp($id){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('first_name'),
    		'action' => 'DELETED Employee Profile',
    		'employee_id' => $id
    		);
    	Audit_trail_model::create($data);
    }

    public function auditUpdateEmp($id){
    	$data = array(
    		'ip_address' => $this->input->ip_address(),
    		'user_level' => $this->session->userdata('user_level'),
    		'username' => $this->session->userdata('first_name'),
    		'action' => 'UPDATED Employee Profile',
    		'employee_id' => $id
    		);
    	Audit_trail_model::create($data);
    }

    public function auditLeave($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Employee '.$details['employee_id'].' requested leave'
            );
        Audit_trail_model::create($data);
    }

    public function auditUpdateLeave($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Leave Request '. $details['leave_status'].' by '. $details['approved_by']
            );
        Audit_trail_model::create($data);
    }

    public function auditPerformance($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Evaluated Employee'. $details['assessee_id']
            );
        Audit_trail_model::create($data);
    }

    public function auditNewProject($proj){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Added new project: '. $proj
            );
        Audit_trail_model::create($data);
    }

    public function auditProjectPersonnel($data){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Added employee '.$data['employee_id'] .' to Project '.$data['project_id'],
            'employee_id' => $data['employee_id']
            );
        Audit_trail_model::create($data);
    }

    public function auditSupervision($data){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Assigend Employee '.$data['employee_id'] .' to Supervisor '.$data['supervisor_id'],
            'employee_id' => $data['employee_id']
            );
        Audit_trail_model::create($data);
    }

    public function auditNewItem($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Added new Inventory: '. $details['item_name']
            );
        Audit_trail_model::create($data);
    }

    public function auditRestock($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Added '.$details['quantity'].' pieces to Item ' .$details['item_id']
            );
        Audit_trail_model::create($data);
    }

    public function auditEditItems($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Edited Info of Item '.$details['item_id']
            );
        Audit_trail_model::create($data);
    }

    public function auditDeleteItem($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Deleted Item '.$details
            );
        Audit_trail_model::create($data);
    }

    public function auditNewAsset($details){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Added New Asset '.$details['asset_name']
            );
        Audit_trail_model::create($data);
    }

    public function auditAssignAsset($details,$id){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Assigned Asset '.$id .' to Employee '. $details['employee_id']
            );
        Audit_trail_model::create($data);
    }

    public function auditBackup(){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Backed up database'
            );
        Audit_trail_model::create($data);
    }

    public function auditAnnouncement(){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Posted an Announcement'
            );
        Audit_trail_model::create($data);
    }

    public function auditAddLeave($id){
        $data = array(
            'ip_address' => $this->input->ip_address(),
            'user_level' => $this->session->userdata('user_level'),
            'username' => $this->session->userdata('first_name'),
            'action' => 'Added Leave to Employee ' .$id
            );
        Audit_trail_model::create($data);
    }
}