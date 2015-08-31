<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/12/2015
 * Time: 11:59 PM
 */
class Asset_request extends ActiveRecord\Model {
    static $table_name = 'tbl_asset_request';
    static $primary_key = 'asset_request_id';

    public function update_asset_request(){
	    $details = array(
			'request_status'  => $this->input->get('asset_request'),
			'approved_by'   => $this->session->userdata('user_level') . ' ' . $this->session->userdata('first_name'),
			'date_approved' => date("Y-m-d"),
	    );
	    $approved = Asset_request::find($this->input->get('asset_request_id'));
	    if ($approved->update_attributes($details)) {
	        redirect('ams/asset_request_table');
	    }
    }	
}