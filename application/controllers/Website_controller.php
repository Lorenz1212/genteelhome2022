<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_controller extends CI_Controller 
{ 
    public function __construct()
    {
      parent::__construct();
      $this->load->helper('url'); 
      $this->load->helper('string');
      $this->load->library('email');
      $this->load->model('email_model');
      $this->load->model('website_model');
      $this->load->library('session');
    }
    public function email_validation(){
         $email = $this->input->post('email');
         $query = $this->db->select()->from('tbl_customer_online')->where('email',$email)->where('status',1)->get();
          $row = $query->row();
            if(!$row){
                $status = 'error';
                $message = null;
            }else{
                $status ='success';
                $type ="Customer_forgotpassword";
                $name = $row->firstname;
                $subject = "Forgot Password";
                $message = sprintf("%06d", mt_rand(1, 999999));
                $this->website_model->forgotpassword($email,$message,$row->id); 
                $this->email_model->email($type,$email,$subject,$message,$row->firstname);  
                
            }
            $data_json = array('status' => $status,
                                'id'     => $message);
            echo json_encode($data_json);
    }
    public function forgotpassword(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->website_model->change_password(base64_decode($email),$password);
        $data_json = array('status'  => 'success',
                          'message' => base64_decode($email));
        echo json_encode($data_json);
    }
    public function verification_code(){
        $type ="verification_code";
        $name = $this->input->post('firstname');
        $from = $this->input->post('email');
        $subject = "Verification Code";
        $message = sprintf("%06d", mt_rand(1, 999999));
        $this->email_model->email($type,$from,$subject,$message,$name); 
        $data_json = array('status' => 'success',
                           'id'     => $message);
        echo json_encode($data_json);
    }
    
    public function registration(){
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->website_model->registration($firstname,$lastname,$email,$password);
        $data = array('status'=> 'success');
        echo json_encode($data);
    }
    public function header()  
    {  
        $data = $this->website_model->header();
        echo json_encode($data);
    } 
    public function footer()  
    {  
        $data = $this->website_model->footer();
        echo json_encode($data);
    } 
    public function index(){
        $data = $this->website_model->index();
        echo json_encode($data);
    }
    public function account(){
        $id = $this->session->userdata('userId');
        $data = $this->website_model->account($id);
        echo json_encode($data);
    }
    public function product_list(){
        $id = $this->input->post('id');
        $action = $this->input->post('action');
        $data = $this->website_model->product_list($id,$action);
        echo json_encode($data);
    }
    public function product_modal(){
        $id = $this->input->post('id');
        $data = $this->website_model->product_modal($id);
        echo json_encode($data);
    }
    public function product_image_modal(){
        $id = $this->input->post('id');
        $data = $this->website_model->product_image_modal($id);
        echo json_encode($data);
    }
    public function product_gallery(){
        $id = $this->input->post('id');
        $data = $this->website_model->product_gallery($id);
        echo json_encode($data);
    }
    public function product_details(){
        $id = $this->input->post('id');
        $data = $this->website_model->product_details($id);
        echo json_encode($data);
    }
    public function Cart_Product(){
        $userid = $this->session->userdata('userId');
        $data = $this->website_model->Cart_Product($userid);
        echo json_encode($data);
    }
    public function CheckOut_Product(){
        $userid = $this->session->userdata('userId');
        $data = $this->website_model->CheckOut_Product($userid);
        echo json_encode($data);
    }
    public function Coupon_Promo(){
        $id = $this->session->userdata('userId');
        $data = $this->website_model->Coupon_Promo($id);
        echo json_encode($data);
    }
    public function product_arrival(){
        $data = $this->website_model->product_arrival();
        echo json_encode($data);
    }
    public function product_stocks(){
        $data = $this->website_model->product_stocks();
        echo json_encode($data);
    }
    public function product_collection(){
        $userid = $this->session->userdata('userId');
        $data = $this->website_model->product_collection($userid);
        echo json_encode($data);
    }
    public function interior_list(){
        $id = $this->input->post('id');
        $data = $this->website_model->interior_list($id);
        echo json_encode($data);
    }
    public function interior_detail(){
        $id = $this->input->post('id');
        $data = $this->website_model->interior_detail($id);
        echo json_encode($data);
    }
    public function events(){
        $data = $this->website_model->events();
        echo json_encode($data);
    }
    public function About_Us(){
       $data = $this->website_model->About_Us();
        echo json_encode($data); 
    }
    //Create
    public function Create_Product_Cart(){
        $id = $this->session->userdata('userId');
        $c_name = $this->input->post('c_name');
        $qty = $this->input->post('qty');
        $order = $this->input->post('order');
        $data = $this->website_model->Create_Product_Cart($id,$c_name,$qty,$order);
        echo json_encode($data);
    }
     public function Create_Product_Collection(){
        $id = $this->session->userdata('userId');
        $c_name = $this->input->post('c_name');
        $data = $this->website_model->Create_Product_Collection($id,$c_name);
        echo json_encode($data);
    }
    public function Create_Deposit(){
        $firstname         = strtoupper($this->input->post('firstname'));
        $lastname          = strtoupper($this->input->post('lastname'));
        $mobile            = $this->input->post('mobile');
        $email             = $this->input->post('email');
        $date_deposite     = $this->input->post('date_deposite');
        $bank              = $this->input->post('bank');
        $amount            = floatval(str_replace(',', '', $this->input->post('amount')));
        $image  =  isset($_FILES["image"]["name"]) ? $_FILES["image"]["name"]: false;
        $tmp    =  isset($_FILES["image"]["tmp_name"]) ? $_FILES["image"]["tmp_name"]:false;
        $path_image =  "assets/images/deposit/";
        $data = $this->website_model->Create_Deposit($firstname,$lastname,$mobile,$email,$order_no,$date_deposite,$amount,$bank,$tmp,$path_image);
        echo json_encode($data);
    }
    public function Create_Service(){
        error_reporting(0);
        $production_no = $this->input->post('production_no');
        $order_no = $this->input->post('order_no');
        $query1 = $this->db->select('*')->from('tbl_salesorder')->where('so_no',$order_no)->get();
        $row1 = $query1->row();
        $query = $this->db->select('*')->from('tbl_project')->where('production_no',$production_no)->get();
        $row = $query->row();
        if(!$row1){
            $data = array('status' => 'error1');
        }else if(!$row){
            $data = array('status' => 'error');
        }else{
            $firstname         = $this->input->post('firstname');
            $lastname          = $this->input->post('lastname');
            $firstname         = strtoupper($firstname);
            $lastname          = strtoupper($lastname);
            $mobile            = $this->input->post('mobile');
            $email             = $this->input->post('email');
            $comment           = $this->input->post('comment');
            $this->website_model->Create_Service($firstname,$lastname,$mobile,$email,$production_no,$comment,$order_no);
            $data = array('status' => 'success');
        }
        echo json_encode($data);
    }
    public function Create_Email(){
        $name = $this->input->post('name');
        $name = strtoupper($name);
        $subject = $this->input->post('subject');
        $comment = $this->input->post('comment');
        $email = $this->input->post('email');
        $type = "contuct_us";
        $this->website_model->Create_Email($name,$subject,$comment,$email);
        $this->email_model->email($type,$email,$subject,$comment,$name); 
        $data = array('status' => 'success');
        echo json_encode($data);
    }

    //Update
    public function Update_Product_Cart(){
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $total = floatval(str_replace(',', '', $this->input->post('total')));
        $this->website_model->Update_Product_Cart($id,$qty,$total);
         $data = array('status' => 'success');
        echo json_encode($data);
    }
    public function Update_Cart_Process(){
         $id = $this->input->post('id');
         $this->website_model->Update_Cart_Process($id);
         $data = array('status' => 'success');
         echo json_encode($data);
    }
    public function Update_Cart_Product(){
         $id = $this->input->post('id');
         $this->website_model->Update_Cart_Product($id);
         $data = array('status' => 'success');
         echo json_encode($data);
    }
    public function Update_Cart_CheckOut(){
         $id = $this->session->userdata('userId');
         $b_address     =  $this->input->post('b_address');
         $b_city        =  $this->input->post('b_city');
         $b_province    =  $this->input->post('b_province');
         $s_address     =  $this->input->post('s_address');
         $s_city        =  $this->input->post('s_city');
         $s_province    =  $this->input->post('s_province');
         $order_date    =  $this->input->post('order_date');
         $shipping_date =  $this->input->post('shipping_date');
         $order_no      =  $this->input->post('order_no');
         $coupons       =  $this->input->post('coupons');
         $subtotal      =  floatval(str_replace(',', '', $this->input->post('subtotal'))); 
         $total         =  floatval(str_replace(',', '', $this->input->post('total'))); 
         $discount      =  $this->input->post('discount');
         $type          =  $this->input->post('type');
         $region        =  $this->input->post('region');
         $this->website_model->Update_Cart_CheckOut($id,$b_address,$b_city,$b_province,$s_address,$s_city,$s_province,$order_date,$shipping_date,$order_no,$coupons,$subtotal,$total,$discount,$type,$region);
         $data = array('status' => 'success');
         echo json_encode($data);
    }
     public function Update_Password(){
         $id = $this->session->userdata('userId');
         $password = $this->input->post('password');
         $this->website_model->Update_Password($id,$password);
         $data = array('status' => 'success');
         echo json_encode($data);
    }
     public function Update_Account(){
         $id = $this->session->userdata('userId');
         $firstname = $this->input->post('firstname');
         $lastname = $this->input->post('lastname');
         $address = $this->input->post('address');
         $city = $this->input->post('city');
         $province = $this->input->post('province');
         $region = $this->input->post('region');
         $mobile = $this->input->post('mobile');
         $this->website_model->Update_Account($id,$firstname,$lastname,$address,$city,$province,$region,$mobile);
         $data = array('status' => 'success');
         echo json_encode($data);
    }

}
?>