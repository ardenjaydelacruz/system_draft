<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ams extends MY_Controller {
	public function __construct() {
		parent:: __construct();
	}

	public function view_assets(){
		$config["base_url"] = base_url() . "ams/view_assets";
		$config["total_rows"] = $this->ams_model->total_assets();
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

		$data['total_asset'] = $this->ams_model->total_assets();
		$data["record"] = $this->ams_model->fetch_record($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data['pageTitle'] = 'Other Assets - MSInc.';
        $data['content'] = 'asset/asset_table';
        $this->load->view($this->master_layout,$data);
        $this->display_notif();
	}

	public function add_asset(){
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
		$data['pageTitle'] = 'Add Asset - MSInc.';
		$data['content'] = 'asset/add_asset';
		$this->load->view($this->master_layout,$data);
	}

	public function delete_asset(){
		$id = $this->input->get('asset_id');
		$this->ams_model->delete_record($id);
		$this->session->set_userdata('deleted',1);
		redirect('ams/view_assets');
	}

	public function search_asset(){
		if($this->input->post('txtSearch')){
			$data['total_asset'] = $this->ams_model->total_assets();
			$data['record'] = $this->ams_model->search_asset();
			$data['pageTitle'] = 'Search Asset - MSInc.';
			$data['content'] = 'asset/asset_table';
			$this->load->view($this->master_layout,$data);
		} else {
			redirect('ams/view_assets');
		}
	}

	public function view_asset_details(){
		$id = $this->input->get('asset_id');
		$data['record'] = $this->ams_model->view_details($id);
		$data['pageTitle'] = 'Asset Details - MSInc.';
		$data['content'] = 'asset/asset_details';
		$this->load->view($this->master_layout,$data);
	}

	public function edit_asset(){
		$id = $this->input->get('asset_id');
		$data['record'] = $this->ams_model->view_details($id);
		$data['pageTitle'] = 'Update Asset - MSInc.';
		$data['content'] = 'asset/edit_asset';
		$this->load->view($this->master_layout,$data);
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
