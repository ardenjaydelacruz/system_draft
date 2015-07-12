<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ams extends MY_Controller {
	public function __construct() {
		parent:: __construct();
		if ($this->session->userdata('logged_in') == false) {
            redirect('msi/login');
        }
	}

	public function view_assets(){
		$data['total_asset'] = count(Assets_model::all());
		$data["record"] = Assets_model::all();
		$data['pageTitle'] = 'Other Assets - MSInc.';
        $data['content'] = 'asset/asset_table';
        $this->load->view($this->master_layout,$data);
        $this->display_notif();
	}

	public function add_asset(){
		Assets_model::add_asset_info();
		$data['pageTitle'] = 'Add Asset - MSInc.';
		$data['content'] = 'asset/add_asset';
		$this->load->view($this->master_layout,$data);
	}

	public function delete_asset(){
		$asset = Assets_model::find($this->input->get('asset_id'));
		$asset->delete();
		$this->session->set_userdata('deleted',1);
		redirect('ams/view_assets');
	}

	public function search_asset(){
		$text = $this->input->post('txtSearch');
		if($text){
			$data['total_asset'] = count(Assets_model::all());
			$data['record'] = Assets_model::find('all', array('conditions' => "asset_id LIKE '%$text%'"));
			$data['pageTitle'] = 'Search Asset - MSInc.';
			$data['content'] = 'asset/asset_table';
			$this->load->view($this->master_layout,$data);
		} else {
			redirect('ams/view_assets');
		}
	}

	public function view_asset_details(){
		$id = $this->input->get('asset_id');
		$data['row'] = Assets_model::find($id);
		$data['pageTitle'] = 'Asset Details - MSInc.';
		$data['content'] = 'asset/asset_details';
		$this->load->view($this->master_layout,$data);
	}

	public function edit_asset(){
		$id = $this->input->get('asset_id');
		$data['row'] = Assets_model::find($id);
		$data['pageTitle'] = 'Update Asset - MSInc.';
		$data['content'] = 'asset/edit_asset';
		$this->load->view($this->master_layout,$data);
	}

	public function update_asset(){
		$details = Assets_model::assetsDetails();
		$asset = Assets_model::find($this->input->get('asset_id'));
		if ($asset->update_attributes($details)){
			$this->session->set_userdata('edited',1);
			redirect('ams/view_assets');
		}
	}

	public function view_projects(){
		$data['record'] = $this->ams_model->view_project();
		$data['pageTitle'] = 'Projects - MSInc.';
		$data['content'] = 'asset/project_table';
		$this->load->view($this->master_layout,$data);
		$this->display_notif();
	}

	public function add_project(){
		$this->form_validation->set_rules('txtProjectID', 'Project ID', 'trim|required');
		$this->form_validation->set_rules('txtProjectName', 'Project Name', 'trim|required');
		$this->form_validation->set_rules('txtClient', 'Client Name', 'trim|required');
		$this->form_validation->set_rules('txtStartingDate', 'Starting Date', 'trim|required');

		if ($this->form_validation->run()){
			if ($this->ams_model->add_project()){
				$this->session->set_userdata('added',1);
				redirect('ams/view_projects');
			}
		}
		$data['pageTitle'] = 'Add Project - MSInc.';
		$data['content'] = 'asset/add_project';
		$this->load->view($this->master_layout,$data);
	}

	public function view_materials(){
		$id = $this->input->get('project_id');
		$data['record'] = $this->ams_model->view_material($id);;
		$data['pageTitle'] = 'Project Materials- MSInc.';
		$data['content'] = 'asset/materials_table';
		$this->load->view($this->master_layout,$data);
	}

	public function view_all_materials(){
		$data['record'] = $this->ams_model->view_all_material();
		$data['pageTitle'] = 'Bill of Materials - MSInc.';
		$data['content'] = 'asset/materials_table';
		$this->load->view($this->master_layout,$data);
		$this->display_notif();
	}

	public function add_materials(){
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
		$data['record'] = $this->ams_model->view_inventory();
		$data['project'] = $this->ams_model->view_project();
		$data['pageTitle'] = 'Add Materials - MSInc.';
		$data['content'] = 'asset/add_materials';
		$this->load->view($this->master_layout,$data);
	}

	public function add_project_materials(){
		$this->form_validation->set_rules('txtMaterialsID', 'Item Number', 'trim|required');
		$this->form_validation->set_rules('txtItemNumber', 'Item Number', 'trim|required');
		$this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
		$this->form_validation->set_rules('txtDateIssued', 'Date Issued', 'trim|required');

		$id = $this->input->get('project_id');
		$data['id'] = $id;
		$data['record'] = $this->ams_model->view_inventory();
		$data['pageTitle'] = 'Add Materials - MSInc.';
		$data['content'] = 'asset/add_project_materials';
		$this->load->view($this->master_layout,$data);

		if ($this->form_validation->run()){
			if ($this->ams_model->add_project_material($id)){
				$this->session->set_userdata('added',1);
				redirect('ams/view_all_materials');
			}
		}
	}

	public function delete_materials(){
		$id = $this->input->get('id');
		$this->ams_model->delete_material($id);
	}

	public function view_inventory(){
		$data['record'] = $this->ams_model->view_inventory();
		$data['pageTitle'] = 'View Inventory - MSInc.';
		$data['content'] = 'asset/inventory_table';
		$this->load->view($this->master_layout,$data);
		$this->display_notif();
	}

	public function view_inventory_details(){
		$id = $this->input->get('item_number');
		$data['record'] = $this->ams_model->view_inventory_details($id);
		$data['pageTitle'] = 'View Inventory Detail - MSInc.';
		$data['content'] = 'asset/inventory_detail';
		$this->load->view($this->master_layout,$data);
	}

	public function add_stocks(){
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
		}
		$data['pageTitle'] = 'Add Stocks - MSInc.';
		$data['content'] = 'asset/add_product';
		$this->load->view($this->master_layout,$data);

	}

	public function edit_stocks(){
		if ($this->input->post('btnSubmit')){
			$id = $this->input->get('item_number');
			if ($this->ams_model->update_stocks($id)){
				$this->session->set_userdata('edited',1);
				redirect('ams/view_inventory');
			}
		}
		$id = $this->input->get('item_number');
		$data['record'] = $this->ams_model->view_inventory_details($id);
		$data['pageTitle'] = 'Update Stocks - MSInc.';
		$data['content'] = 'asset/edit_stocks';
		$this->load->view($this->master_layout,$data);
	}

	public function delete_stocks(){
		$id = $this->input->get('item_number');
		$this->ams_model->delete_stocks($id);
		$this->session->set_userdata('deleted',1);
		redirect('ams/view_inventory');
	}
}
