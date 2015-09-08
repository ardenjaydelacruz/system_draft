<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MY_Controller {
	
	public function __construct(){
		parent::__construct();	
	}
	public function index(){
		$this->login();
	}
	public function login(){
		if ($this->session->userdata('logged_in') == 1){
            redirect('ems/admin_dashboard');
        }
		if($this->validLogin()){
			View_users_model::set_session();
			$this->session->set_userdata('welcome',1);
			Audit_trail_model::auditLogin();
			$userlevel = $this->session->userdata('user_level');
			Users::login_employee($this->session->userdata('employee_id'));
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
		$this->load->view('layout/login');
		$this->display_notif();
	}
	
	public function logout(){
		Audit_trail_model::auditLogout();
		Users::logout_employee($this->session->userdata('employee_id'));
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
		} elseif ($user == 'Logged'){
			$this->form_validation->set_message('validate_data','User is already logged in.');
	 		return false;
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

	public function mobile_login(){
		if ($this->input->post('txtUsername') || $this->input->post('txtPassword')){
			$user = View_users_model::login_employee();
			if ($user == 'Not registered') {
				$response["success"] = 0;
				$response["message"] = "Username is not registered";
			} elseif ($user == 'Incorrect password') {
				$response["success"] = 0;
				$response["message"] = "Username and Password does not match";
			} elseif ($user == 'Success') {
				$user = View_users_model::find_by_username($this->input->post('txtUsername'));
				Users::login_employee($user->employee_id,1);
				$response['employee'] = $this->reports_model->getEmpInfo($user->employee_id);
			} elseif ($user == 'Logged'){
				$response["success"] = 0;
				$response["message"] = "User is already logged in ";
			}
		} else {
			$response["success"] = 0;
			$response["message"] = "Username and Password Field is required";
		}
		echo json_encode($response);
	}
}