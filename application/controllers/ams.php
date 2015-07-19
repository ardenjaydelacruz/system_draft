<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ams extends MY_Controller {
	public function __construct() {
		parent:: __construct();
		if ($this->session->userdata('logged_in') == false) {
            redirect('msi/login');
        }
	}

	public function view_assets(){
		Assets_model::assignAsset();
		$data['total_asset'] = count(View_assigned_assets_model::all());
		$data["record"] = View_assigned_assets_model::all();
		$data['pageTitle'] = 'Other Assets - MSInc.';
        $data['content'] = 'asset/asset_table';
        $this->load->view($this->master_layout,$data);
        $this->display_notif();
	}

	public function add_asset(){
		$data['category'] = Stock_category_model::all();
		$data['vendor'] = Vendor_model::all();
		Assets_info_model::add_asset_info();
		$data['pageTitle'] = 'Add Asset - MSInc.';
		$data['content'] = 'asset/add_asset';
		$this->load->view($this->master_layout,$data);
	}

	public function assign_asset(){
		$data['asset'] = Assets_info_model::find($this->input->get('asset_id'));
		$data['employee'] = Emp_info_model::all();
		$data['pageTitle'] = 'Assign Asset - MSInc.';
		$data['content'] = 'asset/assign_asset';
		$this->load->view($this->master_layout,$data);
	}

	public function delete_asset(){
		$asset = Assets_info_model::find($this->input->get('asset_id'));
		$asset->delete();
		$this->session->set_userdata('deleted',1);
		redirect('ams/view_assets');
	}

	public function search_asset(){
		$text = $this->input->post('txtSearch');
		if($text){
			$data['total_asset'] = count(Assets_info_model::all());
			$data['record'] = Assets_info_model::find('all', array('conditions' => "asset_id LIKE '%$text%'"));
			$data['pageTitle'] = 'Search Asset - MSInc.';
			$data['content'] = 'asset/asset_table';
			$this->load->view($this->master_layout,$data);
		} else {
			redirect('ams/view_assets');
		}
	}

	public function view_asset_details(){
		$id = $this->input->get('asset_id');
		$data['category'] = Stock_category_model::all();
		$data['vendor'] = Vendor_model::all();
		$data['row'] = Assets_info_model::find($id);
		$data['pageTitle'] = 'Asset Details - MSInc.';
		$data['content'] = 'asset/asset_details';
		$this->load->view($this->master_layout,$data);
	}

	public function update_asset(){
		$details = Assets_info_model::assetsDetails();
		$asset = Assets_info_model::find($this->input->get('asset_id'));
		if ($asset->update_attributes($details)){
			$this->session->set_userdata('edited',1);
			redirect('ams/view_assets');
		}
	}

	public function view_projects(){
		$data['record'] = Projects_model::all();
		$data['pageTitle'] = 'Projects - MSInc.';
		$data['content'] = 'asset/project_table';
		$this->load->view($this->master_layout,$data);
		$this->display_notif();
	}

	public function add_project(){
		Projects_model::insertProject();
		$data['pageTitle'] = 'Add Project - MSInc.';
		$data['content'] = 'asset/add_project';
		$this->load->view($this->master_layout,$data);
	}

	//view materials for certain projects
	public function view_materials(){
		$id = $this->input->get('project_id');
		$data['record'] = Materials_model::find('all',array('conditions' => array('project_id=?',$id)));
		$data['pageTitle'] = 'Project Materials- MSInc.';
		$data['content'] = 'asset/materials_table';
		$this->load->view($this->master_layout,$data);
	}

	//list all materials for all projects
	public function view_all_materials(){
		$data['record'] = View_project_materials_model::all();
		$data['pageTitle'] = 'Bill of Materials - MSInc.';
		$data['content'] = 'asset/materials_table';
		$this->load->view($this->master_layout,$data);
		$this->display_notif();
	}

	public function add_materials(){
		Materials_model::insertMaterials();
		$data['record'] = Stock_info_model::all();
		$data['project'] = Projects_model::all();
		$data['pageTitle'] = 'Add Materials - MSInc.';
		$data['content'] = 'asset/add_materials';
		$this->load->view($this->master_layout,$data);
	}

	public function add_project_materials(){
		Materials_model::insertMaterials();
		$id = $this->input->get('project_id');
		$data['id'] = $id;
		$data['record'] = Inventory_model::all();
		$data['pageTitle'] = 'Add Materials - MSInc.';
		$data['content'] = 'asset/add_project_materials';
		$this->load->view($this->master_layout,$data);
	}

	public function delete_materials(){
		$data = Materials_model::find($this->input->get('id'));
		if($data->delete()){
			$this->session->set_userdata('deleted',1);
			redirect('ams/view_all_materials');
		}
	}

	public function view_inventory(){
		$data['record'] = View_stocks_model::all();
		$data['pageTitle'] = 'View Inventory - MSInc.';
		$data['content'] = 'asset/inventory_table';
		$this->load->view($this->master_layout,$data);
		$this->display_notif();
	}

	public function view_inventory_details(){
		$data['row'] = Stock_info_model::find($this->input->get('item_id'));
		$data['pageTitle'] = 'View Inventory Detail - MSInc.';
		$data['content'] = 'asset/inventory_detail';
		$this->load->view($this->master_layout,$data);
	}

	public function add_stocks(){
		Stock_info_model::insertStocks();
		$data['category'] = Stock_category_model::all();
		$data['pageTitle'] = 'Add Stocks - MSInc.';
		$data['content'] = 'asset/add_stock';
		$this->load->view($this->master_layout,$data);
	}

	public function add_stocks_quantity(){
		Restock_model::recordRestock();
		$data['vendor'] = Vendor_model::all();
		$data['stocks'] = View_stocks_model::all();
		$data['pageTitle'] = 'Add Stock Quantity - MSInc.';
		$data['content'] = 'asset/add_stock_quantity';
		$this->load->view($this->master_layout,$data);
	}

	public function edit_stocks(){
		$id = $this->input->get('item_id');
		if ($this->input->post('btnSubmit')){
			$stocks = Stock_info_model::find($id);
			$details = Stock_info_model::stocksDetails();
			if ($stocks->update_attributes($details)){
				$this->session->set_userdata('edited',1);
				redirect('ams/view_inventory');
			}
		}
		$data['category'] = Stock_category_model::all();
		$data['row'] = Stock_info_model::find($this->input->get('item_id'));
		$data['pageTitle'] = 'Update Stocks - MSInc.';
		$data['content'] = 'asset/edit_stocks';
		$this->load->view($this->master_layout,$data);
	}

	public function delete_stocks(){
		$stocks = Stock_info_model::find($this->input->get('item_id'));
		$stocks->delete();
		$this->session->set_userdata('deleted',1);
		redirect('ams/view_inventory');
	}
}
