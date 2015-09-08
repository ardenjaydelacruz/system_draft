<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mobile extends MY_Controller {
	
	public function __construct(){
		parent::__construct();	
	}

	public function logout(){
		$this->update_logged_status($id,$value);
	}
	
}