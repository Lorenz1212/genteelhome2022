<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Option_Controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->model('option_model');
      $this->load->library('session');
    }
    public function pallet_color(){
        $id = $this->input->post('id');
        $data = $this->option_model->pallet_color($id);
        echo json_encode($data);
    }
    public function pallet_docs(){
        $id = $this->input->post('id');
        $data = $this->option_model->pallet_docs($id);
        echo json_encode($data);
    }
    public function design_project_docs(){
        $id = $this->input->post('id');
        $data = $this->option_model->design_project_docs($id);
        echo json_encode($data);
    }
    public function Purchased_Item(){
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $terms = $this->input->post('terms');
        $amount = $this->input->post('amount');
        $supplier = $this->input->post('supplier');
        $data = $this->option_model->Purchased_Item($item,$supplier);
        $data_response = array('data'=> $data,
                               'quantity' => $quantity,
                               'terms'=> $terms,
                               'amount'=> $amount);
        echo json_encode($data_response);
    }
    public function supplier_option()  
    {  
    	$data = $this->option_model->supplier_option();
        echo json_encode($data);
    }  
    public function Item_option()  
    {  
        $data = $this->option_model->Item_option();
        echo json_encode($data);
    } 
    public function Designer_option()  
    {  
        $data = $this->option_model->Designer_option();
        echo json_encode($data);
    } 
    public function Color_option()  
    {  
        $id = $this->input->post('id');
        $data = $this->option_model->Color_option($id);
        echo json_encode($data);
    } 
    public function Image_option(){  
        $id = $this->input->post('id');
        $data = $this->option_model->Image_option($id);
        echo json_encode($data);
    } 
    public function imageproject_option(){
        $id = $this->input->post('id');
        $data = $this->option_model->imageproject_option($id);
        echo json_encode($data);
    }
    public function Project_option()  
    {  
        $data = $this->option_model->Project_option();
        echo json_encode($data);
    } 
    public function Product_option(){
         $data = $this->option_model->Product_option();
        echo json_encode($data);
    } 
    public function Finishproduct_option()  {  
        $project_no = $this->input->post('project_no');
        $c_code = $this->input->post('c_code');
        $data = $this->option_model->Finishproduct_option($project_no,$c_code);
        echo json_encode($data);
    }    
    public function User_option(){
        $data = $this->option_model->User_option();
        echo json_encode($data);
    }
    public function UserUpdate_option(){
        $username = $this->input->post('username');
        $id=$this->input->post('id');
        $data = $this->option_model->UserUpdate_option($id,$username);
        echo json_encode($data);
    }
    public function Password_option(){
        $password = md5($this->input->post('password'));
        $id=$this->input->post('id');
        $data = $this->option_model->Password_option($id,$password);
        echo json_encode($data);
    }
    public function SO_option(){
        $data = $this->option_model->SO_option();
        echo json_encode($data);
    }
    public function ItemQty_option(){
        $id = $this->input->post('id');
        $data = $this->option_model->ItemQty_option($id);
        echo json_encode($data);
    }
    public function Material_option(){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $remarks = $this->input->post('remarks');
        $unit = $this->input->post('unit');
        $type = $this->input->post('type');
        $data = $this->option_model->Material_option($id);
        $status = array('data'    => $data,
                        'qty'     => $qty,
                        'remarks' => $remarks,
                        'type'    => $type);
        echo json_encode($status);
    }
    public function Purchase_option(){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $remarks = $this->input->post('remarks');
        $unit = $this->input->post('unit');
        $type = $this->input->post('type');
        $data = $this->option_model->Purchase_option($id);
        $name = $this->input->post('name');
        $status = array('data'    => $data,
                        'name'    => $name,
                        'qty'     => $qty,
                        'remarks' => $remarks,
                        'type'    => $type);
        echo json_encode($status);
    }
    public function Spare_Option(){
        $data = $this->option_model->Spare_Option();
        echo json_encode($data);
    }
    public function Office_Option(){
        $data = $this->option_model->Office_Option();
        echo json_encode($data);
    }

    public function PurchaseStocks_option()  
    {  
        $status = $this->input->post('status');
        if($status == 'rawmats'){
             $data = $this->option_model->Item_option();
        }else if($status == 'office'){
             $data = $this->option_model->Office_Option();
        }else if($status == 'production'){
             $data = $this->option_model->Spare_Option();
        }
        echo json_encode($data);
    } 
    public function Category_option(){
        $data = $this->option_model->Category_option();
        echo json_encode($data);
    }
    public function SubCategory_option(){
        $id = $this->input->post('id');
        $data = $this->option_model->SubCategory_option($id);
        echo json_encode($data);
    }
    public function SubCategory_Update_option(){
        $id = $this->input->post('id');
        $data = $this->option_model->SubCategory_Update_option($id);
        echo json_encode($data);
    }
    public function SubCategory_Edit_option(){
        $id = $this->input->post('id');
        $data = $this->option_model->SubCategory_Edit_option($id);
        echo json_encode($data);
    }
    public function email_option(){
        $id = $this->input->post('id');
        $status = $this->option_model->email_option($id);
        $data = array('status'=>$status);
        echo json_encode($data);
    }
    public function email_update(){
        $id = $this->input->post('id');
        $email = $this->input->post('email');
        $status = $this->option_model->email_update($id,$email);
        $data = array('status'=>$status);
        echo json_encode($data);
    }
    public function voucher_option(){
        $data = $this->option_model->voucher_option();
        echo json_encode($data);
    }
    public function region_option(){
        $data = $this->option_model->region_option();
        echo json_encode($data);
    }
    public function shipping_option(){
        $id = $this->input->post('id');
        $data = $this->option_model->shipping_option($id);
        echo json_encode($data);
    }
    public function Joborder_Option(){
        $data = $this->option_model->Joborder_Option();
        echo json_encode($data);
    }
    public function Joborder1_Option(){
        $data = $this->option_model->Joborder1_Option();
        echo json_encode($data);
    }
    public function Option_other_expenses(){
        $data = $this->option_model->Option_other_expenses();
        echo json_encode($data);
    }
    public function Customer_Name(){
        $data = $this->option_model->Customer_Name();
        echo json_encode($data);
    }
    public function customer_info(){
        $id = $this->input->post('id');
        $data = $this->option_model->customer_info($id);
        echo json_encode($data);
    }
    public function Option_Income_Statement(){
        $data = $this->option_model->Option_Income_Statement();
        echo json_encode($data);
    }
    public function item_list(){
        $type = $this->input->post('type');
        $data = $this->option_model->item_list($type);
        echo json_encode($data);
    }
    public function so_no_item(){
        $so_no = $this->input->post('so_no');
        $data = $this->option_model->so_no_item($so_no);
        echo json_encode($data);
    }
    public function soa_no(){
        $id = $this->input->post('id');
        $data = $this->option_model->soa_no($id);
        echo json_encode($data);
    }
    public function purchase_product(){
        $id = $this->input->post('id');
        $data = $this->option_model->purchase_product($id);
        echo json_encode($data);
    }
    public function supplier_list(){
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $data = $this->option_model->supplier_list($id,$type);
        echo json_encode($data);
    }
    public function purchase_transaction(){
        $id = $this->input->post('id');
        $data = $this->option_model->purchase_transaction($id);
        echo json_encode($data);
    }
    public function purchase_inventory(){
        $id = $this->input->post('id');
        $data = $this->option_model->purchase_inventory($id);
        echo json_encode($data);
    }
    public function other_material_p_transaction(){
        $id = $this->input->post('id');
        $data = $this->option_model->other_material_p_transaction($id);
        echo json_encode($data);
    }
    public function cashpostion_category(){
        $data = $this->option_model->cashpostion_category();
        echo json_encode($data);
    }
}
?>