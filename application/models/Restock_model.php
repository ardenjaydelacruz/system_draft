<?php
class Restock_model extends ActiveRecord\Model {
    static $table_name = 'tbl_restock';
    static $primary_key = 'item_id';

    public function recordRestock(){
        $this->form_validation->set_rules('txtItemID', 'Item ID', 'trim|required');
        $this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('txtVendor', 'Vendor', 'trim|required');
        $this->form_validation->set_rules('txtDateRestock', 'Date Restock', 'trim|required');
        if ($this->form_validation->run()){
            $details = array(
            	'item_id' => $this->input->post('txtItemID'),
                'quantity' => $this->input->post('txtQuantity'),
                'vendor_id' => $this->input->post('txtVendor'),
                'date_restock' => $this->input->post('txtDateRestock'),
            );
            if (Restock_model::create($details)){
                Stocks_model::addQuantity();
                $this->session->set_userdata('edited',1);
                Audit_trail_model::auditRestock($details);
                redirect('ams/view_inventory');
            }
        }
    }
}

