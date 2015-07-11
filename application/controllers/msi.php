<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msi extends MY_Controller {
	
	public function __construct(){
		parent::__construct();	
	}

	public function index(){
		// $user = User::find('all');
		// foreach ($user as $row) {
		// 	echo $row->username.'<br>';
		// }
		$this->login();
	
	}

	/* =====================================
					LOGIN
	   ===================================== */ 

	public function login(){
		$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|callback_validate_data');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|md5');

		if($this->form_validation->run()){
			$this->login_model->set_session();
			$this->login_model->get_profile();
			$this->session->set_userdata('welcome',1);
			redirect('ems/dashboard');
		}
		// $this->display_navbar('Login - MSInc.');
		$this->load->view('init');
		$this->load->view('login/login');
		if($this->session->userdata('registered')){
			$this->toast('Registration Successful!', 'success');
			$this->session->unset_userdata('registered');
		}
		
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

	/* =====================================
					SIGN UP
	   ===================================== */ 

	public function signup(){
		$this->form_validation->set_rules('txtUsername', 'Username', 'trim|required|is_unique[user_account.username]|min_length[6]');
		$this->form_validation->set_rules('txtPassword', 'Password', 'trim|required|min_length[8]');		
		$this->form_validation->set_rules('txtCPassword', 'Confirm Password', 'trim|required|matches[txtPassword]|min_length[8]');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
		$this->form_validation->set_rules('txtUserLevel', 'User Level', 'trim|required');
		$this->form_validation->set_rules('txtQuestionList', 'Secret Question', 'trim|required');
		$this->form_validation->set_rules('txtAnswer', 'Secret Answer', 'trim|required');

		$this->form_validation->set_message('is_unique', 'The Username is already taken.');

		$this->display_navbar('Sign Up - MSInc.');

		if($this->form_validation->run()){
			if ($this->login_model->addEmployee()) {
				$this->session->set_userdata('registered',1);
				redirect('msi/login');
			} 
		} else {
			if(isset($_POST['btnSubmit']))
				$this->load->view('login/signup_error');
		}
                
		$this->load->view('login/signup');
		$this->load->view('components/footer');
	}

	public function signup_success(){
		$this->load->view('login/signup_success');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('msi/login');
	}


	/* =====================================
				FORGOT PASSWORD
	   ===================================== */ 

	public function reset_password(){
		$this->form_validation->set_rules('txtUserChange', 'Username', 'trim|required|callback_is_registered');
	
		$this->display_navbar('Reset Password - MSInc.');
		if($this->form_validation->run()){
			$this->secret_question();
		} else { 
			$this->load->view('login/reset_password');
			$this->load->view('components/footer');
		}	
	}

	public function is_registered(){
		if(!$this->login_model->is_registered()){
			$this->form_validation->set_message('is_registered','Username does not exists.');
			return false;
		} else {
			$this->session->set_userdata('request_changepass',true);
			return true;
		}
	}

	public function secret_question(){
		if ($this->session->userdata('request_changepass')==true){

			if (isset($_POST['btnQuestion'])){
				$this->form_validation->set_rules('txtQuestion', 'Secret Question', 'required|callback_validate_question');
				$this->form_validation->set_rules('txtAnswer', 'Secret Answer', 'trim|required');

				if($this->form_validation->run()){
					redirect('msi/save_new_pass');
				} 
			}
			$this->load->view('login/secret_question');
			$this->load->view('components/footer');				
		} else {
			redirect('msi');
		}	
	}

	public function validate_question(){
		$question = $this->login_model->valid_answer();
		if($question=='success'){
			return true;
		} else {
			$this->form_validation->set_message('validate_question', 'Secret question/answer is incorrect.');
			return false;
		}
	}

	public function save_new_pass(){
		if ($this->session->userdata('request_changepass')==true){
			$this->display_navbar('Change Password - MSInc.');
			if (isset($_POST['btnSaveNewPass'])){
				$this->form_validation->set_rules('txtNewPass', 'New Password', 'trim|required|min_length[8]');
				$this->form_validation->set_rules('txtCNewPass', 'Confirm New Password', 'trim|required|matches[txtNewPass]|min_length[8]');

				if($this->form_validation->run()){
					if($this->login_model->update_password()){
						$this->load->view('login/changepass_success');
						$this->session->unset_userdata('request_changepass');
					}
				}
			}
			$this->load->view('login/change_pass');
			$this->load->view('components/footer');				
		} else {
			redirect('msi');
		}	
	}

	public function user_changepass(){
		$this->session->set_userdata('request_changepass',true);
		$this->save_new_pass();
	}

}