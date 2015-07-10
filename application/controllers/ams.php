<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ams extends CI_Controller {
	public function __construct() {
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model('ems_model');
		$this->load->model('ams_model');
		$this->load->model('login_model');
	}

	public function display_navbar($title){
		$data['pageTitle'] = $title;
		$this->load->view('init',$data);

		$userLevel = $this->session->userdata('user_level');

		$data['user_level'] = $userLevel;
		$data['firstname']  = $this->session->userdata('first_name');
		$data['lastname']  = $this->session->userdata('last_name');
		$data['profile_image'] = $this->session->userdata('image');
		$this->load->view('components/navbar_logged',$data);

		if($userLevel == 'Administrator'){
			$this->load->view('components/sidebar_admin',$data);
		} elseif ($userLevel == 'Manager'){
			$this->load->view('components/sidebar_manager',$data);
		} elseif ($userLevel == 'Employee'){
			$this->load->view('components/sidebar_employee',$data);
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

	public function view_assets(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Assets - MSInc.');
			$this->load->view('components/sidebar_admin');

			$config["base_url"] = base_url() . "ams/view_assets";
			$config["total_rows"] = $this->ams_model->record_count();

			$config["per_page"] = 15;
			$config["uri_segment"] = 3;
			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);
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

			$this->load->view("asset/asset_table", $data);

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
					redirect('ams/view_assets');
				}
			}
			$this->display_navbar('Add Asset - MSInc.');
			$this->load->view('asset/add_asset');
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function delete_asset(){
		$id = $this->input->get('asset_id');
		$this->ams_model->delete_record($id);
		$this->session->set_userdata('deleted',1);
		redirect('ams/view_assets');
	}

	public function search_asset(){
		if($this->session->userdata('logged_in')==true){
			if($this->input->post('txtSearch')){
				   $this->display_navbar('Assets - MSInc.');

				$data['total_asset'] = $this->ams_model->record_count();
				$data['record'] = $this->ams_model->search_asset();
				$this->load->view("asset/asset_table", $data);
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
				redirect('ams/view_assets');
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
			$this->load->view('asset/asset_details',$data);
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
			$this->load->view('asset/edit_asset',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function update_asset(){
		$id = $this->input->get('asset_id');
		if ($this->ams_model->update_record($id)){
			$id = $this->input->get('asset_id');
				$this->session->set_userdata('edited',1);
				 redirect('ams/view_assets');
			 }
	}

	public function view_projects(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Projects - MSInc.');
			$data['record'] = $this->ams_model->view_project();
			$this->load->view('asset/project_table',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function add_project(){
		if($this->session->userdata('logged_in')==true){
			$this->form_validation->set_rules('txtProjectID', 'Project ID', 'trim|required');
			$this->form_validation->set_rules('txtProjectName', 'Project Name', 'trim|required');
			$this->form_validation->set_rules('txtClient', 'Client Name', 'trim|required');
			$this->form_validation->set_rules('txtStartingDate', 'Starting Date', 'trim|required');

			if ($this->form_validation->run()){
				if ($this->ams_model->add_project()){
					$this->session->set_userdata('added',1);
					redirect('ams/view_project');
				}
			}
			$this->display_navbar('Add Stocks - MSInc.');
			$this->load->view('asset/add_project');
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function view_materials(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Project Materials - MSInc.');
			$id = $this->input->get('project_id');
			$data['record'] = $this->ams_model->view_material($id);
			$this->load->view('asset/materials_table',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function view_all_materials(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('Bill of Materials - MSInc.');
			$data['record'] = $this->ams_model->view_all_material();
			$this->load->view('asset/materials_table',$data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}

	}

	public function add_materials(){
		if($this->session->userdata('logged_in')==true){
			$this->form_validation->set_rules('txtMaterialsID', 'Item Number', 'trim|required');
			$this->form_validation->set_rules('txtItemNumber', 'Item Number', 'trim|required');
			$this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('txtProjectID', 'Project ID', 'trim|required');
			$this->form_validation->set_rules('txtDateIssued', 'Date Issued', 'trim|required');

			if ($this->form_validation->run()){
				if ($this->ams_model->add_material()){
					$this->session->set_userdata('added',1);
					redirect('ams/view_all_materials');
				}
			}

			$this->display_navbar('Add Materials - MSInc.');
			$data['record'] = $this->ams_model->view_inventory();
			$data['project'] = $this->ams_model->view_project();
			$this->load->view('asset/add_materials', $data);
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function add_project_materials(){
		if($this->session->userdata('logged_in')==true){
			$this->form_validation->set_rules('txtMaterialsID', 'Item Number', 'trim|required');
			$this->form_validation->set_rules('txtItemNumber', 'Item Number', 'trim|required');
			$this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('txtDateIssued', 'Date Issued', 'trim|required');

			$id = $this->input->get('project_id');
			$data['id'] = $id;
			$this->display_navbar('Add Materials - MSInc.');
			$data['record'] = $this->ams_model->view_inventory();
			$this->load->view('asset/add_project_materials', $data);
			$this->load->view('components/footer');

			if ($this->form_validation->run()){
				if ($this->ams_model->add_project_material($id)){
					$this->session->set_userdata('added',1);
					redirect('ams/view_all_materials');
				}
			}
		} else {
			redirect('msi');
		}
	}

	public function delete_materials(){
		$id = $this->input->get('id');
		$this->ams_model->delete_material($id);
	}

	public function view_inventory(){
		if($this->session->userdata('logged_in')==true){
			$data['record'] = $this->ams_model->view_inventory();
			$this->display_navbar('View Inventory - MSInc.');
			$this->load->view('asset/inventory_table',$data);

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

	public function view_inventory_details(){
		if($this->session->userdata('logged_in')==true){
			$this->display_navbar('View Inventory Detail - MSInc.');

			$id = $this->input->get('item_number');
			$data['record'] = $this->ams_model->view_inventory_details($id);
			$this->load->view('asset/inventory_detail',$data);

			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function add_stocks(){
		if($this->session->userdata('logged_in')==true){
			$this->form_validation->set_rules('txtItemNumber', 'Item Number', 'trim|required');
			$this->form_validation->set_rules('txtItemName', 'Item Name', 'trim|required');
			$this->form_validation->set_rules('txtVendor', 'Vendor', 'trim|required');
			$this->form_validation->set_rules('txtCategory', 'Category', 'trim|required');
			$this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
			$this->form_validation->set_rules('txtLocation', 'Location', 'trim|required');

			if ($this->form_validation->run()){
				echo "wqwewqewqe";
				if ($this->ams_model->add_stock()){
					$this->session->set_userdata('added',1);
					redirect('ams/view_inventory');
				}
			} echo "huhu";
			$this->display_navbar('Add Stocks - MSInc.');
			$this->load->view('asset/add_product');
			$this->load->view('components/footer');
		} else {
			redirect('msi');
		}
	}

	public function edit_stocks(){
		if($this->session->userdata('logged_in')==true){
			if ($this->input->post('btnSubmit')){
				$id = $this->input->get('item_number');
				if ($this->ams_model->update_stocks($id)){
					$this->session->set_userdata('edited',1);
					redirect('ams/view_inventory');
				}
			}
			$this->display_navbar('Update Stocks - MSInc.');

			$id = $this->input->get('item_number');
			$data['record'] = $this->ams_model->view_inventory_details($id);
			$this->load->view('asset/edit_stocks',$data);

			$this->load->view('components/footer');

		} else {
			redirect('msi');
		}
	}

	public function delete_stocks(){
		$id = $this->input->get('item_number');
		$this->ams_model->delete_stocks($id);
		$this->session->set_userdata('deleted',1);
		redirect('ams/view_inventory');
	}
}
