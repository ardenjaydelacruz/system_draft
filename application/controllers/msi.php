<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msi extends MY_Controller {
	
	public function __construct(){
		parent::__construct();	
		
	}
	public function index(){
		$this->login();
	}
	public function login(){
		if(Users::validLogin()){
			$this->login_model->set_session();
			$this->login_model->get_profile();
			$this->session->set_userdata('welcome',1);
			Audit_trail_model::auditLogin();
			redirect('ems/dashboard');
		}
		$this->load->view('init');
		$this->load->view('login/login');

		$this->display_notif();
	}
	
	public function logout(){
		Audit_trail_model::auditLogout();
		$this->session->sess_destroy();
		redirect('msi/login');
	}
}