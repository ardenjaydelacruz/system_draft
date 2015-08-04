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
	
	public function insert_taxes($tax_name, $amount, $percentage){
		$data = array(
			'tax_name'=>$tax_name,
			'amount'=>$amount,
			'percentage'=>$percentage
		);	
		$query = $this->db->insert('tbl_taxes', $data); 
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_taxes($taxID, $tax_name, $amount, $percentage, $status){
		$this->db->where('tax_id', $taxID);
		$data = array(
			'tax_name'=>$tax_name,
			'amount'=>$amount,
			'percentage'=>$percentage,
			'active'=>$status
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
	
}