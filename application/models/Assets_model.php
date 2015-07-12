<?php
class Assets_model extends ActiveRecord\Model {
	static $table_name = 'assets';
	static $primary_key = 'asset_id';

	public function assetsDetails(){
		$data = array (
			'asset_id' => $this->input->post('txtAssetID'),
			'serial_number' => $this->input->post('txtSerial'),
			'brand' => $this->input->post('txtBrand'),
			'model' => $this->input->post('txtModel'),
			'vendor' => $this->input->post('txtVendor'),
			'assigned_employee' => 'None',
			'status' => 'Brand New',
			'category' => $this->input->post('txtCategory'),
			'date_acquired' => $this->input->post('txtDateAcquired'),
			'warranty_start' => $this->input->post('txtWarrantyStart'),
			'warranty_end' => $this->input->post('txtWarrantyEnd')
		);
		return $data;
	}

	public function add_asset_info(){
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
			$details = Assets_model::assetsDetails();
			if (Assets_model::create($details)){
				$this->session->set_userdata('added',1);
				redirect('ams/view_assets');
			}
		} else {
			RETURN FALSE;
		}
	}
}