<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/13/2015
 * Time: 12:46 AM
 */
class Inventory_model extends ActiveRecord\Model {
    static $table_name = 'tbl_inventory';
    static $primary_key = 'item_number';

    public function stocksDetails(){
        $data = array (
            'item_number' => $this->input->post('txtItemNumber'),
            'item_name' => $this->input->post('txtItemName'),
            'category' => $this->input->post('txtCategory'),
            'vendor' => $this->input->post('txtVendor'),
            'location' => $this->input->post('txtLocation'),
            'quantity' => $this->input->post('txtQuantity'),
            'price' => $this->input->post('txtPrice')
        );
        return $data;
    }
    public function insertStocks(){
        $this->form_validation->set_rules('txtItemNumber', 'Item Number', 'trim|required');
        $this->form_validation->set_rules('txtItemName', 'Item Name', 'trim|required');
        $this->form_validation->set_rules('txtVendor', 'Vendor', 'trim|required');
        $this->form_validation->set_rules('txtCategory', 'Category', 'trim|required');
        $this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('txtLocation', 'Location', 'trim|required');
        $this->form_validation->set_rules('txtPrice', 'Price', 'trim|required');
        if ($this->form_validation->run()){
            $details = Inventory_model::stocksDetails();
            if (Inventory_model::create($details)){
                $this->session->set_userdata('added',1);
                redirect('ams/view_inventory');
            }
        }
    }
}