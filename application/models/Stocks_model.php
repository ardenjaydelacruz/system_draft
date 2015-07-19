<?php
class Stock_model extends ActiveRecord\Model {
    static $table_name = 'tbl_stocks';
    static $primary_key = 'item_id';

    public function newStocks(){
    	$data = array(
	        "item_id" => $this->input->post('txtItemID'),
	        "quantity" => 0
	        );
	    Stocks_model::create($data);
    }

   	public function addQuantity(){
   		$id =$this->post->('txtItemID');
   		if (!$id){
   			Stocks_model::newStocks();
   		}
   		$stocks = Stocks_model::find($id);
   		$details = array(
   			"quantity" => ($stocks->quantity + $this->input->post('txtQuantity')),
   			"vendor_id" => $this->input->post('txtVendor'),
   			"date_last_restocked" => $this->input->post('txtDateRestock')
   			);
   		$stocks->update_attributest($details);
   	}
}

