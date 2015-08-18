<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $master_layout;
    
	public function __construct(){
		parent::__construct();
		$this->load->library("pagination");
        // $this->load->model('login_model');
        $this->load->model('Performance');
        $this->load->model('reports_model');
        $this->load->model('print_reports_model');
        $this->load->library('user_agent');

        // if ($this->ion_auth->logged_in()==false && uri_string() != 'auth/login'){
        //     redirect('auth/login');
        // }
        if ($this->session->userdata('logged_in') == false && uri_string() != 'auth/login') {
            redirect('auth/login');
        }
    
        $this->output->enable_profiler(TRUE);
        $sections = array(
        'config'  => TRUE,
        'queries' => TRUE
        );

        $this->output->set_profiler_sections($sections);


        // if ($this->session->userdata('user_level') == 'Administrator') {
        // 	$this->master_layout = 'layout/admin-master';
        // } elseif ($this->session->userdata('user_level') == 'Manager') {
        //  	$this->master_layout = 'layout/manager-master';
        // } elseif ($this->session->userdata('user_level') == 'Employee') {
        //  	$this->master_layout = 'layout/employee-master';
        // }

        if ($this->session->userdata('user_level') == 'Administrator') {
            $this->master_layout = 'layout/admin-master';
        } elseif ($this->session->userdata('user_level') == 'Employee') {
            $this->master_layout = 'layout/employee-master';
        } elseif ($this->session->userdata('user_level') == 'HR Manager') {
            $this->master_layout = 'layout/manager-master';
        } elseif ($this->session->userdata('user_level') == 'Accounting Manager') {
            $this->master_layout = 'layout/accounting-master';
        } elseif ($this->session->userdata('user_level') == 'Operations Manager') {
            $this->master_layout = 'layout/operation-master';
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

     public function display_notif($message=null)
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

        if ($message!=null){
            $this->toast($message, 'success');
        }
    }

    public function generateMonths(){
        $months = array();
        array_push($months, array("id"=>"01", "value"=>"January"));
        array_push($months, array("id"=>"02", "value"=>"February"));
        array_push($months, array("id"=>"03", "value"=>"March"));
        array_push($months, array("id"=>"04", "value"=>"April"));
        array_push($months, array("id"=>"05", "value"=>"May"));
        array_push($months, array("id"=>"06", "value"=>"June"));
        array_push($months, array("id"=>"07", "value"=>"July"));
        array_push($months, array("id"=>"08", "value"=>"August"));
        array_push($months, array("id"=>"09", "value"=>"September"));
        array_push($months, array("id"=>"10", "value"=>"October"));
        array_push($months, array("id"=>"11", "value"=>"November"));
        array_push($months, array("id"=>"12", "value"=>"December"));
        return $months;
    }
    
    public function generateYears($order = 'asc'){
        $years = array();
        if($order=='asc'){
            $yearStart = 1970;
            $yearEnd = date("Y");
            for($year=$yearEnd; $year>=intval($yearStart); $year--){
                array_push($years, $year);
            }
        }else if($order=='desc'){
            $yearStart = date("Y");
            $yearEnd = 1970;
            for($year=$yearEnd; $year<=intval($yearStart); $year++){
                array_push($years, $year);
            }
        }
        return $years;
    }
}