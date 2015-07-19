<?php
class Assets_model extends ActiveRecord\Model {
	static $table_name = 'tbl_assets';
	static $primary_key = 'asset_id';

	public function newAssets(){
		$details = array (
			"asset_id" => $this->input->post('txtAssetID'),
			"asset_status" => 'Brand New',
			"employee_id" => 0
			);
		Assets_model::create($details);
	}

	public function assignAsset(){
		$details = array(
			"asset_status" => $this->input->post('txtStatus'),
			"employee_id" => $this->input->post('txtEmployee'),
			"assigned_date" => $this->input->post('txtAssignedDate')
			);
		$this->form_validation->set_rules('txtStatus', 'Asset Status', 'trim|required');
		$this->form_validation->set_rules('txtEmployee', 'Employee', 'trim|required');
		$this->form_validation->set_rules('txtAssignedDate', 'Assigned Date', 'trim|required');

		if ($this->form_validation->run()){
			$asset = Assets_model::find($this->input->post('txtAssetID'));
			if($asset->update_attributes($details)){
				$this->session->set_userdata('updated',1);
				redirect('ams/view_assets');
			}
		}

		
	}
}