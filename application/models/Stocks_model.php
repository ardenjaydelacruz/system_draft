<?php
class Stocks_model extends ActiveRecord\Model {
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
   		$id = $this->input->post('txtItemID');
   		$stocks = Stocks_model::find($id);
   		$details = array(
   			"quantity" => ($stocks->quantity + $this->input->post('txtQuantity')),
   			"date_last_restocked" => $this->input->post('txtDateRestock')
   			);
   		$stocks->update_attributes($details);
   	}
}

