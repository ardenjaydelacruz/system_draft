<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	public function __construct() {
        parent:: __construct();
        $this->load->library("pagination");
        $this->load->model('ems_model');
        $this->load->model('ams_model');
        $this->load->model('login_model');
        $this->load->model('performance_model');
        $this->load->model('leave_model');
    }
    
	public function index(){
		$this->dashboard();
	}

	/* =====================================
				Validate Login
	   ===================================== */ 
	public function is_logged_in(){
		if ($data['username']  = $this->session->userdata('username')){
			return true;
		} else {
			return false;
		}
	}

	public function display_navbar($title){
		$logged = $this->is_logged_in();
		$data['pageTitle'] = $title;
		$this->load->view('init',$data);
		if ($logged){
			$data['user_level'] = $this->session->userdata('user_level');
			$data['firstname']  = $this->session->userdata('first_name');
			$data['lastname']  = $this->session->userdata('last_name');
			$data['profile_image'] = $this->session->userdata('image');
			$this->load->view('components/navbar_logged',$data);
			$this->load->view('components/sidebar_admin',$data);
			$this->load->model('ems_model');
		} else {
			$this->load->view('components/navbar',$data);
		}
	}

	public function toast($message, $type){
		$data['message'] = $message;

		if ($type == 'success') {
			$this->load->view('components/toast_success',$data);	
		} elseif ($type == 'error') {
			$this->load->view('components/toast_error',$data);	
		}
	}

	public function dashboard(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Dashboard - MSInc.');

			$userLevel = $this->session->userdata('user_level');
			$firstname = $this->session->userdata('first_name');

			$data['total_employee'] = $this->ems_model->record_count();
			$data['total_asset'] = $this->ams_model->record_count();
			if($userLevel == 'Administrator'){
				$this->load->view('ems/admin_dashboard',$data);
			} elseif ($userLevel == 'Manager'){
				$this->load->view('components/manager_dashboard');
			} elseif ($userLevel == 'Employee'){
				$this->load->view('components/employee_dashboard');
			}
			$this->load->view('components/footer');
			if ($this->session->userdata('welcome')){
				$this->toast('Welcome! ' .$userLevel.' '.$firstname, 'success');
				$this->session->unset_userdata('welcome');
			}
		} else {
			redirect('msi');
		}
	}

/*  =================================================================================
	=																				=
	=						EMPLOYEE MANAGEMENT SYSTEM 								=
	=																				=
	=================================================================================  */ 

	/* =====================================
				View Employees
	   ===================================== */ 
	public function employees(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Employees - MSInc.');
			$this->load->view('components/sidebar_admin');

			$config["base_url"] = base_url() . "admin/employees";
		    $config["total_rows"] = $this->ems_model->record_count();
		    $config["per_page"] = 15;
		    $config["uri_segment"] = 3;
		    $choice = $config["total_rows"] / $config["per_page"];

		    $config["num_links"] = round($choice);

		    //config for bootstrap pagination class integration
	        $config['full_tag_open'] = '<ul class="pagination zero">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li>';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '&laquo';
	        $config['prev_tag_open'] = '<li class="prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '&raquo';
	        $config['next_tag_open'] = '<li>';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li>';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li>';
	        $config['num_tag_close'] = '</li>';
		    $this->pagination->initialize($config);
		    $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;

		    $data['total_employee'] = $this->ems_model->record_count();
		    $data["record"] = $this->ems_model->fetch_record($config["per_page"], $page);
		    $data["links"] = $this->pagination->create_links();

	    	$this->load->view("ems/employees_table", $data);

	    	$this->load->view('components/footer');
	    	if ($this->session->userdata('added')){
				$this->toast('Successful! Record has been added.', 'success');
				$this->session->unset_userdata('added');
			}
			if ($this->session->userdata('deleted')){
				$this->toast('Successful! Record has been deleted.', 'success');
				$this->session->unset_userdata('deleted');
			}
			if ($this->session->userdata('edited')){
				$this->toast('Successful! Record has been updated.', 'success');
				$this->session->unset_userdata('edited');
			}
			if ($this->session->userdata('uploaded')){
				$this->toast('Successful! Photo has been changed.', 'success');
				$this->session->unset_userdata('uploaded');
			}
		} else {
			redirect('msi');
		}
		
	}

	/* =====================================
				Search Employee
	   ===================================== */ 
   	public function search_employee(){
   		if($this->session->userdata('logged_in')==true){
	   		if($this->input->post('txtSearch')){
	   			$this->display_navbar('Employees - MSInc.');
				$this->load->view('components/sidebar_admin');

				$data['total_employee'] = $this->ems_model->record_count();
				$data['record'] = $this->ems_model->search_employee();

				$this->load->view("ems/employees_table", $data);

				$this->load->view('components/footer');

				if ($this->input->get('deleted')){
					$this->toast('Successful! Record has been deleted.', 'success');
				} elseif ($this->input->get('added')){
					$this->toast('Successful! Record has been added.', 'success');
				} elseif ($this->input->get('edited')){
					$this->toast('Successful! Record has been updated.', 'success');
				} else {
					$this->toast(count($data['record'])." Record(s) has been found.", 'success');
				}
	   		} else {
				redirect('admin/employees');
	   		}
	   	} else {
			redirect('msi');
		}
   	}

	/* =====================================
				Add Employee
	   ===================================== */ 
	public function add_employee(){
		if($this->session->userdata('logged_in')==true){
			$this->form_validation->set_rules('txtEmpID', 'Employee ID', 'trim|required');
			$this->form_validation->set_rules('txtEmpPosition', 'Position', 'trim|required');
			$this->form_validation->set_rules('txtEmpStatus', 'Employee Status', 'trim|required');
			$this->form_validation->set_rules('txtEmpDepartment', 'Employee Department', 'trim|required');

			$this->form_validation->set_rules('txtFirstName', 'First Name', 'trim|required');
			$this->form_validation->set_rules('txtMiddleName', 'Middle Name', 'trim');
			$this->form_validation->set_rules('txtLastName', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('txtGender', 'Gender', 'trim|required');
			$this->form_validation->set_rules('txtBday', 'Birthday', 'trim|required');
			$this->form_validation->set_rules('txtStatus', 'Marital Status', 'trim|required');

			$this->form_validation->set_rules('txtStreet', 'Street', 'trim|required');
			$this->form_validation->set_rules('txtBarangay', 'Barangay', 'trim|required');
			$this->form_validation->set_rules('txtCity', 'City', 'trim|required');
			$this->form_validation->set_rules('txtState', 'State', 'trim|required');
			$this->form_validation->set_rules('txtZip', 'Zip Code', 'trim|required');
			$this->form_validation->set_rules('txtCountry', 'Country', 'trim|required');

			if ($this->form_validation->run()){
				$this->load->model('ems_model');
				if ($this->ems_model->add_record()){
					$this->session->set_userdata('added',1);
					redirect('admin/employees');
				} 
			}
				$this->display_navbar('Add Employee - MSInc.');
				$this->load->view('components/sidebar_admin');
				$this->load->view('ems/add_employee');
				$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	/* =====================================
				Delete Employee
	   ===================================== */ 
	public function delete_employee(){
		$this->display_navbar('Delete Employee - MSInc.');

		$id = $this->input->get('emp_id');
		$this->ems_model->delete_employee($id);
		$this->session->set_userdata('deleted',1);
		redirect('admin/employees');
	}

	/* =====================================
				View Details
	   ===================================== */ 
	public function view_details(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Employee Details - MSInc.');

			$id = $this->input->get('emp_id');
			
			$this->load->model('login_model');
			$data['account'] = $this->login_model->find_account($id);
			$data['record'] = $this->ems_model->view_emp_details($id);
			$this->load->view('ems/employee_details',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}		
	}

	public function view_accounts(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('User Accounts - MSInc.');
			$this->load->model('login_model');
			$data['record'] = $this->login_model->view_accounts();

			$this->load->view('ems/view_user',$data);
			$this->load->view('components/footer');
		} else {
		redirect('msi');
		}	
	}

	/* =====================================
				 Edit Employee
	   ===================================== */ 
	public function edit_employee(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Employee Details - MSInc.');

			$id = $this->input->get('emp_id');
			$data['record'] = $this->ems_model->view_emp_details($id);
			$this->load->view('ems/edit_employee',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	/* =====================================
			Update Employee Record
	   ===================================== */ 
	public function update_employee(){
		if($this->session->userdata('logged_in')==true){
			$id = $this->input->get('emp_id');
			$this->display_navbar('Employee Details - MSInc.');
			$this->ems_model->update_record($id);
			$this->login_model->update_account($id);

			if ($this->ems_model->update_record($id) || $this->login_model->update_account($id)){
					$this->session->set_userdata('edited',1);
			 		redirect('admin/employees');
			 	} 

			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function upload_image(){
		if($this->session->userdata('logged_in')==true){
			$id = $this->input->get('emp_id');
			if($this->input->post('btnUpload')){
				$this->display_navbar('Employee Details - MSInc.');
				$this->load->view('components/footer');

				if ($this->ems_model->do_upload($id)){
					redirect("admin/view_details?emp_id=$id");
				}
			}
		}
	}

	/* =====================================
			Employee Performance
	   ===================================== */ 
	public function view_performance(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Employees - MSInc.');
			$this->load->view('components/sidebar_admin');

			$config["base_url"] = base_url() . "admin/view_performance";
		    $config["total_rows"] = $this->performance_model->record_count();

		    $data['total_performance'] = $this->performance_model->record_count();
		    $data["record"] = $this->performance_model->fetch_record($config["per_page"], $page);
		    $data["links"] = $this->pagination->create_links();

			$this->load->view("ems/performance_table",$data);

	    	$this->load->view('components/footer');
	    	if ($this->session->userdata('added')){
				$this->toast('Successful! Record has been added.', 'success');
				$this->session->unset_userdata('added');
			}
			if ($this->session->userdata('deleted')){
				$this->toast('Successful! Record has been deleted.', 'success');
				$this->session->unset_userdata('deleted');
			}
			if ($this->session->userdata('edited')){
				$this->toast('Successful! Record has been updated.', 'success');
				$this->session->unset_userdata('edited');
			}

		} else {
			redirect('msi');
		}
	}

	public function view_performance_details(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Evaluation Details - MSInc.');

			$id = $this->input->get('performance_id');
			$data['record'] = $this->performance_model->view_performance_details($id);
			$this->load->view('ems/performance_details',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}		
	}

	public function evaluate_employee(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Evaluate Employee - MSInc.');

			$this->session->set_userdata('empID',$this->input->get('emp_id'));
			$id = $this->session->userdata('empID');
			$this->ems_model->get_employee($id);	
			$data['name'] = $this->session->userdata('emp_firstname').' '.$this->session->userdata('emp_middlename').' '.$this->session->userdata('emp_lastname');
			$this->load->view('ems/evaluate_employee',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}		
	}

	public function process_evaluation(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Evaluate Employee - MSInc.');
			$id = $this->session->userdata('empID');
			
			if ($this->performance_model->add_evaluation()){
				$this->session->unset_userdata('emp_id');
				$this->session->unset_userdata('emp_firstname');
				$this->session->unset_userdata('emp_middlename');
				$this->session->unset_userdata('emp_lastname');
				$this->session->set_userdata('added',1);
				redirect('admin/employees');
			} else {
				echo "huhuu";
			}
			$this->load->view('components/footer');
		} else {
		redirect('msi');
		}	
	}

	


	/* =====================================
				Employee Leaves
	   ===================================== */ 
	public function request_leave(){
		$id = $this->input->get('emp_id');
		$data['record'] = $this->ems_model->view_emp_details($id);
		
		$this->display_navbar('Add Employee - MSInc.');
		$this->load->view('components/sidebar_admin');
		$this->load->view('ems/request_leave', $data);
		$this->load->view('components/footer');
	}

	public function process_leave(){
		$this->form_validation->set_rules('leaveStarts', 'Leave Starts', 'trim|required');
		$this->form_validation->set_rules('leaveEnds', 'Leave Ends', 'trim|required');
		$this->form_validation->set_rules('type', 'Type of leave', 'trim|required');

		$id = $this->input->get('emp_id');
		$name = $this->input->get('emp_name');
		$leaves = $this->input->get('leaves');
		if ($this->form_validation->run()){
			if ($this->leave_model->makeLeave($id,$name,$leaves)){
				$this->session->set_userdata('added',1);
				redirect('admin/leaves_table');
			} 
		}	
	}

	public function leaves_table(){
		$this->display_navbar('Leaves table - MSInc.');

		$data['record'] = $this->leave_model->leaves_table();

		$this->load->view('components/sidebar_admin');
		$this->load->view('ems/leaves_table', $data);
		$this->load->view('components/footer');

		if ($this->session->userdata('added')){
				$this->toast('Successful! Leave has been submitted.', 'success');
				$this->session->unset_userdata('added');
			}
	}

	public function delete_leave(){
		$this->display_navbar('Delete Leave - MSInc.');

		$id = $this->input->get('leave_id');
		$this->leave_model->delete_leave($id);
		$this->session->set_userdata('deleted',1);
		redirect('admin/leaves_table');
	}

	public function update_leave_status(){
		$this->display_navbar('Update Leave - MSInc.');

		$status = $this->input->get('leave_status');
		$leave_id = $this->input->get('leave_id');
		$days = $this->input->get('days');
		$emp_id = $this->input->get('emp_id');
		$leaves = $this->input->get('leaves');

		if ($this->leave_model->update_leave($leave_id,$emp_id,$status,$days,$leaves)){
			 redirect('admin/leaves_table');
		}
	}

	public function view_leave_details(){
		$this->display_navbar('View Leave Details - MSInc.');

		$id = $this->input->get('leave_id');
		$data['record'] = $this->leave_model->view_leave_info($id);
		$this->load->view('ems/leave_details',$data);
		$this->load->view('components/footer');
	}


	public function promotion(){
		if($this->session->userdata('logged_in')==true){

			$this->display_navbar('Evaluate Employee - MSInc.');
			$this->load->view('ems/upload');
			$this->load->view('components/footer');
		} else {
		redirect('msi');
		}	
	}

/*  =================================================================================
	=																				=
	=						PAYROLL MANAGEMENT SYSTEM 								=
	=																				=
	=================================================================================  */ 


/*  =================================================================================
	=																				=
	=						ASSET MANAGEMENT SYSTEM 								=
	=																				=
	=================================================================================  */ 

	/* =====================================
					View assets
	   ===================================== */
	public function view_assets(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Assets - MSInc.');
			$this->load->view('components/sidebar_admin');

			$config["base_url"] = base_url() . "admin/view_assets";
		    $config["total_rows"] = $this->ams_model->record_count();
		    $config["per_page"] = 15;
		    $config["uri_segment"] = 3;
		    $choice = $config["total_rows"] / $config["per_page"];

		    $config["num_links"] = round($choice);

		    //config for bootstrap pagination class integration
	        $config['full_tag_open'] = '<ul class="pagination zero">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li>';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '&laquo';
	        $config['prev_tag_open'] = '<li class="prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '&raquo';
	        $config['next_tag_open'] = '<li>';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li>';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li>';
	        $config['num_tag_close'] = '</li>';
		    $this->pagination->initialize($config);
		    $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;

		    $data['total_asset'] = $this->ams_model->record_count();
		    $data["record"] = $this->ams_model->fetch_record($config["per_page"], $page);
		    $data["links"] = $this->pagination->create_links();

	    	$this->load->view("ams/asset_table", $data);

			$this->load->view('components/footer');
			if ($this->session->userdata('added')){
				$this->toast('Successful! Record has been added.', 'success');
				$this->session->unset_userdata('added');
			}
			if ($this->session->userdata('deleted')){
				$this->toast('Successful! Record has been deleted.', 'success');
				$this->session->unset_userdata('deleted');
			}
			if ($this->session->userdata('edited')){
				$this->toast('Successful! Record has been updated.', 'success');
				$this->session->unset_userdata('edited');
			}
		} else {
			redirect('msi');
		}

	}

	public function add_asset(){
		if($this->session->userdata('logged_in')==true){
			$this->form_validation->set_rules('txtAssetID', 'Asset ID', 'trim|required');
			$this->form_validation->set_rules('txtSerial', 'Serial Number', 'trim|required');
			$this->form_validation->set_rules('txtBrand', 'Asset Brand', 'trim|required');
			$this->form_validation->set_rules('txtModel', 'Asset Model', 'trim|required');
			$this->form_validation->set_rules('txtVendor', 'Asset Vendor', 'trim|required');
			$this->form_validation->set_rules('txtCategory', 'Asset Category', 'trim');
			$this->form_validation->set_rules('txtDateAcquired', 'Date Acquired', 'trim|required');
			$this->form_validation->set_rules('txtWarrantyStart', 'Warranty Start Date', 'trim|required');
			$this->form_validation->set_rules('txtWarrantyEnd', 'Warranty End Date', 'trim|required');
			

			if ($this->form_validation->run()){
				
				if ($this->ams_model->add_record()){
					$this->session->set_userdata('added',1);
					redirect('admin/view_assets');
				} 
			}
			$this->display_navbar('Add Asset - MSInc.');
			$this->load->view('components/sidebar_admin');
			$this->load->view('ams/add_asset');
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function delete_asset(){
		$this->display_navbar('Delete Asset - MSInc.');

		$id = $this->input->get('asset_id');
		$this->ams_model->delete_record($id);
		$this->session->set_userdata('deleted',1);
		redirect('admin/view_assets');
		
	}

	public function search_asset(){
		if($this->session->userdata('logged_in')==true){
			if($this->input->post('txtSearch')){
	   			$this->display_navbar('Assets - MSInc.');
				$this->load->view('components/sidebar_admin');

				$data['total_asset'] = $this->ams_model->record_count();
				$data['record'] = $this->ams_model->search_asset();

				$this->load->view("ams/asset_table", $data);

				$this->load->view('components/footer');

				if ($this->session->userdata('deleted')){
					$this->toast('Successful! Record has been deleted.', 'success');
					$this->session->unset_userdata('deleted');
				} elseif ($this->session->userdata('added')){
					$this->toast('Successful! Record has been added.', 'success');
					$this->session->unset_userdata('added');
				} elseif ($this->session->userdata('edited')){
					$this->toast('Successful! Record has been updated.', 'success');
					$this->session->unset_userdata('edited');
				} else {
					$this->toast(count($data['record'])." Record(s) has been found.", 'success');
				}
	   		} else {
				redirect('admin/view_assets');
	   		}
	   	} else {
			redirect('msi');
		}
	}

	public function view_asset_details(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Asset Details - MSInc.');

			$id = $this->input->get('asset_id');
			$data['record'] = $this->ams_model->view_details($id);
			$this->load->view('ams/asset_details',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}		
	}

	public function edit_asset(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Edit Asset - MSInc.');

			$id = $this->input->get('asset_id');
			$data['record'] = $this->ams_model->view_details($id);
			$this->load->view('ams/edit_asset',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}		
	}

	public function update_asset(){
		if($this->session->userdata('logged_in')==true){
			$id = $this->input->get('asset_id');
			$this->display_navbar('Asset Details - MSInc.');

			if ($this->ams_model->update_record($id)){
				$id = $this->input->get('asset_id');
					$this->session->set_userdata('edited',1);
			 		redirect('admin/view_assets');
			 	} 

			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function view_bom(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Asset Details - MSInc.');

			$data['record'] = $this->ams_model->view_bom();
			$this->load->view('ams/bom_table',$data);

			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function view_vendors(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Asset Details - MSInc.');

			$data['record'] = $this->ams_model->view_vendors();
			$this->load->view('ams/vendors_table',$data);

			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function purchase_stocks(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Asset Details - MSInc.');

			$data['record'] = $this->ams_model->view_purchase();
			$this->load->view('ams/purchase_table',$data);

			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}


}		