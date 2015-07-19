<?php
class Assets_info_model extends ActiveRecord\Model {
	static $table_name = 'tbl_asset_info';
	static $primary_key = 'asset_id';

	public function assetsDetails(){
		if($this->input->post('txtBrand')){
			$brand = $this->input->post('txtBrand');
		} else {
			$brand = 'Unbranded';
		}

		if($this->input->post('txtModel')){
			$model = $this->input->post('txtModel');
		} else {
			$model = 'N/A';
		}
		$data = array (
			'asset_id' => $this->input->post('txtAssetID'),
			'asset_name' => $this->input->post('txtAssetName'),
			'asset_description' => $this->input->post('txtDescription'),
			'category_id' => $this->input->post('txtAssetID'),
			'serial_number' => $this->input->post('txtSerial'),
			'brand' => $brand,
			'model' => $model,
			'vendor_id' => $this->input->post('txtVendor'),
			'date_acquired' => $this->input->post('txtDateAcquired'),
			'warranty_end_date' => $this->input->post('txtWarrantyEnd')
		);
		return $data;
	}

	public function add_asset_info(){
		$this->form_validation->set_rules('txtAssetID', 'Asset ID', 'trim|required');
		$this->form_validation->set_rules('txtAssetName', 'Asset Name', 'trim|required');
		$this->form_validation->set_rules('txtDescription', 'Description', 'trim|required');
		$this->form_validation->set_rules('txtVendor', 'Asset Vendor', 'trim|required');
		$this->form_validation->set_rules('txtCategory', 'Asset Category', 'trim');
		$this->form_validation->set_rules('txtDateAcquired', 'Date Acquired', 'trim|required');

		if ($this->form_validation->run()){
			$details = Assets_info_model::assetsDetails();
			if (Assets_info_model::create($details)){
				Assets_model::newAssets();
				$this->session->set_userdata('added',1);
				redirect('ams/view_assets');
			}
		}
	}


}