<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mobile extends MY_Controller {
	
	public function __construct(){
		parent::__construct();	
	}

	public function logout(){
		$this->reports_model->update_logged_status($id,$value);
	}

	public function leave_request(){
		Leave_request_model::mobile_process_leave();
	}
	
}