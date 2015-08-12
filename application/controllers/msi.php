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
			redirect('ems/dashboard');
		}
		$this->load->view('init');
		$this->load->view('login/login');
		$this->display_notif();
	}

	public function validate_data(){
		$user = $this->login_model->login_employee();
		if ($user == 'Not registered') {
			$this->form_validation->set_message('validate_data','Username does not exists.');
			return false;
		} elseif ($user == 'Incorrect password') {
			$this->form_validation->set_message('validate_data','Username and Password does not match.');
	 		return false;
		} elseif ($user == 'login success') {
			return true; // no error
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('msi/login');
	}
}