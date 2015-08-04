<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Allowance_model extends MY_Model {
	
	public function view_allowances($allowanceID = FALSE){
		if($allowanceID){ 
			$this->db->where('allowance_id', $allowanceID);
			$query = $this->db->get('tbl_allowances');
			return $query->row();
		}else{
			$query = $this->db->get('tbl_allowances');
			return $query->result();
		}
	}
	
	public function insert_allowances($allowance_name, $amount, $percentage){
		$data = array(
			'allowance_name'=>$allowance_name,
			'amount'=>$amount,
			'percentage'=>$percentage
		);
		$query = $this->db->insert('tbl_allowances', $data); 
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function update_allowances($allowanceID, $allowance_name, $amount, $percentage, $status){
		$this->db->where('allowance_id', $allowanceID);
		$data = array(
			'allowance_name'=>$allowance_name,
			'amount'=>$amount,
			'percentage'=>$percentage,
			'active'=>$status
		);	
		$query = $this->db->update('tbl_allowances', $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}
	
	public function delete_allowances($allowanceID){
		$this->db->where('allowance_id', $allowanceID);
		$this->db->delete('tbl_allowances'); 
	}
	
}