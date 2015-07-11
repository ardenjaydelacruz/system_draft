<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ams_model extends CI_Model {

	public function total_assets(){
		return $this->db->count_all('assets');
	}

	public function total_employees(){
		return $this->db->count_all('employees');
	}

	public function fetch_record($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get("assets");

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
   }

   public function add_record(){
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

		$query = $this->db->insert('assets',$data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_record($id){
		$this->db->where('asset_id', $id);
		$query = $this->db->delete('assets');
	}

	public function search_asset() {
		$match = $this->input->post('txtSearch');
		$this->db->like('asset_id',$match);
		$this->db->or_like('category',$match);
		$this->db->or_like('serial_number',$match);
		$this->db->or_like('status',$match);
		$query = $this->db->get('assets');
		return $query->result();
	}

	public function view_details($id){
		$this->db->where('asset_id', $id);
		$query = $this->db->get('assets');

		if ($query->result()){
			foreach ($query->result() as $row) {
				$records[] = $row;
			}
			return $records;
		}
	}

	public function edit_asset($id){
		$this->db->where('asset_id', $id);
		$query = $this->db->get('assets');

		if ($query->result()){
			foreach ($query->result() as $row) {
				$records[] = $row;
			}
			return $records;
		}
	}

	public function update_record($id){
		 $this->db->where('asset_id', $id);
		 $data = array (
			'asset_id' => $this->input->post('txtAssetID'),
			'serial_number' => $this->input->post('txtSerial'),
			'brand' => $this->input->post('txtBrand'),
			'model' => $this->input->post('txtModel'),
			'vendor' => $this->input->post('txtVendor'),
			'assigned_employee' => 'None',
			'status' => $this->input->post('txtStatus'),
			'category' => $this->input->post('txtCategory'),
			'date_acquired' => $this->input->post('txtDateAcquired'),
			'warranty_start' => $this->input->post('txtWarrantyStart'),
			'warranty_end' => $this->input->post('txtWarrantyEnd')
		);
		 $query = $this->db->update('assets',$data);
			if ($query) {
				return true;
			} else {
				return false;
			}
	}

	public function view_project(){
		return $this->db->get('tbl_project')->result();
	}

	public function add_project(){
		$data = array (
			'project_id' => $this->input->post('txtProjectID'),
			'project_name' => $this->input->post('txtProjectName'),
			'client' => $this->input->post('txtClient'),
			'starting_date' => $this->input->post('txtStartingDate')
		);

		$query = $this->db->insert('tbl_project',$data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}


	public function view_material($id){
		$this->db->where('project_id',$id);
		return $this->db->get('tbl_materials')->result();
	}

	public function view_all_material(){
		return $this->db->get('tbl_materials')->result();
	}

		public function add_material(){
		$item_number = $this->input->post('txtItemNumber');
		$quantity = $this->input->post('txtQuantity');

		$this->db->where('item_number',$item_number);
		$this->db->limit(1);
		$query = $this->db->get('tbl_inventory');
		foreach ($query->result() as $row){
			$price =  $row->price;
		}

		$data = array (
			'materials_id' => $this->input->post('txtMaterialsID'),
			'item_number' => $item_number,
			'quantity' => $quantity,
			'price' => $price,
			'project_id' => $this->input->post('txtProjectID'),
			'date_issued' => $this->input->post('txtDateIssued')
		);

		$query = $this->db->insert('tbl_materials',$data);

		if ($query) {
			$this->update_stock_quantity($item_number,$quantity);
			return true;
		} else {
			return false;
		}
	}

	public function add_project_material($id){
		$item_number = $this->input->post('txtItemNumber');

		$this->db->where('item_number',$item_number);
		$this->db->limit(1);
		$query = $this->db->get('tbl_inventory');
		foreach ($query->result() as $row){
			$price =  $row->price;
		}

		$quantity = $this->input->post('txtQuantity');
		$data = array (
			'materials_id' => $this->input->post('txtMaterialsID'),
			'item_number' => $item_number,
			'quantity' => $quantity,
			'price' => $price,
			'project_id' => $id,
			'date_issued' => $this->input->post('txtDateIssued')
		);

		$query = $this->db->insert('tbl_materials',$data);

		if ($query) {
			$this->update_stock_quantity($item_number,$quantity);
			return true;
		} else {
			return false;
		}
	}

	public function update_stock_quantity($id, $quantity){
		$this->db->where('item_number',$id);
		$this->db->limit(1);
		$query = $this->db->get('tbl_inventory');
		foreach ($query->result() as $row){
			$orig_quantity =  $row->quantity;
		}

		$this->db->where('item_number',$id);
		$data = array ('quantity' => $orig_quantity-$quantity);
		$this->db->update('tbl_inventory',$data);
	}

	public function delete_material($id){
		$this->db->where('materials_id', $id);
		$query = $this->db->delete('tbl_materials');

		$this->session->set_userdata('deleted',1);
		redirect('ams/view_all_materials');
	}


	public function view_inventory(){
		return $this->db->get('tbl_inventory')->result();
	}

	public function view_inventory_details($id){
		$this->db->where('item_number', $id);
		$query = $this->db->get('tbl_inventory');

		if ($query->result()){
			foreach ($query->result() as $row) {
				$records[] = $row;
			}
			return $records;
		}
	}

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
