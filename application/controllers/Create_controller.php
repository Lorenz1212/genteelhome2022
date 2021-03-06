<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Create_controller extends CI_Controller 
{ 
    public function __construct(){
      parent::__construct();
      $this->load->model('create_model');
    }
   
    public function Create_Joborder_Stocks(){
        $project_no = $this->input->post('project_no');
        $c_code = $this->input->post('c_code');
        $qty = $this->input->post('unit');
        $mat_itemno = $this->input->post('mat_itemno');            
        $mat_quantity = $this->input->post('mat_quantity');
        $mat_remarks = $this->input->post('mat_remarks');
        $mat_type = $this->input->post('mat_type');
        $mat_itemno = $this->input->post('mat_itemno');
        $pur_item = $this->input->post('pur_itemno');
        $pur_quantity = $this->input->post('pur_quantity');
        $pur_unit = $this->input->post('pur_unit');
        $pur_remarks = $this->input->post('pur_remarks');
        $pur_type = $this->input->post('pur_type');
        $this->create_model->Create_Joborder_Stocks($project_no,$c_code,$qty,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type);
        $data = array('status' =>  'success');
        echo json_encode($data);
    }
    public function Create_Joborder_Project(){
        $project_no = $this->input->post('project_no');
        $mat_itemno = $this->input->post('mat_itemno');            
        $mat_quantity = $this->input->post('mat_quantity');
        $mat_remarks = $this->input->post('mat_remarks');
        $mat_type = $this->input->post('mat_type');
        $mat_itemno = $this->input->post('mat_itemno');
        $pur_item = $this->input->post('pur_itemno');
        $pur_quantity = $this->input->post('pur_quantity');
        $pur_unit = $this->input->post('pur_unit');
        $pur_remarks = $this->input->post('pur_remarks');
        $pur_type = $this->input->post('pur_type');
        $this->create_model->Create_Joborder_Project($project_no,$mat_type,$mat_itemno,$mat_quantity,$mat_remarks,$pur_item,$pur_quantity,$pur_remarks,$pur_type);
        $data = array('status' =>  'success');
        echo json_encode($data);
    }
     public function Create_Joborder_Request(){
        $project_no = $this->input->post('project_no');
        $assigned = $this->input->post('assigned');
        $c_code = $this->input->post('c_code');
        $unit = $this->input->post('unit')??0;
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Joborder_Request($project_no,$c_code,$unit,$type);        
        echo json_encode($data); 
    }
    public function Create_Users(){
        $status = $this->input->post('status');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $firstname = strtoupper($this->input->post('firstname'));
        $lastname = strtoupper($this->input->post('lastname'));
        $middlename = strtoupper($this->input->post('middlename'));
        $voucher = $this->input->post('voucher');
        $designer = $this->input->post('designer');
        $production = $this->input->post('production');
        $supervisor = $this->input->post('supervisor');
        $superuser = $this->input->post('superuser');
        $admin = $this->input->post('admin');
        $accounting = $this->input->post('accounting');
        $webmodifier = $this->input->post('webmodifier');
        $sales = $this->input->post('sales');
        $profile_avatar  =  isset($_FILES["profile_avatar"]["name"]) ? $_FILES["profile_avatar"]["name"]: false;
        $profile_tmp   =  isset($_FILES["profile_avatar"]["tmp_name"]) ? $_FILES["profile_avatar"]["tmp_name"]: false;
        $profile_path  =  "assets/images/avatar/";
        $this->create_model->Create_Users($firstname,$lastname,$middlename,$username,$status,$designer,$production,$supervisor,$superuser,$admin,$password,$accounting,$webmodifier,$sales,$voucher,$profile_avatar,$profile_tmp,$profile_path);
        $data = array('status' => 'success');
        echo json_encode($data); 
     }
       public function Create_Purchase_Request(){
        $production_no = $this->input->post('production_no');
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');
        $this->create_model->Create_Purchase_Request($production_no,$item,$quantity,$remarks);
        $data = array('status' => 'success');
        echo json_encode($data);
    }
    public function Create_MaterialUsed(){
         $production_no = $this->input->post('production_no');
         $item = $this->input->post('item');
         $item_no = $this->input->post('item_no');
         $qty = $this->input->post('qty');
         $unit = $this->input->post('unit');
         $this->create_model->Create_MaterialUsed($item_no,$production_no,$item,$qty,$unit);
         $data = array('status' => 'success');
         echo json_encode($data);
    }
    public function Create_RawMaterial(){
        $item = strtoupper($this->input->post('item'));
        $unit = $this->input->post('unit');
        $price = floatval(preg_replace('/[^\d.]/', '', $this->input->post('price')));
        $this->create_model->Create_RawMaterial($item,$unit,$price);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
      public function Create_Production(){
        $item_no = $this->input->post('item_no');
        $query = $this->db->select('*')->from('tbl_materials')->where('item_no',$item_no)->get();
        $row=$query->row();
        $item = $row->item;
        $stocks = $this->input->post('stocks');
        $this->create_model->Create_Production($item_no,$item,$stocks);
        $data = array('status' => 'success');
        echo json_encode($data);
     }
     public function Create_Other_Materials(){
        $item = strtoupper($this->input->post('item'));
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Other_Materials($item,$type);
        echo json_encode($data);
     }
     public function Create_Other_Matrials_Request(){
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Other_Matrials_Request($item,$quantity,$remarks,$type);
        echo json_encode($data);
     }
      

     
   
      public function Create_Deposit(){
        $order_no  = $this->input->post('order_no');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $mobile = $this->input->post('mobile');
        $email  = $this->input->post('email');
        $date_deposite  = $this->input->post('date_deposite');
        $bank   = $this->input->post('bank');
        $amount = floatval(str_replace(',', '', $this->input->post('amount')));
        $image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp    =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets/images/deposit/";
        $data = $this->create_model->Create_Deposite($firstname,$lastname,$mobile,$email,$order_no,$date_deposite,$amount,$bank,$image,$tmp,$path_image);
        echo json_encode($data);
    }
    public function Create_Customer(){
       $firstname    = isset($_POST['firstname'])? $this->input->post('firstname'): false;
       $lastname     = isset($_POST['lastname']) ? $this->input->post('lastname'): false;
       $mobile       = isset($_POST['mobile'])   ? $this->input->post('mobile'): false;
       $email        = isset($_POST['email'])    ? $this->input->post('email'): false;
       $address      = isset($_POST['address'])  ? $this->input->post('address'): false;
       $city         = isset($_POST['city'])     ? $this->input->post('city'): false;
       $province     = isset($_POST['province']) ? $this->input->post('province'): false;
       $region       = isset($_POST['region'])   ? $this->input->post('region'): false;
       $data         = $this->create_model->Create_Customer($firstname,$lastname,$mobile,$email,$address,$city,$province,$region);
       $status       = array('status' => $data);
       echo json_encode($status);
    }
    public function Create_Cash_Position(){
       $name = isset($_POST['name'])? $this->input->post('name'): false;
       $amount = isset($_POST['amount'])? floatval(str_replace(',', '', $this->input->post('amount'))): false;
       $date_position = isset($_POST['date_position'])? date('Y-m-d',strtotime($this->input->post('date_position'))) : false;
       $type = isset($_POST['type'])? $this->input->post('type'): false;
       $cat_id = isset($_POST['cat_id'])? $this->input->post('cat_id'): false;
       $data = $this->create_model->Create_Cash_Position($name,$amount,$date_position,$type,$cat_id);
       echo json_encode($data);
    }
    public function Create_Web_Testimony(){
       $name = isset($_POST['name'])? $this->input->post('name'): false;
       $description = isset($_POST['description'])? $this->input->post('description'): false;
       $image      =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
       $tmp        =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
       $path_image =  "assets/images/testimony/";
       $data = $this->create_model->Create_Web_Testimony($name,$description,$image,$tmp,$path_image);
       echo json_encode($data);
    }
    public function Create_Joborder_Inpection_Project_Image(){
        $id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no'); 
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp  =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/inspection/";
        $data = $this->create_model->Create_Joborder_Inpection_Project_Image($id,$production_no,$image,$tmp,$path_image);
        echo json_encode($data);
    }
    public function Create_Joborder_Inpection_Stocks_Image(){
        $id = $this->session->userdata('id');
        $production_no = $this->input->post('production_no'); 
        $image =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp  =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image = "assets/images/inspection/";
        $data = $this->create_model->Create_Joborder_Inpection_Stocks_Image($id,$production_no,$image,$tmp,$path_image);
        echo json_encode($data);
    }

    public function Create_Salesorder_Stocks(){
         $customer = $this->input->post('customer');
         $date_created = $this->input->post('date_created');
         $email = $this->input->post('email');
         $mobile = $this->input->post('mobile');
         $address = $this->input->post('address');
         $tin = $this->input->post('tin');
         $downpayment = floatval(str_replace(',', '', $this->input->post('downpayment')));
         $date_downpayment = $this->input->post('date_downpayment');
         $discount =  $this->input->post('discount');
         $shipping_fee = floatval(str_replace(',', '', $this->input->post('shipping_fee')));
         $vat =  $this->input->post('vat');
         $description = $this->input->post('description');
         $qty = $this->input->post('qty');
         $unit = $this->input->post('unit');
         $amount = $this->input->post('amount');
         $terms_start = $this->input->post('terms_start');
         $terms_end = $this->input->post('terms_end');
         $data = $this->create_model->Create_Salesorder_Stocks($date_created,$customer,$email,$mobile,$address,$downpayment,$discount,$shipping_fee,$vat,$description,$qty,$unit,$amount,$date_downpayment,$tin,$terms_start,$terms_end);        
         echo json_encode($data); 
    }
    public function Create_Salesorder_Project(){
         $project_no = $this->input->post('project_no');
         $customer = $this->input->post('customer');
         $date_created = $this->input->post('date_created');
         $email = $this->input->post('email');
         $mobile = $this->input->post('mobile');
         $address = $this->input->post('address');
         $tin = $this->input->post('tin');
         $downpayment = floatval(str_replace(',', '', $this->input->post('downpayment')));
         $date_downpayment = $this->input->post('date_downpayment');
         $discount =  $this->input->post('discount');
         $shipping_fee = floatval(str_replace(',', '', $this->input->post('shipping_fee')));
         $amount = $this->input->post('amount');
         $terms_start = $this->input->post('terms_start');
         $terms_end = $this->input->post('terms_end');
         $vat =  $this->input->post('vat');
         $description = $this->input->post('description');
         $qty = $this->input->post('qty');
         $unit = $this->input->post('unit');
         $data = $this->create_model->Create_Salesorder_Project($project_no,$date_created,$customer,$email,$mobile,$address,$downpayment,$discount,$shipping_fee,$vat,$description,$qty,$unit,$amount,$date_downpayment,$tin,$terms_start,$terms_end);        
         echo json_encode($data); 
    }
    public function Create_Return_Item_Warehouse(){
         $type = $this->input->post('type');
         $item_no = $this->input->post('item_no');
         $qty = $this->input->post('qty');
         $status = $this->input->post('status');
         $remarks = $this->input->post('remarks');
         $data = $this->create_model->Create_Return_Item_Warehouse($type,$item_no,$qty,$status,$remarks);        
         echo json_encode($data); 
    }
    public function Create_Return_Item_Customer(){
         $so_no = $this->input->post('so_no');
         $item_no = $this->input->post('item_no');
         $item = $this->input->post('item');
         $qty = $this->input->post('qty');
         $status = $this->input->post('status');
         $remarks = $this->input->post('remarks');
         $data = $this->create_model->Create_Return_Item_Customer($so_no,$item_no,$item,$qty,$status,$remarks);        
         echo json_encode($data); 
    }
    public function Create_Request_Material(){
         $type = $this->input->post('type');
         $item_no = $this->input->post('item_no');
         $item = $this->input->post('item');
         $qty = $this->input->post('qty');
         $data = $this->create_model->Create_Request_Material($item_no,$item,$qty,$type);        
         echo json_encode($data); 
    }
    public function Create_Request_Purchase(){
         $type = $this->input->post('type');
         $item_no = $this->input->post('item_no');
         $item = $this->input->post('item');
         $qty = $this->input->post('qty');
         $amount = $this->input->post('amount');
         $data = $this->create_model->Create_Request_Purchase($item_no,$item,$qty,$type,$amount);        
         echo json_encode($data); 
    }
    public function Create_Request_Pre_Order(){
        $id = $this->input->post('id');
        $data = $this->create_model->Create_Request_Pre_Order($id);        
        echo json_encode($data); 
    }
    public function Create_Customized_Request(){
        $subject = $this->input->post('subject');
        $description = $this->input->post('description');
        $data = $this->create_model->Create_Customized_Request($subject,$description);        
        echo json_encode($data); 
    }
    public function Create_Material_request_Supervisor(){
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Material_request_Supervisor($id,$item,$qty,$type);        
        echo json_encode($data); 
    
    }
    public function Create_Purchase_request_Supervisor(){
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $qty = $this->input->post('qty');
        $remarks = $this->input->post('remarks');
        $type = $this->input->post('type');
        $status = $this->input->post('status');
        $special = $this->input->post('special');
        $unit = $this->input->post('unit');
        $data = $this->create_model->Create_Purchase_request_Supervisor($id,$item,$qty,$remarks,$type,$status,$special,$unit);        
        echo json_encode($data); 
    
    }
    public function Create_Supplier(){
       $name = $this->input->post('name_add');
       $mobile = $this->input->post('mobile_add');
       $email = $this->input->post('email_add');
       $address = $this->input->post('address_add');
       $data =  $this->create_model->Create_Supplier($name,$mobile,$email,$address);
        echo json_encode($data);
     }
    public function Create_Supplier_Item(){
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $item_no = $this->input->post('item_no');
        $type = $this->input->post('type');
        $amount = floatval(str_replace(',', '', $this->input->post('amount')));
        $data = $this->create_model->Create_Supplier_Item($id,$item_no,$item,$amount,$type);        
        echo json_encode($data); 
    }
    public function Create_Delivery_Receipt(){
        $so_no = $this->input->post('so_no');
        $id = $this->input->post('id');
        $item = $this->input->post('item');
        $qty = $this->input->post('qty');
        $type = $this->input->post('type');
        $data = $this->create_model->Create_Delivery_Receipt($id,$item,$qty,$so_no,$type);        
        echo json_encode($data); 
    }
    public function Create_Cashposition_Category(){
        $name = $this->input->post('name');
        $data = $this->create_model->Create_Cashposition_Category($name);        
        echo json_encode($data); 
    }
}
?>
