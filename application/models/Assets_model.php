<?php
class Assets_model extends ActiveRecord\Model {
	static $table_name = 'tbl_assets';
	static $primary_key = 'asset_id';

	public function newAssets(){
		$details = array (
			"asset_id" => $this->input->post('txtAssetID'),
			"asset_status" => 'Brand New',
			"employee_id" => 0,
			);
		Assets_model::create($details);
	}
}