<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ams_model extends CI_Model {

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
