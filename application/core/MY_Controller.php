<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $master_layout;
    
	public function __construct(){
		parent::__construct();
		$this->load->library("pagination");
        $this->load->model('ems_model');
        $this->load->model('ams_model');
        $this->load->model('login_model');
        $this->load->model('Performance');

        if ($this->session->userdata('user_level') == 'Administrator') {
        	$this->master_layout = 'layout/admin-master';
        } elseif ($this->session->userdata('user_level') == 'Manager') {
         	$this->master_layout = 'layout/manager-master';
        } elseif ($this->session->userdata('user_level') == 'Employee') {
         	$this->master_layout = 'layout/employee-master';
        }
	}

	public function toast($message, $type)
    {
        $data['message'] = $message;
        if ($type == 'success') {
            $this->load->view('layout/toast_success', $data);
        } elseif ($type == 'error') {
            $this->load->view('layout/toast_error', $data);
        }
    }

     public function display_notif()
    {
        if ($this->session->userdata('added')) {
            $this->toast('Successful! Record has been added.', 'success');
            $this->session->unset_userdata('added');
        }
        if ($this->session->userdata('deleted')) {
            $this->toast('Successful! Record has been deleted.', 'success');
            $this->session->unset_userdata('deleted');
        }
        if ($this->session->userdata('edited')) {
            $this->toast('Successful! Record has been updated.', 'success');
            $this->session->unset_userdata('edited');
        }
        if ($this->session->userdata('uploaded')) {
            $this->toast('Successful! Photo has been changed.', 'success');
            $this->session->unset_userdata('uploaded');
        }
        if ($this->session->userdata('welcome')) {
            $this->toast('Welcome! ' . $this->session->userdata('user_level') . ' ' . $this->session->userdata('first_name'), 'success');
            $this->session->unset_userdata('welcome');
        }
        if($this->session->userdata('registered')){
            $this->toast('Registration Successful!', 'success');
            $this->session->unset_userdata('registered');
        }
    }
}