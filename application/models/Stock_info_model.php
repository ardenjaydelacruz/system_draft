<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/13/2015
 * Time: 12:46 AM
 */
class Stock_info_model extends ActiveRecord\Model {
    static $table_name = 'tbl_stock_info';
    static $primary_key = 'item_id';

    public function stocksDetails(){
        $data = array (
            'item_id' => $this->input->post('txtItemID'),
            'item_name' => $this->input->post('txtItemName'),
            'category_id' => $this->input->post('txtCategory'),
            'price' => $this->input->post('txtPrice')
        );
        return $data;
    }
    public function insertStocks(){
        $this->form_validation->set_rules('txtItemID', 'Item ID', 'trim|required');
        $this->form_validation->set_rules('txtItemName', 'Item Name', 'trim|required');
        $this->form_validation->set_rules('txtCategory', 'Category', 'trim|required');
        $this->form_validation->set_rules('txtPrice', 'Price', 'trim|required');
        if ($this->form_validation->run()){
            $details = Stock_info_model::stocksDetails();
            if (Stock_info_model::create($details)){
                Stocks_model::newStocks();
                $this->session->set_userdata('added',1);
                Audit_trail_model::auditNewItem($details);
                redirect('ams/view_inventory');
            }
        }
    }

    public function editStocks($id){
        $stocks = Stock_info_model::find($id);
            $details = Stock_info_model::stocksDetails();
            if ($stocks->update_attributes($details)){
                $this->session->set_userdata('edited',1);
                Audit_trail_model::auditEditItems($details);
                redirect('ams/view_inventory');
            }
    }
}