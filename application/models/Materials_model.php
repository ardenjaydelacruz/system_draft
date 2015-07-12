<?php
/**
 * Created by PhpStorm.
 * User: Arden
 * Date: 7/13/2015
 * Time: 12:05 AM
 */

class Materials_model extends ActiveRecord\Model{
    static $table_name = 'tbl_materials';
    static $primary_key = 'materials_id';

    public function insertMaterials(){
        $this->form_validation->set_rules('txtMaterialsID', 'Item Number', 'trim|required');
        $this->form_validation->set_rules('txtItemNumber', 'Item Number', 'trim|required');
        $this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('txtProjectID', 'Project ID', 'trim|required');
        $this->form_validation->set_rules('txtDateIssued', 'Date Issued', 'trim|required');

        if ($this->form_validation->run()){
            $item_number = $this->input->post('txtItemNumber');
            $quantity = $this->input->post('txtQuantity');
            $row = Inventory_model::find($item_number);
            //insert into materials table
            $data = array (
                'materials_id' => $this->input->post('txtMaterialsID'),
                'item_number' => $row->item_number,
                'quantity' =>  $quantity,
                'price' => $row->price,
                'project_id' => $this->input->post('txtProjectID'),
                'date_issued' => $this->input->post('txtDateIssued')
            );
            if (Materials_model::create($data)){
                $row->quantity -= $quantity;
                $row->save();
                $this->session->set_userdata('added',1);
                redirect('ams/view_all_materials');
            }
        }
    }

//    public function inserProjectMaterials(){
//        $this->form_validation->set_rules('txtMaterialsID', 'Item Number', 'trim|required');
//        $this->form_validation->set_rules('txtItemNumber', 'Item Number', 'trim|required');
//        $this->form_validation->set_rules('txtQuantity', 'Quantity', 'trim|required');
//        $this->form_validation->set_rules('txtDateIssued', 'Date Issued', 'trim|required');
//        if ($this->form_validation->run()){
//            if ($this->ams_model->add_project_material($id)){
//                $this->session->set_userdata('added',1);
//                redirect('ams/view_all_materials');
//            }
//        }
//    }
}