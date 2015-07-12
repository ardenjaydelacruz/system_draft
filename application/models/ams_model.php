<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ams_model extends CI_Model {

	public function add_stock(){
		$data = array (
			'item_number' => $this->input->post('txtItemNumber'),
			'item_name' => $this->input->post('txtItemName'),
			'category' => $this->input->post('txtCategory'),
			'vendor' => $this->input->post('txtVendor'),
			'location' => $this->input->post('txtLocation'),
			'quantity' => $this->input->post('txtQuantity'),
			'price' => $this->input->post('txtPrice')
		);

		$query = $this->db->insert('tbl_inventory',$data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function update_stocks($id){
		$this->db->where('item_number', $id);
		$data = array (
			'category' => $this->input->post('txtCategory'),
			'vendor' => $this->input->post('txtVendor'),
			'location' => $this->input->post('txtLocation'),
			'quantity' => $this->input->post('txtQuantity'),
			'price' => $this->input->post('txtPrice')
		);
		$query = $this->db->update('tbl_inventory',$data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_stocks($id){
		$this->db->where('item_number', $id);
		$query = $this->db->delete('tbl_inventory');
	}
}
