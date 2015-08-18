<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Taxes_model extends MY_Model {
	
	public function view_taxes($taxID = FALSE){
		if($taxID){ 
			$this->db->where('tax_id', $taxID);
			$query = $this->db->get('tbl_taxes');
			return $query->row();
		}else{
			$query = $this->db->get('tbl_taxes');
			return $query->result();
		}
	}
	
	public function insert_taxes($tax_name, $amount, $percentage, $range_status){
		$data = array(
			'tax_name'=>$tax_name,
			'amount'=>$amount,
			'percentage'=>$percentage,
			'ranges_active'=>$range_status
		);	
		$query = $this->db->insert('tbl_taxes', $data); 
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_taxes($taxID, $tax_name, $amount, $percentage, $status, $range_status){
		$this->db->where('tax_id', $taxID);
		$data = array(
			'tax_name'=>$tax_name,
			'amount'=>$amount,
			'percentage'=>$percentage,
			'active'=>$status,
			'ranges_active'=>$range_status
		);	
		$query = $this->db->update('tbl_taxes', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function delete_taxes($taxID){
		$this->db->where('tax_id', $taxID);
		$this->db->delete('tbl_taxes'); 
	}
	
	public function view_tax_range($taxID){
		$this->db->where('tax_id', $taxID);
		$query = $this->db->get('tbl_tax_range');
		return $query->result();
	}
	
	public function view_tax_range_details($taxRangeID){
		$this->db->where('tax_range_id', $taxRangeID);
		$query = $this->db->get('tbl_tax_range');
		return $query->row();
	}
	
	public function insert_tax_range($taxID, $amount_from, $amount_to, $amount_deducted){
		$data = array(
			'tax_id'=>$taxID,
			'amount_from'=>$amount_from,
			'amount_to'=>$amount_to,
			'amount_deducted'=>$amount_deducted
		);	
		$query = $this->db->insert('tbl_tax_range', $data); 
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_tax_range($taxRangeID, $amount_from, $amount_to, $amount_deducted){
		$this->db->where('tax_range_id', $taxRangeID);
		$data = array(
			'amount_from'=>$amount_from,
			'amount_to'=>$amount_to,
			'amount_deducted'=>$amount_deducted
		);	
		$query = $this->db->update('tbl_tax_range', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function delete_tax_range($taxRangeID){
		$this->db->where('tax_range_id', $taxRangeID);
		$this->db->delete('tbl_tax_range'); 
	}
	
}