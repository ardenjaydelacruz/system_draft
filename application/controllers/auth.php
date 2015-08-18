<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MY_Controller {
	
	public function __construct(){
		parent::__construct();	
		
	}
	public function index(){
		$this->login();
	}
	public function login(){
		if($this->validLogin()){
			View_users_model::set_session();
			$this->session->set_userdata('welcome',1);
			Audit_trail_model::auditLogin();
			$userlevel = $this->session->userdata('user_level');
			if ($userlevel=='Administrator'){
				redirect('ems/admin_dashboard');
			} elseif ($userlevel=='HR Manager'){
				redirect('ems/hr_dashboard');
			} elseif ($userlevel=='Operations Manager'){
				redirect('ems/oper_dashboard');
			} elseif ($userlevel=='Accounting Manager'){
				redirect('ems/acc_dashboard');
			} elseif ($userlevel=='Employee'){
				redirect('ems/emp_dashboard');
			}
			
			// dump($this->validLogin());
		}
		$this->load->view('init');
		$this->load->view('login/login');
		$this->display_notif();
	}
	
	public function logout(){
		Audit_trail_model::auditLogout();
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	public function validate_data(){
		$user = View_users_model::login_employee();
		if ($user == 'Not registered') {
			$this->form_validation->set_message('validate_data','Username does not exists.');
			return false;
		} elseif ($user == 'Incorrect password') {
			$this->form_validation->set_message('validate_data','Username and Password does not match.');
	 		return false;
		} elseif ($user == 'Success') {
			return true; // no error
		}
	}

	public function validLogin(){
		$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|callback_validate_data');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required');
		if($this->form_validation->run()){
			return true;
		} else {
			return false;
		}
	}
}